<?php

namespace Palma\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Palma\Productor;
use Palma\Cupos;

class CuposController extends Controller
{
     public function listarcupos()
    {
        return view ('cupos');    
    }
    
    public function buscarcupos(Request $request)
    {
        $sql = "
                SELECT * 
                FROM cupos 
                INNER JOIN productor 
                ON cupos.productor_id=productor.id 
                WHERE fecha='".$request->nombre."'";
        $sql2 = "
                SELECT * 
                FROM cupos 
                WHERE fecha='hola'";
        
        $cupo=DB::select($sql2);
            
        $cupos=DB::select($sql);
                
        $fecha=0;
                
        $peso=0;
                
        foreach ($cupos as $var)
        {
                $fecha=$var->fecha;
                $fecha=date_create($fecha);
                $peso=$var->peso + $peso;
        }
                        
             if(count($cupos)==0) 
             {   
            return view ('/cupos', ['cupos'=>$cupos,  'cupo'=>$cupo,'fecha'=>$fecha, 'msj'=>'NO HAY CUPOS REGISTRADOS PARA EL '.$request->nombre]);
             }
              else 
              {
                  return view ('/cupos', ['cupos'=>$cupos, 'cupo'=>$cupo,'fecha'=>$fecha,'peso'=>$peso ]);
              }
    }
    
    public function agregarcupos(Request $request)
    {
      $validator = Validator::make($request->all(),
            [
                'peso'=>'required |min:20|max:200000|numeric',
                'fecha'=>'required |date',
                'cedula'=>'required |min:100000|max:200000000|numeric',
                'nacionalidad'=>'required',
            ]);
        
        if($validator->fails())
        {
            return redirect('/agregarcupos')
            ->withInput()
            ->withErrors($validator);
        }
        
        $productor = Productor::all();
                
        $idproductor=0;
                 
        foreach ($productor as $productores) 
        { 
                if ($request->nacionalidad."".$request->cedula==$productores->cedula)
                {
                    $idproductor=$productores->id;
                    $productornombre=$productores->nombre;
                }            
        }
           
        if ($idproductor!=0)
        {
            $cupo=new Cupos;
            $cupo->peso = $request ->peso;
            $cupo->fecha = $request ->fecha;
            $cupo->productor_id = $idproductor;
            
            if($cupo->save())
            {
                return back()->with('msj', 'Cupo para el Productor: '.$productornombre.' Guardado con Exito');
                return redirect ('/cupos');
            }
        }
        else 
        {
            return back()->with('msj2', 'La Cedula de Identidad '.$request->nacionalidad."".$request->cedula.' NO EXISTE');
            return redirect ('/agregarcupos');
        }   
    }
    
    public function tablacupos()
    {
        $sql = "
                SELECT fecha, count(fecha) as cfecha, sum(peso) as speso 
                FROM cupos 
                GROUP BY fecha";
        $sql2 = "
                SELECT fecha 
                FROM cupos 
                WHERE fecha='hola'";
        
        $cupos=DB::select($sql2);
                 
        $cupo=DB::select($sql);
                 
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $fecha= $fecha->format('Y-m-d');
        
        if (count($cupo)==0)
        {
            return view('cupos', ['cupo'=>$cupo, 'cupos'=>$cupos,'msj'=>'NO HAY CUPOS REGISTRADOS', 'fecha'=>$fecha]);
        }
        else 
        {
            return view('cupos', ['cupo'=>$cupo,'cupos'=>$cupos,'fecha'=>$fecha]);
        }
    }
}
