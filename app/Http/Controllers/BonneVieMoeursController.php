<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BonneVieMoeurs;
use App\Models\Personne;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;

class BonneVieMoeursController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = BonneVieMoeurs::where('entite_id', auth()->user()->entite_id)->with('personne');
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

        $bonneviemoeurs = $query->paginate(15)->withQueryString();
        return view('bonneviemoeurs.index', compact('bonneviemoeurs', 'stats'));
    }

    public function show($id)
    {
        $bonneviemoeur = BonneVieMoeurs::where('entite_id', auth()->user()->entite_id)->with('personne')->findOrFail($id);
        return view('bonneviemoeurs.show', compact('bonneviemoeur'));
    }

        public function create()
        {
            $personnes = Personne::orderBy('nom')->get();
            return view('bonneviemoeurs.create', compact('personnes'));
        }

        public function store(Request $request)
        {
            try {
                $validated = $request->validate([
                    'personne_id' => 'required|exists:personnes,id',
                    
                    'soussignataire' => 'required|string|max:255',
                    'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                ]);
                if ($request->hasFile('documents')) {
                    $documentsPath = $request->file('documents')->store('documents', 'public');
                    $validated['documents'] = $documentsPath;
                }
                $validated['user_id'] = auth()->id();
                $validated['entite_id'] = auth()->user()->entite_id;
                $validated['num_acte'] = 'BVM-' . strtoupper(uniqid()) . '-' . date('Y');

                BonneVieMoeurs::create($validated);

                return redirect()->route('bonneviemoeurs.index')->with('success', 'Bonne Vie Moeurs créée avec succès.');
            } catch (\Exception $e) {
                dd($e->getMessage());
                return back()->withErrors(['error' => $e->getMessage()])->withInput();
            }
        }

        public function edit($id)
        {
            $bonneviemoeur = BonneVieMoeurs::where('entite_id', auth()->user()->entite_id)->findOrFail($id);
            $personnes = Personne::orderBy('nom')->get();
            return view('bonneviemoeurs.edit', compact('bonneviemoeur', 'personnes'));
        }

        public function update(Request $request, $id)
        {
            try {
                $bonneviemoeur = BonneVieMoeurs::where('entite_id', auth()->user()->entite_id)->findOrFail($id);

                $validated = $request->validate([
                    'personne_id' => 'required|exists:personnes,id',
                    'soussignataire' => 'required|string|max:255',
                    'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                ]);

                if ($request->hasFile('documents')) {
                    $documentsPath = $request->file('documents')->store('documents', 'public');
                    $validated['documents'] = $documentsPath;
                }

                $bonneviemoeur->update($validated);

                return redirect()->route('bonneviemoeurs.index')->with('success', 'Bonne Vie Moeurs mise à jour avec succès.');
            } catch (\Exception $e) {
                
                return back()->withErrors(['error' => $e->getMessage()])->withInput();
            }
        }

        public function destroy($id)
        {
            try {
                $bonneviemoeur = BonneVieMoeurs::where('entite_id', auth()->user()->entite_id)->findOrFail($id);
                $bonneviemoeur->delete();
                return redirect()->route('bonneviemoeurs.index')->with('success', 'Bonne Vie Moeurs supprimée avec succès.');
            } catch (\Exception $e) {
                
                return back()->withErrors(['error' => $e->getMessage()]);
            }
        }

    public function pdf($id)
    {
        $bonneviemoeur = BonneVieMoeurs::where('entite_id', auth()->user()->entite_id)->with('personne')->findOrFail($id);
        $pdf = FacadePdf::loadView('bonneviemoeurs.pdf', compact('bonneviemoeur'));
        return $pdf->download('bonne_viemoeurs_' . $bonneviemoeur->id . '.pdf');
    }
     public function attestation($id)
    {
        $bonneviemoeur = BonneVieMoeurs::where('entite_id', auth()->user()->entite_id)->with('personne')->findOrFail($id);
        return view('bonneviemoeurs.attestation', compact('bonneviemoeur'));
    }
    public function verify($id)
    {
        $bonneviemoeur = BonneVieMoeurs::with('personne')->findOrFail($id);
        
        return view('bonneviemoeurs.verify', compact('bonneviemoeur'));
    }
}
