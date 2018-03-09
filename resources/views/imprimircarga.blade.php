  
 <html lang="es">
<head>
   
    <meta charset="UTF-8">
    <link href="css/pdf.css" rel="stylesheet">
   <div align="center">
  <font size=1><strong>Asoc. Coop. Agrop. Bejuma RL</strong></font><br>
   <font size=1> RIF: J-31664833-8</font>
    </div>
    <title>Documentos</title>
</head>
<body>
   <div>
   
   <div align="left"><font size=1><strogn>Fecha:</strogn> {{$fecha}} </font> </div>
   <font size=1>HE {{$entrada}}</font>
   <font size=1>HS {{$salida}}</font><br>
    

    <div>
        <div align="left"><font size=1><strong>Orden de Entrega Nº {{$id}} </strong></font></div>
   
 
  <font size=1>Placas: <strong>{{$placa}}</strong></font><br>
  <font size=1>RIF Productor: <strong>{{$cedula}}</strong></font><br>
  <font size=1>Productor: <strong>{{$nombre}}</strong></font><br>
  <font size=1>Peso Bruto: <strong>{{number_format($carga/1000, 3,",",".")}} T</strong></font><br>
  <font size=1>Descuento: <strong>{{number_format(($descuento)/1000,3,",",".")}} T</strong> </font><br>
  <font size=1>Peso Neto: <strong>{{number_format(($carga-$peso-$descuento)/1000,3,",",".")}} T</strong>  </font>  <br>
  <font size=1>TARA: <strong>{{number_format($peso/1000,3,",",".")}} T</strong> </font><br>
  <font size=1>Precio: <strong>{{$precio}} BsF</strong>  </font><br>
     <font size=1><strong>TOTAL:  {{number_format((($carga-$peso-$descuento)/1000)*$precio,2,",",".")}} BsF.</strong></font><br>
        
    
        
       
        
    </div>
    </div>
   
</div>



   
</body>
</html>


