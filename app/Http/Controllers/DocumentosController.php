<?php

namespace Palma\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Palma\Productor;
use Palma\Pesaje;

class DocumentosController extends Controller
{  
    public function listadoinforme()
    {
        return view ('informe');    
    }
    
    public function recibo()
    {
        return view ('recibo');    
    }
    
    public function listarrecibo()
    {
        return view ('listarrecibo');    
    }
    
    public function buscarreciboproductor(Request $request)
    {
        $sql = "SELECT * 
        FROM productor 
        WHERE rif='".$request->nombre."' 
        OR cedula='".$request->nombre."'";  
        
        $sql2 = "SELECT * 
        FROM banco 
        INNER JOIN productor
        ON  banco.productor_id = productor.id WHERE rif='".$request->nombre."' 
        OR cedula='".$request->nombre."'";  
                
        $productorid=0;
        $productornombre=0; 
        $productorcedula=0;
        $productorrif=0;
        $productorfinca=0;
        $productorcorreo=0;
        $productordir=0;
        $productor=DB::select($sql);
        $banco=DB::select($sql2);
        
        foreach($productor as $productores)
        {
            $productorid=$productores->id;
            $productornombre=$productores->nombre;
            $productorcedula=$productores->cedula;
            $productorrif=$productores->rif;
            $productorfinca=$productores->finca;
            $productorcorreo=$productores->correo;
            $productordir=$productores->direccion;
        }
        
        $sqlcarga = "SELECT P.id, B.precio, carga, peso, pago, descripcion, fecha, camion_id, productor_id, precio_id 
        FROM pesaje P 
        INNER JOIN precio B 
        ON P.precio_id = B.id
        WHERE productor_id='".$productorid."' 
        AND  pago='NO'";
          
        $pesaje=DB::select($sqlcarga);
        $total=0;
        foreach($pesaje as $pesajes)
        {
            $total=$total + ((($pesajes->carga-$pesajes->peso)/1000)*$pesajes->precio);
           
        }
        
        if(count($pesaje)==0) 
        {
            if(count($productor)>0)
            {
                $productoresnombre="o";
                
                foreach ($productor as $productores)
                {
                        $productoresnombre=$productores->nombre;
                }
                
                return view ('/listarrecibo', ['productornombre'=>$productornombre, 'pesaje'=>$pesaje, 'productorcedula'=>$productorcedula, 'productorrif'=>$productorrif, 'banco'=>$banco, 'productorfinca'=>$productorfinca,'total'=>$total,'productorcorreo'=>$productorcorreo,  'msj'=>'El productor: '.$productoresnombre." no tiene recibos por cobrar",'productordir'=>$productordir,'productor'=>$productor]);
            
            }
            else 
            {
                return view ('/listarrecibo', ['productornombre'=>$productornombre, 'pesaje'=>$pesaje, 'productorcedula'=>$productorcedula, 'productorrif'=>$productorrif, 'banco'=>$banco, 'productorfinca'=>$productorfinca,'total'=>$total,'productorcorreo'=>$productorcorreo, 'msj'=>'No se encontraron coincidencias con: ('.$request->nombre.')','productordir'=>$productordir,'productor'=>$productor]);
            }
        }
        else
        { 
            return view ('/listarrecibo', ['productornombre'=>$productornombre, 'pesaje'=>$pesaje, 'productorcedula'=>$productorcedula, 'productorrif'=>$productorrif, 'banco'=>$banco, 'productorfinca'=>$productorfinca,'total'=>$total,'productorcorreo'=>$productorcorreo,'productordir'=>$productordir,'productor'=>$productor]);
        }
    }
    public function confirmacionpago($id)
    {
        $sqlcarga = "SELECT P.id, B.precio, P.productor_id 
        FROM pesaje P 
        INNER JOIN precio B 
        ON P.precio_id = B.id
        WHERE P.id='".$id."'";
             
        $pesaje2=DB::select($sqlcarga);
             
        foreach($pesaje2 as $var)
        {
            $productorid=$var->productor_id;
        }
              
        $productor=Productor::findOrFail($productorid);
            
        $pesaje=Pesaje::findOrFail($id);
          
        return view('editarrecibo', ['pesaje'=>$pesaje,'pesaje2'=>$pesaje2,'productor'=>$productor]);
    }
    
    public function pagados($id, Request $request)
    {
    $recibo=Pesaje::findOrFail($id);
    $recibo->carga = $request->carga;
    $recibo->descripcion = $request->descripcion;
    $recibo->pago = $request->pago;
    $recibo->peso = $request->peso;
    $recibo->fecha = $request->fecha;
    $recibo->camion_id = $request->camion_id;
    $recibo->productor_id = $request->productor_id;
    $recibo->precio_id = $request->precio_id;
    $recibo->save();
        
    $productor=Productor::findOrFail($request->productor_id);
        
    return back()->with('msj', 'El pago del productor '.$productor->nombre.' Cedula de Identidad '.$productor->cedula.' Fue Actualizado con exito');
    }
    
    public function informe()
    {
       $sql = "
       SELECT COUNT(C.id) AS cp, C.tipo, SUM(P.carga) AS pcarga, SUM(P.peso) AS ppeso, R.nombre, R.finca, R.cedula, R.rif, C.cuenta, C.tipocuenta, C.banco, P.pago, B.precio, P.peso, P.carga 
       FROM pesaje P 
       INNER JOIN precio B 
       ON P.precio_id = B.id 
       INNER JOIN productor R 
       ON P.productor_id = R.id 
       INNER JOIN banco C ON R.id = C.productor_id 
       WHERE P.pago = 'NO' 
       GROUP BY C.id, B.precio 
       ORDER BY B.precio ASC";  
            
        $sqltotal="
        SELECT sum(peso) as peso, sum(carga) as carga, precio 
        FROM pesaje 
        INNER JOIN precio 
        ON pesaje.precio_id=precio.id 
        WHERE pago='NO' 
        GROUP BY precio.id";
        
        $totales=DB::select($sqltotal);
        $total=0;
        foreach($totales as $var)
        {
            $total=((($var->carga-$var->peso)/1000)*$var->precio)+$total;
        }
        
        $productor=DB::select($sql);
            
        return view('informe', ['productor'=>$productor, 'total'=>$total,'cedula'=>'0','precio'=>'0','msj'=>'NO HAY RECIBOS POR PAGAR', 'pago'=>'0']); 
    }
    public function buscarrecibopago(Request $request)
    {
        $sql = "
            SELECT COUNT(C.id) AS cp, C.tipo, SUM(P.carga) AS pcarga, SUM(P.peso) AS ppeso, R.nombre, R.finca, R.cedula, R.rif, C.cuenta, C.tipocuenta, C.banco, P.pago, B.precio, P.peso, P.carga 
            FROM pesaje P 
            INNER JOIN precio B 
            ON P.precio_id = B.id 
            INNER JOIN productor R 
            ON P.productor_id = R.id 
            INNER JOIN banco C 
            ON R.id = C.productor_id 
            WHERE P.pago = 'SI' 
            AND fecha='".$request->nombre."' 
            GROUP BY C.id, B.precio 
            ORDER BY B.precio ASC";  
            
        $sqltotal=" 
            SELECT sum(peso) as peso, sum(carga) as carga, precio 
            FROM pesaje 
            INNER JOIN precio
            ON pesaje.precio_id=precio.id 
            WHERE pago='SI' 
            AND fecha='".$request->nombre."' 
            GROUP BY precio.id";
            
        $totales=DB::select($sqltotal);
                
        $total=0;
                
        foreach($totales as $var)
        {
                $total=((($var->carga-$var->peso)/1000)*$var->precio)+$total;
        }
        
        $productor=DB::select($sql);
            
        return view('informe', ['productor'=>$productor, 'total'=>$total,'cedula'=>'0','precio'=>'0','msj'=>'NO HAY RECIBOS POR PAGAR', 'pago'=>'1', 'fecha'=>$request->nombre]);    
    }
}
