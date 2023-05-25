<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables=Table::orderBy('table_number', 'asc')->paginate(10);
        $autentificado=Auth::user();       
        if($autentificado==null) {
            return view('/auth/login');
        }else{                     
            $admin=$autentificado->type=='admin';
            if($admin){               
                return view('tables.index', compact('tables'));
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
                return view('tables.create');
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
        $this->validate($request,[
            'diner_number' => 'required|numeric|min:1|max:50',
            'place' => 'required',                                  
        ],
            ['diner_number.required' => __("Introduzca numero de comensales")],
            ['place.required' => __("Introduzca el lugar a instalar la mesa")],                        
        );
        
        $diner_number=$request->input('diner_number');
        $requestData=$request->all();

        // Obtener todos los números de mesa existentes en la base de datos
        $existingNumbers=Table::pluck('table_number')->toArray();

        // Obtener todos los números de mesa posibles
        $allNumbers=range(1, 100); // Supongamos que hay 100 mesas posibles
        $availableNumbers = array_diff($allNumbers, $existingNumbers);//encontrar los números de mesa disponibles sin usar

        if (empty($availableNumbers)) {
            return redirect('/tables')->with('error', 'No hay números de mesa disponibles.');
        }

        $tableNumber=reset($availableNumbers);//obtengo el primer num de mesa disponible
        
        $table=new Table();
        $table->table_number=$tableNumber;
        $table->diner_number=$diner_number;
        $table->place=$request->place;
        $table->save();
        //$table=Table::create($requestData);
        return redirect('/tables')->with('success', 'Mesa ' . $table->table_number . ' insertada satisfactoriamente por ' . auth()->user()->type . '.');
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
        $autentificado=Auth::user();       
        if($autentificado==null) {      
            return view('/auth/login');
        }else{
            $table=Table::findOrFail($id);
            return view('tables.edit', compact('table'));
        }        
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
        $this->validate($request,[
            'diner_number' => 'numeric|min:1|max:50',            
        ]);


        $table=Table::find($id);
        $table->diner_number=$request->input('diner_number');
        $table->place=$request->input('place');

        $table->save();
        return redirect('/tables')->with('info','Mesa "' .$table->id. '" actualizada con éxito  por '.auth()->user()->type.'.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $autentificado=Auth::user();   
        if($autentificado==null) {
            return view('/auth/login');
        }else{
            $table=Table::find($id);
            $admin=$autentificado->type=='admin';
            if($admin){
                if ($table->reserves()->exists()) {
                    return back()->with('info', 'No se puede eliminar la mesa porque existen reservas asociadas.');
                }else{                
                    $table->delete();    
                    return back()->with('warning','Mesa "' .$table->id. '" eliminada con éxito por '.auth()->user()->type.'.');
                }
            }
        }        
    }
}
