@extends('head')

@section('title', 'StrefaRP SAMS - Baza danych')

@section('body')
    @if(Auth::guest())
        <div class="card text-center bg-dark" style="margin-top: 10px;">
            <div class="card-body bg-dark">
                <a href="{{route('login')}}" class="btn btn-primary btn-lg">Wejdź do bazy!</a>
            </div>
        </div>
    @else
        <script>window.location = "{{route('home')}}";</script>
    @endif
@endsection
