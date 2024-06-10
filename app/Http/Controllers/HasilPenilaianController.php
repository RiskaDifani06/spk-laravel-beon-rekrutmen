<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternativeValues;
use App\Models\HasilPenilaian;
use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Http\Request;

class HasilPenilaianController extends Controller
{
  public function index()
  {
    $hasil_penilaian = HasilPenilaian::join('alternatif', 'hasil_penilaian.alternatif_id', '=', 'alternatif.id')
      ->join('roles', 'alternatif.role_id', '=', 'roles.id')
      ->groupBy('user_id', 'alternatif.role_id', 'roles.name')
      ->get(['user_id', 'alternatif.role_id', 'roles.name']);

    return view('ranking.index', compact('hasil_penilaian'));
  }

  public function show($id)
  {
    $user_penilai = User::find($id);
    $hasil_penilaian = HasilPenilaian::where('user_id', $id)->get();

    return view('ranking.show', compact('hasil_penilaian', 'user_penilai'));
  }

  public function menghitung_utility($role_id)
  {
    $totalSubKriteria = SubKriteria::where('role_id', $role_id)->count();
    $alternatif_ids = Alternatif::where('role_id', $role_id)->pluck('id'); // Renamed variable to avoid conflict

    $minValues = [];
    $maxValues = [];
    $utilityValues = collect();  // Use a collection for object-like structure

    foreach ($alternatif_ids as $alternatif_id) { // Changed to foreach loop to use actual IDs
      $minValues[$alternatif_id] = AlternativeValues::where('alternatif_id', $alternatif_id)->min('value');
      $maxValues[$alternatif_id] = AlternativeValues::where('alternatif_id', $alternatif_id)->max('value');

      $utilityValuesForAlternatif = [];
      $nilaiAlternatif = AlternativeValues::where('alternatif_id', $alternatif_id)->pluck('value');

      // Check if $nilaiAlternatif is not empty
      if ($nilaiAlternatif->isEmpty()) {
        continue;
      }

      for ($j = 1; $j <= $totalSubKriteria; $j++) {
        // Check if the index exists in $nilaiAlternatif
        if (isset($nilaiAlternatif[$j - 1])) {
          $utilityValuesForAlternatif[$j] = ($nilaiAlternatif[$j - 1] - $minValues[$alternatif_id]) / ($maxValues[$alternatif_id] - $minValues[$alternatif_id]);
        } else {
          // Handle the case where the index does not exist
          $utilityValuesForAlternatif[$j] = 0; // or some default value
        }
      }

      $utilityValues->put($alternatif_id, $utilityValuesForAlternatif);
    }

    return $utilityValues;
  }
  public function nilai_akhir($role_id)
  {
    $utilityValues = $this->menghitung_utility($role_id);
    $totalAlternatif = Alternatif::where('role_id', $role_id)->count();
    $totalSubKriteria = SubKriteria::where('role_id', $role_id)->count();
    $bobotSubKriteria = SubKriteria::where('role_id', $role_id)->pluck('bobot');
    $normalisasiBobot = [];

    for ($i = 1; $i <= $totalSubKriteria; $i++) {
      $normalisasiBobot[$i] = $bobotSubKriteria[$i - 1] / $bobotSubKriteria->sum();
    }

    $nilaiAkhir = [];

    for ($i = 1; $i <= $totalAlternatif; $i++) {
      for ($j = 1; $j <= $totalSubKriteria; $j++) {
        if (isset($utilityValues[$i][$j])) {
          $nilaiAkhir[$i][$j] = $utilityValues[$i][$j] * ($normalisasiBobot[$j]);
        } else {
          // Handle the case where the utility value does not exist
          $nilaiAkhir[$i][$j] = 0; // or some default value
        }
      }
    }

    return $nilaiAkhir;
  }

  public function ranking($role_id)
  {
    $nilaiAkhir = $this->nilai_akhir($role_id);
    $current_user = auth()->user();
    $totalAlternatif = Alternatif::count();
    $totalSubKriteria = SubKriteria::count();

    $hasilAkhir = [];
    for ($i = 1; $i <= $totalAlternatif; $i++) {
      for ($j = 1; $j <= $totalSubKriteria; $j++) {
        // sum of all nilaiAkhir[$i]
        $hasilAkhir[$i] = array_sum($nilaiAkhir[$i]);
      }
    }
    arsort($hasilAkhir, SORT_NUMERIC);

    HasilPenilaian::where('user_id', $current_user->id)->delete();
    $rank = 1;
    foreach ($hasilAkhir as $alternatif_id => $hasil_penilaian) {
      HasilPenilaian::create([
        'alternatif_id' => $alternatif_id,
        'user_id' => $current_user->id,
        'hasil_penilaian' => $hasil_penilaian,
        'rank' => $rank
      ]);
      $rank++;
    }

    return $hasilAkhir;
  }
}
