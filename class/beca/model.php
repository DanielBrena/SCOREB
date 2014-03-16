<?php

/**
 * Description of model
 *
 * @author daniel
 */
class Beca extends DBAbstractModel {

    protected $bec_id;
    private $bec_fecha_recepcion;
    private $bec_programa;
    private $bec_tipo_beca;
    private $bec_fechaCita;
    private $bec_porcentajeSolicitado;
    private $bec_porcentajeAcordado;
    private $bec_pendiente;
    private $bec_observaciones;
    private $bec_grupo;

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
                //$this->query = "SELECT * FROM sb_logs WHERE log_creador = '$id'";
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



            $this->query = "
                                                 INSERT INTO sb_beca
                                                 (bec_id,bec_fecha_recepcion,bec_programa,bec_tipo_beca,bec_fechaCita,
                                                 bec_porcentajeSolicitado,bec_porcentajeAcordado,bec_pendiente,bec_observaciones,bec_grupo)
                                                 VALUES 
                                                 ('$bec_id','$bec_fecha_recepcion','$bec_programa','$bec_tipo_beca','$bec_fechaCita',
                                                     '$bec_porcentajeSolicitado','$bec_porcentajeAcordado','$bec_pendiente','$bec_observaciones','$bec_grupo')                                          
                                                ";
            $this->execute_single_query();

            $this->mensaje = "Se creo beca nueva";
        } else {
            $this->mensaje = "Error";
        }
    }

    public function edit($array_data = array()) {
        if (array_key_exists('bec_id', $array_data)) {
            foreach ($array_data as $campo => $valor) {
                $$campo = $valor;
            }
            $this->query = "
                                        UPDATE sb_beca
                                        SET bec_fecha_recepcion ='$bec_fecha_recepcion',
                                                  bec_programa = '$bec_programa',
                                                            bec_tipo_beca ='$bec_tipo_beca', 
                                                                      bec_fechaCita = '$bec_fechaCita',
                                                                                bec_porcentajeSolicitado ='$bec_porcentajeSolicitado', 
                                                                                          bec_porcentajeAcordado = '$bec_porcentajeAcordado',
                                                                                                    bec_pendiente = '$bec_pendiente',
                                                                                                              bec_observaciones = '$bec_observaciones',
                                                                                                                        bec_grupo = '$bec_grupo'
                                            WHERE bec_id = '$bec_id'                                                                                    
                              ";
            $this->execute_single_query();
            $this->mensaje = "Se Actualizo programa";
        } else {
            $this->mensaje = "Error";
        }
    }

    public function delete($id = '') {
        if ($id != '') {
            if (is_int($id)) {
                $this->query = "DELETE FROM sb_beca
                                        WHERE bec_id ='$id' ";
            } else {
                
            }
            $this->execute_single_query();
            $this->mensaje = "Se elimino log";
        } else {
            $this->mensaje = "Error";
        }
    }

    public function getBec_id() {
        return $this->bec_id;
    }

    public function getBec_fecha_recepcion() {
        return $this->bec_fecha_recepcion;
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

    public function getBec_porcentajeSolicitado() {
        return $this->bec_porcentajeSolicitado;
    }

    public function getBec_porcentajeAcordado() {
        return $this->bec_porcentajeAcordado;
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
