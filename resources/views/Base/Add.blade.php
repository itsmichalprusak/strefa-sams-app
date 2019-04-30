@extends('head')

@section('title', 'SAMS - Dodaj Pracownika')

@section('body')

    <h3 style="margin-top: 10px;" >StrefaRP - Baza SAMS > Dodaj Pracownika</h3>

    <form method="POST" action="{{route('addemployee')}}">
        {{csrf_field()}}

        <div class="form-group">
            <label for="imie">Imię</label>
            <input required type="name" class="form-control bg-dark text-white" id="imie" aria-describedby="firstname" name="name" placeholder="Imię Lekarza">
            <small id="firstname" class="form-text text-muted">Podaj imię pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="nazwisko">Nazwisko</label>
            <input required type="name" name="surname" class="form-control bg-dark text-white" id="nazwisko" placeholder="Nazwisko Lekarza">
            <small id="surname" class="form-text text-muted">Podaj nazwisko pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="ranga">Ranga</label>
            <select required class="form-control bg-dark text-white" name="rank" id="stopien">
                <option value="Szef SAMS">Szef SAMS</option>
                <option value="Dyrektor">Dyrektor</option>
                <option value="Doktor">Doktor</option>
                <option value="Lekarz ratownictwa medycznego">Lekarz ratownictwa medycznego</option>
                <option value="Ratownik Medyczny">Ratownik Medyczny</option>
                <option value="Pielęgniarz">Pielęgniarz</option>
            </select>
            <small id="stopien" class="form-text text-muted">Podaj stopień pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="dataurodzenia">Data urodzin</label>
            <input type="date" onkeydown="return false" name="date" class="form-control bg-dark text-white" id="dataurodzenia" onfocus="(this.type='date')">
            <small id="surname" class="form-text text-muted">Podaj datę urodzenia pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="telefon">Numer telefonu</label>
            <input required pattern="\d+" type="phone" name="phonenumber" class="form-control bg-dark text-white" id="telefon" placeholder="Numer Telefonu">
            <small id="surname" class="form-text text-muted">Podaj numer telefonu pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="przydzial">Osoba nadzorująca</label>
            <select class="form-control bg-dark text-white" name="UnderSupervision" id="Employee">
                <option value="">Brak</option>
                @foreach($employees as $employee)
                    <option value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                @endforeach
            </select>
            <small id="przydzial" class="form-text text-muted">Podaj osobę nadzorującą pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Dodaj pracownika!</button>
        </div>

    </form>

@endsection
