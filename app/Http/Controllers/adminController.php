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
use Faker\Generator as Faker;
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
    private $faker;
    private $desempenho;
    public function __construct(Employee $employee, PersonalData $personal_data, EmployeAsseduidade $employe_asseduidade, User $user, Desempenho $desempenho, Faker $faker) {
        $this->employee = $employee;
        $this->personal_data = $personal_data;
        $this->user = $user;
        $this->faker = $faker;
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
    public function createTempUser(Faker $faker) {
        $input = [
            "name" => $faker->name,
            'role_id' => 2,
            'active' => 0,
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make("passeord")
        ];
        DB::beginTransaction();
        try {
            $user = $this->user->create($input);
            DB::commit();
            return response()->json(["message" => "utilizador criado com sucesos", "userId" => $user->id], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        }
    }
    public function storePesonalData(Request $request) {
        $input = $request->all();
        DB::beginTransaction();
        try {
            if ($request->documeto) {
                $path = 'uploads';
                $document = time().'.' . $request->documeto->getClientOriginalExtension();
                $request->documeto->move(public_path($path), $document);
                $input['anexo_documento'] = $path . '/' . $document;
            } else {
                $input['anexo_documento'] = null;
            }
            $personal_data = $this->personal_data->create($input);
            $personal_data->save();
            DB::commit();
            return response()->json("Personal Data saved Successfully", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
    public function storeCompanyData(Request $request) {
        $input = $request->all();
        DB::beginTransaction();
        try {
            if ($request->documeto) {
                $path = 'uploads';
                $document = time().'.' . $request->documeto->getClientOriginalExtension();
                $request->documeto->move(public_path($path), $document);
                $input['contrato'] = $path . '/' . $document;
            } else {
                $input['contrato'] = null;
            }
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
    public function storeNivelAcademicoData(Request $request) {
        $input = $request->only(['nivel_id', 'curso', 'instituicao']);
        DB::beginTransaction();
        try {
            if ($request->anexo) {
                $path = 'uploads';
                $document = time().'.' . $request->anexo->getClientOriginalExtension();
                $request->anexo->move(public_path($path), $document);
                $input['anexo'] = $path . '/' . $document;
            }
            $nivel_academico = $this->nivel_academico->create($input);
            $nivel_academico->save();
            DB::commit();
            return response()->json("Nivel academico saved Successfully", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
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
        $users = User::where('active', 1)->get()->map(function ($ass) {
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
        $employePerUniOrg = UnidadeOrganica::get()->map(
            function ($uni) {
                $employessss = [];
                return [
                    $uni->name => Employee::where('uni_org_id', $uni->id)->get()->count()
                ];
            }
        );
        $employeSituacao = Situation::get()->map(function ($sit) {
            return [
                $sit->name => Employee::where('situation_id', $sit->id)->get()->count()
            ];
        });
        $employeeGenero = [
            [
                "masculino" => PersonalData::where('genero', 'MASCULINO')->get()->count()
            ],
            [
                "feminino" => PersonalData::where('genero', 'FEMININO')->get()->count(),
            ],
        ];


        $stats = [
            'generos' => $employeeGenero,
            'employee_situation' => $employeSituacao,
            'employee_uniOrg' => $employePerUniOrg,
            "total_emplyes" =>$totalEmployes,
            "total_situation" =>$situation,
        ];
        return response()->json($stats, 200);
    }
}
