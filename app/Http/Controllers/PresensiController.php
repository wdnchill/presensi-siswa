<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         // Retrieve presensi data with related siswas and kelas, sorted by created_at
         $presensis = Presensi::with('siswas', 'kelas','users')
             ->orderBy('created_at')
             ->get();

        
         $kelas = Kelas::all();

         $users = User::all();
         return view('Layouts.Presensi.index', compact('presensis', 'kelas' , 'users'));
     }


    public function create(Request $request)
    {
        // Build the query for Kelas
        $kelas = Kelas::all();
        $siswas = Siswa::all();
        $users = User::all();

        return view('Layouts.Presensi.create', compact('kelas', 'siswas','users'));
    }


    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
     {
       // Validate the input data
      $this->validate($request, [
          'siswa_id' => 'required',
          'kelas_id' => 'required',
          'user_id' => 'required',
          'presensi' => 'required|array',
          'presensi.*' => 'required|in:Hadir,Alfa,Sakit,Izin',
      ],[
        'presensi.required' => 'Kolom Presensi wajib diisi.',
        'presensi.*.required' => 'Kolom Presensi untuk setiap siswa wajib diisi.',
        'presensi.*.in' => 'Kolom Presensi untuk setiap siswa harus berisi Hadir, Alfa, Sakit, atau Izin.',

      ]);
      
  if ($request->user_id === 'Pilih Guru/Petugas' || count($request->presensi) === 0) {
        return redirect()->route('presensi.create')->with([
            'error' => 'Kolom Guru/Petugas Absen wajib diisi.'
        ])->withInput();
    }

      foreach ($request->presensi as $siswa_id => $presensi) {
          Presensi::create([
              'kelas_id' => $request->kelas_id,
              'siswa_id' => $siswa_id,
              'user_id'  => $request->user_id,
              'presensi' => $presensi,
          ]);
      }

      // Redirect back to the index page with a success message
      return redirect()->route('presensi.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
     }

    /**
     * Display the specified resource.
     */
  public function show($kelas_id)
{
    $presensis = Presensi::with('siswas', 'kelas')
        ->where('kelas_id', $kelas_id)->orderBy('created_at')->get();
    $kelas = Kelas::where('id', $kelas_id)->get();
    $siswas = Siswa::where('kelas_id', $kelas_id)->get();
    $users = User::all();

    return view('Layouts.Presensi.create', compact('presensis', 'kelas', 'siswas','users'));
}



   public function edit($id)
{
    $presensi = Presensi::with('siswas', 'kelas')->findOrFail($id);
    $users = User::all();
    $kelas = Kelas::all();
    $siswas = Siswa::all();
    return view('Layouts.Presensi.edit', compact('presensi','siswas','kelas','users'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'presensi' => 'required|in:Hadir,Alfa,Sakit,Izin',
            'user_id' => 'required',
            'kelas_id' => 'required',
        ]);

        $presensi = Presensi::findOrFail($id);

        $presensi->update([
            'presensi' => $request->presensi,
            'user_id' =>  $request->user_id,
            'kelas_id' => $request->kelas_id,
            'siswa_id' => $request->siswa_id, 
        ]);

        return redirect()->route('laporan')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $presensi = Presensi::findOrFail($id);

        $presensi->delete();

        return redirect()->route('laporan')->with(['success' => 'Data Berhasil Dihapus!']);
    }


    public function laporan()
    {
      // Build the query for Kelas
        $kelas = Kelas::all();
        $presensis = Presensi::with('siswas', 'kelas','users')->get();
        return view('Layouts.Presensi.laporan', compact('presensis', 'kelas'));

    }
    public function filter(Request $request)
    {

        // Validate the input data
        $request->validate([
            'TanggalMulai' => 'nullable|date',
            'TanggalSelesai' => 'nullable|date|after_or_equal:TanggalMulai',
            'kelas_id' => 'nullable|exists:kelas,id', // Add this validation rule for kelas_id
        ]);

        // Retrieve the input dates and kelas_id
        $TanggalMulai = $request->input('TanggalMulai');
        $TanggalSelesai = $request->input('TanggalSelesai');
        $kelas_id = $request->input('kelas_id');

        // Build the query for Kelas
        $siswas = Siswa::all();
        $kelas = Kelas::all();

        // Build the query for Presensi
        $presensiQuery = Presensi::with('siswas', 'kelas');

        // Filter by start date if provided
        if ($TanggalMulai) {
            $presensiQuery->whereDate('created_at', '>=', $TanggalMulai);
        }

        // Filter by end date if provided
        if ($TanggalSelesai) {
            $presensiQuery->whereDate('created_at', '<=', $TanggalSelesai);
        }

        // Filter by kelas_id if provided
        if ($kelas_id) {
            $presensiQuery->whereHas('kelas', function ($query) use ($kelas_id) {
                $query->where('id', $kelas_id);
            });
        }

        // Retrieve presensi data with related siswas and kelas, sorted by kelas
        $presensis = $presensiQuery
            ->orderBy('created_at') // Order by the created_at column
            ->get();

        return view('Layouts.Presensi.laporan', compact('presensis', 'kelas'));
    }


}
