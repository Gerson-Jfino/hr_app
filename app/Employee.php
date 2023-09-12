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
    public function situation()
    {
        return $this->belongsTo(\App\Situation::class, 'situation_id');
    }
    public function pelouro()
    {
        return $this->belongsTo(\App\Pelouro::class, 'pelouro_id');
    }
    public function sector()
    {
        return $this->belongsTo(\App\Sector::class, 'sector_id');
    }
    public function uni_org()
    {
        return $this->belongsTo(\App\UnidadeOrganica::class, 'uni_org_id');
    }
    public function categoria()
    {
        return $this->belongsTo(\App\Categoria::class, 'categoria_id');
    }
    public function nivel()
    {
        return $this->belongsTo(\App\Nivel::class, 'nivel_id');
    }
}
