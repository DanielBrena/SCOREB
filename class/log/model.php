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
require_once ($_SERVER['DOCUMENT_ROOT']."/SCOREB/core/DBAbstractModel.php");
class Log extends DBAbstractModel {
          protected $log_id;
          private $log_descripcion;
          private $log_fecha;
          private $log_creador;
          
          function __construct() {
                    $this->db_name = "beca";
          }
          
          public function get($id = ''){
                    if($id != ''){
                              if(is_int($id)){
                                        $this->query = "SELECT * FROM sb_logs WHERE log_id ='$id'";
                                         $this->get_results_from_query();

                                        if(count($this->rows) == 1){
                                                  foreach ($this->rows[0] as $propiedad => $valor) {
                                                            $this->$propiedad = $valor;
                                                  }
                                                  $this->mensaje = "log escolar encontrado";
                                        }else{
                                                  $this->mensaje = "No se encontro logr";
                                        }
                              }else{
                                       // $this->query = "SELECT * FROM sb_logs WHERE log_creador = '$id'";
                                      
                              }
                              
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function set($array_data = array()){
                    if(array_key_exists('log_id', $array_data)){
                              
                                        foreach ($array_data as $campo => $valor) {
                                                  $$campo = $valor;
                                        }
                                        
                                        
                                        $fecha = date("Y-m-d h:m:s");
                                        
                                        $this->query = "
                                                  INSERT INTO sb_logs
                                                  (log_id,log_descripcion,log_fecha,log_creador)
                                                  VALUES
                                                  ('$log_id','$log_descripcion','$fecha','$log_creador')
                                                  ";
                                        $this->execute_single_query();
                                        
                                        $this->mensaje = "Se creo log";
                             
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function edit(){
             /*
              * Un log no se puede editar
              */
          }
          
          public function delete($id = ''){
                    if($id != ''){
                              if(is_int($id)){
                                        $this->query = "DELETE FROM sb_logs
                                        WHERE log_id ='$id' ";
                             
                              }else{
                                          $this->query = "DELETE FROM sb_logs
                                        WHERE log_creador ='$id' ";
                              }
                               $this->execute_single_query();
                              $this->mensaje = "Se elimino log";
                    }else{
                              $this->mensaje = "Error";
                    }
          }

          public function mostrar(){
            $this->query = "SELECT * FROM sb_logs ORDER BY log_id DESC LIMIT 0, 5 ";
            $this->get_results_from_query();
            return $this->rows;
          }
}

?>
