@foreach ($employees as $employee)
<div class="modal fade" id="UserEmployeeForm{{$employee->Id}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Edytowanie Danych pracowników</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('UserEditEmployee')}}">
                    {{csrf_field()}}

                    <input type="hidden" name="EmployeeId" value="{{$employee->Id}}">
                    <div class="form-group">
                        <label for="imie">Imię</label>
                        <input required type="name" class="form-control bg-dark text-white" id="imie" aria-describedby="firstname" name="name" placeholder="Imię Lekarza" value="{{$employee->Name}}">
                        <small id="firstname" class="form-text text-muted">Podaj imię pracownika, którego chcesz dodać do bazy.</small>
                    </div>
                    <div class="form-group">
                        <label for="nazwisko">Nazwisko</label>
                        <input required type="name" name="surname" class="form-control bg-dark text-white" id="nazwisko" placeholder="Nazwisko Lekarza" value="{{$employee->Surname}}">
                        <small id="surname" class="form-text text-muted">Podaj nazwisko pracownika, którego chcesz dodać do bazy.</small>
                    </div>
                    <div class="form-group">
                        <label for="ranga">Ranga</label>
                        <select required class="form-control bg-dark text-white" name="rank" id="stopien">
                            <option @if($employee->Rank == 'Szef SAMS') Selected @endif value="Szef SAMS">Szef SAMS</option>
                            <option @if($employee->Rank == 'Dyrektor') Selected @endif value="Dyrektor">Dyrektor</option>
                            <option @if($employee->Rank == 'Lekarz ratownictwa medycznego') Selected @endif value="Lekarz ratownictwa medycznego">Lekarz ratownictwa medycznego</option>
                            <option @if($employee->Rank == 'Ratownik Medyczny') Selected @endif value="Ratownik Medyczny">Ratownik Medyczny</option>
                            <option @if($employee->Rank == 'Pielęgniarz') Selected @endif value="Pielęgniarz">Pielęgniarz</option>
                        </select>
                        <small id="stopien" class="form-text text-muted">Podaj stopień pracownika, którego chcesz dodać do bazy.</small>
                    </div>
                    <div class="form-group">
                        <label for="dataurodzenia">Data urodzin</label>
                        <input type="date" name="date" class="form-control bg-dark text-white" id="dataurodzenia" onfocus="(this.type='date')" value="{{$employee->BirthDate}}">
                        <small id="surname" class="form-text text-muted">Podaj datę urodzenia pracownika, którego chcesz dodać do bazy.</small>
                    </div>
                    <div class="form-group">
                        <label for="nazwisko">Numer telefonu</label>
                        <input required type="phone" name="phonenumber" class="form-control bg-dark text-white" id="telefon" placeholder="Numer Telefonu" value="{{$employee->PhoneNumber}}">
                        <small id="surname" class="form-text text-muted">Podaj numer telefonu pracownika, którego chcesz dodać do bazy.</small>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Edytuj pracownika!</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($cards as $card)

    <div class="modal fade" id="UserEmployeeFormTwo{{$card->CardId}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered bg-dark" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h3 class="modal-title" id="DelTitle">Usuwanie zabiegu</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('UserEditEmployeeTwo')}}">
                        {{csrf_field()}}

                        <input type="hidden" value="{{$card->CardId}}" name="CardId">
                        <div class="form-group">
                            <label for="imie">Imię i Nazwisko</label>
                            <select required name="PatientId" class="form-control bg-dark text-white" id="imie" >
                                @foreach($patientstwo as $patient)
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
                            <select required name="PersonIssuing" class="form-control bg-dark text-white" id="Person">
                                @foreach($employeestwo as $employee)
                                    <option @if($employee->Id == $card->emId) selected @endif value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                                @endforeach
                            </select>
                            <small id="imie" class="form-text text-muted">Podaj osobę wykonanującą zabieg.</small>
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
                            <label  for="Price">Cena</label>
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

    <div class="modal fade" id="UserEmployeeFormTwoDelete{{$card->CardId}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header bg-dark">
                    <h3 class="modal-title bg-dark" id="DelTitle">Usuwanie zabiegu</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-dark">
                    <h4>Jesteś pewny że chcesz usunąć zabieg?</h4>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <form method="POST" action="{{Route('UserEmployeeFormTwoDelete')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="CardIndexesId" value="{{$card->CardId}}">
                        <input type="submit" class="btn btn-danger" value="Usuń">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach
