<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function Login()
    {
        return view('page.admin.login');
    }

    function Dashboard()
    {
        $allnews = News::count();
        $alluser = User::count();
        $userActive = User::where('active', true)->count();
        $userUmum = User::where('role', 1)->count();
        $userPetani = User::where('role', 2)->count();
        $userDivide = [$userUmum, $userPetani];

        return view('page.admin.dashboard', compact('allnews', 'alluser', 'userActive', 'userDivide'));
    }

    function ViewUserUmum()
    {
        $data = User::where('role', 1)->get();
        return view('page.admin.umum', compact('data'));
    }

    function ViewUserPetani()
    {
        $data = User::where('role', 2)->get();
        return view('page.admin.petani', compact('data'));
    }

    //UPDATE

    function updatePassUser(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required',
            'new_pass' => 'required|min:8'
        ]);

        User::where('id_user', $validate['id'])->update([
            'password' => Hash::make($validate['new_pass'])
        ]);

        return back()->with('success', 'Password Berhasil Diubah');
    }

    function deleteUser($id)
    {
        User::destroy($id);
        return back()->with('success', 'User Berhasil Dihapus');
    }

    function getDataUser($id)
    {
        $data = User::where('id_user', $id)->first();
        return response()->json($data);
    }
}
