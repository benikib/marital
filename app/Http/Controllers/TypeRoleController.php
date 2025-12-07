<?php

namespace App\Http\Controllers;

use App\Models\typeRole;
use Illuminate\Http\Request;

class TypeRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeRoles = typeRole::all();
        return view('admins.typeRoles.index', compact('typeRoles'));
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
        $request->validate([
            'nom' => 'required|string|max:255|unique:type_roles,nom',
        ]);

        typeRole::create([
            'nom' => $request->input('nom'),
        ]);

        return redirect()->route('typeRoles.index')->with('success', 'Type de rôle créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(typeRole $typeRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(typeRole $typeRole)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, typeRole $typeRole)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:type_roles,nom,' . $typeRole->id,
        ]);

        $typeRole->update([
            'nom' => $request->input('nom'),
        ]);

        return redirect()->route('typeRoles.index')->with('success', 'Type de rôle mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(typeRole $typeRole)
    {
        if ($typeRole->users()->count() > 0) {
            return redirect()->route('typeRoles.index')->with('error', 'Impossible de supprimer ce type de rôle car il est associé à des utilisateurs.');
        }

        $typeRole->delete();
        return redirect()->route('typeRoles.index')->with('success', 'Type de rôle supprimé avec succès.');
    }
}
