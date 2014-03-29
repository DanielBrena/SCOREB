<?php 
require_once("../../../class/log/model.php");
require_once("../../../class/administrador/model.php");
$administrador = new Administrador();
$log = new Log();

if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	$action = $_POST['action'];

	@$adm_id = $_POST['id'];
    @$adm_nombre = $_POST['nombre'];
    @$adm_apellidoPaterno = $_POST['apellidoPaterno'];
    @$adm_apellidoMaterno = $_POST['apellidoMaterno'];
    @$adm_correo = $_POST['correo'];
    @$adm_usuario = $_POST['usuario'];
    @$adm_clave = $_POST['clave'];
   	@$adm_permiso = $_POST['permiso'];
   	@$admin = $_POST['admin'];
	

	$array_data_administrador = array(
      'adm_id' => $adm_id,
      'adm_nombre' => addslashes($adm_nombre),
      'adm_apellidoPaterno' => addslashes($adm_apellidoPaterno),
      'adm_apellidoMaterno' => addslashes($adm_apellidoMaterno),
      'adm_correo' => addslashes($adm_correo),
      'adm_usuario' => addslashes($adm_usuario),
      'adm_clave' => addslashes($adm_clave),
      'adm_permiso' => addslashes($adm_permiso)
    );

	switch($action){
		case 'crear':

		$administrador->set($array_data_administrador);
		
		$json = json_encode($administrador);
		echo $json;

		/*$array_data_logs = array(
		    'log_id'=>'',
		    'log_descripcion'=>'Crear|Administrador|Mensaje del sistema:'.$administrador->mensaje,
		    'log_creador' => $admin
		    ); 

		$log->set($array_data_logs);
		*/


		break;

		case 'eliminar':
		$administrador->delete(intval($adm_id));
		$json = json_encode($administrador);
		echo $json;
		/*$array_data_logs = array(
		      'log_id'=>'',
		      'log_descripcion'=>'Eliminar|Administrador|Mensaje del sistema:'.$administrador->mensaje,
		      'log_creador' => $admin
		    ); 
		
		$log->set($array_data_logs);
		*/
		
	    break;

		case 'actualizar':

			$administrador->edit($array_data_administrador);
			//$sesion = new Sesion();
			

			$json = json_encode($administrador);
			echo $json;

			/*$array_data_logs = array(
		      'log_id'=>'',
		      'log_descripcion'=>'Actualizar|Administrador|Mensaje del sistema:'.$administrador->mensaje,
		      'log_creador' => $admin
		    ); 

		    $log->set($array_data_logs);*/

		break;

		case 'get':

		
		$administrador->get(intval($adm_id));
		echo $administrador->to_json();

		break;

		case 'validar':

			$validar = $administrador->validar_tiempo_real($adm_nombre,$adm_usuario,$adm_apellidoPaterno,$adm_correo);
			if($validar){

				$json = json_encode($administrador);
				echo $json;
			}
		break;

		case 'mostrar':
			$row = $administrador->mostrar();
			$json = json_encode($row);
			echo $json;
		break;




	}
}


 ?>