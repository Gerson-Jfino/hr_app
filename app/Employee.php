<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = "employe";
    public $fillable = [
        'user_id',
        'nome_completo',
        'data_admissao',
        'data_fim',
        'situation_id',
        'data_situacao',
        'pelouro_id',
        'uni_org_id',
        'sector_id',
        'categoria_id',
        'nivel_id',
        'salario',
    ];
}
