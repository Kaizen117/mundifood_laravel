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
        //
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
        return view('users.edit', compact('user'));
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

    public function work(){
        return view('users.work');
    }

    public function who(){
        return view('users.who');
    }

    public function faqs(){
        return view('users.faqs');
    }

    public function news(){
        return view('users.news');
    }
    
    public function success(){
        return view('success');
    }
}
