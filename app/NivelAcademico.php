<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelAcademico extends Model
{
    public $table = "nivel_academico";
    public $fillable = [
        'user_id',
        'nivel_id',
        'curso',
        'instituicao',
        'anexo'
    ];
    public function getAnexoAttribute()
    {
        return $this->attributes['anexo']?  env('APP_URL') . '/' . $this->attributes['anexo'] : '';
    }
    public function nivel()
    {
        return $this->belongsTo(\App\Nivel::class, 'nivel_id');
    }
}
