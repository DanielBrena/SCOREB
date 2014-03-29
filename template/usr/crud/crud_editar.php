<?php 

require_once("../../../class/alumno/model.php");
require_once("../../../class/programa/model.php");
require_once("../../../class/tipoBeca/model.php");
require_once("../../../class/alumnobeca/model.php");
require_once("../../../class/beca/model.php");

@$alumno = new Alumno();
@$programa = new Programa();
@$tipobeca = new TipoBeca();
@$alumnobeca = new AlumnoBeca();
@$beca = new Beca();


if($_SERVER["REQUEST_METHOD"] == 'POST'){

	@$action = $_POST['action'];
	@$alu_id = $_POST['id'];
	@$alu_nombre = $_POST['nombre_alumno'];
	@$alu_apellidoPaterno = $_POST['apellidopaterno_alumno'];
	@$alu_apellidoMaterno = $_POST['apellidomaterno_alumno'];
	@$alu_sexo = $_POST['sexo'];

	$array_data_alumno = array(
    'alu_id' =>$alu_id,
    'alu_nombre' => $alu_nombre,
    'alu_apellidoPaterno' => $alu_apellidoPaterno,
    'alu_apellidoMaterno' => $alu_apellidoMaterno,
    'alu_sexo' => $alu_sexo
	);

	@$pro_id = $_POST['id_programa'];
	@$pro_nombre = $_POST['nombre_programa'];

	@$tip_id = $_POST['id_tipobeca'];
	@$tip_nombre =  $_POST['nombre_tipobeca'];

	//@$bec_fecha_recepcion = $_POST['fecha_recepcion'];
	@$bec_id = $_POST['idb'];
	@$bec_fechaCita = $_POST['fecha_cita'];
	@$bec_porcentajeSolicitado = $_POST['porcentaje_solicitado'];
	@$bec_porcentajeAcordado = $_POST['porcentaje_acordado'];
	@$bec_pendiente = $_POST['pendiente'];
	@$bec_observaciones = $_POST['observacion'];
	@$bec_asistencia = $_POST['asistencia'];
	@$bec_recibe = $_POST['recibe'];


	$array_data_beca = array(
    'bec_id' => $bec_id,
    'bec_programa' => $pro_id,
    'bec_tipo_beca' => $tip_id,
    'bec_fechaCita' => $bec_fechaCita,
    'bec_porcentajeSolicitado' => $bec_porcentajeSolicitado,
    'bec_porcentajeAcordado' => $bec_porcentajeAcordado,
    'bec_pendiente' => $bec_pendiente,
    'bec_observaciones'=> $bec_observaciones,
    'bec_grupo' => '',
    'bec_asistencia' => $bec_asistencia,
    'bec_recibe' => $bec_recibe
    );


	switch($action){

		case 'actualizar':
		$alumno->edit($array_data_alumno);
		$beca->edit($array_data_beca);


		   $json = json_encode($beca);
		   // $mensaje = "No entro".$idalumno." ".$idbeca;
		   echo $json;


		break;
		 


		
	}
}













 ?>