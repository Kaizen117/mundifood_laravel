<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $type1 = ['type' => 'users'];
        $type2 = ['type' => 'waiters'];
        
        $users=User::where($type1)->orWhere($type2)->latest()->paginate(10);
        $autentificado=Auth::user();       
        if($autentificado==null) {//si no hay un user logeado reidirigo a login        
            return view('/auth/login');
        }else{                     
            //extraigo de la variable el valor admin y como es true, en una consulta muestro todos los usuarios con el type=users/waiters y lo envio a la vista
            $admin=$autentificado->type=='admin';
            if($admin){               
                return view('users.index', compact('users'));
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
        //
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
        $user = User::findOrFail($id);
        //return View::make('users.edit')->with('user', $user);
        return view('users.edit', compact('user'));
        //return view('users.edit',compact('user','companies'));
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
        $this->validateUser($request);
        $usuario = User::findOrFail($id);
        $user = array(
            'name' => $request->name,
            'surname1' => $request->surname1,
            'surname2' => $request->surname2,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'username' => $request->surname2,
            'email' => $request->email,
            'password' => $request->password != "" ? Hash::make($request->password) : $usuario->password,
        );
        User::whereId($id)->update($user);
        return redirect('/users')->with('message','Usuario actualizado satisfactoriamente.');
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

    public function sendEmail(Request $request){               
        //dd($request);     //recupera todo lo que necesito
        $marcados=$request->input('marcado');        
        //dd($marcados);    //devuelve correctamente los checkboxes marcados
        $elProducto=$request->input('products');
        //dd($elProducto);  //producto devuelve correctamente el nombre asignado del id
        $elAsunto=$request->input('asunto');
        //dd($elAsunto);    //devuelve correctamente el titulo
        $elContenido=$request->input('contenido');
        //dd($elContenido); //devuelve correctamente el contenido introducido

        foreach($marcados as $marcado){            
            $data = [
                'emailto' => $marcado,
                'subject' => $elAsunto,
                'product' => $elProducto,
                'content' => $elContenido
            ];
            //dd($data); //primera iteracion 16, luego 17. El resto de campos son constantes
            Mail::send('vistaEmail', $data, function ($message) use($data) {
                $message->from(env('MAIL_USERNAME'));  //recupero el correo del fichero env para evitar errores
                //dd(env('MAIL_USERNAME')); //devuelve mi correo real
                //dd($data); //datos correctos.
                $message->to($data['emailto'])->subject($data['subject']);
                //segun stackoverflow da error en el to('') al pasarle una variable
                //al parecer no habia refrescado la web y algo no pillaba del array, pero ya envia a cada destinatario real.
            });
        }   
        return back();       
    }

    public function work(){
        return view('users.work');
    }

    public function who(){
        return view('users.who');
    }

    public function faqs(){
        return view('users.faqs');
    }
    
    public function success(){
        return view('success');
    }
}
