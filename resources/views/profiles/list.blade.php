@extends('head')

@section('title', 'SAMS - Pacjenci')

@section('content')

    <div class="table-responsive">
        <input type="text" id="Input" onkeyup="SearchByName()" class="form-control bg-dark text-white" placeholder="Szukaj po imieniu">
        <table id="table" class="table table-dark bg-dark table-bordered" width="100%">
            <tr>
                <th onclick="sortTable(0)" style="cursor:pointer">Imię i Nazwisko</th>
                <th onclick="sortTable(1)" style="cursor:pointer">Ubezpieczony</th>
                <th onclick="sortTable(2)" style="cursor:pointer">Data urodzenia</th>
                <th onclick="sortTable(3)" style="cursor:pointer">Numer telefonu</th>
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
