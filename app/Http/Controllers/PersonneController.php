<?php

namespace App\Http\Controllers;

use App\Models\EntiteAdministrative;
use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    public function index()
    {
        $entites = EntiteAdministrative::all();

        $personnes = Personne::orderBy('nom')->paginate(15);

        return view('personnes.index', compact('personnes','entites'));
    }

    public function create()

    {
        $entites = EntiteAdministrative::all();
        return view('personnes.create', compact('entites'));
    }

    public function store(Request $request)
    {
        try {
           $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'nationalite' => 'required|string|max:255',
            'photo' => 'nullable|image',
        ]);

        if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $request->merge(['photo' => $photoPath]);
            }
        $request->merge([
            'user_id' => auth()->id(),
            'entite_id' => auth()->user()->entite_id,
        ]);

        Personne::create($request->all());

        return redirect()->route('personnes.index')->with('success', 'Personne créée avec succès.');
            
        } catch (\Exception $e) {
            dd($e->getMessage());
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
            $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'sexe' => 'required|in:M,F',
                'date_naissance' => 'required|date',
                'lieu_naissance' => 'required|string|max:255',
                'adresse' => 'required|string|max:255',
                'profession' => 'nullable|string|max:255',
                'nationalite' => 'required|string|max:255',
                'photo' => 'nullable|image',
            ]);

            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('photos', 'public');
                $request->merge(['photo' => $photoPath]);
            }
            $request->merge([
                'user_id' => auth()->id(),
                'entite_id' => auth()->user()->entite_id,
            ]);

            $personne->update($request->all());

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
