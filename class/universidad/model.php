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
require_once ("../../core/DBAbstractModel.php");

/**
 * @author daniel
 *
 */
class Universidad extends DBAbstractModel {

          private $uni_id;
          private $uni_nombre;
          private $uni_descripcion;
          private $uni_fechaCreacion;

          /**
           * Constructor
           */
          function __construct() {
                    $this->db_name = "beca";
          }
          
           /**
           * @see DBAbstractModel::get()
           */
          public function get($id = '') {
                    if ($id != '') {

                              if (is_int($id)) {

                                        $this->query = "SELECT * FROM sb_universidad
					WHERE uni_id = '$id'
				";
                                      
                              } else {

                                        $this->query = "SELECT * FROM sb_universidad
					WHERE uni_nombre = '$id'
				";
                                        
                              }
                              $this->get_results_from_query();

                              if (count($this->rows) == 1) {

                                        foreach ($this->rows [0] as $propiedad => $valor) {
                                                  $this->$propiedad = $valor;
                                        }
                                        $this->mensaje = "Universidad encontrada";
                              } else {
                                        $this->mensaje = "Universidad no encontrada";
                              }
                    } else {
                              $this->mensaje = "Error";
                    }
          }

          /**
           * @see DBAbstractModel::set()
           */
          public function set($array_data = array()) {
                    if (array_key_exists('uni_nombre', $array_data)) {

                              $this->get($array_data ['uni_nombre']);

                              if ($this->uni_nombre != $array_data ['uni_nombre']) {

                                        foreach ($array_data as $campo => $valor) {
                                                  $$campo = $valor;
                                        }

                                        $fecha = date("Y-m-d h:m:s");

                                        $this->query = "	INSERT INTO sb_universidad
				(uni_id,uni_nombre,uni_descripcion,uni_fechaCreacion) 
				VALUES 
				('$uni_id','$uni_nombre','$uni_descripcion','$fecha')
				";
                                        $this->execute_single_query();
                                        $this->mensaje = "Se creo Universidad";
                              } else {
                                        $this->mensaje = "Ya existe con ese nombre";
                              }
                    } else {
                              $this->mensaje = "Error";
                    }
          }

          /**
           * 
           * @see DBAbstractModel::edit()
           */
          public function edit($array_data = array()) {
                    if (array_key_exists('uni_id', $array_data)) {
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }
                              $this->query = "
                                        UPDATE sb_universidad 
                                        SET
                                        uni_nombre = '$uni_nombre',
                                                  uni_descripcion = '$uni_descripcion'
                                                            WHERE uni_id = '$uni_id'
                              ";
                              
                              $this->execute_single_query();
                              $this-> mensaje = "Se actualizo universidad";
                              
                    } else {
                              $this->mensaje = "Error";
                    }
          }
          
           /**
           * @see DBAbstractModel::delete()
           */
           public function delete($id = '') {
                    if($id != ''){
                              
                              if(is_int($id)){
                                        $this->query = "DELETE FROM sb_universidad
                                        WHERE uni_id = '$id'";
                                        
                              }else{
                                        $this->query = "DELETE FROM sb_universidad
                                        WHERE uni_nombre = '$id'";
                                     
                              }
                              $this->execute_single_query();
                             
                              $this->mensaje = "Se elimino universidad";
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
         
          public function getUni_id() {
                    return $this->uni_id;
          }

                    
          public function getUni_nombre() {
                    return $this->uni_nombre;
          }

          public function getUni_descripcion() {
                    return $this->uni_descripcion;
          }

          public function getUni_fechaCreacion() {
                    return $this->uni_fechaCreacion;
          }

          function __destruct() {
                    unset($this);
          }

}

?>
