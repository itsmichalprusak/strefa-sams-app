@extends('head')

@section('title', 'SAMS - dłużnicy')

@section('content')

    @foreach($permissions as $perm)
    <div class="table-responsive">
        <input type="text" id="Input" onkeyup="SearchByName()" class="form-control bg-dark text-white" placeholder="Szukaj po imieniu">
        <table id="table" class="table table-dark bg-dark table-bordered" width="100%">
            <tr>
                <th onclick="sortTable(0)" style="cursor:pointer">Imię i Nazwisko</th>
                <th onclick="sortTable(1)" style="cursor:pointer">Kwota zadłużenia</th>
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
