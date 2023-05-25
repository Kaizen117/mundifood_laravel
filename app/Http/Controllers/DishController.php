<?php

namespace App\Http\Controllers;

use App\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $dishes=Dish::orderBy('name', 'asc')->paginate(10);
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
        $this->validate($request,[
            'name' => 'required|string|max:50',
            'image' => 'required|file|image',
            'price' => 'required|numeric|between:0,99999.99',
            'description' => 'required|string',
            'category' => 'required|string|max:20',            
            'disponibility' => 'boolean|nullable',            
        ],
            ['name.required' => __("Introduzca nombre del plato")],
            ['image.required' => __("Introduzca una imagen correspondiente")], 
            ['price.required' => __("Introduzca el precio a vender")],
            ['description.required' => __("Introduzca una descripcion detallada a ser posible")],             
        );        
        
        $image=$request->file('image');
        $filename=$image->getClientOriginalName();

        //Mover la imagen a la carpeta public/images/dishes con su nombre original
        $destinationPath=public_path('/images/dishes');
        $image->move($destinationPath, $filename);

        //Crear el plato con los datos de la solicitud, incluyendo el nombre de la imagen
        $requestData=$request->all();
        $requestData['disponibility']=$request->input('disponibility', 0) ? 1 : 0;
        //$requestData['disponibility']=$request->has('disponibility') ? true : false;
        $requestData['image']=$filename;
        
        $dish=Dish::create($requestData);

        return redirect('/dishes')->with('success', 'Plato "' . $dish->name . '" creado satisfactoriamente por ' . auth()->user()->type . '.');
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
            $dish=Dish::findOrFail($id);
            return view('dishes.edit', compact('dish'));
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
            'name' => 'string|max:50',
            'image' => 'file|image',
            'price' => 'numeric|between:0,99999.99',
            'description' => 'string|max:255',
            'category' => 'string|max:20',
            'disponibility' => 'boolean|nullable',
        ]);


        $dish=Dish::find($id);
        $dish->name=$request->input('name');
        $dish->price=$request->input('price');
        $dish->description=$request->input('description');
        $dish->category=$request->input('category');
        $dish->disponibility=$request->input('disponibility');

        if ($request->hasFile('image')) {
            $image=$request->file('image');
            $filename=$image->getClientOriginalName();
            $destinationPath=public_path('/images/dishes');
            $image->move($destinationPath, $filename);
            $dish->image=$filename;
        }

        $dish->save();
        return redirect('/dishes')->with('info','Plato "' .$dish->name. '" actualizado con éxito  por '.auth()->user()->type.'.');
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
            $dish=Dish::find($id);
            $admin=$autentificado->type=='admin';
            if($admin){
                $dish->delete();                
                return back()->with('warning','Plato "' .$dish->name. '" eliminado con éxito por '.auth()->user()->type.'.');
            }
        }        
    }

    public function menu(){
        return view('dishes.menu');
    }
}
