@extends('head')

@section('title', 'SAMS - dłużnicy')

@section('content')

    <div class="table-responsive">
        <input type="text" id="Input" onkeyup="SearchByName()" placeholder="Szukaj po imieniu">
        <table id="table" class="table" width="100%">
            <tr>
                <th>Imię i Nazwisko</th>
                <th>Kwota zadłużenia</th>
            </tr>
            @foreach($debtors as $debtor)
                <tr>
                    <td><a href="{{route('user')}}?emId={{$debtor->Id}}">{{$debtor->Name}} {{$debtor->Surname}}</a></td>
                    <td>{{$debtor->Debt}}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
