<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    public function index()
    {
        $personnes = Personne::orderBy('nom')->paginate(15);

        return view('personnes.index', compact('personnes'));
    }

    public function create()
    {
        return view('personnes.create');
    }

    public function store(Request $request)
    {
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


        Personne::create($request->all());

        return redirect()->route('personnes.index')->with('success', 'Personne créée avec succès.');
    }

    public function edit(Personne $personne)
    {
        return view('personnes.edit', compact('personne'));
    }

    public function update(Request $request, Personne $personne)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'nationalite' => 'required|string|max:255',
            'photo' => 'nullable|string|max:255',
        ]);

        $personne->update($request->all());

        return redirect()->route('personnes.index')->with('success', 'Personne mise à jour.');
    }

    public function destroy(Personne $personne)
    {
        $personne->delete();

        return redirect()->route('personnes.index')->with('success', 'Personne supprimée.');
    }
}
