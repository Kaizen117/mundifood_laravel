<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('users.create');
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
            'name' => 'required',
            'surname1' => 'required',
            'surname2' => 'required',
            'telephone' => 'required|unique:users',
            'address' => 'required',
            'email' => 'required|unique:users',
            //'email_verified_at' => 'email|unique:users',
            'username' => 'required|unique:users',
            'type' => 'required',
            'activated' => 'required',
        ],
            ['name.required' => __("Introduzca su nombre")],
            ['surname1.required' => __("Introduzca el primer apellido")], 
            ['surname2.required' => __("Introduzca el segundo apellido")],
            ['telephone.required' => __("Introduzca el primer apellido")], 
            ['address.required' => __("Introduzca el segundo apellido")],                      
            ['email.required' => __("Introduzca un correo válido")],
            //['email_verified_at.required' => __("Repita su email")],
            ['username.required' => __("Introduzca su nombre de usuario")],
            ['type.required' => __("Por favor seleccione el rol")],
        );        
        $user=User::create($request->all());
        //return redirect()->route('users.index')->with('message',['success',__("Usuario añadido con éxito por ".auth()->user()->type)]);   
        return redirect()->route('users.index')->with('success','Usuario ' .$user->username. ' creado satisfactoriamente por '.auth()->user()->type);

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
        $user=User::findOrFail($id);
        return view('users.edit', compact('user'));
        //User::find($id)->update($request->all());
        //return redirect()->route('users.edit')->with('message',['success',__("Usuario .$user. actualizado con éxito por ".auth()->user()->type)]);
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
            'name' => 'required|unique:users',
            'surname' => 'required|unique:users',
            'email' => 'required|unique:users',
            'email_verified_at' => 'required|email|unique:users',
            'type' => 'required|unique:users',
        ],
            ['name.required' => __("Enter a name")],
            ['surname.required' => __("Enter a surname")],           
            ['email.required' => __("Enter a email")],
            ['email_verified_at.required' => __("Repeat your email, please")],
            ['type.required' => __("Type not contemplated")],
        ); 
        User::find($id)->update($request->all());
        return back()->with('message',['info',__("Usuario actualizado con éxito por ".auth()->user()->type)]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $autentificado=Auth::user();   
        if($autentificado==null) {
            return view('/auth/login');
        }else{
            $admin=$autentificado->type=='admin';
            if($admin){
                $user->delete();
                //return back()->with('message',['warning',__("Usuario .$user->username. eliminado con éxito por ".auth()->user()->type)]);
                //return view('users.index', compact('users'));
                 return back()->with('warning','Usuario ' .$user->username. ' eliminado con éxito por '.auth()->user()->type);
            }
        }
        
    }
    /*
    public function activate($id)
    {
        $user = User::where('id', $id)->first();
        // Si no existe, redirige a la ruta principal 
        if (!$user){
            return redirect('/') ->with('message','El usuario no existe');
        }            
        $user->actived=1;
        $user->save();
        return redirect('/users')->with('message','Usuario activado');
    }

    public function deactivate($id){

        $user = User::where('id', $id)->first();
        // Si no existe, redirige a la ruta principal 
        if (!$user){
            return redirect('/') ->with('message','El usuario no existe');
        }
        $user->actived=0;
        $user->save();
        return redirect('/users')->with('message','Usuario desactivado');

    }*/
}
