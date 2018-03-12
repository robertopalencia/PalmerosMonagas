

<html lang="es">
<head>
   
    <meta charset="UTF-8">
    <link href="css/pdfinformes.css" rel="stylesheet">
    <h1><strong>ASOCIACION COOPERATIVA AGROPECUARIA BEJUMA RL</strong></h1>
    RIF: J-31664833-8
    <title>Documentos</title>
</head>
<body>
   <div>
    
    <br>
   <div align="right">{{date_format($fecha,"d/m/Y")}}</div>
    

    <div>
        <div align="center"><h1><strong>INFORME DE RECIBOS PAGADOS</strong></h1></div>
    <div>
      <br>
       
   
      
        <table width="100%" border="1" align="center"  bordercolor="#000000">
            <thead align="center">
                <tr>
                <th>Nombre</th>
                <th>C.I. o RIF</th>
                <th>Banco</th>
                <th>Tipo</th>
                <th>Cuenta Bancaria</th>
                <th>Carga</th>
                <th>Monto</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($productor as $var)
                 <?php
                if($precio!=$var->precio){
                    $precio=$var->precio;
                    $cedula=0;
                }?>
               @if($cedula!=$var->cedula)
               <?php $cedula=$var->cedula;
               
                ?>
               
                <tr>
                   
                    @if($var->tipo=='Juridico')
                    <td class="table-text"><div> {{$var->finca}} </div></td>
                    @else
                    <td class="table-text"><div> {{$var->nombre}} </div></td>
                    @endif
                    @if($var->tipo=='Juridico')
                    <td class="table-text"><div> {{$var->rif}} </div></td>
                    @else
                    <td class="table-text"><div> {{$var->cedula}} </div></td>
                    @endif
                    <td><div> {{$var->banco}} </div></td>
                    <td><div> {{$var->tipocuenta}} </div></td>
                    <td><div> {{$var->cuenta}} </div></td>
                    <td><div> {{number_format(($var->pcarga-$var->ppeso-$var->pdescuento)/1000, 2,",",".")}} </div></td>
                    <td><div> {{number_format((($var->pcarga-$var->ppeso-$var->pdescuento)/1000)*$var->precio, 2, ",",".")}} </div></td>
                   
                     
                </tr>
                @endif
                @endforeach
               
                <tr>
                 <td><div></div></td>
                    <td><div> </div></td>
                    <td><div> </div></td>
                    <td><div> </div></td>
                    <td class="2"><div align="right"><h2><strong>Monto</strong></h2>  </div></td>
                    <td class="3"><div><h2><strong>Total</strong> </h2></div></td>
                    <td><div><h4><strong>  {{number_format($total, 2, ",",".")}}</strong></h4></div></td>
                
                    </tr>
            </tbody>
        </table>
        
       
        
    </div>
    </div>
   
</div>



   
</body>
</html>