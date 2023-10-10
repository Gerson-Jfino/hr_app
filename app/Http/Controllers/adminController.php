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
use App\EmployeAsseduidade;
use App\PersonalData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class adminController extends Controller
{
    private $employee;
    private $personal_data;
    private $nivel_academico;
    private $employe_asseduidade;
    public function __construct(Employee $employee, PersonalData $personal_data, EmployeAsseduidade $employe_asseduidade) {
        $this->employee = $employee;
        $this->personal_data = $personal_data;
        $this->employe_asseduidade = $employe_asseduidade;
    }

    public function getColaboradores() {
        $filters = [
            'name' => request('nome'),
            'situation' => request('situacao'),
            'pelouro' => request('pelouro'),
            'uni_org' => request('uni_org')
        ];
        $colaboradores = $this->employee->filterEmploye($filters)->with('situation', 'pelouro', 'sector', 'uni_org', 'categoria')->paginate(15);
        return response()->json($colaboradores, 200);
    }
    public function showColaborador($id) {
        $user = User::where('id', 1)->with('employee', 'personal_data', 'nivel_academico', 'nivel_academico.nivel','employee.situation', 'employee.pelouro', 'employee.sector', 'employee.uni_org', 'employee.categoria', 'employee.nivel')->first();
        return response()->json($user, 200);
    }
    public function getEmployes() {
        $colaboradores = $this->employee->get();
        return response()->json($colaboradores, 200);
    }
    public function getAsseduidades() {
        $asseduidades = EmployeAsseduidade::with('employe')->get()->map(function ($ass) {
            return [
                "id" => $ass->id,
                "employe_id" => $ass->employe_id,
                "nome_colaborador" => $ass->employe->nome_completo,
                "absentismo" => $ass->absentismo,
                "data_inicio" => $ass->data_inicio,
                "data_fim" => $ass->data_fim,
                "observacoes" => $ass->observacoes,
                
            ];
        });
        return response()->json($asseduidades, 200);
    }
    public function storeAssiduidade(Request $request) {
        $input = $request->all();
        // return response()->json($input, 200);
        // dd($input);
        DB::beginTransaction();
        try {
            $employe_asseduidade = $this->employe_asseduidade->create($input);
            $employe_asseduidade->save();
            DB::commit();
            return response()->json("Asseduidade saved Successfully", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
    public function updateAssiduidade($id, Request $request) {
        $input = $request->all();
        // return response()->json($input, 200);
        // dd($input);
        $employe_asseduidade = $this->employe_asseduidade->find($id)->first();
        DB::beginTransaction();
        try {
            $employe_asseduidade->update($input);
            $employe_asseduidade->save();
            DB::commit();
            return response()->json("Asseduidade saved Successfully", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
}
