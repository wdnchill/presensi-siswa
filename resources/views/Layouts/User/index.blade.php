@extends('Layouts.main')
@section('title')
    DATA USER | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
    DATA USER
@endsection
<p class="mb-0">Regitrasi data </p>
<a href="{{ route('user.create') }}" class="btn btn-success mb-2">TAMBAH DATA USER</a>
<table class="table table-striped" id="tabledata" style="width:100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ asset('storage/' . $user->imguser) }}" alt="not found" width="50px" height="50px"
                        class="rounded-circle">
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <div class="list-group list-group-horizontal" role="group">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary m-1"><i
                                class="ti ti-edit"></i>EDIT</a>                            

                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline;">
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
