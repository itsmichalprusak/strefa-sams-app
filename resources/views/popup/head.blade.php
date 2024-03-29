<?php

$employees = DB::table('Employees')
    ->select('Employees.Id', 'Employees.Name', 'Employees.Surname')
    ->whereNotIn('Id', function($query){
        $query->select('EmployeeId')->from('users');
    })
    ->get();

?>

<div class="form-group row">
    <label for="Employee" class="col-md-4 col-form-label text-md-right">Dodaj lekarza</label>
    <div class="col-md-6">
        <select required class="bg-dark text-white form-control" name="employee" id="EmployeeSelect">
            @foreach($employees as $employee)
                <option value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
            @endforeach
        </select>
    </div>
</div>
