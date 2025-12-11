<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Epoux;
use App\Models\Epouse;
use App\Models\parentEpouse;
use App\Models\parentEpoux;
use App\Models\Status;
use App\Models\RegimeMatrimoniale;
use App\Models\AyantDroitCoutinier;
use App\Models\contrat;
use App\Models\mariage;
use App\Models\temoinEpouse;
use App\Models\temoinEpoux;

use Illuminate\Support\Facades\Auth;

use phpDocumentor\Reflection\Types\Parent_;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class MariageController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->where('commune_id', $user->commune_id)
            ->latest()
            ->paginate(10);

        return view('agents.mariages.index', compact('mariages'));
    }

    public function create()
    {
        $commune = auth()->user()->commune;
        $status = Status::all();
        $contrats = Contrat::all();
        return view('agents.mariages.create', compact('commune', 'status','contrats'));
    }

    public function store(Request $request)
    {
        try {
           $user = Auth::user();

        // Vérifier si l'époux existe déjà
        $epouxExist = Epoux::where('nom', $request->epoux['nom'])
            ->where('prenom', $request->epoux['prenom'])
            ->where('date_naissance', $request->epoux['date_naissance'])
            ->first();

        if ($epouxExist) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Un époux avec ces informations existe déjà.']);
        }

        // Vérifier si l'épouse existe déjà
        $epouseExist = Epouse::where('nom', $request->epouse['nom'])
            ->where('prenom', $request->epouse['prenom'])
            ->where('date_naissance', $request->epouse['date_naissance'])
            ->first();

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

        $epoux = Epoux::create($epouxData);

        // Gestion de la photo de l'épouse
        $epouseData = $request->epouse;
        if ($request->hasFile('epouse.url_photo')) {
            $path = $request->file('epouse.url_photo')->store('photos/epouse', 'public');
            $epouseData['url_photo'] = $path;
        } else {
            $epouseData['url_photo'] = 'default.jpg'; // Valeur par défaut
        }
        $epouse = Epouse::create($request->epouse);


        $regime = RegimeMatrimoniale::create($request->regime);


        $AyantDroitCoutinier = AyantDroitCoutinier::create($request->ayant_droit );

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
        $mariage = mariage::create([
            'epoux_id' => $epoux->id,
            'epouse_id' => $epouse->id,
            'status_id' => $request->mariage['status_id'],
            'regime_matrimonial_id' => $regime->id,
            'ayant_droit_coutinier_id' => $AyantDroitCoutinier->id,
            'date_mariage' => $request->mariage['date_mariage'],
            'lieu_mariage' => $request->mariage['lieu_mariage'],
            'user_id' => $user->id,
            'commune_id'=> $user->commune_id,
        ]);


        DB::commit();

        return redirect()->route('mariages.show', $mariage)
            ->with('success', 'Mariage enregistré avec succès.');

    } catch (\Throwable $th) {
        DB::rollBack();
        dd($th);
        return redirect()->back()
            ->withInput()
            ->withErrors(['error' => 'Erreur: ' . $th->getMessage()]);
    }
    }

        public function show(Mariage $mariage)
    {
        $mariage->load(['epoux', 'epouse', 'status', 'regimeMatrimonial.contrat', 'ayantDroitCoutinier','commune']);

        return view('formulaires.show', compact('mariage'));
    }

    public function edit(Mariage $mariage)
    {
        // Vérifier que le mariage appartient à la commune de l'agent
        // if ($mariage->commune_id !== auth()->user()->commune->id) {
        //     abort(403, 'Accès non autorisé.');
        // }

        $epouses = Epouse::all();
        $epoux = Epoux::find($mariage->epoux_id);
        $status = Status::all();
        $regimes = RegimeMatrimoniale::with('contrat')->get();
        $ayantsDroit = AyantDroitCoutinier::all();
        $provinces = Epoux::select('province')->distinct()->pluck('province');

        return view('formulaires.edit', compact('mariage', 'epoux', 'epouses', 'status', 'regimes', 'ayantsDroit','provinces'));
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
       $mariage->load(['epoux', 'epouse', 'status', 'regimeMatrimonial.contrat', 'ayantDroitCoutinier','commune']);


        return view('certification', compact('mariage'));

        $mariage->load(['epoux', 'epouse', 'status', 'commune']);

        $pdf = PDF::loadView('agents.mariages.print', compact('mariage'));
        return $pdf->stream('acte-mariage-' . $mariage->id . '.pdf');
    }

}
