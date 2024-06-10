<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternativeValues;
use App\Models\HasilPenilaian;
use App\Models\SubKriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AlternativeValuesController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $semuaAlternatif = Alternatif::with('role')->get();
    $semuaSubKriteria = SubKriteria::all();
    $semuaUser = User::all();
    $semuaNilaiAlternatif = AlternativeValues::query()->select('user_id', 'alternatif_id')->distinct()->simplePaginate(10);
    $title = 'Delete Nilai Alternatif!';
    $text = 'Apakah anda yakin ingin menghapus data ini?';
    confirmDelete($title, $text, 'penilaian.destroy');
    return view('penilaian.index', compact('semuaAlternatif', 'semuaSubKriteria', 'semuaNilaiAlternatif', 'semuaUser'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(Request $request)
  {
    $alternatif_id = $request->query('alternatif');
    $userId = auth()->user()->id;
    if (!$alternatif_id) {
      Alert::error('Gagal', 'Alternatif tidak ditemukan');
      return redirect()->route('penilaian.index');
    }
    $semuaAlternatif = Alternatif::where('id', $alternatif_id)->get();
    $role_id = Alternatif::where('id', $alternatif_id)->first()->role_id;
    $semuaSubKriteria = SubKriteria::where('role_id', $role_id)->get();
    return view('penilaian.create', compact('semuaAlternatif', 'semuaSubKriteria'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      $data = [
        'user_id' => $request->user_id,
        'alternatif_id' => $request->alternatif_id,
      ];
      $role_id = Alternatif::where('id', $request->alternatif_id)->first()->role_id;

      foreach ($request->input('value') as $subKriteriaId => $value) {
        $data['subkriteria_id'] = $subKriteriaId;
        $data['value'] = $value;
        $validator = Validator::make($data, [
          'user_id' => 'required|exists:users,id',
          'alternatif_id' => 'required|exists:alternatif,id',
          'subkriteria_id' => 'required|exists:sub_kriteria,id',
          'value' => 'required|numeric',
        ]);

        if ($validator->fails()) {
          Alert::error('Gagal', $validator->errors()->first());
          return redirect()->back()->withInput()->withErrors($validator);
        }

        if (empty($value)) {
          $value = 0;
        }

        AlternativeValues::create($data);
      }
      Alert::success('Berhasil', 'Data berhasil disimpan');
      app(HasilPenilaianController::class)->ranking($role_id);
      return redirect()->route('penilaian.index');
    } catch (\Exception $e) {
      Alert::error('Gagal', $e->getMessage());
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show($user_id, $alternatif_id)
  {
    $semuaAlternatif = Alternatif::with('role')->get();
    $role_id = Alternatif::where('id', $alternatif_id)->first()->role_id;
    $semuaSubKriteria = SubKriteria::where('role_id', $role_id)->get();
    $semuaUser = User::all();
    $alternativeValues = AlternativeValues::where('user_id', $user_id)
      ->where('alternatif_id', $alternatif_id)
      ->first();
    return view('penilaian.show', compact('alternativeValues', 'semuaAlternatif', 'semuaSubKriteria', 'semuaUser'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($user_id, $alternatif_id)
  {
    $current_user = auth()->user();
    if ($current_user->id != $user_id) {
      Alert::error('Gagal', 'Data tidak bisa diubah');
      return redirect()->route('penilaian.index');
    } else {
      $alternativeValues = AlternativeValues::where('user_id', $current_user->id)
        ->where('alternatif_id', $alternatif_id)->where('value', '!=', null)->get();
      $semuaAlternatif = Alternatif::all();
      $role_id = Alternatif::where('id', $alternatif_id)->first()->role_id;
      $semuaSubKriteria = SubKriteria::where('role_id', $role_id)->get();
      return view('penilaian.edit', compact('alternativeValues', 'semuaAlternatif', 'semuaSubKriteria'));
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    try {
      $role_id = Alternatif::where('id', $request->alternatif_id)->first()->role_id;

      foreach ($request->input('value') as $subKriteriaId => $value) {
        $data = [
          'user_id' => $request->user_id,
          'alternatif_id' => $request->alternatif_id,
          'subkriteria_id' => $subKriteriaId,
          'value' => $value,
        ];

        $validator = Validator::make($data, [
          'user_id' => 'required|exists:users,id',
          'alternatif_id' => 'required|exists:alternatif,id',
          'subkriteria_id' => 'required|exists:sub_kriteria,id',
          'value' => 'required|numeric',
        ]);

        if ($validator->fails()) {
          Alert::error('Gagal', $validator->errors()->first());
          return redirect()->back()->withInput()->withErrors($validator);
        }

        if (empty($value)) {
          $value = 0;
        }
        // Check if the record exists
        $alternativeValue = AlternativeValues::where('user_id', $request->user_id)
          ->where('alternatif_id', $request->alternatif_id)
          ->where('subkriteria_id', $subKriteriaId)
          ->first();

        if ($alternativeValue) {
          $alternativeValue->update($data);
        } else {
          AlternativeValues::create($data);
        }
      }

      Alert::success('Berhasil', 'Data berhasil diperbarui');
      app(HasilPenilaianController::class)->ranking($role_id);
      return redirect()->route('penilaian.index');
    } catch (\Exception $e) {
      Alert::error('Gagal', $e->getMessage());
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($user_id, $alternatif_id)
  {
    try {
      $current_user = auth()->user();
      if ($current_user->id != $user_id) {
        Alert::error('Gagal', 'Data tidak bisa dihapus');
        return redirect()->route('penilaian.index');
      }
      AlternativeValues::where('user_id', $current_user->id)->where('alternatif_id', $alternatif_id)->delete();
      HasilPenilaian::where('user_id', $current_user->id)->where('alternatif_id', $alternatif_id)->delete();
      Alert::success('Berhasil', 'Data berhasil dihapus');
      return redirect()->route('penilaian.index');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function checkExist(Request $request)
  {
    $alternatifId = $request->input('alternatif_id');
    $userId = $request->input('user_id');

    $exists = AlternativeValues::where('alternatif_id', $alternatifId)
      ->where('user_id', $userId)
      ->exists();

    return response()->json(['exists' => $exists]);
  }
}