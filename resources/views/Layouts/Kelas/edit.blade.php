@extends('Layouts.main')
@section('title')
    EDIT DATA KELAS | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
    FORM EDIT DATA KELAS
@endsection
<p class="mb-0">Input data kelas</p>

<div class="card-body">
    <form action="{{ route('kelas.update', $kelas->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nama">Kelas</label>
            <input type="text" class="form-control" id="nama" name="kelas" required
                value="{{ old('kelas', $kelas->kelas) }}">
        </div>
        <button type="reset" class="btn btn-warning">Riset</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
