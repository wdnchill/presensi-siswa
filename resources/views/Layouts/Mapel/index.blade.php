@extends('Layouts.main')
@section('title')
    DATA MAPEL | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
     DATA MAPEL
@endsection
@section('content')
<a href="{{ route('mapel.create') }}" class="btn btn-success mb-2"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z" /><path d="M19 16h-12a2 2 0 0 0 -2 2" /><path d="M9 8h6" /></svg></i>TAMBAH MAPEL</a>
<table class="table table-striped" id="tabledata2" style="width:100%" cellspacing="0">
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
                            <a href="{{ route('mapel.edit', $mapels->id) }}" class="btn btn-primary m-1"><i class="ti ti-edit"></i> EDIT</a>
                
                            <form action="{{ route('mapel.destroy', $mapels->id) }}" method="POST">
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