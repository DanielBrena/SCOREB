<?php 
require_once("../../../class/programa/model.php");
require_once("../../../class/matricula/model.php");
require_once("../../../class/vistas/model.php");
$programa = new Programa();
$matricula = new Matricula();
$vista = new VistaMatricula();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	@$action = $_POST['action'];
	@$id_programa = intval($_POST['id']);
	@$pro = intval($_POST['pro']);
	@$matac = intval($_POST['matac']);
	@$mat = intval($_POST['mat']);
	@$bajas = intval($_POST['bajas']);
	@$reinscripcion = intval($_POST['reinscripcion']);


	$array_data_matricula = array(
	    'mat_id' => $id_programa,
	    'mat_programa' => $pro,
	    'mat_matricula_actual' => $matac,
	    'mat_matricula' => $mat,
	    'mat_bajasAproximacion' => $bajas,
	    'mat_reinscripcionEsperada' => $reinscripcion
    );

	switch ($action) {
		case 'mostrarProgramas':
			
			$row = $programa->mostrar();
			$json = json_encode($row);
			echo $json;
		break;
		
		case 'crear':

			$matricula->set($array_data_matricula);
			$json = json_encode($matricula);
			echo $json;

		break;

		case 'mostrarTabla':
			
			$row = $vista->mostrar();
			$json = json_encode($row);
			echo $json;
		break;

		case 'eliminar':
			$matricula->delete(intval($id_programa));
			$json = json_encode($matricula);
			echo $json;
					
	    break;

		case 'actualizar':

			$matricula->edit($array_data_matricula);
			$json = json_encode($matricula);
			echo $json;

		break;
		case 'get':
		$matricula->get(intval($id_programa));
		echo $matricula->to_json();

		break;
	}

}
 ?>