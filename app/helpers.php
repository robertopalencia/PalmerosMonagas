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