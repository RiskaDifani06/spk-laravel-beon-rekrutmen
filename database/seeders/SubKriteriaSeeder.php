<?php

namespace Database\Seeders;

use App\Models\SubKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKriteriaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Inti
    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Optimistic',
      'bobot' => 1.25,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Enthusiastic',
      'bobot' => 1.25,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Joyful',
      'bobot' => 1.25,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Embracing',
      'bobot' => 1.25,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Encourage',
      'bobot' => 1.25,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Respectful',
      'bobot' => 1.25,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Impartial',
      'bobot' => 1.25,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Empathetic',
      'bobot' => 1.25,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Knowledgeable',
      'bobot' => 1.5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Insightful',
      'bobot' => 1.5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Ingenious',
      'bobot' => 1.5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Open Minded',
      'bobot' => 1.5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Persistent',
      'bobot' => 1,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Ambitious',
      'bobot' => 1,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Bold',
      'bobot' => 1,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 1,
      'nama' => 'Influential',
      'bobot' => 1,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    // Pendukung

    SubKriteria::create([
      'kriteria_id' => 2,
      'nama' => 'Product Knowledge',
      'bobot' => 2.5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 2,
      'nama' => 'Bahasa Inggris',
      'bobot' => 2.5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    // Softskill

    SubKriteria::create([
      'kriteria_id' => 3,
      'nama' => 'Integritas',
      'bobot' => 1.667,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 3,
      'nama' => 'Komunikasi',
      'bobot' => 1.667,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 3,
      'nama' => 'CSO (Customer Service Orientation)',
      'bobot' => 1.667,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 3,
      'nama' => 'Concern for Order',
      'bobot' => 1.667,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 3,
      'nama' => 'Teamwork',
      'bobot' => 1.667,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 3,
      'nama' => 'Time Management',
      'bobot' => 1.667,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    // Hardskill

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'Panel Server',
      'bobot' => 12,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'CI/CD',
      'bobot' => 5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'Virtualization',
      'bobot' => 5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'Framework & CMS',
      'bobot' => 10,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'Manajemen Server',
      'bobot' => 5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'Teknologi Cloud',
      'bobot' => 10,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'Domain & Hosting',
      'bobot' => 10,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'Evaluasi Kinerja',
      'bobot' => 3,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);

    SubKriteria::create([
      'kriteria_id' => 4,
      'nama' => 'Administrasi dan Billing',
      'bobot' => 5,
      'tipe' => 'benefit',
      'role_id' => 1
    ]);
  }
}
