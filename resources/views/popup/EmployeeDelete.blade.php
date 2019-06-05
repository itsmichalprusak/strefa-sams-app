<div class="modal fade" id="employeeDelete{{$employee->Id}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Usuń Pracownika</h3>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Czy chcesz usunąć konto dla {{$employee->Name}} {{$employee->Surname}}?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
                <form method="POST" action="{{Route('EmployeeUsersDelete')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="Id" value="{{$employee->Id}}">
                    <input type="submit" class="btn btn-success" value="Tak">
                </form>
            </div>
        </div>
    </div>
</div>

