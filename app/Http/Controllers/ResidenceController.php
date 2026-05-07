<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residence;
use App\Models\Personne;
use App\Models\User;
use App\Models\EntiteAdministrative;

class ResidenceController extends Controller
{
    public function index(Request $request)
    {
        $personnes = Personne::orderBy('nom')->get();

        $baseQuery = Residence::where('entite_id', auth()->user()->entite_id)->with('personne');
        $query = (clone $baseQuery)->orderBy('created_at', 'desc');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('personne', function ($qPersonne) use ($search) {
                    $qPersonne->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('postnom', 'like', "%{$search}%");
                })->orWhere('soussignataire', 'like', "%{$search}%");
            });
        }

        $stats = [
            'total' => (clone $baseQuery)->count(),
            'filtered' => (clone $query)->count(),
        ];

        $residences = $query->paginate(15)->withQueryString();
        return view('residences.index', compact('residences', 'personnes', 'stats'));
    }

    public function create()
    {
        $personnes = Personne::orderBy('nom')->get();
        
        return view('residences.create', compact('personnes'));
    }

    public function store(Request $request)
{
    try {
        $data = $request->validate([
            'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'soussignataire' => 'nullable|string|max:255',
            'personne_id' => 'required|exists:personnes,id',
        ]);

        // Upload fichier
        if ($request->hasFile('documents')) {
            $data['documents'] = $request->file('documents')
                ->store('documents', 'public');
        }

        // Ajouter infos système
        $data['user_id'] = auth()->id();
        $data['entite_id'] = auth()->user()->entite_id;

        // Enregistrement
        Residence::create($data);

        return redirect()
            ->route('residences.index')
            ->with('success', 'Attestation de résidence créée avec succès.');

    } catch (\Exception $e) {

        // (optionnel) log erreur
        \Log::error($e->getMessage());

        return back()->withErrors([
            'error' => 'Une erreur est survenue lors de la création.'
        ]);
    }
}
    public function show(Residence $residence)
    {
        
        return view('residences.show', compact('residence'));
    }

     public function verify(Residence $residence)
    {
        return view('residences.verify', compact('residence'));
    }

    public function edit(Residence $residence)
    {
        $personnes = Personne::orderBy('nom')->get();
        
        return view('residences.edit', compact('residence', 'personnes'));
    }

    public function update(Request $request, Residence $residence)
    {
        try {
            $request->validate([
                'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                'soussignataire' => 'nullable|string|max:255',
                'personne_id' => 'required|exists:personnes,id',
            ]);

            if ($request->hasFile('documents')) {
                $documentsPath = $request->file('documents')->store('documents', 'public');
                $request->merge(['documents' => $documentsPath]);
            }

            $request->merge([
                'user_id' => auth()->id(),
                'entite_id' => auth()->user()->entite_id,
            ]);

            $residence->update($request->all());

            return redirect()->route('residences.index')->with('success', 'Attestation de résidence mise à jour avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour de l\'attestation de résidence.']);
        }


    }

    public function destroy(Residence $residence)
    {
        try {
            $residence->delete();
            return redirect()->route('residences.index')->with('success', 'Attestation de résidence supprimée avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la suppression de l\'attestation de résidence.']);
        }
    }

    public function attestation(Residence $residence)
    {
        return view('residences.attestation', compact('residence'));
    }

    public function pdf(Residence $residence)
    {
        $pdf = \PDF::loadView('residences.attestation', compact('residence'));
        return $pdf->download('attestation_residence_' . $residence->id . '.pdf');
    }

    
}
