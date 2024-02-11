@extends('Layouts.main')
@section('title')
    EDIT DATA SISWA | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
    FORM EDIT DATA SISWA
@endsection
@section('content')
    <form action="{{ route('siswa.update', $siswas->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">Nis</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="nis" name="nis" placeholder="PERBARUI NOMOR NIS SISWA"
                    required value="{{ old('nis', $siswas->nis) }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nisn" class="col-sm-2 col-form-label">Nisn</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="nisn" name="nisn"
                    placeholder="PERBARUI NOMOR NISN SISWA" required value="{{ old('nisn', $siswas->nisn) }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama_lengkap"
                    placeholder="PERBARUI NAMA SISWA " required value="{{ old('nama_lengkap', $siswas->nama_lengkap) }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Jenis Kelamin :</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" id="L" value="Laki-Laki"
                        required {{ $siswas->jenis_kelamin === 'Laki-Laki' ? 'checked' : '' }}>
                    <label class="form-check-label" for="L">Laki-Laki</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" id="P" value="Perempuan"
                        required {{ $siswas->jenis_kelamin === 'Perempuan' ? 'checked' : '' }}>
                    <label class="form-check-label" for="P">Perempuan</label>
                </div>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
                <select class="form-select" id="kelas" name="kelas_id">
                    <option selected disabled>Pilih Kelas</option>
                    @foreach ($kelas as $kelas)
                        <option value="{{ old('kelas_id', $kelas->id) }}"
                            {{ old('kelas_id', $siswas->kelas_id) == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->kelas }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a href="{{ route('siswa.index') }}" type="button" class="btn btn-danger"><i
                        class="ti ti-arrow-narrow-left fs-7"></i> Back</a>
                <button type="submit" class="btn btn-primary show-alert-submit-box">Update</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </div>
    </form>
@endsection
