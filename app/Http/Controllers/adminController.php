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
use App\Role;
use App\EmployeAsseduidade;
use App\PersonalData;
use App\Desempenho;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    private $employee;
    private $personal_data;
    private $nivel_academico;
    private $employe_asseduidade;
    private $user;
    private $desempenho;
    public function __construct(Employee $employee, PersonalData $personal_data, EmployeAsseduidade $employe_asseduidade, User $user, Desempenho $desempenho) {
        $this->employee = $employee;
        $this->personal_data = $personal_data;
        $this->user = $user;
        $this->employe_asseduidade = $employe_asseduidade;
        $this->desempenho = $desempenho;
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
    public function getDesempenhos() {
        $colaboradores = $this->employee->with('situation', 'pelouro', 'sector', 'uni_org', 'categoria', 'desempenho')->get()->map(function ($col) {
            return [
                "id" => $col->id,
                "nome_completo" => $col->nome_completo,
                "uni_org" => $col->uni_org->name,
                "sector" => $col->sector->name,
                "desempenho" => $col->desempenho
            ];
        });
        return response()->json($colaboradores, 200);
    }
    public function showColaborador($id) {
        $employe = $this->employee->find($id)->first();
        $user = User::where('id', $employe->user_id)->with('employee', 'personal_data', 'nivel_academico', 'nivel_academico.nivel','employee.situation', 'employee.pelouro', 'employee.sector', 'employee.uni_org', 'employee.categoria', 'employee.nivel')->first();
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
    public function storeDesempenho(Request $request) {
        $input = $request->only(['employe_id', 'data_avalicao', 'avaliacao']);
        DB::beginTransaction();
        try {
            if ($request->anexo) {
                $path = 'uploads';
                $document = time().'.' . $request->anexo->getClientOriginalExtension();
                $request->anexo->move(public_path($path), $document);
                $input['anexo'] = $path . '/' . $document;
            }
            $desempenho = $this->desempenho->create($input);
            $desempenho->save();
            DB::commit();
            return response()->json("Nivel academico saved Successfully", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
    public function getUsers() {
        $users = User::get()->map(function ($ass) {
            return [
                "name" => $ass->name,
                "email" => $ass->email,
                "role_id" => $ass->role_id,
                "role" => $ass->role_id == 1 ? "Admin" : "Normal"
            ];
        });
        return response()->json($users, 200);
    }
    public function getRoles() {
        $roles = Role::get();
        return response()->json($roles, 200);
    }
    public function newUser(Request $request) {
        $input = $request->all();
        $input['password'] = Hash::make("password");
        $input['active'] = true;
        DB::beginTransaction();
        try {
            $user = $this->user->create($input);
            $user->save();
            DB::commit();
            return response()->json("Utilizador registado com sucesso!", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }

    }
    public function updateUser($id, Request $request) {
        $input = $request->all();
        $user = $this->user->find($id)->first();
        DB::beginTransaction();
        try {
            $user = $user->update($input);
            $user->save();
            DB::commit();
            return response()->json("Utilizador atualizado com sucesso!", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
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
    public function relatorios() {
        $totalEmployes = $this->employee->get()->count();
        $situation = DB::table('employe')
        ->selectRaw('situation_id, COUNT(*) as count')
        ->groupBy('situation_id')
        ->orderBy('count', 'desc')
        ->get()->map(function ($sit) {
            return [
                "situation_name" => Situation::find($sit->situation_id)->first()->name,
                "count" => $sit->count
            ];
        });


        $stats = [
            "total_emplyes" =>$totalEmployes,
            "total_situation" =>$situation,
        ];
        return response()->json($stats, 200);
    }
}
