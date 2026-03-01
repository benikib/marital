<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Mariage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RapportController extends Controller
{
    public function mensuel()
    {
        $entite = auth()->user()->entite;
        $mois = request('mois', Carbon::now()->month);
        $annee = request('annee', Carbon::now()->year);
        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->when($entite, function ($q) use ($entite) { return $q->where('entite_id', $entite->id); })
            ->whereMonth('date_mariage', $mois)
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        return view('agents.rapports.mensuel', compact('mariages', 'total', 'parStatus', 'mois', 'annee'));
    }

    public function annuel()
    {
        $entite = auth()->user()->entite;
        $annee = request('annee', Carbon::now()->year);
        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->when($entite, function ($q) use ($entite) { return $q->where('entite_id', $entite->id); })
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parMois = $mariages->groupBy(function ($mariage) {
            return Carbon::parse($mariage->date_mariage)->format('m');
        })->map(function ($group) {
            return $group->count();
        });

        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        return view('agents.rapports.annuel', compact('mariages', 'total', 'parMois', 'parStatus', 'annee'));
    }

    public function exportMensuel()
    {
        $entite = auth()->user()->entite;
        $mois = request('mois', Carbon::now()->month);
        $annee = request('annee', Carbon::now()->year);
        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->when($entite, function ($q) use ($entite) { return $q->where('entite_id', $entite->id); })
            ->whereMonth('date_mariage', $mois)
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        $pdf = PDF::loadView('agents.rapports.export-mensuel', compact('mariages', 'total', 'parStatus', 'mois', 'annee', 'entite'));
        return $pdf->download('rapport-mensuel-' . ($entite?->nom ?? 'entite') . '-' . $mois . '-' . $annee . '.pdf');
    }

    public function exportAnnuel()
    {
        $entite = auth()->user()->entite;
        $annee = request('annee', Carbon::now()->year);
        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->when($entite, function ($q) use ($entite) { return $q->where('entite_id', $entite->id); })
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parMois = $mariages->groupBy(function ($mariage) {
            return Carbon::parse($mariage->date_mariage)->format('m');
        })->map(function ($group) {
            return $group->count();
        });

        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        $pdf = PDF::loadView('agents.rapports.export-annuel', compact('mariages', 'total', 'parMois', 'parStatus', 'annee', 'entite'));
        return $pdf->download('rapport-annuel-' . ($entite?->nom ?? 'entite') . '-' . $annee . '.pdf');
    }
}
