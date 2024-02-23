<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Elimina todos los registros existentes en la tabla antes de agregar nuevos datos
        User::truncate();

        User::create([
            'name' => 'admin', 
            'email' => 'admin@newspaper.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN'
        ]);
    }
}
