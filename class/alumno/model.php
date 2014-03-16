<?php

/**
 * Description of model
 *
 * @author daniel
 */
//require_once ("../core/DBAbstractModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/beca3/core/DBAbstractModel.php");
class Alumno extends DBAbstractModel {

          protected $alu_id;
          private $alu_nombre;
          private $alu_apellidoPaterno;
          private $alu_apellidoMaterno;
          private $alu_fechaCreacion;
          

          function __construct() {
                    $this->db_name = "beca";
          }

          /**
           * @see DBAbstractModel::delete()
           */
          public function delete($id = '') {
                    if ($id != '') {

                              if (is_int($id)) {
                                        $this->query = "DELETE FROM sb_alumno
                                                      WHERE alu_id = '$id '";
                                      
                                        print $id;
                              } else {
                                        $this->query = "DELETE FROM sb_alumno
                                                              WHERE alu_nombre = '$id'";
                                       
                              }
                                $this->execute_single_query();
                             

                              $this->mensaje = "Se elimino usuario";
                    } else {
                              $this->mensaje = "Error";
                    }
          }

          /**
           * @see DBAbstractModel::edit()
           */
          public function edit($array_data = array()) {
                    if (array_key_exists('alu_id', $array_data)) {
                        
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }
                              $this->query = "
                      UPDATE sb_alumno
                      SET
                      alu_nombre = '$alu_nombre', 
                               alu_apellidoPaterno = '$alu_apellidoPaterno', 
                                        alu_apellidoMaterno = '$alu_apellidoMaterno'
                      WHERE alu_id = '$alu_id'
                      ";

                              $this->execute_single_query();
                              $this->mensaje = "Se actualizo alumno";
                    } else {
                              $this->mensaje = "Error";
                    }
          }

          /**
           * @see DBAbstractModel::get()
           */
          public function get($id = '') {
                    if ($id != '') {

                              if (is_int($id)) {

                                        $this->query = "SELECT * FROM sb_alumno
                                                                       WHERE alu_id = '$id'
                                                                      ";
                              } else {

                                        $this->query = "SELECT * FROM sb_alumno
                                                              WHERE alu_nombre = '$id'
                                                                     ";
                              }
                              $this->get_results_from_query();

                              if (count($this->rows) == 1) {

                                        foreach ($this->rows[0] as $propiedad => $valor) {
                                                  $this->$propiedad = $valor;
                                        }
                                        $this->mensaje = "Alumno encontrado";
                              } else {
                                        $this->mensaje = "Alumno no encontrado";
                              }
                    } else {
                              $this->mensaje = "Error";
                    }
          }

          /**
           * @see DBAbstractModel::set()
           * 
           */
          public function set($array_data = array()) {

                    if (array_key_exists('alu_nombre', $array_data)) {

                              //  $this->get($array_data ['alu_nombre']);

                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }

                              $this->query = "
                                                  SELECT * FROM sb_alumno 
                                                  WHERE alu_nombre = '$alu_nombre'
                                                            AND alu_apellidoPaterno = '$alu_apellidoPaterno'
                              
                                        ";
                              $this->get_results_from_query();

                              if (count($this->rows) == 1) {
                                        $this->mensaje = "Ya existe alumno";
                              } else {
                                        unset($this->rows);

                                        

                                        $fecha = date("Y-m-d h:m:s");

                                        $this->query = "INSERT INTO sb_alumno
				(alu_id,alu_nombre,alu_apellidoPaterno,alu_apellidoMaterno,alu_fechaCreacion) 
				VALUES 
				('$alu_id','$alu_nombre','$alu_apellidoPaterno','$alu_apellidoMaterno','$fecha') 
				";
                                        $this->execute_single_query();

                                        $this->mensaje = "Se creo Alumno";
                              }
                    } else {
                              $this->mensaje = "Error";
                    }
          }
          
         
          
          public function getAlu_id() {
                    return $this->alu_id;
          }

          public function getAlu_nombre() {
                    return $this->alu_nombre;
          }

          public function getAlu_apellidoPaterno() {
                    return $this->alu_apellidoPaterno;
          }

          public function getAlu_apellidoMaterno() {
                    return $this->alu_apellidoMaterno;
          }


          public function getAlu_fechaCreacion() {
                    return $this->alu_fechaCreacion;
          }


          
          function __destruct() {
                    unset($this);
          }

}

?>
