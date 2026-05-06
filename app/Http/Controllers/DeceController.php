<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dece;
use App\Models\Personne;
use Illuminate\Support\Facades\Storage;


class DeceController extends Controller
{
        public function index(Request $request)
        {
            $query = Dece::with('personne')->latest();

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
                'total' => Dece::count(),
                'filtered' => (clone $query)->count(),
            ];

            $deces = $query->paginate(10)->withQueryString();
            return view('deces.index', compact('deces', 'stats'));
        }
    
        public function create()
        {
            $personnes = Personne::all();
            return view('deces.create', compact('personnes'));
        }
    
        public function show(Dece $dece)
        {
            return view('deces.show', compact('dece'));
        }

        public function store(Request $request)
        {
           $validatedData =  $request->validate([
                'soussignataire' => 'required|string|max:255',
                'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'personne_id' => 'required|exists:personnes,id',
            ]);

            if ($request->hasFile('documents')) {
                $validatedData['documents'] = $request->file('documents')->store('dece_docs', 'public');
            }

            $validatedData['user_id'] = auth()->id();
            $validatedData['entite_id'] = auth()->user()->entite_id;

            Dece::create($validatedData);

            return redirect()->route('deces.index')->with('success', 'Décès créé avec succès.');
        }

            public function edit(Dece $dece)
            {
                $personnes = Personne::all();
                return view('deces.edit', compact('dece', 'personnes'));
            }
    
            public function update(Request $request, Dece $dece)
            {
                $validatedData = $request->validate([
                    'soussignataire' => 'required|string|max:255',
                    'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'personne_id' => 'required|exists:personnes,id',
                ]);
    
                if ($request->hasFile('documents')) {
                    if ($dece->documents) {
                        Storage::disk('public')->delete($dece->documents);
                    }
                    $validatedData['documents'] = $request->file('documents')->store('dece_docs', 'public');
                }
    
                $dece->update($validatedData);
    
                return redirect()->route('deces.index')->with('success', 'Décès mis à jour avec succès.');
            }

        public function destroy(Dece $dece)
        {
            try {
                $dece->delete();
                return redirect()->route('deces.index')->with('success', 'Décès supprimé avec succès.');
            } catch (\Exception $e) {
                return redirect()->route('deces.index')->with('error', 'Une erreur est survenue lors de la suppression du décès.');
            }
        
        
        }

        public function attestation(Dece $dece)
        {
            return view('deces.attestation', compact('dece'));
        }

        public function pdf(Dece $dece)
        {
            // Générer le PDF à partir de la vue attestation
            $pdf = \PDF::loadView('deces.attestation', compact('dece'));
    
            // Télécharger le PDF
            return $pdf->download('attestation_dece.pdf');
        }

        public function verify(Dece $dece)
        {
            return view('deces.verify', compact('dece'));
        }
    


}
