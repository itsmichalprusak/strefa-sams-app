@extends('head')

@section('title', 'SAMS - Dodaj Pracownika')

@section('body')

    <h3 style="margin-top: 10px;" >StrefaRP - Baza SAMS > Dodaj Pracownika</h3>

    <form method="POST" action="{{route('addemployee')}}">
        {{csrf_field()}}

        <div class="form-group">
            <label for="imie">Imię</label>
            <input type="name" class="form-control" id="imie" aria-describedby="firstname" name="name" placeholder="Imię Lekarza">
            <small id="firstname" class="form-text text-muted">Podaj imię pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="nazwisko">Nazwisko</label>
            <input type="name" name="surname" class="form-control" id="nazwisko" placeholder="Nazwisko Lekarza">
            <small id="surname" class="form-text text-muted">Podaj nazwisko pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="ranga">Ranga</label>
            <select class="form-control" name="rank" id="stopien">
                <option value="Szef SAMS">Szef SAMS</option>
                <option value="Dyrektor">Dyrektor</option>
                <option value="Lekarz ratownictwa medycznego">Lekarz ratownictwa medycznego</option>
                <option value="Ratownik Medyczny">Ratownik Medyczny</option>
                <option value="Szef SAMS">Pielęgniarz</option>
            </select>
            <small id="stopien" class="form-text text-muted">Podaj stopień pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="dataurodzenia">Data urodzin</label>
            <input type="date" name="date" class="form-control" id="dataurodzenia" onfocus="(this.type='date')">
            <small id="surname" class="form-text text-muted">Podaj datę urodzenia pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="nazwisko">Numer telefonu</label>
            <input type="phone" name="phonenumber" class="form-control" id="telefon" placeholder="Numer Telefonu">
            <small id="surname" class="form-text text-muted">Podaj numer telefonu pracownika, którego chcesz dodać do bazy.</small>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Dodaj pracownika!</button>
        </div>

    </form>

@endsection
