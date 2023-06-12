<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reserve;

class ReservesController extends Controller
{
    public $successStatus = 200;

    public function index() {
        $reserves = Reserve::all();
        return response()->json(['reserves' => $reserves->toArray()], $this->successStatus);
    }
}
