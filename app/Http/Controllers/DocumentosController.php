<?php

namespace Palma\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Palma\Productor;
use Palma\Pesaje;

class DocumentosController extends Controller
{  
    public function listadoinforme(Request $request)
    { $request->user()->authorizeRoles(['admin']);
        return view ('informe');    
    }
    
    public function recibo(Request $request)
    {   
        $request->user()->authorizeRoles(['admin']);
        return view ('recibo');    
    }
    
    public function listarrecibo( Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
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
        
        $sqlcarga = "SELECT P.id, P.precio, descuento, B.preciocontado, B.preciocredito, carga, peso, pago, descripcion, fecha, camion_id, productor_id, precio_id 
        FROM pesaje P 
        INNER JOIN precio B 
        ON P.precio_id = B.id
        WHERE productor_id='".$productorid."' 
        AND  pago='NO'";
          
        $pesaje=DB::select($sqlcarga);
        $total=0;
        foreach($pesaje as $pesajes)
        { 
            if($pesajes->precio==0)
            {
            $total=$total + (totalPrecioFloat(($pesajes->carga-$pesajes->peso-$pesajes->descuento),$pesajes->preciocontado,2));
            }
            else
            {
               $total=$total + (totalPrecioFloat(($pesajes->carga-$pesajes->peso-$pesajes->descuento),$pesajes->preciocredito,2));  
            }
           
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
        $sqlcarga = "SELECT P.id, P.precio, B.preciocontado, B.preciocredito, P.productor_id 
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
       SELECT P.id AS pid, P.precio, C.id AS cp, C.tipo, P.carga AS pcarga, P.peso AS ppeso, R.nombre, R.finca, R.cedula, R.rif, C.cuenta, C.tipocuenta, C.banco, P.pago, B.preciocontado, B.preciocredito, P.peso, P.carga, P.descuento AS pdescuento 
       FROM pesaje P 
       INNER JOIN precio B 
       ON P.precio_id = B.id 
       INNER JOIN productor R 
       ON P.productor_id = R.id 
       INNER JOIN banco C ON R.id = C.productor_id 
       WHERE P.pago = 'NO'  
       ORDER BY B.preciocontado ASC";  
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $fecha=$fecha->format('d-m-Y');
         
            
        
         $productor=DB::select($sql);
       
        $total=0;
        foreach($productor as $var)
        {
            if($var->precio==0)
            {
              $total=((truncateFloatNumber(($var->pcarga-$var->ppeso-$var->pdescuento), 2))*$var->preciocontado)+$total;  
            }
            else 
            {
                 $total=((truncateFloatNumber(($var->pcarga-$var->ppeso-$var->pdescuento), 2))*$var->preciocredito)+$total;   
            }
            
        }
        
        $productor=DB::select($sql);
            
        return view('informe', ['productor'=>$productor, 'total'=>$total,'cedula'=>'0','precio'=>'0','msj'=>'NO HAY RECIBOS POR PAGAR', 'pago'=>'0','fecha'=>$fecha]); 
    }
    public function buscarrecibopago(Request $request)
    {
        $sql = "
       SELECT P.id AS pid, C.id AS cp, C.tipo, P.carga AS pcarga, P.peso AS ppeso,  R.nombre, R.finca, R.cedula, R.rif, C.cuenta, C.tipocuenta, C.banco, P.pago, B.preciocontado, B.preciocredito, P.precio, P.peso, P.carga, P.descuento AS pdescuento 
       FROM pesaje P 
       INNER JOIN precio B 
       ON P.precio_id = B.id 
       INNER JOIN productor R 
       ON P.productor_id = R.id 
       INNER JOIN banco C ON R.id = C.productor_id 
       WHERE P.pago = 'SI' AND fecha='".$request->nombre."'   
       ORDER BY B.preciocontado ASC";  
            
        $fecha=date_create($request->nombre);
        $fecha=$fecha->format('d-m-Y');
         $productor=DB::select($sql);
       
        $total=0;
        foreach($productor as $var)
        {
            if($var->precio==0)
            {
             $total=((truncateFloatNumber(($var->pcarga-$var->ppeso-$var->pdescuento), 2))*$var->preciocontado)+$total;   
            }
            else
            {
             $total=((truncateFloatNumber(($var->pcarga-$var->ppeso-$var->pdescuento), 2))*$var->preciocredito)+$total;   
            }
            
        }
        
        $productor=DB::select($sql);
            
        return view('informe', ['productor'=>$productor, 'total'=>$total,'cedula'=>'0','precio'=>'0','msj'=>'NO HAY RECIBOS POR PAGAR', 'pago'=>'1', 'fecha'=>$fecha]);   
    }
}
