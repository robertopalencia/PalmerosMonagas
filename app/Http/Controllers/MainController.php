<?php

namespace Palma\Http\Controllers;
use Palma\Precio;
use Palma\User;
use Palma\Camion;
use Palma\Productor;
use Palma\Pesaje;
use Palma\Banco;
use Palma\Cupos;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MainController extends BaseController
{
    public function index()
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
     
    
      public function agregarcupos()
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $fecha->format('d-m-Y');
        return view ('agregarcupos',['fecha'=>$fecha]);    
    }
  
    public function agregarprecio(Request $request)
    {
         $validator = Validator::make($request->all(),
            [
                'precio'=>'required|max:12',
            ]);
        
        if($validator->fails())
        {
            return redirect('/precio')
            ->withInput()
            ->withErrors($validator);
        }
        
        $precio=new Precio;
        $precio->precio = $request->precio;    
        $precio->save();
        return redirect ('/precio');
      
    }
    
    public function precio()
    {
        return view ('precio'); 
    }
     
    public function register()
    {
        return view('auth.register');
    }
}

