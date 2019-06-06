<div class="modal fade" id="employeeEdit{{$employee->Id}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Edycja danych pracownika</h3>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{Route('UserEditEmployee')}}">
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
                            <option @if($employee->Rank == 'Doktor') Selected @endif value="Doktor">Doktor</option>
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
                        <small id="surname" class="form-text text-muted">Podaj numer telefonu pracownika, na jaki chcesz zmienić.</small>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Edytuj pracownika!</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
            </div>
        </div>
    </div>
</div>
