<?php

/**
 * Description of model
 *
 * @author daniel
 */
require_once ("../core/DBAbstractModel.php");
require_once ("../class/ciclo/model.php");

class Matricula extends DBAbstractModel {

    protected $mat_id;
    private $mat_programa;
    private $mat_matricula;
    private $mat_bajasAproximacion;
    private $mat_reinscripcionEsperada;
    private $mat_ciclo_escolar_fk;

    function __construct() {
        $this->db_name = "beca";
    }

    public function get($id = '') {
        if ($id != '') {
            // if(is_int($id)){

            $this->query = "SELECT * FROM sb_matricula WHERE mat_id ='$id'";

            $this->get_results_from_query();

            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad => $valor) {
                    $this->$propiedad = $valor;
                }
                $this->mensaje = "matricula encontrado";
            } else {
                $this->mensaje = "No se encontro matricula";
            }


            // }else{
            //     $this->mensaje = "Parametro es string";   
            //}
        } else {
            $this->mensaje = "Error";
        }
    }

    public function set($array_data = array()) {
        if (array_key_exists('mat_id', $array_data)) {



            foreach ($array_data as $campo => $valor) {
                $$campo = $valor;
            }

            $ciclo_actual = new CicloEscolar();
            
            
            $ciclo_actual->getActivo();
            $id = $ciclo_actual->getCic_id();
            
            $this->query = "
                SELECT * FROM sb_matricula WHERE mat_programa = '$mat_programa' AND mat_ciclo_escolar_fk = '$id'
            ";
            $this->get_results_from_query();
            if(count($this->rows) == 1){
                $this->mensaje = "Ya existe esa matricula";
            }else{
                unset($this->rows);
                
                $this->query = "
                                                  INSERT INTO sb_matricula
                                                  (mat_id,mat_programa,mat_matricula,mat_bajasAproximacion,mat_reinscripcionEsperada, mat_ciclo_escolar_fk)
                                                  VALUES
                                                  ('$mat_id','$mat_programa','$mat_matricula','$mat_bajasAproximacion','$mat_reinscripcionEsperada','$id')
                                                  ";
                $this->execute_single_query();
                $this->mensaje = "Se creo matricula";
            }
            
            

            
        } else {
            $this->mensaje = "Error";
        }
    }

    public function edit($array_data = array()) {
        if (array_key_exists('mat_id', $array_data)) {
            foreach ($array_data as $campo => $valor) {
                $$campo = $valor;
            }
            $this->query = "
                                        UPDATE sb_matricula
                                        SET  mat_programa ='$mat_programa',
                                                 mat_matricula = '$mat_matricula',
                                                           mat_bajasAproximacion = '$mat_aproximacion',
                                                                     mat_reinscripcionEsperada = '$mat_reinscripcionAproximacion'
                                                   
                                         
                                                  WHERE mat_id = '$mat_id'
                              ";
            $this->execute_single_query();
            $this->mensaje = "Se Actualizo tipo beca";
        } else {
            $this->mensaje = "Error";
        }
    }

    public function delete($id = '') {
        if ($id != '') {
            $this->query = "DELETE FROM sb_matricula
                                        WHERE mat_id ='$id' ";
            $this->execute_single_query();
            $this->mensaje = "Se elimino tipo beca";
        } else {
            $this->mensaje = "Error";
        }
    }

    public function getMat_id() {
        return $this->mat_id;
    }

    public function getMat_programa() {
        return $this->mat_programa;
    }

    public function getMat_matricula() {
        return $this->mat_matricula;
    }

    public function getMat_bajasAproximacion() {
        return $this->mat_bajasAproximacion;
    }

    public function getMat_reinscripcionEsperada() {
        return $this->mat_reinscripcionEsperada;
    }

    public function getMat_ciclo_escolar_fk() {
        return $this->mat_ciclo_escolar_fk;
    }

    function __destruct() {
        unset($this);
    }

}

?>
