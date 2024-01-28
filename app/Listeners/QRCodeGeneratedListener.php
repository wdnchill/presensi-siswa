<?php
namespace App\Listeners;

use App\Events\QRCodeGenerated;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class QRCodeGeneratedListener
{
    public function handle(QRCodeGenerated $event)
    {
        $kelas = $event->kelas;

        // Generate QR code with dynamic class ID in the route
        $qrCode = QrCode::format('png')->generate(url("/presensi/{$kelas->id}"));

        // Define the output file path
        $outputFile = '/qrCodekelas/qr-' . $kelas->id . '.png';

        // Save the QR code to storage
        Storage::disk('public')->put($outputFile, $qrCode);

        // Update the QR code path in the Kelas model
        $kelas->update(['qrCode' => $outputFile]);
    }
}
