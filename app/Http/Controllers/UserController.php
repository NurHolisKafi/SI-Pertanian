<?php

namespace App\Http\Controllers;

use App\Models\News;
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

    function profile_petani(): View
    {
        return view('page.petani.profile');
    }

    function profile_umum(): View
    {
        return view('page.umum.profile');
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

        return redirect()->route('login.umum')->with('success', 'Berhasil Registrasi');
    }

    function store_register_petani(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email:rfc|unique:users,email',
            'jenis_kelamin' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
            'notelp' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
            'role' => 'required',
            'profesi' => 'required',
            'organisasi' => 'required'
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
            'notelp' => $data['notelp'],
            'profesi' => $data['profesi'],
            'organisasi_petani' => $data['organisasi'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);

        return redirect()->route('login.petani')->with('success', 'Berhasil Registrasi');
    }

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

    function view_image($filename)
    {
        $file = storage_path('app/public/profile/' . $filename);
        return response()->file($file);
    }

    function test()
    {
        $usersByMonthAndYear = News::select(DB::raw('YEAR(tanggal_posting) as year'), DB::raw('MONTH(tanggal_posting) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->get();
        dd($usersByMonthAndYear);
    }
}
