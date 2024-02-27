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

       
        $qrCode = QrCode::format('png')->generate(url("/presensi/{$kelas->id}"));

       
        $outputFile = '/qrCodekelas/qr-' . $kelas->id . '.png';

     
        Storage::disk('public')->put($outputFile, $qrCode);

        
        $kelas->update(['qrCode' => $outputFile]);
    }
}
