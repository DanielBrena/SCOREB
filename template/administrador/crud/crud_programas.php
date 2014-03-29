<?php 
require_once("../../../class/programa/model.php");
$programa = new Programa();
//$log = new Log();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$action = $_POST['action'];

	@$pro_id = $_POST['id'];
    @$pro_nombre = $_POST['nombre'];
    @$pro_descripcion= $_POST['descripcion'];
    
	

	$array_data_programa = array(
    'pro_id' => addslashes($pro_id),
    'pro_nombre' => addslashes($pro_nombre),
    'pro_descripcion' => addslashes($pro_descripcion)
    
	);

	switch($action){
		case 'crear':

			$programa->set($array_data_programa);
			$json = json_encode($programa);
			echo $json;

		break;

		case 'eliminar':
			$programa->delete(intval($pro_id));
			$json = json_encode($programa);
			echo $json;
					
	    break;

		case 'actualizar':

			$programa->edit($array_data_programa);
			$json = json_encode($programa);
			echo $json;

		break;

		case 'get':

		
		$programa->get(intval($pro_id));
		echo $programa->to_json();

		break;

		case 'validar':

			$validar = $programa->validar_tiempo_real($pro_nombre);
			if($validar){

				$json = json_encode($programa);
				echo $json;
				
			}
		break;

		case 'mostrar':
			$row = $programa->mostrar();
			$json = json_encode($row);
			echo $json;
		break;




	}
}


 ?>