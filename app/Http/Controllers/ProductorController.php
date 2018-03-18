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
                'localidad'=>'required |min:1',
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
            $productor->direccion = $request->localidad.", ".$request ->direccion;
            $productor->correo = $request ->correo;
            $productor->telefono = $request ->telefono;
                    $productor_id= Productor::all();
                    var_dump($productor_id->last());
                    $idcodigo=0;
                    foreach ($productor_id as $id)
                    {
                        $idcodigo=$id->id;
                    }
            if ($request->localidad=='La Hormiga')
            {   if ($idcodigo<9){
                $productor->cod='PH00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PH0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PH'.($idcodigo+1);
             }
            }
            else if ($request->localidad=='Vuelta Larga')
            {   if ($idcodigo<9){
                $productor->cod='PVL00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PVL0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PVL'.($idcodigo+1);
             }
            } 
            else if ($request->localidad=='El Zamuro')
            {   if ($idcodigo<9){
                $productor->cod='PZ00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PZ0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PZ'.($idcodigo+1);
             }
            } 
             else if ($request->localidad=='Cachipo')
            {   if ($idcodigo<9){
                $productor->cod='PC00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PC0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PC'.($idcodigo+1);
             }
            }
            else if ($request->localidad=='Aguila')
            {   if ($idcodigo<9){
                $productor->cod='PA00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PA0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PA'.($idcodigo+1);
             }
            }
            else if ($request->localidad=='Vivoral')
            {   if ($idcodigo<9){
                $productor->cod='PV00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PV0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PV'.($idcodigo+1);
             }
            }
            else if ($request->localidad=='Caripito')
            {   if ($idcodigo<9){
                $productor->cod='PCR00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PCR0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PCR'.($idcodigo+1);
             }
            }
            else if ($request->localidad=='Pica June')
            {   if ($idcodigo<9){
                $productor->cod='PPJ00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PPJ0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PPJ'.($idcodigo+1);
             }
            }
             else if ($request->localidad=='San Augustin')
            {   if ($idcodigo<9){
                $productor->cod='PSA00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PSA0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PSA'.($idcodigo+1);
             }
            }
            else if ($request->localidad=='El Barril')
            {   if ($idcodigo<9){
                $productor->cod='PEB00'.($idcodigo+1);
                }
                else if($idcodigo>8&&$idcodigo<99) {
                 $productor->cod='PEB0'.($idcodigo+1);
             }
                else if ($idcodigo>98){
                 $productor->cod='PEB'.($idcodigo+1);
             }
            }
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
