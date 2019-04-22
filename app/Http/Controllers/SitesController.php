<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index(){
        return view('Select');
    }

    public function add(){
        return view('Base.Add');
    }

    public function insurance(){
        return view('Insurances.List');
    }

    public function search(){
        return view('Search');
    }

    public function Base(){
        return view('Base.Main');
    }
}
