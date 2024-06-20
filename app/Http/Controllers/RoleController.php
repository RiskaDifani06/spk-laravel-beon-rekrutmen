<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $roles = Role::whereNull('deleted_at')->paginate(10);
    $title = 'Delete Role!';
    $text = 'Apakah anda yakin ingin menghapus data ini?';
    confirmDelete($title, $text, 'role.destroy');
    return view('role.index', compact('roles'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('role.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
      ]);

      if ($validator->fails()) {
        Alert::error('Gagal', $validator->errors()->first());
        return redirect()->back()->withInput();
      }

      Role::create($request->all());

      Alert::success('Berhasil', 'Data berhasil disimpan');
      return redirect()->route('role.index');
    } catch (\Throwable $th) {
      Alert::error('Gagal', $th->getMessage());
      return redirect()->back()->withInput();
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Role $role)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Role $role)
  {
    return view('role.edit', compact('role'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Role $role)
  {
    try {
      $validator = Validator::make($request->all(), [
        'name' => 'required',
      ]);

      if ($validator->fails()) {
        Alert::error('Gagal', $validator->errors()->first());
        return redirect()->back()->withInput();
      }

      $role->update($request->all());

      Alert::success('Berhasil', 'Data berhasil diubah');
      return redirect()->route('role.index');
    } catch (\Throwable $th) {
      Alert::error('Gagal', $th->getMessage());
      return redirect()->back()->withInput();
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Role $role)
  {
    try {
      $role->update(['deleted_at' =>now()]);
      Alert::success('Berhasil', 'Data berhasil dihapus');
      return redirect()->route('role.index');
    } catch (\Throwable $th) {
      Alert::error('Gagal', $th->getMessage());
      return redirect()->route('role.index');
    }
  }

  public function restore($id)
{
    try {
        $role = Role::withTrashed()->findOrFail($id);
        $role->restore();

        Alert::success('Berhasil', 'Data berhasil dikembalikan');
        return redirect()->route('role.index');
    } catch (\Throwable $th) {
        Alert::error('Gagal', $th->getMessage());
        return redirect()->back();
    }
}

}


