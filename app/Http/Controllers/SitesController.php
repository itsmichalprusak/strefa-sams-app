<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('Base.Add');
    }

    public function addemployee(Request $req){


        $name = $req->input('name');
        $surname = $req->input('surname');
        $rank = $req->input('rank');
        $BirthDate = $req->input('date');
        $PhoneNumber = $req->input('phonenumber');

        $data = array('Name' => $name, 'Surname' => $surname, 'Rank' => $rank, 'BirthDate' => $BirthDate, 'PhoneNumber' => $PhoneNumber);

        DB::table('Employees') -> insert($data);

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

        DB::table('Patients') -> insert($data);

        return redirect('home');
    }

    public function insurance(){

        $insurances = DB::select('SELECT Patients.Id, Patients.Name, Patients.Surname, Insurances.InsuranceAmount, Insurances.InsuranceDate, Employees.Name as emName, Employees.Surname as emSurname
                                        FROM Patients, Insurances, Employees
                                        WHERE Insurances.PatientId = Patients.Id
                                        AND Insurances.PersonIssuing = Employees.Id
                                ');

        return view('Insurances.List', ['insurances' => $insurances]);
    }

    public function search(){
        return view('Search');
    }

    public function base(){
        return view('Base.Main');
    }

    public function home(){

        $patients = DB::select('SELECT Patients.Name, Patients.Surname, Patients.IsInsured, Patients.Email, Patients.PhoneNumber, Patients.BirthDate, Patients.Comments, BloodGroups.BloodGroup 
                                FROM Patients, BloodGroups
                                WHERE Patients.BloodGroupid = BloodGroups.id
                                ');

        $cardindexes = DB::table('CardIndexes')
                            ->join('Patients', 'Patients.Id', '=', 'CardIndexes.PatientId')
                            ->join('Employees', 'Employees.Id', '=', 'CardIndexes.SupervisingDoctor')
                            ->join('Treatments', 'Treatments.Id', '=', 'TreatmentCategoryId')
                            ->select('Patients.Id', 'Patients.Name', 'Patients.Surname', 'Employees.Id as emId', 'Employees.Name as emName',
                                'Employees.Surname as emSurname', 'Treatments.TreatmentCategory', 'CardIndexes.Annotation', 'CardIndexes.Date', 'CardIndexes.Price',
                                'CardIndexes.IsPaid', 'CardIndexes.Recognition', 'CardIndexes.Treatment')
                            ->paginate(10)
                            ;

        return view('home', ['patients'=>$patients, 'cardindexes'=>$cardindexes]);
    }

    public function user(){

        $id = Input::get('id');
        $emid = Input::get('emId');

        $patients = DB::select('SELECT Patients.Name, Patients.Surname, Patients.IsInsured, Patients.Email, Patients.PhoneNumber, Patients.BirthDate, Patients.Comments, BloodGroups.BloodGroup 
                                FROM Patients, BloodGroups
                                WHERE Patients.BloodGroupId = BloodGroups.Id
                                AND Patients.id = :id', [$id]
                                );
        $employees = DB::select('SELECT Employees.Name, Employees.Surname, Employees.LastPromotion, 
                                        Employees.Rank, Employees.BirthDate, Employees.PhoneNumber, Employees.UnderSupervision 
                                FROM Employees 
                                WHERE Employees.Id = :emId', [$emid]
                                );
        $cardindexes = DB::select('SELECT Patients.Id, Patients.Name, Patients.Surname, CardIndexes.Annotation, 
                                        CardIndexes.Date, Employees.Id as emId, Employees.Name as emName, Employees.Surname as emSurname, 
                                        Treatments.TreatmentCategory, CardIndexes.Price, CardIndexes.IsPaid, 
                                        Treatments.Description, CardIndexes.Recognition, CardIndexes.Treatment 
                                    FROM Patients, CardIndexes, Treatments, Employees 
                                    WHERE CardIndexes.PatientId = Patients.Id 
                                    AND CardIndexes.SupervisingDoctor = Employees.Id
                                    AND CardIndexes.TreatmentCategoryId = Treatments.Id
                                    AND Patients.Id = :id
                                    ORDER BY CardIndexes.Date DESC
                                    ', [$id]);
        $cards = DB::select('SELECT Patients.Id, Patients.Name, Patients.Surname, CardIndexes.Annotation,
                                    CardIndexes.Date, Treatments.TreatmentCategory,Treatments.Description, CardIndexes.Price, 
                                    CardIndexes.IsPaid, CardIndexes.Recognition, CardIndexes.Treatment
                            FROM Patients, CardIndexes, Treatments, Employees
                            WHERE CardIndexes.PatientId = Patients.Id
                            AND CardIndexes.SupervisingDoctor = Employees.Id
                            AND CardIndexes.TreatmentCategoryId = Treatments.Id
                            AND CardIndexes.SupervisingDoctor = :emId
                            ORDER BY CardIndexes.Date DESC
                            ', [$emid]);

        return view('profiles.user', ['patients'=>$patients, 'id'=>$id, 'emid'=>$emid, 'employees'=>$employees, 'cardindexes'=>$cardindexes, 'cards' => $cards]);
    }

    public function patient(){

        return view('Base.Patient');
    }

    public function addinsurance(){

        $employees = DB::select('SELECT Employees.Id, Employees.Name, Employees.Surname
                                From Employees
                                ');
        $patients = DB::select('SELECT Patients.Id, Patients.Name, Patients.Surname
                                From Patients
                                ');

        return view('Base.Insurance', ['employees' => $employees, 'patients' => $patients]);
    }

    public function addinsurancedb(Request $req){

        $PatientId = $req->input('PatientId');
        $InsuranceAmount = $req->input('InsurancePrice');
        $InsuranceDate = $req->input('Date');
        $PersonIssuing = $req->input('PersonIssuing');

        $data = array('PatientId' => $PatientId, 'InsuranceAmount' => $InsuranceAmount, 'InsuranceDate' => $InsuranceDate, 'PersonIssuing' => $PersonIssuing);

        DB::update('UPDATE Patients SET IsInsured = 1 WHERE Id= :PatientId', [$PatientId]);

        DB::table('Insurances') -> insert($data);
        return redirect('home');
    }

    public function CardIndexes(){

        $patients = DB::select('SELECT Patients.Id, Patients.Name, Patients.Surname, Patients.IsInsured
                                From Patients
                                ');

        $employees = DB::select('SELECT Employees.Id, Employees.Name, Employees.Surname
                                From Employees
                                ');
        $treatments = DB::select('SELECT Treatments.Id, Treatments.TreatmentCategory, Treatments.UnInsurancePriceMin, 
                                                Treatments.UnInsurancePriceMax, Treatments.InsurancePriceMin, 
                                                Treatments.InsurancePriceMax, Treatments.Description
                                From Treatments
                                ');

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

        return redirect('home');
    }

    public function PatientsList(){

        $patients = DB::select('SELECT Patients.Id, Patients.Name, Patients.Surname, Patients.IsInsured, Patients.BirthDate, Patients.PhoneNumber
                                FROM Patients
                                ');

        return view('profiles.list', ['patients' => $patients]);
    }

    public function EmployeesList(){

        $employees = DB::select('SELECT Employees.Id, Employees.Name, Employees.Surname, Employees.Rank, Employees.BirthDate, Employees.PhoneNumber
                                FROM Employees
                                ');

        return view('profiles.employees', ['employees' => $employees]);
    }

    public function Debtors(){

        $debtors = DB::select('SELECT Patients.Id, Patients.Name, Patients.Surname, sum(CardIndexes.Price) as Debt
                               FROM Patients, CardIndexes
                               WHERE CardIndexes.PatientId = Patients.Id
                               AND IsPaid = 0
                               GROUP BY Patients.Id, Patients.Surname, Patients.Name
                              ');

        return view('Base.debtors', ['debtors' => $debtors]);
    }

}
