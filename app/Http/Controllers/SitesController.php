<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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

    public function addemployee(Request $req){


        $name = $req->input('name');
        $surname = $req->input('surname');
        $rank = $req->input('rank');
        $BirthDate = $req->input('date');
        $PhoneNumber = $req->input('phonenumber');

        $data = array('Name' => $name, 'Surname' => $surname, 'Rank' => $rank, 'BirthDate' => $BirthDate, 'PhoneNumber' => $PhoneNumber);

        DB::table('employees') -> insert($data);

        return redirect('home');
    }

    public function addpatient(Request $req){

        $name = $req->input('Name');
        $surname = $req->input('Surname');
        $email = $req->input('Email');
        $phonenumber = $req->input('PhoneNumber');
        $birthdate = $req->input('date');
        $comments = $req->input('Comments');
        $bloodgroup = $req->input('BloodGroup');

        $data = array('Name' => $name, 'Surname' => $surname, 'IsInsured' => 0, 'Email' => $email, 'PhoneNumber' => $phonenumber, 'BirthDate' => $birthdate, 'Comments' => $comments, 'BloodGroupID' => $bloodgroup);

        DB::table('patients') -> insert($data);

        return redirect('home');
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
        $cardindexes = DB::select('SELECT patients.Id, patients.Name, patients.Surname, cardindexes.Annotation, 
                                        cardindexes.Date, employees.Id as emId, employees.Name as emName, employees.Surname as emSurname, 
                                        treatments.TreatmentCategory, cardindexes.Price, cardindexes.IsPaid, 
                                        cardindexes.Recognition, cardindexes.Treatment 
                                    FROM patients, cardindexes, treatments, employees 
                                    WHERE cardindexes.PatientId = patients.Id 
                                    AND cardindexes.SupervisingDoctor = employees.Id 
                                    AND cardindexes.TreatmentCategoryId = treatments.Id
                                ');

        return view('home', ['patients'=>$patients, 'cardindexes'=>$cardindexes]);
    }

    public function user(){

        $id = Input::get('id');
        $emid = Input::get('emId');

        $patients = DB::select('SELECT patients.name, patients.surname, patients.isinsured, patients.email, patients.phonenumber, patients.birthdate, patients.comments, bloodgroups.bloodgroup 
                                FROM patients, bloodgroups
                                WHERE patients.bloodgroupid = bloodgroups.id
                                AND patients.id = :id', [$id]
                                );
        $employees = DB::select('SELECT employees.Name, employees.Surname, employees.LastPromotion, 
                                        employees.Rank, employees.BirthDate, employees.PhoneNumber, employees.UnderSupervision 
                                FROM employees 
                                WHERE employees.Id = :emId', [$emid]
                                );

        return view('profiles.user', ['patients'=>$patients, 'id'=>$id, 'emid'=>$emid, 'employees'=>$employees]);
    }

    public function patient(){



        return view('Base.Patient');
    }

}
