<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'siswa_id'); 
    }
    
}
