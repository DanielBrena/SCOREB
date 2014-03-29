<?php



/**
 * Description of model
 *
 * @author daniel
 */
//require_once ("../core/DBAbstractModel.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/SCOREB/core/DBAbstractModel.php");
class TipoBeca extends DBAbstractModel {
          
          protected $tip_id;
          private $tip_nombre;
          private $tip_descripcion;
          private $tip_fechaCreacion;
          
           function __construct(){
                    $this->db_name = "beca";
          }
          
          public function get($id = ''){
                    if($id != ''){
                              if(is_int($id)){
                                        $this->query = "SELECT * FROM sb_tipo_beca WHERE tip_id ='$id'";
                              }else{
                                        $this->query = "SELECT * FROM sb_tipo_beca WHERE tip_nombre = '$id'";
                                       
                              }
                              $this->get_results_from_query();
                              
                              if(count($this->rows) == 1){
                                        foreach ($this->rows[0] as $propiedad => $valor) {
                                                  $this->$propiedad = $valor;
                                        }
                                        $this->mensaje = "Tipo de beca  encontrado";
                              }else{
                                        $this->mensaje = "No se encontro el tipo de beca";
                              }
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function set($array_data = array()){
                    if(array_key_exists('tip_nombre', $array_data)){
                              $this->get($array_data['tip_nombre']);
                              if($array_data['tip_nombre'] != $this->tip_nombre){
                                        foreach ($array_data as $campo => $valor) {
                                                  $$campo = $valor;
                                        }
                                        
                                        $fecha = date("Y-m-d h:m:s");
                                        if($tip_nombre != ''){
                                          $this->query = "
                                                  INSERT INTO sb_tipo_beca
                                                  (tip_id,tip_nombre,tip_descripcion,tip_fechaCreacion)
                                                  VALUES
                                                  ('$tip_id','$tip_nombre','$tip_descripcion','$fecha')
                                                    ";
                                          $this->execute_single_query();
                                          
                                          $this->mensaje = "Se creo un nuevo tipo de beca";
                                        }else{
                                          $this->mensaje = "Error, faltaron algunos campos que rellenar";
                                        }
                                        
                              }else{
                                        $this->mensaje = "Tipo de beca existente";
                              }
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function edit($array_data = array()){
                    if(array_key_exists('tip_id', $array_data)){
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }

                              if($tip_nombre != ''){
                                $this->query = "
                                        UPDATE sb_tipo_beca
                                        SET tip_nombre ='$tip_nombre',
                                                   tip_descripcion = '$tip_descripcion'
                                           
                                                    WHERE tip_id = '$tip_id'
                                ";
                                $this->execute_single_query();
                                $this->mensaje = "Se actualizo el tipo de beca";
                              }else{
                                $this->mensaje = "Error, algunos campos no se rellenaron";
                              }
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function delete($id = ''){
                    if($id != ''){
                              $this->query = "DELETE FROM sb_tipo_beca
                                        WHERE tip_id ='$id' ";
                              $this->execute_single_query();
                              $this->mensaje = "Se elimino tipo beca";
                    }else{
                              $this->mensaje = "Error";
                    }
          }

           public function mostrar(){
            $this->query = "SELECT * FROM sb_tipo_beca";
            $this->get_results_from_query();
            return $this->rows;
          }

          public function validar_tiempo_real($tip_nombre =''){
            $this->query = "SELECT * FROM sb_tipo_beca
                                           WHERE tip_nombre = '$tip_nombre'                                            
                                        ";
                                 $this->get_results_from_query();
                                 
                                 if(count($this->rows) == 1){
                                           $this->mensaje = "Tipo de beca existente.";
                                           return true;
                                 }else{
                                    return false;
                                 }
          }

          public function to_json(){
            return json_encode(array(
              'tip_id' => $this->tip_id,
              'tip_nombre' => $this->tip_nombre,
              'tip_descripcion' => $this->tip_descripcion,
              'tip_fechaCreacion' => $this->tip_fechaCreacion

              ));
          }
          
          public function getTip_id() {
                    return $this->tip_id;
          }

          public function getTip_nombre() {
                    return $this->tip_nombre;
          }

          public function getTip_descripcion() {
                    return $this->tip_descripcion;
          }

          public function getTipo_fechaCreacion() {
                    return $this->tipo_fechaCreacion;
          }

                    
          function __destruct() {
                    unset($this);
          }
          
}



?>
