<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class PresensiController extends Controller
{

    public function index()
    {
        $kelas = Kelas::all();
        return view('Layouts.Presensi.index', compact('kelas'));
    }


    public function create(Request $request)
    {
        $kelas = Kelas::all();
        $siswas = Siswa::all();
        $mapel = Mapel::all();
        return view('Layouts.Presensi.create', compact('kelas', 'siswas', 'mapel'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'siswa_id' => 'required',
            'kelas_id' => 'required',
            'user_id' => 'required',
            'mapel_id' => 'required',
            'presensi' => 'required|array',
            'presensi.*' => 'required|in:Hadir,Alfa,Sakit,Izin',
        ], [
            'presensi.required' => 'Kolom Presensi wajib diisi.',
            'presensi.*.required' => 'Kolom Presensi untuk setiap siswa wajib diisi.',
            'presensi.*.in' => 'Kolom Presensi untuk setiap siswa harus berisi Hadir, Alfa, Sakit, atau Izin.',

        ]);

        if ($request->mapel_id == 'Pilih Mata pelajaran' || count($request->presensi) === 0) {
            return redirect()->route('presensi.create')->with([
                'error' => 'Kolom Matapelajaran  wajib diisi.'
            ])->withInput();
        }

        foreach ($request->presensi as $siswa_id => $presensi) {
            Presensi::create([
                'kelas_id' => $request->kelas_id,
                'siswa_id' => $siswa_id,
                'user_id'  => $request->user_id,
                'mapel_id'  => $request->mapel_id,
                'presensi' => $presensi,
            ]);
        }

        return redirect()->route('presensi.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }


    public function show($kelas_id)
    {
        $kelas = Kelas::where('id', $kelas_id)->get();
        $siswas = Siswa::where('kelas_id', $kelas_id)->get();
        $users = User::all();
        $mapel = Mapel::all();


        return view('Layouts.Presensi.create', compact('kelas', 'siswas', 'users', 'mapel'));
    }



    public function edit($id)
    {
        $presensi = Presensi::with('siswas', 'kelas')->findOrFail($id);
        $users = User::all();
        $kelas = Kelas::all();
        $siswas = Siswa::all();
        $mapel = Mapel::all();
        return view('Layouts.Presensi.edit', compact('presensi', 'siswas', 'kelas', 'users', 'mapel'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'presensi' => 'required|in:Hadir,Alfa,Sakit,Izin',
            'kelas_id' => 'required',
            'user_id' => 'required',
            'siswa_id' => 'required',
            'mapel_id' => 'required',
        ]);

        $presensi = Presensi::findOrFail($id);

        $presensi->update([
            'presensi' => $request->presensi,
            'user_id' =>  $request->user_id,
            'kelas_id' => $request->kelas_id,
            'siswa_id' => $request->siswa_id,
            'mapel_id' => $request->mapel_id,
        ]);

        return redirect()->route('laporan')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id)
    {
        $presensi = Presensi::findOrFail($id);

        $presensi->delete();

        return redirect()->route('laporan')->with(['success' => 'Data Berhasil Dihapus!']);
    }


    public function laporan()
    {
        $mapels = Mapel::all();
        $kelas = Kelas::all();
        $presensis = Presensi::with('siswas', 'kelas', 'users', 'mapels')->get();
        return view('Layouts.Presensi.laporan', compact('presensis', 'kelas', 'mapels'));
    }
    public function filter(Request $request)
    {

        $request->validate([
            'TanggalMulai' => 'nullable|date',
            'TanggalSelesai' => 'nullable|date|after_or_equal:TanggalMulai',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);


        $TanggalMulai = $request->input('TanggalMulai');
        $TanggalSelesai = $request->input('TanggalSelesai');
        $kelas_id = $request->input('kelas_id');

        $siswas = Siswa::all();
        $kelas = Kelas::all();


        $presensiQuery = Presensi::with('siswas', 'kelas');


        if ($TanggalMulai) {
            $presensiQuery->whereDate('created_at', '>=', $TanggalMulai);
        }


        if ($TanggalSelesai) {
            $presensiQuery->whereDate('created_at', '<=', $TanggalSelesai);
        }

        if ($kelas_id) {
            $presensiQuery->whereHas('kelas', function ($query) use ($kelas_id) {
                $query->where('id', $kelas_id);
            });
        }

        $presensis = $presensiQuery
            ->orderBy('created_at')
            ->get();

        return view('Layouts.Presensi.laporan', compact('presensis', 'kelas'));
    }
}
