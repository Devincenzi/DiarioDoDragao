<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Localizacoes;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        $locais = Localizacoes::all();

        return view('home', compact('locais'));
    }

    public function login(){
        return view('login');
    }

    public function register(){
        return view('login');
    }
}
