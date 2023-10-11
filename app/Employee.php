<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
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
        'inss',
        'contrato'
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
    public function scopefilterEmploye($query, $filters, $recruiter_id = null)
    {
        $name = $filters['name'];
        $situation = $filters['situation'];
        $pelouro = $filters['pelouro'];
        $uni_org = $filters['uni_org'];

        if (!empty($name)) {
            return $query->where('nome_completo', 'LIKE', "%$name%");

        } elseif (!empty($situation)) {
            return $query->where('situation_id', $situation);
        }
        elseif (!empty($pelouro)) {
            return $query->where('pelouro_id', $pelouro);
        }
        elseif (!empty($uni_org)) {
            return $query->where('uni_org_id', $uni_org);
        } else {
            return $query;
        }
    }
}
