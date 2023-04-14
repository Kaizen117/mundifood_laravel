<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function index() {
        $users = User::all();
        return response()->json(['Usuarios' => $users->toArray()], $this->successStatus);
    }

    public function store(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::create($input);
            return response()->json(['Usuario' => $user->toArray()], $this->successStatus);
    }

    public function show($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        return response()->json(['Usuario' => $user->toArray()], $this->successStatus);
    }
}
