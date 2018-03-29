


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
   <div align="right">{{$fecha}}</div>
    

    <div>
        <div align="justify"><h1><strong>INFORME DE NOTAS DE ENTREGA POR PAGAR</strong></h1></div>
    <div>
      <br>
       
   
      
        <table width="100%" border="1" align="center"  bordercolor="#000000">
            <thead align="center">
                <tr>
                <th>Nº</th>
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
                <tr>
                  <td class="table-text"><div align="center"> {{$var->pid}} </div></td>
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
                     <td class="table-text"><div> {{$var->banco}} </div></td>
                      <td class="table-text"><div> {{$var->tipocuenta}} </div></td>
                    <td class="table-text"><div> {{$var->cuenta}} </div></td>
                   
                    <td class="table-text"><div>{{neto($var->pcarga,$var->ppeso,$var->pdescuento,2)}}</div></td>
                   
                    <td class="table-text"><div> 
                    @if($var->precio==0)
                    {{totalPrecio(($var->pcarga-$var->ppeso-$var->pdescuento), $var->preciocontado,2)}}
                    @else
                    {{totalPrecio(($var->pcarga-$var->ppeso-$var->pdescuento), $var->preciocredito,2)}}
                    @endif  
                    
                    </div></td>
                   
                     
                </tr>
                
                @endforeach
               
                <tr><td class="table-text"><div></div></td>
                    <td class="table-text"><div></div></td>
                    <td class="table-text"><div></div></td>
                    <td class="table-text"><div></div></td>
                    <td class="table-text"><div></div></td>
                    <td class="table-text"colspan="2"><div align="center"><h4><strong>Monto Total</strong></h4> </div></td>
                    
                    <td class="table-text" ><div><h4><strong>{{number_format($total, 2, ",",".")}}</strong></h4>
                    
                    </tr>
            </tbody>
        </table>
        
       
        
    </div>
    </div>
   
</div>



   
</body>
</html>





 


