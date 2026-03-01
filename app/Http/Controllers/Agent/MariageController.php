<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Epoux;
use App\Models\Epouse;
use App\Models\parentEpouse;
use App\Models\parentEpoux;
use App\Models\Status;
use App\Models\RegimeMatrimoniale;
use App\Models\AyantDroitCoutumier;
use App\Models\Contrat;
use App\Models\mariage;
use App\Models\temoinEpouse;
use App\Models\temoinEpoux;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\MariageDraft;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use phpDocumentor\Reflection\Types\Parent_;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class MariageController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $entite = $user->entite;

        $query = mariage::with(['epoux', 'epouse', 'status']);
        if ($entite) {
            $query->where('entite_id', $entite->id);
        }

        $mariages = $query->latest()->paginate(10);

        return view('agents.mariages.index', compact('mariages'));
    }

    /**
     * Save a mariage draft from the current request (including uploaded files).
     */
    private function saveDraftFromRequest(Request $request)
    {
        $payload = $request->except(['_token', '_method']);
        $filesSaved = [];

        $files = $request->allFiles();

        $saveFilesRecursive = function ($filesArr, &$targetArr) use (&$saveFilesRecursive, &$filesSaved) {
            foreach ($filesArr as $key => $val) {
                if ($val instanceof \Illuminate\Http\UploadedFile) {
                    $ext = $val->getClientOriginalExtension() ?: 'jpg';
                    $filename = 'draft_' . time() . '_' . Str::random(8) . '.' . $ext;
                    $path = $val->storeAs('photos/drafts', $filename, 'public');
                    $filesSaved[$key] = $path;
                    // place url in target arr if possible
                    $targetArr[$key] = Storage::url($path);
                } elseif (is_array($val)) {
                    $targetArr[$key] = $targetArr[$key] ?? [];
                    $saveFilesRecursive($val, $targetArr[$key]);
                }
            }
        };

        // Prepare structure in payload matching files
        $saveFilesRecursive($files, $payload);

        MariageDraft::create([
            'user_id' => auth()->id(),
            'data' => $payload,
            'files' => $filesSaved,
        ]);
    }

    public function create(Request $request)
    {
        $entite = auth()->user()->entite;
        $commune = null;
        if ($entite && $entite->type === 'commune') {
            $commune = $entite;
        }
        $status = Status::all();
        $contrats = Contrat::all();
        // If a draft id is provided, load it (only if it belongs to the current user)
        $draftData = null;
        $draftFiles = null;
        if ($request->has('draft')) {
            $draft = MariageDraft::where('id', $request->query('draft'))
                ->where('user_id', auth()->id())
                ->first();
            if ($draft) {
                $draftData = $draft->data ?? null;
                $draftFiles = $draft->files ?? null;
            }
        }

        return view('agents.mariages.create', compact('commune', 'status','contrats', 'draftData', 'draftFiles'));
    }

    public function store(Request $request)
    {
        dd('store called');
        try {
            $request->validate([
                'epoux.nom' => 'required|string|max:255',
                'epoux.prenom' => 'required|string|max:255',
                'epoux.date_naissance' => 'required|date',
                'epoux.url_photo' => 'required|image|max:5120',

                'epouse.nom' => 'required|string|max:255',
                'epouse.prenom' => 'required|string|max:255',
                'epouse.date_naissance' => 'required|date',
                'epouse.url_photo' => 'required|image|max:5120',

                'mariage.date_mariage' => 'required|date',
                'mariage.lieu_mariage' => 'required|string|max:255',
                'mariage.status_id' => 'required|exists:status,id',
                'mariage.couple_photo' => 'required|image|max:5120',

                'regime.dotation_coutumier' => 'required|numeric',
                'regime.contrat_id' => 'required|exists:contrats,id',
            ]);
        } catch (ValidationException $ve) {
            try {
                $this->saveDraftFromRequest($request);
            } catch (\Throwable $e) {
                Log::error('Failed to save agent draft on validation error: ' . $e->getMessage(), ['exception' => $e]);
            }
            return redirect()->back()->withInput()->withErrors($ve->validator)->with('draft_saved', true);
        }

        // Age checks
        $epouxAge = Carbon::parse($request->input('epoux.date_naissance'))->age;
        $epouseAge = Carbon::parse($request->input('epouse.date_naissance'))->age;
        if ($epouxAge < 18 || $epouseAge < 18) {
            return redirect()->back()->withInput()->withErrors(['error' => 'L\'époux ou l\'épouse a moins de 18 ans. Le dossier ne peut pas être validé.']);
        }

        DB::beginTransaction();
        $user = Auth::user();
        // Vérifier si l'époux existe déjà
        $epouxExist = Epoux::where('nom', $request->epoux['nom'])
            ->where('prenom', $request->epoux['prenom'])
            ->where('date_naissance', $request->epoux['date_naissance'])
            ->first();
            Log::debug('Agent\\MariageController: after epoux existence check', ['epouxExist' => (bool) $epouxExist]);

        if ($epouxExist) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Un époux avec ces informations existe déjà.']);
        }
        Log::debug('Agent\\MariageController: before epouse existence check');

        // Vérifier si l'épouse existe déjà
        $epouseExist = Epouse::where('nom', $request->epouse['nom'])
            ->where('prenom', $request->epouse['prenom'])
            ->where('date_naissance', $request->epouse['date_naissance'])
            ->first();
            Log::debug('Agent\\MariageController: after epouse existence check', ['epouseExist' => (bool) $epouseExist]);

        if ($epouseExist) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Une épouse avec ces informations existe déjà.']);
        }
        $epouxData = $request->epoux;
        if ($request->hasFile('epoux.url_photo')) {
            $path = $request->file('epoux.url_photo')->store('photos/epoux', 'public');

            $epouxData['url_photo'] = $path;
        } else {
            $epouxData['url_photo'] = 'default.jpg'; // Valeur par défaut
        }
        Log::debug('Agent\\MariageController: before epoux creation');

        $epoux = Epoux::create($epouxData);

        // Gestion de la photo de l'épouse
        $epouseData = $request->epouse;
        if ($request->hasFile('epouse.url_photo')) {
            $path = $request->file('epouse.url_photo')->store('photos/epouse', 'public');
            $epouseData['url_photo'] = $path;
        } else {
            $epouseData['url_photo'] = 'default.jpg'; // Valeur par défaut
        }
        $epouse = Epouse::create($epouseData);


        $AyantDroitCoutumier = AyantDroitCoutumier::create($request->ayant_droit );

        $parent_pere_epoux = ParentEpoux::create($request->pere_epoux + [
            'epouxe_id' => $epoux->id,
            'epouse_id' => $epouse->id,

        ]);

        $parent_mere_epoux = ParentEpoux::create($request->mere_epoux + [
            'epouxe_id' => $epoux->id,
            'epouse_id' => $epouse->id,

        ]);

        $parent_pere_epouse = parentEpouse::create($request->pere_epouse + [
            'epouxe_id' => $epoux->id,
            'epouse_id' => $epouse->id,


        ]);

        $parent_mere_epouse = parentEpouse::create($request->mere_epouse + [
            'epouxe_id' => $epoux->id,
            'epouse_id' => $epouse->id,

        ]);

        $temoin_epoux = TemoinEpoux::create($request->temoin_epoux + [
            'epouxe_id' => $epoux->id
        ]);

        $temoin_epouse = temoinEpouse::create($request->temoin_epouse + [
            'epouse_id' => $epouse->id
        ]);

        // Correction de la syntaxe ici (suppression des parenthèses en trop)
        // Stockage de la photo du couple
        $couplePhotoPath = null;
        if ($request->hasFile('mariage.couple_photo')) {
            $couplePhotoPath = $request->file('mariage.couple_photo')->store('photos/couple', 'public');
        }

        // Create regime first because DB requires a non-null regime_matrimonial_id
        $regime = RegimeMatrimoniale::create($request->regime ?? []);

        $mariage = mariage::create([
            'epoux_id' => $epoux->id,
            'epouse_id' => $epouse->id,
            'status_id' => $request->mariage['status_id'],
            'regime_matrimonial_id' => $regime->id,
            'ayant_droit_coutumier_id' => $AyantDroitCoutumier->id,
            'couple_photo' => $couplePhotoPath,
            'date_mariage' => $request->mariage['date_mariage'],
            'lieu_mariage' => $request->mariage['lieu_mariage'],
            'user_id' => $user->id,
            'commune_id'=> $user->commune_id ?? null,
            'entite_id' => $user->entite?->id,
        ]);


        DB::commit();

        return redirect()->route('mariages.show', $mariage)
            ->with('success', 'Mariage enregistré avec succès.');

    } 
   
        public function show(Mariage $mariage)
    {
        $mariage->load(['epoux', 'epouse', 'status', 'regimeMatrimonial.contrat', 'ayantDroitCoutumier','entite']);

        return view('formulaires.show', compact('mariage'));
    }

    public function edit(Mariage $mariage)
    {
        // Vérifier que le mariage appartient à la commune de l'agent
        // if ($mariage->commune_id !== auth()->user()->commune->id) {
        //     abort(403, 'Accès non autorisé.');
        // }
        $contrats = Contrat::all();

        $epouses = Epouse::all();
        $epoux = Epoux::find($mariage->epoux_id);
        $status = Status::all();
        $regimes = RegimeMatrimoniale::with('contrat')->get();
        $ayantsDroit = AyantDroitCoutumier::all();
        $provinces = Epoux::select('province')->distinct()->pluck('province');

        return view('formulaires.edit', compact('mariage', 'epoux', 'epouses', 'status', 'regimes', 'ayantsDroit','provinces','contrats'));
    }

    public function update(Request $request, Mariage $mariage)
    {
        // Vérifier que le mariage appartient à la commune de l'agent
        // if ($mariage->commune_id !== auth()->user()->commune->id) {
        //     abort(403, 'Accès non autorisé.');
        // }

        $request->validate([
            'epoux_nom' => 'required|string|max:255',
            'epoux_prenom' => 'required|string|max:255',
            'epoux_date_naissance' => 'required|date',
            'epoux_lieu_naissance' => 'required|string|max:255',
            'epoux_profession' => 'required|string|max:255',
            'epoux_adresse' => 'required|string|max:255',
            'epoux_nationalite' => 'required|string|max:255',
            'epoux_piece_identite' => 'required|string|max:255',
            'epoux_numero_piece' => 'required|string|max:255',

            'epouse_nom' => 'required|string|max:255',
            'epouse_prenom' => 'required|string|max:255',
            'epouse_date_naissance' => 'required|date',
            'epouse_lieu_naissance' => 'required|string|max:255',
            'epouse_profession' => 'required|string|max:255',
            'epouse_adresse' => 'required|string|max:255',
            'epouse_nationalite' => 'required|string|max:255',
            'epouse_piece_identite' => 'required|string|max:255',
            'epouse_numero_piece' => 'required|string|max:255',

            'date_mariage' => 'required|date',
            'lieu_mariage' => 'required|string|max:255',
            'status_id' => 'required|exists:status,id',
        ]);

        // Mettre à jour l'époux
        $mariage->epoux->update([
            'nom' => $request->epoux_nom,
            'prenom' => $request->epoux_prenom,
            'date_naissance' => $request->epoux_date_naissance,
            'lieu_naissance' => $request->epoux_lieu_naissance,
            'profession' => $request->epoux_profession,
            'adresse' => $request->epoux_adresse,
            'nationalite' => $request->epoux_nationalite,
            'piece_identite' => $request->epoux_piece_identite,
            'numero_piece' => $request->epoux_numero_piece,
        ]);

        // Mettre à jour l'épouse
        $mariage->epouse->update([
            'nom' => $request->epouse_nom,
            'prenom' => $request->epouse_prenom,
            'date_naissance' => $request->epouse_date_naissance,
            'lieu_naissance' => $request->epouse_lieu_naissance,
            'profession' => $request->epouse_profession,
            'adresse' => $request->epouse_adresse,
            'nationalite' => $request->epouse_nationalite,
            'piece_identite' => $request->epouse_piece_identite,
            'numero_piece' => $request->epouse_numero_piece,
        ]);

        // Mettre à jour le mariage
        $mariage->update([
            'date_mariage' => $request->date_mariage,
            'lieu_mariage' => $request->lieu_mariage,
            'status_id' => $request->status_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('agent.mariagescommunes.show', $mariage)
            ->with('success', 'Mariage mis à jour avec succès.');
    }

    public function print(Mariage $mariage)
    {
    $mariage->load(['epoux', 'epouse', 'status', 'regimeMatrimonial.contrat', 'ayantDroitCoutumier','commune']);


        return view('certification', compact('mariage'));

        $mariage->load(['epoux', 'epouse', 'status', 'commune']);

        $pdf = PDF::loadView('agents.mariages.print', compact('mariage'));
        return $pdf->stream('acte-mariage-' . $mariage->id . '.pdf');
    }

}
