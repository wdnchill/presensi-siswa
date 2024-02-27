<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::all();

        return view('Layouts.Mapel.index', compact('mapel'));
    }

    public function create()
    {
        return view('Layouts.Mapel.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'namaMapel' => 'required|unique:mapels,namaMapel',
        ], [
            'namaMapel.required' => 'Kolom Mapel wajib diisi.',
            'namaMapel.unique' => 'Mapel sudah terdaftar.',
        ]);

        Mapel::create([
            'namaMapel' => $request->namaMapel,
        ]);


        notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Data Berhasil Ditambahkan!');

        return redirect()->route('mapel.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $mapel = Mapel::findOrFail($id);

        return view('Layouts.Mapel.edit', compact('mapel'));
    }


    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'namaMapel' => 'required|unique:mapels,namaMapel,' . $id,
        ], [
            'namaMapel.required' => 'Kolom Mapel wajib diisi.',
            'namaMapel.unique' => 'Mapel sudah terdaftar.',
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'namaMapel' => $request->namaMapel,
        ]);

        notyf()->addSuccess('Data Berhasil Diubah!');

        return redirect()->route('mapel.index');
    }

    public function destroy(string $id)
    {
        $mapel = Mapel::findOrFail($id);
        $presensiCount = $mapel->mapels()->count();

        $mapel->delete();

        notyf()->position('x', 'right')->position('y', 'top')->addSuccess('Data Berhasil Dihapus!');

        return redirect()->route('mapel.index');
    }
}
