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
        // Generate QR code with dynamic class ID in the route
        $qrCode = QrCode::format('png')->generate(url("/presensi/{$kelas->id}"));

        // Define the output file path
        $outputFile = '/qrCodekelas/qr-' . $kelas->id . '.png';

        // Save the QR code to storage
        Storage::disk('public')->put($outputFile, $qrCode);

        // Update the QR code path in the Kelas model
        $kelas->update(['qrCode' => $outputFile]);

        // Fire an event to notify that QR code has been generated
        event(new QRCodeGenerated($kelas));

        return redirect()->route('kelas.index')->with(['success' => 'QR Code generated successfully']);
    }
}
