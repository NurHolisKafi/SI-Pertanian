<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ChatController extends Controller
{
    function umum(): View
    {
        return view('page.umum.chat');
    }

    function petani(): View
    {
        return view('page.petani.chat');
    }
}
