<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Events\QRCodeGenerated;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelases = Kelas::all();

        return view('Layouts.Kelas.index', compact('kelases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Layouts.Kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $this->validate($request, [
        'kelas' => 'required',
    ],[
        'kelas.required' => 'Kolom Kelas wajib diisi.',
    ]);

    $kelas = Kelas::create([
        'kelas' => $request->kelas,
        'qrCode' => 'required',
    ]);

    $kelasId = $kelas->id;

   
    $qrCode = QRCode::format('png')->generate(url("/presensi/{$kelasId}"));

    
    $outputFile = '/qrCodekelas/qr-' . $kelasId . '.png';


    Storage::disk('public')->put($outputFile, $qrCode);

 
    $kelas->update(['qrCode' => $outputFile]);

  
    event(new QRCodeGenerated($kelas));

    return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('Layouts.Kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, string $id)
{
   
    $this->validate($request, [
        'kelas' => 'required',
    ]);

  
    $kelas = Kelas::findOrFail($id);

    
    $qrCode = QRCode::format('png')->generate(url("/presensi/{$kelas->id}"));

    $outputFile = '/qrCodekelas/qr-' . $kelas->id . '.png';

    Storage::disk('public')->put($outputFile, $qrCode);

   
    Storage::disk('public')->delete($kelas->qrCode);

  
    $kelas->update([
        'kelas' => $request->kelas,
        'qrCode' => $outputFile,
    ]);


    event(new QRCodeGenerated($kelas));


    return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Diubah!']);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas,$id)
    {
         
         $kelas = Kelas::findOrFail($id);
         $kelas->delete();

         Storage::disk('public')->delete($kelas->qrCode);
         return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Dihapus!']);


     }

    }

