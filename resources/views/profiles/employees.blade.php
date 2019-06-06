@extends('head')

@section('title', 'StrefaRP SAMS - Lista pracowników')

@section('content')

    <div class="btn-group float-right">
        <button type="button" class="btn btn-dark dropdown-toggle btn-outline-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sortuj wg.
        </button>
        <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item bg-dark text-white" href="?sort=Surname&type=asc">Nazwisko &uarr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=Surname&type=desc">Nazwisko &darr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=Rank&type=asc">Ranga &uarr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=Rank&type=desc">Ranga &darr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=BirthDate&type=asc">Data Urodzenia &uarr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=BirthDate&type=desc">Data Urodzenia &darr;</a>
        </div>
    </div>

    <div class="table-responsive">
        <form action="{{Route('EmployeesList')}}" method="get" class="form-inline">
            {{csrf_field()}}
            <div class="form-group mx-sm-2 mb-2">
                <input type="text" id="Input" name="search" class="form-control bg-dark text-white" placeholder="Szukaj po nazwisku" autofocus value="{{$search}}">
            </div>
            <input type="submit" class="btn btn-primary mb-2">
        </form><br>
        <table id="table" class="table table-dark bg-dark table-bordered" width="100%">
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Ranga</th>
                <th>Data urodzenia</th>
                <th>Numer telefonu</th>
                @foreach($permissions as $perm)
                    @if($perm->Rank == 'Dyrektor')
                        <th>Usuń</th>
                        <th>Edytuj</th>
                    @endif
                @endforeach
            </tr>
            @foreach($employees as $employee)
                <tr>
                    <td><a href="{{route('user')}}?emId={{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</a></td>
                    <td>{{$employee->Rank}}</td>
                    <td>{{$employee->BirthDate}}</td>
                    <td>{{$employee->PhoneNumber}}</td>
                    @foreach($permissions as $perm)
                        @if($perm->Rank == 'Dyrektor')
                            <td><button class="btn btn-dark btn-outline-light" data-toggle="modal" data-target="#employeeDelete{{$employee->Id}}">Usuń</button></td>
                            <td><button class="btn btn-dark btn-outline-light" data-toggle="modal" data-target="#employeeEdit{{$employee->Id}}">Edytuj</button></td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
        {{$employees->appends(request()->query())->links()}}
        @foreach($employees as $employee)
            @include('popup.EmployeeDelete')
            @include('popup.EmployeeEdit')
        @endforeach
    </div>

@endsection
