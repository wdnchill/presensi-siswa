<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class SiswaController extends Controller
{
    
    public function index()
    {
        $kelas = Kelas::all();
        $siswas = Siswa::all();

        return view('Layouts.Siswa.index', compact('siswas','kelas'));
    }

   
    public function create()
    {
        $kelas = Kelas::all();
        return view('Layouts.Siswa.create',compact('kelas'));
    }

   
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nisn' => 'required|numeric',
            'nis' => 'required|numeric',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'kelas_id' => 'required',
           ],[
        'nis.required' => 'Kolom NIS wajib diisi.',
        'nis.numeric' => 'Kolom NIS harus berupa angka.',
        'nisn.required' => 'Kolom NISN wajib diisi.',
        'nisn.numeric' => 'Kolom NISN harus berupa angka.',
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
           
           return redirect()->route('siswa.create')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
         $siswas = Siswa::findOrFail($id);
         $kelas = Kelas::all();
               return view('Layouts.Siswa.edit', compact('siswas','kelas'));
    }

    
    public function update(Request $request, string $id)
    {
    $this->validate($request, [
        'nis' => 'required|numeric',
        'nisn' => 'required|numeric',
        'nama_lengkap' => 'required',
        'jenis_kelamin' => 'required',
        'kelas_id' => 'required'
    ]);

    $siswas = Siswa::findOrFail($id);
    $siswas->update([
            'nisn' => $request->nis,
            'nis' => $request->nis,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas_id' => $request->kelas_id,
    ]);

    return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Diubah!']);
}


    public function destroy(string $id)
    {

         $siswas = Siswa::findOrFail($id);

         $siswas->delete();

         return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }

   public function filterSiswa(Request $request)
    {
          
        $request->validate([
            'kelas_id' => 'required|numeric', 
        ]);

        $kelas = Kelas::all();
        $kelasId = $request->input('kelas_id');
        $siswas = Siswa::where('kelas_id', $kelasId)->get();

        return view('Layouts.Siswa.index', compact('siswas','kelas'));
    }

}
