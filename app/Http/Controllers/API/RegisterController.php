<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname1' => 'required',
            'surname2' => 'required',
            'telephone' => 'required|unique:users',
            'address' => 'required',
            'email' => 'required|email|unique:users',           
            'username' => 'required|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            // 'type' => 'required',
            // 'activated' => 'required',           
        ]);
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        //$input['password'] = bcrypt($input['password']);

        $password=bcrypt($request->password);       

        $input['activated'] = 0; //false
        $input['type'] = 'users';
        $user = User::create($input);

        if(isset($user)){
            $user->password=$password;
            $user->save();
        }
        $success['token'] = $user->createToken('Mundifood')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function login() {
        // Si las credenciales son correctas
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            // Creamos un token de acceso para ese usuario
            $success['token'] = $user->createToken('Mundifood')->accessToken;
            $success['user'] = $user;
            // Y lo devolvemos en el objeto 'json'
            return response()->json(['data' => $success], $this->successStatus);
        }
        else {
            return response()->json(['error' => 'No estás autorizado'], 401);
        }
    }

    public function logout(Request $request){
        $user = auth()->user();

        if ($user) {
            $user->tokens()->delete(); // Elimina todos los tokens de acceso del usuario
            return response()->json(['message' => 'Logout satisfactorio'], 200);
        } else {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }
    }

    // public function logout(Request $request){//no funciona, corregir
    //     $request->user()->token()->revoke();
    //     return response()->json(['message' => 'Usuario desconectado satisfactoriamente']);
    // }

    // public function logout(Request $request)//no funciona, corregir
    // {
    //     $user = Auth::user();
    //     $user->tokens()->delete();

    //     return response()->json(['message' => 'Logout satisfactorio'], 200);
    // }

}
