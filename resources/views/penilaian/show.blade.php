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

      <!-- Kriteria form -->
      <div class="card shadow mb-4">
        <div class="card-header">
          <h2 class="m-0 h4 font-weight-bold text-primary">Edit Data Penilaian</h2>
        </div>
        <div class="card-body">
          <div>
            {{-- Select input for choose alternatif --}}
            <div class="form-group row">
              <label for="alternatif_id" class="col-sm-2 col-form-label">Alternatif</label>
              <div class="col-sm-10">
                <select disabled class="form-control" id="alternatif_id" name="alternatif_id" readonly>
                  <option value="{{ $alternativeValues->alternatif_id }}">
                    {{ $alternativeValues->alternatif->nama }}</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <span class="col-sm-2 text-danger">Penjelasan: </span>
              <div class="col-sm-10">
                <p class="text-danger">0 = Tidak Baik, 1 = Kurang Baik, 2 = Cukup Baik, 3 = Baik, 4 = Sangat Baik</p>
              </div>
            </div>
            @foreach ($semuaSubKriteria->groupBy('kriteria_id') as $kriteriaId => $subKriteriaGroup)
              <div class="accordion my-3" id="accordion{{ $kriteriaId }}">
                <div class="card">
                  <div class="card-header" id="heading{{ $kriteriaId }}">
                    <h2 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse"
                        data-target="#collapse{{ $kriteriaId }}" aria-expanded="true"
                        aria-controls="collapse{{ $kriteriaId }}">
                        {{ $subKriteriaGroup->first()->kriteria->nama }}
                      </button>
                    </h2>
                  </div>

                  <div id="collapse{{ $kriteriaId }}" class="collapse show"
                    aria-labelledby="heading{{ $kriteriaId }}" data-parent="#accordion{{ $kriteriaId }}">
                    <div class="card-body">
                      @foreach ($subKriteriaGroup as $subKriteria)
                        <div
                          class="form-group row
                          @error('value.' . $subKriteria->id)
                            has-error
                          @enderror">
                          <input type="hidden" name="sub_kriteria_id[]" value="{{ $subKriteria->id }}">
                          <label class="col-sm-2 col-form-label"
                            for="value[{{ $subKriteria->id }}]">{{ $subKriteria->nama }}</label>
                          <div class="col-sm-10">
                            @for ($i = 0; $i <= 4; $i++)
                              <div class="form-check form-check-inline">
                                <input disabled class="form-check-input" type="radio"
                                  name="value[{{ $subKriteria->id }}]"
                                  id="value[{{ $subKriteria->id }}]{{ $i }}" value="{{ $i }}"
                                  {{ old('value.' . $subKriteria->id, $alternativeValues->where('subkriteria_id', $subKriteria->id)->first()->value) == $i ? 'checked' : '' }}>
                                <label class="form-check-label"
                                  for="value[{{ $subKriteria->id }}]{{ $i }}">{{ $i }}</label>
                              </div>
                            @endfor
                          </div>
                          @error('value.' . $subKriteria->id)
                            <span
                              class="help-block
                              @error('value.' . $subKriteria->id)
                                has-error
                              @enderror">{{ $message }}</span>
                          @enderror
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            <a href="{{ route('penilaian.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
          </div>
        </div>

      </div>
    </div>
  @endsection
