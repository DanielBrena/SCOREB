<?php 
require_once("../../../class/configuracion/model.php");
$configuracion = new Configuracion();

	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		@$action = $_POST['action'];
		@$id = intval($_POST['id']);
		@$valor = intval($_POST['valor']);

		switch ($action) {
			case 'actualizarPorcentaje':
				$configuracion->editarID($id,$valor);
				$json = json_encode($configuracion);
				echo $json;

				break;
			
			default:
				# code...
				break;
		}

	}


?>