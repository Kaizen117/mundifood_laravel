<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/success';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:25',
            'surname1' => 'required|string|max:30',
            'surname2' => 'required|string|max:30',
            'telephone' => 'required|string|min:9|max:9|unique:users',
            'address' => 'required|string|max:150',            
            'email' => 'required|string|email|max:50|unique:users',
            'username' => 'required|string|max:30',
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'surname1' => $data['surname1'],
            'surname2' => $data['surname2'],
            'telephone' => $data['telephone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'type' => 'users',
            'activated' => false,
            'remember_token' => str_random(10),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
