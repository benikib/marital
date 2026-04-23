<?php

namespace App\Http\Controllers;

use App\Models\Nationalite;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NationaliteVerificationController extends Controller
{
    /**
     * Vérifie l'authenticité d'une attestation de nationalité
     * Accessible via le QR code
     */
    public function verify(Request $request, $id)
    {
        $nationalite = Nationalite::with(['personne', 'entite', 'user'])->find($id);
        
        if (!$nationalite) {
            return view('nationalites.invalide', [
                'message' => 'Cette attestation est introuvable.',
                'code' => 'NOT_FOUND'
            ]);
        }
        
        // Vérifier si l'attestation est valide (moins de 3 mois par exemple)
        $dateDelivrance = $nationalite->created_at;
        $dateExpiration = $dateDelivrance->copy()->addMonths(3);
        $isExpired = now()->greaterThan($dateExpiration);
        $isValid = !$isExpired;
        
        // Générer un hash de vérification pour cette consultation
        $verificationHash = hash('sha256', $nationalite->id . $nationalite->numero_officiel . now()->timestamp);
        
        // Logger la vérification (optionnel)
        $this->logVerification($nationalite, $request);
        
        return view('nationalites.verify', compact(
            'nationalite', 
            'isValid', 
            'isExpired',
            'dateDelivrance',
            'dateExpiration',
            'verificationHash'
        ));
    }
    
    /**
     * Vérification par numéro officiel (alternative)
     */
    public function verifyByNumber(Request $request)
    {
        $request->validate([
            'numero_officiel' => 'required|string'
        ]);
        
        $nationalite = Nationalite::with(['personne', 'entite', 'user'])
            ->where('numero_officiel', $request->numero_officiel)
            ->first();
        
        if (!$nationalite) {
            return back()->with('error', 'Aucune attestation trouvée avec ce numéro.');
        }
        
        return redirect()->route('nationalites.verify', $nationalite->id);
    }
    
    /**
     * API de vérification pour les services externes
     */
    public function apiVerify(Request $request, $id)
    {
        $nationalite = Nationalite::with(['personne', 'entite'])->find($id);
        
        if (!$nationalite) {
            return response()->json([
                'success' => false,
                'message' => 'Attestation introuvable',
                'data' => null
            ], 404);
        }
        
        $isValid = now()->lessThan($nationalite->created_at->addMonths(3));
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $nationalite->id,
                'numero_officiel' => $nationalite->numero_officiel,
                'nom' => $nationalite->personne->nom,
                'prenom' => $nationalite->personne->prenom,
                'date_naissance' => $nationalite->personne->date_naissance,
                'date_delivrance' => $nationalite->created_at->format('Y-m-d'),
                'est_valide' => $isValid,
                'verifie_le' => now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
    
    /**
     * Page de formulaire de vérification par numéro
     */
    public function verificationForm()
    {
        return view('nationalites.verification.form');
    }
    
    /**
     * Logger les tentatives de vérification
     */
    private function logVerification($nationalite, $request)
    {
        // Optionnel : enregistrer dans une table de logs
        // VerificationLog::create([
        //     'nationalite_id' => $nationalite->id,
        //     'ip_address' => $request->ip(),
        //     'user_agent' => $request->userAgent(),
        //     'verified_at' => now()
        // ]);
    }
}