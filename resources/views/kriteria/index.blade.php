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

      <!-- Kriteria table -->
      <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="m-0 h4 font-weight-bold text-primary">Data Kriteria</h2>
          @if (Auth::user()->role == 'admin')
            <a href="{{ route('kriteria.create') }}" class="btn btn-primary">Tambah Kriteria</a>
          @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="alternatifTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kriteria</th>
                  <th>Bobot</th>
                  @if (Auth::user()->role == 'admin')
                    <th>Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($kriteria as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->bobot }}</td>
                    @if (Auth::user()->role == 'admin')
                      <td>
                        <a href="{{ route('kriteria.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('kriteria.destroy', $item->id) }}" class="btn btn-danger"
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
                {{ $kriteria->firstItem() }}
                to
                {{ $kriteria->lastItem() }}
                of
                {{ $kriteria->total() }}
                entries
              </span>
              <ul class="pagination">
                {{ $kriteria->links() }}
              </ul>
            </nav>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
