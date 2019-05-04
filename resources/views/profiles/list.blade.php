@extends('head')

@section('title', 'SAMS - Pacjenci')

@section('content')

    <div class="btn-group float-right">
        <button type="button" class="btn btn-dark dropdown-toggle btn-outline-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sortuj wg.
        </button>
        <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item bg-dark text-white" href="?sort=Surname&type=asc">Nazwisko &uarr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=Surname&type=desc">Nazwisko &darr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=InsuranceId&type=asc">Ubezpieczenie &uarr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=InsuranceId&type=desc">Ubezpieczenie &darr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=BirthDate&type=asc">Data Urodzenia &uarr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=BirthDate&type=desc">Data Urodzenia &darr;</a>
        </div>
    </div>

    <div class="table-responsive">
        <form action="{{Route('PatientsList')}}" method="get" class="form-inline">
            {{csrf_field()}}
            <div class="form-group mx-sm-2 mb-2">
                <input type="text" id="Input" name="search" class="form-control bg-dark text-white" placeholder="Szukaj po nazwisku" autofocus value="{{$search}}">
            </div>
            <input type="submit" class="btn btn-primary mb-2">
        </form><br>
        <table id="table" class="table table-dark bg-dark table-bordered" width="100%">
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Ubezpieczony</th>
                <th>Data urodzenia</th>
                <th>Numer telefonu</th>
            </tr>
            @foreach($patients as $patient)
                <tr>
                    <td><a href="{{route('user')}}?id={{$patient->Id}}">{{$patient->Name}} {{$patient->Surname}}</a></td>
                    <td>@if($patient->IsInsured == 0) Nie @else Tak @endif</td>
                    <td>{{$patient->BirthDate}}</td>
                    <td>{{$patient->PhoneNumber}}</td>
                </tr>
            @endforeach
        </table>
        {{$patients->links()}}
    </div>

@endsection
