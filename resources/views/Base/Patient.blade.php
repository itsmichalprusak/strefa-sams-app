@extends('head')

@section('title', 'SAMS - Dodaj Pacjenta')

@section('body')

    <h3 style="margin-top: 10px;">Baza SAMS > Dodaj Pacjenta</h3>
    <form method="POST" action="{{route('addpatient')}}">
        {{csrf_field()}}

        <div class="form-group">
            <label for="imie">Imię</label>
            <input required type="name" name="Name" id="imie" aria-describedby="firstname" placeholder="Imię Pacjenta" class="form-control bg-dark text-white">
            <small id="firstname" class="form-text text-muted">Podaj imię pacjenta, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="nazwisko">Nazwisko</label>
            <input required type="name" name="Surname" id="nazwisko" aria-describedby="nazwisko" placeholder="Nazwisko Pacjenta" class="form-control bg-dark text-white">
            <small id="nazwisko" class="form-text text-muted">Podaj Nazwisko pacjenta, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="Email">Nick Discord</label>
            <input required type="name" name="Email" id="Email" placeholder="Nick Discord" aria-describedby="Email" class="form-control bg-dark text-white">
            <small id="Email" class="form-text text-muted">Podaj nick na Discord'dzie pacjenta, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="PhoneNumber">Numer telefonu</label>
            <input required pattern="\d+" type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Numer Telefonu" aria-describedby="PhoneNumber" class="form-control bg-dark text-white">
            <small id="PhoneNumber" class="form-text text-muted">Podaj Numer Telefonu pacjenta, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="dataurodzenia">Data urodzin</label>
            <input type="date" onkeydown="return false" name="date" class="form-control bg-dark text-white" id="dataurodzenia" onfocus="(this.type='date')">
            <small id="date" class="form-text text-muted">Podaj datę urodzenia pacjenta, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="Comments">Uwagi</label>
            <textarea required name="Comments" class="form-control bg-dark text-white" id="Comments" aria-describedby="Comments" placeholder="Choroby, Leki, Leczenia"></textarea>
            <small id="Comments" class="form-text text-muted">Podaj Alergie, leki itd. pacjenta, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <label for="BloodGroup">Grupa Krwi</label>
            <select required name="BloodGroup" class="form-control bg-dark text-white" id="BloodGroup" aria-describedby="BloodGroup">
                <option value="1">0 Rh+</option>
                <option value="2">0 Rh-</option>
                <option value="3">A Rh+</option>
                <option value="4">A Rh-</option>
                <option value="5">B Rh+</option>
                <option value="6">B Rh-</option>
                <option value="7">AB Rh+</option>
                <option value="8">AB Rh-</option>
            </select>
            <small id="BloodGroup" class="form-text text-muted">Podaj Grupę krwi pacjenta, którego chcesz dodać do bazy.</small>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"> Dodaj Pacjenta!</button>
        </div>

    </form>

@endsection
