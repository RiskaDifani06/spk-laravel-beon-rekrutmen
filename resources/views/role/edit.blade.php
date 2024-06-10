@extends('layouts.admin')

@section('main-content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ __('Role') }}</h1>

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

      <!-- Role form -->
      <div class="card mb-4 shadow">
        <div class="card-header">
          <h2 class="h4 font-weight-bold text-primary m-0">Ubah Role</h2>
        </div>
        <div class="card-body">
          <form action="{{ route('role.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group @error('name') is-invalid @enderror">
              <label for="name">Nama Role</label>
              <input required type="text" class="form-control" id="name" name="name"
                value="{{ $role->name }}" placeholder="Masukkan Nama Role">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            <a href="{{ route('role.index') }}" class="btn btn-secondary mt-3">Batal</a>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection
