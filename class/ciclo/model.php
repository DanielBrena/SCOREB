<?php


/**
 * Description of model
 *
 * @author daniel
 */
//require_once ("../core/DBAbstractModel.php");
//require_once ("../class/universidad/model.php");

include($_SERVER['DOCUMENT_ROOT']."/SCOREB/class/universidad/model.php");

class CicloEscolar extends DBAbstractModel {
          protected $cic_id;
          private $cic_fechaInicio;
          private $cic_fechaFinal;
          private $cic_descripcion;
          private $cic_activar;
          private $cic_universidad_fk;
          
          
          
           function __construct(){
                    $this->db_name = "beca";
          }
          
          public function get($id = ''){
                    if($id != ''){
                              if(is_int($id)){
                                        $this->query = "SELECT * FROM sb_ciclo_escolar  WHERE cic_id ='$id'";
                              }else{
                                        $this->query = "SELECT * FROM sb_ciclo_escolar WHERE cic_fechaInicio = '$id'";
                                       
                              }
                              $this->get_results_from_query();
                              
                              if(count($this->rows) == 1){
                                        foreach ($this->rows[0] as $propiedad => $valor) {
                                                  $this->$propiedad = $valor;
                                        }
                                        $this->mensaje = "Ciclo escolar encontrado";
                              }else{
                                        $this->mensaje = "No se encontro ciclo escolar";
                              }
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function set($array_data = array()){
                    if(array_key_exists('cic_fechaInicio', $array_data)){
                              $this->get($array_data['cic_fechaInicio']);
                              if($array_data['cic_fechaInicio'] != $this->cic_fechaInicio){
                                  
                                        foreach ($array_data as $campo => $valor) {
                                                  $$campo = $valor;
                                        }
                                        
                                        // $fecha = date("Y-m-d h:m:s");
                                        if($cic_fechaInicio != ''){
                                          $universidad = new Universidad();
                                          $universidad->get("Universidad La Salle Oaxaca");

                                          $id = $universidad->getUni_id();
                                          
                                          $this->query = "
                                                    INSERT INTO sb_ciclo_escolar
                                                    (cic_id,cic_fechaInicio,cic_fechaFinal,cic_descripcion,cic_activar,cic_universidad_fk)
                                                    VALUES
                                                    ('$cic_id','$cic_fechaInicio','$cic_fechaFinal','$cic_descripcion','0','$id')
                                                    ";
                                          $this->execute_single_query();
                                          
                                          $this->mensaje = "Se creo ciclo el escolar.";
                                        }else{
                                          $this->mensaje = "Error, faltaron algunos campos que rellenar.";
                                        }
                                        
                              }else{
                                        $this->mensaje = "Ciclo escolar existente";
                              }
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function edit($array_data = array()){
                    if(array_key_exists('cic_id', $array_data)){
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }
                              if($cic_fechaInicio != ''){
                                $this->query = "
                                        UPDATE sb_ciclo_escolar
                                        SET cic_fechaInicio ='$cic_fechaInicio',
                                                  cic_fechaFinal = '$cic_fechaFinal',
                                                            cic_descripcion = '$cic_descripcion'
                                         
                                                  WHERE cic_id = '$cic_id'
                                ";
                                $this->execute_single_query();
                                $this->mensaje = "Se actualizo ciclo el escolar";
                              }else{
                                $this->mensaje = "Error, faltaron algunos campos que rellenar.";
                              }
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function delete($id = ''){
                    if($id != ''){
                              $this->query = "DELETE FROM sb_ciclo_escolar
                                        WHERE cic_id ='$id' ";
                              $this->execute_single_query();
                              $this->mensaje = "Se elimino ciclo escolar";
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function getActivo(){
              $this->query = "
                  SELECT * FROM sb_ciclo_escolar
                  WHERE cic_activar = '1'
                ";
              $this->get_results_from_query();
              
              if(count($this->rows) == 1){
                  foreach ($this->rows[0] as $propiedad => $valor) {
                      $this->$propiedad = $valor;
                  }
              }
          }
          
          public function activar($id = ''){
              if($id != ''){
                  
                  if(is_int($id)){
                      
                      $this->query = "UPDATE sb_ciclo_escolar
                          SET cic_activar = '0'";
                      $this->execute_single_query();
                      
                      unset($this->rows);
                       
                      $this->query = "UPDATE sb_ciclo_escolar
                          SET cic_activar = '1'
                          WHERE cic_id ='$id'";
                      $this->execute_single_query();
                      
                      $this->mensaje = "Se activo el ciclo escolar.";
                              
                      
                  }
                  
              }else{
                  $this->mensaje = "Error.";
              }
          }
          public function mostrar(){
            $this->query = "SELECT * FROM sb_ciclo_escolar";
            $this->get_results_from_query();
            return $this->rows;
          }

          public function validar_tiempo_real($cic_fechaInicio =''){
            $this->query = "SELECT * FROM sb_ciclo_escolar
                                           WHERE cic_fechaInicio = '$cic_fechaInicio'                                            
                                        ";
                                 $this->get_results_from_query();
                                 
                                 if(count($this->rows) == 1){
                                           $this->mensaje = "Ciclo escolar existente.";
                                           return true;
                                 }else{
                                    return false;
                                 }
          }

          public function to_json(){
            @list($anioI,$mesI,$diaI) = explode("-", $this->cic_fechaInicio);
            @$fechaInicio = $mesI."-".$diaI."-".$anioI;
            @$this->cic_fechaInicio = $fechaInicio;

            @list($anioF,$mesF,$diaF) = explode("-", $this->cic_fechaFinal);
            @$fechaFinal = $mesF."-".$diaF."-".$anioF;
            @$this->cic_fechaFinal = $fechaFinal;


            return json_encode(array(
              'cic_id' => $this->cic_id,
              'cic_fechaInicio' => $this->cic_fechaInicio,
              'cic_fechaFinal' => $this->cic_fechaFinal,
              'cic_descripcion' => $this->cic_descripcion,
              'cic_activar' => $this->cic_activar,
              'cic_universidad_fk' => $this->cic_universidad_fk

              ));
          }

          public function getCic_id() {
                    return $this->cic_id;
          }

          public function getCic_fechaInicio() {
                    return $this->cic_fechaInicio;
          }

          public function getCic_fechaFinal() {
                    return $this->cic_fechaFinal;
          }

          public function getCic_descripcion() {
                    return $this->cic_descripcion;
          }

          public function getCic_activar() {
                    return $this->cic_activar;
          }

          public function getCic_universidad_fk() {
                    return $this->cic_universidad_fk;
          }

          
                    
          function __destruct() {
                    unset($this);
          }
          
}

?>
