  
 <html lang="es">
<head>
   
    <meta charset="UTF-8">
    <link href="css/pdf.css" rel="stylesheet">
   <div align="center">
  <font size=1><strong>Asoc. Coop. Agrop. Bejuma RL</strong></font>
   <font size=1> RIF: J-31664833-8</font> <br>
   <font size=1> C4 N19 Maturin Estado Monagas</font> <br>
   <font size=1> Tlfs: 0291-6440585 0416-9894225 </font><br>
   <font size=1> Aliados de ACEITES C.A. RIF: J-31664833-8</font><br>
    <font size=1>Colon Estado Zulia</font><br>
    </div>
    <title>Documentos</title>
</head>
<body>
   <div>
   
   <div align="left"><font size=1> {{$fecha}} </font> </div>
   <font size=1>HE {{$entrada}}</font>
   <font size=1>HS {{$salida}}</font><br>
    

    <div>
        <div align="center"><font size=1><strong>Nota de Entrega Nº {{$id}} </strong></font></div>
   
 
 <font size=1>Cod Productor: <strong>{{$cod}}</strong></font><br>
  <font size=1>RIF Productor: <strong>{{$rif}}</strong></font><br>
  <font size=1>Productor: <strong>{{$nombre}}</strong></font><br>
   <font size=1>Placas: <strong>{{$placa}}</strong></font><br>
   <font size=1>Conductor: <strong>{{$chofer}}</strong></font><br>
   <font size=1>C.I. Conductor <strong>{{$cedula}}</strong></font><br>
   <font size=1>TARA: <strong>{{number_format($peso/1000,3,",",".")}} T</strong> </font><br>
  <font size=1>Peso Bruto: <strong>{{number_format($carga/1000, 3,",",".")}} T</strong></font><br>
  <font size=1>Descuento: <strong>{{number_format(($descuento)/1000,3,",",".")}} T</strong> </font><br>
  <font size=2>Peso Neto: <strong>{{number_format(($carga-$peso-$descuento)/1000,3,",",".")}} T</strong>  </font>  <br>
  
  <font size=2>Precio P/T: <strong>{{$precio}} BsF</strong>  </font><br>
     <font size=2><strong>TOTAL:  {{number_format((($carga-$peso-$descuento)/1000)*$precio,2,",",".")}} BsF.</strong></font><br> <br> <br>
       <font size=2>Firma:_____________________________</font>
       <br> <br>
       <?php $fecha=date_create($fecha); ?>
       <div align="left"><font size=1> Venta de tonelada de RFF Semana {{date_format($fecha, 'W')}} del {{date_format($fecha, 'Y')}} </font> </div>
    </div>
    </div>
</div>
</body>
</html>


