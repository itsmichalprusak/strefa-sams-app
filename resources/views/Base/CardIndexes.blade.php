@extends('head')

@section('title', 'SAMS - Dodaj Zabieg')

@section('body')

    <h3 style="margin-top: 10px;" >StrefaRP - Baza SAMS > Dodaj Zabieg</h3>
    <form method="POST" action="{{route('CardIndexesDb')}}">
        {{csrf_field()}}

        <div class="form-group">
            <label for="imie">Imię i Nazwisko</label>
            <select name="PatientId" class="form-control" id="imie">
                @foreach($patients as $patient)
                    <option value="{{$patient->Id}}">{{$patient->Name}} {{$patient->Surname}} || @if($patient->IsInsured == 1) Ubezpieczony @elseif($patient->IsInsured == 0) Nieubezpieczony @endif</option>
                @endforeach
            </select>
            <small id="imie" class="form-text text-muted">Podaj Imię i Nazwisko pacjenta, któremu wykonujesz zabieg.</small>
        </div>
        <div class="form-group">
            <label for="Annotation">Przysłanie</label>
            <input type="text" name="Annotation" class="form-control" id="Annotation" placeholder="np. LSPD">
            <small id="imie" class="form-text text-muted">Podaj przysłanie pacjenta, jeżeli takie miało miejsce.</small>
        </div>
        <div class="form-group">
            <label for="date">Data Zabiegu</label>
            <input type="date" name="Date" class="form-control" onfocus="(this.type='date')" value="{{date("Y-m-d")}}">
            <small id="imie" class="form-text text-muted">Podaj datę wykonania zabiegu.</small>
        </div>
        <div class="form-group">
            <label for="Person">Osoba Nadzorująca</label>
            <select name="PersonIssuing" class="form-control" id="Person">
                @foreach($employees as $employee)
                    <option value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                @endforeach
            </select>
            <small id="imie" class="form-text text-muted">Podaj osobę wykonanującą zabieg.</small>
        </div>
        <div class="form-group">
            <label for="Category">Kategoria Zabiegu</label>
            <select name="TreatmentCategory" class="form-control" id="Category">
                @foreach($treatments as $treatment)
                    <option value="{{$treatment->Id}}">{{$treatment->TreatmentCategory}} - {{$treatment->Description}}</option>
                @endforeach
            </select>
            <small id="imie" class="form-text text-muted">Podaj kategorię zabiegu.</small>
        </div>
        <div class="form-group">
            <label for="Price">Cena</label>
                <input type="text" name="price" class="form-control" id="Price">
            </select>
            <small id="imie" class="form-text text-muted">Podaj koszt zabieg.</small>
        </div>
        <div class="form-group">
            <label for="Paid">Zapłacono</label>
            <select name="IsPaid" class="form-control" id="Paid">
                <option value="0">Nie</option>
                <option value="1">Tak</option>
            </select>
            <small id="imie" class="form-text text-muted">Podaj czy osoba zapłaciła za zabieg.</small>
        </div>
        <div class="form-group">
            <label for="Recognition">Rozpoznanie</label>
                <textarea name="Recognition" class="form-control" id="Recognition">Zauważono: </textarea>
            <small id="imie" class="form-text text-muted">Podaj Rozpoznanie pacjenta (Jakie rany, co go bolało).</small>
        </div>
        <div class="form-group">
            <label for="Treatment">Zabieg</label>
            <textarea name="Treatment" class="form-control" id="Treatment">Zrobiono: </textarea>
            <small id="imie" class="form-text text-muted">Podaj działania jakie wykonałeś podczas zabiegu np. założony gips, przypisane leki raz dziennie przez tydzień.</small>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Dodaj Zabieg">
        </div>

    </form>

    <div class="table-responsive">
        <table style="width: 100%" class="table">
            <tr>
                <th scope="col">Kategoria Zabiegu</th>
                <th scope="col">Cena Minimalna bez ubezpieczenia</th>
                <th scope="col">Cena Maksymalna bez ubezpieczenia</th>
                <th scope="col">Cena Minimalna z ubezpieczenia</th>
                <th scope="col">Cena Maksymalna z ubezpieczenia</th>
                <th scope="col">Opis</th>
            </tr>
            @foreach($treatments as $treatment)
                <tr>
                    <td>{{$treatment->TreatmentCategory}}</td>
                    <td>@if($treatment->UnInsurancePriceMin == 99999) --------- @else {{$treatment->UnInsurancePriceMin}} @endif</td>
                    <td>@if($treatment->UnInsurancePriceMax == 99999) --------- @else {{$treatment->UnInsurancePriceMax}} @endif</td>
                    <td>{{$treatment->InsurancePriceMin}}</td>
                    <td>{{$treatment->InsurancePriceMax}}</td>
                    <td>{{$treatment->Description}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
