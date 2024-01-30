@extends('Layouts.main')
@section('title')
    DATA MAPEL | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
    TABLE DATA MAPEL
@endsection
<a href="{{ route('mapel.create') }}" class="btn btn-success btn-sm mb-2"><i class="ti ti-plus"></i>TAMBAH DATA MAPEL</a>
<table class="table table-striped" id="tabledata" style="width:100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Mapel</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($mapel as $mapels)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mapels->namaMapel }}</td>
                <td>
             <a href="{{ route('mapel.edit', $mapels->id) }}" class="btn btn-primary"><i
                            class="ti ti-edit"></i>EDIT</a>
                    <form action="{{ route('mapel.destroy', $mapels->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger show-alert-delete-box"><i
                                class="ti ti-trash"></i>HAPUS</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <div class="alert alert-warning">
                        Data mapel belum dimasukan.
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
