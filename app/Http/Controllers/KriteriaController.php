<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $kriteria = Kriteria::query()->paginate(10);
    $title = 'Delete Kriteria!';
    $text = 'Apakah anda yakin ingin menghapus data ini?';
    confirmDelete($title, $text, 'kriteria.destroy');
    return view('kriteria.index', compact('kriteria'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $sum = Kriteria::sum('bobot');
    return view('kriteria.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'bobot' => 'required'
      ]);

      if ($validator->fails()) {
        Alert::error('Gagal', 'Data gagal disimpan');
        return redirect()->back()->withErrors($validator)->withInput();
      }
      Kriteria::create($request->all());
      $sum = Kriteria::sum('bobot');
      if ($sum < 100) {
        Alert::warning('Perhatian', 'Total bobot kriteria kurang dari 100');
      } elseif ($sum > 100) {
        Alert::error('Perhatian', 'Total bobot kriteria melebihi 100');
        Kriteria::latest()->first()->delete();
      } else {
        Alert::success('Berhasil', 'Data berhasil disimpan');
      }
      return redirect()->route('kriteria.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Kriteria $kriteria)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Kriteria $kriteria)
  {
    return view('kriteria.edit', compact('kriteria'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Kriteria $kriteria)
  {
    try {
      $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'bobot' => 'required'
      ]);

      if ($validator->fails()) {
        Alert::error('Gagal', 'Data gagal disimpan');
        return redirect()->back()->withErrors($validator)->withInput();
      }
      $kriteria->update($request->all());
      $sum = Kriteria::sum('bobot');
      if ($sum < 100) {
        Alert::warning('Perhatian', 'Total bobot kriteria kurang dari 100');
      } elseif ($sum > 100) {
        Alert::error('Perhatian', 'Total bobot kriteria melebihi 100');
        $kriteria->update($request->except('bobot'));
      } else {
        Alert::success('Berhasil', 'Data berhasil diubah');
      }
      return redirect()->route('kriteria.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Kriteria $kriteria)
  {
    $kriteria->delete();
    alert()->success('Berhasil', 'Data berhasil dihapus');
    return back();
  }
}
