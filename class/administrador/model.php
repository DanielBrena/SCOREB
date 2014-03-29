<?php


/**
 * Description of model
 *
 * @author daniel
 * 
 */

require_once ($_SERVER['DOCUMENT_ROOT']."/SCOREB/core/DBAbstractModel.php");
class Administrador extends DBAbstractModel {
          protected  $adm_id;
          private $adm_nombre;
          private $adm_apellidoPaterno;
          private $adm_apellidoMaterno;
          private $adm_correo;
          private $adm_usuario;
          private $adm_clave;
          private $adm_permiso;
          private $adm_fechaCreacion;
          private $adm_estado;
          
          function __construct() {
                    $this->db_name  = "beca";
          }
          public function get($id = ''){
                    if($id != ''){
                              
                              if(is_int($id)){
                                        
                                        $this->query = "
                                                  SELECT * FROM sb_administrador 
                                                  WHERE adm_id = '$id'
                                         ";
                                        
                              }else{
                                        
                                        $this->query = "
                                                  SELECT * FROM sb_administrador
                                                  WHERE adm_correo = '$id' OR adm_usuario = '$id'
                                        ";
                               }
                              $this->get_results_from_query();
                              
                              if(count($this->rows) == 1){
                                        foreach ($this->rows[0] as $propiedad => $valor) {
                                                  $this->$propiedad = $valor;
                                        }
                                        //$this->adm_clave = base64_decode($this->adm_clave);
                                        
                                        $this->mensaje = "Se encontro administrador";
                                        
                              }else{
                                        $this->mensaje = "No se encontro administrador";
                              }
                                        
                                        
                    }else{
                              $this->mensaje = "Error";
                    }
          }
          
          public function set($array_data = array()){
                    if(array_key_exists('adm_correo', $array_data) &&
                            array_key_exists('adm_usuario', $array_data) &&
                               array_key_exists('adm_clave', $array_data)){
                              
                                 foreach ($array_data as $campo => $valor) {
                                           $$campo = $valor;
                                 }
                                 if($adm_nombre != ''  && $adm_apellidoPaterno != '' &&  ($adm_correo != '' && filter_var($adm_correo, FILTER_VALIDATE_EMAIL)) && $adm_usuario != '' && $adm_clave != ''){
                                    $adm_clave = base64_encode($adm_clave);

                                    $this->query = "SELECT * FROM sb_administrador
                                           WHERE adm_nombre = '$adm_nombre' AND adm_apellidoPaterno = '$adm_apellidoPaterno'
                                                     OR adm_correo = '$adm_correo' OR adm_usuario = '$adm_usuario'                                               
                                            ";
                                     $this->get_results_from_query();
                                     
                                     if(count($this->rows) == 1){
                                               $this->mensaje = "Administrador existente";
                                     }else{
                                               unset($this->rows);
                                               
                                               $fecha = date("Y-m-d h:m:s");
                                               
                                               $this->query = "
                                                  INSERT INTO sb_administrador
                                                  (adm_id,adm_nombre,adm_apellidoPaterno,adm_apellidoMaterno,
                                                      adm_correo,adm_usuario,adm_clave,adm_permiso,adm_fechaCreacion,adm_estado)
                                                  VALUES
                                                  ('$adm_id','$adm_nombre','$adm_apellidoPaterno','$adm_apellidoMaterno',
                                                      '$adm_correo','$adm_usuario','$adm_clave','$adm_permiso','$fecha','0')
                                               ";
                                               $this->execute_single_query();
                                               $this->mensaje = "Se ha creado un administrador";
                                     }


                                 }else{
                                    $this->mensaje = "Error, faltan algunos campos que rellenar";
                                 }
                                 
                              
                    }else{
                              $this->mensaje = "Error!";
                    }
          }
          
          public function edit($array_data = array()){
                    if(array_key_exists('adm_id', $array_data)){
                              foreach ($array_data as $campo => $valor) {
                                        $$campo = $valor;
                              }
                              if($adm_nombre != ''  && $adm_apellidoPaterno != '' &&  ($adm_correo != '' && filter_var($adm_correo, FILTER_VALIDATE_EMAIL)) && $adm_usuario != '' && $adm_clave != ''){
                                  $adm_clave = base64_encode($adm_clave);
                                  $this->query = "
                                          UPDATE sb_administrador
                                          SET
                                          adm_nombre = '$adm_nombre',
                                                    adm_apellidoPaterno = '$adm_apellidoPaterno',
                                                              adm_apellidoMaterno = '$adm_apellidoMaterno',
                                                                        adm_correo = '$adm_correo',
                                                                                  adm_usuario = '$adm_usuario',
                                                                                            adm_clave = '$adm_clave',
                                                                                                      adm_permiso = '$adm_permiso'
                                                                                                                
                                                                                                      WHERE adm_id ='$adm_id'
                                                                                  
                                  ";
                                $this->execute_single_query();
                                $this->mensaje = "Se actualizo administrador";
                              }else{
                                $this->mensaje =  "Error, faltaron algunos campos obligatorios que rellenar.";
                              }
                              
                    }else{
                              $this->mensaje = "Error";
                    }
                    
          }
          
         
          public function delete($id =''){
                    if($id != ''){
                              $this->query = "DELETE FROM sb_administrador 
                                        WHERE adm_id = '$id'";
                              $this->execute_single_query();
                              $this->mensaje = "Administrador eliminado";
                              
                    }else{
                              $this->mensaje = "Error";
                    }
          }

          public function login($admin = '',$clave = ''){
            if($admin != '' && $clave != ''){
              $clave = base64_encode($clave);
              $this->query = "SELECT * FROM sb_administrador
              WHERE adm_correo = '$admin' OR adm_usuario = '$admin' AND adm_clave = '$clave'";
              $this->get_results_from_query();

              if(count($this->rows) == 1){
                foreach ($this->rows[0] as $propiedad => $valor) {
                  $this->$propiedad = $valor;
                }
                $this->mensaje = "Se econtro";
                return true;
              }else{
                $this->mensahe = "No se encontro";
                return false;
              }
            }else{
              $this->mensaje = "Error";
              return false;
            }
          }

          public function validar_tiempo_real($adm_nombre ='',$adm_usuario ='',$adm_apellidoPaterno = '',$adm_correo = ''){
            $this->query = "SELECT * FROM sb_administrador
                                           WHERE adm_nombre = '$adm_nombre' AND adm_apellidoPaterno = '$adm_apellidoPaterno'
                                                     OR adm_correo = '$adm_correo' OR adm_usuario = '$adm_usuario'                                               
                                        ";
                                 $this->get_results_from_query();
                                 
                                 if(count($this->rows) == 1){
                                           $this->mensaje = "Administrador existente, puede que el Nombre, Usuario o Correo ya estan en uso.";
                                           return true;
                                 }else{
                                    $this->mensaje = "undefined";
                                    return false;
                                 }
          }

          public function mostrar(){
            $this->query = "SELECT * FROM sb_administrador";
            $this->get_results_from_query();
            return $this->rows;
          }

          public function changeStatus($id = '', $opcion = ''){
            
              if(is_int($id)){
                if($opcion == 1){
                  $this->query = "UPDATE sb_administrador SET adm_estado = '1' WHERE adm_id = '$id'";
                  $this->execute_single_query();
                  $this->mensaje = "Administrador activo";
                }else{
                  $this->query = "UPDATE sb_administrador SET adm_estado = '0' WHERE adm_id = '$id'";
                  $this->execute_single_query();
                  $this->mensaje = "Administrador activo";
                }
              }else{
                $this->mensaje = "Error";
              }
            
          }

          public function to_json(){
            return json_encode(array(
              'adm_id' => $this->adm_id,
              'adm_nombre' => $this->adm_nombre,
              'adm_apellidoPaterno' => $this->adm_apellidoPaterno,
              'adm_apellidoMaterno' => $this->adm_apellidoMaterno,
              'adm_correo' => $this->adm_correo,
              'adm_usuario' => $this->adm_usuario,
              'adm_clave' =>  base64_decode($this->adm_clave),
              'adm_permiso' => $this->adm_permiso,
              'adm_fechaCreacion' => $this->adm_fechaCreacion,
              'adm_estado' => $this->adm_estado

              ));
          }
          
          public function getAdm_id() {
                    return $this->adm_id;
          }

          public function getAdm_nombre() {
                    return $this->adm_nombre;
          }

          public function getAdm_apellidoPaterno() {
                    return $this->adm_apellidoPaterno;
          }

          public function getAdm_apellidoMaterno() {
                    return $this->adm_apellidoMaterno;
          }

          public function getAdm_correo() {
                    return $this->adm_correo;
          }

          public function getAdm_usuario() {
                    return $this->adm_usuario;
          }

          public function getAdm_clave() {
                    return $this->adm_clave;
          }

          public function getAdm_permiso() {
                    return $this->adm_permiso;
          }

          public function getAdm_fechaCreacion() {
                    return $this->adm_fechaCreacion;
          }

          public function getAdm_estado() {
                    return $this->adm_estado;
          }

          function __destruct() {
                    unset($this);
          }
          
          
          
}

?>
