<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id'); 
    }

    public function siswas()
    {
        return $this->hasMany(Presensi::class, 'siswa_id');
    }

}
