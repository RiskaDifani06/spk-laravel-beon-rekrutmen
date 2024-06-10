@extends('layouts.admin')

@section('main-content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ __('Perangkingan Borda') }}</h1>

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
    <div class="col-lg-12">
      <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="h4 font-weight-bold text-primary m-0">Hasil Ranking Metode Borda {{ $borda->first()->role_name }}
          </h2>
          <a href="{{ route('borda.export', $borda->first()->role_id) }}" class="btn btn-success">Export</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table-bordered table" id="subKriteriaTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Ranking</th>
                  <th>Nama Alternatif</th>
                  <th>Skor</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($borda as $b)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->alternatif_name }}</td>
                    <td>{{ number_format($b->score, 3) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
