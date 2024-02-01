@extends('Layouts.main')
@section('title')
    DATA SISWA | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
    DATA SISWA
@endsection
<form action="{{ route('presensi.filterSiswa') }}" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="kelas_id">Pilih Kelas</label>
            <select class="form-control" name="kelas_id" id="kelasSelect">
                <option value="">--PILIH KELAS--</option>
                @foreach ($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id }}">{{ $kelasItem->kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 mt-4">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>
<p class="mb-0">Regitrasi data </p>
<a href="{{ route('siswa.create') }}" class="btn btn-success mb-2">TAMBAH DATA SISWA</a>
<table class="table table-striped table-responsiv" id="tabledata" style="width:100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nis</th>
            <th>Nisn</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Kelas</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswas as $siswa)
            <tr data-kelas="{{ $siswa->kelas_id }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->nama_lengkap }}</td>
                <td>{{ $siswa->jenis_kelamin }}</td>
                <td>{{ $siswa->kelas->kelas }}</td>
                <td>
                    <div class="list-group list-group-horizontal" role="group" aria-label="Aksi">
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-primary"><i
                                class="ti ti-edit"></i>EDIT</a>
                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger show-alert-delete-box"><i
                                    class="ti ti-trash"></i>HAPUS</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
