<?php 


require_once ($_SERVER['DOCUMENT_ROOT']."/SCOREB/core/DBAbstractModel.php");
class VistaBecaAlumno extends DBAbstractModel {
	/*private $nombre;
	private $apellidoPaterno;
	private $apellidoMaterno;
	private $programa;
	private $tipoBeca;
	private $cicloEscolar;
	private $tipo;
	private $fechaRecepcion;
	private $fechaCita;
	private $porcentajeSolicitado;
	private $pendiente;
	private $observacion;
*/
	function __construct(){
		$this->db_name = "beca";
	}

	public function get(){

	}

	public function set(){

	}

	public function edit(){

	}

	public function delete(){

	}

	public function mostrar(){
		$this->query = "SELECT * FROM vista_beca_alumno WHERE cic_activar ='1' ORDER BY abc_id  DESC  LIMIT 5";
		$this->get_results_from_query();
		return $this->rows;
	}
	public function mostrar_otorgados(){
		$this->query = "SELECT * FROM vista_beca_alumno WHERE cic_activar ='1' AND bec_porcentajeAcordado <> 0 ORDER BY abc_id  DESC";
		$this->get_results_from_query();
		return $this->rows;
	}

	public function mostrar_para_otorgar(){
		$this->query = "SELECT * FROM vista_beca_alumno WHERE cic_activar ='1' AND bec_porcentajeAcordado = 0 ORDER BY abc_id  DESC";
		$this->get_results_from_query();
		return $this->rows;
	}

	public function mostrar_param($param = ''){
		$this->query = "SELECT * FROM vista_beca_alumno WHERE abc_tipo = '$param'  ORDER BY abc_id DESC";
		$this->get_results_from_query();
		return $this->rows;
	}

	public function alumnoID($id = ''){
		$this->query = "SELECT * FROM vista_beca_alumno WHERE alu_id = '$id'";
		$this->get_results_from_query();
		if(count($this->rows) >= 1){
           foreach ($this->rows[0] as $propiedad => $valor) {
                $$propiedad = $valor;
            }
          	return $pro_id;
        }
		
	}

	public function noRenovar($id = ''){
		$this->query = "SELECT * FROM vista_beca_alumno WHERE alu_id = '$id' and abc_tipo = 'Renovacion' or abc_tipo = 'Nueva' and cic_activar = '1'";
		$this->get_results_from_query();
		if(count($this->rows) >= 1){
           return true;
          	
        }else{
        	return false;
        }
	}

	public function abc($abc = ''){
		$this->query = "SELECT * FROM vista_beca_alumno WHERE abc_id = '$abc'";
		$this->get_results_from_query();
		return $this->rows;
	}

	public function mostrar_alumnos(){
		$this->query = "SELECT * FROM vista_beca_alumno  GROUP BY alu_id ORDER BY abc_id DESC ";
		$this->get_results_from_query();
		return $this->rows;
		
	}

	public function actualizar($porcentaje = '',$bec = ''){
		if($porcentaje != '' && $bec != ''){
			$this->query = "
			UPDATE vista_beca_alumno SET bec_porcentajeAcordado = '$porcentaje' WHERE bec_id = '$bec';
			";
			$this->execute_single_query();
			$this->mensaje = "Se otorgo un porcentaje al alumno";
		}else{
			$this->mensaje = "Error";
		}
	}

}

class VistaHistorial extends DBAbstractModel {
	private $id;
	private $id_abc;
	private $nombre;
	private $apellidoPaterno;
	private $apellidoMaterno;
	private $programa;
	private $tipoBeca;
	private $cicloEscolar;
	private $tipo;
	private $porcentajeSolicitado;
	private $porcentajeAcordado;
	private $activo;

	function __construct(){
		$this->db_name = "beca";
	}

	public function get(){

	}

	public function set(){

	}

	public function edit(){

	}

	public function delete(){

	}

	public function mostrar($id = ''){
		$this->query = "select * from vista_historial where id = '$id'";
		$this->get_results_from_query();
		return $this->rows;
	}

	public function actualizar($id = '', $id2 = ''){
		if($porcentaje != '' && $id != ''){
			$this->query = "
			UPDATE vista_historial SET activo = '0'  where id = '$id';
			";
			$this->execute_single_query();

			
			unset($this->rows);
			$this->query = "
			UPDATE vista_historial SET activo = '0'  where id_abc = '$id2';
			";
			$this->execute_single_query();

			$this->mensaje = "Se otorgo un porcentaje al alumno";


		}else{
			$this->mensaje = "Error";
		}
	}

}

class VistaMatricula extends DBAbstractModel {
	/*private $id;
	private $id_abc;
	private $nombre;
	private $apellidoPaterno;
	private $apellidoMaterno;
	private $programa;
	private $tipoBeca;
	private $cicloEscolar;
	private $tipo;
	private $porcentajeSolicitado;
	private $porcentajeAcordado;
	private $activo;
	*/

	function __construct(){
		$this->db_name = "beca";
	}

	public function get(){

	}

	public function set(){

	}

	public function edit(){

	}

	public function delete(){

	}

	public function mostrar(){
		$this->query = "SELECT * FROM vista_matricula";
		$this->get_results_from_query();
		return $this->rows;
	}

	/*public function actualizar($id = '', $id2 = ''){
		if($porcentaje != '' && $id != ''){
			$this->query = "
			UPDATE vista_historial SET activo = '0'  where id = '$id';
			";
			$this->execute_single_query();

			
			unset($this->rows);
			$this->query = "
			UPDATE vista_historial SET activo = '0'  where id_abc = '$id2';
			";
			$this->execute_single_query();

			$this->mensaje = "Se otorgo un porcentaje al alumno";


		}else{
			$this->mensaje = "Error";
		}
	}*/

}
 ?>