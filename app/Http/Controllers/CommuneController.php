<?php

namespace App\Http\Controllers;

use App\Models\commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communes = Commune::paginate(10);
        $provinces = \App\Models\province::all();


        return view('admins.communes.index', compact('communes', 'provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255|unique:communes,nom',
                'province_id' => 'required|exists:provinces,id',
            ]);
            Commune::create($request->all());
            return redirect()->back()->with('success', 'Commune créée avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de la commune.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(commune $commune)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(commune $commune)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, commune $commune)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255|unique:communes,nom,' . $commune->id,
                'province_id' => 'required|exists:provinces,id',
            ]);
            $commune->update($request->all());
            return redirect()->back()->with('success', 'Commune modifiée avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la modification de la commune.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(commune $commune)
    {
        try {
            $commune->delete();
            return redirect()->back()->with('success', 'Commune supprimée avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de la commune.');
        }
    }
}
