<?php

namespace App\Http\Controllers;


use App\Pelouro;
use App\UnidadeOrganica;
use App\Sector;
use App\Nivel;
use App\Categoria;
use App\Situation;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class profileController extends Controller
{
    private $employee;
    public function __construct(Employee $employee) {
        $this->employee = $employee;
    }
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
    public function storeCompanyData(Request $request) {
        DB::beginTransaction();
        $input = $request->all();
        $input['user_id'] = 1;
        try {
            $employee = $this->employee->create($input);
            // $employee->user_id = 1;
            $employee->save();
            DB::commit();
            return response()->json("Data saved Successfully", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
    public function meAdapter() {
        $user = User::where('id', 1)->with('employee')->first();
        return response()->json($user, 200);
    }
}
