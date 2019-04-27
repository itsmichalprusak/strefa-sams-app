@extends('layouts.app')

@section('title', 'SAMS - Lista Ubezpieczeń')

@section('content')

    <div class="table-responsive">
        <input type="text" id="Input" onkeyup="SearchByName()" class="form-control bg-dark text-white" placeholder="Szukaj po imieniu">
        <table style="width: 100%" id="table" class="table table-dark bg-dark table-bordered">
            <tr>
                <th scope="col" onclick="sortTable(0)" style="cursor:pointer" >Imie i Nazwisko</th>
                <th scope="col" onclick="sortTable(1)" style="cursor:pointer">Kwota Ubezpieczenia</th>
                <th scope="col" onclick="sortTable(2)" style="cursor:pointer">Data Nabycia</th>
                <th scope="col" onclick="sortTable(3)" style="cursor:pointer">Lekarz nadający ubezpieczenie</th>
                <th scope="col" onclick="sortTable(4)" style="cursor:pointer">Data wygaśnięcia</th>
                <th scope="col" onclick="sortTable(5)" style="cursor:pointer">Ilość dni pozostała</th>
                <th scope="col">Edytuj</th>
                <th scope="col">Usuń</th>
            </tr>
            <?php $now = time() ?>
            @foreach($insurances as $insurance)
                <tr>
                    <td><a href="{{route('user')}}?id={{$insurance->Id}}">{{$insurance->Name}} {{$insurance->Surname}}</a></td>
                    <td>@if($insurance->InsuranceAmount == 9999) 0$ | Służba @else {{$insurance->InsuranceAmount}}$ @endif</td>
                    <td>{{$insurance->InsuranceDate}}</td>
                    <td><a href="{{route('user')}}?emId={{$insurance->emId}}">{{$insurance->emName}} {{$insurance->emSurname}}</a></td>
                    <td>
                        @if($insurance->InsuranceAmount == 800)
                            {{$date1 = date('Y-m-d', strtotime("+7 day",strtotime($insurance->InsuranceDate)))}}
                        @elseif($insurance->InsuranceAmount == 1300)
                            {{$date2 = date('Y-m-d', strtotime("+14 day",strtotime($insurance->InsuranceDate)))}}
                        @elseif($insurance->InsuranceAmount == 2200)
                            {{$date3 = date('Y-m-d', strtotime("+30 day",strtotime($insurance->InsuranceDate)))}}
                        @elseif($insurance->InsuranceAmount == 9999)
                            Nigdy | Służby porządkowe
                        @endif
                    </td>
                    <td>
                        @if($insurance->InsuranceAmount == 800)
                            {{ round((((strtotime($date1) - $now)/24)/60)/60) }}
                        @elseif($insurance->InsuranceAmount == 1300)
                            {{ round((((strtotime($date2) - $now)/24)/60)/60) }}
                        @elseif($insurance->InsuranceAmount == 2200)
                            {{ round((((strtotime($date3) - $now)/24)/60)/60) }}
                        @elseif($insurance->InsuranceAmount == 9999)
                            Nigdy | Służby porządkowe
                        @endif
                    </td>
                    <td><button class="btn btn-dark btn-outline-light" data-toggle="modal" data-target="#InsuranceEdit{{$insurance->InId}}">Edytuj</button></td>
                    <td><button class="btn btn-dark btn-outline-light" data-toggle="modal" data-target="#DeleteInsurance{{$insurance->InId}}">Usuń</button></td>
                </tr>
            @endforeach
        </table>

        @include('popup.list')

        {{$insurances->links()}}
    </div>

@endsection
