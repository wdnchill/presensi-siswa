<?php

namespace App\Http\Controllers;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Mapel::all();

        return view('Layouts.Mapel.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Layouts.Mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
               $mapel = Mapel::findOrFail($id);

               return view('Layouts.Mapel.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
         $mapel = Mapel::findOrFail($id);

         
         $mapel->delete();

       
         return redirect()->route('mapel.index')->with(['success' => 'Data Berhasil Dihapus!']);
        
    }
}
