<?php

namespace App\Http\Controllers;


use App\Reserve;
use App\Table;
use App\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class ReserveController extends Controller
{
    public function index()
    {
        $reserves=Reserve::orderBy('date', 'asc')->orderBy('hour', 'asc')->paginate(10);
        foreach ($reserves as $reserve) {
            $reserve->date=Carbon::parse($reserve->date)->format('d/m/Y');
        }
        $autentificado=Auth::user();
        if($autentificado==null) {
            return view('/auth/login');
        }else{                     
            $waiter=$autentificado->type=='waiters';
            if($waiter){               
                return view('reserves.index', compact('reserves'));
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
            $waiter=$autentificado->type=='waiters';
            if($waiter){
                $users=User::where('type', 'users')->select('name', 'surname1', 'surname2', 'id')->get(); //obtengo los nombres y los id correspondientes del rol users               
                
                $availableTables=Table::whereNotIn('id', function ($query) {//funcion anonima que obtengo los id de las mesas que no estan reservadas
                    $query->select('table_id')->from('reserves');
                })->orderBy('created_at')->get();

                $selectedUsers=[];
                return view('reserves.create', compact('users', 'availableTables', 'selectedUsers'));                
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
        $currentDate=now()->format('d-m-Y');
        $currentTime=now()->format('H:i');        

        $this->validate($request,[
            'table_id' => 'required|exists:tables,id',
            'user_id' => 'required|exists:users,id',
            'diner_number' => 'required|integer|min:1',
            'date' => "required|date|after_or_equal:{$currentDate}",
            'hour' => 'required|date_format:H:i',                
            'observations' => 'required|max:60',
        ],
            ['table_id.required' => __("Debe seleccionar una de las mesas disponibles.")],
            ['user_id.required' => __("El usuario no existe")],
            ['date.required' => __("Introduzca la fecha de la reserva")],
            ['date.in' => __("La fecha de reserva debe ser igual a la fecha actual")],
            ['hour.required' => __("Introduzca la hora a reservar")],
            ['hour.date_format' => __("El formato de hora no es válido")],
            ['hour.after' => __("La hora de reserva debe ser posterior a la hora actual")],
            ['hour.required' => __("Introduzca la hora a reservar")],
            ['observations.required' => __("Introduzca una descripcion detallada a ser posible")],
            ['diner_number.integer' => __("El número de comensales debe ser un número entero")],
            ['diner_number.min' => __("El número de comensales debe ser igual o superior a 1")],
        );
        
        $table_id=$request->input('table_id');
        $user_id=$request->input('user_id');
        $diner_number=$request->input('diner_number');
        $date=$request->input('date');               
        $hour=$request->input('hour');
        $observations=$request->input('observations');

        $requestData=$request->all();

        $dateTime=date('d-m-Y H:i', strtotime("{$date} {$hour}"));
        $currentDateTime="{$currentDate} {$currentTime}";

        if ($dateTime < $currentDateTime) {
            return redirect()->back()->with('error', 'No puedes reservar una fecha u hora pasada (' . $dateTime. '), fecha del sistema: ' . $currentDateTime);
        }

        /*Si solo queremos permitir una reserva de USUARIO por dia:
        
        $existsUserReserve=Reserve::where('user_id', $user_id)->where('date', $date)->first();        
        if ($existsUserReserve) {
            return redirect()->back()->with('error', 'Ya tienes una reserva para esta fecha.');
        }*/

        $existsTableReserve=Reserve::where('table_id', $table_id)
            ->where('date', $date)
            ->where('hour', $hour)
            ->first();

        if ($existsTableReserve) {
            return redirect()->back()->with('error', 'Ya hay una mesa reservada en esa fecha y hora.');
        }

        $table=Table::findOrFail($table_id);

        if ($diner_number>$table->diner_number) {
            return redirect()->back()->with('error', 'El número de comensales excede la capacidad de la mesa.');
        }

        $reserve=Reserve::create($requestData);

        $reserveDate=date_create($reserve->date);
        $reserveHour=date_create_from_format('H:i', $reserve->hour);

        return redirect('/reserves')->with('success', 'Reserva para el día ' . date_format($reserveDate, 'd/m/Y') . ' a las ' . date_format($reserveHour, 'H:i') . ' horas creada satisfactoriamente por ' . auth()->user()->type . '.');
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
            $waiter=$autentificado->type=='waiters';
            if($waiter){
                $reserve=Reserve::findOrFail($id);
                return view('Reserves.edit', compact('reserve'));
            }
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
        $currentDate=now()->format('d-m-Y');
        $currentTime=now()->format('H:i');    

        $this->validate($request,[            
            'diner_number' => 'integer|min:1',
            'date' => "date|after_or_equal:{$currentDate}",
            'hour' => 'date_format:H:i',                
            'observations' => 'string|max:60',            
        ],
            ['diner_number.integer' => __("El número de comensales debe ser un número entero")],
            ['diner_number.min' => __("El número de comensales debe ser igual o superior a 1")],
            ['date' => __("Introduzca la fecha de la reserva")],
            ['date.in' => __("La fecha de reserva debe ser igual a la fecha actual")],
            ['hour' => __("Introduzca la hora a reservar")],
            ['hour.date_format' => __("El formato de hora no es válido")],
            ['hour.after' => __("La hora de reserva debe ser posterior a la hora actual")],
            ['hour' => __("Introduzca la hora a reservar")],
            ['observations' => __("Introduzca una descripcion detallada a ser posible")],            
        );

        $reserve=Reserve::findOrFail($id);
        $reserve->diner_number=$request->input('diner_number');
        $reserve->date=$request->input('date');
        $reserve->hour=$request->input('hour');
        $reserve->observations=$request->input('observations');

        $table=Table::findOrFail($reserve->table_id);
        $diner_number=$request->input('diner_number');
            
        if ($diner_number > $table->diner_number) {
            return redirect()->back()->with('error', 'El número de comensales excede la capacidad de la mesa.');
        }
        //para mostrar el error en plantilla en lugar de flashMessenger:
        //return redirect()->back()->withErrors(['diner_number' => 'El número de comensales excede la capacidad de la mesa.'])->withInput();

        $existsReserve=Reserve::where('id', '!=', $id)
            ->where('date', $request->input('date'))
            ->where('hour', $request->input('hour'))
            ->first();

        if ($existsReserve) {
            return redirect()->back()->withErrors(['date' => 'Ya existe una reserva para la fecha y hora seleccionadas.'])->withInput();
        }

        $date=$request['date'];
        $hour=$request['hour'];
        //dd($date);
        $dateTime=date('d-m-Y H:i', strtotime("{$date} {$hour}"));
        $currentDateTime="{$currentDate} {$currentTime}";

        if ($dateTime < $currentDateTime) {
            return redirect()->back()->with('error', 'No puedes reservar una fecha u hora pasada (' . $dateTime. '), fecha del sistema: ' . $currentDateTime);
        }

        $reserve->save();

        $reserveDate=date_create($reserve->date);
        $reserveHour=date_create($reserve->hour);

        $formattedDate=$reserveDate ? date_format($reserveDate, 'd/m/Y') : '';
        $formattedHour=$reserveHour ? date_format($reserveHour, 'H:i') : '';

        return redirect('/reserves')->with('info', 'Reserva para el día ' . $formattedDate . ' a las ' . $formattedHour . ' actualizada con éxito  por '. auth()->user()->type . '.');        
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
            $reserve=Reserve::find($id);
            $waiter=$autentificado->type=='waiters';
            if($waiter){
                $reserveDate=date_create($reserve->date);
                $reserveHour=date_create($reserve->hour);

                $formattedDate=$reserveDate ? date_format($reserveDate, 'd/m/Y') : '';
                $formattedHour=$reserveHour ? date_format($reserveHour, 'H:i') : '';

                $reserve->delete();
                
                return redirect('/reserves')->with('warning', 'Reserva del día ' . $formattedDate . ' a las ' . $formattedHour . ' horas cancelada con éxito por ' . auth()->user()->type . '.');
            }
        }        
    }
}
