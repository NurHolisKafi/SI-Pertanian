<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request;

class TanamanController extends Controller
{

    public function index()
    {
        $data = Tanaman::all();
        return view('page.admin.jenis-tanaman', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanaman' => 'required|unique:tanaman,nama|regex:/^[a-zA-Z]+$/'
        ], [
            'tanaman.unique' => 'Nama sudah ada',
            'tanaman.regex' => 'Nama tidak valid'
        ]);

        Tanaman::create([
            'nama' => $data['tanaman']
        ]);

        return back()->with('success', 'Tanaman Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'update-tanaman' => 'required|unique:tanaman,nama|regex:/^[a-zA-Z]+$/'
        ], [
            'update-tanaman.unique' => 'Nama sudah ada',
            'update-tanaman.regex' => 'Nama tidak valid'
        ]);

        Tanaman::where('id_tanaman', $id)->update([
            'nama' => $data['update-tanaman']
        ]);

        return back()->with('success', 'Tanaman Berhasil Diubah');
    }


    public function destroy($id)
    {
        Tanaman::destroy($id);
        return back()->with('success', 'Tanaman Berhasil dihapus');
    }
}
