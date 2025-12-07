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
        $commune = auth()->user()->commune;
        $mois = request('mois', Carbon::now()->month);
        $annee = request('annee', Carbon::now()->year);

        $mariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->where('commune_id', $commune->id)
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
        $commune = auth()->user()->commune;
        $annee = request('annee', Carbon::now()->year);

        $mariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->where('commune_id', $commune->id)
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
        $commune = auth()->user()->commune;
        $mois = request('mois', Carbon::now()->month);
        $annee = request('annee', Carbon::now()->year);

        $mariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->where('commune_id', $commune->id)
            ->whereMonth('date_mariage', $mois)
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        $pdf = PDF::loadView('agents.rapports.export-mensuel', compact('mariages', 'total', 'parStatus', 'mois', 'annee', 'commune'));
        return $pdf->download('rapport-mensuel-' . $commune->nom . '-' . $mois . '-' . $annee . '.pdf');
    }

    public function exportAnnuel()
    {
        $commune = auth()->user()->commune;
        $annee = request('annee', Carbon::now()->year);

        $mariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->where('commune_id', $commune->id)
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

        $pdf = PDF::loadView('agents.rapports.export-annuel', compact('mariages', 'total', 'parMois', 'parStatus', 'annee', 'commune'));
        return $pdf->download('rapport-annuel-' . $commune->nom . '-' . $annee . '.pdf');
    }
}
