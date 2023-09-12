<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalData extends Model
{
    use SoftDeletes;
    public $table = "personal_data";
}
