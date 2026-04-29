<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inhumation;
use App\Models\Personne;


class InhumationController extends Controller
{
    public function index()
    {
        $inhumations = Inhumation::with('personne')->latest()->paginate(10);
        return view('inhumations.index', compact('inhumations'));
    }
    public function create()
    {
        $personnes = Personne::all();
        return view('inhumations.create', compact('personnes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'soussignataire' => 'required|string|max:255',
            'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'date_inhumation' => 'required|date',
            'lieu_inhumation' => 'required|string|max:255',
             
            'personne_id' => 'required|exists:personnes,id',
        ]);

        if ($request->hasFile('documents')) {
            $request->merge(['documents' => $request->file('documents')->store('inhumation_docs', 'public')]);
        }

       

        $request->merge([
            'user_id' => auth()->id(),
            'entite_id' => auth()->user()->entite_id,
        ]);

        Inhumation::create($request->all());

        return redirect()->route('inhumations.index')->with('success', 'Inhumation créée avec succès.');
    }
    public function show($id)
    {
        $inhumation = Inhumation::with('personne', 'user', 'entite')->findOrFail($id);
        return view('inhumations.show', compact('inhumation'));
    }

    public function edit(Inhumation $inhumation)
    {
        $personnes = Personne::all();
        return view('inhumations.edit', compact('inhumation', 'personnes'));
    }

    public function update(Request $request, Inhumation $inhumation)
    {
        $request->validate([
            'soussignataire' => 'required|string|max:255',
            'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'date_inhumation' => 'required|date',
            'lieu_inhumation' => 'required|string|max:255',
             
            'personne_id' => 'required|exists:personnes,id',
        ]);

        if ($request->hasFile('documents')) {
            $request->merge(['documents' => $request->file('documents')->store('inhumation_docs', 'public')]);
        }

        $inhumation->update($request->all());

        return redirect()->route('inhumations.index')->with('success', 'Inhumation mise à jour avec succès.');
    }
    
     public function destroy(Inhumation $inhumation)
    {
        if ($inhumation->documents) {
            Storage::disk('public')->delete($inhumation->documents);
        }
        $inhumation->delete();
        return redirect()->route('inhumations.index')->with('success', 'Inhumation supprimée avec succès.');
    }

        public function verify(Inhumation $inhumation)
        {
            return view('inhumations.verify', compact('inhumation'));
        }

        public function print(Inhumation $inhumation)
        {
            return view('inhumations.print', compact('inhumation'));
        }

        public function attestation(Inhumation $inhumation)
        {
            return view('inhumations.attestation', compact('inhumation'));
        }

}
