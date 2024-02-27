<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Siswa;
use App\Models\Kelas; 

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
       
        $kelas = Kelas::where('kelas', $row['kelas'])->first();

        if (!$kelas) {
            return null;
        }

        return new Siswa([
            'nisn' => $row['nisn'],
            'nis' => $row['nis'],
            'nama_lengkap' => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'kelas_id' => $kelas->id, 
        ]);
    }
}

