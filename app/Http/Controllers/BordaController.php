<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Borda;
use App\Models\HasilPenilaian;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BordaController extends Controller
{
  public function index()
  {
    $this->calculateBorda();
    // sort borda by score
    $borda = Borda::join('alternatif', 'borda.alternatif_id', '=', 'alternatif.id')
      ->join('roles', 'alternatif.role_id', '=', 'roles.id')
      ->select('roles.name as role_name', 'roles.id as role_id')
      ->groupBy('roles.id', 'roles.name')->get();

    return view('borda.index', compact('borda'));
  }

  public function show($role_id)
  {
    $borda = Borda::join('alternatif', 'borda.alternatif_id', '=', 'alternatif.id')
      ->join('roles', 'alternatif.role_id', '=', 'roles.id')
      ->select('borda.*', 'alternatif.nama as alternatif_name', 'roles.name as role_name', 'roles.id as role_id')
      ->where('roles.id', $role_id)
      ->orderBy('score', 'desc')
      ->get();

    return view('borda.show', compact('borda'));
  }

  public function calculateBorda()
  {
    // Fetch all distinct roles
    $roles = Alternatif::distinct('role_id')->pluck('role_id');

    foreach ($roles as $roleId) {
      // Fetch all HasilPenilaian records for the current role
      $hasilPenilaian = HasilPenilaian::whereHas('alternatif', function ($query) use ($roleId) {
        $query->where('role_id', $roleId);
      })->get();

      $alternatifCount = Alternatif::where('role_id', $roleId)->count();
      $rankCount = HasilPenilaian::whereHas('alternatif', function ($query) use ($roleId) {
        $query->where('role_id', $roleId);
      })->whereNotNull('rank')->distinct()->count('rank');
      $weights = [];
      $bordaTemp = [];
      $score = [];

      // Set weights for ranks
      for ($i = 1; $i <= $alternatifCount; $i++) {
        $weights[$i] = $alternatifCount - $i;
      }

      // Initialize bordaTemp and calculate counts
      for ($i = 1; $i <= $alternatifCount; $i++) {
        for ($j = 1; $j <= $rankCount; $j++) {
          $alternatifId = Alternatif::where('role_id', $roleId)->skip($i - 1)->first()->id;
          if ($hasilPenilaian->where('alternatif_id', $alternatifId)->where('rank', $j)->count() > 0) {
            $bordaTemp[$i][$j] = $hasilPenilaian->where('alternatif_id', $alternatifId)->where('rank', $j)->count();
          } else {
            $bordaTemp[$i][$j] = 0;
          }
        }
      }

      // Calculate scores
      for ($i = 1; $i <= $alternatifCount; $i++) {
        $score[$i] = 0;
        for ($j = 1; $j <= $rankCount; $j++) {
          $score[$i] += $bordaTemp[$i][$j] * $weights[$j];
        }
      }

      // Update or create Borda records
      for ($i = 1; $i <= $alternatifCount; $i++) {
        $alternatifId = Alternatif::where('role_id', $roleId)->skip($i - 1)->first()->id;
        $borda = Borda::where('alternatif_id', $alternatifId)->first();
        if ($borda) {
          $borda->update([
            'score' => $score[$i],
          ]);
        } else {
          Borda::create([
            'alternatif_id' => $alternatifId,
            'score' => $score[$i],
          ]);
        }
      }
    }

    return redirect()->route('borda.index');
  }

  public function exportBorda($role_id)
  {
    $borda = Borda::join('alternatif', 'borda.alternatif_id', '=', 'alternatif.id')
      ->join('roles', 'alternatif.role_id', '=', 'roles.id')
      ->select('borda.*', 'alternatif.nama as alternatif_name', 'roles.name as role_name', 'roles.id as role_id')
      ->where('roles.id', $role_id)
      ->orderBy('score', 'desc')
      ->get();
    $pdf = FacadePdf::loadView('borda.export', compact('borda'));
    return $pdf->download('borda.pdf');
  }
}
