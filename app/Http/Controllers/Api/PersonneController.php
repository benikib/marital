<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personnes = Personne::with(['contrat', 'role', 'statut'])->paginate(15);
        return response()->json($personnes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $personne = Personne::find($id);

        if (! $personne) {
            return response()->json(['message' => 'Personne non trouvée'], 404);
        }

        return response()->json([
            'id' => $personne->id,
            'nom' => $personne->nom,
            'prenom' => $personne->prenom,
            'postnom' => $personne->postnom,
            'sexe' => $personne->sexe,
            'date_naissance' => $personne->date_naissance ? $personne->date_naissance->format('d/m/Y') : null,
            'lieu_naissance' => $personne->lieu_naissance,
            'adresse' => $personne->adresse,
            'pere' => $personne->pere,
            'mere' => $personne->mere,
            'profession' => $personne->profession,
            'nationalite' => $personne->nationalite,
            'statut_vie' => $personne->statut_vie,
            'etat_civil' => $personne->etat_civil,
            'cin' => $personne->cin,
            'telephone' => $personne->telephone,
            'photo' => $personne->photo ? asset($personne->photo) : null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
