<?php

namespace App\Http\Controllers;
use App\Models\Mapel;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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
        $this->validate($request,[
            'namaMapel' => 'required',
        ]);

        Mapel::create([
            'namaMapel' => $request->namaMapel,            
        ]);        

        return redirect()->route('mapel.index')->with(['success' => 'Data Berhasil Ditambahkan!']);
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
               $mapel = Mapel::findOrFail($id);

               return view('Layouts.Mapel.edit', compact('mapel'));
    }


    public function update(Request $request, string $id)
    {
     
    $this->validate($request, [
        'namaMapel' => 'required',
    ]);

   
    $mapel = Mapel::findOrFail($id);
    $mapel->update([
        'namaMapel' => $request->namaMapel,
    ]);

 
    return redirect()->route('mapel.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


   public function destroy(string $id)
{
    $mapel = Mapel::findOrFail($id);
    $presensiCount = $mapel->mapels()->count();
    
    if ($presensiCount > 0) {
        return redirect()->back()->with(['error' => 'Tidak dapat menghapus data mapel karena ada data terkait dalam tabel presensi. Silahkan hapus data presensi yang berkaitan terlebih dahulu.']);
    }
    
    $mapel->delete();
    
    return redirect()->route('mapel.index')->with(['success' => 'Data Berhasil Dihapus!']);
}

}
