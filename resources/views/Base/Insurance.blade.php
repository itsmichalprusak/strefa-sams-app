@extends('layouts.app')

@section('title', 'SAMS - Dodaj ubezpieczenie')

@section('content')

    <h3 style="margin-top: 10px;" >StrefaRP - Baza SAMS > Dodaj Ubezpieczenie</h3>
    <form method="POST" action="{{route('addInsuranceDB')}}">
        {{csrf_field()}}

        <div class="form-group">
            <label for="imie">Imię i Nazwisko</label>
            <select class="form-control" name="PatientId" id="imie">
                @foreach($patients as $patient)
                    <option value="{{$patient->Id}}">{{$patient->Name}} {{$patient->Surname}}</option>
                @endforeach
            </select>
            <small id="stopien" class="form-text text-muted">Podaj Imię i Nazwisko pacjenta, dla którego chcesz dodać ubezpieczenie.</small>
        </div>
        <div class="form-group">
            <label for="price">Kwota</label>
            <select class="form-control" name="InsurancePrice" id="price">
                <option value="800">800</option>
                <option value="1300">1300</option>
                <option value="2200">2200</option>
                <option value="9999">0 | Służby porządkowe</option>
            </select>
            <small id="stopien" class="form-text text-muted">Podaj Kwotę ubezpieczenia, dla pacjenta.</small>
        </div>
        <div class="form-group">
            <label for="date">Data Dodania</label>
            <input type="date" name="Date"  class="form-control" id="date" onfocus="(this.type='date')" value="{{date("Y-m-d")}}">
            <small id="date" class="form-text text-muted">Podaj Datę utworzenia wpisu ubezpieczenia.</small>
        </div>
        <div class="form-group">
            <label for="Employee">Osoba Dodająca</label>
            <select class="form-control" name="PersonIssuing" id="Employee">
                @foreach($employees as $employee)
                    <option value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                @endforeach
            </select>
            <small id="Employee" class="form-text text-muted">Podaj osobę nadającą ubezpieczenie.</small>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Dodaj Ubezpieczenie!</button>
        </div>

    </form>

@endsection
