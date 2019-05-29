@foreach($insurances as $insurance)
<div class="modal fade" id="InsuranceEdit{{$insurance->InId}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Edytowanie zabiegu</h3>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{route('EditInsurance')}}">
                    {{csrf_field()}}

                    <input type="hidden" name="id" value="{{$insurance->InId}}">
                    <div class="form-group">
                        <label for="imie">Imię i Nazwisko</label>
                        <select required name="PatientId" class="form-control bg-dark text-white" id="imieSelect">
                            @foreach($patients as $patient)
                                <option @if($insurance->Id == $patient->Id) Selected @endif value="{{$patient->Id}}">{{$patient->Name}} {{$patient->Surname}}</option>
                            @endforeach
                        </select>
                        <small id="stopien" class="form-text text-muted">Podaj Imię i Nazwisko pacjenta, dla którego chcesz dodać ubezpieczenie.</small>
                    </div>
                    <div class="form-group">
                        <label for="price">Kwota</label>
                        <select required class="form-control bg-dark text-white" name="InsurancePrice" id="price">
                            <option @if($insurance->InsuranceAmount == 800) Selected @endif value="800">800</option>
                            <option @if($insurance->InsuranceAmount == 1300) Selected @endif value="1300">1300</option>
                            <option @if($insurance->InsuranceAmount == 2200) Selected @endif value="2200">2200</option>
                            <option @if($insurance->InsuranceAmount == 9999) Selected @endif value="9999">0 | Służby porządkowe</option>
                        </select>
                        <small id="stopien" class="form-text text-muted">Podaj Kwotę ubezpieczenia, dla pacjenta.</small>
                    </div>
                    <div class="form-group">
                        <label for="date">Data Dodania</label>
                        <input required type="date" name="Date"  class="form-control bg-dark text-white" id="date" onfocus="(this.type='date')" value="{{$insurance->InsuranceDate}}">
                        <small id="date" class="form-text text-muted">Podaj Datę utworzenia wpisu ubezpieczenia.</small>
                    </div>
                    <div class="form-group">
                        <label for="Employee">Osoba Dodająca</label>
                        <select required class="form-control bg-dark text-white" name="PersonIssuing" id="EmployeeSelect">
                            @foreach($employees as $employee)
                                <option @if($insurance->emId == $employee->Id) Selected @endif value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                            @endforeach
                        </select>
                        <small id="Employee" class="form-text text-muted">Podaj osobę nadającą ubezpieczenie.</small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary bg-dark text-white">Edytuj Ubezpieczenie!</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteInsurance{{$insurance->InId}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Usuwanie ubezpieczenia</h3>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Jesteś pewny że chcesz usunąć ubezpieczenie?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <form method="POST" action="{{Route('DeleteInsurance')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="InsuranceId" value="{{$insurance->InId}}">
                    <input type="hidden" name="PatientId" value="{{$insurance->Id}}">
                    <input type="submit" class="btn btn-danger" value="Usuń">
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
