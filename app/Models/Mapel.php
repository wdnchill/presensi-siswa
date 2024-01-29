<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

        protected $fillable = ['namaMapel'];

 public function mapels()
    {
        return $this->hasMany(Presensi::class, 'mapel_id');
    }

    
}
