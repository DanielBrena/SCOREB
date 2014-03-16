<?php 

$persona = new stdClass();
$persona->Para = $_GET['nombre'];
$persona->Mensaje =  $_GET["mensaje"];
$ajax = json_encode($persona);
echo $ajax;

 ?>