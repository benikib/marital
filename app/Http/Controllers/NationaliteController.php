<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Nationalite;
use App\Models\Personne;
use App\Models\User;
use App\Models\EntiteAdministrative;

class NationaliteController extends Controller
{
     public function  index ()
    {
    
    $personnes = Personne::orderBy('nom')->get();

    $nationalites = Nationalite::where('entite_id', auth()->user()->entite_id)->with('personne')->orderBy('created_at', 'desc')->paginate(15);
    return view('nationalites.index', compact('nationalites', 'personnes'));
    }

    public function create()
    {
        $personnes = Personne::orderBy('nom')->get();
        $entites = EntiteAdministrative::all();
        return view('nationalites.create', compact('personnes', 'entites'));
    }

    public function store(Request $request)
    {
        try {
            
            $request->validate([
    
                'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                'quittance' => 'nullable|string',
                'soussignataire' => 'nullable|string|max:255',
                'personne_id' => 'required|exists:personnes,id',
                
                'residence' => 'required|string|max:255',
                'motif' => 'nullable|string',
                'nationalite_pere' => 'nullable|string|max:255',
                'nationalite_mere' => 'nullable|string|max:255',
            ]);

            if ($request->hasFile('documents')) {
                $documentsPath = $request->file('documents')->store('documents', 'public');
                $request->merge(['documents' => $documentsPath]);
            }

            $request->merge([
                'user_id' => auth()->id(),
                'entite_id' => auth()->user()->entite_id,
                'dont_cout' => str_replace(',', '.', "SDZ ".number_format(10000, 2, ',', ' ')),
                'nationalite' => "Congolaise",
            ]);

            Nationalite::create($request->all());

            return redirect()->route('nationalites.index')->with('success', 'Nationalité créée avec succès.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

        public function edit(Nationalite $nationalite)
        {
            $personnes = Personne::orderBy('nom')->get();
            $entites = EntiteAdministrative::all();
            return view('nationalites.edit', compact('nationalite', 'personnes', 'entites'));
        }

        public function update(Request $request, Nationalite $nationalite)
        {
            try {
                $request->validate([
                    'dont_cout' => 'required|numeric',
                    'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'quittance' => 'nullable|string',
                    'soussignataire' => 'nullable|string|max:255',
                    'personne_id' => 'required|exists:personnes,id',
                    'nationalite' => 'required|string|max:255',
                    'residence' => 'required|string|max:255',

                    'nationalite_pere' => 'nullable|string|max:255',
                    'nationalite_mere' => 'nullable|string|max:255',
                ]);

                $request->merge([
                    'user_id' => auth()->id(),
                    'entite_id' => auth()->user()->entite_id,
                ]);

                $nationalite->update($request->all());

                return redirect()->route('nationalites.index')->with('success', 'Nationalité mise à jour avec succès.');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return back()->withErrors(['error' => $e->getMessage()])->withInput();
            }
        }

        public function destroy(Nationalite $nationalite)
        {
            try {
                $nationalite->delete();
                return redirect()->route('nationalites.index')->with('success', 'Nationalité supprimée avec succès.');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return back()->withErrors(['error' => $e->getMessage()]);
            }
        }

        public function show(Nationalite $nationalite)
        {
            return view('nationalites.show', compact('nationalite'));
        }

        public function attestation(Nationalite $nationalite)
        {
            return view('nationalites.attestation', compact('nationalite'));
        }

        public function attestationPdf(Nationalite $nationalite)
        {
            $pdf = \PDF::loadView('nationalites.attestation_pdf', compact('nationalite'));
            return $pdf->download('attestation_nationalite.pdf');
        }

        public function verify(Nationalite $nationalite)
        {
            // Logique de vérification de l'attestation
            // Par exemple, vérifier si le numéro d'attestation est valide, etc.

            return view('nationalites.verify', compact('nationalite'));
        }

   
}
