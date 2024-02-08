@extends('Layouts.main')

@section('title')
    DATA PRESENSI SISWA | PRESENSI CITRA NEGARA
@endsection

@section('sub-title')
    DATA LAPORAN PRESENSI
@endsection

@section('content')
<div class="card-body">
    <form action="{{ route('presensi.filter') }}" method="post">
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
            <div class="col-md-3">
                <label for="TanggalMulai">Tanggal Mulai</label>
                <input type="date" class="form-control" id="TanggalMulai" name="TanggalMulai"
                    value="{{ old('TanggalMulai') }}">
            </div>
            <div class="col-md-3">
                <label for="TanggalSelesai">Tanggal Selesai</label>
                <input type="date" class="form-control" id="TanggalSelesai" name="TanggalSelesai"
                    value="{{ old('TanggalSelesai') }}">
            </div>
            <div class="col-md-3 mt-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
</div>
        <table class="table table-striped" id="tabledata" style="width:100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nisn</th>
                    <th>Nis</th>
                    <th>kelas</th>
                    <th>Absensi</th>
                    <th>Guru</th>
                    <th>Matapelajaran</th>
                    <th>Bln/Tgl/Thn</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($presensis as $presensi)
                    <tr data-kelas="{{ $presensi->siswas->kelas_id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $presensi->siswas->nama_lengkap }}</td>
                        <td>{{ $presensi->siswas->nisn }}</td>
                        <td>{{ $presensi->siswas->nis }}</td>
                        <td>{{ $presensi->kelas->kelas }}</td>
                        <td>{{ $presensi->presensi }}</td>
                        <td>{{ $presensi->users->name }}</td>
                        <td>{{ $presensi->mapels->namaMapel }}</td>
                        <td>{{ $presensi->created_at ? $presensi->created_at->format('d F Y') : 'N/A' }}</td>
                        <td>
                            <div class="list-group list-group-horizontal" role="group">
                                <a href="{{ route('presensi.edit', $presensi->id) }}" class="btn btn-primary m-1"><i
                                        class="ti ti-edit"></i>EDIT</a>
                                <form action="{{ route('presensi.destroy', $presensi->id) }}" method="POST"
                                    style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger m-1 show-alert-delete-box"><i
                                            class="ti ti-trash"></i>HAPUS</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
