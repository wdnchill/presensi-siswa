@extends('Layouts.main')
@section('title')
    DATA KELAS | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
     DATA KELAS
@endsection
<a href="{{ route('kelas.create') }}" class="btn btn-success mb-2"><i class="ti ti-plus"></i>TAMBAH KELAS</a>
<table class="table table-striped" id="tabledata" style="width:100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Qrcode</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kelases as $kelas)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kelas->kelas }}</td>
                <td>
                    <img src="{{ asset('storage/' . $kelas->qrCode) }}" alt="Qrcode" width="75" height="75">
                </td>
                <td>
                            <div class="list-group list-group-horizontal" role="group">
                            <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-primary m-1"><i class="ti ti-edit"></i> EDIT</a>
                
                            <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger m-1 show-alert-delete-box"><i class="ti ti-trash"></i> HAPUS</button>
                            </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection