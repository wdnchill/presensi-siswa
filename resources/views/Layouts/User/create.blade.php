@extends('Layouts.main')
@section('title')
    CREATE DATA USER | PRESENSI CITRA NEGARA
@endsection
@section('sub-title')
    FORM REGISTER USER
@endsection
@section('content')
    <div class="mb-4 d-flex justify-content-center">
        <img src="{{ asset('assets/images/icon.jpg') }}" alt="userimg" class="rounded-circle"
            style="width: 200px; height: 200px;" id="preview-image">
    </div>
    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="name" placeholder="MASUKAN NAMA LENGKAP"
                    required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="MASUKAN USERNAME"
                    required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="MASUKAN EMAIL AKTIF"
                    required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="pw" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="pw" name="password" placeholder="MASUKAN PASSWORD"
                    required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select class="form-select" id="role" name="role">
                    <option selected disabled>PILIH ROLE</option>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="walas">Wali Kelas</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="imguser" name="imguser" accept="image/*"
                    onchange="previewImage(event)" required>
                <div id="croppie-container" class="mt-3"></div>
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a href="{{ route('user.index') }}" type="button" class="btn btn-danger"><i
                        class="ti ti-arrow-narrow-left fs-7"></i> Back</a>
                <button type="submit" class="btn btn-primary show-alert-submit-box">Submit</button>
                <button type="reset" class="btn btn-warning">Reset</button>
            </div>
        </div>
    </form>
@endsection
