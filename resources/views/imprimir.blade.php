
<html lang="es">


<head>
    <meta charset="UTF-8">
    <link href="css/pdf.css" rel="stylesheet">
    <h1><strong>ASOCIACION COOPERATIVA AGROPECUARIA BEJUMA RL</strong></h1>
                RIF: J-31664833-8
    <div align="right">{{$fecha}}</div>
    <div align="left">
     
       <strong>{{$productorfinca}}</strong> <br>
       <strong>RIF:</strong>{{$productorrif}} <br>
       <strong>Dirección: </strong>{{$productordir}} <br>
       <strong>Representante:</strong> <br>
       <strong>{{$productornombre}}</strong> <br>
       <strong>C.I.:</strong>{{$productorcedula}} <br>
       <strong>Email: </strong>{{$productorcorreo}} <br>
       </div>
    <title>RECIBO</title>
</head>
<body>
   
     <br>
     <h1><strong>Recibo</strong></h1>
      <table width="100%" border="1" align="center"  bordercolor="#000000">
            <thead>
               <tr>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Descripcion</th>
                <th>Monto Bs.F</th>
                </tr>
                
            </thead>
            <tbody> 
                @foreach($pesaje as $pesajes)

               
                <tr>
                   <?php $fecha2=date_create($pesajes->fecha); ?>
                    <td> {{date_format($fecha2, 'd-m-Y')}} </td>
                    <td > {{number_format(($pesajes->carga-$pesajes->peso-$pesajes->descuento)/1000, 2,",",".")}} <strong>T</strong> </td>
                    <td >{{$pesajes->descripcion}}</td>
                    <td >{{number_format((($pesajes->carga-$pesajes->peso-$pesajes->descuento)/1000)*$pesajes->precio, 2, ",",".")}}</td>
                   
                </tr>
                
                @endforeach
               
                <tr>
                 <td border="0"></td>
                    <td border="0"></td>
                    
                    <td align="right"><h3><strong>Monto Total</strong> </h3></td>
                    <td><h3><strong> {{number_format($total, 2, ",",".")}} Bs.F</strong></h3></td>
                   
                    </tr>
            </tbody>
        </table>
        <br>
        
       

    <p align="justify">Recibí de Asociación Cooperativa Agropecuaria Bejuma RL <strong></strong> la cantidad de {{number_format($total, 2, ",",".")}} Bs.F por concepto de: <strong>Pago de {{number_format($totalt, 2, ",",".")}} Toneladas de Fruta fresca de palma aceitera</strong></p>
       
       <br><br>
        <STRONG>Recibí Conforme:____________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entregue Conforme:___________________</STRONG>
        <br><br>
        <STRONG>             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CI:____________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CI:____________________</STRONG>
</body>
</html>
      
       
      
        