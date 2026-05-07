<?php

namespace App\Http\Controllers;

use App\Models\StatutMariage;
use Illuminate\Http\Request;

class StatutMariageController extends Controller
{
    public function index(Request $request)
    {
        $query = StatutMariage::orderBy('nom');

        if ($search = $request->query('search')) {
            $query->where('nom', 'like', "%{$search}%");
        }

        $stats = [
            'total' => StatutMariage::count(),
            'filtered' => (clone $query)->count(),
        ];

        $statuts = $query->paginate(15)->withQueryString();
        return view('statuts.index', compact('statuts', 'stats'));
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
