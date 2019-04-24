@extends('head')

@section('title', 'SAMS')

@section('body')
    @if(Auth::guest())
        <a href="{{route('login')}}" class ="login_SAMS">
            <div class="select_SAMS">
                <p class="Login_Text">Login to SAMS Database</p>
            </div>
        </a>
    @else
        <script>window.location = "{{route('home')}}";</script>
    @endif
@endsection
