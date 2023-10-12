<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    public $table = 'documentos';
    public $fillable = [
        'employe_id',
        'name',
        'anexo',
        'type'
    ];
}
