
<div class="modal fade" id="Form{{$card->CardId}}" tabindex="-1" role="dialog" aria-labelledby="FormCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="FormTitle">Edytuj wpis {{$card->Name}} {{$card->Surname}}</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{route('CardIndexUpdate')}}">
                    {{csrf_field()}}

                    <input type="hidden" value="{{$card->CardId}}" name="CardId">
                    <div class="form-group">
                        <label for="imie">Imię i Nazwisko</label>
                        <select required name="PatientId" class="form-control bg-dark text-white" id="imieSelect" >
                            @foreach($patients as $patient)
                                <option @if($patient->Id == $card->Id) selected @endif value="{{$patient->Id}}"> {{$patient->Name}} {{$patient->Surname}} || @if($patient->IsInsured == 1) Ubezpieczony @elseif($patient->IsInsured == 0) Nieubezpieczony @endif
                                </option>
                            @endforeach
                        </select>
                        <small id="imie" class="form-text text-muted">Podaj Imię i Nazwisko pacjenta, któremu wykonujesz zabieg.</small>
                    </div>
                    <div class="form-group">
                        <label for="date">Data Zabiegu</label>
                        <input required type="date" name="Date" class="form-control bg-dark text-white" onfocus="(this.type='date')" value="{{$card->Date}}">
                        <small id="imie" class="form-text text-muted">Podaj datę wykonania zabiegu.</small>
                    </div>
                    <div class="form-group">
                        <label for="Person">Osoba Nadzorująca</label>
                        <select required name="PersonIssuing" class="form-control bg-dark text-white" id="EmployeeSelect">
                            @foreach($employees as $employee)
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

<div class="modal fade" id="Formd{{$card->CardId}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Usuwanie zabiegu</h3>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Jesteś pewny że chcesz usunąć zabieg?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <form method="POST" action="{{Route('CardIndexDelete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="CardIndexesId" value="{{$card->CardId}}">
                    <input type="submit" class="btn btn-danger" value="Usuń">
                </form>
            </div>
        </div>
    </div>
</div>

