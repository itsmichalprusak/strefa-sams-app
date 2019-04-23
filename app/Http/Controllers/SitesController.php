<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function base(){
        return view('Base.Main');
    }

    public function home(){

        $patients = DB::select('SELECT patients.name, patients.surname, patients.isinsured, patients.email, patients.phonenumber, patients.birthdate, patients.comments, bloodgroups.bloodgroup 
                                FROM patients, bloodgroups
                                WHERE patients.bloodgroupid = bloodgroups.id
                                ');

        return view('home', ['patients'=>$patients]);
    }
}
