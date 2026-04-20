<?php

namespace App\Http\Controllers;

use App\Models\StatutMariage;
use Illuminate\Http\Request;

class StatutMariageController extends Controller
{
    public function index()
    {
        $statuts = StatutMariage::orderBy('nom')->paginate(15);

        return view('statuts.index', compact('statuts'));
    }

    public function create()
    {
        return view('statuts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        StatutMariage::create($request->all());

        return redirect()->route('statuts.index')->with('success', 'Statut de mariage créé avec succès.');
    }

    public function edit(StatutMariage $statut)
    {
        return view('statuts.edit', compact('statut'));
    }

    public function update(Request $request, StatutMariage $statut)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $statut->update($request->all());

        return redirect()->route('statuts.index')->with('success', 'Statut de mariage mis à jour.');
    }

    public function destroy(StatutMariage $statut)
    {
        $statut->delete();

        return redirect()->route('statuts.index')->with('success', 'Statut de mariage supprimé.');
    }
}
