<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\RegimeMatrimonial;
use Illuminate\Http\Request;

class RegimeMatrimonialController extends Controller
{
    public function index()
    {
        $regimes = RegimeMatrimonial::with('contrat')->orderBy('id')->paginate(15);

        return view('regimes.index', compact('regimes'));
    }

    public function create()
    {
        $contrats = Contrat::orderBy('nom')->get();

        return view('regimes.create', compact('contrats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dotation_coutumiere' => 'required|numeric|min:0',
            'contrat_id' => 'required|exists:contrats,id',
        ]);

        RegimeMatrimonial::create($request->all());

        return redirect()->route('regimes.index')->with('success', 'Régime matrimonial créé avec succès.');
    }

    public function edit(RegimeMatrimonial $regime)
    {
        $contrats = Contrat::orderBy('nom')->get();

        return view('regimes.edit', compact('regime', 'contrats'));
    }

    public function update(Request $request, RegimeMatrimonial $regime)
    {
        $request->validate([
            'dotation_coutumiere' => 'required|numeric|min:0',
            'contrat_id' => 'required|exists:contrats,id',
        ]);

        $regime->update($request->all());

        return redirect()->route('regimes.index')->with('success', 'Régime matrimonial mis à jour.');
    }

    public function destroy(RegimeMatrimonial $regime)
    {
        $regime->delete();

        return redirect()->route('regimes.index')->with('success', 'Régime matrimonial supprimé.');
    }
}
