<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;


class AdminController extends Controller
{
   function index()
   {
     return view('Layouts.index');
   }
   function guru()  {
    return view('Layouts.Presensi.index');
  }
  function walas()  {
    return view('Layouts.Presensi.laporan');
  }
  function admin()  {
    return view('Layouts.index');
  }
}


