<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
public function run(): void
    {
        // Solo llamamos a nuestro seeder para crear el usuario necesario.
        $this->call([
            UserSeeder::class, // <-- ESTO es lo esencial.
        ]);
    }
    
}
