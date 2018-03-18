<?php

namespace Palma\Http\Controllers;
use Auth;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Palma\Http\Requests;
use Palma\Http\Controllers\Controller;
use DB;
use Palma\Camion;


use Illuminate\Support\Facades\Validator;


class VehiculoController extends Controller
{ 
    public function vistaagregar(Request $request)
    {
        $request->user()->authorizeRoles(['admin','user']);
        return view ('caagregar');    
    }
    
    public function listacamiones()
    {
        return view ('tablacamiones');    
    }
    
    public function buscarcamion(Request $request)
    {
         $sql = "SELECT * FROM camion WHERE nombre='".$request->nombre."' 
            OR nombre LIKE '%".$request->nombre."%' 
             
            OR cedula LIKE '%".$request->nombre."%' 
             
            OR placa LIKE '%".$request->nombre."%'";
               
            $camion=DB::select($sql);
            
        if(count($camion)==0) 
            {   
            return view ('/tablacamiones', ['camion'=>$camion, 'msj'=>'No se encontraron coincidencias con: ('.$request->nombre.")"]);
            }
        else 
        {
            return view ('/tablacamiones', ['camion'=>$camion ]);
        }
    }
    public function agregarcamion(Request $request) 
    {
      $validator = Validator::make($request->all(),
            [
                'nombre'=>'required |max:70',
                'placa'=>'required | min:6|max:8|unique:camion|unique:gandola',
                'peso'=>'required |max:10',
                'cedula'=>'required |min:6|max:9',
                'marca'=>'required |max:20',
                'modelo'=>'required |max:20',
                'color'=>'required |max:20',
                'ano'=>'required |min:2|max:4',
                'telefono'=>'required |max:14|unique:camion',
                
            ]);
        
                if($validator->fails())
                {
                      return redirect('/caagregar')
                     ->withInput()
                     ->withErrors($validator);
                }
                
                $camionbd = Camion::all();
                
                $placa=0;
                
                foreach ($camionbd as $camiones) 
                {   
                    if ($request->placa==$camiones->placa)
                    {
                        $placa=1;
                    }
                }
        
                $cedula=0;
        
                foreach ($camionbd as $camiones) 
                {
                    if ($request->cedula==$camiones->cedula)
                    {
                        $cedula=1;
                    }
                  }
        
                if($placa==0 && $cedula==0)
                {
                    $camion=new Camion;
                    $camion->nombre = $request ->nombre;
                    $camion->placa = $request ->placa;
                    $camion->peso = $request ->peso;
                    $camion->cedula = $request ->cedula;
                    $camion->telefono = $request ->telefono;
                    $camion->modelo = $request ->modelo;
                    $camion->ano = $request ->ano;
                    $camion->marca = $request ->marca;
                    $camion->color = $request ->color;
                    
                    if($camion->save())
                    
                    {
                        return back()->with('msj', 'Vehiculo con placas '.$camion->placa.' Guardado con Exito');
                    }
                    else 
                    {
                        return back();
                    }
                }
               else {
                    if($cedula==1)
                    {
                        if($placa==1)
                        {
                            return back()->with('msj2', 'La Placa '.$request->placa.' del Vehiculo y la Cedula de Identidad del Chofer '.$request->cedula.", YA EXISTEN");
                        }
                        else
                        {
                           return back()->with('msj2', 'La Cedula de Identidad: '.$request->cedula.", YA EXISTE"); 
                        }
                    }
                    else 
                    {
                        return back()->with('msj2', 'La placa: '.$request->placa.", YA EXISTE"); 
                        
                    }
                }
                    return redirect ('/caagregar');  
    }
    
    public function tablacamiones (Request $request) 
    {
         $camion= Camion::orderBy('nombre')->get();
               
                if (count($camion)==0)
                {
                 return view('tablacamiones', ['camion'=>$camion, 'msj'=>'NO HAY CAMIONES REGISTRADO']);
                } 
                else 
                {
                    return view('tablacamiones', ['camion'=>$camion]);
                }
    }
    
    public function delete($id)
    {
        
    Camion::findOrFail($id)->delete();
    return redirect('/tablacamiones');  
        
    }
    
    public function update ($id, Request $request)
    {
         $validator = Validator::make($request->all(),
            [
                'nombre'=>'required |max:70',
                'placa'=>'required | min:6',
                'peso'=>'required |max:70',
                'cedula'=>'required |min:7',
                'telefono'=>'required |max:14',
                'marca'=>'required |max:20',
                'modelo'=>'required |max:20',
                'ano'=>'required |min:2|max:4',
                'color'=>'required |max:20',
                
                
            ]);
                if($validator->fails()){
                      return redirect('/tablacamiones')
                     ->withInput()
                     ->withErrors($validator);
                }
        
            $camion=Camion::findOrFail($id);
            $camion->nombre = $request ->nombre;
            $camion->placa = $request ->placa;
            $camion->peso = $request ->peso;
            $camion->cedula = $request ->cedula;
            $camion->telefono = $request ->telefono;
            $camion->modelo = $request ->modelo;
            $camion->ano = $request ->ano;
            $camion->marca = $request ->marca;
            $camion->color = $request ->color;
            $camion->save();
        
    return redirect('/tablacamiones');
    }
    
    public function viewupdate($id)
    {
            $camion=Camion::findOrFail($id);
            return view('editarcamiones', ['camion'=>$camion]);
    }
}
