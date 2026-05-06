<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $query = Role::orderBy('nom');

        if ($search = $request->query('search')) {
            $query->where('nom', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $stats = [
            'total' => Role::count(),
            'filtered' => (clone $query)->count(),
        ];

        $roles = $query->paginate(15)->withQueryString();
        return view('roles.index', compact('roles', 'stats'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Rôle créé avec succès.');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Rôle mis à jour.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rôle supprimé.');
    }
}
