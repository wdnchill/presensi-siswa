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
        'qrCode' => '',
    ]);

    $kelasId = $kelas->id;

    // Generate QR code with dynamic class ID in the route
    $qrCode = QRCode::format('png')->generate(url("/presensi/{$kelasId}"));

    // Define the output file path
    $outputFile = '/qrCodekelas/qr-' . $kelasId . '.png';

    // Save the QR code to storage
    Storage::disk('public')->put($outputFile, $qrCode);

    // Update the QR code path in the Kelas model
    $kelas->update(['qrCode' => $outputFile]);

    // Trigger the QRCodeGenerated event
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
    //validate form
    $this->validate($request, [
        'kelas' => 'required',
    ]);

    //get post by ID
    $kelas = Kelas::findOrFail($id);

    // Generate QR code with dynamic class ID in the route
    $qrCode = QRCode::format('png')->generate(url("/presensi/{$kelas->id}"));

    $outputFile = '/qrCodekelas/qr-' . $kelas->id . '.png';

    Storage::disk('public')->put($outputFile, $qrCode);

    // Delete the old QR code file
    Storage::disk('public')->delete($kelas->qrCode);

    // Update the nilai kelas based on the form data
    $kelas = Kelas::update([
        'kelas' => $request->kelas,
        'qrCode' => $outputFile,
    ]);

    // Trigger the QRCodeGenerated event
    event(new QRCodeGenerated($kelas));

    // Redirect to index
    return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Diubah!']);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas,$id)
    {
         //get post by ID
         $kelas = Kelas::findOrFail($id);
         $kelas->delete();

         Storage::disk('public')->delete($kelas->qrCode);
         return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Dihapus!']);


     }

    }

