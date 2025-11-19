<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Se crea el usuario con ID 1 que es obligatorio para tu tarea.
        User::create([
            'name' => 'Usuario Dummy',
            'email' => 'dummy@app.com',
            'password' => Hash::make('password'),
        ]);
    }
}