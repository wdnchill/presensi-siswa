<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SiswaController extends Controller
{

    public function index()
    {
        $kelas = Kelas::all();
        $siswas = Siswa::all();

        return view('Layouts.Siswa.index', compact('siswas', 'kelas'));
    }


    public function create()
    {
        $kelas = Kelas::all();
        return view('Layouts.Siswa.create', compact('kelas'));
    }


    public function store(Request $request)
    {
    
        $this->validate($request, [
            'nisn' => 'required|numeric|digits:10',
            'nis' => 'required|numeric|digits:9',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'kelas_id' => 'required',
        ], [
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.numeric' => 'Kolom NIS harus berupa angka.',
            'nis.digits' => 'Kolom NIS harus terdiri dari 9 digit angka.',
            'nisn.required' => 'Kolom NISN wajib diisi.',
            'nisn.numeric' => 'Kolom NISN harus berupa angka.',
            'nisn.digits' => 'Kolom NISN harus terdiri dari 10 digit angka.',
            'nama_lengkap.required' => 'Kolom Nama Lengkap wajib diisi.',
            'jenis_kelamin.required' => 'Kolom Jenis Kelamin wajib diisi.',
            'kelas_id.required' => 'Kolom Kelas wajib diisi.',
            'kelas_id.numeric' => 'Kolom Kelas harus berupa angka.',

        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $siswas = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('Layouts.Siswa.edit', compact('siswas', 'kelas'));
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nis' => 'required|numeric|digits:9',
            'nisn' => 'required|numeric|digits:10',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'kelas_id' => 'required',
        ]);

        $siswas = Siswa::findOrFail($id);
        $siswas->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

public function destroy(string $id)
{
    $siswa = Siswa::findOrFail($id);
    $presensiCount = $siswa->siswas()->count();
    
    if ($presensiCount > 0) {
        return redirect()->back()->with(['error' => 'Tidak dapat menghapus data siswa karena ada data terkait dalam tabel presensi. Silahkan hapus data presensi yang berkaitan terlebih dahulu.']);
    }

    $siswa->delete();

    return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
}

  
public function filterSiswa(Request $request)
{
    $request->validate([
        'kelas_id' => 'nullable|numeric',
    ]);

    $kelas = Kelas::all();
    $kelasId = $request->input('kelas_id');

 
    if ($kelasId !== null) {
        $siswas = Siswa::where('kelas_id', $kelasId)->get();
    } else {
       
        $siswas = Siswa::all();
    }

    return view('Layouts.Siswa.index', compact('siswas', 'kelas'));
}

}
