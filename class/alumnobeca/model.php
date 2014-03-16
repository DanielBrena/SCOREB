<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author daniel
 */

//require_once ("../core/DBAbstractModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/beca3/core/DBAbstractModel.php");
include ($_SERVER['DOCUMENT_ROOT']."/beca3/class/ciclo/model.php");
class AlumnoBeca extends DBAbstractModel {
          
           protected $abc_id;
          private $abc_alumno_fk;
          private $abc_ciclo_escolar_fk;
          private $abc_beca_fk;
          private $abc_tipo;
          private $abc_activo;
          
          
           function __construct(){
                    $this->db_name = "beca";
          }
          
          public function get($id = ''){
                    if($id != ''){
                              if(is_int($id)){
                                        $this->query = "SELECT * FROM sb_alumbo_beca WHERE abc_ ='$id'";
                                        $this->get_results_from_query();
                              
                                    if(count($this->rows) == 1){
                                              foreach ($this->rows[0] as $propiedad => $valor) {
                                                        $this->$propiedad = $valor;
                                              }
                                              $this->mensaje = "alumno beca encontrado";
                                    }else{
                                              $this->mensaje = "No se encontro alumno beca";
                                    }
                              }else{
                                        //$this->query = "SELECT * FROM sb_tipo_beca WHERE tip_nombre = '$id'";
                                    $this->mensaje = "Error";   
                              }
                              
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function set($array_data = array()){
                    if(array_key_exists('abc_id', $array_data)){
                              
                        //$this->get($array_data['abc_id']);
                             // if($array_data['abc_id'] != $this->abc_id){
                                        
                                        $ciclo = new CicloEscolar();
                                        $ciclo->getActivo();
                                        $ciclo_id = $ciclo->getCic_id();
                                        
                                        foreach ($array_data as $campo => $valor) {
                                                  $$campo = $valor;
                                        }
                                        
                                        
                                        $this->query = "SELECT * FROM sb_alumno_beca
                                            WHERE abc_alumno_fk = '$abc_alumno_fk' AND abc_ciclo_escolar_fk = '$ciclo_id'
                                                AND abc_beca_fk = '$abc_beca_fk'
                                            ";
                                        $this->get_results_from_query();
                                        
                                        if(count($this->rows) == 1){
                                            $this->mensaje = "alumno beca existente";
                                        }else{
                                            unset($this->rows);
                                            
                                            $this->query = "
                                                  INSERT INTO sb_alumno_beca
                                                  (abc_id,abc_alumno_fk,abc_ciclo_escolar_fk,abc_beca_fk,abc_tipo, abc_activo)
                                                  VALUES
                                                  ('$abc_id','$abc_alumno_fk','$ciclo_id','$abc_beca_fk','$abc_tipo','$abc_activo')
                                                  ";
                                            $this->execute_single_query();

                                            $this->mensaje = "Se creo alumno beca";
                                            
                                        }
                                        

                                        
                            
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function edit($array_data = array()){
                   /*
                    * No se puede editar
                    *  if(array_key_exists('bec_id', $array_data)){
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }
                              $this->query = "
                                        UPDATE sb_alumno_beca
                                        SET  sb ='$mat_programa',
                                                 mat_matricula = '$mat_matricula',
                                                           mat_bajasAproximacion = '$mat_aproximacion',
                                                                     mat_reinscripcionEsperada = '$mat_reinscripcionAproximacion'
                                                   
                                         
                                                  WHERE mat_id = '$mat_id'
                              ";
                              $this->execute_single_query();
                              $this->mensaje = "Se Actualizo tipo beca";
                    }else{
                              $this->mensaje = "Error";
                    }*/
          }
          
          public function delete($id = ''){
                   /**
                    * No se puede eliminar
                    *  if($id != ''){
                    
                              $this->query = "DELETE FROM sb_matricula
                                        WHERE mat_id ='$id' ";
                              $this->execute_single_query();
                              $this->mensaje = "Se elimino tipo beca";
                    }else{
                              $this->mensaje = "Error";
                    }
                    */
          }
          
          
          public function getAbc_id() {
              return $this->abc_id;
          }

          public function getAbc_alumno_fk() {
              return $this->abc_alumno_fk;
          }

          public function getAbc_ciclo_escolar_fk() {
              return $this->abc_ciclo_escolar_fk;
          }

          public function getAbc_beca_fk() {
              return $this->abc_beca_fk;
          }

          public function getAbc_tipo() {
              return $this->abc_tipo;
          }

          public function getAbc_activo() {
              return $this->abc_activo;
          }

                                        
          function __destruct() {
                    unset($this);
          }
}

?>
