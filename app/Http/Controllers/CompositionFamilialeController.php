<?php

namespace App\Http\Controllers;

use App\Models\CompositionFamiliale;
use App\Models\EntiteAdministrative;
use App\Models\Mariage;
use App\Models\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompositionFamilialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compositions = CompositionFamiliale::with([
            'mariage',
            'personne',
            'enfants',
            'entite',
            'user'
        ])->latest()->paginate(10);

        return view('composition_familiales.index', compact('compositions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mariages = Mariage::with('epoux', 'epouse')->get();

        $personnes = Personne::orderBy('nom')->get();
        $entites = EntiteAdministrative::orderBy('nom')->get();

        return view('composition_familiales.create', compact(
            'mariages',
            'personnes',
            'entites'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'soussignataire' => ['required', 'string', 'max:255'],
                'mariage_id' => ['required', 'exists:mariages,id'],
            
            
                'documents' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                'enfants' => ['nullable', 'array'],
                'enfants.*' => ['exists:personnes,id'],
            ]);

            if ($request->hasFile('documents')) {
                $documentPath = $request->file('documents')->store('composition_familiales', 'public');
                $validated['documents'] = $documentPath;
            }

            $validated['user_id'] = Auth::id();
                $validated['entite_id'] = auth()->user()->entite_id;
    
                $validated['nombre_enfants'] = count($validated['enfants'] ?? []);
                 $validated['num_acte'] = 'COMP-' . strtoupper(uniqid()) . '-' . date('Y');
            

            $compositionFamiliale = CompositionFamiliale::create($validated);

            if (isset($validated['enfants'])) {
                $compositionFamiliale->enfants()->sync($validated['enfants']);
            }

            return redirect()
                ->route('composition_familiales.index')
                ->with('success', 'Composition familiale créée avec succès.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création de la composition familiale.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CompositionFamiliale $compositionFamiliale)
    {
        $compositionFamiliale->load([
            'mariage',
            'personne',
            'enfants',
            'entite',
            'user'
        ]);

        return view('composition_familiales.show', compact('compositionFamiliale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompositionFamiliale $compositionFamiliale)
    {
        $mariages = Mariage::with(['epoux', 'epouse'])->get();

        $personnes = Personne::orderBy('nom')->get();

        $entites = EntiteAdministrative::orderBy('nom')->get();

        $compositionFamiliale->load('enfants');

        return view('composition_familiales.edit', compact(
            'compositionFamiliale',
            'mariages',
            'personnes',
            'entites'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompositionFamiliale $compositionFamiliale)
    {
       try {
            $validated = $request->validate([
                'soussignataire' => ['required', 'string', 'max:255'],
                'mariage_id' => ['required', 'exists:mariages,id'],
                'documents' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
                'enfants' => ['nullable', 'array'],
                'enfants.*' => ['exists:personnes,id'],
            ]);

            if ($request->hasFile('documents')) {
                if ($compositionFamiliale->documents &&
                    Storage::disk('public')->exists($compositionFamiliale->documents)) {

                    Storage::disk('public')
                        ->delete($compositionFamiliale->documents);
                }

                $documentPath = $request->file('documents')->store('composition_familiales', 'public');
                $validated['documents'] = $documentPath;
            }

            $validated['nombre_enfants'] = count($validated['enfants'] ?? []);

            $compositionFamiliale->update($validated);

            if (isset($validated['enfants'])) {
                $compositionFamiliale->enfants()->sync($validated['enfants']);
            } else {
                $compositionFamiliale->enfants()->detach();
            }

            return redirect()
                ->route('composition_familiales.show', $compositionFamiliale)
                ->with('success', 'Composition familiale mise à jour avec succès.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour de la composition familiale.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompositionFamiliale $compositionFamiliale)
    {
        if ($compositionFamiliale->documents &&
            Storage::disk('public')->exists($compositionFamiliale->documents)) {

            Storage::disk('public')
                ->delete($compositionFamiliale->documents);
        }

        $compositionFamiliale->delete();

        return redirect()
            ->route('composition_familiales.index')
            ->with('success', 'Composition familiale supprimée avec succès.');
    }

    public function verify(CompositionFamiliale $compositionFamiliale)
    {
        return view('composition_familiales.verify', compact('compositionFamiliale'));
    }
    public function attestation(CompositionFamiliale $compositionFamiliale)
    {
        return view('composition_familiales.attestation', compact('compositionFamiliale'));
    }
}