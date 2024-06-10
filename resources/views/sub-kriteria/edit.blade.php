@extends('layouts.admin')

@section('main-content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ __('Sub Kriteria') }}</h1>

  @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-12">

      <!-- Sub Kriteria form -->
      <div class="card mb-4 shadow">
        <div class="card-header">
          <h2 class="h4 font-weight-bold text-primary m-0">Ubah Sub Kriteria</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('sub-kriteria.update', $subKriteria->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group @error('kriteria_id')
                has-error
              @enderror">
              <label for="kriteria_id">Nama Kriteria</label>
              <select required name="kriteria_id" id="kriteria_id" class="form-control">
                <option value="">Pilih Kriteria</option>
                @foreach ($kriteria as $k)
                  <option value="{{ $k->id }}" {{ $subKriteria->kriteria_id == $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                  </option>
                @endforeach
              </select>
              @error('kriteria_id')
                <div class="text-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group @error('nama')
                has-error
              @enderror">
              <label for="nama">Nama Sub Kriteria</label>
              <input required type="text" name="nama" id="nama" class="form-control"
                value="{{ $subKriteria->nama }}">
              @error('nama')
                <div class="text-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group @error('bobot')
                has-error
              @enderror">
              <label for="bobot">Bobot</label>
              <input required type="number" step="any" name="bobot" id="bobot" class="form-control"
                value="{{ $subKriteria->bobot }}">
              @error('bobot')
                <div class="text-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group @error('role_id')
                has-error
              @enderror">
              <label for="role_id">Role</label>
              <select required name="role_id" id="role_id" class="form-control">
                <option value="">Pilih Role</option>
                @foreach ($roles as $role)
                  <option value="{{ $role->id }}" {{ $subKriteria->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                  </option>
                @endforeach
              </select>
              @error('role_id')
                <div class="text-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group @error('tipe')
                has-error
              @enderror">
              <label for="tipe">Tipe</label>
              <select required name="tipe" id="tipe" class="form-control">
                <option value="">Pilih Tipe</option>
                <option value="cost" {{ $subKriteria->tipe == 'cost' ? 'selected' : '' }}>Cost</option>
                <option value="benefit" {{ $subKriteria->tipe == 'benefit' ? 'selected' : '' }}>Benefit
                </option>
              </select>
              @error('tipe')
                <div class="text-danger mt-2">
                  {{ $message }}
                </div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            <a href="{{ route('sub-kriteria.index') }}" class="btn btn-secondary mt-3">Batal</a>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection
