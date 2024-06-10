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

      <!-- Sub Kriteria table -->
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="m-0 h4 font-weight-bold text-primary">Data Sub Kriteria</h2>
          @if (Auth::user()->role == 'admin')
            <a href="{{ route('sub-kriteria.create') }}" class="btn btn-primary">Tambah Sub Kriteria</a>
          @endif
        </div>
        <div class="card-header">
          <form class="d-flex gap-5 align-items-center" action="{{ route('sub-kriteria.index') }}" method="GET">
            <select name="role" id="role" class="form-control">
              <option value="">Pilih Role</option>
              @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ request()->get('role') == $role->id ? 'selected' : '' }}>
                  {{ $role->name }}
                </option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-primary ml-5 px-5">Filter</button>
          </form>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="subKriteriaTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kriteria</th>
                  <th>Nama Sub Kriteria</th>
                  <th>Role</th>
                  <th>Bobot</th>
                  <th>Tipe</th>
                  @if (Auth::user()->role == 'admin')
                    <th>Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($subKriteria as $key => $sub)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $sub->kriteria->nama }}</td>
                    <td>{{ $sub->nama }}</td>
                    <td>{{ $sub->role->name }}</td>
                    <td>{{ $sub->bobot }}</td>
                    <td class="text-uppercase">{{ $sub->tipe }}</td>
                    @if (Auth::user()->role == 'admin')
                      <td>
                        <a href="{{ route('sub-kriteria.edit', $sub->id) }}" class="btn btn-warning">
                          Edit
                        </a>
                        <a href="{{ route('sub-kriteria.destroy', $sub->id) }}" class="btn btn-danger"
                          data-confirm-delete="true">Delete</a>
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
            <nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
              <span>
                Showing
                {{ $subKriteria->firstItem() }}
                to
                {{ $subKriteria->lastItem() }}
                of
                {{ $subKriteria->total() }}
                entries
              </span>
              <ul class="pagination">
                {{ $subKriteria->links() }}
              </ul>
            </nav>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
