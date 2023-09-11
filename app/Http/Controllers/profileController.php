<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Pelouro;
use App\UnidadeOrganica;
use App\Sector;
use App\Nivel;
use App\Categoria;
use App\Situation;
class profileController extends Controller
{
    public function getPelouros() {
        $pelouros = Pelouro::get(['id', 'name']);
        $uni_org = UnidadeOrganica::get(['id', 'pelouro_id','name']);
        $sector = Sector::get(['id', 'uni_org_id','name']);
        $nivel = Nivel::get(['id','name']);
        $categoria = Categoria::get(['id', 'name']);
        $situation = Situation::get(['id', 'name']);
        return response()->json([
            'pelouros' => $pelouros,
            'uni_org' => $uni_org,
            'sector' => $sector,
            'nivel' => $nivel,
            'categoria' => $categoria,
            'situation' => $situation
        ], 200);
    }
}
