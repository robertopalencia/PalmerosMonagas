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


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user','admin','watcher']);
            
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
}
