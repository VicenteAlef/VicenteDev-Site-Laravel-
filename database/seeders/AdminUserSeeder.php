<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
  public function run(): void
  {
    // Usa updateOrCreate para não duplicar caso você rode o seeder duas vezes
    User::updateOrCreate(
      ['email' => 'ildealef@outlook.com'], // Defina seu email real aqui
      [
        'name' => 'Vicente (Root)',
        'password' => Hash::make('Leffdev@2025'), // Mude antes de subir para produção
        'role' => 'root',
        'is_active' => true,
      ]
    );
  }
}
