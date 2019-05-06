@extends('layouts.app')

@section('title', 'SAMS')

@section('content')
    <div class="container bg-dark">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark">
                    <div class="card-header bg-dark">Ostatnie Wpisy
                        @if(isset($id))
                            <a class="text-white float-right" href="{{Route('home')}}">Wróć</a>
                        @endif
                    </div>

                    <div class="card-body bg-dark">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="table-responsive bg-dark table-dark">
                            <table class="table w-auto">
                                <tr>
                                    <th scope="col">Imie i Nazwisko</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Lekarz nadzorujacy</th>
                                    <th scope="col">Kategoria zabiegu</th>
                                    <th scope="col">Cena</th>
                                    <th scope="col">Zapłacono</th>
                                    <th scope="col">Rozpoznanie</th>
                                    <th scope="col">Zabieg</th>
                                    <th scope="col">Edytuj</th>
                                    <th scope="col">Usuń</th>
                                </tr>
                                @foreach($cardindexes as $card)
                                    <tr>
                                        <td><a href="{{route('user')}}?id={{$card->Id}}">{{$card->Name}} {{$card->Surname}}</a></td>
                                        <td>{{$card->Date}}</td>
                                        <td><a href="{{route('user')}}?emId={{$card->emId}}">{{$card->emName}} {{$card->emSurname}}</a></td>
                                        <td>{{$card->TreatmentCategory}}</td>
                                        <td>{{$card->Price}}$</td>
                                        <td>@if($card->IsPaid == 0) Nie @else Tak @endif</td>
                                        @if(isset($id))
                                            <td>{{$card->Recognition, 50}}</td>
                                            <td>{{$card->Treatment, 50}}</td>
                                        @else
                                        <td>{{str_limit($card->Recognition, 50)}} @if(strlen($card->Recognition) > 50) <a href="?id={{$card->CardId}}"> &raquo </a> @endif</td>
                                        <td>{{str_limit($card->Treatment, 50)}} @if(strlen($card->Recognition) > 50) <a href="?id={{$card->CardId}}"> &raquo </a> @endif</td>
                                        @endif
                                        <td><button class="btn btn-dark btn-outline-light" data-toggle="modal" data-target="#Form{{$card->CardId}}">Edytuj</button></td>
                                        <td><button class="btn btn-dark btn-outline-light" data-toggle="modal" data-target="#Formd{{$card->CardId}}">Usuń</button></td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                            @foreach($cardindexes as $card)
                                @include('popup.home')
                            @endforeach

                            {{$cardindexes->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
