@extends('head')

@section('title', 'SAMS - Lista pracowników')

@section('content')

    <div class="table-responsive">
        <input type="text" id="Input" onkeyup="SearchByName()" class="form-control bg-dark text-white" placeholder="Szukaj po imieniu">
        <table id="table" class="table table-dark bg-dark table-bordered" width="100%">
            <tr>
                <th onclick="sortTable(0)" style="cursor:pointer">Imię i Nazwisko</th>
                <th onclick="sortTable(1)" style="cursor:pointer">Ranga</th>
                <th onclick="sortTable(2)" style="cursor:pointer">Data urodzenia</th>
                <th onclick="sortTable(3)" style="cursor:pointer">Numer telefonu</th>
            </tr>
            @foreach($employees as $employee)
                <tr>
                    <td><a href="{{route('user')}}?emId={{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</a></td>
                    <td>{{$employee->Rank}}</td>
                    <td>{{$employee->BirthDate}}</td>
                    <td>{{$employee->PhoneNumber}}</td>
                </tr>
            @endforeach
        </table>
        {{$employees->links()}}
    </div>

@endsection
