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

class Configuracion extends DBAbstractModel {
          
           protected $con_id;
          private $con_nombreConfiguracion;
          private $con_valorConfiguracion;
          private $con_estado;
         
          
           function __construct(){
                    $this->db_name = "beca";
          }
          
          public function get($id = ''){
                    if($id != ''){
                              if(is_int($id)){
                                        $this->query = "SELECT * FROM sb_configuracion WHERE con_id ='$id'";
                              }else{
                                        //$this->query = "SELECT * FROM sb_tipo_beca WHERE tip_nombre = '$id'";
                                       
                              }
                              $this->get_results_from_query();
                              
                              if(count($this->rows) == 1){
                                        foreach ($this->rows[0] as $propiedad => $valor) {
                                                  $this->$propiedad = $valor;
                                        }
                                        $this->mensaje = "COnfiguracion  encontrada";
                              }else{
                                        $this->mensaje = "No se encontro configuracion";
                              }
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function set($array_data = array()){
                    if(array_key_exists('con_id', $array_data)){
                              $this->get($array_data['con_id']);
                              if($array_data['con_id'] != $this->con_id){
                                        
                                        foreach ($array_data as $campo => $valor) {
                                                  $$campo = $valor;
                                        }
                                      

                                        $this->query = "
                                                  INSERT INTO sb_configuracion
                                                  (con_id,con_nombreConfiguracion,con_valorConfiguracion,con_estado)
                                                  VALUES
                                                  ('$con_id','$con_nombreConfiguracion','$con_valorConfiguracion','$con_estado')
                                                  ";
                                        $this->execute_single_query();
                                        
                                        $this->mensaje = "Se creo configuracion";
                              }else{
                                        $this->mensaje = "Configuracion existente";
                              }
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function edit($array_data = array()){
                    if(array_key_exists('con_id', $array_data)){
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }
                              $this->query = "
                                        UPDATE sb_configuracion
                                        SET  con_nombreConfiguracion ='$con_nombreConfiguracion',
                                                 con_valorConfiguracion = '$con_valorConfiguracion',
                                                           con_estado = '$con_estado'
                                                                                            
                                                  WHERE mat_id = '$mat_id'
                              ";
                              $this->execute_single_query();
                              $this->mensaje = "Se Actualizo configuracion";
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function delete($id = ''){
                    if($id != ''){
                              $this->query = "DELETE FROM sb_configuracion
                                        WHERE con_id ='$id' ";
                              $this->execute_single_query();
                              $this->mensaje = "Se elimino configuracion";
                    }else{
                              $this->mensaje = "Error";
                    }
          }


          public function editarID($id = '',$valor = ''){
               if($id != '' && $valor != ''){
                    $this->query = "UPDATE sb_configuracion SET con_valorConfiguracion = '$valor'
                    WHERE con_id = '$id'";
                    $this->execute_single_query();
                    $this->mensaje = "Se ha actualizado.";
               }else{
                    $this->mensaje = "Error";
               }
          }
          
          public function getCon_id() {
                    return $this->con_id;
          }

          public function getCon_nombreConfiguracion() {
                    return $this->con_nombreConfiguracion;
          }

          public function getCon_valorConfiguracion() {
                    return $this->con_valorConfiguracion;
          }

          public function getCon_estado() {
                    return $this->con_estado;
          }

          
                              
          function __destruct() {
                    unset($this);
          }
}

?>
