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
                        <th>Imie i Nazwisko</th>
                        <th>Data Urodzenia</th>
                        <th>Ubezpieczony</th>
                        <th>Komentarze</th>
                        <th>Grupa Krwi</th>
                        <th>Edytuj</th>
                        <th>Usuń</th>
                    </tr>
                    @foreach ($patients as $user)
                        <tr>
                            <td>{{$user->Name}} {{$user->Surname}}</td>
                            <td>{{$user->BirthDate}}</td>
                            <td>@if($user->IsInsured == 0) Nie @else Tak @endif </td>
                            <td>{{$user->Comments}}</td>
                            <td>{{$user->BloodGroup}}</td>
                            <td>Edytuj</td>
                            <td>Usuń</td>
                        </tr>
                    @endforeach
                    </table>
                        <br><br><h2>Ostatnie wpisy o pacjencie</h2><br><br>
                    <table style="width: 100%">
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
                                <td>Edytuj</td>
                                <td>Usuń</td>
                            </tr>
                        @endforeach
                        </table>
                        {{$cardindexes->links()}}

                    @elseif($emid)
                        <table style="width: 100%">
                            <tr>
                                <th>Imie i Nazwisko</th>
                                <th>Data ostatniego awansu</th>
                                <th>Ranga</th>
                                <th>Data Urodzenia</th>
                                <th>Numer telefonu</th>
                                <th>Pod nadzorem</th>
                                <th>Edytuj</th>
                                <th>Usuń</th>
                            </tr>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{$employee->Name}} {{$employee->Surname}}</td>
                                    <td>{{$employee->LastPromotion}}</td>
                                    <td>{{$employee->Rank}}</td>
                                    <td>{{$employee->BirthDate}}</td>
                                    <td>{{$employee->PhoneNumber}}</td>
                                    <td><a href="{{route('user')}}?emId={{$employee->UnderSupervision}}">{{$employee->UnderSupervision}}</a></td>
                                    <td>Edytuj</td>
                                    <td>Usuń</td>
                                </tr>
                            @endforeach
                        </table>
                        <br><br><br>
                        <table style="width: 100%">
                            <tr>
                                <th>Imie i Nazwisko</th>
                                <th>Odesłanie</th>
                                <th>Data</th>
                                <th>Kategoria Zabiegu</th>
                                <th>Cena</th>
                                <th>Zapłacono</th>
                                <th>Rozpoznanie</th>
                                <th>Zabieg</th>
                                <th>Edytuj</th>
                                <th>Usuń</th>
                            </tr>
                            @foreach ($cards as $card)
                                <tr>
                                    <td><a href="{{route('user')}}?id={{$card->Id}}">{{$card->Name}} {{$card->Surname}}</a></td>
                                    <td>{{$card->Annotation}}</td>
                                    <td>{{$card->Date}}</td>
                                    <td>{{$card->TreatmentCategory}} | {{$card->Description}}</td>
                                    <td>{{$card->Price}}</td>
                                    <td>{{$card->IsPaid}}</td>
                                    <td>{{$card->Recognition}}</td>
                                    <td>{{$card->Treatment}}</td>
                                    <td>Edytuj</td>
                                    <td>Usuń</td>
                                </tr>
                            @endforeach
                        </table>
                        {{$cards->links()}}

                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
