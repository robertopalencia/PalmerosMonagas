<?php

namespace Palma\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Palma\Camion;
use Palma\Productor;
use Palma\Precio;
use Palma\Pesaje;
use Palma\Gandola;
use Palma\Cargagandola;
use Palma\Control;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;
class PesajeController extends Controller
{
    public function control(Request $request)
    { $request->user()->authorizeRoles(['admin','user']);
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $fecha=$fecha->format('Y-m-d');
        $fecha2=$fecha;  
        
        $sql="SELECT Pe.peso AS peso, Pe.precio, Pr.preciocontado, Pr.preciocredito, Pe.cargagandola_id AS cargagandola, Po.cod, C.modelo, C.marca, C.ano, descuento, C.cedula as cedula, C.nombre as nombre, Po.id as poid, Pe.created_at AS entrada, Pe.updated_at AS salida, rif, finca, Po.nombre AS nombre, placa, carga, Pe.id AS pid, C.id AS cid, fecha, precio 
           FROM pesaje Pe 
           INNER JOIN productor Po 
           ON Pe.productor_id=Po.id
           INNER JOIN camion C
           ON Pe.camion_id=C.id 
           INNER JOIN precio Pr 
           ON Pe.precio_id=Pr.id
           WHERE fecha='".$fecha."'";
        $sqlgandola="SELECT placa, cargagandola_id FROM pesaje P INNER JOIN cargagandola C ON P.cargagandola_id=C.id INNER JOIN gandola G ON C.id_gandola=G.id WHERE fecha='".$fecha."'";
        $gandola=DB::select($sqlgandola);
        $control=DB::select($sql);
        $monto=0;
        $total=0;
        $monagas=0;
        foreach ($control as $precio)
        {
            if($precio->precio==0){
            $monto=$monto+(truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2)*$precio->preciocontado);
            }
            else
            {
               $monto=$monto+(truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2)*$precio->preciocredito); 
            }
            $total=$total+truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2);
            $monagas=$monagas+($precio->carga-$precio->peso-$precio->descuento);
           
        }
            return view('control',['gandolas'=>$gandola, 'controles'=>$control, 'total'=>$monto,'totalcarga'=>$total, 'hoy'=>'1','fecha'=>$fecha, 'msj'=>'Para hoy, no hay registros aún', 'fecha2'=>$fecha2,'monagas'=>$monagas]);
    }
    public function search(Request $request)
    { 
        
        
        $sql="SELECT Pe.peso AS peso, descuento, Pe.precio, Pr.preciocontado, Pr.preciocredito, C.cedula as cedula, Po.cod, C.modelo, C.marca, C.ano, C.nombre as nombre, Po.id as poid, Pe.created_at AS entrada, Pe.updated_at AS salida, rif, finca, Po.nombre AS nombre, placa, carga, Pe.id AS pid, C.id AS cid, fecha, precio 
           FROM pesaje Pe 
           INNER JOIN productor Po 
           ON Pe.productor_id=Po.id
           INNER JOIN camion C
           ON Pe.camion_id=C.id 
           INNER JOIN precio Pr 
           ON Pe.precio_id=Pr.id
           WHERE fecha='".$request->nombre."'";
        $sqlgandola="SELECT placa, cargagandola_id FROM pesaje P INNER JOIN cargagandola C ON P.cargagandola_id=C.id INNER JOIN gandola G ON C.id_gandola=G.id WHERE fecha='".$request->nombre."'";
        $gandola=DB::select($sqlgandola);
        $control=DB::select($sql);
        $monto=0;
        $monagas=0;
        $total=0;
        
        $fecha=date_create($request->nombre);
        $fecha2=$request->nombre;
        foreach ($control as $precio)
        {
            if($precio->precio==0){
            $monto=$monto+(truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2)*$precio->preciocontado);
            }
            else
            {
               $monto=$monto+(truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2)*$precio->preciocredito); 
            }
            $total=$total+truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2);
            $monagas=$monagas+($precio->carga-$precio->peso-$precio->descuento);
        }
            return view('control',['controles'=>$control, 'total'=>$monto,'msj'=>'No hay registros para la fecha: '.$request->nombre, 'hoy'=>'0','fecha'=>$fecha, 'totalcarga'=>$total,'fecha2'=>$fecha2, 'gandolas'=>$gandola,'monagas'=>$monagas]);
    }
     public function searchByGandola(Request $request)
    {
        
        $sql="SELECT Pe.peso AS peso, descuento, C.cedula as cedula, Pe.precio, Pr.preciocontado, Pr.preciocredito, Po.cod, C.modelo, C.marca, C.ano, C.nombre as nombre, Po.id as poid, Pe.created_at AS entrada, Pe.updated_at AS salida, rif, finca, Po.nombre AS nombre, placa, carga, Pe.id AS pid, C.id AS cid, fecha, precio 
           FROM pesaje Pe 
           INNER JOIN productor Po 
           ON Pe.productor_id=Po.id
           INNER JOIN camion C
           ON Pe.camion_id=C.id 
           INNER JOIN precio Pr 
           ON Pe.precio_id=Pr.id
           WHERE fecha='".$request->fecha."' AND Pe.cargagandola_id='".$request->id."'";
        $control=DB::select($sql);
        $monto=0;
         $monagas=0;
        $total=0;
          $sqlgandola="SELECT placa, cargagandola_id FROM pesaje P INNER JOIN cargagandola C ON P.cargagandola_id=C.id INNER JOIN gandola G ON C.id_gandola=G.id WHERE fecha='".$request->fecha."'";
        $gandola=DB::select($sqlgandola);
        
        $fecha=date_create($request->fecha);
        $fecha2=$request->fecha;
        foreach ($control as $precio)
        {
            if($precio->precio==0){
            $monto=$monto+(truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2)*$precio->preciocontado);
            }
            else
            {
               $monto=$monto+(truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2)*$precio->preciocredito); 
            }
            $total=$total+truncateFloatNumber(($precio->carga-$precio->peso-$precio->descuento), 2);
            $monagas=$monagas+($precio->carga-$precio->peso-$precio->descuento);
        }
            return view('control',['controles'=>$control, 'total'=>$monto,'msj'=>'No hay registros para la fecha: '.$request->nombre, 'hoy'=>'0','fecha'=>$fecha,'totalcarga'=>$total,'fecha2'=>$fecha2,'gandolas'=>$gandola,'monagas'=>$monagas]);
    }
    public function peso($id, Request $request)
    {
            $request->user()->authorizeRoles(['admin','user']);
            $peso=Pesaje::findOrFail($id);
            return view('editarpesorecibo', ['peso'=>$peso]);
    }
    public function update($id, Request $request) 
     
     {
       
    $pesaje=Pesaje::findOrFail($id);
     $pesaje->descuento = $request ->real;
    
            $pesaje->save();
    return back()->with('msj','Guardado con exito');  
     }
     public function pesocamion($id, Request $request)
    {   
         $request->user()->authorizeRoles(['admin','user']); 
        $peso=Pesaje::findOrFail($id);
         $camion=Camion::findOrFail($peso->camion_id);
            
            return view('editarpesocamion', ['peso'=>$peso, 'camion'=>$camion]);
    }
    public function updatecamion($id, Request $request) 
     
     {
       
    $pesaje=Pesaje::findOrFail($id);
   
    $camion=Camion::findOrFail($pesaje->camion_id);
    $camion->peso = $request->real;
    $camion->save();
    $pesaje->peso = $request ->real;
    $pesaje->save();
    return back()->with('msj','Guardado con exito');  
     }
    
    public function vistaagregar(Request $request)
    { 
        $request->user()->authorizeRoles(['admin','user']);
        $sqlcargagandola = "SELECT * FROM cargagandola WHERE finale='no'"; 
        $cargagandola=DB::select($sqlcargagandola);
        $idgandola=0;
        foreach($cargagandola as $cargas)
        {
            $idcarga=$cargas->id;
            $idgandola=$cargas->id_gandola;
            $pesoneto=$cargas->peso_neto;
        }
        $sqlgandola = "SELECT * FROM gandola WHERE id='".$idgandola."'"; 
        $gandola=DB::select($sqlgandola);
         foreach($gandola as $gandolas)
        {
            $placa=$gandolas->placa;
            $gandolapeso=$gandolas->peso;
        }
        if(count($cargagandola)>0)
        {
         return view ('pagregar', ['idgandola'=>'1', 'idcarga'=>$idcarga, 'placagandola'=>$placa, 'pesoneto'=>$pesoneto, 'gandolapeso'=>$gandolapeso]); 
        }
        else
        {
         return view ('pagregar', ['idgandola'=>'0']);    
        }
    }
    
    public function agregarcarga (Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'carga'=>'required |max:2000000|numeric',
                'tara'=>'required |max:2000000|numeric',
                'descripcion'=>'required |max:70',
                'rif'=>'required |min:6|max:14',
                'placa'=>'required |min:6|max:9',
                'gandola'=>'required |min:6|max:9',
                'letra'=>'required',
                'precio'=>'required',
                
            ]);
                if($validator->fails())
                {
                      return redirect('/pagregar')
                     ->withInput()
                     ->withErrors($validator);
                }
                $camion = Camion::all();
                $gandola = Gandola::all();
                $productor = Productor::all();
                $precio = Precio::all();
                $precios2=0;
        if (count($precio)==0) {
             return redirect('/pagregar')
                 ->with('msj3', 'NO HAY UN PRECIO CARGADO EN LA BASE DE DATOS');
        }
        else {
             
                foreach ($precio as $precios){
                     
                    if($precios->id>=$precios2) {
                        $precios2=$precios->id;
                        $preciocredito=$precios->preciocredito;
                        $preciocontado=$precios->preciocontado;
                                             }
                                         } 
                 $idcamion=0;
                foreach ($camion as $camiones) {
                   
                    if ($request->placa==$camiones->placa){
                        $idcamion=$camiones->id;
                        $pesocamion=$camiones->peso;
                        $placa=$camiones->placa;
                    }
                    
                } $idproductor=0;
                 foreach ($productor as $productores) {
                    
                     
                    if (($request->letra."".$request->rif)==$productores->rif){
                        $idproductor=$productores->id;
                        $productornombre=$productores->finca;
                        $productorrif=$productores->rif;
                    }
                    
                }
                $sqlcargagandola = "SELECT * FROM cargagandola WHERE finale='no'"; 
                $cargagandola=DB::select($sqlcargagandola);
       
        foreach ($cargagandola as $cargagandolas) {
       $idcarga=$cargagandolas->id;
       $idgandolacarga=$cargagandolas->id_gandola;
       $pesoneto=$cargagandolas->peso_neto;
       }
                $idgandola=0;
                $gandolapeso=0;
                $placagandola=0;
                $idgandolacarga=0;
        
                foreach ($gandola as $gandolas) {
                     
                    if ($request->gandola==$gandolas->placa)
                    {
                        $idgandola=$gandolas->id;
                        $gandolapeso=$gandolas->peso;
                        $placagandola=$gandolas->placa;
                    } 
                
                }
           foreach ($gandola as $gandolas) {
         if($idgandolacarga==$gandolas->id)
                    {
                       $idgandola=$gandolas->id;
                        $gandolapeso=$gandolas->peso;
                        $placagandola=$gandolas->placa; 
                    }
           }
        
           if ($idproductor!=0&&$idcamion!=0)
           {
               if ($idgandola!=0)
               {
                   
            $camion=Camion::findOrFail($idcamion);
            
            $camion->peso = $request ->tara;
            $camion->save();
                   
            $carga=new Pesaje;
            $carga->carga = $request->carga;
            $carga->descripcion = $request->descripcion;
            $carga->peso=$request->tara;
            $carga->pago="NO";
            $carga->camion_id = $idcamion;
                   
            $carga->productor_id = $idproductor;
            $carga->precio_id = $precios2;
               if ($request->precio=='contado')
                {
                    $carga->precio=0;
                }
                else
                {
                $carga->precio=1;    
                }
               
                if(count($cargagandola)>0)
                {
                $suma=0;
                $pesaje=$request->carga-$pesocamion;
                $suma=$pesaje+$pesoneto;
                $gandola2=Cargagandola::findOrFail($idcarga);
                $gandola2->peso_neto = $suma;
                $gandola2->save();
                $carbon = new \Carbon\Carbon();
                $fecha = $carbon->now();
                $fecha=$fecha->format('Y-m-d');
                $carga->fecha = $fecha;
                $carga->cargagandola_id = $idcarga;
             
             if($carga->save()){
                 if($request->precio=='contado')
                 {
                return back()->with('msj', 'Carga del Productor: '.$productornombre.' Guardada con Exito')->with('peso',$request->tara)->with('carga',$request->carga)->with('precio',$preciocontado)->with('nombre',$productornombre)->with('cedula',$productorrif)->with('placa',$placa)->with('idgandola','1')->with('idcarga',$idcarga)->with('pesoneto',$suma)->with('placagandola',$placagandola)->with('gandolapeso', $gandolapeso)->with('descuento', '0');
                 }
                 else if($request->precio=='credito')
                 {
                  return back()->with('msj', 'Carga del Productor: '.$productornombre.' Guardada con Exito')->with('peso',$request->tara)->with('carga',$request->carga)->with('precio',$preciocredito)->with('nombre',$productornombre)->with('cedula',$productorrif)->with('placa',$placa)->with('idgandola','1')->with('idcarga',$idcarga)->with('pesoneto',$suma)->with('placagandola',$placagandola)->with('gandolapeso', $gandolapeso)->with('descuento', '0');   
                 }
            }
                }
            
                else 
                {
                    $cargagandola=new Cargagandola;
                    $pesaje=$request->carga-$request->tara;
                    $cargagandola->peso_neto = $pesaje;
                    $cargagandola->id_gandola = $idgandola;
                    $cargagandola->finale = "no";
                    $cargagandola->save();
                    $sqlcargagandola = "SELECT * FROM cargagandola WHERE finale='no'"; 
                    $cargagandola=DB::select($sqlcargagandola);
                      foreach ($cargagandola as $cargagandolas) {
       $idcarga=$cargagandolas->id;
       }
                    
                    
                    $control= new Control;
                    $control->id_cargagandola = $idcarga;
                    $control->ubicacion = 'Monagas';
                    $control->save();
      
            
            $carbon = new \Carbon\Carbon();
            $fecha = $carbon->now();
            $fecha=$fecha->format('Y-m-d');
            $carga->fecha = $fecha;
            $carga->cargagandola_id = $idcarga;
             if($carga->save()){
                   if($request->precio=='contado')
                 {
                return back()->with('msj', 'Carga del Productor: '.$productornombre.' Guardada con Exito')->with('peso',$request->tara)->with('carga',$request->carga)->with('precio',$preciocontado)->with('nombre',$productornombre)->with('cedula',$productorrif)->with('placa',$placa)->with('idgandola','1')->with('idcarga',$idcarga)->with('placagandola',$placagandola)->with('gandolapeso', $gandolapeso)->with('pesoneto',$pesaje);
                   }
                 else if($request->precio=='credito')
                 {
                      return back()->with('msj', 'Carga del Productor: '.$productornombre.' Guardada con Exito')->with('peso',$request->tara)->with('carga',$request->carga)->with('precio',$preciocredito)->with('nombre',$productornombre)->with('cedula',$productorrif)->with('placa',$placa)->with('idgandola','1')->with('idcarga',$idcarga)->with('placagandola',$placagandola)->with('gandolapeso', $gandolapeso)->with('pesoneto',$pesaje);
                 }
            }
                }
          
               }
               else 
               {
                return back()->with('msj3', 'La Placa '.$placagandola.' de la gandola NO EXISTE'); 
               }
           }
                else
                {
                    if ($idproductor==0)
                    {
                        
                         if ($idcamion==0) 
                         {
                         return back()->with('msj3', 'La Placa '.$request->placa.' del Vehiculo NO EXISTE y el RIF '.$request->letra."".$request->rif." NO EXISTE");
                        }
                        else
                        { 
                            if($idgandola==0)
                        {
                           return back()->with('msj3', 'La Placa '.$placagandola.' de la gandola NO EXISTE'); 
                        }
                            else 
                            {
                               return back()->with('msj3', 'El RIF '.$request->letra."".$request->rif.' NO EXISTE'); 
                            }
                             
                        } 
                    }
                    else 
                    {
                         if($idgandola==0)
                        {
                           return back()->with('msj3', 'La Placa '.$placagandola.' de la gandola NO EXISTE'); 
                        }
                        else
                        {
                         return back()->with('msj3', 'La Placa '.$request->placa.' del Vehiculo NO EXISTE');    
                        }
                        
                        
                    }
                }
                 
               return redirect ('/pagregar');
        }
    }
    public function pdfcarga(Request $request)
    {
         $fecha=date_create($request->entrada);
        $fecha=$fecha->format('d-m-Y');
        $entrada=date_create($request->entrada);
        $entrada=$entrada->format('G:i:s');
        $carbon = new \Carbon\Carbon();
        $salida = $carbon->now();
        $salida=$salida->format('G:i:s');
        
        $pdf= PDF::loadView('imprimircarga',['cedula'=>$request->cedula, 'cod'=>$request->cod, 'chofer'=>$request->chofer, 'peso'=>$request->peso, 'carga'=>$request->carga,'precio'=>$request->precio,'preciocontado'=>$request->preciocontado,'preciocredito'=>$request->preciocredito, 'rif'=>$request->rif,'nombre'=>$request->nombre,'fecha'=>$fecha,'placa'=>$request->placa, 'descuento'=>$request->descuento, 'entrada'=>$entrada, 'salida'=>$salida, 'id'=>$request->id, 'modelo'=>$request->marca." ".$request->modelo.", Año ".$request->ano]);
        $paper_size = array(0,0,200,380);
        $pdf->setPaper($paper_size);
        return $pdf->stream('Nota de Entrega '.$request->nombre.' '.$fecha.' .pdf');
    }
    public function pdfrecibo(Request $request) 
    {
        $sql = "SELECT * FROM productor WHERE rif='".$request->nombre."' OR cedula='".$request->nombre."'";  
        $sql2 = "SELECT * FROM banco INNER JOIN productor
        ON  banco.productor_id = productor.id WHERE rif='".$request->nombre."' OR cedula='".$request->nombre."'";  
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
            $productorcod=$productores->cod;
        }
        
        $sqlcarga = "SELECT P.id, P.precio, B.preciocontado, B.preciocredito, carga, peso, pago, descripcion, fecha, camion_id, productor_id, precio_id, descuento FROM pesaje P INNER JOIN precio B 
        ON P.precio_id = B.id
        WHERE productor_id='".$productorid."' AND  pago='NO'";
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $fecha=$fecha->format('d-m-Y');
        $pesaje=DB::select($sqlcarga);
        $total=0;
        $totaltoneladas=0;
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
           $totaltoneladas=$totaltoneladas + truncateFloatNumber(($pesajes->carga-$pesajes->peso-$pesajes->descuento), 2);
               
            }
    $pdf= PDF::loadView('imprimir',['productornombre'=>$productornombre, 'productorid'=>$productorid, 'pesaje'=>$pesaje, 'productorcedula'=>$productorcedula, 'productorrif'=>$productorrif, 'banco'=>$banco, 'productorfinca'=>$productorfinca,'total'=>$total,'productorcorreo'=>$productorcorreo,  'msj'=>'El productor: '.$productornombre." no tiene recibos por cobrar",'productordir'=>$productordir,'productor'=>$productor,'fecha'=>$fecha, 'totalt'=>$totaltoneladas, 'cod'=>$productorcod]);
        $paper_size = array(0,0,200,470);
        $pdf->setPaper($paper_size);
    return $pdf->stream('Recibo Total '.$productornombre.' '.$fecha.'.pdf');
    }
      public function updatecarga($id) 
     {
    $cargagandola=Cargagandola::findOrFail($id);
    $cargagandola->finale = 'si';
    $cargagandola->save();
    return redirect('/pagregar');  
     }
}
