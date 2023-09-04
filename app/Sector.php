<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public $table = "sector";

    public function regiao()
    {
        return $this->belongsTo(\App\Regiao::class, 'regiao_id');
    }
    public function UnidadeOrganica()
    {
        return $this->belongsTo(\App\UnidadeOrganica::class, 'uni_org_id');
    }

}
