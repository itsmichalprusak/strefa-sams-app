@extends('head')

@section('title', 'SAMS - Dodaj Zabieg')

@section('body')

    <form method="POST" action="{{route('CardIndexesDb')}}">
        {{csrf_field()}}

        <div>
            <label>Imię i Nazwisko</label>
            <select name="PatientId">
                @foreach($patients as $patient)
                    <option value="{{$patient->Id}}">{{$patient->Name}} {{$patient->Surname}} || @if($patient->IsInsured == 1) Ubezpieczony @elseif($patient->IsInsured == 0) Nieubezpieczony @endif</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Przysłanie</label>
            <input type="text" name="Annotation" placeholder="np. LSPD">
        </div>
        <div>
            <label>Data Zabiegu</label>
            <input type="date" name="Date">
        </div>
        <div>
            <label>Osoba Nadzorująca</label>
            <select name="PersonIssuing">
                @foreach($employees as $employee)
                    <option value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Kategoria Zabiegu</label>
            <select name="TreatmentCategory">
                @foreach($treatments as $treatment)
                    <option value="{{$treatment->Id}}">{{$treatment->TreatmentCategory}} - {{$treatment->Description}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Cena</label>
                <input type="text" name="price">
            </select>
        </div>
        <div>
            <label>Zapłacono?</label>
            <select name="IsPaid">
                <option value="0">Nie</option>
                <option value="1">Tak</option>
            </select>
        </div>
        <div>
            <label>Rozpoznanie</label>
                <textarea name="Recognition" cols="50">Zauważono: </textarea>
        </div>
        <div>
            <label>Zabieg</label>
            <textarea name="Treatment" cols="50">Zrobiono: </textarea>
        </div>
        <div>
            <input type="submit" value="Dodaj Zabieg">
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
                    <td>{{$treatment->UnInsurancePriceMin}}</td>
                    <td>{{$treatment->UnInsurancePriceMax}}</td>
                    <td>{{$treatment->InsurancePriceMin}}</td>
                    <td>{{$treatment->InsurancePriceMax}}</td>
                    <td>{{$treatment->Description}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
