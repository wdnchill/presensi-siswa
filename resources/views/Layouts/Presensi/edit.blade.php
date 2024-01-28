@extends('Layouts.main')

@section('title')
    EDIT DATA PRESENSI SISWA | PRESENSI CITRA NEGARA
@endsection

@section('content')

@section('sub-title')
    FORM EDIT ABSEN
@endsection

@section('content')
    <form action="{{ route('presensi.update', $presensi->id) }}" method="post">
        @csrf
        @method('PUT')
        @foreach ($kelas as $kelasItem)
            <input value="{{ $kelasItem->id }}" type="hidden" name="kelas_id">
        @endforeach

        <select class="form-select mb-3" id="user" name="user_id">
            <option selected disabled>Pilih Guru/Petugas</option>
            @foreach ($users as $user)
                <option value="{{old('user_id', $presensi->user_id)
                 }}" {{ old('user_id', $presensi->user_id) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
       <select class="form-select mb-3" id="siswa" name="siswa_id" disabled>
    @foreach ($siswas as $siswa)
        <option value="{{ old('siswa_id', $presensi->siswa_id) }}" {{ old('siswa_id', $presensi->siswa_id) == $siswa->id ? 'selected' : '' }}>
            {{ $siswa->nama_lengkap }}
        </option>
    @endforeach
    </select>

        <div class="form-group mb-3">
            <label class="form-label">Keterangan :</label>
            <div class="btn-group d-flex" role="group" aria-label="Vertical radio toggle button group">
                <input type="radio" class="btn-check" name="presensi" id="hadir" value="Hadir"
                    {{ $presensi->presensi === 'Hadir' ? 'checked' : '' }} required>
                <label class="btn btn-outline-success" for="hadir">Hadir</label>

                <input type="radio" class="btn-check" name="presensi" id="alfa" value="Alpa"
                    {{ $presensi->presensi === 'Alpa' ? 'checked' : '' }} required>
                <label class="btn btn-outline-danger" for="alfa">Alfa</label>

                <input type="radio" class="btn-check" name="presensi" id="sakit" value="Sakit"
                    {{ $presensi->presensi === 'Sakit' ? 'checked' : '' }} required>
                <label class="btn btn-outline-warning" for="sakit">Sakit</label>

                <input type="radio" class="btn-check" name="presensi" id="izin" value="Izin"
                    {{ $presensi->presensi === 'Izin' ? 'checked' : '' }} required>
                <label class="btn btn-outline-info" for="izin">Izin</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
