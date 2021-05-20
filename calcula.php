<?php

function somatorio($num) {
    // $soma = 0;
    
    // while($num > 0) {
    //   $soma += $num--;
    // }
    
    // return $soma;

    return ($num + 1) * $num / 2;
}

function vagabundo($dia, $mes, $ano) {
    return somatorio($mes) + ($ano / 100) * (50 - $dia);
}

function anjo($vagabundo) {
    return 100 - $vagabundo;
}

$t = strtotime($_POST['nascimento']); // Converte a entrada (texto) em uma data válida para o PHP
// echo date('d/m/Y', $t); // Exemplo de como exibir uma data no padrão brasileiro
$dia = date('d', $t); // Extrai o dia da data informada
$mes = date('m', $t); // Extrai o mês da data informada (em formato numérico) 
$ano = date('y', $t); // Extrai o ano da data informada (em formato de dois dígitos, ou seja 2019 seria apenas 19) 
$vagabundo = vagabundo($dia, $mes, $ano); // Calcula o % de vagabundo, usando a função vagabundo
$anjo = anjo($vagabundo); // Calcula o % de anjo, usando a função anjo

include("./resultado.html");