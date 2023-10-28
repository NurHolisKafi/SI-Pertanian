<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allNews = News::all();
        return view('page.admin.news', ['data' => $allNews]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'tanggal' => 'required|date',
            'thumbnail' => 'required|image',
            'deskripsi' => 'required'
        ]);

        $thumbnail = $request->file('thumbnail');
        $new_name = Str::random(10) . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->storeAs('public/news', $new_name);
        News::create([
            'judul' => $data['title'],
            'tanggal_posting' => $data['tanggal'],
            'thumbnail' => $new_name,
            'isi_berita' => $data['deskripsi']
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan berita');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'tanggal' => 'required|date',
            'deskripsi' => 'required'
        ]);

        if ($request->has('thumbnail')) {
            $request->validate([
                'thumbnail' => 'image'
            ]);

            $thumbnail = $request->file('thumbnail');
            $new_name = Str::random(10) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('public/news', $new_name);
            News::where('id_berita', $request->post('id'))->update([
                'thumbnail' => $new_name
            ]);

            if (Storage::disk('news')->exists($request->post('old_thumbnail'))) {
                Storage::disk('news')->delete($request->post('old_thumbnail'));
            }
        }

        News::where('id_berita', $request->post('id'))->update([
            'judul' => $data['title'],
            'tanggal_posting' => $data['tanggal'],
            'isi_berita' => $data['deskripsi'],
        ]);


        return redirect()->back()->with('success', 'Berhasil mengupdate berita');
    }

    public function destroy(string $id)
    {
        $data = News::where('id_berita', $id)->select('thumbnail')->first();
        if (Storage::disk('news')->exists($data['thumbnail'])) {
            Storage::disk('news')->delete($data['thumbnail']);
        }
        News::destroy($id);
        return redirect()->back()->with('success', 'Berhasil menghapus berita');
    }

    public function show_thumbnail(string $filename)
    {
        $file = storage_path('app/public/news/' . $filename);
        return response()->file($file);
    }
}
