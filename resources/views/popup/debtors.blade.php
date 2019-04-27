<div class="modal fade" id="debtor{{$debtor->Id}}" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header bg-dark">
                <h3 class="modal-title" id="DelTitle">Spłacanie długu</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Czy {{$debtor->Name}} {{$debtor->Surname}} spłacił {{$debtor->Debt}}$ długu?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
                <form method="POST" action="{{Route('UpdateDebtors')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="Id" value="{{$debtor->Id}}">
                    <input type="submit" class="btn btn-success" value="Tak">
                </form>
            </div>
        </div>
    </div>
</div>
