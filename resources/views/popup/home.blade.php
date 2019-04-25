
    <div class="modal fade" id="Form{{$card->CardId}}" tabindex="-1" role="dialog" aria-labelledby="FormCenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="FormTitle">Edytuj wpis {{$card->Name}} {{$card->Surname}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{route('CardIndexUpdate')}}">
                        {{csrf_field()}}

                        <input type="hidden" value="{{$card->CardId}}" name="CardId">
                        <div class="form-group">
                            <label for="imie">Imię i Nazwisko</label>
                            <select name="PatientId" class="form-control" id="imie" >
                                @foreach($patients as $patient)
                                    <option @if($patient->Id == $card->Id) selected @endif value="{{$patient->Id}}"> {{$patient->Name}} {{$patient->Surname}} || @if($patient->IsInsured == 1) Ubezpieczony @elseif($patient->IsInsured == 0) Nieubezpieczony @endif
                                    </option>
                                @endforeach
                            </select>
                            <small id="imie" class="form-text text-muted">Podaj Imię i Nazwisko pacjenta, któremu wykonujesz zabieg.</small>
                        </div>
                        <div class="form-group">
                            <label for="Annotation">Przysłanie</label>
                            <input type="text" name="Annotation" class="form-control" id="Annotation" placeholder="np. LSPD" value="{{$card->Annotation}}">
                            <small id="imie" class="form-text text-muted">Podaj przysłanie pacjenta, jeżeli takie miało miejsce.</small>
                        </div>
                        <div class="form-group">
                            <label for="date">Data Zabiegu</label>
                            <input type="date" name="Date" class="form-control" onfocus="(this.type='date')" value="{{$card->Date}}">
                            <small id="imie" class="form-text text-muted">Podaj datę wykonania zabiegu.</small>
                        </div>
                        <div class="form-group">
                            <label for="Person">Osoba Nadzorująca</label>
                            <select name="PersonIssuing" class="form-control" id="Person">
                                @foreach($employees as $employee)
                                    <option @if($employee->Id == $card->emId) selected @endif value="{{$employee->Id}}">{{$employee->Name}} {{$employee->Surname}}</option>
                                @endforeach
                            </select>
                            <small id="imie" class="form-text text-muted">Podaj osobę wykonanującą zabieg.</small>
                        </div>
                        <div class="form-group">
                            <label for="Category">Kategoria Zabiegu</label>
                            <select name="TreatmentCategory" class="form-control" id="Category">
                                @foreach($treatments as $treatment)
                                    <option @if($treatment->Id == $card->TreatmentId) selected @endif value="{{$treatment->Id}}">{{$treatment->TreatmentCategory}} - {{$treatment->Description}}</option>
                                @endforeach
                            </select>
                            <small id="imie" class="form-text text-muted">Podaj kategorię zabiegu.</small>
                        </div>
                        <div class="form-group">
                            <label for="Price">Cena</label>
                            <input type="text" name="price" class="form-control" id="Price" value="{{$card->Price}}">
                            </select>
                            <small id="imie" class="form-text text-muted">Podaj koszt zabieg.</small>
                        </div>
                        <div class="form-group">
                            <label for="Paid">Zapłacono</label>
                            <select name="IsPaid" class="form-control" id="Paid">
                                <option @if($card->IsPaid == 0) selected @endif value="0">Nie</option>
                                <option @if($card->IsPaid == 1) selected @endif value="1">Tak</option>
                            </select>
                            <small id="imie" class="form-text text-muted">Podaj czy osoba zapłaciła za zabieg.</small>
                        </div>
                        <div class="form-group">
                            <label for="Recognition">Rozpoznanie</label>
                            <textarea name="Recognition" class="form-control" id="Recognition">{{$card->Recognition}}</textarea>
                            <small id="imie" class="form-text text-muted">Podaj Rozpoznanie pacjenta (Jakie rany, co go bolało).</small>
                        </div>
                        <div class="form-group">
                            <label for="Treatment">Zabieg</label>
                            <textarea name="Treatment" class="form-control" id="Treatment">{{$card->Treatment}}</textarea>
                            <small id="imie" class="form-text text-muted">Podaj działania jakie wykonałeś podczas zabiegu np. założony gips, przypisane leki raz dziennie przez tydzień.</small>
                        </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Zapisz zmiany!">
                            </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                </div>
            </div>
        </div>
    </div>
