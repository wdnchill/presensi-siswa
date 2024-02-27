@extends('Layouts.main')
@section('title')
    DATA SISWA | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
    DATA SISWA
@endsection

<form action="{{ route('presensi.filterSiswa') }}" method="post" class="mb-3">
    @csrf
    <div class="d-flex align-items-end">
        <div class="me-3">
            <select class="form-control" name="kelas_id" id="kelasSelect" onchange="this.form.submit()">
                <option value="">--PILIH KELAS--</option>
                @foreach ($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id }}">{{ $kelasItem->kelas }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<div class="row mb-3">
    <div class="col-md-6">
        <div class="d-flex justify-content-start gap-2">
            <a href="{{ route('siswa.create') }}" class="btn btn-success"><i class="ti ti-plus"></i>TAMBAH SISWA</a>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" /></svg> Import Excel</button>
        </div>
    </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data Siswa dari Excel</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
        
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih file Excel</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-info">Import Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped table-responsive" id="tabledata" style="width:100%" cellspacing="0">
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
                    <div class="list-group list-group-horizontal" role="group">
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-primary m-1"><i class="ti ti-edit"></i> EDIT</a>
                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-1 show-alert-delete-box"><i class=" ti ti-trash"></i> HAPUS</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
