@extends('layouts.app')

@section('title', 'SAMS - profile')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if($id)
                            O Pacjencie
                        @elseif($emid)
                            Karta Pracownika
                        @endif
                    </div>

                    @if($id)
                    <table style="width: 100%">
                    <tr>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                        <th>Data Urodzenia</th>
                        <th>Ubezpieczony?</th>
                        <th>Komentarze</th>
                        <th>Grupa Krwi</th>
                    </tr>
                    @foreach ($patients as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>
                            <td>{{$user->birthdate}}</td>
                            <td>@if($user->isinsured == 0) Nie @else Tak @endif </td>
                            <td>{{$user->comments}}</td>
                            <td>{{$user->bloodgroup}}</td>
                        </tr>
                        @endforeach
                        </table>
                    @elseif($emid)
                        <table style="width: 100%">
                            <tr>
                                <th>Imie i Nazwisko</th>
                                <th>Data ostatniego awansu</th>
                                <th>Ranga</th>
                                <th>Data Urodzenia</th>
                                <th>Numer telefonu</th>
                                <th>Pod nadzorem</th>
                            </tr>
                            @foreach ($employees as $employee)
                                <tr>
                                    <th>{{$employee->Name}} {{$employee->Surname}}</th>
                                    <th>{{$employee->LastPromotion}}</th>
                                    <th>{{$employee->Rank}}</th>
                                    <th>{{$employee->BirthDate}}</th>
                                    <th>{{$employee->PhoneNumber}}</th>
                                    <th><a href="/user?emId={{$employee->UnderSupervision}}">{{$employee->UnderSupervision}}</a></th>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
