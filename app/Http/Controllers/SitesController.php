<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SitesController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index(){
        return view('Select');
    }

    public function add(){

        $employees = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname')
                            ->get();

        return view('Base.Add', ['employees' => $employees]);
    }

    public function addemployee(Request $req){


        $name = $req->input('name');
        $surname = $req->input('surname');
        $rank = $req->input('rank');
        $BirthDate = $req->input('date');
        $PhoneNumber = $req->input('phonenumber');
        $UnderSupervision = $req->input('UnderSupervision');

        $data = array('Name' => $name, 'Surname' => $surname, 'Rank' => $rank, 'BirthDate' => $BirthDate, 'PhoneNumber' => $PhoneNumber, 'UnderSupervision' => $UnderSupervision);

        DB::table('Employees') -> insert($data);

        return redirect(Route('EmployeesList'));
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

        DB::table('Patients') -> insert($data);

        return redirect(Route('PatientsList'));
    }

    public function insurance(){

        $insurances = DB::table('Insurances')
                            ->join('Patients', 'Patients.Id', '=', 'Insurances.PatientId')
                            ->join('Employees', 'Employees.Id', '=', 'Insurances.PersonIssuing')
                            ->select('Patients.Id', 'Insurances.InsuranceAmount', 'Insurances.Id as InId', 'Insurances.InsuranceDate')
                            ->orderByDesc('Insurances.InsuranceDate')
                            ->paginate(10);


        $now = time();

        $search = request('search');

        foreach($insurances as $insurance){
            if($insurance->InsuranceAmount == 800)
                $date1 = date('Y-m-d', strtotime("+7 day",strtotime($insurance->InsuranceDate)));
            elseif($insurance->InsuranceAmount == 1300)
                $date2 = date('Y-m-d', strtotime("+14 day",strtotime($insurance->InsuranceDate)));
            elseif($insurance->InsuranceAmount == 2200)
                $date3 = date('Y-m-d', strtotime("+30 day",strtotime($insurance->InsuranceDate)));

            if(isset($date1)){
                if (round((((strtotime($date1) - $now) / 24) / 60) / 60) < 0) {
                    DB::table('Insurances')
                            ->where('Id', '=', $insurance->InId)
                            ->delete();
                    DB::table('Patients')
                            ->where('Id', '=', $insurance->Id)
                            ->update(array('IsInsured' => '0', 'InsuranceId' => NULL));
                }
            }

            if(isset($date2)){
                if (round((((strtotime($date2) - $now) / 24) / 60) / 60) < 0) {
                    DB::table('Insurances')
                            ->where('Id', '=', $insurance->InId)
                            ->delete();
                    DB::table('Patients')
                            ->where('Id', '=', $insurance->Id)
                            ->update(array('IsInsured' => '0', 'InsuranceId' => NULL));
                }
            }

            if(isset($date3)){
                if (round((((strtotime($date3) - $now) / 24) / 60) / 60) < 0) {
                    DB::table('Insurances')
                            ->where('Id', '=', $insurance->InId)
                            ->delete();
                    DB::table('Patients')
                            ->where('Id', '=', $insurance->Id)
                            ->update(array('IsInsured' => '0', 'InsuranceId' => NULL));
                }
            }
        }

        $insurancesTwo = DB::table('Insurances')
                            ->join('Patients', 'Patients.Id', '=', 'Insurances.PatientId')
                            ->join('Employees', 'Employees.Id', '=', 'Insurances.PersonIssuing')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Insurances.InsuranceAmount', 'Insurances.Id as InId',
                                'Insurances.InsuranceDate', 'Employees.Id as emId', 'Employees.Name as emName', 'Employees.Surname as emSurname')
                            ->where('Patients.Surname', 'LIKE', '%' . $search . '%')
                            ->orderByDesc('Insurances.InsuranceDate')
                            ->paginate(10);

        $patients = DB::table('Patients')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured')
                            ->get();

        $employees = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname')
                            ->get();

        return view('Insurances.list', ['insurances' => $insurancesTwo, 'patients' => $patients, 'employees' => $employees, 'search' => $search]);
    }

    public function home(){

        $cardindexes = DB::table('CardIndexes')
                            ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                            ->join('Employees', 'Employees.Id', '=', 'CardIndexes.SupervisingDoctor')
                            ->join('Treatments', 'Treatments.Id', '=', 'TreatmentCategoryId')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Employees.Id as emId', 'Employees.Name as emName',
                                'Employees.Surname as emSurname', 'Treatments.TreatmentCategory', 'Treatments.Id as TreatmentId', 'CardIndexes.Id as CardId', 'CardIndexes.Annotation', 'CardIndexes.Date', 'CardIndexes.Price',
                                'CardIndexes.IsPaid', 'CardIndexes.Recognition', 'CardIndexes.Treatment')
                            ->orderByDesc('CardIndexes.Date')
                            ->paginate(7);

        $patients = DB::table('Patients')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured')
                            ->where('Patients.Registered', '=', '1')
                            ->get();

        $employees = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname')
                            ->get();

        $treatments = DB::table('Treatments')
                            ->select('Treatments.Id', 'Treatments.TreatmentCategory', 'Treatments.UnInsurancePriceMin',
                                'Treatments.UnInsurancePriceMax', 'Treatments.InsurancePriceMin',
                                'Treatments.InsurancePriceMax', 'Treatments.Description')
                            ->get();

        return view('home', ['cardindexes'=>$cardindexes, 'patients' => $patients, 'employees' => $employees, 'treatments' => $treatments]);
    }

    public function user(){

        $id = Input::get('id');
        $emid = Input::get('emId');

        $patients = DB::table('Patients')
                            ->join('BloodGroups', 'BloodGroups.Id', '=', 'Patients.BloodGroupId')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured', 'Patients.Email',
                                'Patients.PhoneNumber', 'Patients.BirthDate', 'Patients.Comments', 'Patients.BloodGroupId', 'BloodGroups.BloodGroup')
                            ->where('Patients.Id', '=', $id)
                            ->get();

        $employees = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname', 'Employees.LastPromotion',
                                        'Employees.Rank', 'Employees.BirthDate', 'Employees.PhoneNumber', 'Employees.UnderSupervision')
                            ->where('Employees.Id', '=', $emid)
                            ->get();

        $supervision = DB::table('Employees')
                            ->select('Employees.Name', 'Employees.Surname')
                            ->where('Employees.UnderSupervision', '=', 'Employees.Id')
                            ->where('Employees.Id', '=', $emid)
                            ->get();

        $employeestwo = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname', 'Employees.LastPromotion',
                                'Employees.Rank', 'Employees.BirthDate', 'Employees.PhoneNumber', 'Employees.UnderSupervision')
                            ->get();

        $patientstwo = DB::table('Patients')
                            ->select('Patients.*')
                            ->where('Patients.Registered', '=', '1')
                            ->get();

        $treatments = DB::table('Treatments')
                            ->select('Treatments.Id', 'Treatments.TreatmentCategory', 'Treatments.UnInsurancePriceMin',
                                        'Treatments.UnInsurancePriceMax', 'Treatments.InsurancePriceMin',
                                        'Treatments.InsurancePriceMax', 'Treatments.Description')
                            ->get();

        $cardindexes = DB::table('CardIndexes')
                            ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                            ->join('Employees', 'Employees.Id', '=', 'CardIndexes.SupervisingDoctor')
                            ->join('Treatments', 'Treatments.Id', '=', 'CardIndexes.TreatmentCategoryId')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'CardIndexes.Annotation',
                                        'CardIndexes.Date', 'Employees.Id as emId', 'Employees.Name as emName', 'Employees.Surname as emSurname',
                                        'Treatments.TreatmentCategory', 'CardIndexes.Id as CardId', 'CardIndexes.Price', 'CardIndexes.IsPaid',
                                        'Treatments.Description', 'CardIndexes.Recognition', 'CardIndexes.Treatment', 'Treatments.Id as TreatmentId')
                            ->where('Patients.Id', '=', $id)
                            ->orderByDesc('CardIndexes.Date')
                            ->paginate(10);

        $cards = DB::table('CardIndexes')
                            ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                            ->join('Employees', 'Employees.Id', '=', 'CardIndexes.SupervisingDoctor')
                            ->join('Treatments', 'Treatments.Id', '=', 'CardIndexes.TreatmentCategoryId')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'CardIndexes.Annotation', 'CardIndexes.Id as CardId',
                                            'CardIndexes.Date', 'Treatments.TreatmentCategory', 'Treatments.Description', 'CardIndexes.Price', 'Employees.Id as emId',
                                            'CardIndexes.IsPaid', 'CardIndexes.Recognition', 'CardIndexes.Treatment', 'Treatments.Id as TreatmentId')
                            ->where('CardIndexes.SupervisingDoctor', '=', $emid)
                            ->orderByDesc('CardIndexes.Date')
                            ->paginate(10);

        return view('profiles.user', ['patients'=>$patients, 'id'=>$id, 'emid'=>$emid, 'employees'=>$employees, 'cardindexes'=>$cardindexes, 'cards' => $cards, 'treatments' => $treatments, 'employeestwo' => $employeestwo, 'patientstwo' => $patientstwo, 'supervision' => $supervision]);
    }

    public function patient(){

        return view('Base.Patient');
    }

    public function addinsurance(){

        $employees = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname')
                            ->get();

        $patients = DB::table('Patients')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname')
                            ->where('Patients.Registered', '=', '1')
                            ->whereNotIn('Id', function ($query){
                                $query->select('PatientId')->from('Insurances');
                            })
                            ->get();

        return view('Base.Insurance', ['employees' => $employees, 'patients' => $patients]);
    }

    public function addinsurancedb(Request $req){

        $PatientId = $req->input('PatientId');
        $InsuranceId = $req->input('InsuranceId');
        $InsuranceAmount = $req->input('InsurancePrice');
        $InsuranceDate = $req->input('Date');
        $PersonIssuing = $req->input('PersonIssuing');

        $data = array('PatientId' => $PatientId, 'InsuranceAmount' => $InsuranceAmount, 'InsuranceDate' => $InsuranceDate, 'PersonIssuing' => $PersonIssuing);

        DB::update('UPDATE Patients SET IsInsured = 1 WHERE Id= :PatientId', [$PatientId]);

        DB::update('UPDATE Patients SET InsuranceID = :InsuranceId WHERE Id= :PatientId', [$InsuranceId, $PatientId]);

        DB::table('Insurances') -> insert($data);

        return redirect(Route('insurance'));
    }

    public function CardIndexes(){

        $patients = DB::table('Patients')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured')
                            ->where('Patients.Registered', '=', '1')
                            ->get();

        $employees = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname')
                            ->get();

        $treatments = DB::table('Treatments')
                            ->select('Treatments.Id', 'Treatments.TreatmentCategory', 'Treatments.UnInsurancePriceMin',
                                'Treatments.UnInsurancePriceMax', 'Treatments.InsurancePriceMin',
                                'Treatments.InsurancePriceMax', 'Treatments.Description')
                            ->get();

        return view('Base.CardIndexes', ['employees' => $employees, 'patients' => $patients, 'treatments' => $treatments]);
    }

    public function CardIndexesDb(Request $req){

        $PatientId = $req->input('PatientId');
        $Annotation = $req->input('Annotation');
        $Date = $req->input('Date');
        $PersonIssuing = $req->input('PersonIssuing');
        $TreatmentCategory = $req->input('TreatmentCategory');
        $price = $req->input('price');
        $IsPaid = $req->input('IsPaid');
        $Recognition = $req->input('Recognition');
        $Treatment = $req->input('Treatment');

        $data = array('PatientId' => $PatientId, 'Annotation' => $Annotation, 'Date' => $Date, 'SupervisingDoctor' => $PersonIssuing, 'TreatmentCategoryId' => $TreatmentCategory, 'Price' => $price, 'IsPaid' => $IsPaid, 'Recognition' => $Recognition, 'Treatment' => $Treatment);

        DB::table('CardIndexes') -> insert($data);

        return redirect(Route('home'));
    }

    public function PatientsList(){

        $sort = Input::get('sort');
        $type = Input::get('type');

        $search = request('search');

        if(isset($sort)){
            $patients = DB::table('Patients')
                                ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured', 'Patients.BirthDate', 'Patients.PhoneNumber')
                                ->where('Patients.Registered', '=', '1')
                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                ->orderBy($sort, $type)
                                ->paginate(15);
        }else{
            $patients = DB::table('Patients')
                                ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured', 'Patients.BirthDate', 'Patients.PhoneNumber')
                                ->where('Patients.Registered', '=', '1')
                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                ->orderBy('Patients.Surname', 'asc')
                                ->paginate(15);
        }

        return view('profiles.list', ['patients' => $patients, 'search' => $search]);
    }

    public function EmployeesList(){

        $sort = Input::get('sort');
        $type = Input::get('type');

        $search =  request('search');

        if(isset($sort)){
            $employees = DB::table('Employees')
                                ->select('Employees.Id', 'Employees.Name', 'Employees.Surname', 'Employees.Rank', 'Employees.BirthDate', 'Employees.PhoneNumber')
                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                ->orderBy($sort, $type)
                                ->paginate(15);
        }else{
            $employees = DB::table('Employees')
                                ->select('Employees.Id', 'Employees.Name', 'Employees.Surname', 'Employees.Rank', 'Employees.BirthDate', 'Employees.PhoneNumber')
                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                ->orderBy('Employees.Surname', 'asc')
                                ->paginate(15);
        }

        return view('profiles.employees', ['employees' => $employees, 'search' => $search]);
    }

    public function Debtors(){

        $sort = Input::get('sort');
        $type = Input::get('type');

        $search =  request('search');

        if(isset($sort)){
            switch($sort){
                case "Surname":
                    switch($type){
                        case "asc":
                            $debtors = DB::table('CardIndexes')
                                                ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                                                ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', DB::raw('sum(CardIndexes.Price) as Debt'))
                                                ->where('CardIndexes.IsPaid', '=', 0)
                                                ->where('Patients.Registered', '=', '1')
                                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                                ->groupBy('Patients.Id', 'Patients.Name', 'Patients.Surname')
                                                ->orderBy('Patients.Surname', 'asc')
                                                ->paginate(20);
                            break;
                        case "desc":
                            $debtors = DB::table('CardIndexes')
                                                ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                                                ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', DB::raw('sum(CardIndexes.Price) as Debt'))
                                                ->where('CardIndexes.IsPaid', '=', 0)
                                                ->where('Patients.Registered', '=', '1')
                                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                                ->groupBy('Patients.Id', 'Patients.Name', 'Patients.Surname')
                                                ->orderBy('Patients.Surname', 'desc')
                                                ->paginate(20);
                            break;
                    }
                case "Debt":
                    switch($type){
                        case "asc":
                            $debtors = DB::table('CardIndexes')
                                                ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                                                ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', DB::raw('sum(CardIndexes.Price) as Debt'))
                                                ->where('CardIndexes.IsPaid', '=', 0)
                                                ->where('Patients.Registered', '=', '1')
                                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                                ->groupBy('Patients.Id', 'Patients.Name', 'Patients.Surname')
                                                ->orderBy('Debt', 'asc')
                                                ->paginate(20);
                            break;
                        case "desc":
                            $debtors = DB::table('CardIndexes')
                                                ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                                                ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', DB::raw('sum(CardIndexes.Price) as Debt'))
                                                ->where('CardIndexes.IsPaid', '=', 0)
                                                ->where('Patients.Registered', '=', '1')
                                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                                ->groupBy('Patients.Id', 'Patients.Name', 'Patients.Surname')
                                                ->orderBy('Debt', 'desc')
                                                ->paginate(20);
                            break;
                    }
            }
        }else{
            $debtors = DB::table('CardIndexes')
                                ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                                ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', DB::raw('sum(CardIndexes.Price) as Debt'))
                                ->where('CardIndexes.IsPaid', '=', 0)
                                ->where('Patients.Registered', '=', '1')
                                ->where('Surname', 'LIKE', '%' . $search . '%')
                                ->groupBy('Patients.Id', 'Patients.Name', 'Patients.Surname')
                                ->orderBy('Patients.Surname', 'asc')
                                ->paginate(20);
        }

        $permissions = DB::table('users')
                            ->join('Employees', 'Employees.Id', '=', 'users.EmployeeId')
                            ->select('Employees.Rank as Rank')
                            ->where('users.id', '=', Auth::id())
                            ->get();

        return view('Base.debtors', ['debtors' => $debtors, 'permissions' => $permissions, 'search' => $search]);
    }

    public function CardIndexUpdate(Request $req){

        $PatientId = $req->input('PatientId');
        $Annotation = $req->input('Annotation');
        $Date = $req->input('Date');
        $PersonIssuing = $req->input('PersonIssuing');
        $TreatmentCategory = $req->input('TreatmentCategory');
        $price = $req->input('price');
        $IsPaid = $req->input('IsPaid');
        $Recognition = $req->input('Recognition');
        $Treatment = $req->input('Treatment');
        $CardId = $req->input('CardId');

        $data = array('PatientId' => $PatientId, 'Annotation' => $Annotation, 'Date' => $Date, 'SupervisingDoctor' => $PersonIssuing, 'TreatmentCategoryId' => $TreatmentCategory, 'Price' => $price, 'IsPaid' => $IsPaid, 'Recognition' => $Recognition, 'Treatment' => $Treatment);

        DB::table('CardIndexes')
                            ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                            ->where('CardIndexes.Id', '=', $CardId)
                            ->update($data);

        return redirect(Route('home'));
    }

    public function CardIndexDelete(Request $req){

        $CardIndexesId = $req->input('CardIndexesId');

        DB::table('CardIndexes')
                            ->where('CardIndexes.Id', '=', $CardIndexesId)
                            ->delete();

        return redirect(Route('home'));
    }

    public function UsersPatientsEdit(Request $req){

        $id = $req->input('Id');
        $name = $req->input('Name');
        $surname = $req->input('Surname');
        $birthdate = $req->input('BirthDate');
        $comments = $req->input('Comments');
        $bloodgroup = $req->input('BloodGroup');
        $phonenumber = $req->input('PhoneNumber');
        $email = $req->input('Email');

        $data = array('Name' => $name, 'Surname' => $surname, 'Email' => $email, 'PhoneNumber' => $phonenumber, 'BloodGroupId' => $bloodgroup, 'Comments' => $comments, 'BirthDate' => $birthdate);

        DB::table('Patients')
                            ->where('Patients.Id', '=', $id)
                            ->update($data);

        return redirect(Route('home'));
    }

    public function UserCardIndexUpdate(Request $req){

        $Id = $req->input('CardId');
        $PatientId = $req->input('PatientId');
        $Annotation = $req->input('Annotation');
        $Date = $req->input('Date');
        $PersonIssuing = $req->input('PersonIssuing');
        $TreatmentCategory = $req->input('TreatmentCategory');
        $price = $req->input('price');
        $IsPaid = $req->input('IsPaid');
        $Recognition = $req->input('Recognition');
        $Treatment = $req->input('Treatment');

        $data = array('PatientId' => $PatientId, 'Annotation' => $Annotation, 'Date' => $Date, 'SupervisingDoctor' => $PersonIssuing, 'TreatmentCategoryId' => $TreatmentCategory, 'Price' => $price, 'IsPaid' => $IsPaid, 'Recognition' => $Recognition, 'Treatment' => $Treatment);

        DB::table('CardIndexes')
                            ->where('CardIndexes.Id', '=', $Id)
                            ->update($data);

        return redirect(Route('home'));
    }

    public function UserCardIndexDelete(Request $req){

        $CardIndexesId = $req->input('CardIndexesId');

        DB::table('CardIndexes')
                            ->where('CardIndexes.Id', '=', $CardIndexesId)
                            ->delete();

        return redirect(Route('home'));
    }

    public function UserEditEmployee(Request $req){

        $id = $req->input('EmployeeId');
        $name = $req->input('name');
        $surname = $req->input('surname');
        $rank = $req->input('rank');
        $date = $req->input('date');
        $phonenumber = $req->input('phonenumber');

        $data = array('Name' => $name, 'Surname' => $surname, 'Rank' => $rank, 'BirthDate' => $date, 'PhoneNumber' => $phonenumber);

        DB::table('Employees')
                            ->where('Employees.Id', '=', $id)
                            ->update($data);

        return redirect(Route('home'));
    }

    public function UserEditEmployeeTwo(Request $req){

        $id = $req->input('CardId');
        $PatientId = $req->input('PatientId');
        $Annotation = $req->input('Annotation');
        $Date = $req->input('Date');
        $PersonIssuing = $req->input('PersonIssuing');
        $TreatmentCategory = $req->input('TreatmentCategory');
        $price = $req->input('price');
        $IsPaid = $req->input('IsPaid');
        $Recognition = $req->input('Recognition');
        $Treatment = $req->input('Treatment');

        $data = array('PatientId' => $PatientId, 'Annotation' => $Annotation, 'Date' => $Date, 'SupervisingDoctor' => $PersonIssuing, 'Price' => $price, 'IsPaid' => $IsPaid, 'TreatmentCategoryId' => $TreatmentCategory, 'Recognition' => $Recognition, 'Treatment' => $Treatment);

        DB::table('CardIndexes')
                            ->where('CardIndexes.Id', '=', $id)
                            ->update($data);

        return redirect(Route('home'));
    }

    public function UserEmployeeFormTwoDelete(Request $req){

        $id = $req->input('CardIndexesId');

        DB::table('CardIndexes')
                            ->where('CardIndexes.Id', '=', $id)
                            ->delete();

        return redirect(Route('home'));
    }

    public function EditInsurance(Request $req){

        $id = $req->input('id');
        $PatientId = $req->input('PatientId');
        $InsurancePrice = $req->input('InsurancePrice');
        $Date = $req->input('Date');
        $PersonIssuing = $req->input('PersonIssuing');

        $data = array('PatientId' => $PatientId, 'InsuranceAmount' => $InsurancePrice, 'InsuranceDate' => $Date, 'PersonIssuing' => $PersonIssuing);

        DB::table('Insurances')
                            ->where('Insurances.Id', '=', $id)
                            ->update($data);

        return redirect(Route('insurance'));
    }

    public function DeleteInsurance(Request $req){

        $id = $req->input('InsuranceId');
        $uid = $req->input('PatientId');

        $data = array('IsInsured' => '0', 'InsuranceId' => NULL);

        DB::table('Insurances')
                            ->where('Insurances.Id', '=', $id)
                            ->delete();
        DB::table('Patients')
                            ->where('Patients.Id', '=', $uid)
                            ->update($data);

        return redirect(Route('insurance'));
    }

    public function AddAccount(Request $req){

        $nick = $req->input('login');
        $password = bcrypt($req->input('password'));
        $employeeId = $req->input('employee');

        $data = array('name' => $nick, 'email' => $nick, 'password' => $password, 'EmployeeId' => $employeeId);

        DB::table('users')
                            ->insert($data);

        return redirect(Route('home'));
    }

    public function UpdateDebtors(Request $req){

        $patient = $req->input('Id');

        $data = array('IsPaid' => '1');

        DB::table('CardIndexes')
                            ->where('PatientId', '=', $patient)
                            ->where('IsPaid', '=', '0')
                            ->update($data);

        return redirect(Route('Debtors'));
    }

    public function UserDeletePatient(Request $req){

        $id = $req->input('id');

        $data = array('Registered' => '0');

        DB::table('Patients')
                            ->where('Id', '=', $id)
                            ->update($data);

        return redirect(Route('home'));
    }

    public function ChangePassword(Request $req){

        $email = $req->input('email');
        $pass = $req->input('pass');
        $rpass = $req->input('pass');

        $values = array('password' => bcrypt($rpass));

        if($pass == $rpass){
            DB::table('users')
                            ->where('email', '=', $email)
                            ->update($values);
        }

        return redirect(Route('home'));
    }

}
