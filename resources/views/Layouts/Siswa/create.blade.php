@extends('Layouts.main')
@section('title')
    CREATE DATA SISWA | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
    Form siswa
@endsection
@section('content')
    <form action="{{ route('siswa.store') }}" method="post">
        @csrf

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">Nis</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="nis" name="nis" placeholder="MASUKAN NOMOR NIS SISWA"
                    required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nisn" class="col-sm-2 col-form-label">Nisn</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="nisn" name="nisn"
                    placeholder="MASUKAN NOMOR NISN SISWA" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap siswa</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama_lengkap"
                    placeholder="MASUKAN NAMA SISWA" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Jenis Kelamin :</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="Laki-Laki" value="Laki-Laki">
                    <label class="form-check-label" for="Laki-Laki">Laki-Laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="Perempuan" value="Perempuan">
                    <label class="form-check-label" for="Perempuan">Perempuan</label>
                </div>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
                <select class="form-select" id="kelas" name="kelas_id">
                    @foreach ($kelas as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a href="{{ route('siswa.index') }}" type="button" class="btn btn-danger"><i
                        class="ti ti-arrow-narrow-left fs-7"></i> Back</a>
                <button type="submit" class="btn btn-primary show-alert-submit-box">Submit</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </div>
    </form>
@endsection
