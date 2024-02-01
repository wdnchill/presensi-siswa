<?php

namespace App\Http\Controllers;

use App\Events\QRCodeGenerated;
use App\Models\Kelas;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class QRCodeController extends Controller
{
    public function generateQRCode(Kelas $kelas)
    {
        
        $qrCode = QrCode::format('png')->generate(url("/presensi/{$kelas->id}"));

        $outputFile = '/qrCodekelas/qr-' . $kelas->id . '.png';

        Storage::disk('public')->put($outputFile, $qrCode);

        $kelas->update(['qrCode' => $outputFile]);

        event(new QRCodeGenerated($kelas));

        return redirect()->route('kelas.index')->with(['success' => 'QR Code generated successfully']);
    }
}
