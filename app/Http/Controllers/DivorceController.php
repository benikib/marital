<?php

namespace App\Http\Controllers;

use App\Models\Divorce;
use App\Models\Mariage;
use App\Models\EntiteAdministrative;
use App\Models\Personne;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DivorceController extends Controller
{
    public function index(Request $request)
    {
        $query = Divorce::with(['mariage.epoux', 'mariage.epouse', 'entite', 'user']);

        // 🔍 Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('mariage.epoux', function ($q2) use ($search) {
                    $q2->where('nom', 'like', "%$search%")
                       ->orWhere('prenom', 'like', "%$search%");
                })
                ->orWhereHas('mariage.epouse', function ($q2) use ($search) {
                    $q2->where('nom', 'like', "%$search%")
                       ->orWhere('prenom', 'like', "%$search%");
                })
                ->orWhere('num_acte', 'like', "%$search%")
                ->orWhere('numero_jugement', 'like', "%$search%");
            });
        }

        // 📅 Filtre par date
        if ($request->filled('date')) {
            $query->whereDate('date_divorce', $request->date);
        }

        $stats = [
            'total' => Divorce::count(),
            'filtered' => (clone $query)->count(),
        ];

        $divorces = $query->latest()->paginate(10)->withQueryString();

        return view('divorces.index', compact('divorces', 'stats'));
    }

    public function create(Request $request)
    {
        // Sélectionner seulement les mariages actifs (statut "en cours")
        $mariages = Mariage::with(['epoux', 'epouse', 'statut'])
            ->whereHas('statut', function ($query) {
                $query->where('nom', 'en cours');
            })
            ->orderBy('date_mariage', 'desc')
            ->get();

        $entites = EntiteAdministrative::orderBy('nom')->get();
        $selectedMariageId = $request->query('mariage_id');

        return view('divorces.create', compact('mariages', 'entites', 'selectedMariageId'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
            'mariage_id' => 'required|exists:mariages,id',
            
            'date_divorce' => 'required|date',
            'divorce_rendu' => 'required|string|max:255',
            'date_transcription' => 'nullable|date',
            'date_jugement' => 'nullable|date',
            'numero_jugement' => 'nullable|string|max:255',
            'mentions_complementaire' => 'nullable|string',
            'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'soussignataire' => 'required|string|max:255',
        ]);

        // Vérifier que le mariage est bien actif
        $mariage = Mariage::with('statut')->findOrFail($validated['mariage_id']);
        if ($mariage->statut->nom !== 'en cours') {
            return redirect()->back()->withInput()->with('error', 'Ce mariage n\'est pas actif.');
        }
        //change le statut de mariage à dissous
        $statutDissous = \App\Models\StatutMariage::where('nom', 'dissous')->first();
        if ($statutDissous) {
            $mariage->update(['statut_id' => $statutDissous->id]);
            //change l'état civil des époux à célibataire
            changeEtatCivil($mariage->epoux_id, 'célibataire');
            changeEtatCivil($mariage->epouse_id, 'célibataire');
        }

        // Upload du document si présent
        if ($request->hasFile('documents')) {
            $validated['documents'] = $request->file('documents')->store('divorce_docs', 'public');
        }

        // Générer le numéro d'acte automatiquement
        $validated['num_acte'] = 'DIV-' . date('Y') . '-' . str_pad(Divorce::count() + 1, 4, '0', STR_PAD_LEFT);
        $validated['entite_id'] = auth()->user()->entite_id;
        $validated['user_id'] = auth()->id();

        Divorce::create($validated);

        // Changer le statut du mariage à "dissous"
        $statutDissous = \App\Models\StatutMariage::where('nom', 'dissous')->first();
        if ($statutDissous) {
            $mariage->update(['statut_id' => $statutDissous->id]);
            // Changer l'état civil des époux
            changeEtatCivil($mariage->epoux_id, 'célibataire');
            changeEtatCivil($mariage->epouse_id, 'célibataire');
        }

        return redirect()->route('divorces.index')->with('success', 'Divorce créé avec succès.');
        } catch (\Throwable $th) {
            dd($request->all(), $th->getMessage());
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la création du divorce.');
        }
    }

    public function show(Divorce $divorce)
    {
        $divorce->load(['mariage.epoux', 'mariage.epouse', 'entite', 'user']);

        return view('divorces.show', compact('divorce'));
    }

    public function edit(Divorce $divorce)
    {
        $mariages = Mariage::with(['epoux', 'epouse', 'statut'])
            ->whereHas('statut', function ($query) {
                $query->where('nom', 'en cours');
            })
            ->orWhere('id', $divorce->mariage_id) // Inclure le mariage actuel même s'il n'est plus actif
            ->orderBy('date_mariage', 'desc')
            ->get();

        $entites = EntiteAdministrative::orderBy('nom')->get();

        return view('divorces.edit', compact('divorce', 'mariages', 'entites'));
    }

    public function update(Request $request, Divorce $divorce)
    {
        $validated = $request->validate([
            'mariage_id' => 'required|exists:mariages,id',
            'date_divorce' => 'required|date',
            'divorce_rendu' => 'required|string|max:255',
            'date_transcription' => 'nullable|date',
            'date_jugement' => 'nullable|date',
            'numero_jugement' => 'nullable|string|max:255',
            'mentions_complementaire' => 'nullable|string',
            'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'soussignataire' => 'required|string|max:255',
           
        ]);

        // Upload du document si présent
        if ($request->hasFile('documents')) {
            if ($divorce->documents) {
                \Storage::disk('public')->delete($divorce->documents);
            }
            $validated['documents'] = $request->file('documents')->store('divorce_docs', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['entite_id'] = $divorce->entite_id; // Conserver la même entité
        $validated['num_acte'] = $divorce->num_acte; // Conserver le même numéro d'acte

         // Si le mariage a été changé, vérifier le nouveau mariage
        if ($divorce->mariage_id != $validated['mariage_id']) {
            $mariage = Mariage::with('statut')->findOrFail($validated['mariage_id']);
            if ($mariage->statut->nom !== 'en cours') {
                return redirect()->back()->withInput()->with('error', 'Le mariage sélectionné n\'est pas actif.');
            }
        }

         // Changer le statut du mariage à "dissous"
        $statutDissous = \App\Models\StatutMariage::where('nom', 'dissous')->first();
        if ($statutDissous) {
            $mariage->update(['statut_id' => $statutDissous->id]);
            // Changer l'état civil des époux
            changeEtatCivil($mariage->epoux_id, 'célibataire');
            changeEtatCivil($mariage->epouse_id, 'célibataire');
        }



        $divorce->update($validated);

        return redirect()->route('divorces.index')->with('success', 'Divorce mis à jour avec succès.');
    }

    public function destroy(Divorce $divorce)
    {
        try {
            // Remettre le mariage en statut "en cours" si on supprime le divorce
            $statutEnCours = \App\Models\StatutMariage::where('nom', 'en cours')->first();
            if ($statutEnCours) {
                $divorce->mariage->update(['statut_id' => $statutEnCours->id]);
                // Remettre l'état civil des époux
                changeEtatCivil($divorce->mariage->epoux_id, 'marié');
                changeEtatCivil($divorce->mariage->epouse_id, 'marié');
            }

            if ($divorce->documents) {
                \Storage::disk('public')->delete($divorce->documents);
            }

            $divorce->delete();

            return redirect()->route('divorces.index')->with('success', 'Divorce supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('divorces.index')->with('error', 'Une erreur est survenue lors de la suppression du divorce.');
        }
    }

    public function attestation(Divorce $divorce)
    {
        $divorce->load(['mariage.epoux', 'mariage.epouse', 'entite']);

        return view('divorces.attestation', compact('divorce'));
    }

    public function pdf(Divorce $divorce)
    {
        $divorce->load(['mariage.epoux', 'mariage.epouse', 'entite']);

        $pdf = Pdf::loadView('divorces.attestation', compact('divorce'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('attestation-divorce-'.$divorce->num_acte.'.pdf');
    }

    public function verify(Divorce $divorce)
    {
        $divorce->load(['mariage.epoux', 'mariage.epouse', 'entite']);

        return view('divorces.verify', compact('divorce'));
    }

    public function getMariageDetails(Request $request)
    {
        
        \Log::info('getMariageDetails called', [
            'user_id' => auth()->id(),
            'request_data' => $request->all(),
            'headers' => $request->headers->all()
        ]);

        $mariageId = $request->query('id');

        if (!$mariageId) {
            return response()->json(['error' => 'ID du mariage requis'], 400);
        }

        $mariage = Mariage::with(['epoux', 'epouse', 'entite', 'regime', 'statut'])
            ->find($mariageId);

        if (!$mariage) {
            return response()->json(['error' => 'Mariage non trouvé'], 404);
        }

        return response()->json([
            'id' => $mariage->id,
            'epoux' => [
                'nom' => $mariage->epoux ? $mariage->epoux->nom : '-',
                'prenom' => $mariage->epoux ? $mariage->epoux->prenom : '',
                'full_name' => ($mariage->epoux ? $mariage->epoux->nom : '-') . ' ' . ($mariage->epoux ? $mariage->epoux->prenom : ''),
            ],
            'epouse' => [
                'nom' => $mariage->epouse ? $mariage->epouse->nom : '-',
                'prenom' => $mariage->epouse ? $mariage->epouse->prenom : '',
                'full_name' => ($mariage->epouse ? $mariage->epouse->nom : '-') . ' ' . ($mariage->epouse ? $mariage->epouse->prenom : ''),
            ],
            'date_mariage' => $mariage->date_mariage ? $mariage->date_mariage->format('d/m/Y') : 'N/A',
            'lieu_mariage' => $mariage->lieu_mariage ?? 'N/A',
            'regime' => $mariage->regime ? $mariage->regime->contrat->nom : 'N/A',
            'entite' => $mariage->entite ? $mariage->entite->nom : 'N/A',
            'statut' => $mariage->statut ? $mariage->statut->nom : 'N/A',
        ]);
    }

    
}

function changeEtatCivil($personne_id, $etat_civil)
{
    $personne = Personne::findOrFail($personne_id);
    $personne->update(['etat_civil' => $etat_civil]);
}