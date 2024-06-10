@extends('layouts.admin')

@section('main-content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ __('Kriteria') }}</h1>

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

      <!-- Kriteria form -->
      <div class="card mb-4 shadow">
        <div class="card-header">
          <h2 class="h4 font-weight-bold text-primary m-0">Ubah Kriteria</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group @error('nama') is-invalid @enderror">
              <label for="nama">Nama Kriteria</label>
              <input required type="text" class="form-control" id="nama" name="nama"
                value="{{ $kriteria->nama }}" placeholder="Masukkan Nama Kriteria">
              @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group @error('bobot') is-invalid @enderror">
              <label for="bobot">Bobot</label>
              <input required type="text" class="form-control" id="bobot" name="bobot"
                value="{{ $kriteria->bobot }}" placeholder="Masukkan Bobot Kriteria">
              @error('bobot')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            <a href="{{ route('kriteria.index') }}" class="btn btn-secondary mt-3">Batal</a>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection
