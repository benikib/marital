<?php

namespace App\Http\Controllers;

use App\Models\EntiteAdministrative;
use Illuminate\Http\Request;

class EntiteAdministrativeController extends Controller
{
    public function index()
    {
        $entites = EntiteAdministrative::with('parent')->orderBy('nom')->paginate(15);

        return view('entites.index', compact('entites'));
    }

    public function create()
    {
        $parents = EntiteAdministrative::orderBy('nom')->get();

        return view('entites.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:entite_administratives,id',
        ]);

        EntiteAdministrative::create($request->all());

        return redirect()->route('entites.index')->with('success', 'Entité créée avec succès.');
    }

    public function edit(EntiteAdministrative $entite)
    {
        $parents = EntiteAdministrative::where('id', '!=', $entite->id)->orderBy('nom')->get();

        return view('entites.edit', compact('entite', 'parents'));
    }

    public function update(Request $request, EntiteAdministrative $entite)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:entite_administratives,id',
        ]);

        $entite->update($request->all());

        return redirect()->route('entites.index')->with('success', 'Entité mise à jour.');
    }

    public function destroy(EntiteAdministrative $entite)
    {
        $entite->delete();

        return redirect()->route('entites.index')->with('success', 'Entité supprimée.');
    }
}
