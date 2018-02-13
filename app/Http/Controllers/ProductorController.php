<?php

namespace Palma\Http\Controllers;
use Auth;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Palma\Http\Requests;
use Palma\Http\Controllers\Controller;
use DB;
use Palma\Productor;
use Palma\Banco;

use Illuminate\Support\Facades\Validator;
class ProductorController extends Controller
{
    
    public function vistaagregar()
    {
        return view ('proagregar');    
    }
    
    public function listaproductores()
    {
        return view ('tablaproductores');    
    }
    
    public function buscarproductor(Request $request)
    {
          $sql = "SELECT * FROM productor WHERE nombre='".$request->nombre."' 
            OR nombre LIKE '%".$request->nombre."%' 
             
            OR cedula LIKE '%".$request->nombre."%' 
             
            OR rif LIKE '%".$request->nombre."%' 
            
            OR finca LIKE '%".$request->nombre."%'
             
            OR direccion LIKE '%".$request->nombre."%'";  
                
            $productor=DB::select($sql);
             if(count($productor)==0) {   
            return view ('/tablaproductores', ['productor'=>$productor, 'msj'=>'No se encontraron coincidencias con: ('.$request->nombre.")"]);
            }
             else {return view ('/tablaproductores', ['productor'=>$productor]);}
             
    }
    
    
     public function agregarproductor(Request $request)
     {
        $validator = Validator::make($request->all(),
            [
                'nombre'=>'required |min:8|max:70',
                'cedula'=>'required |min:100000|max:200000000|numeric',
                'rif'=>'required |min:7|max:15',
                'finca'=>'required | max:70',
                'direccion'=>'required |max:70',
                'cuenta'=>'required |digits:20|numeric|unique:banco',
                'banco'=>'required |max:50',
                'correo'=>'required |max:70 |email|unique:productor',
                'telefono'=>'required |max:14|unique:productor',
                'tipo'=>'required',
                'tipocuenta'=>'required',
        
                
            ]);
                 
                
                if($validator->fails()){
                     return redirect('/proagregar')
                     ->withInput()
                     ->withErrors($validator);
                }
                $productorbd = Productor::all();
                $bancobd = banco::all();
                $cedula=0;
                  foreach ($productorbd as $productores) {
                   
                    if ($request->cedula==$productores->cedula){
                        $cedula=1;
                    }
                  }
                $rif=0;
                
                foreach ($productorbd as $productores2) {
                    
                    if ($request->rif==$productores2->rif){
                        $rif=1;
                    }
                  }
                $cuenta=0;
                foreach ($bancobd as $bancos) {
                   
                    if ($request->cuenta==$bancos->cuenta){
                        $cuenta=1;
                    }
                  }
                if($cedula==0 && $rif==0 && $cuenta==0){
                   
            
            $productor=new Productor;
            $productor->nombre = $request ->nombre;
            $productor->cedula = $request ->cedula;
            $productor->rif= $request ->rif;
            $productor->finca = $request ->finca;
            $productor->direccion = $request ->direccion;
            $productor->correo = $request ->correo;
            $productor->telefono = $request ->telefono;
                        
            if($productor->save()){
                 $productorid=DB::select('SELECT id from productor');
                $id=0;
                foreach($productorid as $var){
                    if($id<$var->id){
                    $productorid2=$var->id;
                }}
                $banco=new Banco;
            $banco->cuenta = $request->cuenta;
            $banco->banco = $request->banco;
            $banco->tipo = $request->tipo;
            $banco->tipocuenta = $request->tipocuenta;
            $banco->productor_id = $productorid2;

               if($banco->save()){ 
                return back()->with('msj', 'Productor: '.$productor->nombre.' con la Cedula de Identidad: '.$productor->cedula.' fue Guardado con Exito');
            }
            
            }
                else {return back();}
                }
                else {
                    if($cedula==1){
                        if($rif==1){
                            if($cuenta==1) {
                                 return back()->with('msj2', 'La Cuenta Bancaria Nº: '.$request->cuenta.', la Cedula de Identidad: '.$request->cedula." y el RIF: ".$request->rif." YA EXISTEN");
                            }
                            else {
                                
                            return back()->with('msj2', 'El RIF: '.$request->rif.' y la Cedula de Identidad: '.$request->cedula.", YA EXISTEN");
                            }
                        }
                        else{
                            if ($cuenta==1){
                                return back()->with('msj2', 'La Cuenta Bancaria Nº '.$request->cuenta.' y la Cedula de Identidad: '.$request->cedula.", YA EXISTEN");
                            }
                            else {
                                return back()->with('msj2', 'La Cedula de Identidad: '.$request->cedula.", YA EXISTE"); 
                            }
                           
                        }
                    }
                    else {
                        if($cuenta==1 && $rif==1){
                            return back()->with('msj2', 'La Cuenta Bancaria Nº '.$request->cuenta.' y el RIF: '.$request->rif.", YA EXISTEN");
                        }
                        else { if($cuenta == 1){
                            return back()->with('msj2', 'La Cuenta Bancaria Nº: '.$request->cuenta.", YA EXISTE"); 
                            
                        }
                              else {
                                  return back()->with('msj2', 'El RIF: '.$request->rif.", YA EXISTE"); 
                              }
                            
                        } 
                        
                    }
                }
                return redirect ('/proagregar');  
     }
    
    public function tablaproductores()
    {
          $productor= Productor::orderBy('nombre')->get();
              
                if (count($productor)==0){
                 return view('tablaproductores', ['productor'=>$productor, 'msj'=>'NO HAY PRODUCTORES REGISTRADO']);
            }
                else {  return view('tablaproductores', ['productor'=>$productor]);}
    }
     
    public function delete($id)
    
    {
    Productor::findOrFail($id)->delete();
    return redirect('tablaproductores');
    }
    public function viewupdate($id) 
    {
         $productor=Productor::findOrFail($id);
            return view('editarproductores', ['productor'=>$productor]);
    }
     public function update($id, Request $request) 
     
     {
       $validator = Validator::make($request->all(),
            [
                 'nombre'=>'required |max:70',
                'cedula'=>'required |min:7',
                'rif'=>'required |min:7',
                'finca'=>'required | max:70',
                'direccion'=>'required |max:70',
                'correo'=>'required |max:70 |email',
                'telefono'=>'required |max:14',
                
            ]);
                if($validator->fails()){
                      return redirect('/tablaproductores')
                     ->withInput()
                     ->withErrors($validator);
                }
    $productor=Productor::findOrFail($id);
     $productor->nombre = $request ->nombre;
            $productor->cedula = $request ->cedula;
            $productor->rif = $request ->rif;
            $productor->finca = $request ->finca;
    $productor->direccion = $request ->direccion;
    $productor->correo = $request ->correo;
      $productor->telefono = $request ->telefono;
    
            $productor->save();
    return redirect('/tablaproductores');  
     }
}
