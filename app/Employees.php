<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Employees extends Model
{
    use Sortable;
    public $sortable = ['Id', 'Name', 'Surname', 'LastPromotion', 'Rank', 'BirthDate', 'PhoneNumber', 'UnderSupervision'];
}
