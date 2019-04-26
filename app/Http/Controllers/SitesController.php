<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Insurances.InsuranceAmount', 'Insurances.Id as InId',
                                'Insurances.InsuranceDate', 'Employees.Id as emId', 'Employees.Name as emName', 'Employees.Surname as emSurname')
                            ->orderByDesc('Insurances.InsuranceDate')
                            ->paginate(10);

        $patients = DB::table('Patients')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured')
                            ->get();

        $employees = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname')
                            ->get();

        return view('Insurances.list', ['insurances' => $insurances, 'patients' => $patients, 'employees' => $employees]);
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
                            ->paginate(10);

        $patients = DB::table('Patients')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured')
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

        $patients = DB::table('Patients')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Patients.IsInsured', 'Patients.BirthDate', 'Patients.PhoneNumber')
                            ->paginate(15);

        return view('profiles.list', ['patients' => $patients]);
    }

    public function EmployeesList(){

        $employees = DB::table('Employees')
                            ->select('Employees.Id', 'Employees.Name', 'Employees.Surname', 'Employees.Rank', 'Employees.BirthDate', 'Employees.PhoneNumber')
                            ->paginate(15);

        return view('profiles.employees', ['employees' => $employees]);
    }

    public function Debtors(){

        $debtors = DB::table('CardIndexes')
                            ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', DB::raw('CardIndexes.Price as Debt'))
                            ->where('CardIndexes.IsPaid', '=', 0)
                            ->groupBy('Patients.Id', 'Patients.Surname', 'Patients.Name', 'CardIndexes.Price')
                            ->paginate(20);

        return view('Base.debtors', ['debtors' => $debtors]);
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

        DB::table('Insurances')
                            ->where('Insurances.Id', '=', $id)
                            ->delete();

        return redirect(Route('insurance'));
    }

}
