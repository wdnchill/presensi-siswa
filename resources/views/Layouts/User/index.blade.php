@extends('Layouts.main')
@section('title')
    DATA USER | PRESENSI CITRA NEGARA
@endsection
@section('content')
@section('sub-title')
    DATA USER
@endsection
<div class="row">
    <div class="col-md-3 mt-3 mb-3">
        <form action="{{ route('user.index') }}" method="GET">
            <div class="form-group">
                <select name="role" onchange="this.form.submit()" class="form-control">
                    <option value="">Pilih Role</option>
                    <option value="guru">Guru</option>
                    <option value="admin">Admin</option>
                    <option value="walas">Wali Kelas</option>
                </select>
            </div>
        </form>
    </div>
    <div class="col-md-9 text-md-right mt-3 mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-success"><i class="ti ti-plus"></i> TAMBAH USER</a>
    </div>
</div>

<table class="table table-striped" id="tabledata2" style="width:100%" cellspacing="0">
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
