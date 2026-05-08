<?php

namespace App\Http\Controllers;

use App\Models\EntiteAdministrative;
use App\Models\Mariage;
use App\Models\Personne;
use App\Models\RegimeMatrimonial;
use App\Models\StatutMariage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MariageController extends Controller
{
    private function uploadImage($request, $field)
{
    if ($request->hasFile($field)) {
        return $request->file($field)
            ->store('photos/' . date('Y/m'), 'public');
    }

    return null;
}
 public function index(Request $request)
{
    $query = Mariage::with(['epoux', 'epouse', 'regime', 'statut', 'entite', 'temoins.personne', 'parents.personne', 'user']);

    // 🔍 Recherche (nom/prénom)
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->whereHas('epoux', function ($q2) use ($search) {
                $q2->where('nom', 'like', "%$search%")
                   ->orWhere('prenom', 'like', "%$search%");
            })
            ->orWhereHas('epouse', function ($q2) use ($search) {
                $q2->where('nom', 'like', "%$search%")
                   ->orWhere('prenom', 'like', "%$search%");
            });
        });
    }

    // 📅 Filtre par date
    if ($request->filled('date')) {
        $query->whereDate('date_mariage', $request->date);
    }

    // 📍 Filtre par lieu
    if ($request->filled('lieu')) {
        $query->where('lieu_mariage', 'like', "%{$request->lieu}%");
    }

    $stats = [
        'total' => Mariage::count(),
        'filtered' => (clone $query)->count(),
    ];

    $mariages = $query->latest()->paginate(10)->withQueryString();

    return view('mariages.index', compact('mariages', 'stats'));
}

    public function create()
    {
        $personnes = Personne::orderBy('nom')->orderBy('prenom')->where("statut_vie", "en vie")->get();
        // qui lle statut du mariage est "en cours" ou "dissous" ou "annulé"

        $personnes_epoux = Personne::orderBy('nom')->orderBy('prenom')->where("sexe", "M")->
         where("statut_vie", "en vie")->
        whereDoesntHave('mariagesEpoux', function ($query) {
            $query->whereIn('statut_id', function ($subQuery) {
                $subQuery->select('id')
                    ->from('statuts_mariage')
                    ->whereIn('nom', ['en cours', 'dissous', 'annulé']);
            });
        })->
        get();

       $personnes_epouse = Personne::orderBy('nom')->orderBy('prenom')->where("sexe", "F")
        ->where("statut_vie", "en vie")->
        whereDoesntHave('mariagesEpouse', function ($query) {
            $query->whereIn('statut_id', function ($subQuery) {
                $subQuery->select('id')
                    ->from('statuts_mariage')
                    ->whereIn('nom', ['en cours', 'dissous', 'annulé']);
            });
        })->
        get();
        
        $regimes = RegimeMatrimonial::with('contrat')->orderBy('id')->get();
        
        $statuts = StatutMariage::orderBy('nom')->get();
        $entites = EntiteAdministrative::orderBy('nom')->get();
        $mariage = Mariage::orderBy('date_mariage', 'desc')->first();

        return view('mariages.create', compact('personnes', 'regimes', 'statuts', 'entites', 'personnes_epoux', 'personnes_epouse'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'epoux_id' => 'required|exists:personnes,id',
        'epouse_id' => 'required|exists:personnes,id',
        'regime_id' => 'required|exists:regimes_matrimoniaux,id',
        'statut_id' => 'required|exists:statuts_mariage,id',
        'date_mariage' => 'required|date',
        'lieu_mariage' => 'required|string|max:255',
        'empreinte_epoux' => 'nullable|string|max:255',
        'empreinte_epouse' => 'nullable|string|max:255',
        'photo_epoux' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'photo_epouse' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'photo_couple' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'etat_civil_epoux' => 'required|string|max:50',
        'etat_civil_epouse' => 'required|string|max:50',
       
    ]);

    // Upload images (propre)
    $validated['photo_epoux'] = $this->uploadImage($request, 'photo_epoux');
    $validated['photo_epouse'] = $this->uploadImage($request, 'photo_epouse');
    $validated['photo_couple'] = $this->uploadImage($request, 'photo_couple');

    // Ajouter user
    $validated['user_id'] = auth()->id();
    $validated['entite_id'] = auth()->user()->entite_id;

    Mariage::create($validated);
    changeEtatCivil($validated['epoux_id'], 'marié');
    changeEtatCivil($validated['epouse_id'], 'marié');

    return redirect()->route('mariages.index')
        ->with('success', 'Mariage créé avec succès.');
}

    public function edit(Mariage $mariage)
    {
        $personnes = Personne::orderBy('nom')->orderBy('prenom')->where("statut_vie", "en vie")->get();

        $personnes_epoux = Personne::orderBy('nom')->orderBy('prenom')->where("sexe", "M")->
        where("statut_vie", "en vie")->
        whereDoesntHave('mariagesEpoux', function ($query) use ($mariage) {
            $query->whereIn('statut_id', function ($subQuery) {
                $subQuery->select('id')
                    ->from('statuts_mariage')
                    ->whereIn('nom', ['en cours', 'dissous', 'annulé']);
            })->where('id', '!=', $mariage->id);
        })->get();

        $personnes_epouse = Personne::orderBy('nom')->orderBy('prenom')->where("sexe", "F")->
        where("statut_vie", "en vie")->
        whereDoesntHave('mariagesEpouse', function ($query) use ($mariage) {
            $query->whereIn('statut_id', function ($subQuery) {
                $subQuery->select('id')
                    ->from('statuts_mariage')
                    ->whereIn('nom', ['en cours', 'dissous', 'annulé']);
            })->where('id', '!=', $mariage->id);
        })->get();  

        $regimes = RegimeMatrimonial::with('contrat')->orderBy('id')->get();
        $statuts = StatutMariage::orderBy('nom')->get();
        $entites = EntiteAdministrative::orderBy('nom')->get();
        
        return view('mariages.edit', compact('mariage', 'personnes', 'regimes', 'statuts', 'entites', 'personnes_epoux', 'personnes_epouse'));
    }

    public function update(Request $request, Mariage $mariage)
    {
      $validated =  $request->validate([
            'epoux_id' => 'required|exists:personnes,id',
            'epouse_id' => 'required|exists:personnes,id',
            'regime_id' => 'required|exists:regimes_matrimoniaux,id',
            'statut_id' => 'required|exists:statuts_mariage,id',
            'date_mariage' => 'required|date',
            'lieu_mariage' => 'required|string|max:255',
            'empreinte_epoux' => 'nullable|string|max:255',
            'empreinte_epouse' => 'nullable|string|max:255',
            'photo_epoux' => 'nullable|image',
            'photo_epouse' => 'nullable|image',
            'photo_couple' => 'nullable|image',
            'etat_civil_epoux' => 'required|string|max:50',
            'etat_civil_epouse' => 'required|string|max:50',
            'entite_id' => 'required|exists:entite_administratives,id',
        ]);
            
        // Upload images (propre)
        $validated['photo_epoux'] = $this->uploadImage($request, 'photo_epoux') ?? $mariage->photo_epoux;
        $validated['photo_epouse'] = $this->uploadImage($request, 'photo_epouse') ?? $mariage->photo_epouse;
        $validated['photo_couple'] = $this->uploadImage($request, 'photo_couple') ?? $mariage->photo_couple;    
         
        $validated['user_id'] = auth()->id();

        $mariage->update($validated);

        return redirect()->route('mariages.index')->with('success', 'Mariage mis à jour.');
    }

    public function destroy(Mariage $mariage)
    {
        $mariage->delete();

        return redirect()->route('mariages.index')->with('success', 'Mariage supprimé.');
    }

    public function temoins(Mariage $mariage)
    {
        $temoins = $mariage->temoins()->with('personne')->get();
         $personnes = Personne::orderBy('nom')->orderBy('prenom')->where("statut_vie", "en vie")->get();
        
        return view('mariages.temoins', compact('mariage', 'temoins', 'personnes'));
    }

    public function parents(Mariage $mariage)
    {
        $parents = $mariage->parents()->with('personne')->get();
        
        $personnes = Personne::orderBy('nom')->orderBy('prenom')->where("statut_vie", "en vie")->get();

        return view('mariages.parents', compact('mariage', 'parents', 'personnes'));
    }

    public function show(Mariage $mariage)
    {
        $mariage->load(['epoux', 'epouse', 'regime.contrat', 'statut', 'entite']);

        return view('mariages.show', compact('mariage'));
    }

    public function storeTemoin(Request $request)
    {
        $request->validate([
            'mariage_id' => 'required|exists:mariages,id',
            'temoin_epoux' => 'required|exists:personnes,id',
            'temoin_epouse' => 'required|exists:personnes,id',
            
        ]);

        $mariage = Mariage::findOrFail($request->mariage_id);
        $mariage->temoins()->create([
            'personne_id' => $request->temoin_epoux,
            'role' => 'témoin de l\'époux',
        ]);
        $mariage->temoins()->create([
            'personne_id' => $request->temoin_epouse,
            'role' => 'témoin de l\'épouse',
        ]);

        return redirect()->route('mariages.temoins', $mariage)->with('success', 'Témoin ajouté avec succès.');
    }

    public function storeParent(Request $request)
    {
          
        $request->validate([
            'mariage_id' => 'required|exists:mariages,id',
            'pere_epoux' => 'required|exists:personnes,id',
            'mere_epoux' => 'required|exists:personnes,id',
            'pere_epouse' => 'required|exists:personnes,id',
            'mere_epouse' => 'required|exists:personnes,id',
        ]);

        $mariage = Mariage::findOrFail($request->mariage_id);
        $mariage->parents()->create([
            'personne_id' => $request->pere_epoux,
            'type_parent' => 'père de l\'époux',
        ]);
        $mariage->parents()->create([
            'personne_id' => $request->mere_epoux,
            'type_parent' => 'mère de l\'époux',
        ]);
        $mariage->parents()->create([
            'personne_id' => $request->pere_epouse,
            'type_parent' => 'père de l\'épouse',
        ]);
        $mariage->parents()->create([
            'personne_id' => $request->mere_epouse,
            'type_parent' => 'mère de l\'épouse',
        ]);

        return redirect()->route('mariages.show', $mariage)->with('success', 'Parents ajoutés avec succès.');
    }

   
public function certificat(Mariage $mariage)
{
    $mariage->load(['epoux', 'epouse', 'statut', 'regime.contrat', 'entite']);

    return view('mariages.certificat', compact('mariage'));
}

public function certificatPdf(Mariage $mariage)
{
    $mariage->load(['epoux', 'epouse', 'statut', 'regime.contrat', 'entite']);

    $pdf = Pdf::loadView('mariages.certificat', compact('mariage'))
        ->setPaper('a4', 'landscape');

    return $pdf->download('certificat-mariage-'.$mariage->id.'.pdf');
}

public function verify(Mariage $mariage)
{
    $mariage->load(['epoux', 'epouse', 'statut', 'entite']);

    return view('mariages.verify', compact('mariage'));
}
 public function changeStatut(Mariage $mariage, $statut_id)
    {
        $statut = StatutMariage::findOrFail($statut_id);
        $mariage->update(['statut_id' => $statut->id]);

        // Si le mariage est dissous ou annulé, changer l'état civil des époux
        if (in_array($statut->nom, ['dissous', 'annulé'])) {
            changeEtatCivil($mariage->epoux_id, 'célibataire');
            changeEtatCivil($mariage->epouse_id, 'célibataire');
        }

        return redirect()->route('mariages.show', $mariage)->with('success', 'Statut du mariage mis à jour.');
    }
    
    
}

function changeEtatCivil($personne_id, $etat_civil)
{
    $personne = Personne::findOrFail($personne_id);
    $personne->update(['etat_civil' => $etat_civil]);
}