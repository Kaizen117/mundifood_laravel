<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function index() {
        $users = User::all();
        return response()->json(['users' => $users->toArray()], $this->successStatus);
    }

    public function store(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'surname1' => 'required',
            'surname2' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'type' => 'required',
            'activated' => 'required', 
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::create($input);
            return response()->json(['Usuario' => $user->toArray()], $this->successStatus);
    }

    public function show($id)
    {
        $user= DB::table('users')->where('id', $id)->get();
        return response()->json(['user' => $user->toArray()], $this->successStatus);
    }   

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'nullable|string|max:25',
            'surname1' => 'nullable|string|max:30',
            'surname2' => 'nullable|string|max:30',
            'telephone' => 'nullable|digits:9|unique:users,telephone,'.$user->id,
            'address' => 'nullable|string|max:150',
            'email' => 'nullable|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed'/*,
            'c_password' => 'nullable|string|min:6|same:password',*/
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 422);
        }
        // $request->validate([
        //     'name' => 'nullable|string|max:25',
        //     'surname1' => 'nullable|string|max:30',
        //     'surname2' => 'nullable|string|max:30',
        //     'telephone' => 'nullable|digits:9',
        //     'address' => 'nullable|string|max:150',
        //     'email' => 'nullable|string|email|max:255|unique:users,email,'.$user->id,
        //     'password' => 'nullable|string|min:6|confirmed',
        // ]);

        $user->update([
            'name' => $request->name,
            'surname1' => $request->surname1,
            'surname2' => $request->surname2,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);    
        return response()->json(['data' => 'Perfil actualizado satisfactoriamente.'], $this->successStatus);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
    
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Usuario no encontrado'], 500);
        }
    }

    public function getUser($id) {
        $user = User::findOrFail($id);       
        return response()->json(['data' => $user], 200);
    }

    public function getUserAuthenticated() {
        $user = Auth::user();
        return response()->json(['data' => $user], 200);
    }

    /*public function getUser() {
        $user = Auth::user();
        
        $response = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'type' => $user->type,
            'activated' => $user->activated
        ];
        
        return response()->json(['data' => $response], 200);
    }*/
}
