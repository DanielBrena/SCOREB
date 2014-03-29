<?php

/**
 * Description of model
 *
 * @author daniel
 */
require_once ($_SERVER['DOCUMENT_ROOT']."/SCOREB/core/DBAbstractModel.php");
include ($_SERVER['DOCUMENT_ROOT']."/SCOREB/class/ciclo/model.php");

class Matricula extends DBAbstractModel {

   protected $mat_id;
   private $mat_programa;
   private $mat_matricula_actual;
   private $mat_matricula;
   private $mat_bajasAproximacion;
   private $mat_reinscripcionEsperada;
   private $mat_ciclo_escolar_fk;

   function __construct() {
      $this->db_name = "beca";
   }

   public function get($id = '') {
      if ($id != '') {
         if(is_int($id)){
            $this->query = "SELECT * FROM sb_matricula WHERE mat_id ='$id'";
            $this->get_results_from_query();
            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad => $valor) {
                    $this->$propiedad = $valor;
                }
                $this->mensaje = "Se encontro la matricula.";
            } else {
                $this->mensaje = "No se encontro la matricula.";
            }
         }else{
            $this->mensaje = "Error.";
         }
      }else {
         $this->mensaje = "Error.";
      }
   }

   public function set($array_data = array()) {
      if (array_key_exists('mat_id', $array_data)) {
            foreach ($array_data as $campo => $valor) {
               $$campo = $valor;
            }
            $ciclo_actual = new CicloEscolar();
            $ciclo_actual->getActivo();
            $id = $ciclo_actual->getCic_id();
            $this->query = "
               SELECT * FROM sb_matricula WHERE
               mat_programa = '$mat_programa' AND mat_ciclo_escolar_fk = '$id'
            ";
            $this->get_results_from_query();
            if(count($this->rows) == 1){
               $this->mensaje = "Ya existe esa matricula";
            }else{
               unset($this->rows);
               $this->query = "
                  INSERT INTO sb_matricula
                  (mat_id, mat_programa,mat_matricula_actual,mat_matricula,
                  mat_bajasAproximacion,mat_reinscripcionEsperada, mat_ciclo_escolar_fk)
                  VALUES
                  ('$mat_id','$mat_programa','$mat_matricula_actual',
                  '$mat_matricula','$mat_bajasAproximacion','$mat_reinscripcionEsperada','$id')
               ";
               $this->execute_single_query();
               $this->mensaje = "Se creo la matricula";
            }   
         }else {
            $this->mensaje = "Error";
      }
   }

   public function edit($array_data = array()) {
      if (array_key_exists('mat_id', $array_data)) {
         foreach ($array_data as $campo => $valor) {
            $$campo = $valor;
         }
         $this->query = "
            UPDATE sb_matricula
            SET  mat_programa ='$mat_programa',
            mat_matricula_actual = '$mat_matricula_actual',
            mat_matricula = '$mat_matricula',
            mat_bajasAproximacion = '$mat_bajasAproximacion',
            mat_reinscripcionEsperada = '$mat_reinscripcionEsperada'
            WHERE mat_id = '$mat_id'
         ";
         $this->execute_single_query();
           $this->mensaje = "Se actualizo la matricula.";
      }else {
         $this->mensaje = "Error";
      }
   }

   public function delete($id = '') {
      if ($id != '') {
         $this->query = "DELETE FROM sb_matricula
            WHERE mat_id ='$id' ";
         $this->execute_single_query();
         $this->mensaje = "Se elimino la matricula.";
      } else {
         $this->mensaje = "Error";
      }
   }

   public function to_json(){
      return json_encode(array(
         'mat_id' => $this->mat_id,
         'mat_programa' => $this->mat_programa,
         'mat_matricula_actual' => $this->mat_matricula_actual,
         'mat_matricula' => $this->mat_matricula,
         'mat_bajasAproximacion' => $this->mat_bajasAproximacion,
         'mat_reinscripcionEsperada' => $this->mat_reinscripcionEsperada
      ));
   }

   public function getMat_id() {
      return $this->mat_id;
   }

   public function getMat_programa() {
      return $this->mat_programa;
   }

   public function getMat_matricula_actual() {
      return $this->mat_matricula_actual;
   }

   public function getMat_matricula() {
      return $this->mat_matricula;
   }

   public function getMat_bajasAproximacion() {
      return $this->mat_bajasAproximacion;
   }

   public function getMat_reinscripcionEsperada() {
      return $this->mat_reinscripcionEsperada;
   }

   public function getMat_ciclo_escolar_fk() {
      return $this->mat_ciclo_escolar_fk;
   }

   function __destruct() {
     unset($this);
   }

}

?>
