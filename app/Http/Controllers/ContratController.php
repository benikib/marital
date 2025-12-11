<?php

namespace App\Http\Controllers;

use App\Models\contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContratController extends Controller
{
    /**
     * Affiche la liste des contrats.
     */
    public function index()
    {
        $contrats = Contrat::latest()->paginate(10);
        return view('admins.contrats.index', compact('contrats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Enregistre un nouveau contrat.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_contrat' => 'required|string|max:255|unique:contrats,type_contrat',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Contrat::create($request->all());

        return redirect()->route('contrats.index')
            ->with('success', 'Contrat créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrat $contrat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrat $contrat)
    {
        //
    }

    /**
     * Met à jour un contrat.
     */
    public function update(Request $request, Contrat $contrat)
    {
        $validator = Validator::make($request->all(), [
            'type_contrat' => 'required|string|max:255|unique:contrats,type_contrat,' . $contrat->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contrat->update($request->all());

        return redirect()->route('contrats.index')
            ->with('success', 'Contrat mis à jour avec succès.');
    }

    /**
     * Supprime un contrat.
     */
    public function destroy(Contrat $contrat)
    {
        // Vérifier si le contrat est utilisé dans des régimes matrimoniaux
        if ($contrat->regimesMatrimoniaux()->count() > 0) {
            return redirect()->route('contrats.index')
                ->with('error', 'Impossible de supprimer ce contrat car il est utilisé dans des régimes matrimoniaux.');
        }

        $contrat->delete();

        return redirect()->route('contrats.index')
            ->with('success', 'Contrat supprimé avec succès.');
    }
}
