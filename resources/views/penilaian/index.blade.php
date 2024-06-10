
@extends('layouts.admin')

@section('main-content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">{{ __('Penilaian') }}</h1>

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

      <!-- Penilaian table -->
      <div class="card mb-4 shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h2 class="h4 font-weight-bold text-primary m-0">Data Penilaian</h2>
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#alternatifModal">
            Tambah Penilaian
          </a>
          <div class="modal fade" id="alternatifModal" tabindex="-1" role="dialog"
            aria-labelledby="alternatifModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="alternatifModalLabel">Pilih Alternatif</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <select class="form-control" id="alternatifSelect" name="alternatif_id">
                    <option value="">Pilih Alternatif</option>
                    @foreach ($semuaAlternatif as $alternatif)
                      <option value="{{ $alternatif->id }}">{{ $alternatif->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="button" class="btn btn-primary" id="selanjutnyaBtn">Selanjutnya</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table-bordered table" id="subKriteriaTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Penilai</th>
                  <th>Nama Alternatif</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($semuaNilaiAlternatif as $nilaiAlternatif)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $nilaiAlternatif->user->name }}</td>
                    <td>{{ $nilaiAlternatif->alternatif->nama }}</td>
                    @if (auth()->user()->id == $nilaiAlternatif->user_id)
                      <td>
                        <a href="{{ route('penilaian.edit', [$nilaiAlternatif->user_id, $nilaiAlternatif->alternatif_id]) }}"
                          class="btn btn-warning">
                          Edit
                        </a>
                        <a href="{{ route('penilaian.destroy', [$nilaiAlternatif->user_id, $nilaiAlternatif->alternatif_id]) }}"
                          class="btn btn-danger" data-confirm-delete="true">Delete</a>
                      </td>
                    @else
                      <td>
                        <a href="{{ route('penilaian.show', [$nilaiAlternatif->user_id, $nilaiAlternatif->alternatif_id]) }}"
                          class="btn btn-primary">
                          Show
                        </a>
                      </td>
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>
            <nav class="d-flex justify-content-between align-items-center" aria-label="Page navigation">
              <span>
                Showing
                {{ $semuaNilaiAlternatif->firstItem() }}
                to
                {{ $semuaNilaiAlternatif->lastItem() }}
              </span>
              <ul class="pagination">
                {{ $semuaNilaiAlternatif->links() }}
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $("#selanjutnyaBtn").click(function() {
        let alternatifId = $("#alternatifSelect").val();
        if (alternatifId) {
          $.ajax({
            url: "{{ route('alternatif.get-by-role') }}",
            type: "POST",
            data: {
              _token: "{{ csrf_token() }}",
              alternatif_id: alternatifId
            },
            success: function(response) {
              window.location.href = "{{ route('penilaian.create') }}" + "?alternatif=" +
                alternatifId
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          })
        }
      });
    });
  </script>
@endsection
