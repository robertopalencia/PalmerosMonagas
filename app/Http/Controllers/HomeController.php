<?php

namespace Palma\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
}
