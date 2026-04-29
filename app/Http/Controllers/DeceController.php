<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dece;
use App\Models\Personne;
use Illuminate\Support\Facades\Storage;


class DeceController extends Controller
{
        public function index()
        {
            $deces = Dece::with('personne')->latest()->paginate(10);
            return view('deces.index', compact('deces'));
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
            $request->validate([
                'soussignataire' => 'required|string|max:255',
                'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'personne_id' => 'required|exists:personnes,id',
            ]);

            if ($request->hasFile('documents')) {
                $request->merge(['documents' => $request->file('documents')->store('dece_docs', 'public')]);
            }

            $request->merge([
                'user_id' => auth()->id(),
                'entite_id' => auth()->user()->entite_id,
            ]);

            Dece::create($request->all());

            return redirect()->route('deces.index')->with('success', 'Décès créé avec succès.');
        }

            public function edit(Dece $dece)
            {
                $personnes = Personne::all();
                return view('deces.edit', compact('dece', 'personnes'));
            }
    
            public function update(Request $request, Dece $dece)
            {
                $request->validate([
                    'soussignataire' => 'required|string|max:255',
                    'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                    'personne_id' => 'required|exists:personnes,id',
                ]);
    
                if ($request->hasFile('documents')) {
                    if ($dece->documents) {
                        Storage::disk('public')->delete($dece->documents);
                    }
                    $request->merge(['documents' => $request->file('documents')->store('dece_docs', 'public')]);
                }
    
                $dece->update($request->all());
    
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
