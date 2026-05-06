<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\EntiteAdministrative;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('role', 'entite')->orderBy('name');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('role', function ($qRole) use ($search) {
                        $qRole->where('nom', 'like', "%{$search}%");
                    })->orWhereHas('entite', function ($qEntite) use ($search) {
                        $qEntite->where('nom', 'like', "%{$search}%");
                    });
            });
        }

        $stats = [
            'total' => User::count(),
            'filtered' => (clone $query)->count(),
        ];

        $users = $query->paginate(15)->withQueryString();
        return view('users.index', compact('users', 'stats'));
    }

    public function create()
    {
        $roles = Role::orderBy('nom')->get();
        $entites = EntiteAdministrative::orderBy('nom')->get();

        return view('users.create', compact('roles', 'entites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            //'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'entite_id' => 'nullable|exists:entite_administratives,id',

        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'), // Mot de passe par défaut, à changer après la création
            'role_id' => $request->role_id,
            'entite_id' => $request->entite_id,
        ]);
            
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit($id)
    {
        $user = User::With('role')->With('entite')->findOrFail($id);
            $roles = Role::orderBy('nom')->get();
            $entites = EntiteAdministrative::orderBy('nom')->get();

        return view('users.edit', compact('user', 'roles', 'entites'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'entite_id' => 'nullable|exists:entite_administratives,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->entite_id = $request->entite_id;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
       
       

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
