<?php

namespace App\Http\Controllers;

use App\Models\EntiteAdministrative;
use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    public function index(Request $request)
    {
        $entites = EntiteAdministrative::all();
        
        $query = Personne::orderBy('nom');

        // Recherche simple
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('sexe', 'like', "%{$search}%")
                    ->orWhere('lieu_naissance', 'like', "%{$search}%")
                    ->orWhere('date_naissance', 'like', "%{$search}%");
            });
        }

        // Recherche avancée - Sexe
        if ($sexe = $request->query('sexe')) {
            $query->where('sexe', $sexe);
        }

        // Recherche avancée - Lieu de naissance
        if ($lieu = $request->query('lieu')) {
            $query->where('lieu_naissance', 'like', "%{$lieu}%");
        }

        // Recherche avancée - Date de naissance (entre deux dates)
        if ($dateDebut = $request->query('date_debut')) {
            $query->where('date_naissance', '>=', $dateDebut);
        }
        if ($dateFin = $request->query('date_fin')) {
            $query->where('date_naissance', '<=', $dateFin);
        }

        // Statistiques totales (avant pagination)
        $totalPersonnes = Personne::count();
        $totalHommes = Personne::where('sexe', 'M')->count();
        $totalFemmes = Personne::where('sexe', 'F')->count();
        
        // Statistiques sur les résultats filtrés
        $resultatsFiltres = $query->count();
        $statsHommesFiltres = (clone $query)->where('sexe', 'M')->count();
        $statsFemmesFiltres = (clone $query)->where('sexe', 'F')->count();

        $personnes = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => $totalPersonnes,
            'hommes' => $totalHommes,
            'femmes' => $totalFemmes,
            'resultats_filtres' => $resultatsFiltres,
            'hommes_filtres' => $statsHommesFiltres,
            'femmes_filtres' => $statsFemmesFiltres,
        ];

        return view('personnes.index', compact('personnes', 'entites', 'stats'));
    }

    public function create()

    {
        $entites = EntiteAdministrative::all();
        return view('personnes.create', compact('entites'));
    }

    public function store(Request $request)
    {
        try {
         $valideted =  $request->validate([

            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'nationalite' => 'required|string|max:255',

            'photo' => 'nullable|image',
            'pere' => 'nullable|string|max:255',
            'mere' => 'nullable|string|max:255',
            'statut_vie' => 'required|in:en vie,décédé',
           
            'province_id' => 'required|exists:entite_administratives,id',
            'territoire_id' => 'nullable|exists:entite_administratives,id',
            'secteur_id' => 'nullable|exists:entite_administratives,id',
            'district_id' => 'nullable|exists:entite_administratives,id',
            'localite_id' => 'nullable|exists:entite_administratives,id',
            'ville_id' => 'nullable|exists:entite_administratives,id',
            'cin' => 'nullable|string|max:255|unique:personnes,cin',
            'telephone' => 'nullable|string|max:255',
           


        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $valideted['photo'] = $photoPath;
        }

         $valideted['user_id'] = auth()->id();
         $valideted['entite_id'] = auth()->user()->entite_id;
    
         Personne::create($valideted);
        

        return redirect()->route('personnes.index')->with('success', 'Personne créée avec succès.');
            
        } catch (\Exception $e) {
            
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit(Personne $personne)
    {
        $entites = EntiteAdministrative::all();
        return view('personnes.edit', compact('personne', 'entites'));
    }

    public function update(Request $request, Personne $personne)
    {
        try {
           $valideted= $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'postnom' => 'nullable|string|max:255',
                'sexe' => 'required|in:M,F',
                'date_naissance' => 'required|date',
                'lieu_naissance' => 'required|string|max:255',

                'adresse' => 'required|string|max:255',
                'pere' => 'nullable|string|max:255',
                'mere' => 'nullable|string|max:255',
                'profession' => 'nullable|string|max:255',
                'nationalite' => 'required|string|max:255',
                'photo' => 'nullable|image',
                'statut_vie' => 'required|in:en vie,décédé',
                
                'etat_civil' => 'required|string|max:255',
                'province_id' => 'required|exists:entite_administratives,id',
                'territoire_id' => 'nullable|exists:entite_administratives,id', 
                'secteur_id' => 'nullable|exists:entite_administratives,id',
                'district_id' => 'nullable|exists:entite_administratives,id',
                'localite_id' => 'nullable|exists:entite_administratives,id',
                'ville_id' => 'nullable|exists:entite_administratives,id',
                'cin' => 'nullable|string|max:255|unique:personnes,cin,' . $personne->id,
                'telephone' => 'nullable|string|max:255'


            ]);

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $valideted['photo'] = $photoPath;
            }
            $valideted['user_id'] = auth()->id();
            $valideted['entite_id'] = auth()->user()->entite_id;
            

            $personne->update($valideted );
             

            return redirect()->route('personnes.index')->with('success', 'Personne mise à jour avec succès.');
        } catch (\Exception $e) {
          
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
        
    }

    public function destroy(Personne $personne)
    {
        $personne->delete();

        return redirect()->route('personnes.index')->with('success', 'Personne supprimée.');
    }
}
