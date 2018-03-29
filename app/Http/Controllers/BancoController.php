<?php

namespace Palma\Http\Controllers;
use DB;
use Palma\Productor;
use Palma\Banco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BancoController extends Controller
{
    
    
    public function vistaagregar(Request $request)
    { $request->user()->authorizeRoles(['admin']);
        return view ('agregarcuenta');    
    }
    
    public function buscarbanco(Request $request)
    {
       $sql = "
            SELECT * FROM productor WHERE nombre='".$request->nombre."' 
            OR nombre LIKE '%".$request->nombre."%'  
            OR cedula LIKE '%".$request->nombre."%' 
            OR rif LIKE '%".$request->nombre."%'
            OR correo LIKE '%".$request->nombre."%' 
            OR finca LIKE '%".$request->nombre."%'";  
        
        $sql2 = "
                SELECT * FROM banco WHERE banco='".$request->nombre."' 
                OR banco LIKE '%".$request->nombre."%' 
                OR cuenta LIKE '%".$request->nombre."%' 
                OR tipo LIKE '%".$request->nombre."%'
                OR tipocuenta LIKE '%".$request->nombre."%'";
        
        $banco= DB::select($sql2);
        $productor=DB::select($sql);
        
        if(count($banco)==0 && count($productor)==0)
        {
            return view ('/banco', ['productor'=>$productor,'banco'=>$banco, 'msj'=>'No se encontraron coincidencias con: ('.$request->nombre.")"]); 
        }
        else
        {      
            if(count($banco)>0)
            {
                if(count($productor)>0)
                {
                    return view ('/banco', ['productor'=>$productor,'banco'=>$banco]);
                }
                else 
                { 
                    $productor=Productor::all();
                    return view ('/banco', ['productor'=>$productor,'banco'=>$banco]);
                    
                }
            }
            else 
            {
                 $banco=Banco::all();
                 return view ('/banco', ['productor'=>$productor,'banco'=>$banco]);
            }
        }  
    }
    
    public function agregarbanco(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'cuenta'=>'required |digits:20|numeric',
                'banco'=>'required |max:50',
                'tipo'=>'required',
                'tipocuenta'=>'required',
                'cedula'=>'required |min:100000|max:200000000|numeric',
                'nacionalidad'=>'required',
            ]);   
        
        if($validator->fails())
        {
            return redirect('/agregarcuenta')
            ->withInput()
            ->withErrors($validator);
        }
                
        $productor = Productor::all();
        $bancobd=Banco::all();
        $idproductor=0;
                    
        foreach ($productor as $productores) 
        {
                   
            if ($request->nacionalidad."".$request->cedula==$productores->cedula)
            {
                $idproductor=$productores->id;
                $nombre=$productores->nombre;
            }
        }
        
        $cuenta=0;
                
        foreach ($bancobd as $bancos) 
        {
            if ($request->cuenta==$bancos->cuenta)
            {
                $cuenta=1;
            }
        }
        
        if($idproductor>0 && $cuenta==0)
        {   
            $banco=new Banco;
            $banco->cuenta = $request->cuenta;
            $banco->banco = $request->banco;
            $banco->tipo = $request->tipo;
            $banco->tipocuenta = $request->tipocuenta;
            $banco->productor_id = $idproductor;
            
            if($banco->save())
            
            {    
                return back()->with('msj', 'Cuenta Bancaria Nº '.$request->cuenta.' Del Banco '.$request->banco.', del Productor: '.$nombre.' fue Guardada con Exito');
                return redirect ('/banco');
            }
            else 
            {
                return back();
            }
        }
        else 
        {
            if($idproductor==0)
            {
                return back()->with('msj2', 'La Cedula de Identidad: '.$request->cedula.' NO EXISTE');
            }
            else
            {
                if ($cuenta==1)
                {
                    return back()->with('msj2', 'La Cuenta Bancaria Nº '.$request->cuenta.' YA EXISTE');
                } 
            }
                return redirect ('/agregarcuenta');
        }
    }
    
    public function tablabancos(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $banco= Banco::all();
        $productor=Productor::orderBy('nombre')->get();
        
        if (count($banco)==0 || count($productor)==0 )
        {
            return view('banco', ['productor'=>$productor,'banco'=>$banco, 'msj'=>'NO HAY CUENTAS BANCARIAS REGISTRADAS']);
        }
        else 
        {
            return view('banco', ['productor'=>$productor,'banco'=>$banco]);
        }
    }
    
    public function delete($id)
    {
        Banco::findOrFail($id)->delete();
        return redirect('/banco');
    }
    
    public function update ($id, Request $request)
    {
         $validator = Validator::make($request->all(),
            [
                 'cuenta'=>'required |digits:20|numeric',
                'banco'=>'required |max:50',
                
                'tipo'=>'required',
                'tipocuenta'=>'required',
            ]);
        
        if($validator->fails())
        {
            return redirect('/banco')
            ->withInput()
            ->withErrors($validator);
        }
        
        $banco=Banco::findOrFail($id);
        $banco->cuenta = $request ->cuenta;
        $banco->banco = $request ->banco;  
        $banco->tipo = $request ->tipo;
        $banco->tipocuenta = $request ->tipocuenta;
    
        if($banco->save())
        {
            return redirect('/banco');
        }
        
        return redirect('/banco');
    }
    
    public function updateview($id, Request $request)
    {   
        $request->user()->authorizeRoles(['admin']);
        $banco=Banco::findOrFail($id);
        $productorid=$banco->productor_id;
        $productor=Productor::findOrFail($productorid);
        return view('editarcuenta', ['banco'=>$banco, 'productor'=>$productor]);
    }
}
