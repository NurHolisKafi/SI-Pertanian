<?php

namespace App\Http\Controllers;

use App\Models\Budidaya;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BudidayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tanaman::join('budidaya', 'budidaya.id_tanaman', '=', 'tanaman.id_tanaman')
            ->select('budidaya.id', 'nama', 'thumbnail')
            ->get();
        $jenis_tanaman = Tanaman::all();
        return view('page.admin.budidaya', compact('data', 'jenis_tanaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_tanaman' => 'required',
            'tahapan' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png'
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumnail = $request->file('thumbnail');
            $new_name = Str::random('10') . '.' . $thumnail->getClientOriginalExtension();
            $thumnail->storeAs('public/tanaman', $new_name);
        }

        $validatedData['thumbnail'] = $new_name;

        Budidaya::create($validatedData);
        return back()->with('success', 'Berhasil menambahkan data');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Budidaya  $budidaya
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budidaya $budidaya)
    {
        $validate = $request->validate([
            'id_tanaman' => 'required',
            'tahapan' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png|nullable'
        ]);

        $budidaya->update([
            'id_tanaman' => $validate['id_tanaman'],
            'tahapan' => $validate['tahapan']
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $new_name = Str::random('10') . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('public/tanaman', $new_name);

            $budidaya->update([
                'thumbnail' => $new_name
            ]);

            if (Storage::disk('budidaya')->exists($request->post('old_thumbnail'))) {
                Storage::disk('budidaya')->delete($request->post('old_thumbnail'));
            }
        }

        return back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budidaya  $budidaya
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budidaya $budidaya)
    {
        if (Storage::disk('budidaya')->exists($budidaya->thumbnail)) {
            Storage::disk('budidaya')->delete($budidaya->thumbnail);
        }
        $budidaya->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }

    //RESPONSE

    public function show(Budidaya $budidaya)
    {
        return response()->json($budidaya);
    }

    public function show_thumbnail(string $filename)
    {
        $file = storage_path('app/public/tanaman/' . $filename);
        return response()->file($file);
    }
}
