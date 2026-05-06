<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Celibat;
use Illuminate\Support\Facades\Storage;
use App\Models\Personne;

class CelibatController extends Controller
{
    public function index(Request $request)
    {
        $query = Celibat::with('personne', 'user', 'entite')->orderBy('created_at', 'desc');

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
            'total' => Celibat::count(),
            'filtered' => (clone $query)->count(),
        ];

        $celibats = $query->paginate(10)->withQueryString();
        return view('celibats.index', compact('celibats', 'stats'));
    }

     public function show(Celibat $celibat)
    {
        return view('celibats.show', compact('celibat'));
    }

     public function create()
    {
        $personnes = Personne::orderBy('nom')->get();
        

        return view('celibats.create', compact('personnes'));
    }

     public function store(Request $request)
    {
        
        try {
         $validatedData = $request->validate([
            'soussignataire' => 'required|string|max:255',
            
            'personne_id' => 'required|exists:personnes,id',
           
        ]);

         $validatedData['user_id'] = auth()->id();
         $validatedData['entite_id'] = auth()->user()->entite_id;
        
        if ($request->hasFile('documents')) {
            $validatedData['documents'] = $request->file('documents')->store('celibat_docs', 'public');
        }
        


        Celibat::create($validatedData);

        return redirect()->route('celibats.index')->with('success', 'Celibat créé avec succès.');
        } catch (\Exception $e) {
            
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la création du celibat.']);
        }
    }

     public function edit(Celibat $celibat)
    {
        $personnes = Personne::orderBy('nom')->get();
        return view('celibats.edit', compact('celibat', 'personnes'));
    }

     public function update(Request $request, Celibat $celibat)
    {
        $validatedData = $request->validate([
            'soussignataire' => 'required|string|max:255',
            'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'personne_id' => 'required|exists:personnes,id',
        ]);

    $validatedData['user_id'] = auth()->id();
    $validatedData['entite_id'] = auth()->user()->entite_id;

        if ($request->hasFile('documents')) {
            if ($celibat->documents) {
                Storage::disk('public')->delete($celibat->documents);
            }
            $validatedData['documents'] = $request->file('documents')->store('celibat_docs', 'public');
        }

        $celibat->update($validatedData);

        return redirect()->route('celibats.index')->with('success', 'Celibat mis à jour avec succès.');
    }

     public function destroy(Celibat $celibat)
    {
        if ($celibat->documents) {
            Storage::disk('public')->delete($celibat->documents);
        }
        $celibat->delete();
        return redirect()->route('celibats.index')->with('success', 'Celibat supprimé avec succès.');
    }  

    public function verify(Celibat $celibat)
    {
        return view('celibats.verify', compact('celibat'));
    }

    public function print(Celibat $celibat)
    {
        return view('celibats.print', compact('celibat'));
    }

    public function attestation(Celibat $celibat)
    {
        return view('celibats.attestation', compact('celibat'));
    }
}
