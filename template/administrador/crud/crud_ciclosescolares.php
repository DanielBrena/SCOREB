<?php 
require_once("../../../class/ciclo/model.php");
$cicloescolar = new CicloEscolar();


if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	@$action = $_POST['action'];
	@$cic_id = $_POST['id'];
	@$fi = $_POST['fechainicio'];
	@$ff = $_POST['fechafinal'];
	@$cic_descripcion = $_POST['descripcion'];
    
	@list($mesI,$diaI,$anioI) = explode("-", $fi);
	@$fechaInicio = $anioI."-".$mesI."-".$diaI;
    @$cic_fechaInicio = $fechaInicio;

    @list($mesF,$diaF,$anioF) = explode("-", $ff);
	@$fechaFinal = $anioF."-".$mesF."-".$diaF;
    @$cic_fechaFinal= $fechaFinal;
    
    
	

	
	$array_data_ciclo = array(
	    'cic_id' => addslashes($cic_id),
	    'cic_fechaInicio' => addslashes($cic_fechaInicio),
	    'cic_fechaFinal' => addslashes($cic_fechaFinal),
	    'cic_descripcion' => addslashes($cic_descripcion)
	);


	switch($action){
		case 'crear':

			$cicloescolar->set($array_data_ciclo);
			$json = json_encode($cicloescolar);
			echo $json;

		break;

		case 'eliminar':
			$cicloescolar->delete(intval($cic_id));
			$json = json_encode($cicloescolar);
			echo $json;
					
	    break;

	    case 'activar':
			$cicloescolar->activar(intval($cic_id));
			$json = json_encode($cicloescolar);
			echo $json;
					
	    break;

		case 'actualizar':

			$cicloescolar->edit($array_data_ciclo);
			$json = json_encode($cicloescolar);
			echo $json;

		break;

		case 'get':

		
		$cicloescolar->get(intval($cic_id));
		echo $cicloescolar->to_json();

		break;

		case 'validar':

			$validar = $cicloescolar->validar_tiempo_real($cic_fechaInicio);
			if($validar){

				$json = json_encode($cicloescolar);
				echo $json;
				
			}
		break;

		case 'mostrar':
			$row = $cicloescolar->mostrar();
			$json = json_encode($row);
			echo $json;
		break;




	}
}


 ?>