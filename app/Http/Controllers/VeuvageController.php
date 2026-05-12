<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Veuvage;
use App\Models\Personne;
use App\Models\User;
use App\Models\EntiteAdministrative;

class VeuvageController extends Controller
{
    public function index(Request $request)
    {
        $query = Veuvage::with('personne', 'user', 'entite')->orderBy('created_at', 'desc');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('personne', function ($qPersonne) use ($search) {
                    $qPersonne->where('nom', 'like', "%{$search}%")
                        ->orWhere('prenom', 'like', "%{$search}%")
                        ->orWhere('postnom', 'like', "%{$search}%");
                })->orWhereHas('entite', function ($qEntite) use ($search) {
                    $qEntite->where('nom', 'like', "%{$search}%")
                        ->orWhere('type', 'like', "%{$search}%");
                });
            });
        }

        $stats = [
            'total' => Veuvage::count(),
            'filtered' => (clone $query)->count(),
        ];

        $veuvages = $query->paginate(10)->withQueryString();
        return view('veuvages.index', compact('veuvages', 'stats'));
    }

    public function create()
    {
        $personnes = Personne::orderBy('nom')->get();
        $entites = EntiteAdministrative::all();
        return view('veuvages.create', compact('personnes', 'entites'));
    } 
    
    public function store(Request $request)
    {
        try {
            
            $validated = $request->validate([
                'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                'soussignataire' => 'nullable|string|max:255',
                'personne_id' => 'required|exists:personnes,id',
            ]);

            if ($request->hasFile('documents')) {
                $documentsPath = $request->file('documents')->store('documents', 'public');
                $validated['documents'] = $documentsPath;
            }
                $validated['entite_id'] = auth()->user()->entite_id;
                $validated['user_id'] = auth()->id();
            $validated['num_acte'] = 'VEU-' . strtoupper(uniqid()) . '-' . date('Y');

            Veuvage::create($validated);

            return redirect()->route('veuvages.index')->with('success', 'Veuvage créé avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la création du veuvage.']);
        }
    }

     public function show(Veuvage $veuvage)
    {
        return view('veuvages.show', compact('veuvage'));
    }

        public function edit(Veuvage $veuvage)
        {
            $personnes = Personne::orderBy('nom')->get();
            $entites = EntiteAdministrative::all();
            return view('veuvages.edit', compact('veuvage', 'personnes', 'entites'));
        }

        public function update(Request $request, Veuvage $veuvage)
        {
            try {
                $validated = $request->validate([
                    'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'soussignataire' => 'nullable|string|max:255',
                    'personne_id' => 'required|exists:personnes,id',
                ]);

                if ($request->hasFile('documents')) {
                    $documentsPath = $request->file('documents')->store('documents', 'public');
                    $validated['documents'] = $documentsPath;
                }
                    $validated['entite_id'] = auth()->user()->entite_id;
                    $validated['user_id'] = auth()->id();

            

                $veuvage->update($request->all());

                return redirect()->route('veuvages.index')->with('success', 'Veuvage mis à jour avec succès.');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour du veuvage.']);
            }
        }

         public function destroy(Veuvage $veuvage)
        {
            try {
                $veuvage->delete();
                return redirect()->route('veuvages.index')->with('success', 'Veuvage supprimé avec succès.');
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Une erreur est survenue lors de la suppression du veuvage.']);
            }
        }

            public function verify(Veuvage $veuvage)
    {
        return view('veuvages.verify', compact('veuvage'));
    }

    public function attestation(Veuvage $veuvage)
    {
        return view('veuvages.attestation', compact('veuvage'));
    }

     public function pdf(Veuvage $veuvage)
    {
        $pdf = \PDF::loadView('veuvages.attestation', compact('veuvage'));
        return $pdf->download('attestation_veuvage_' . $veuvage->id . '.pdf');
    }
    
}

