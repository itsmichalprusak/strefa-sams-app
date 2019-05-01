@extends('head')

@section('title', 'SAMS - Lista pracowników')

@section('content')

    <div class="table-responsive">
        <form action="{{Route('EmployeesList')}}" method="get" class="form-inline">
            {{csrf_field()}}
            <div class="form-group mx-sm-2 mb-2">
                <input type="text" id="Input" name="search" class="form-control bg-dark text-white" placeholder="Szukaj po nazwisku" autofocus value="{{$search}}">
            </div>
            <input type="submit" class="btn btn-primary mb-2">
        </form>
        <table id="table" class="table table-dark bg-dark table-bordered" width="100%">
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Ranga</th>
                <th>Data urodzenia</th>
                <th>Numer telefonu</th>
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
