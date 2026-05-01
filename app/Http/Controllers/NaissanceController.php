<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Naissance;
use App\Models\Personne;

class NaissanceController extends Controller
{   

    public function index()
    {
        $naissances = Naissance::with(['personne', 'user', 'entite'])
            ->where('entite_id', auth()->user()->entite_id)
            ->orderBy('created_at', 'desc')
            ->paginate  (10);

        return view('naissances.index', compact('naissances'));
    }
    public function show($id)
    {
        $naissance = Naissance::with(['personne', 'user', 'entite'])->findOrFail($id);
       

        return view('naissances.show', compact('naissance'));
    }

    public function create()
    {
        $personnes = Personne::orderBy('nom')->get();
        return view('naissances.create', compact('personnes'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'personne_id' => 'required|exists:personnes,id',
                'motif' => 'nullable|string|max:255',
                'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            ]);

            if ($request->hasFile('documents')) {
                $documentsPath = $request->file('documents')->store('documents', 'public');
                $request->merge(['documents' => $documentsPath]);
            }

            $request->merge([
                'user_id' => auth()->id(),
                'entite_id' => auth()->user()->entite_id,
            ]);

            Naissance::create($request->all());

            return redirect()->route('naissances.index')->with('success', 'Naissance créée avec succès.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $naissance = Naissance::where('entite_id', auth()->user()->entite_id)->findOrFail($id);
        $personnes = Personne::orderBy('nom')->get();
        return view('naissances.edit', compact('naissance', 'personnes'));
    }

    public function update(Request $request, $id)
    {
        try {
            $naissance = Naissance::where('entite_id', auth()->user()->entite_id)->findOrFail($id);

            $request->validate([
                'personne_id' => 'required|exists:personnes,id',
                'motif' => 'nullable|string|max:255',
                'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            ]);

            if ($request->hasFile('documents')) {
                $documentsPath = $request->file('documents')->store('documents', 'public');
                $request->merge(['documents' => $documentsPath]);
            }

            $naissance->update($request->all());

            return redirect()->route('naissances.index')->with('success', 'Naissance mise à jour avec succès.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $naissance = Naissance::where('entite_id', auth()->user()->entite_id)->findOrFail($id);
            $naissance->delete();

            return redirect()->route('naissances.index')->with('success', 'Naissance supprimée avec succès.');
        } catch (\Exception $e) {
           
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
      

    public function attestation($id)
    {
        $naissance = Naissance::with(['personne', 'entite'])->find($id);
        
        if (!$naissance) {
            return back()->with('error', 'Attestation introuvable');
        }

      return view('naissances.attestation', compact('naissance'));
      } 

        public function verify(Naissance $naissance)
    {
        
        return view('naissances.verify', compact('naissance'));
    }

    

}
