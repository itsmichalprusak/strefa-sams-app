@extends('head')

@section('title', 'SAMS - Lista pracowników')

@section('content')

    <div class="table-responsive">
        <input type="text" id="Input" onkeyup="SearchByName()" placeholder="Szukaj po imieniu">
        <table id="table" class="table" width="100%">
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Ranga</th>
                <th>Data urodzenia</th>
                <th>Numer telefonu</th>
                <th>Edytuj</th>
                <th>Usuń</th>
            </tr>
            @foreach($employees as $employee)
                <tr>
                    <td><a href="{{route('user')}}?emId={{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</a></td>
                    <td>{{$employee->Rank}}</td>
                    <td>{{$employee->BirthDate}}</td>
                    <td>{{$employee->PhoneNumber}}</td>
                    <td>Edytuj</td>
                    <td>Usuń</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
