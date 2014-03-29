<?php 
require_once("../../../class/log/model.php");
require_once("../../../class/tipoBeca/model.php");
$tipoBeca = new TipoBeca();
//$log = new Log();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$action = $_POST['action'];

	@$tip_id = $_POST['id'];
    @$tip_nombre = $_POST['nombre'];
    @$tip_descripcion= $_POST['descripcion'];
    
	

	$array_data_tipo_beca = array(
    'tip_id' => addslashes($tip_id),
    'tip_nombre' => addslashes($tip_nombre),
    'tip_descripcion' => addslashes($tip_descripcion)
    
	);

	switch($action){
		case 'crear':

			$tipoBeca->set($array_data_tipo_beca);
			$json = json_encode($tipoBeca);
			echo $json;

		break;

		case 'eliminar':
			$tipoBeca->delete(intval($tip_id));
			$json = json_encode($tipoBeca);
			echo $json;
					
	    break;

		case 'actualizar':

			$tipoBeca->edit($array_data_tipo_beca);
			$json = json_encode($tipoBeca);
			echo $json;

		break;

		case 'get':

		
		$tipoBeca->get(intval($tip_id));
		echo $tipoBeca->to_json();

		break;

		case 'validar':

			$validar = $tipoBeca->validar_tiempo_real($tip_nombre);
			if($validar){

				$json = json_encode($tipoBeca);
				echo $json;
				
			}
		break;

		case 'mostrar':
			$row = $tipoBeca->mostrar();
			$json = json_encode($row);
			echo $json;
		break;




	}
}


 ?>