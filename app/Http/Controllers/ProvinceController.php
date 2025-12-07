<?php

namespace App\Http\Controllers;

use App\Models\province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::paginate(10);
        return view('admins.provinces.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255|unique:provinces,nom',
            ]);
            Province::create($request->all());
            return redirect()->back()->with('success', 'Province créée avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de la province.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, province $province)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255|unique:provinces,nom,' . $province->id,
            ]);
            $province->update($request->all());
            return redirect()->back()->with('success', 'Province modifiée avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la modification de la province.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(province $province)
    {
        try {
            $province->delete();
            return redirect()->back()->with('success', 'Province supprimée avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de la province.');
        }
    }
}
