<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Kriteria::create([
      'nama' => 'Inti',
      'bobot' => 20,
    ]);

    Kriteria::create([
      'nama' => 'Pendukung',
      'bobot' => 5,
    ]);

    Kriteria::create([
      'nama' => 'Softskill',
      'bobot' => 10,
    ]);

    Kriteria::create([
      'nama' => 'Hardskill',
      'bobot' => 65,
    ]);
  }
}
