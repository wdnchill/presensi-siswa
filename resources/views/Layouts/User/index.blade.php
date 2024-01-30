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
            <th>Email</th>
            <th>Role</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ asset('storage/' . $user->imguser) }}" alt="userimg"width="35"
                        height="35" class="rounded-circle">
                </td>
                <td>{{ $user->name }}</td> 
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary "><i
                                class="ti ti-edit"></i>EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger show-alert-delete-box"><i
                                class="ti ti-trash"></i>HAPUS</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">
                    <div class="alert alert-warning">
                        Data user belum dimasukan.
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
