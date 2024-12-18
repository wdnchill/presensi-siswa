@extends('Layouts.main')
@section('title')
    EDIT DATA USER | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
    FORM EDIT DATA USER
@endsection
@section('content')
    <div class="mb-4 d-flex justify-content-center">
        <div class="mb-4 d-flex justify-content-center">
            <img src="{{ asset('storage/' . $user->imguser) }}" alt="User Image" class="rounded-circle"
                style="width: 200px; height: 200px;" id="preview-image">
        </div>
    </div>
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="name" placeholder="PERBARUI NAMA LENGKAP"
                    required value="{{ old('name', $user->name) }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="PERBARUI USERNAME"
                    required value="{{ old('username', $user->username) }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="PERBARUI EMAIL"
                    required value="{{ old('email', $user->email) }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="pw" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pw" name="password" placeholder="PERBARUI PASSWORD"
                    value="{{ old('password') }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-control" id="role" name="role">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="walas" {{ old('role', $user->role) == 'walas' ? 'selected' : '' }}>Wali Kelas</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="foto" accept="image/*" name="imguser"
                    value="{{ old('imguser', $user->imguser) }}" onchange="previewImage(event)">
                <div id="croppie-container" class="mt-3"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a href="{{ route('user.index') }}" type="button" class="btn btn-danger"><i
                        class="ti ti-arrow-narrow-left fs-7"></i> Back</a>
                <button type="submit" class="btn btn-primary show-alert-submit-box">Update</button>
                <button type="reset" class="btn btn-md btn-warning">Reset</button>
            </div>
        </div>
    </form>
@endsection
