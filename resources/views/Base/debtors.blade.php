@extends('head')

@section('title', 'SAMS - dłużnicy')

@section('content')

    <div class="btn-group float-right">
        <button type="button" class="btn btn-dark dropdown-toggle btn-outline-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sortuj wg.
        </button>
        <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item bg-dark text-white" href="?sort=Surname&type=asc">Nazwisko &uarr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=Surname&type=desc">Nazwisko &darr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=Debt&type=asc">Kwota Zadłużenia &uarr;</a>
            <a class="dropdown-item bg-dark text-white" href="?sort=Debt&type=desc">Kwota Zadłużenia &darr;</a>
        </div>
    </div>

    @foreach($permissions as $perm)
    <div class="table-responsive">
        <form action="{{Route('Debtors')}}" method="get" class="form-inline">
            {{csrf_field()}}
            <div class="form-group mx-sm-2 mb-2">
                <input type="text" id="Input" name="search" class="form-control bg-dark text-white" placeholder="Szukaj po nazwisku" autofocus value="{{$search}}">
            </div>
            <input type="submit" class="btn btn-primary mb-2">
        </form>
        <table id="table" class="table table-dark bg-dark table-bordered" width="100%">
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Kwota zadłużenia</th>
                @if($perm->Rank != 'Pielęgniarz')
                <th>Zapłacono</th>
                @endif
            </tr>
            @foreach($debtors as $debtor)
                <tr>
                    <td><a href="{{route('user')}}?emId={{$debtor->Id}}">{{$debtor->Name}} {{$debtor->Surname}}</a></td>
                    <td>{{$debtor->Debt}}$</td>
                    @if($perm->Rank != 'Pielęgniarz')
                    <td><button class="btn btn-dark btn-outline-light" data-toggle="modal" data-target="#debtor{{$debtor->Id}}">Spłacił</button></td>
                    @endif
                </tr>
            @endforeach
        </table>
        {{$debtors->links()}}
        @foreach($debtors as $debtor)
            @include('popup.debtors')
        @endforeach

    </div>
    @endforeach
@endsection
