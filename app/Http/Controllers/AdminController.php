<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function Login()
    {
        return view('page.admin.login');
    }

    function Dashboard()
    {
        return view('page.admin.dashboard');
    }

    function ViewUserUmum()
    {
        return view('page.admin.umum');
    }

    function ViewUserPetani()
    {
        return view('page.admin.petani');
    }
}
