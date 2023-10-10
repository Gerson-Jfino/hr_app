<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function autoRegister(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $input = $request->only(['name', 'email']);
        $input['password'] = Hash::make($request->password);
        $input['active'] = true;
        $input['role_id'] = 2;
        DB::beginTransaction();
        try {
            $this->user->create($input);
            DB::commit();
            return response()->json(["message" => "utilizador criado com sucesos"], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        }
    }
}
