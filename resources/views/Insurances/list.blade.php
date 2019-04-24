@extends('layouts.app')

@section('title', 'SAMS - Lista Ubezpieczeń')

@section('content')

    <div class="table-responsive">
        <input type="text" id="Input" onkeyup="SearchByName()" placeholder="Szukaj po imieniu">
        <table style="width: 100%" id="table" class="table">
            <tr>
                <th scope="col">Imie i Nazwisko</th>
                <th scope="col">Kwota Ubezpieczenia</th>
                <th scope="col">Data Nabycia</th>
                <th scope="col">Lekarz nadający ubezpieczenie</th>
                <th scope="col">Data wygaśnięcia</th>
                <th scope="col">Ilość dni pozostała</th>

            </tr>
            <?php $now = time() ?>
            @foreach($insurances as $insurance)
                <tr>
                    <td><a href="{{route('user')}}?id={{$insurance->Id}}">{{$insurance->Name}} {{$insurance->Surname}}</a></td>
                    <td>@if($insurance->InsuranceAmount == 9999) 0 | Służba @else {{$insurance->InsuranceAmount}} @endif</td>
                    <td>{{$insurance->InsuranceDate}}</td>
                    <td>{{$insurance->emName}} {{$insurance->emSurname}}</td>
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
                </tr>
            @endforeach
        </table>
    </div>

@endsection
