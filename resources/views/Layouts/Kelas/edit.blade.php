@extends('Layouts.main')
@section('title')
    EDIT DATA KELAS | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
    FORM EDIT DATA KELAS
@endsection
    <form action="{{ route('kelas.update', $kelas->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nama">Kelas</label>
            <input type="text" class="form-control" id="nama" name="kelas" required
                value="{{ old('kelas', $kelas->kelas) }}">
        </div>
     <div class="mb-3 row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <a href="{{ route('kelas.index') }}" type="button" class="btn btn-danger"><i class="ti ti-arrow-narrow-left fs-7"></i> Back</a>
                        <button type="submit" class="btn btn-primary show-alert-submit-box">Update</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </div>
    </form>
@endsection
