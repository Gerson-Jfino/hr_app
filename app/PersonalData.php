<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalData extends Model
{
    use SoftDeletes;
    public $table = "personal_data";
    public $fillable = [
        'user_id',
        'nome_completo',
        'nuit',
        'data_nascimento',
        'genero',
        'estado_civil',
        'nacionalidade',
        'tipo_documento',
        'anexo_documento',
        'nr_documento',
        'endereco',
        'bairro',
        'cod_postal',
        'provincia',
        'distrito',
        'cidade',
        'email',
        'email_sec',
        'contacto',
        'contacto_sec',
        'cell'
    ];
    public function getAnexoDocumentoAttribute()
    {
        return $this->attributes['anexo_documento'] ?  env('APP_URL') . '/' . $this->attributes['anexo_documento'] : '';
    }
}
