@foreach($patients as $user)
<div class="modal fade" id="FormEdit{{$user->Id}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
        <div class="modal-header bg-dark">
            <h3 class="modal-title" id="DelTitle">Edycja danych pacjenta</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{Route('UsersPatientsEdit')}}">
                {{csrf_field()}}
                <input type="hidden" name="Id" value="{{$user->Id}}">
                <div class="form-group">
                    <label for="imie">Imię</label>
                    <input type="name" name="Name" id="imie" aria-describedby="firstname" placeholder="Imię Pacjenta" class="form-control bg-dark text-white" value="{{$user->Name}}">
                    <small id="firstname" class="form-text text-muted">Podaj imię pacjenta, którego chcesz dodać do bazy.</small>
                </div>
                <div class="form-group">
                    <label for="nazwisko">Nazwisko</label>
                    <input type="name" name="Surname" id="nazwisko" aria-describedby="nazwisko" placeholder="Nazwisko Pacjenta" class="form-control bg-dark text-white" value="{{$user->Surname}}">
                    <small id="nazwisko" class="form-text text-muted">Podaj Nazwisko pacjenta, którego chcesz dodać do bazy.</small>
                </div>
                <div class="form-group">
                    <label for="Email">Nick Discord</label>
                    <input type="name" name="Email" id="Email" placeholder="Nick Discord" aria-describedby="Email" class="form-control bg-dark text-white" value="{{$user->Email}}">
                    <small id="Email" class="form-text text-muted">Podaj nick na Discord'dzie pacjenta, którego chcesz dodać do bazy.</small>
                </div>
                <div class="form-group">
                    <label for="PhoneNumber">Numer telefonu</label>
                    <input type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Numer Telefonu" aria-describedby="PhoneNumber" class="form-control bg-dark text-white" value="{{$user->PhoneNumber}}">
                    <small id="PhoneNumber" class="form-text text-muted">Podaj Numer Telefonu pacjenta, którego chcesz dodać do bazy.</small>
                </div>
                <div class="form-group">
                    <label for="dataurodzenia">Data urodzin</label>
                    <input type="date" name="BirthDate" class="form-control bg-dark text-white" id="dataurodzenia" onfocus="(this.type='date')" value="{{$user->BirthDate}}">
                    <small id="date" class="form-text text-muted">Podaj datę urodzenia pacjenta, którego chcesz dodać do bazy.</small>
                </div>
                <div class="form-group">
                    <label for="Comments">Uwagi</label>
                    <textarea name="Comments" class="form-control bg-dark text-white" id="Comments" aria-describedby="Comments" placeholder="Choroby, Leki, Leczenia">{{$user->Comments}}</textarea>
                    <small id="Comments" class="form-text text-muted">Podaj Alergie, leki itd. pacjenta, którego chcesz dodać do bazy.</small>
                </div>
                <div class="form-group">
                    <label for="BloodGroup">Grupa Krwi</label>
                    <select name="BloodGroup" class="form-control bg-dark text-white" id="BloodGroup" aria-describedby="BloodGroup">
                        <option @if($user->BloodGroupId == 1) selected @endif value="1">0 Rh+</option>
                        <option @if($user->BloodGroupId == 2) selected @endif value="2">0 Rh-</option>
                        <option @if($user->BloodGroupId == 3) selected @endif value="3">A Rh+</option>
                        <option @if($user->BloodGroupId == 4) selected @endif value="4">A Rh-</option>
                        <option @if($user->BloodGroupId == 5) selected @endif value="5">B Rh+</option>
                        <option @if($user->BloodGroupId == 6) selected @endif value="6">B Rh-</option>
                        <option @if($user->BloodGroupId == 7) selected @endif value="7">AB Rh+</option>
                        <option @if($user->BloodGroupId == 8) selected @endif value="8">AB Rh-</option>
                    </select>
                    <small id="BloodGroup" class="form-text text-muted bg-dark text-white">Podaj Grupę krwi pacjenta, którego chcesz dodać do bazy.</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Edytuj dane pacjenta!</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="DeletePatient{{$user->Id}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Usuń pacjęta</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Ar ju siure?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <form method="POST" action="{{Route('UserDeletePatient')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$user->Id}}">
                    <input type="submit" class="btn btn-danger" value="Usuń">
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($cardindexes as $card)
<div class="modal fade" id="FormEditd{{$card->CardId}}" tabindex="-1" role="dialog" aria-labelledby="FormCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="FormTitle">Edytuj wpis {{$card->Name}} {{$card->Surname}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{route('UserCardIndexUpdate')}}">
                    {{csrf_field()}}

                    <input type="hidden" value="{{$card->CardId}}" name="CardId">
                    <div class="form-group">
                        <label for="imie">Imię i Nazwisko</label>
                        <select required name="PatientId" class="form-control bg-dark text-white" id="imie" >
                            @foreach($patients as $patient)
                                <option @if($patient->Id == $card->Id) selected @endif value="{{$patient->Id}}"> {{$patient->Name}} {{$patient->Surname}} || @if($patient->IsInsured == 1) Ubezpieczony @elseif($patient->IsInsured == 0) Nieubezpieczony @endif
                                </option>
                            @endforeach
                        </select>
                        <small id="imie" class="form-text text-muted">Podaj Imię i Nazwisko pacjenta, któremu wykonujesz zabieg.</small>
                    </div>
                    <div class="form-group">
                        <label for="Annotation">Przysłanie</label>
                        <input type="text" name="Annotation" class="form-control bg-dark text-white" id="Annotation" placeholder="np. LSPD" value="{{$card->Annotation}}">
                        <small id="imie" class="form-text text-muted">Podaj przysłanie pacjenta, jeżeli takie miało miejsce.</small>
                    </div>
                    <div class="form-group">
                        <label for="date">Data Zabiegu</label>
                        <input required type="date" name="Date" class="form-control bg-dark text-white" onfocus="(this.type='date')" value="{{$card->Date}}">
                        <small id="imie" class="form-text text-muted">Podaj datę wykonania zabiegu.</small>
                    </div>
                    <div class="form-group">
                        <label for="Person">Osoba Nadzorująca</label>
                        <select required name="PersonIssuing" class="form-control bg-dark text-white" id="EmployeeSelect">
                            @foreach($employeestwo as $employee)
                                <option @if($employee->Id == $card->emId) selected @endif value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                            @endforeach
                        </select>
                        <small id="imie" class="form-text text-muted bg-dark text-white">Podaj osobę wykonanującą zabieg.</small>
                    </div>
                    <div class="form-group">
                        <label for="Category">Kategoria Zabiegu</label>
                        <select required name="TreatmentCategory" class="form-control bg-dark text-white" id="Category">
                            @foreach($treatments as $treatment)
                                <option @if($treatment->Id == $card->TreatmentId) selected @endif value="{{$treatment->Id}}">{{$treatment->TreatmentCategory}} - {{$treatment->Description}}</option>
                            @endforeach
                        </select>
                        <small id="imie" class="form-text text-muted">Podaj kategorię zabiegu.</small>
                    </div>
                    <div class="form-group">
                        <label for="Price">Cena</label>
                        <input required type="text" name="price" class="form-control bg-dark text-white" id="Price" value="{{$card->Price}}">
                        </select>
                        <small id="imie" class="form-text text-muted">Podaj koszt zabieg.</small>
                    </div>
                    <div class="form-group">
                        <label for="Paid">Zapłacono</label>
                        <select required name="IsPaid" class="form-control bg-dark text-white" id="Paid">
                            <option @if($card->IsPaid == 0) selected @endif value="0">Nie</option>
                            <option @if($card->IsPaid == 1) selected @endif value="1">Tak</option>
                        </select>
                        <small id="imie" class="form-text text-muted">Podaj czy osoba zapłaciła za zabieg.</small>
                    </div>
                    <div class="form-group">
                        <label for="Recognition">Rozpoznanie</label>
                        <textarea required name="Recognition" class="form-control bg-dark text-white" id="Recognition">{{$card->Recognition}}</textarea>
                        <small id="imie" class="form-text text-muted">Podaj Rozpoznanie pacjenta (Jakie rany, co go bolało).</small>
                    </div>
                    <div class="form-group">
                        <label for="Treatment">Zabieg</label>
                        <textarea required name="Treatment" class="form-control bg-dark text-white" id="Treatment">{{$card->Treatment}}</textarea>
                        <small id="imie" class="form-text text-muted">Podaj działania jakie wykonałeś podczas zabiegu np. założony gips, przypisane leki raz dziennie przez tydzień.</small>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Zapisz zmiany!">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="FormEditdel{{$card->CardId}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Usuwanie zabiegu</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Jesteś pewny że chcesz usunąć zabieg?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <form method="POST" action="{{Route('UserCardIndexDelete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="CardIndexesId" value="{{$card->CardId}}">
                    <input type="submit" class="btn btn-danger" value="Usuń">
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
