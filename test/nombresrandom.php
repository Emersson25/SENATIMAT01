<?php

$rutaDestino = '../views/img/fotografias/';
$horaActual = date('c');
$nombreArchivo = sha1($horaActual) . ".jpg";
$rutaDestino .= $nombreArchivo;

var_dump($rutaDestino);