<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternativeValues;
use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $users = User::count();
    $totalAlternatif = Alternatif::count();
    $totalKriteria = Kriteria::count();
    $alternativesWithoutValue = AlternativeValues::whereDoesntHave('alternatif')->count();
    $widget = [
      'users' => $users,
      'totalAlternatif' => $totalAlternatif,
      'totalKriteria' => $totalKriteria,
      'alternativesWithoutValue' => $alternativesWithoutValue,
    ];

    return view('home', compact('widget'));
  }
}
