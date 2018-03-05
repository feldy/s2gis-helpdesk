<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SCMasFormModel extends Model
{
    protected $connection= 'db-sales';
    protected $table = 'sc_mas_form';
    protected $primaryKey = 'sid';
    public $incrementing = false;
}
