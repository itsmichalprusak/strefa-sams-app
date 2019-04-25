@extends('head')

@section('title', 'Baza SAMS - StrefaRP')

@section('body')
    @if(Auth::guest())
        <div class="card text-center" style="margin-top: 10px;">
            <div class="card-body">
                <a href="{{route('login')}}" class="btn btn-primary btn-lg">Wejdź do bazy!</a>
            </div>
        </div>
    @else
        <script>window.location = "{{route('home')}}";</script>
    @endif
@endsection
