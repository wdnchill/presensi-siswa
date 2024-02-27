<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ],[
            'file.required' => 'Silahkan masukan file excel data siswa',
            'file.mimes' => 'Maaf hanya bisa memasukan file bertipe xlsx dan xls'
        ]);

        $file = $request->file('file');

        try {
            Excel::import(new SiswaImport, $file);
            notyf()->addSuccess('Data Berhasil tersimpan.');
        } catch (\Exception $e) {
            notyf()->addError('Data Gagal tersimpan.');
        }

        return redirect()->back();
    }
}
