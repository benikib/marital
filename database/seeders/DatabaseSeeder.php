<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            CommuneSeeder::class,
            TypeRoleSeeder::class,
            UserSeeder::class,
            ContratSeeder::class,
            RegimeMatrimonialeSeeder::class,
            StatusSeeder::class,
            EpouxSeeder::class,
            EpouseSeeder::class,
            AyantDroitCoutinierSeeder::class,
            MariageSeeder::class,
        ]);
    }
}
