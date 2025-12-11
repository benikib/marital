<?php

namespace App\Http\Controllers;

use App\Models\mariage;
use App\Models\Epoux;
use App\Models\Epouse;
use App\Models\ParentEpouse;
use App\Models\ParentEpoux;
use App\Models\Status;
use App\Models\RegimeMatrimoniale;
use App\Models\AyantDroitCoutinier;
use App\Models\Contrat;
use App\Models\temoinEpouse;
use App\Models\temoinEpoux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Parent_;

class MariageController extends Controller
{
    /**
     * Affiche la liste des mariages
     */
    public function index(Request $request)
    {
        $query = mariage::with(['epoux', 'epouse', 'status', 'regimeMatrimonial', 'ayantDroitCoutinier']);

        // Filtres
        if ($request->has('province')) {
            $query->whereHas('epoux', function ($q) use ($request) {
                $q->where('province', $request->province);
            })->orWhereHas('epouse', function ($q) use ($request) {
                $q->where('province', $request->province);
            });
        }

        if ($request->has('date_debut') && $request->has('date_fin')) {
            $query->whereBetween('date_mariage', [$request->date_debut, $request->date_fin]);
        }

        $mariages = $query->latest()->paginate(10);
        $provinces = Epoux::select('province')->distinct()->pluck('province');


        return view('formulaires.index', compact('mariages', 'provinces'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function certification(Mariage $mariage){

    $mariage->load(['epoux', 'epouse', 'status', 'regimeMatrimonial.contrat', 'ayantDroitCoutinier','commune']);


        return view('certification', compact('mariage'));
    }
    public function create()
    {
        $epoux = Epoux::all();
        $epouses = Epouse::all();
        $status = Status::all();
        $regimes = RegimeMatrimoniale::with('contrat')->get();
        $ayantsDroit = AyantDroitCoutinier::all();
        $provinces = Epoux::select('province')->distinct()->pluck('province');
        $contrats = Contrat::all();
        return view('formulaires.create', compact('epoux', 'epouses', 'status', 'regimes', 'ayantsDroit', 'provinces', 'contrats'));
    }

    /**
     * Enregistre un nouveau mariage
     */
//     public function store(Request $request)
//     {
//        try {
//          $regime = RegimeMatrimoniale::create($request->regime);
//         // $regime = RegimeMatrimoniale::findOrFail($request->regime['id']);
//         $epoux = Epoux::create($request->epoux);

//           $epouse = Epouse::create($request->epouse);
//           $AyantDroitCoutinier = AyantDroitCoutinier::create($request->ayantdroit);
//             $parent_pere_epoux = ParentEpoux::create($request->pere_epoux  + ['epoux_id' => $epoux->id,'epouse_id' => $epouse->id]
// );
//             $parent_mere_epoux = ParentEpoux::create($request->mere_epoux + ['epoux_id' => $epoux->id,'epouse_id' => $epouse->id]);
//             $parent_pere_epouse = parentEpouse::create($request->pere_epouse+ ['epoux_id' => $epoux->id,'epouse_id' => $epouse->id]);
//              $parent_mere_epouse = parentEpouse::create($request->mere_epouse+ ['epoux_id' => $epoux->id,'epouse_id' => $epouse->id]);
//             $temoin_epoux = TemoinEpoux::create($request->temoin_epoux  + ['epoux_id' => $epoux->id]);
//             $temoin_epouse = temoinEpouse::create($request->temoin_epouse  + ['epouse_id' => $epouse->id]);
//         $mariage= mariage::create()([
//             'epoux_id' => $epoux->id,
//             'epouse_id' => $epouse->id,
//             'status_id' => $request->mariage['status_id'],
//             'regime_matrimonial_id' => $regime->id,
//             'ayant_droit_coutinier_id' => $AyantDroitCoutinier->id,
//             'date_mariage' => $request->mariage['date_mariage'],
//             'lieu_mariage' => $request->mariage['lieu_mariage']
//         ]);

//        } catch (\Throwable $th) {
//         dd($th);
//               return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement du mariage.']);
//        }



//        // $mariage = mariage::create($validated + ['user_id' => auth()->id()]);

//         return redirect()->route('mariages.show', $mariage)
//             ->with('success', 'Mariage enregistré avec succès.');
//     }

//     /**
//      * Affiche les détails d'un mariage
//      */
    public function show(Mariage $mariage)
    {
        $mariage->load(['epoux', 'epouse', 'status', 'regimeMatrimonial.contrat', 'ayantDroitCoutinier','commune']);

        return view('formulaires.show', compact('mariage'));
    }

// public function store(Request $request)

//   {  // Démarrer une transaction
//     DB::beginTransaction();

//     try {
//         $regime = RegimeMatrimoniale::create($request->regime);
//         $epoux = Epoux::create($request->epoux);
//         $epouse = Epouse::create($request->epouse);
//         $AyantDroitCoutinier = AyantDroitCoutinier::create($request->ayantdroit);

//         $parent_pere_epoux = ParentEpoux::create($request->pere_epoux + [
//             'epoux_id' => $epoux->id,
//             'epouse_id' => $epouse->id
//         ]);

//         $parent_mere_epoux = ParentEpoux::create($request->mere_epoux + [
//             'epoux_id' => $epoux->id,
//             'epouse_id' => $epouse->id
//         ]);

//         $parent_pere_epouse = parentEpouse::create($request->pere_epouse + [
//             'epoux_id' => $epoux->id,
//             'epouse_id' => $epouse->id
//         ]);

//         $parent_mere_epouse = parentEpouse::create($request->mere_epouse + [
//             'epoux_id' => $epoux->id,
//             'epouse_id' => $epouse->id
//         ]);

//         $temoin_epoux = TemoinEpoux::create($request->temoin_epoux + [
//             'epoux_id' => $epoux->id
//         ]);

//         $temoin_epouse = temoinEpouse::create($request->temoin_epouse + [
//             'epouse_id' => $epouse->id
//         ]);

//         // Correction de la syntaxe ici (suppression des parenthèses en trop)
//         $mariage = mariage::create([
//             'epoux_id' => $epoux->id,
//             'epouse_id' => $epouse->id,
//             'status_id' => $request->mariage['status_id'],
//             'regime_matrimonial_id' => $regime->id,
//             'ayant_droit_coutinier_id' => $AyantDroitCoutinier->id,
//             'date_mariage' => $request->mariage['date_mariage'],
//             'lieu_mariage' => $request->mariage['lieu_mariage']
//         ]);

//         // Si tout s'est bien passé, valider la transaction
//         DB::commit();

//         return redirect()->route('mariages.show', $mariage)
//             ->with('success', 'Mariage enregistré avec succès.');

//     } catch (\Throwable $th) {

//         // En cas d'erreur, annuler la transaction
//         DB::rollBack();
//         dd($th);

//         // Journaliser l'erreur pour le débogage


//         return redirect()->back()
//             ->withInput()
//             ->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement du mariage. Détails: ' . $th->getMessage()]);
//     }
// }

// Dans votre contrôleur
public function checkPersonExists(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|min:2|max:255',
        'prenom' => 'required|string|min:2|max:255',
        'date_naissance' => 'required|date|before:today'
    ]);

    try {
        $exists = Personne::where('nom', $validated['nom'])
                         ->where('prenom', $validated['prenom'])
                         ->whereDate('date_naissance', $validated['date_naissance'])
                         ->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Personne trouvée' : 'Nouvelle personne'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Erreur lors de la vérification'
        ], 500);
    }
}
public function store(Request $request)
{



    try {
        // Gestion de la photo de l'époux
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

        // Vérifier si un mariage existe déjà entre ces deux personnes
        if ($epouxExist && $epouseExist) {
            $mariageExist = mariage::where('epoux_id', $epouxExist->id)
                ->where('epouse_id', $epouseExist->id)
                ->exists();

            if ($mariageExist) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'Un mariage entre ces deux personnes existe déjà.']);
            }
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

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Mariage $mariage)
    {
        $epoux = Epoux::all();
        $epouses = Epouse::all();
        $status = Status::all();
        $regimes = RegimeMatrimoniale::with('contrat')->get();
        $ayantsDroit = AyantDroitCoutinier::all();
        $provinces = Epoux::select('province')->distinct()->pluck('province');

        return view('formulaires.edit', compact('mariage', 'epoux', 'epouses', 'status', 'regimes', 'ayantsDroit','provinces'));
    }

    /**
     * Met à jour un mariage
     */
    public function update(Request $request, Mariage $mariage)
    {
        $validated = $request->validate([
            'epoux_id' => 'required|exists:epouxes,id',
            'epouse_id' => 'required|exists:epouses,id',
            'status_id' => 'required|exists:status,id',
            'regime_matrimonial_id' => 'required|exists:regimes_matrimonauxes,id',
            'ayant_droit_coutinier_id' => 'required|exists:ayant_droit_coutiniers,id',
            'date_mariage' => 'required|date',
            'lieu_mariage' => 'required|string|max:255',
        ]);

        $mariage->update($validated);

        return redirect()->route('mariages.show', $mariage)
            ->with('success', 'Mariage mis à jour avec succès.');
    }

    /**
     * Supprime un mariage
     */
    public function destroy(Mariage $mariage)
    {
        $mariage->delete();

        return redirect()->route('mariages.index')
            ->with('success', 'Mariage supprimé avec succès.');
    }
}
