<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Role;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SubKriteriaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $kriteria = Kriteria::all();
    $roles = Role::all();
    $role = $request->query('role', null);
    $subKriteria = SubKriteria::query()->with('kriteria', 'role')->when($role, function ($query) use ($role) {
      return $query->where('role_id', $role);
    })->paginate(10);

    $title = 'Delete Sub Kriteria!';
    $text = 'Apakah anda yakin ingin menghapus data ini?';
    confirmDelete($title, $text, 'sub-kriteria.destroy');

    return view('sub-kriteria.index', compact('subKriteria', 'kriteria', 'roles'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $kriteria = Kriteria::all();
    $roles = Role::all();

    return view('sub-kriteria.create', compact('kriteria', 'roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'kriteria_id' => 'required',
      'nama' => 'required',
      'bobot' => 'required',
      'tipe' => 'required',
      'role_id' => 'required',
    ]);

    if ($validator->fails()) {
      Alert::error('Gagal', $validator->errors()->first());
      return redirect()->back()->withInput();
    }

    try {
      SubKriteria::create($request->all());
      Alert::success('Berhasil', 'Data berhasil disimpan');
      return redirect()->route('sub-kriteria.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(SubKriteria $subKriteria)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(SubKriteria $subKriteria)
  {
    $kriteria = Kriteria::all();
    $roles = Role::all();

    return view('sub-kriteria.edit', compact('subKriteria', 'kriteria', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, SubKriteria $subKriteria)
  {
    $validator = Validator::make($request->all(), [
      'kriteria_id' => 'required',
      'nama' => 'required',
      'bobot' => 'required',
      'tipe' => 'required',
      'role_id' => 'required',
    ]);

    if ($validator->fails()) {
      Alert::error('Gagal', $validator->errors()->first());
      return redirect()->back()->withInput();
    }

    try {
      $subKriteria->update($request->all());
      Alert::success('Berhasil', 'Data berhasil diubah');
      return redirect()->route('sub-kriteria.index');
    } catch (\Exception $e) {
      return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(SubKriteria $subKriteria)
  {
    try {
      $subKriteria->delete();
      Alert::success('Berhasil', 'Data berhasil dihapus');
      return back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function getByRole(Request $request)
  {
    $role = $request->role_id;
    $subKriteria = SubKriteria::where('role_id', $role)->with('kriteria')->get();

    return response()->json($subKriteria);
  }
}
