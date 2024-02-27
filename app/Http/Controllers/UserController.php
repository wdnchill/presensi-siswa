<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
    $role = $request->input('role');

   
    $users = $role ? User::where('role', $role)->get() : User::all();

    return view('Layouts.User.index', compact('users'));
    
    }

    public function create()
    {
        return view('Layouts.User.create');
    }

    public function show()
    {
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email|email|max:50',
            'password' => 'required',
            'role' => 'required',
            'username' => 'required|unique:users,username',
            'imguser' => 'image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'username.required' => 'Kolom username wajib diisi.',
            'role.required' => 'Kolom role wajib diisi.',
            'name.required' => 'Kolom nama wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'name.unique' => 'nama user sudah terdaftar.',
            'username.unique' => 'username sudah terdaftar.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
            'password.required' => 'Kolom kata sandi wajib diisi.',
            'imguser.image' => 'Berkas yang diunggah harus berupa gambar.',
            'imguser.mimes' => 'Format gambar yang diizinkan adalah jpeg, jpg, dan png.',
            'imguser.max' => 'Gambar tidak boleh lebih dari 2048 kilobita.',
        ]);

        
        if ($request->hasFile('imguser')) {
            $imguserPath = $request->file('imguser')->store('images','public');
        }


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => $request->role,
            'username' => $request->username,
            'imguser' => $imguserPath ?? null,
        ]);

        notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Data user berhasil di tambahkan!');

        return redirect()->route('user.index');
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
            'password' => 'nullable',
            'username' => 'required|unique:users,username,' . $id . '|max:50',
            'imguser' => 'image|mimes:jpeg,jpg,png|max:2048',
        ],[
           'username.required' => 'Kolom username wajib diisi.',
        'role.required' => 'Kolom role wajib diisi.',
        'name.required' => 'Kolom nama wajib diisi.',
        'email.required' => 'Kolom email wajib diisi.',
        'email.unique' => 'Email sudah terdaftar.',
        'username.unique' => 'Username sudah terdaftar.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
        'username.max' => 'Username tidak boleh lebih dari 50 karakter.',
        'imguser.image' => 'Berkas yang diunggah harus berupa gambar.',
        'imguser.mimes' => 'Format gambar yang diizinkan adalah jpeg, jpg, dan png.',
        'imguser.max' => 'Gambar tidak boleh lebih dari 2048 kilobita.',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('imguser')) {
            $imguserPath = $request->file('imguser')->store('images','public');
            
               if ($user->imguser) {
                Storage::delete($user->imguser);
                }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
            'username' => $request->username,
            'imguser' => $imguserPath ?? $user->imguser,
        ]);

         notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Data user berhasil di update!');

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);


        if ($user->imguser) {
            Storage::delete($user->imguser);
        }

        $user->delete();

          notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Data user berhasil di hapus!');

        return redirect()->route('user.index');
    }
}
