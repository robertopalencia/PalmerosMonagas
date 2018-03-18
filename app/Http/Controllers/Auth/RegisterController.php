<?php

namespace Palma\Http\Controllers\Auth;
use Palma\Role;
use Palma\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
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
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'tipo'=>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Palma\User
     */
    protected function create(array $data)
    {
         $user=User::create([
            'name'=>$data['name'],
            'email'=>$data ['email'],
            'password'=>bcrypt($data['password']),
            
        ]);
        if($data['tipo']=='Administrador')
        {
           $user->roles()->attach(Role::where('name', 'admin')->first());
            return $user; 
        }
        else if($data['tipo']=='Usuario') 
        {
            $user->roles()->attach(Role::where('name', 'user')->first());
            return $user; 
        }
         else if($data['tipo']=='Observador') 
        {
            $user->roles()->attach(Role::where('name', 'watcher')->first());
            return $user; 
        }
        
    }
}
