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
use App\NivelAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class profileController extends Controller
{
    private $employee;
    private $personal_data;
    private $nivel_academico;
    public function __construct(Employee $employee, PersonalData $personal_data, NivelAcademico $nivel_academico) {
        $this->employee = $employee;
        $this->personal_data = $personal_data;
        $this->nivel_academico = $nivel_academico;
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
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        DB::beginTransaction();
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
    public function updateCompanyData($id, Request $request) {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $employee = $this->employee->find($id)->first();
        DB::beginTransaction();
        try {
            $employee->update($input);
            $employee->save();
            DB::commit();
            return response()->json("Data updated", 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
    public function meAdapter() {
        // $id = Auth::user()->id;
        $user = User::where('id', 1)->with('employee', 'personal_data', 'nivel_academico', 'nivel_academico.nivel','employee.situation', 'employee.pelouro', 'employee.sector', 'employee.uni_org', 'employee.categoria', 'employee.nivel')->first();
        return response()->json($user, 200);
    }
    public function storePesonalData(Request $request) {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        DB::beginTransaction();
        try {
            $personal_data = $this->personal_data->create($input);
            $personal_data->save();
            DB::commit();
            return response()->json("Personal Data saved Successfully", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
    public function updatePesonalData($id, Request $request) {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $personal_data = $this->personal_data->find($id)->first();
        DB::beginTransaction();
        try {
            $personal_data->update($input);
            $personal_data->save();
            DB::commit();
            return response()->json("Data updated", 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
    public function storeNivelAcademicoData(Request $request) {
        $input = $request->only(['nivel_id', 'curso', 'instituicao']);
        $input['user_id'] = Auth::user()->id;
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
    public function updateNivelAcademicoData($id, Request $request) {
        $input = $request->only(['nivel_id', 'curso', 'instituicao']);
        $input['user_id'] = Auth::user()->id;
        $nivel_academico = $this->nivel_academico->find($id)->first();
        DB::beginTransaction();
        try {
            if ($request->anexo) {
                $path = 'uploads';
                $document = time().'.' . $request->anexo->getClientOriginalExtension();
                $request->anexo->move(public_path($path), $document);
                $input['anexo'] = $path . '/' . $document;
            }
            $nivel_academico->update($input);
            $nivel_academico->save();
            DB::commit();
            return response()->json("Nivel academico saved Successfully", 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->message(), 500);
        }
    }
}
