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

class PdfController extends Controller
{
    public function pdfinforme()   
    {
       $sql = "
            SELECT COUNT(C.id) AS cp, C.tipo, SUM(P.carga) AS pcarga, SUM(P.peso) AS ppeso, SUM(P.descuento) AS pdescuento, R.nombre, R.finca, R.cedula, R.rif, C.cuenta, C.tipocuenta, C.banco, P.pago, B.precio, P.peso, P.carga 
            FROM pesaje P 
            INNER JOIN precio B 
            ON P.precio_id = B.id 
            INNER JOIN productor R 
            ON P.productor_id = R.id 
            INNER JOIN banco C 
            ON R.id = C.productor_id 
            WHERE P.pago = 'NO' 
            GROUP BY C.id, B.precio 
            ORDER BY B.precio ASC";  
            
        $sqltotal="
                SELECT sum(peso) as peso, sum(carga) as carga, sum(descuento) as descuento, precio 
                FROM pesaje 
                INNER JOIN precio 
                ON pesaje.precio_id=precio.id 
                WHERE pago='NO' 
                GROUP BY precio.id";
        
        $totales=DB::select($sqltotal);
                
        $total=0;
                
        foreach($totales as $var)
        {
            $total=((($var->carga-$var->peso-$var->descuento)/1000)*$var->precio)+$total;
        }
        
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $fecha=$fecha->format('d/m/Y');
        $productor=DB::select($sql);
        $pdf= PDF::loadView('imprimirinforme',['productor'=>$productor, 'total'=>$total,'cedula'=>'0','precio'=>'0','fecha'=>$fecha]);
        return $pdf->download('INFORME DE RECIBOS NO PAGADOS '.$fecha.'.pdf'); 
    }
    
    public function pdfinformepagos(Request $request)
    {
         $sql = "
                SELECT COUNT(C.id) AS cp, C.tipo, SUM(P.carga) AS pcarga, SUM(P.peso) AS ppeso, SUM(P.descuento) AS pdescuento, R.nombre, R.finca, R.cedula, R.rif, C.cuenta, C.tipocuenta, C.banco, P.pago, B.precio, P.peso, P.carga 
                FROM pesaje P 
                INNER JOIN precio B 
                ON P.precio_id = B.id 
                INNER JOIN productor R 
                ON P.productor_id = R.id 
                INNER JOIN banco C 
                ON R.id = C.productor_id 
                WHERE P.pago = 'SI' 
                AND fecha='".$request->fecha."' 
                GROUP BY C.id, B.precio 
                ORDER BY B.precio ASC";  
            
            $sqltotal="
                        SELECT sum(peso) as peso, sum(carga) as carga, sum(descuento) as descuento, precio 
                        FROM pesaje 
                        INNER JOIN precio 
                        ON pesaje.precio_id=precio.id 
                        WHERE pago='SI' 
                        AND fecha='".$request->fecha."' 
                        GROUP BY precio.id";
        
            $totales=DB::select($sqltotal);
            $total=0;
            
            foreach($totales as $var)
            {
                    $total=((($var->carga-$var->peso-$var->descuento)/1000)*$var->precio)+$total;
            }
        
            $productor=DB::select($sql);
        
            $fecha=date_create("$request->fecha");
    
            $productor=DB::select($sql);
        
            $pdf= PDF::loadView('imprimirinformepago',['productor'=>$productor, 'total'=>$total,'cedula'=>'0','precio'=>'0','fecha'=>$fecha]);
            
            return $pdf->download('INFORME DE RECIBOS PAGADOS '.date_format($fecha, "d-m-Y").'.pdf');
    }
    
    public function pdfid( Request $request)
    {
         $sql = "
                SELECT * 
                FROM productor 
                WHERE cedula='".$request->cedula."'";  
            
        $sql2 = "
                SELECT * 
                FROM banco INNER JOIN productor
                ON  banco.productor_id = productor.id 
                WHERE cedula='".$request->cedula."'";  
        
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
        
        $sqlcarga = "
                    SELECT P.id, B.precio, carga, peso, pago, descripcion, fecha, camion_id, productor_id, precio_id, descuento 
                    FROM pesaje P INNER JOIN precio B 
                    ON P.precio_id = B.id
                    WHERE productor_id='".$productorid."' AND  P.id='".$request->id."'";
        
        $carbon = new \Carbon\Carbon();
        $fecha = $carbon->now();
        $fecha=$fecha->format('d-m-Y');
                
        $pesaje=DB::select($sqlcarga);
        $total=0;
        $totaltoneladas=0;           
        foreach($pesaje as $pesajes)
        {    
            $total=$total + ((($pesajes->carga-$pesajes->peso-$pesajes->descuento)/1000)*$pesajes->precio);
            $fecha2=$pesajes->fecha;
            $fecha2=date_create($fecha2);
            $totaltoneladas=$totaltoneladas + (($pesajes->carga-$pesajes->peso-$pesajes->descuento)/1000);
        }
        
    $pdf= PDF::loadView('imprimir',['productornombre'=>$productornombre, 'pesaje'=>$pesaje, 'productorcedula'=>$productorcedula, 'productorrif'=>$productorrif, 'banco'=>$banco, 'productorfinca'=>$productorfinca,'total'=>$total,'productorcorreo'=>$productorcorreo,  'msj'=>'El productor: '.$productornombre." no tiene recibos por cobrar",'productordir'=>$productordir,'productor'=>$productor,'fecha'=>$fecha, 'totalt'=>$totaltoneladas]);
    
    return $pdf->download('Recibo '.$productornombre.' '.date_format($fecha2,'d-m-Y').'.pdf');
        
    }
     
}
