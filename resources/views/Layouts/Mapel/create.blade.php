@extends('layouts.main')
@section('title')
    CREATE DATA MAPEL | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
    Form mapel
@endsection
@section('content')
    <form action="{{ route('mapel.store') }}" method="post">
        @csrf

        <div class="mb-3 row">
            <label for="mapel" class="col-sm-2 col-form-label">Nama Mata pelajaran</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="mapel" name="namaMapel" placeholder="MASUKAN MATA PELAJARAN" required>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a href="{{ route('mapel.index') }}" type="button" class="btn btn-danger show-alert-submit-box"><i class="ti ti-arrow-narrow-left fs-7"></i> Back</a>
                <button type="submit" class="btn btn-primary show-alert-submit-box">Submit</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </div>
    </form>
@endsection
