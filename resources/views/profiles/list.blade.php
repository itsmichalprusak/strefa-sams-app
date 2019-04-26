@extends('head')

@section('title', 'SAMS - Pacjenci')

@section('content')

    <div class="table-responsive">
        <input type="text" id="Input" onkeyup="SearchByName()" class="form-control bg-dark text-white" placeholder="Szukaj po imieniu">
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
