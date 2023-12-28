<?php

namespace App\Http\Controllers;

use App\Models\JenisKebutuhan;
use App\Models\Kebutuhan;
use Illuminate\Http\Request;

class BahanTanamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kebutuhan::select('id_kebutuhan', 'nama', 'harga', 'jenis_kebutuhan.kategori')
            ->join('jenis_kebutuhan', 'jenis_kebutuhan.id_jenis', '=', 'kebutuhan_tanam.id_jenis')
            ->get();
        $kategori = JenisKebutuhan::all();
        return view('page.admin.bahan-tanam', compact('data', 'kategori'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'bahan' => 'required|unique:kebutuhan_tanam,nama',
            'harga' => 'required|integer|numeric|min:1',
            'kategori' => 'required'
        ], [
            'bahan.unique' => 'Bahan atau Peralatan Sudah Ada'
        ]);

        Kebutuhan::create([
            'nama' => $data['bahan'],
            'harga' => $data['harga'],
            'id_jenis' => $data['kategori']
        ]);

        return back()->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'bahan' => 'required|unique:kebutuhan_tanam,nama,' . $id . ',id_kebutuhan',
            'harga' => 'required|integer|numeric|min:1',
            'kategori' => 'required'
        ], [
            'bahan.unique' => 'Bahan atau Peralatan Sudah Ada'
        ]);

        Kebutuhan::where('id_kebutuhan', $id)->update([
            'nama' => $data['bahan'],
            'harga' => $data['harga'],
            'id_jenis' => $data['kategori']
        ]);

        return back()->with('success', 'Berhasil Mengubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kebutuhan::destroy($id);
        return back()->with('success', 'Berhasil Menghapus Data');
    }
}
