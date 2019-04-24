@extends('layouts.app')

@section('title', 'SAMS - Dodaj ubezpieczenie')

@section('content')

    <form method="POST" action="{{route('addInsuranceDB')}}">
        {{csrf_field()}}

        <div>
            <label>Imię i Nazwisko</label>
            <select name="PatientId">
                @foreach($patients as $patient)
                    <option value="{{$patient->Id}}">{{$patient->Name}} {{$patient->Surname}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Kwota</label>
            <select name="InsurancePrice">
                <option value="800">800</option>
                <option value="1300">1300</option>
                <option value="2200">2200</option>
            </select>
        </div>
        <div>
            <label>Data Dodania</label>
            <input type="date" name="Date">
        </div>
        <div>
            <label>Osoba Dodająca</label>
            <select name="PersonIssuing">
                @foreach($employees as $employee)
                    <option value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="submit" value="Dodaj Ubezpieczenie">
        </div>

    </form>

@endsection
