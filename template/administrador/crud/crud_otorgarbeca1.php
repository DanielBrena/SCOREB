<?php 
require_once("../../../class/vistas/model.php");

$vista = new VistaBecaNueva();

if($_SERVER["REQUEST_METHOD"] == 'POST'){

	@$action = $_POST['action'];
	@$valor = $_POST['valor'];
	@$id = $_POST['id'];

	;

	switch($action){

		case 'actualizar':
		$vista->actualizar($valor,$bec);
		$json = json_encode($vista);
		echo $json;
		break;
	}
}

 ?>