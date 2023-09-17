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
use App\PersonalData;
use Illuminate\Http\Request;

class adminController extends Controller
{
    private $employee;
    private $personal_data;
    private $nivel_academico;
    public function __construct(Employee $employee, PersonalData $personal_data) {
        $this->employee = $employee;
        $this->personal_data = $personal_data;
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
}
