<?php

namespace Palma\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Palma\Camion;
use Palma\Productor;
use Palma\Precio;
use Palma\Pesaje;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;
class PesajeController extends Controller
{
    
    public function vistaagregar()
    {
        return view ('pagregar');    
    }
    
    public function agregarcarga (Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'carga'=>'required |max:2000000|numeric',
                'descripcion'=>'required |max:70',
                'cedula'=>'required |min:100000|max:200000000|numeric',
                'placa'=>'required |min:6|max:9',
                
            ]);
                if($validator->fails())
                {
                      return redirect('/pagregar')
                     ->withInput()
                     ->withErrors($validator);
                }
                $camion = Camion::all();
                $productor = Productor::all();
                $precio = Precio::all();
                foreach ($precio as $precios){
                     $precios2=0;
                    if($precios->id>=$precios2) {
                        $precios2=$precios->id;
                        $precio3=$precios->precio;
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
                    
                     
                    if ($request->cedula==$productores->cedula){
                        $idproductor=$productores->id;
                        $productornombre=$productores->nombre;
                        $productorcedula=$productores->cedula;
                    }
                    
                }
           if ($idproductor!=0&&$idcamion!=0)
           {
            $carga=new Pesaje;
            $carga->carga = $request ->carga;
            $carga->descripcion = $request ->descripcion;
            $carga->peso=$pesocamion;
            $carga->pago="NO";
            $carga->camion_id = $idcamion;
            $carga->productor_id = $idproductor;
            $carga->precio_id = $precios2;
            
            
            $carbon = new \Carbon\Carbon();
            $fecha = $carbon->now();
            $fecha=$fecha->format('Y-m-d');
            $carga->fecha = $fecha ; 
             if($carga->save()){
                return back()->with('msj', 'Carga del Productor: '.$productornombre.' Guardada con Exito')->with('peso',$pesocamion)->with('carga',$request->carga)->with('precio',$precio3)->with('nombre',$productornombre)->with('cedula',$productorcedula)->with('placa',$placa);
            }
               }
                else
                {
                    if ($idproductor==0)
                    {
                        
                         if ($idcamion==0) 
                         {
                         return back()->with('msj3', 'La Placa '.$request->placa.' del Vehiculo NO EXISTE y la Cedula de Identidad '.$request->cedula." NO EXISTE");
                        }
                        else
                        {
                             return back()->with('msj2', 'La Cedula de Identidad '.$request->cedula.' NO EXISTE');
                        }
                    }
                    else 
                    {
                         return back()->with('msj3', 'La Placa '.$request->placa.' del Vehiculo NO EXISTE');
                        
                    }
                }
                 
               return redirect ('/pagregar');
            
    }
    public function pdfcarga(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $fecha=$fecha->format('d-m-Y');
            
        $pdf= PDF::loadView('imprimircarga',['peso'=>$request->peso, 'carga'=>$request->carga,'precio'=>$request->precio,'cedula'=>$request->cedula,'nombre'=>$request->nombre,'fecha'=>$fecha,'placa'=>$request->placa]);
        
        return $pdf->download('Nota de Entrega '.$request->nombre.' '.$fecha.' .pdf');
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
            foreach($productor as $productores){
            $productorid=$productores->id;
            $productornombre=$productores->nombre;
            $productorcedula=$productores->cedula;
                 $productorrif=$productores->rif;
                $productorfinca=$productores->finca;
               $productorcorreo=$productores->correo;
                 $productordir=$productores->direccion;
            }
        $sqlcarga = "SELECT P.id, B.precio, carga, peso, pago, descripcion, fecha, camion_id, productor_id, precio_id FROM pesaje P INNER JOIN precio B 
        ON P.precio_id = B.id
        WHERE productor_id='".$productorid."' AND  pago='NO'";
      $carbon = new \Carbon\Carbon();
            $fecha = $carbon->now();
            $fecha=$fecha->format('d-m-Y');
                
                $pesaje=DB::select($sqlcarga);
                $total=0;
               foreach($pesaje as $pesajes){
            $total=$total + ((($pesajes->carga-$pesajes->peso)/1000)*$pesajes->precio);
           
               
            }
    $pdf= PDF::loadView('imprimir',['productornombre'=>$productornombre, 'pesaje'=>$pesaje, 'productorcedula'=>$productorcedula, 'productorrif'=>$productorrif, 'banco'=>$banco, 'productorfinca'=>$productorfinca,'total'=>$total,'productorcorreo'=>$productorcorreo,  'msj'=>'El productor: '.$productornombre." no tiene recibos por cobrar",'productordir'=>$productordir,'productor'=>$productor,'fecha'=>$fecha]);
    return $pdf->download('Recibo Total '.$productornombre.' '.$fecha.'.pdf');
    }
}
