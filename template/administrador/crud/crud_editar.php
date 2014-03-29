<?php 
require_once("../../../class/alumno/model.php");
require_once("../../../class/beca/model.php");
$alumno = new Alumno();
$beca = new Beca();
//$log = new Log();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$action = $_POST['action'];

	@$alu_id = $_POST['id'];
    @$alu_nombre = $_POST['nombre'];
    @$alu_apellidoPaterno= $_POST['apellidoPaterno'];
    @$alu_apellidoMaterno = $_POST['apellidoMaterno'];
    @$alu_sexo = $_POST['sexo'];

    @$bec_id = $_POST['idB'];
    @$bec_porcentajeAcordado = $_POST['porcentajeAcordado'];


    
	

	$array_data_alumno = array(
    'alu_id' => addslashes($alu_id),
    'alu_nombre' => addslashes($alu_nombre),
    'alu_apellidoPaterno' => addslashes($alu_apellidoPaterno),
    'alu_apellidoMaterno' => addslashes($alu_apellidoMaterno),
    'alu_sexo' => addslashes($alu_sexo) 
	);

	switch($action){
		case 'actualizar':

			$alumno->edit($array_data_alumno);
			$json = json_encode($alumno);
			echo $json;

		break;

		case 'actualizarBeca':
			$beca->actualizarPorcentaje($bec_id,$bec_porcentajeAcordado);
			$json = json_encode($beca);
			echo $json;
			break;

	
	}
}



 ?>