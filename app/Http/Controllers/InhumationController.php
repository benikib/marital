<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inhumation;
use App\Models\Personne;


class InhumationController extends Controller
{
    public function index(Request $request)
    {
        $query = Inhumation::with('personne')->latest();

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('personne', function ($qPersonne) use ($search) {
                    $qPersonne->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('postnom', 'like', "%{$search}%")
                        ->orWhere('lieu_naissance', 'like', "%{$search}%");
                })->orWhere('date_inhumation', 'like', "%{$search}%")
                  ->orWhere('lieu_inhumation', 'like', "%{$search}%")
                  ->orWhere('cimetiere', 'like', "%{$search}%");
            });
        }

        $stats = [
            'total' => Inhumation::count(),
            'filtered' => (clone $query)->count(),
        ];

        $inhumations = $query->paginate(10)->withQueryString();
        return view('inhumations.index', compact('inhumations', 'stats'));
    }
    public function create()
    {
        $personnes = Personne::all();
        return view('inhumations.create', compact('personnes'));
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'soussignataire' => 'required|string|max:255',
            'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'date_inhumation' => 'required|date',
            'lieu_inhumation' => 'required|string|max:255',
            'cimetiere' => 'required|string|max:255',
            'personne_id' => 'required|exists:personnes,id',
        ]);

        if ($request->hasFile('documents')) {
            $validated['documents'] = $request->file('documents')->store('inhumation_docs', 'public');
        }

       

        $validated['user_id'] = auth()->id();
        $validated['entite_id'] = auth()->user()->entite_id;

        Inhumation::create($validated);

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
        $validated = $request->validate([
            'soussignataire' => 'required|string|max:255',
            'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'date_inhumation' => 'required|date',
            'lieu_inhumation' => 'required|string|max:255',
             'cimetiere' => 'required|string|max:255',
            'personne_id' => 'required|exists:personnes,id',
        ]);

        if ($request->hasFile('documents')) {
            $validated['documents'] = $request->file('documents')->store('inhumation_docs', 'public');
        }

        $inhumation->update($validated);

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
