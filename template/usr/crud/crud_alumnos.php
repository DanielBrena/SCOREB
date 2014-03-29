<?php  

require_once("../../../class/alumno/model.php");

$alumno = new Alumno();

if($_SERVER["REQUEST_METHOD"] == 'POST'){

	@$action = $_POST['action'];


	switch ($action) {
		case 'mostrarAlumnos':
			$row = $alumno->mostrar();
			$json = json_encode($row);
			echo $json;
			break;
		
		default:
			# code...
			break;
	}

}
?>