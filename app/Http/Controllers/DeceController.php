<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dece;
use App\Models\Personne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


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
            
        
          try {
                $validatedData =  $request->validate([
                'soussignataire' => 'required|string|max:255',
                'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'personne_id' => 'required|exists:personnes,id',
            ]);
             //change les status de la personne à décédé
            $personne = Personne::find($validatedData['personne_id']);
            // $personne->statut_vie = 'décédé';
            // $personne->save();

              if ($personne->etat_civil == 'marié') {
                $mariage = DB::table('mariages')
                    ->where(function ($query) use ($personne) {
                        $query->where('epoux_id', $personne->id)
                              ->orWhere('epouse_id', $personne->id);
                    })
                    ->where('statut_id', 1) // statut_id 1 pour les mariages actifs
                    ->first();
                    

               
                if ($mariage) {
                    if ($mariage->epoux_id == $personne->id) {
                        DB::table('personnes')->where('id', $mariage->epouse_id)->update(['etat_civil' => 'veuf']);
                    } else {
                        DB::table('personnes')->where('id', $mariage->epoux_id)->update(['etat_civil' => 'veuf']);
                    }
                }
              } 

            if ($request->hasFile('documents')) {
                $validatedData['documents'] = $request->file('documents')->store('dece_docs', 'public');
            }

            $validatedData['user_id'] = auth()->id();
            $validatedData['entite_id'] = auth()->user()->entite_id;
            $validatedData['num_acte'] = 'DEC-' . strtoupper(uniqid()) . '-' . date('Y');

            Dece::create($validatedData);
            //change les status de la personne à décédé
            $personne = Personne::find($validatedData['personne_id']);
            $personne->statut_vie = 'décédé';
            $personne->save();

            // change etat civile de l'epoux ou de l'epouse dans le cas ou la personne décédée est marié
          
            
                   


            return redirect()->route('deces.index')->with('success', 'Décès créé avec succès.');

                
            } catch (\Exception $e) {

            dd($e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la création du décès.');
            }
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
