<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Retorna simplemente el layout home
    function home(){
        return view('pages.home');
    }
}
