@extends('head')

@section('title', 'SAMS - Pacjenci')

@section('content')

    <div class="table-responsive">
        <form action="{{Route('PatientsList')}}" method="get" class="form-inline">
            {{csrf_field()}}
            <div class="form-group mx-sm-2 mb-2">
                <input type="text" id="Input" name="search" class="form-control bg-dark text-white" placeholder="Szukaj po nazwisku" autofocus value="{{$search}}">
            </div>
            <input type="submit" class="btn btn-primary mb-2">
        </form>
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
