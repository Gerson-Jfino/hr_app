<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desempenho extends Model
{
    public $table = 'desempenho';
    public $fillable = [
        'employe_id',
        'data_avalicao',
        'avaliacao',
        'anexo',
        'type'
    ];
}
