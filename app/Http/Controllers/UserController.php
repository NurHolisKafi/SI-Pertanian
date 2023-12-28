<?php

namespace App\Http\Controllers;

use App\Models\DetailKebutuhanTanam;
use App\Models\HasilPerhitungan;
use App\Models\Kebutuhan;
use App\Models\LuasTanah;
use App\Models\News;
use App\Models\Tanaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    function profile(): View
    {
        return view('page.umum.profile');
    }

    function kalkulator_panen()
    {
        $dataPerhitungan = HasilPerhitungan::select('id_perhitungan as id', 'tanaman.nama as tanaman', 'luas_tanah.luas', 'modal')
            ->join('tanaman', 'tanaman.id_tanaman', '=', 'hasil_perhitungan.id_tanaman')
            ->join('luas_tanah', 'luas_tanah.id_luas', '=', 'hasil_perhitungan.id_luas')
            ->where('id_user', auth()->user()->id_user)
            ->orderByDesc('id_perhitungan')
            ->get();
        $dataTanaman = Tanaman::all();
        return view('page.umum.calc', compact('dataPerhitungan', 'dataTanaman'));
    }

    //INSERT
    function store_perhitungan_tanam(Request $request)
    {
        $data = $request->validate([
            'modal' => 'required|numeric:min:1',
            'luas' => 'required|numeric:min:1',
            'tanaman' => 'required'
        ]);

        $luas = LuasTanah::firstOrCreate([
            'luas' => $data['luas']
        ]);

        HasilPerhitungan::create([
            'id_user' => auth()->user()->id_user,
            'id_tanaman' => $data['tanaman'],
            'id_luas' => $luas['id_luas'],
            'modal' => $data['modal']
        ]);

        return back()->with('success', 'Berhasil menambahkan data');
    }
    function store_register_umum(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'jenis_kelamin' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'notelp' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required'
        ], [
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.confirmed' => 'Konfirmasi password salah'
        ],);

        User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => " {$data['alamat']} , {$data['kota']}",
            'password' => Hash::make($data['password']),
            'notelp' => $data['notelp'],
            'role' => $data['role']
        ]);

        return redirect()->route('login')->with('success', 'Berhasil Registrasi');
    }

    // function store_register_petani(Request $request)
    // {
    //     // dd($request->all());
    //     $data = $request->validate([
    //         'nama' => 'required',
    //         'email' => 'required|email:rfc|unique:users,email',
    //         'jenis_kelamin' => 'required',
    //         'kota' => 'required',
    //         'alamat' => 'required',
    //         'notelp' => 'required',
    //         'password' => ['required', 'confirmed', Password::min(8)],
    //         'role' => 'required',
    //         'profesi' => 'required',
    //         'organisasi' => 'required'
    //     ], [
    //         'email.email' => 'Email tidak valid',
    //         'email.unique' => 'Email sudah terdaftar',
    //         'password.confirmed' => 'Konfirmasi password salah'
    //     ],);

    //     User::create([
    //         'name' => $data['nama'],
    //         'email' => $data['email'],
    //         'jenis_kelamin' => $data['jenis_kelamin'],
    //         'alamat' => " {$data['alamat']} , {$data['kota']}",
    //         'notelp' => $data['notelp'],
    //         'profesi' => $data['profesi'],
    //         'organisasi_petani' => $data['organisasi'],
    //         'password' => Hash::make($data['password']),
    //         'role' => $data['role']
    //     ]);

    //     return redirect()->route('login.petani')->with('success', 'Berhasil Registrasi');
    // }

    //UPDATE

    function update_profileImage(Request $request)
    {
        $request->validate([
            'img_profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $file_image = $request->file('img_profile');
        $new_Imgname = Str::random(10) . '.' . $file_image->getClientOriginalExtension();
        $destPath = storage_path('app/public/profile');
        $img = Image::make($file_image->getRealPath());
        $img->resize(300, 300)->save($destPath . '/' . $new_Imgname);

        if (Storage::disk('img')->exists($request->post('old_image')) && $request->post('old_image') != 'default_profile.jpg') {
            Storage::disk('img')->delete($request->post('old_image'));
        }

        User::where('id_user', auth()->user()->id_user)->update([
            'image' => $new_Imgname
        ]);

        return back()->with('success', 'Gambar berhasil diubah.');
    }

    function update_profileInformation(Request $request)
    {
        if (auth()->user()->role == 1) {
            $data = $request->validate([
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'kota' => 'required',
                'alamat' => 'required',
                'notelp' => 'required',
                'email' => ['required', 'email:rfc,dns', Rule::unique('users')->ignore(auth()->user()->id_user, 'id_user')],
            ], [
                'email.email' => 'Email tidak valid',
            ],);

            User::where('id_user', auth()->user()->id_user)->update([
                'name' => $data['nama'],
                'email' => $data['email'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => " {$data['alamat']} , {$data['kota']}",
                'notelp' => $data['notelp'],
            ]);
        } else {
            // dd($request->all());
            $data = $request->validate([
                'nama' => 'required',
                'email' => ['required', 'email:rfc,dns', Rule::unique('users')->ignore(auth()->user()->id_user, 'id_user')],
                'jenis_kelamin' => 'required',
                'kota' => 'required',
                'alamat' => 'required',
                'notelp' => 'required',
                'profesi' => 'required',
                'organisasi' => 'required',
            ], [
                'email.email' => 'Email tidak valid',
            ],);

            User::where('id_user', auth()->user()->id_user)->update([
                'name' => $data['nama'],
                'email' => $data['email'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'profesi' => $data['profesi'],
                'organisasi_petani' => $data['organisasi'],
                'alamat' => " {$data['alamat']} , {$data['kota']}",
                'notelp' => $data['notelp'],
            ]);
        }


        return back()->with('success', 'Data berhasil diubah.');
    }

    function update_password(Request $request)
    {
        $data = $request->validate([
            'oldpass' => 'required|current_password',
            'newpass' => 'required|confirmed|min:8'
        ], [
            'oldpass.current_password' => 'Password sebelumnya salah',
            'newpass.confirmed' => 'Konfirmasi password salah'
        ]);

        User::where('id_user', auth()->user()->id_user)->update([
            'password' => Hash::make($data['newpass'])
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }

    //DELETE
    function remove_profileImage(Request $request)
    {
        if (Storage::disk('img')->exists($request->post('filename'))) {
            Storage::disk('img')->delete($request->post('filename'));
        }
        User::where('id_user', auth()->user()->id_user)->update([
            'image' => 'default_profile.jpg'
        ]);

        return back()->with('success', 'Gambar berhasil dihapus.');
    }

    function remove_perhitungan($id)
    {
        HasilPerhitungan::destroy($id);
        return back()->with('success', 'Data berhasil dihapus.');
    }

    //RESPONSE
    function view_image($filename)
    {
        $file = storage_path('app/public/profile/' . $filename);
        return response()->file($file);
    }

    function minLuasLahan($id)
    {
        $minLuas = LuasTanah::select(DB::raw('MIN(luas) as min_luas'))->join('detail_kebutuhan_tanam', 'detail_kebutuhan_tanam.id_luas', '=', 'luas_tanah.id_luas')->where('detail_kebutuhan_tanam.id_tanaman', $id)->first();
        return response()->json($minLuas);
    }

    function KebutuhanTanam($id)
    {
        $dataHasilHitung = HasilPerhitungan::select('luas_tanah.luas', 'id_tanaman', 'modal')
            ->where('id_perhitungan', $id)
            ->join('luas_tanah', 'luas_tanah.id_luas', '=', 'hasil_perhitungan.id_luas')
            ->first();
        // dd($dataHasilHitung);
        $kebutuhan = DetailKebutuhanTanam::select('kebutuhan_tanam.nama', 'kebutuhan_tanam.harga', 'kebutuhan_tanam.id_jenis', 'jumlah', 'luas_tanah.luas')
            ->join('kebutuhan_tanam', 'kebutuhan_tanam.id_kebutuhan', '=', 'detail_kebutuhan_tanam.id_kebutuhan')
            ->join('tanaman', 'tanaman.id_tanaman', '=', 'detail_kebutuhan_tanam.id_tanaman')
            ->join('luas_tanah', 'luas_tanah.id_luas', '=', 'detail_kebutuhan_tanam.id_luas')
            ->where('tanaman.id_tanaman', $dataHasilHitung['id_tanaman'])
            ->orderBy('kebutuhan_tanam.id_kebutuhan')
            ->get();


        $result = $kebutuhan->map(function ($res) use ($dataHasilHitung) {

            if ($res['id_jenis'] == 1) {
                $jumlah =  $dataHasilHitung['luas'] / ($res['luas'] / $res['jumlah']);
                $harga = $jumlah * $res['harga'];
            } else {
                $jumlah = $res['jumlah'];
                $harga = $res['harga'];
            }

            return [
                'nama' => $res['nama'],
                'jumlah' => $jumlah,
                'harga' => $harga
            ];
        });

        $hargaTotal = 0;
        foreach ($result as $value) {
            $hargaTotal += $value['harga'];
        }

        $sisaModal = $dataHasilHitung['modal'] - $hargaTotal;
        return view('page.umum.hasil-perhitungan', compact('result', 'hargaTotal', 'sisaModal'));
    }

    function test()
    {
        $tanaman = Tanaman::find(2);
        $kebutuhan = [
            1 => 5,
            2 => 10
        ];

        // foreach ($kebutuhan as $idKebutuhan => $jumlah) {
        //     $tanaman->kebutuhan()->attach($idKebutuhan, ['id_luas' => 1, 'jumlah' => $jumlah]);
        // }

        dd('berhasil');
    }
}
