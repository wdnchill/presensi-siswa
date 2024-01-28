 @extends('Layouts.main')
 @section('title')
     CREATE DATA PRESENSI SISWA | PRESENSI CITRA NEGARA
 @endsection
 @section('content')
 @section('sub-title')
     FORM PRESENSI SISWA
 @endsection
 @section('content')
     <form action="{{ route('presensi.store') }}" method="POST" id="presensiForm">
         @csrf
         @foreach ($kelas as $kelasItem)
             <input value="{{ $kelasItem->id }}" type="hidden" name="kelas_id">
         @endforeach

         <div class="card-body">
             <select class="form-select" id="user" name="user_id">
                 <option selected>Pilih Guru/Petugas</option>
                 @foreach ($users as $usersItem)
                     <option value="{{ $usersItem->id }}" required>{{ $usersItem->name }}</option>
                 @endforeach
             </select>
             <div class="table-responsive">
                 <table class="table table-hover" id="" style="width:100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Siswa</th>
                             <th>Nis</th>
                             <th>Nisn</th>
                             <th>Absensi</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($siswas as $siswa)
                             <tr data-kelas="{{ $siswa->kelas_id }}">
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $siswa->nama_lengkap }}</td>
                                 <td>{{ $siswa->nis }}</td>
                                 <td>{{ $siswa->nisn }}</td>
                                 <td>
                                     <input type="hidden" name="siswa_id[]" value="{{ $siswa->id }}">
                                     <div class="btn-group d-flex" role="group"
                                         aria-label="Vertical radio toggle button group">
                                         <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                             id="Hadir_{{ $siswa->id }}" value="Hadir" autocomplete="off">
                                         <label class="btn btn-outline-success"
                                             for="Hadir_{{ $siswa->id }}">Hadir</label>

                                         <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                             id="Alfa_{{ $siswa->id }}" value="Alfa" autocomplete="off">
                                         <label class="btn btn-outline-danger" for="Alfa_{{ $siswa->id }}">Alfa</label>

                                         <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                             id="Sakit_{{ $siswa->id }}" value="Sakit" autocomplete="off">
                                         <label class="btn btn-outline-warning"
                                             for="Sakit_{{ $siswa->id }}">Sakit</label>

                                         <input type="radio" class="btn-check" name="presensi[{{ $siswa->id }}]"
                                             id="Izin_{{ $siswa->id }}" value="Izin" autocomplete="off">
                                         <label class="btn btn-outline-info" for="Izin_{{ $siswa->id }}">Izin</label>
                                     </div>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
             <div class="mb-3 row">
                 <div class="col-md-12 text-center">
                     <button type="submit" class="btn btn-outline-info show-alert-submit-box" id="submitBtn"
                         style="width: 100%;">Submit</button>
                 </div>
             </div>
         </div>
     </form>
 @endsection
