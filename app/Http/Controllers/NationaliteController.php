<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Nationalite;
use App\Models\Personne;
use App\Models\User;
use App\Models\EntiteAdministrative;

class NationaliteController extends Controller
{
     public function index(Request $request)
    {
        $personnes = Personne::orderBy('nom')->get();

        $query = Nationalite::where('entite_id', auth()->user()->entite_id)->with('personne');

        // Recherche simple
        if ($search = $request->query('search')) {
            $query->whereHas('personne', function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('postnom', 'like', "%{$search}%");
            })->orWhere('residence', 'like', "%{$search}%");
        }

        // Recherche avancée - Personne ID
        if ($personne_id = $request->query('personne_id')) {
            $query->where('personne_id', $personne_id);
        }

        // Recherche avancée - Residence
        if ($residence = $request->query('residence')) {
            $query->where('residence', 'like', "%{$residence}%");
        }

        // Statistiques totales
        $totalNationalites = Nationalite::where('entite_id', auth()->user()->entite_id)->count();
        
        // Statistiques sur les résultats filtrés
        $resultatsFiltres = (clone $query)->count();

        $nationalites = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        $stats = [
            'total' => $totalNationalites,
            'resultats_filtres' => $resultatsFiltres,
        ];

        return view('nationalites.index', compact('nationalites', 'personnes', 'stats'));
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

        $validated = $request->validate([
            'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'quittance' => 'nullable|string',
            'soussignataire' => 'nullable|string|max:255',
            'personne_id' => 'required|exists:personnes,id',
            'residence' => 'required|string|max:255',
            'motif' => 'nullable|string',
            'nationalite_pere' => 'nullable|string|max:255',
            'nationalite_mere' => 'nullable|string|max:255',
        ]);

        // 📁 Gestion du fichier
        if ($request->hasFile('documents')) {
            $file = $request->file('documents');

            if ($file->isValid()) {
                $validated['documents'] = $file->store('documents', 'public');
            }
        }

        // 🔐 Données système
        $validated['user_id'] = auth()->id();
        $validated['entite_id'] = auth()->user()->entite_id;
        $validated['dont_cout'] = "SDZ 10 000,00";
        $validated['nationalite'] = "Congolaise";

        // 💾 Enregistrement
        Nationalite::create($validated);

        return redirect()->route('nationalites.index')
            ->with('success', 'Nationalité créée avec succès.');

    } catch (\Exception $e) {

        return back()
            ->withErrors(['error' => $e->getMessage()])
            ->withInput();
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
               $validated= $request->validate([
                    
                    'documents' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                    'quittance' => 'nullable|string',
                    'soussignataire' => 'nullable|string|max:255',
                    'personne_id' => 'required|exists:personnes,id',
                   
                    'residence' => 'required|string|max:255',

                    'nationalite_pere' => 'nullable|string|max:255',
                    'nationalite_mere' => 'nullable|string|max:255',
                ]);
                if ($request->hasFile('documents')) {
                    $file = $request->file('documents');

                    if ($file->isValid()) {
                        $validated['documents'] = $file->store('documents', 'public');
                    }
                }

                $validated['user_id'] = auth()->id();
                $validated['entite_id'] = auth()->user()->entite_id;    


                $nationalite->update($validated);

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
