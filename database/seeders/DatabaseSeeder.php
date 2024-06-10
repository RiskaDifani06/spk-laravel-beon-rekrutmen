<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory(10)->create();

    User::factory()->create([
      'name' => 'Admin',
      'last_name' => 'SPK',
      'email' => 'admin@example.com',
      'email_verified_at' => now(),
      'password' => 'password',
      'role' => 'admin',
      'remember_token' => \Illuminate\Support\Str::random(10),
    ]);

    User::factory()->create([
      'name' => 'User',
      'last_name' => 'SPK',
      'email' => 'hr@example.com',
      'email_verified_at' => now(),
      'password' => 'password',
      'role' => 'hr',
      'remember_token' => \Illuminate\Support\Str::random(10),
    ]);

    $this->call([
      KriteriaSeeder::class,
      RoleSeeder::class,
      AlternatifSeeder::class,
      SubKriteriaSeeder::class,
      // AlternativesValueSeeder::class,
    ]);
  }
}
