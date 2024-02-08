@extends('Layouts.main')
@section('title')
    DATA MAPEL | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
    TABLE DATA MAPEL
@endsection
@section('content')
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
        @foreach ($mapel as $mapels)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mapels->namaMapel }}</td>
                <td>
            <div class="list-group list-group-horizontal" role="group">
             <a href="{{ route('mapel.edit', $mapels->id) }}" class="btn btn-primary m-1"><i
                            class="ti ti-edit"></i>EDIT</a>                   
                        </div>
                        <div class="col-md-4">
                           <form action="{{ route('mapel.destroy', $mapels->id) }}" method="POST" style="display: inline; ">
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