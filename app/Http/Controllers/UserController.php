<?php

namespace App\Http\Controllers;

use App\Models\typeRole;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('typeRole')->latest();

        // Filtrage par type de rôle
        if ($request->has('type_role') && $request->type_role != '') {
            $query->whereHas('typeRole', function ($q) use ($request) {
                $q->where('id', $request->type_role);
            });
        }

        $users = $query->paginate(10);
        $typeRoles = typeRole::all();
        $communes = \App\Models\commune::all();

        return view('admins.users.index', compact('users', 'typeRoles','communes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Logic to show user creation form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'type_role_id' => 'required|exists:type_roles,id',
                'commune_id' => 'required|exists:communes,id',
            ]);

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'type_role_id' => $request->input('type_role_id'),
                'commune_id' => $request->input('commune_id'),
            ]);

            return redirect()->back()->with('success', 'Utilisateur créé avec succès.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de l\'utilisateur.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Logic to show a specific user
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Logic to show user edit form
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'type_role_id' => 'required|exists:type_roles,id',
                'commune_id' => 'required|exists:communes,id',
            ]);
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'type_role_id' => $request->input('type_role_id'),
                'commune_id' => $request->input('commune_id'),
            ]);
            return redirect()->back()->with('success', 'Utilisateur modifié avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la modification de l\'utilisateur.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Logic to delete a user
    }
    /**
     * Additional methods can be added here as needed.
     */
}
