<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    public function index()
    {
        $contrats = Contrat::orderBy('nom')->paginate(15);

        return view('contrats.index', compact('contrats'));
    }

    public function create()
    {
        return view('contrats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Contrat::create($request->all());

        return redirect()->route('contrats.index')->with('success', 'Contrat créé avec succès.');
    }

    public function edit(Contrat $contrat)
    {
        return view('contrats.edit', compact('contrat'));
    }

    public function update(Request $request, Contrat $contrat)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $contrat->update($request->all());

        return redirect()->route('contrats.index')->with('success', 'Contrat mis à jour.');
    }

    public function destroy(Contrat $contrat)
    {
        $contrat->delete();

        return redirect()->route('contrats.index')->with('success', 'Contrat supprimé.');
    }
}
