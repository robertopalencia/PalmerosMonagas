<?php

namespace Palma\Http\Controllers;
use Auth;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Palma\Http\Requests;
use Palma\Http\Controllers\Controller;
use DB;
use Palma\Gandola;
use Palma\Cargagandola;
use Palma\Control;
use Illuminate\Support\Facades\Validator;



class GandolaController extends Controller
{
    public function tabla(Request $request)
    {
          $gandol= Gandola::orderBy('chofer')->get();
               
                if (count($gandol)==0)
                {
                 return view('tablagandolas', ['gandol'=>$gandol, 'msj'=>'NO HAY GANDOLAS REGISTRADAS']);
                } 
                else 
                {
                    return view('tablagandolas', ['gandol'=>$gandol]);
                }
    }
    
     public function vistaagregar()
    {
        return view ('agregargandola');    
    }
    public function gandolas()
    {
         $sql = "SELECT chofer, placa, peso_neto, peso_mermado, peso_real, CG.updated_at as fecha, ubicacion, CG.id as id, C.id as cid, G.id as gid FROM cargagandola as CG INNER JOIN gandola as G
        ON  CG.id_gandola = G.id 
        INNER JOIN control as C 
        ON CG.id=C.id_cargagandola WHERE  finale='si' and ubicacion<>'Zulia'"; 
        $gandola=DB::select($sql);
        if(count($gandola)>0)
        {
         return view ('gandolas', ['gandol'=>$gandola, 'gandola'=>'1']); 
        }
        else
        {
         return view('gandolas', ['gandola'=>'0']);    
        }  
    }
     public function endestino()
    {
         $sql = "SELECT chofer, placa, peso_neto, peso_mermado, peso_real, C.updated_at as fecha, ubicacion, CG.id as id, C.id as cid, G.id as gid FROM cargagandola as CG INNER JOIN gandola as G
        ON  CG.id_gandola = G.id 
        INNER JOIN control as C 
        ON CG.id=C.id_cargagandola WHERE  finale='si' and ubicacion='Zulia' order by C.updated_at DESC "; 
        $gandola=DB::select($sql);
        
        if(count($gandola)>0)
        {
         return view ('endestino', ['gandol'=>$gandola, 'gandola'=>'1']); 
        }
        else
        {
         return view('endestino', ['gandola'=>'0']);    
        }  
    }


     public function agregargandola(Request $request) 
    {
      $validator = Validator::make($request->all(),
            [
                'chofer'=>'required |max:70',
                'placa'=>'required | min:6|max:8',
                'peso'=>'required |max:10',
                'cedula'=>'required |min:6|max:9',
                'telefono'=>'required |max:14|unique:gandola',
                
            ]);
        
                if($validator->fails())
                {
                      return redirect('/agregargandola')
                     ->withInput()
                     ->withErrors($validator);
                }
                
                $gandolabd = Gandola::all();
                
                $placa=0;
                
                foreach ($gandolabd as $gandolas) 
                {   
                    if ($request->placa==$gandolas->placa)
                    {
                        $placa=1;
                    }
                }
        
                $cedula=0;
        
                foreach ($gandolabd as $gandolas) 
                {
                    if ($request->cedula==$gandolas->cedula)
                    {
                        $cedula=1;
                    }
                  }
        
                if($placa==0 && $cedula==0)
                {
                    $gandola=new Gandola;
                    $gandola->chofer = $request ->chofer;
                    $gandola->placa = $request ->placa;
                    $gandola->peso = $request ->peso;
                    $gandola->cedula = $request ->cedula;
                    $gandola->telefono = $request ->telefono;
                    
                    if($gandola->save())
                    
                    {
                        return back()->with('msj', 'Vehiculo con placas '.$gandola->placa.' Guardado con Exito');
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
                    return redirect ('/agregargandola');  
    }
    
     public function delete($id)
    {
        
    Gandola::findOrFail($id)->delete();
    return redirect('/tablagandolas');  
        
    }
      public function update ($id, Request $request)
    {
         $validator = Validator::make($request->all(),
            [
                'chofer'=>'required |max:70',
                'placa'=>'required | min:6',
                'peso'=>'required |max:70',
                'cedula'=>'required |min:7',
                'telefono'=>'required |max:14',
                
                
            ]);
                if($validator->fails()){
                      return redirect('/tablagandolas')
                     ->withInput()
                     ->withErrors($validator);
                }
        
            $gandola=Gandola::findOrFail($id);
            $gandola->chofer = $request ->chofer;
            $gandola->placa = $request ->placa;
            $gandola->peso = $request ->peso;
            $gandola->cedula = $request ->cedula;
            $gandola->telefono = $request ->telefono;
            $gandola->save();
        
    return redirect('/tablagandolas');
    }
    public function viewupdate($id)
    {
            $Gandola=Gandola::findOrFail($id);
            return view('editargandolas', ['gandola'=>$Gandola]);
    }
    
    public function pesos($id)
    {
            $Gandola=Cargagandola::findOrFail($id);
            return view('pesos', ['gandola'=>$Gandola]);
    }
    
     public function updatepesos($id, Request $request)
    {
           $gandola=Cargagandola::findOrFail($id);
            $gandola->peso_real = $request ->real;
            $gandola->peso_mermado = $request ->destino;
            $gandola->save();
         return redirect('/gandolas');
    }
    
       public function ubicacion($id)
    {
            $Gandola=Control::findOrFail($id);
            return view('ubicacion', ['gandola'=>$Gandola]);
    }
    
     public function updateubicacion($id, Request $request)
    {
            $gandola=Control::findOrFail($id);
            $gandola->ubicacion = $request ->ubicacion;
            $gandola->save();
         return redirect('/gandolas');
    }
    
      public function buscargandola(Request $request)
    {
         $sql = "SELECT * FROM gandola WHERE chofer='".$request->nombre."' 
            OR chofer LIKE '%".$request->nombre."%' 
             
            OR cedula LIKE '%".$request->nombre."%'
            OR telefono LIKE '%".$request->nombre."%'
             
            OR placa LIKE '%".$request->nombre."%'";
               
            $camion=DB::select($sql);
            
        if(count($camion)==0) 
            {   
            return view ('/tablagandolas', ['gandol'=>$camion, 'msj'=>'No se encontraron coincidencias con: ('.$request->nombre.")"]);
            }
        else 
        {
            return view ('/tablagandolas', ['gandol'=>$camion ]);
        }
    }
    
}

