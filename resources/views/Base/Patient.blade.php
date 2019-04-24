@extends('head')

@section('title', 'SAMS - Dodaj Pacjenta')

@section('body')

    <form method="POST" action="{{route('addpatient')}}">
        {{csrf_field()}}

        <div>
            <label>Imię</label>
            <input type="text" name="Name" placeholder="Imie">
        </div>
        <div>
            <label>Nazwisko</label>
            <input type="text" name="Surname" placeholder="Nazwisko">
        </div>
        <div>
            <label>Email</label>
            <input type="text" name="Email" placeholder="Email">
        </div>
        <div>
            <label>Numer telefonu</label>
            <input type="text" name="PhoneNumber" placeholder="Numer Telefonu">
        </div>
        <div>
            <label>Data urodzin</label>
            <input type="date" name="date">
        </div>
        <div>
            <label>Uwagi</label>
            <textarea cols="50" name="Comments" placeholder="asd"></textarea>
        </div>
        <div>
            <label>Grupa Krwi</label>
            <select name="BloodGroup">
                <option value="1">0 Rh+</option>
                <option value="2">0 Rh-</option>
                <option value="3">A Rh+</option>
                <option value="4">A Rh-</option>
                <option value="5">B Rh+</option>
                <option value="6">B Rh-</option>
                <option value="7">AB Rh+</option>
                <option value="8">AB Rh-</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Dodaj Pacjenta">
        </div>

    </form>

@endsection
