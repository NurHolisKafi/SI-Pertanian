<?php

namespace App\Http\Controllers;

use App\Models\DetailKebutuhanTanam;
use App\Models\Kebutuhan;
use App\Models\LuasTanah;
use App\Models\Tanaman;
use BotMan\BotMan\Messages\Outgoing\Actions\Select;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KebutuhanTanamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tanaman::select('tanaman.id_tanaman', 'nama')
            ->join('detail_kebutuhan_tanam', 'tanaman.id_tanaman', '=', 'detail_kebutuhan_tanam.id_tanaman')
            ->distinct()
            ->get();

        return view('page.admin.kebutuhanTanam.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataTanaman = Tanaman::all();
        $dataBahan = Kebutuhan::all();
        return view('page.admin.kebutuhanTanam.create', compact('dataTanaman', 'dataBahan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanaman = Tanaman::find($request->post('jenis_tanaman'));
        $data = $request->validate([
            'bahan.*' => 'required',
            'jumlah.*' => 'required|integer|numeric|min:1',
            'jenis_tanaman' => 'required|unique:detail_kebutuhan_tanam,id_tanaman',
            'luas' => 'required'
        ], [
            'jenis_tanaman.unique' => 'Data kebutuhan untuk tanaman ' . $tanaman->nama . ' sudah ada'
        ]);
        $minLuas = LuasTanah::firstOrCreate([
            'luas' => $data['luas']
        ]);
        $kebutuhans = [];

        foreach ($data['bahan'] as $key => $value) {
            $kebutuhans[$value] = (int) $data['jumlah'][$key];
        }

        foreach ($kebutuhans as $idBahan => $jum) {
            $tanaman->kebutuhan()->attach($idBahan, ['id_luas' => $minLuas['id_luas'], 'jumlah' => $jum]);
        }

        return redirect()->route('kebutuhantanam.index')->with('success', 'Berhasil menambahkan data');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataTanaman = Tanaman::all();
        $dataBahan = Kebutuhan::all();
        $tanamanById = Tanaman::where('id_tanaman', $id)->first();
        $MinLuas = LuasTanah::where('tanaman.id_tanaman', $id)
            ->join('detail_kebutuhan_tanam', 'detail_kebutuhan_tanam.id_luas', '=', 'luas_tanah.id_luas')
            ->join('tanaman', 'tanaman.id_tanaman', '=', 'detail_kebutuhan_tanam.id_tanaman')
            ->min('luas');

        $listBahan = Kebutuhan::select('detail_kebutuhan_tanam.id_detail_kebutuhan as id', 'kebutuhan_tanam.id_kebutuhan', 'jumlah')
            ->join('detail_kebutuhan_tanam', 'detail_kebutuhan_tanam.id_kebutuhan', '=', 'kebutuhan_tanam.id_kebutuhan')
            ->join('luas_tanah', 'luas_tanah.id_luas', '=', 'detail_kebutuhan_tanam.id_luas')
            ->where('id_tanaman', $id)
            ->where('luas_tanah.luas', $MinLuas)
            ->get();
        // dd($listBahan);
        $jumBahan = count($listBahan);
        return view('page.admin.kebutuhanTanam.update', compact('dataTanaman', 'dataBahan', 'tanamanById', 'listBahan', 'MinLuas', 'jumBahan'));
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
        $tanaman = Tanaman::find($id);
        $data = $request->validate([
            'bahan.*' => 'required',
            'jumlah.*' => 'required|integer|numeric|min:1',
            'jenis_tanaman' => 'required|unique:detail_kebutuhan_tanam,id_tanaman,' . $id . ',id_tanaman',
            'luas' => 'required'
        ], [
            'jenis_tanaman.unique' => 'Data kebutuhan untuk tanaman ' . $tanaman->nama . ' sudah ada'
        ]);

        $minLuas = LuasTanah::firstOrCreate([
            'luas' => $data['luas']
        ]);

        if ($request->has('new_bahan')) {
            $newData = $request->validate([
                'new_bahan.*' => 'required',
                'new_jumlah.*' => 'required|integer|numeric|min:1',
            ]);

            $kebutuhans = [];

            foreach ($newData['new_bahan'] as $key => $value) {
                $kebutuhans[$value] = (int) $newData['new_jumlah'][$key];
            }

            foreach ($kebutuhans as $idBahan => $jum) {
                $tanaman->kebutuhan()->attach($idBahan, ['id_luas' => $minLuas['id_luas'], 'jumlah' => $jum]);
            }
        }

        if ($request->has('delete_bahan')) {
            DetailKebutuhanTanam::destroy($request->post('delete_bahan'));
        }

        for ($i = 0; $i < count($request->post('id')); $i++) {
            DetailKebutuhanTanam::where('id_detail_kebutuhan', $request->post('id')[$i])->update([
                'id_kebutuhan' => $data['bahan'][$i],
                'jumlah' => $data['jumlah'][$i],
                'id_luas' => $minLuas->id_luas,
                'id_tanaman' => $data['jenis_tanaman']
            ]);
        }

        return redirect()->route('kebutuhantanam.index')->with('success', 'Berhasil mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tanaman = Tanaman::find($id);
        $tanaman->kebutuhan()->detach();
        return back()->with('success', 'Berhasil menghapus data');
    }

    //mendapatkan data bahan untuk setiap tanaman 
    function getDataKebutuhan($id)
    {
        $kebutuhan = Kebutuhan::select('kebutuhan_tanam.id_kebutuhan', 'kebutuhan_tanam.nama', 'harga')
            ->join('detail_kebutuhan_tanam', 'detail_kebutuhan_tanam.id_kebutuhan', '=', 'kebutuhan_tanam.id_kebutuhan')
            ->join('tanaman', 'tanaman.id_tanaman', '=', 'detail_kebutuhan_tanam.id_tanaman')
            ->where('tanaman.id_tanaman', '=', $id)
            ->distinct()
            ->get();
        return response()->json($kebutuhan);
    }
}
