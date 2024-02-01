@extends('layouts.main')
@section('title')
    EDIT DATA USER | PRESENSI CITRA NEGARA
@endsection
@section('content')
    <h5 class="card-title fw-semibold mb-4">Form Edit User</h5>
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="name" placeholder="MASUKAN NAMA LENGKAP"
                    required value="{{ old('name', $user->name) }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="MASUKAN EMAIL AKTIF"
                    required value="{{ old('email', $user->email) }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="pw" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pw" name="password" placeholder="MASUKAN PASSWORD"
                    required value="{{ old('password', $user->password) }}">
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
                    value="{{ old('imguser', $user->imguser) }}">
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
