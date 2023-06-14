<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Reserve;
use App\User;

class ReservesController extends Controller
{
    public $successStatus = 200;

    public function index() {
        //$reserves = Reserve::all();
        $reserves=Reserve::orderBy('date', 'asc')->orderBy('hour', 'asc')->get();
        return response()->json(['reserves' => $reserves->toArray()], $this->successStatus);
    }
   
    public function getUsersReserves(){
        $reservesWithUsers = Reserve::with('user')//indica que debe cargarse la relacion user asociada a reserve y ordenandolo por fecha y hora
        ->orderBy('date', 'asc')
        ->orderBy('hour', 'asc')
        ->get();

        $data=[];
        //itero cada reserva y guardo en una nueva variable cada resultado para guardar los datos del usuario para mostrarlo posteriormente
        foreach ($reservesWithUsers as $reserve) {
            $info=[
                'reserve_id' => $reserve->id,
                'user_id' => $reserve->user_id,
                'user' => [
                    'id' => $reserve->user->id,
                    'name' => $reserve->user->name,
                    'surname1' => $reserve->user->surname1,
                    'surname2' => $reserve->user->surname2,
                    'telephone' => $reserve->user->telephone,
                    'email' => $reserve->user->email,
                    'username' => $reserve->user->username,
                ],
            ];
            $data[]=$info;
        }
        return response()->json(['data' => $data], $this->successStatus);
        // $reserve= DB::table('reserves')->where('user_id', $id)->get();

        // return response()->json(['reserves' => $reserve->toArray()], $this->successStatus);
    }

    public function consultaReserves()
    {
        $reserves = Reserve::with('user')->get();

        return response()->json($reserves);
    }
}
