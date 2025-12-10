<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Epoux;
use App\Models\Mariage;
use App\Models\Status;
use Illuminate\Http\Request;

class EpouxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = \App\Models\province::all();
        $communes = \App\Models\commune::all();
        $epoux = Epoux::all();
        $mariages = Mariage::all();
        // $mariage = Mariage::find(1);
        // dd($mariage->epoux);

        return view('formulaires.index', compact('epoux', 'communes', 'provinces', 'mariages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = \App\Models\province::all();
        $communes = \App\Models\commune::all();
        $epoux = Epoux::all();
        $status = Status::all();
        $contrats = contrat::all();
        return view('formulaires.create', compact('epoux', 'communes', 'provinces', 'status', 'contrats'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Epoux $epoux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Epoux $epoux)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Epoux $epoux)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Epoux $epoux)
    {
        //
    }
}
