<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Presensi;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $users  = User::count();
        $siswas  = Siswa::count();
        $kelas  = Kelas::count();

        $absensiHariIni = Presensi::whereDate('created_at', Carbon::today())->count();

        return view('Layouts.index', compact('kelas', 'siswas', 'users', 'absensiHariIni'));
    }
}
