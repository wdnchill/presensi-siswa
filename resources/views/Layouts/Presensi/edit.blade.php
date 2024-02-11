@extends('Layouts.main')

@section('title')
    EDIT DATA PRESENSI SISWA | PRESENSI CITRA NEGARA
@endsection

@section('sub-title')
    FORM EDIT PRESENSI
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-10 mb-3">
            <a href="{{ route('laporan') }}" type="button" class="btn btn-danger">
                <i class="ti ti-arrow-narrow-left fs-7"></i> Back
            </a>
        </div>
    </div>
    <form action="{{ route('presensi.update', $presensi->id) }}" method="post">
        @csrf
        @method('PUT')

        <input value="{{ old('kelas_id', $presensi->kelas_id) }}" type="hidden" name="kelas_id">

        <select class="form-select mb-3" id="user" name="user_id">
            <option selected disabled>Pilih Guru/Petugas</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id', $presensi->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        <select class="form-select mb-3" id="mapel" name="mapel_id">
            <option selected disabled>Perbarui matapelajaran</option>
            @foreach ($mapel as $mapels)
                <option value="{{ old('mapel_id', $mapels->id) }}"
                    {{ old('mapel_id', $presensi->mapel_id) == $mapels->id ? 'selected' : '' }}>
                    {{ $mapels->namaMapel }}
                </option>
            @endforeach
        </select>

        <input value="{{ old('siswa_id', $presensi->siswa_id) }}" name="siswa_id" type="hidden">

        <div class="form-group mb-3">
            <label class="form-label">Keterangan :</label>
            <div class="btn-group d-flex" role="group" aria-label="Vertical radio toggle button group">
                <input type="radio" class="btn-check" name="presensi" id="hadir" value="Hadir"
                    {{ $presensi->presensi == 'Hadir' ? 'checked' : '' }} required>
                <label class="btn btn-outline-success" for="hadir">Hadir</label>

                <input type="radio" class="btn-check" name="presensi" id="alfa" value="Alfa"
                    {{ $presensi->presensi == 'Alfa' ? 'checked' : '' }} required>
                <label class="btn btn-outline-danger" for="alfa">Alfa</label>

                <input type="radio" class="btn-check" name="presensi" id="sakit" value="Sakit"
                    {{ $presensi->presensi == 'Sakit' ? 'checked' : '' }} required>
                <label class="btn btn-outline-warning" for="sakit">Sakit</label>

                <input type="radio" class="btn-check" name="presensi" id="izin" value="Izin"
                    {{ $presensi->presensi == 'Izin' ? 'checked' : '' }} required>
                <label class="btn btn-outline-info" for="izin">Izin</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary show-alert-submit-box">Update</button>
    </form>
@endsection
