@extends('Layouts.main')
@section('title')
    CREATE DATA PRESENSI SISWA | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
    FROM PRESENSI
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-10 mb-3">
            <a href="{{ route('presensi.index') }}" type="button" class="btn btn-danger">
                <i class="ti ti-arrow-narrow-left fs-7"></i> Back
            </a>
        </div>
    </div>
    <form action="{{ route('presensi.store') }}" method="POST" id="presensiForm">
        @csrf
        @foreach ($kelas as $kelasItem)
            <input value="{{ $kelasItem->id }}" type="hidden" name="kelas_id">
        @endforeach
        <div class="row">
            <div class="col-md-10">
                <select class="form-select mb-3" id="mapel" name="mapel_id">
                    <option selected disabled>Pilih Mata pelajaran</option>
                    @foreach ($mapel as $mapelItem)
                        <option value="{{ $mapelItem->id }}"
                            {{ old('mapel_id', $mapelItem->namaMapel) == $mapelItem->id ? 'selected' : '' }}>
                            {{ $mapelItem->namaMapel }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @if ($siswas->isEmpty())
            <div class="alert alert-warning">
                <p>Data siswa belum dimasukkan.</p>
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($siswas as $siswa)
                    <div class="col mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted"># {{ $loop->iteration }}</h6>
                                <h5 class="card-title text-info">{{ $siswa->nama_lengkap }}</h5>
                                <p class="card-text">NIS: {{ $siswa->nis }}</p>
                                <p class="card-text">NISN: {{ $siswa->nisn }}</p>
                                <p class="card-text">KELAS: {{ $siswa->kelas->kelas }}</p>

                                <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                <div class="btn-group" role="group" aria-label="Vertical radio toggle button group">
                                    <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                        id="Hadir_{{ $siswa->id }}" value="Hadir" autocomplete="off">
                                    <label class="btn btn-outline-success" for="Hadir_{{ $siswa->id }}">
                                        <i class="ti ti-check"></i> Hadir
                                    </label>

                                    <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                        id="Alfa_{{ $siswa->id }}" value="Alfa" autocomplete="off">
                                    <label class="btn btn-outline-danger" for="Alfa_{{ $siswa->id }}">
                                        <i class="ti ti-xbox-x"></i> Alfa
                                    </label>

                                    <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                        id="Sakit_{{ $siswa->id }}" value="Sakit" autocomplete="off">
                                    <label class="btn btn-outline-warning" for="Sakit_{{ $siswa->id }}">
                                        <i class="ti ti-heartbeat"></i> Sakit
                                    </label>

                                    <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                        id="Izin_{{ $siswa->id }}" value="Izin" autocomplete="off">
                                    <label class="btn btn-outline-info" for="Izin_{{ $siswa->id }}">
                                        <i class="ti ti-info-circle"></i> Izin
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mb-3 row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-outline-info show-alert-submit-box" id="submitBtn"
                    style="width: 100%;">
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection
