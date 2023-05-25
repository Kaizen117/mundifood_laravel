<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
//use Illuminate\Validation\Rule;

//use App\Mail\send_email;
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
    public function create(){
        $autentificado=Auth::user();       
        if($autentificado==null) {//si no hay un user logeado reidirigo a login        
            return view('/auth/login');
        }else{
            return view('users.create');
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
            'name' => 'required|string|max:25',
            'surname1' => 'required|string|max:30',
            'surname2' => 'required|string|max:30',
            'telephone' => 'required|string|min:9|max:9|unique:users',
            'address' => 'required|string|max:150',            
            'email' => 'required|string|email|max:50|unique:users',
            //'email_verified_at' => 'email|unique:users',
            'username' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
            'type' => 'required',
            'activated' => 'required',
            'remember_token' => 'required|string|max:100',
        ],
            ['name.required' => __("Introduzca su nombre")],
            ['surname1.required' => __("Introduzca el primer apellido")], 
            ['surname2.required' => __("Introduzca el segundo apellido")],
            ['telephone.required' => __("Introduzca el primer apellido")], 
            ['address.required' => __("Introduzca el segundo apellido")],                      
            ['email.required' => __("Introduzca un correo válido")],
            //['email_verified_at.required' => __("Repita su email")],
            ['username.required' => __("Introduzca su nombre de usuario")],
            ['password.required' => __("Introduzca su pwd")],
            ['remember_token.required' => __("Genere token")],
        );
        $password = Input::get('password');       
        $hashed = Hash::make($password);
        
        $requestData=$request->all();
        $requestData['password']=$hashed;
        $user=User::create($requestData);
        //return redirect()->route('users.index')->with('message',['success',__("Usuario añadido con éxito por ".auth()->user()->type)]);   
        return redirect('/users')->with('success','Camarero "' .$user->username. '" creado satisfactoriamente por '.auth()->user()->type.'.');
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
            $user=User::findOrFail($id);
            return view('users.edit', compact('user'));
            //return redirect('/users')->with('success','Usuario "' .$user->username. '" actualizado con éxito  por '.auth()->user()->type.'.');
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
        $user=User::where('id', $id)->firstOrFail();
        
        //Si el usuario quiere actualizar un solo campo y no todos se utiliza el .$id al final de la columna para asegurar que el valor de esa columna sea unico y a su vez
        //ignorando el mismo id que se esta actualizando
        $this->validate($request, [
            'name' => 'string|min:1|max:25',
            'surname1' => 'string|min:1|max:30',
            'surname2' => 'string|min:1|max:30',
            'telephone' => 'string|min:9|max:9|unique:users,telephone,'.$id,
            'address' => 'string|min:1|max:150',            
            'email' => 'string|email|max:50|unique:users,email,'.$id.',id',
            'username' => 'string|min:1|max:30|unique:users,username,'.$id,
            'password' => 'string|min:6|max:255|confirmed',           
        ]);

        $username=$request->username;
        $password=Input::get('password');       
        $hashed=Hash::make($password);
        
        $requestData=$request->all();
        $requestData['password']=$hashed;
        
        $user->update($requestData);
        return redirect('/users')->with('info', 'Usuario "' . $user->username . '" actualizado con éxito por ' . auth()->user()->type . '.');        
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
            $user=User::find($id);
            $admin=$autentificado->type=='admin';
            if($admin){
                $user->delete();                
                return back()->with('warning','Usuario "' .$user->username. '" eliminado con éxito por '.auth()->user()->type.'.');
            }
        }        
    }

    public function password_edit($id)
    {
        $autentificado=Auth::user();       
        if($autentificado==null) {      
            return view('/auth/login');
        }else{
            $user=User::findOrFail($id);
            return view('users.edit-password', compact('user'));
        }
    }

    public function password_update(Request $request, $id)
    {               
        $this->validate($request,[            
            'password' => 'string|min:6|max:255|confirmed',
        ]); 
      
        $user=User::where('id', $id)->firstOrFail();
        $username=$user->username;
        $password=Input::get('password');       
        $hashed=Hash::make($password);
        
        $requestData=$request->all();
        $requestData['password']=$hashed;
        if($id) {           
            User::find($id)->update($requestData);            
            return redirect('/users')->with('info','Usuario "' .$username. '" actualizado con éxito  por '.auth()->user()->type.'.');
        }
    }

    public function sendEmail(Request $request)
    {    
        $request->validate([
            'marcado' => 'required|array|min:1',
            'asunto' => 'required',
            'contenido' => 'required',
        ]);
        
        //dd($request);     //recupera todo lo que necesito
        $marcados=$request->input('marcado');   //devuelve correctamente los checkboxes marcados
        $losPlatos=DB::table('dishes')->orderByDesc('created_at')->take(3)->select('name', 'description', 'image')->get();
        $elAsunto=$request->input('asunto');
        $elContenido=$request->input('contenido');

        $htmlPlatos='';//visualiza correctamente el array a string para la estructura por html de cada plato
        $header="<br/>¡Hola! Ha recibido este correo porque está suscrito al Newsletter de Mundif00d. Le mostraremos nuestras noticias y productos más interesantes y novedosos para su disfrute.
        Pruebe estos nuevos platos, ¡son una delicia!:";
        $footer="<p>Y recuerda, ¡cómete el mundo!</p>
        <h5>Si ha recibido este correo por error, por favor ignore este mensaje o póngase en contacto con el administrador del sistema para solucionar el problema.</h5>";
        
        foreach ($losPlatos as $plato) {
            $htmlPlatos .= '<div>';
            $htmlPlatos .= '<h2>' . $plato->name . '</h2>';
            $htmlPlatos .= '<p>' . $plato->description . '</p>';
            $htmlPlatos .= '</div>';
        }

        foreach($marcados as $marcado){            
            $data = [
                'emailto' => $marcado,
                'subject' => $elAsunto,
                'content' => $elContenido,
                'platosHtml' => $htmlPlatos
                                
            ];
            //dd($data);
            Mail::send('email', $data, function ($message) use($header, $data, $htmlPlatos, $losPlatos, $footer) {
                $message->from(env('MAIL_USERNAME'));                                
                $message->to($data['emailto'])->subject($data['subject']);
                $message->setBody($data['content'] . $header . '<br>' . $data['platosHtml'] . '<br>' . $footer, 'text/html');

                foreach ($losPlatos as $plato) {
                    $imagePath=public_path('images/dishes/' . $plato->image);
                    $message->embed($imagePath, $plato->name);                    
                }
            });
        }   
        return back()->with('success','Correo electrónico enviado satisfactoriamente para los usuarios: ' .implode(', ', $marcados));
        //para evitar el error array strin conversion se fixea con la funcion implode y el delimitador ','. Asi no falla ni para uno ni para 50 emails
    }
}
