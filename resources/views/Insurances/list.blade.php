@extends('layouts.app')

@section('title', 'SAMS - Lista Ubezpieczeń')

@section('content')

    <div class="table-responsive">
        <table style="width: 100%" class="table">
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
                    <td>{{$insurance->Name}} {{$insurance->Surname}}</td>
                    <td>{{$insurance->InsuranceAmount}}</td>
                    <td>{{$insurance->InsuranceDate}}</td>
                    <td>{{$insurance->emName}} {{$insurance->emSurname}}</td>
                    <td>
                        @if($insurance->InsuranceAmount == 800)
                            {{$date1 = date('Y-m-d', strtotime("+7 day",strtotime($insurance->InsuranceDate)))}}
                        @elseif($insurance->InsuranceAmount == 1300)
                            {{$date2 = date('Y-m-d', strtotime("+14 day",strtotime($insurance->InsuranceDate)))}}
                        @elseif($insurance->InsuranceAmount == 2200)
                            {{$date3 = date('Y-m-d', strtotime("+30 day",strtotime($insurance->InsuranceDate)))}}
                        @endif
                    </td>
                    <td>
                        @if($insurance->InsuranceAmount == 800)
                            {{ round((((strtotime($date1) - $now)/24)/60)/60) }}
                        @elseif($insurance->InsuranceAmount == 1300)
                            {{ round((((strtotime($date2) - $now)/24)/60)/60) }}
                        @elseif($insurance->InsuranceAmount == 2200)
                            {{ round((((strtotime($date3) - $now)/24)/60)/60) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
