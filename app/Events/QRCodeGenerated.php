<?php
namespace App\Events;

use App\Models\Kelas;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QRCodeGenerated
{
    use Dispatchable, SerializesModels;

    public $kelas;

    public function __construct(Kelas $kelas)
    {
        $this->kelas = $kelas;
    }
}
