@extends('layouts.app')

@section('title', 'SAMS - profile')

@section('content')

    <div class="container bg-dark text-white">
        <div class="row justify-content-center bg-dark text-white">
            <div class="col-md-12 bg-dark text-white">
                <div class="card bg-dark text-white">
                    <div class="card-header bg-dark text-white">
                        @if($id)
                            O Pacjencie
                        @elseif($emid)
                            Karta Pracownika
                        @endif
                    </div>

                    @if($id)
                    <table class="table table-dark bg-dark table-bordered">
                    <tr>
                        <th>Imie i Nazwisko</th>
                        <th>Data Urodzenia</th>
                        <th>Ubezpieczony</th>
                        <th>Numer Telefonu</th>
                        <th>Komentarze</th>
                        <th>Grupa Krwi</th>
                        <th>Nick Discord</th>
                        <th>Edytuj</th>
                    </tr>
                    @foreach ($patients as $user)
                        <tr>
                            <td>{{$user->Name}} {{$user->Surname}}</td>
                            <td>{{$user->BirthDate}}</td>
                            <td>@if($user->IsInsured == 0) Nie @else Tak @endif </td>
                            <td>{{$user->PhoneNumber}}</td>
                            <td>{{$user->Comments}}</td>
                            <td>{{$user->BloodGroup}}</td>
                            <td>{{$user->Email}}</td>
                            <td><button class="btn btn-dark" data-toggle="modal" data-target="#FormEdit{{$user->Id}}">Edytuj</button></td>
                        </tr>
                    @endforeach
                    </table>
                        <br><br><h2>Ostatnie wpisy o pacjencie</h2><br><br>
                    <table class="table table-dark bg-dark table-bordered">
                        <tr>
                            <th>Imie i Nazwisko</th>
                            <th>Odesłanie</th>
                            <th>Data</th>
                            <th>Lekarz Nadzorujący</th>
                            <th>Kategoria zabiegu</th>
                            <th>Cena</th>
                            <th>Zapłacono</th>
                            <th>Rozpoznanie</th>
                            <th>Zabieg</th>
                            <th>Edytuj</th>
                            <th>Usuń</th>
                        </tr>
                        @foreach ($cardindexes as $card)
                            <tr>
                                <td>{{$card->Name}} {{$card->Surname}}</td>
                                <td>{{$card->Annotation}}</td>
                                <td>{{$card->Date}}</td>
                                <td><a href="{{route('user')}}?emId={{$card->emId}}">{{$card->emName}} {{$card->emSurname}}</a></td>
                                <td>{{$card->TreatmentCategory}} | {{$card->Description}}</td>
                                <td>{{$card->Price}}</td>
                                <td>@if($card->IsPaid == 0) Nie @else Tak @endif</td>
                                <td>{{$card->Recognition}}</td>
                                <td>{{$card->Treatment}}</td>
                                <td><button class="btn btn-dark" data-toggle="modal" data-target="#FormEditd{{$card->CardId}}">Edytuj</button></td>
                                <td><button class="btn btn-dark" data-toggle="modal" data-target="#FormEditdel{{$card->CardId}}">Usuń</button></td>
                            </tr>
                        @endforeach
                        </table>
                        {{$cardindexes->links()}}

                    @elseif($emid)
                        <table class="table table-dark bg-dark table-bordered">
                            <tr>
                                <th>Imie i Nazwisko</th>
                                <th>Data ostatniego awansu</th>
                                <th>Ranga</th>
                                <th>Data Urodzenia</th>
                                <th>Numer telefonu</th>
                                <th>Pod nadzorem</th>
                                <th>Edytuj</th>
                            </tr>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{$employee->Name}} {{$employee->Surname}}</td>
                                    <td>{{$employee->LastPromotion}}</td>
                                    <td>{{$employee->Rank}}</td>
                                    <td>{{$employee->BirthDate}}</td>
                                    <td>{{$employee->PhoneNumber}}</td>
                                    <td> @if($employee->UnderSupervision) <a href="{{route('user')}}?emId={{$employee->UnderSupervision}}">  Profil Osoby Nadzorującej  </a> @endif </td>
                                    <td><button class="btn btn-dark" data-toggle="modal" data-target="#UserEmployeeForm{{$employee->Id}}">Edytuj</button></td>
                                </tr>
                            @endforeach
                        </table>
                        <br><br><br>
                        <table class="table table-dark bg-dark table-bordered">
                            <tr>
                                <th scope="col">Imie i Nazwisko</th>
                                <th scope="col">Odesłanie</th>
                                <th scope="col">Data</th>
                                <th scope="col">Kategoria Zabiegu</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Zapłacono</th>
                                <th scope="col">Rozpoznanie</th>
                                <th scope="col">Zabieg</th>
                                <th scope="col">Edytuj</th>
                                <th scope="col">Usuń</th>
                            </tr>
                            @foreach ($cards as $card)
                                <tr>
                                    <td><a href="{{route('user')}}?id={{$card->Id}}">{{$card->Name}} {{$card->Surname}}</a></td>
                                    <td>{{$card->Annotation}}</td>
                                    <td>{{$card->Date}}</td>
                                    <td>{{$card->TreatmentCategory}} | {{$card->Description}}</td>
                                    <td>{{$card->Price}}</td>
                                    <td>@if($card->IsPaid == 0) Nie @else Tak @endif</td>
                                    <td>{{$card->Recognition}}</td>
                                    <td>{{$card->Treatment}}</td>
                                    <td><button class="btn btn-dark" data-toggle="modal" data-target="#UserEmployeeFormTwo{{$card->CardId}}">Edytuj</button></td>
                                    <td><button class="btn btn-dark" data-toggle="modal" data-target="#UserEmployeeFormTwoDelete{{$card->CardId}}">Usuń</button></td>
                                </tr>
                            @endforeach
                        </table>
                        {{$cards->links()}}

                    @endif
                </div>
                @include('popup.patients')
                @include('popup.employees')
            </div>
        </div>
    </div>


@endsection
