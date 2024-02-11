@extends('Layouts.main')
@section('title')
    CREATE DATA KELAS | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
    FORM CREATE KELAS
@endsection
@section('content')
    <form action="{{ route('kelas.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="nama">Kelas</label>
            <input type="text" class="form-control" id="nama" name="kelas" placeholder="MASUKAN KELAS " required>
        </div>
        <div class="mb-3 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a href="{{ route('kelas.index') }}" type="button" class="btn btn-danger"><i
                        class="ti ti-arrow-narrow-left fs-7"></i> Back</a>
                <button type="submit" class="btn btn-primary show-alert-submit-box">Submit</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </div>
    </form>
@endsection
