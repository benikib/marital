<?php

namespace Database\Seeders;

use App\Models\typeRole;
use Illuminate\Database\Seeder;

class TypeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des rôles de base
        $roles = [
            ['nom' => 'admin'],
            ['nom' => 'utilisateur'],
            ['nom' => 'modérateur'],
            ['nom' => 'éditeur'],
            ['nom' => 'agent'],
        ];

        foreach ($roles as $role) {
            TypeRole::create($role);
        }
    }
}
