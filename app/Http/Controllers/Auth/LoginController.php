<?php

namespace Palma\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use Palma\Http\Requests\LoginRequest;
use Palma\Precio;
use Palma\User;
use Palma\Camion;
use Palma\Productor;
use Palma\Pesaje;
use Palma\Banco;
use Palma\Cupos;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    
     public function login(Request $request)
    {
     $credentials = ['email'=>$request->email, 'password'=>$request->password];
        
         if(Auth::attempt($credentials))
         {
        $productorsql="SELECT count(id) as idp FROM productor";
        $camionsql="SELECT count(id) as idp FROM camion";
        $pesajessql="SELECT count(id) as idp FROM pesaje where pago='NO'";
        $usuariossql="SELECT count(id) as idp FROM users";
        $productor= DB::select($productorsql);
        $camion=DB::select($camionsql);
        $pesaje=DB::select($pesajessql);
        $usuario=DB::select($usuariossql);
              
        return view('index', ['productor'=>$productor, 'camion'=>$camion, 'pesaje'=>$pesaje,'usuario'=>$usuario ]); 
         }
         return back()->withErrors(['email'=>'Estas credenciales no concuerdan con nuestros registros']);
    }
    
       public function showLoginForm()
    {
        
           return view ('auth.login');
    }
}
