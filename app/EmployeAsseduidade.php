<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmployeAsseduidade extends Model
{
    public $table = 'employe_asseduidade';
    use SoftDeletes;
    public $fillable = [
        'employe_id',
        'data_inicio',
        'data_fim',
        'absentismo',
        'observacoes',
        'anexo'
    ];
    public function employe()
    {
        return $this->belongsTo(\App\Employee::class, 'employe_id');
    }
}
