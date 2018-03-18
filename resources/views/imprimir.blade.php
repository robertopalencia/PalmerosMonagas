
<html lang="es">


<head>
    <meta charset="UTF-8">
    <link href="css/pdf.css" rel="stylesheet">
    <div align="center"><font size=1><strong>Asoc. Coop. Agrop. Bejuma RL</strong></font>
   <font size=1> RIF: J-31664833-8</font> <br>
   <font size=1> C4 N19 Maturin Estado Monagas</font> <br>
   <font size=1> Tlfs: 0291-6440585 0416-9894225 </font><br>
   <font size=1> Aliados de ACEITES C.A. RIF: J-31664833-8</font><br>
    <font size=1>Colon Estado Zulia</font><br></div>
    <div align="right"><font size=1>{{$fecha}}</font></div>
    <div align="left">
     
        <font size=1><strong>Productor: {{$productorfinca}}</strong></font> <br>
        <font size=1><strong>RIF:</strong>{{$productorrif}} </font><br>
        <font size=1><strong>Codigo Productor:</strong>{{$cod}}</font> <br>
        <font size=1><strong>Representante: {{$productornombre}}</strong></font> <br>
        <font size=1><strong>C.I.:</strong>{{$productorcedula}}</font> <br>
        <font size=1><strong>Email: </strong>{{$productorcorreo}}</font>
       </div>
    <title><strong>RECIBO </strong></title>
</head>
<body>
   
     <br>
     <div><font size=2><<strong> Recibo</strong></font></div>
      <table width="100%" border="1" align="center"  bordercolor="#000000">
            <thead>
               <tr>
                <th><font size=1>Fecha</font></th>
                <th><font size=1>Nota Entrega</font></th>
                <th><font size=1>Monto Bs.F</font></th>
                </tr>
                
            </thead>
            <tbody> 
                @foreach($pesaje as $pesajes)

               
                <tr>
                   <?php $fecha2=date_create($pesajes->fecha); ?>
                    <td align="center"> <font size=1>{{date_format($fecha2, 'd-m-Y')}}</font> </td>
                    <td align="center"> <font size=1>{{$pesajes->id}} <strong></font></strong> </td>
                    <td align="center"><font size=1>{{totalPrecio((($pesajes->carga-$pesajes->peso-$pesajes->descuento)/1000),$pesajes->precio, 2)}}</font></td>
                   
                </tr>
                
                @endforeach
               
                <tr>
                 <td border="0"></td>
                    <td align="center"><h3><font size=1><strong>Monto Total</strong></font> </h3></td>
                    <td align="center"><h3><strong><font size=1> {{number_format($total, 2, ",",".")}} Bs.F</font></strong></h3></td>
                   
                    </tr>
            </tbody>
    </table>   
<font size=1>
    <p align="justify">Recibí de Asociación Cooperativa Agropecuaria Bejuma RL <strong></strong> la cantidad de {{number_format($total, 2, ",",".")}} Bs.F por concepto de: <strong>Pago de {{number_format($totalt, 2, ",",".")}} Toneladas de Fruta fresca de palma aceitera</strong></p></font>
       
       <br><br>
        <font size=1><strong>Recibí Conforme:____________________ <br> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C.I: ____________________ </strong></font>
</body>
</html>
      
       
      
        