@extends('Layouts.main')
@section('title')
    CREATE DATA KELAS | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
    FORM KELAS
@endsection
<p class="mb-0">Input data kelas</p>
<div class="card-body">
    <form action="{{ route('kelas.store') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="nama">Kelas</label>
            <input type="text" class="form-control" id="nama" name="kelas" placeholder="MASUKAN KELAS " required>
        </div>
        <a href="{{ route('kelas.index') }}" type="button" class="btn btn-danger "><i
                class="ti ti-arrow-narrow-left fs-7"></i></a>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-warning">Reset</button>
    </form>
</div>
@endsection
