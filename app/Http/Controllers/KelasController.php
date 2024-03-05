<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Events\QRCodeGenerated;

class KelasController extends Controller
{
    public function index()
    {
        $kelases = Kelas::all();

        return view('Layouts.Kelas.index', compact('kelases'));
    }

    public function create()
    {
        return view('Layouts.Kelas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas' => 'required|unique:kelas,kelas',
        ], [
            'kelas.required' => 'Kolom Kelas wajib diisi.',
            'kelas.unique' => 'Maaf kelas yang anda masukan sudah terdaftar silahkan masukan kelas lain.',
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

        notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Data kelas berhasil di tambahkan!');
        notyf()->position('x', 'right')->position('y', 'top')->addSuccess('QrCode kelas berhasil di buat!');

        return redirect()->route('kelas.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('Layouts.Kelas.edit', compact('kelas'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'kelas' => 'required|unique:kelas,kelas,' . $id,
        ], [
            'kelas.required' => 'Kolom Kelas wajib diisi.',
            'kelas.unique' => 'Maaf kelas yang anda masukan sudah terdaftar silahkan masukan kelas lain.',
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

        notyf()->position('x', 'right')->position('y', 'top')->addSuccess('QrCode kelas berhasil di update!');
        notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Data kelas berhasil di update!');
 
        return redirect()->route('kelas.index');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $presensiCount = $kelas->presensi()->count();

        if ($kelas->qrCode) {
            Storage::disk('public')->delete($kelas->qrCode);
        }

        $kelas->delete();

        notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Data kelas berhasil di hapus!');

        return redirect()->route('kelas.index');
    }
}
