<?php

namespace App\Http\Controllers;

use App\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dishes=Dish::paginate(10);
        $autentificado=Auth::user();       
        if($autentificado==null) {//si no hay un user logeado reidirigo a login        
            return view('/auth/login');
        }else{                     
            //extraigo de la variable el valor admin y como es true, en una consulta muestro todos los usuarios con el type=users/waiters y lo envio a la vista
            $admin=$autentificado->type=='admin';
            if($admin){               
                return view('dishes.index', compact('dishes'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autentificado=Auth::user();       
        if($autentificado==null) {
            return view('/auth/login');
        }else{                                 
            $admin=$autentificado->type=='admin';
            if($admin){
                return view('dishes.create');
            }
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function menu(){
        return view('dishes.menu');
    }
}
