<?php


/**
 * Description of model
 *
 * @author daniel
 */
//require_once ("../core/DBAbstractModel.php");
class Programa extends DBAbstractModel {
          protected $pro_id;
          private $pro_nombre;
          private $pro_descripcion;
          private $pro_fechaCreacion;        
          
          
           function __construct(){
                    $this->db_name = "beca";
          }
          
          public function get($id = ''){
                    if($id != ''){
                              if(is_int($id)){
                                        $this->query = "SELECT * FROM sb_programa WHERE pro_id ='$id'";
                              }else{
                                        $this->query = "SELECT * FROM sb_programa WHERE pro_nombre = '$id'";
                                       
                              }
                              $this->get_results_from_query();
                              
                              if(count($this->rows) == 1){
                                        foreach ($this->rows[0] as $propiedad => $valor) {
                                                  $this->$propiedad = $valor;
                                        }
                                        $this->mensaje = "Programa encontrado";
                              }else{
                                        $this->mensaje = "No se encontro programa";
                              }
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function set($array_data = array()){
                    if(array_key_exists('pro_nombre', $array_data)){
                              $this->get($array_data['pro_nombre']);
                              
                              if($array_data['pro_nombre'] != $this->pro_nombre){
                                        foreach ($array_data as $campo => $valor) {
                                                  $$campo = $valor;
                                        }
                                        
                                         $fecha = date("Y-m-d h:m:s");

                                        $this->query = "
                                                  INSERT INTO sb_programa
                                                  (pro_id,pro_nombre,pro_descripcion,pro_fechaCreacion)
                                                  VALUES
                                                  ('$pro_id','$pro_nombre','$pro_descripcion','$fecha')
                                                  ";
                                        $this->execute_single_query();
                                        
                                        $this->mensaje = "Se creo programa";
                              }else{
                                        $this->mensaje = "Programa existente";
                              }
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function edit($array_data = array()){
                    if(array_key_exists('pro_id', $array_data)){
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }
                              $this->query = "
                                        UPDATE sb_programa
                                        SET pro_nombre ='$pro_nombre',
                                                  pro_descripcion = '$pro_descripcion'
                                         
                                                  WHERE pro_id = '$pro_id'
                              ";
                              $this->execute_single_query();
                              $this->mensaje = "Se Actualizo programa";
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function delete($id = ''){
                    if($id != ''){
                              $this->query = "DELETE FROM sb_programa
                                        WHERE pro_id ='$id' ";
                              $this->execute_single_query();
                              $this->mensaje = "Se elimino programa";
                    }else{
                              $this->mensaje = "Error";
                    }
          }

           public function mostrar(){
            $this->query = "SELECT * FROM sb_programa";
            $this->get_results_from_query();
            return $this->rows;
          }

          public function validar_tiempo_real($pro_nombre =''){
            $this->query = "SELECT * FROM sb_programa
                                           WHERE pro_nombre = '$pro_nombre'                                            
                                        ";
                                 $this->get_results_from_query();
                                 
                                 if(count($this->rows) == 1){
                                           $this->mensaje = "Programa existente.";
                                           return true;
                                 }else{
                                    return false;
                                 }
          }
          
          public function getPro_id() {
                    return $this->pro_id;
          }

          public function getPro_nombre() {
                    return $this->pro_nombre;
          }

          public function getPro_descripcion() {
                    return $this->pro_descripcion;
          }

          public function getPro_fechaCreacion() {
                    return $this->pro_fechaCreacion;
          }


                    
          function __destruct() {
                    unset($this);
          }
          
}

?>
