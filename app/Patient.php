<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Patient extends Model
{
    use Sortable;

    public $sortable=['Id', 'Name', 'Surname', 'IsInsured', 'BirthDate', 'PhoneNumber'];
}
