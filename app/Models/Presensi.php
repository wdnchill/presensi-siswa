<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['presensi', 'user_id', 'kelas_id','siswa_id'];

    public function siswas()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id'); // Correct the foreign key reference to 'siswa_id'
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id'); 
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}