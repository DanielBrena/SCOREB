<?php

/**
 * Description of model
 *
 * @author daniel
 */
require_once ($_SERVER['DOCUMENT_ROOT']."/SCOREB/core/DBAbstractModel.php");
class Beca extends DBAbstractModel {

   protected $bec_id;
   private $bec_asistencia;
   private $bec_recibe;
   private $bec_programa;
   private $bec_tipo_beca;
   private $bec_fechaCita;
   private $bec_porcentajeSolicitado;
   private $bec_porcentajeAcordado;
   private $bec_pendiente;
   private $bec_observaciones;
   private $bec_grupo;
   private $bec_fechaCreacion;

   public function get($id = '') {
      if ($id != '') {
         if (is_int($id)) {
            $this->query = "SELECT * FROM sb_beca WHERE bec_id ='$id' ";
            $this->get_results_from_query();
            if (count($this->rows) == 1) {
               foreach ($this->rows[0] as $propiedad => $valor) {
                        $this->$propiedad = $valor;
                    }
                    $this->mensaje = "beca encontrado";
                } else {
                    $this->mensaje = "No se encontro beca";
                }
            } else {
               $this->mensaje = "Es un string";
            }
        } else {
            $this->mensaje = "Error";
        }
    }

    public function set($array_data = array()) {
         if (array_key_exists('bec_id', $array_data)) {
         foreach ($array_data as $campo => $valor) {
            $$campo = $valor;
         }
         $fecha = date("Y-m-d h:m:s");
         if($bec_programa != '' && $bec_tipo_beca != '' && $bec_recibe != '' && $bec_asistencia  !='' && $bec_fechaCita != '' && $bec_porcentajeSolicitado != ''){
            $this->query = "
               INSERT INTO sb_beca
               (bec_id,bec_asistencia,bec_recibe,bec_programa,bec_tipo_beca,bec_fechaCita,
               bec_porcentajeSolicitado,bec_porcentajeAcordado,bec_pendiente,bec_observaciones,bec_grupo,bec_fechaCreacion)
               VALUES 
               ('$bec_id','$bec_asistencia','$bec_recibe','$bec_programa','$bec_tipo_beca','$bec_fechaCita',
               '$bec_porcentajeSolicitado','$bec_porcentajeAcordado','$bec_pendiente','$bec_observaciones','$bec_grupo','$fecha')                                          
            ";
            $this->execute_single_query();
            $this->mensaje = "Se creo una beca nueva";
            unset($this->rows);
            $this->query = "SELECT bec_id FROM sb_beca WHERE
               bec_asistencia = '$bec_asistencia' AND bec_recibe = '$bec_recibe' AND bec_fechaCita = '$bec_fechaCita'
               AND bec_programa = '$bec_programa' AND bec_tipo_beca = '$bec_tipo_beca'
               AND bec_porcentajeSolicitado = '$bec_porcentajeSolicitado' AND bec_fechaCreacion = '$fecha';
               ";
            $this->get_results_from_query();
            if(count($this->rows) == 1) {
               foreach ($this->rows[0] as $propiedad => $valor) {
                  $this->$propiedad = $valor;
               }
               return $this->bec_id;
            }else{
               return 0;
            }

         }else{
            $this->mensaje = "Error, algunos campos no se rellenaron.";
         }
      } else {
         $this->mensaje = "Error";
      }
   }

   public function edit($array_data = array()) {
      if (array_key_exists('bec_id', $array_data)) {
         foreach ($array_data as $campo => $valor) {
            $$campo = $valor;
         }
         if($bec_programa != '' && $bec_tipo_beca != ''  && $bec_fechaCita != '' && $bec_porcentajeSolicitado != ''){
            $this->query = "
               UPDATE sb_beca
               SET bec_asistencia ='$bec_asistencia',
               bec_recibe = '$bec_recibe',
               bec_programa = '$bec_programa',
               bec_tipo_beca ='$bec_tipo_beca', 
               bec_fechaCita = '$bec_fechaCita',
               bec_porcentajeSolicitado ='$bec_porcentajeSolicitado', 
               bec_porcentajeAcordado = '$bec_porcentajeAcordado',
               bec_pendiente = '$bec_pendiente',
               bec_observaciones = '$bec_observaciones'
               WHERE bec_id = '$bec_id'                                                                                    
            ";
            $this->execute_single_query();
            $this->mensaje = "Se actualizo la beca.";
            }else{
                $this->mensaje = "Error, algunos campos no se rellenaron.";
            }
         }else {
            $this->mensaje = "Error";
      }
   }

   public function actualizarPorcentaje($bec_id ='', $valor = ''){
    $this->query = "UPDATE sb_beca set bec_porcentajeAcordado = '$valor' where bec_id = '$bec_id'";
    $this->execute_single_query();
    $this->mensaje = "Se actulizo el porcentaje.";
   }

    public function delete($id = '') {
         if ($id != '') {
            if (is_int($id)) {
               $this->query = "DELETE FROM sb_beca
               WHERE bec_id ='$id' ";
               $this->execute_single_query();
               $this->mensaje = "Se elimino la beca";
            }     
        }else {
            $this->mensaje = "Error";
        }
    }

    public function getBec_id() {
        return $this->bec_id;
    }

    public function getBec_asistencia() {
        return $this->bec_asistencia;
    }

    public function getBec_recibe() {
        return $this->bec_recibe;
    }

    public function getBec_programa() {
        return $this->bec_programa;
    }

    public function getBec_tipo_beca() {
        return $this->bec_tipo_beca;
    }

    public function getBec_fechaCita() {
        return $this->bec_fechaCita;
    }

  public function getBec_fechaCreacion(){
      return $this->bec_fechaCreacion;
   }

    public function getBec_porcentajeAcordado() {
        return $this->bec_porcentajeAcordado;
    }
    public function getBec_porcentajeSolicitado() {
        return $this->bec_porcentajeSolicitado;
    }

    public function getBec_pendiente() {
        return $this->bec_pendiente;
    }

    public function getBec_observaciones() {
        return $this->bec_observaciones;
    }

    public function getBec_grupo() {
        return $this->bec_grupo;
    }

    function __desctruct() {
        unset($this);
    }

}

?>
