@extends('head')

@section('title', 'SAMS - Dodaj Pracownika')

@section('body')

    <form method="POST" action="{{route('addemployee')}}">
        {{csrf_field()}}

        <div>
            <label>Imię</label>
            <input type="text" name="name" placeholder="Imie">
        </div>
        <div>
            <label>Nazwisko</label>
            <input type="text" name="surname" placeholder="Nazwisko">
        </div>
        <div>
            <label>Ranga</label>
            <input type="text" name="rank" placeholder="Ranga">
        </div>
        <div>
            <label>Data urodzin</label>
            <input type="date" name="date">
        </div>
        <div>
            <label>Numer telefonu</label>
            <input type="text" name="phonenumber" placeholder="Numer Telefonu">
        </div>
        <div>
            <input type="submit" value="Dodaj Pracownika">
        </div>

    </form>

@endsection
