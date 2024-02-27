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
                <i class="ti ti-arrow-narrow-left fs-7"></i> Kembali
            </a>
        </div>
    </div>
    <div class="mb-3">
        <h1>{{ $presensi->siswas->nama_lengkap }}</h1>
        <h1>{{ $presensi->kelas->kelas }}</h1>
    </div>

    <form action="{{ route('presensi.update', $presensi->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="siswa_id" value="{{ $presensi->siswas->id }}">
         @foreach ($kelas as $kelasItem)
            <input value="{{ $kelasItem->id }}" type="hidden" name="kelas_id">
        @endforeach
        <div class="mb-3">
            <label for="user" class="form-label">Pilih Guru/Petugas</label>
            <select class="form-select" id="user" name="user_id">
                <option selected disabled>Pilih Guru/Petugas</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $presensi->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="mapel" class="form-label">Perbarui Mata Pelajaran</label>
            <select class="form-select" id="mapel" name="mapel_id">
                <option selected disabled>Pilih Mata Pelajaran</option>
                @foreach ($mapel as $mapels)
                    <option value="{{ $mapels->id }}" {{ old('mapel_id', $presensi->mapel_id) == $mapels->id ? 'selected' : '' }}>
                        {{ $mapels->namaMapel }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan :</label>
            <div class="btn-group" role="group" aria-label="Vertical radio toggle button group">
                <input type="radio" class="btn-check" name="presensi" id="hadir" value="Hadir"
                    {{ $presensi->presensi == 'Hadir' ? 'checked' : '' }} required>
                <label class="btn btn-outline-success" for="hadir"> <i class="ti ti-check"></i> Hadir</label>

                <input type="radio" class="btn-check" name="presensi" id="alfa" value="Alfa"
                    {{ $presensi->presensi == 'Alfa' ? 'checked' : '' }} required>
                <label class="btn btn-outline-danger" for="alfa"> <i class="ti ti-xbox-x"></i>  Alfa</label>

                <input type="radio" class="btn-check" name="presensi" id="sakit" value="Sakit"
                    {{ $presensi->presensi == 'Sakit' ? 'checked' : '' }} required>
                <label class="btn btn-outline-warning" for="sakit">  <i class="ti ti-heartbeat"></i> Sakit</label>

                <input type="radio" class="btn-check" name="presensi" id="izin" value="Izin"
                    {{ $presensi->presensi == 'Izin' ? 'checked' : '' }} required>
                <label class="btn btn-outline-info" for="izin"> <i class="ti ti-info-circle"></i> Izin</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">Perbarui</button>
    </form>
@endsection
