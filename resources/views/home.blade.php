@extends('layouts.app')

@section('title', 'SAMS')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ostatnie Wpisy</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table style="width: 100%" class="table">
                                <tr>
                                    <th scope="col">Imie i Nazwisko</th>
                                    <th scope="col">Odesłanie</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Lekarz nadzorujacy</th>
                                    <th scope="col">Kategoria zabiegu</th>
                                    <th scope="col">Cena</th>
                                    <th scope="col">Zapłacono?</th>
                                    <th scope="col">Rozpoznanie</th>
                                    <th scope="col">Zabieg</th>
                                </tr>
                                @foreach($cardindexes as $card)
                                    <tr>
                                        <td><a href="{{route('user')}}?id={{$card->Id}}">{{$card->Name}} {{$card->Surname}}</a></td>
                                        <td>{{$card->Annotation}}</td>
                                        <td>{{$card->Date}}</td>
                                        <td><a href="{{route('user')}}?emId={{$card->emId}}">{{$card->emName}} {{$card->emSurname}}</a></td>
                                        <td>{{$card->TreatmentCategory}}</td>
                                        <td>{{$card->Price}}</td>
                                        <td>@if($card->IsPaid == 0) Nie @else Tak @endif</td>
                                        <td>{{$card->Recognition}}</td>
                                        <td>{{$card->Treatment}}</td>
                                    </tr>
                                @endforeach
                            </table>

                            {{$cardindexes->links()}}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
