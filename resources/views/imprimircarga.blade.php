  <br>
  <br>

 <br>
  <br>
 <br>
 <html lang="es">
<head>
   
    <meta charset="UTF-8">
    <link href="css/pdf.css" rel="stylesheet">
   <h1><strong>ASOCIACION COOPERATIVA AGROPECUARIA BEJUMA RL</strong></h1>
    RIF: J-31664833-8
    <title>Documentos</title>
</head>
<body>
   <div>
    
    <br>
   <div align="right">{{$fecha}}</div>
    

    <div>
        <div align="center"><h1><strong>NOTA DE ENTREGA</strong></h1></div>
   
      <br>
    
   <p align="justify"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hacemos constar que: <strong>{{$nombre}}</strong> RIF: <strong>{{$cedula}},</strong> ha hecho entrega de una carga con un <strong>peso bruto de {{number_format($carga/1000, 2,",",".")}}</strong> Toneladas, a la cual se le realiza un <strong>descuento de {{number_format($descuento, 0,",",".")}} Kg</strong> de racimos por estar por debajo de la calidad aceptada y un peso neto de <strong>{{number_format(($carga-$peso-$descuento)/1000,2,",",".")}}</strong> Toneladas, debido a que el Vehiculo Placas <strong>{{$placa}}</strong> tiene una TARA de <strong>{{number_format($peso/1000,2,",",".")}}</strong> Toneladas. El precio suscrito para esta transaccion por toneladas, fue de <strong>{{$precio}} BsF</strong>; estableciendo como <strong>MONTO TOTAL  {{number_format((($carga-$peso-$descuento)/1000)*$precio,2,",",".")}} BsF.</strong>
      </p>  
        <br><br><br><br>
    <p align="center">_________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______________</p> 
    <p align="center">Entregue Conforme&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recibi Conforme</p>  
        
       
        
    </div>
    </div>
   
</div>



   
</body>
</html>


