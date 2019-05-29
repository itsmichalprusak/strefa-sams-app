@extends('layouts.app')

@section('title', 'StrefaRP SAMS - Lista Ubezpieczeń')

@section('content')

    <div class="table-responsive">
        <form action="{{Route('insurance')}}" method="get" class="form-inline">
            {{csrf_field()}}
            <div class="form-group mx-sm-2 mb-2">
                <input type="text" id="Input" name="search" class="form-control bg-dark text-white" placeholder="Szukaj po nazwisku" autofocus value="{{$search}}">
            </div>
            <input type="submit" class="btn btn-primary mb-2">
        </form>
        <table style="width: 100%" id="table" class="table table-dark bg-dark table-bordered">
            <tr>
                <th scope="col">Imie i Nazwisko</th>
                <th scope="col">Kwota Ubezpieczenia</th>
                <th scope="col">Data Nabycia</th>
                <th scope="col">Lekarz nadający ubezpieczenie</th>
                <th scope="col">Data wygaśnięcia</th>
                <th scope="col">Ilość dni pozostała</th>
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
                            @if(round((((strtotime($date1) - $now)/24)/60)/60) >= 0)
                                {{round((((strtotime($date1) - $now)/24)/60)/60)}}
                            @elseif(round((((strtotime($date1) - $now)/24)/60)/60) < 0)
                                0 od {{abs(round((((strtotime($date1) - $now)/24)/60)/60))}} dni
                            @endif
                        @elseif($insurance->InsuranceAmount == 1300)
                            @if(round((((strtotime($date2) - $now)/24)/60)/60) >= 0)
                                {{round((((strtotime($date2) - $now)/24)/60)/60)}}
                            @elseif(round((((strtotime($date2) - $now)/24)/60)/60) < 0)
                                0 od {{abs(round((((strtotime($date2) - $now)/24)/60)/60))}} dni
                            @endif
                        @elseif($insurance->InsuranceAmount == 2200)
                            @if(round((((strtotime($date3) - $now)/24)/60)/60) >= 0)
                                {{round((((strtotime($date3) - $now)/24)/60)/60)}}
                            @elseif(round((((strtotime($date3) - $now)/24)/60)/60) < 0)
                                0 od {{abs(round((((strtotime($date3) - $now)/24)/60)/60))}} dni
                            @endif
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
