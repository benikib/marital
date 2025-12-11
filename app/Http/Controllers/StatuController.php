<?php

namespace App\Http\Controllers;

use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatuController extends Controller
{
    /**
     * Affiche la liste des statuts.
     */
    public function index()
    {
        $status = Status::latest()->paginate(10);
        return view('admins.status.index', compact('status'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('admins.status.create');
    }

    /**
     * Enregistre un nouveau statut.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255|unique:status,nom',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Status::create($request->all());

        return redirect()->route('status.index')
            ->with('success', 'Statut créé avec succès.');
    }

    /**
     * Affiche un statut spécifique.
     */
    public function show(Status $statu)
    {
        return view('admins.status.show', compact('statu'));
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit(Status $statu)
    {
        return view('admins.status.edit', compact('statu'));
    }

    /**
     * Met à jour un statut.
     */
    public function update(Request $request, Status $statu)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255|unique:status,nom,' . $statu->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $statu->update($request->all());

        return redirect()->route('status.index')
            ->with('success', 'Statut mis à jour avec succès.');
    }

    /**
     * Supprime un statut.
     */
    public function destroy(Status $statu)
    {
        // Vérifier si le statut est utilisé dans des mariages
        if ($statu->mariages()->count() > 0) {
            return redirect()->route('status.index')
                ->with('error', 'Impossible de supprimer ce statut car il est utilisé dans des mariages.');
        }

        $statu->delete();

        return redirect()->route('status.index')
            ->with('success', 'Statut supprimé avec succès.');
    }
}
