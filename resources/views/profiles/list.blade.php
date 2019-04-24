@extends('head')

@section('title', 'SAMS - Pacjenci')

@section('content')

    <div class="table-responsive">
        <table class="table" width="100%">
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Data urodzenia</th>
                <th>Numer telefonu</th>
            </tr>
            @foreach($patients as $patient)
                <tr>
                    <td><a href="{{route('user')}}?id={{$patient->Id}}">{{$patient->Name}} {{$patient->Surname}}</a></td>
                    <td>{{$patient->BirthDate}}</td>
                    <td>{{$patient->PhoneNumber}}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
