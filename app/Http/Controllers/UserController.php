<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Layouts.User.index', compact('users'));
    }

    public function create()
    {
        return view('Layouts.User.create');
    }

     public function show()
     {
         $users = User::all();
        return view('Layouts.User.history', compact('users'));
     }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email|email|max:50',
        'password' => 'required',
        'role' => 'required',
        'imguser' => 'image|mimes:jpeg,jpg,png|max:2048',
    ], [
        'role.required' => 'Kolom role wajib diisi.',
        'name.required' => 'Kolom nama wajib diisi.',
        'email.required' => 'Kolom email wajib diisi.',
        'email.unique' => 'Email sudah terdaftar.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
        'password.required' => 'Kolom kata sandi wajib diisi.',
        'imguser.image' => 'Berkas yang diunggah harus berupa gambar.',
        'imguser.mimes' => 'Format gambar yang diizinkan adalah jpeg, jpg, dan png.',
        'imguser.max' => 'Gambar tidak boleh lebih dari 2048 kilobita.',
    ]);
    

    $imguser = $request->file('imguser');
    $imguser = $imguser->storeAs('images', $imguser->hashName());

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'imguser' => $imguser,
    ]);

    return redirect()->route('user.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
}


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Layouts.User.edit', compact('user'));
    }

  public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email,' . $id . '|email|max:50',
        'password' => 'required',
        'imguser' => 'image|mimes:jpeg,jpg,png|max:2048',
    ]);

    $user = User::findOrFail($id);

    if ($request->hasFile('imguser')) {

        $imguser = $request->file('imguser');

      
        $imguserPath = $imguser->store('images', 'public');

       
        if ($user->imguser) {
            Storage::disk('public')->delete($user->imguser);       
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'imguser' => $imguserPath,
        ]);

    } else {

   
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
    }

    return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diubah!']);
}



    public function destroy($id)
    {
        $user = User::findOrFail($id);

          Storage::disk('public')->delete($user->imguser);

        $user->delete();

        return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
