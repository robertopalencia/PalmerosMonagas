<?php 

function truncateFloat ($number, $digitos)
    
{
    $raiz=10;
    $multiplicador = pow($raiz, $digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return number_format($resultado, $digitos, ",",".");
}

function truncateFloatNumber ($number, $digitos)
    
{
    $raiz=10;
    $multiplicador = pow($raiz, $digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    return $resultado;
}
function total ($carga, $peso, $descuento, $digitos)
    
{
    $raiz=10;
    $multiplicador = pow($raiz, $digitos);
    $resultadocarga = ((int)($carga * $multiplicador)) / $multiplicador;
    $resultadopeso = round($peso, 2);
    $resultadodescuento = round($descuento, 2);
    $resultado=$resultadocarga+$resultadodescuento+$resultadopeso;
     return number_format($resultado, $digitos, ",",".");
}

function totalPrecio ($carga, $precio, $digitos)
    
{
    $raiz=10;
    $multiplicador = pow($raiz, $digitos);
    $resultado = ((int)($carga * $multiplicador)) / $multiplicador;
    $precio=$resultado*$precio;
    return number_format($precio, $digitos, ",",".");
}