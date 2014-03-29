<?php


/**
 * Description of model
 *
 * @author daniel
 */
require_once ($_SERVER['DOCUMENT_ROOT']."/SCOREB/core/DBAbstractModel.php");
class BecaCiclo extends DBAbstractModel{
    
    protected $bnc_id;
    private $bnc_programa;
    private $bnc_solicitudes;
    private $bnc_alumnosBeneficiados;
    private $bnc_becasCienSolicitadas;
    private $bnc_becasCienOtorgadas;
    private $bnc_becasCienSolicitadasNoDictaminadas;
    private $bnc_matriculaEsperada;
    private $bnc_becasPresupuestadas;
    private $bnc_disponibilidadBecas;
    private $bnc_disponibilidadRealBecas;
    private $bnc_ciclo_escolar_fk;
    
    
    function __construct(){
        $this->db_name = "beca";
    }
    public function get($id = ''){
        if($id != ''){
           
            if(is_int($id)){
                $this->query = "
              SELECT * FROM sb_beca_ciclo
              WHERE bnc_id = '$id'
            ";
                $this->get_results_from_query();
                
                if(count($this->rows) == 1){
                    
                    foreach ($this->rows[0] as $propiedad => $valor) {
                        $this->$propiedad = $valor;
                    }
                    $this->mensaje = "Beca ciclo encontrada";
                }else{
                    $this->mensaje = "Beca no encontrada";
                }
                
            }
            
        }else{
            $this->mensaje = "Error";
        }
    }
    public function set($array_data = array()){
        
        if(array_key_exists('bnc_id', $array_data)){
            
           // $this->get($array_data['bnc_id']);
            
           // if($array_data['bnc_id'] != $this->bnc_id){
               
                foreach ($array_data as $campo => $valor) {
                    $$campo = $valor;
                }
                
                 $ciclo_actual = new CicloEscolar();
            
            
                $ciclo_actual->getActivo();
                $id = $ciclo_actual->getCic_id();
                
                $this->query = "
                 SELECT * FROM sb_beca_ciclo
                 WHERE bnc_programa = '$bnc_programa' AND bnc_ciclo_escolar_fk = '$id'
                     
                 ";
                
                $this->get_results_from_query();
                
                if(count($this->rows) == 1){
                    $this->mensaje = "Ya existe";
                }else{
                
                    unset($this->rows);
                    
                    $this->query = "
                        INSERT INTO sb_beca_ciclo
                        (bnc_id, bnc_programa,bnc_solicitudes,bnc_alumnosBeneficiados,bnc_becasCienSolicitadas,bnc_becasCienOtorgadas,
                          bnc_becasCienSolicitadasNoDictaminadas,bnc_matriculaEsperada,bnc_becasPresupuestadas,
                              bnc_disponibilidadBecas,bnc_disponibilidadRealBecas,bnc_ciclo_escolar_fk)
                        VALUES
                        ('$bnc_id','$bnc_programa','$bnc_solicitudes','$bnc_alumnosBeneficiados','$bnc_becasCienSolicitadas','$bnc_becasCienOtorgadas',
                          '$bnc_becasCienSolicitadasNoDictaminadas','$bnc_matriculaEsperada','$bnc_becasPresupuestadas',
                              '$bnc_disponibilidadBecas','$bnc_disponibilidadRealBecas','$id')
                    ";
                    $this->execute_single_query();
                    $this->mensaje = "Se creo becas ciclo";
                }
                
           
            
        }else {
            $this->mensaje = "Error";
        }
        
        
        
    }
    public function edit($array_data = array()){
        if(array_key_exists('bnc_id', $array_data)){
            
            foreach ($array_data as $campo => $valor) {
                $$campo = $valor;
            }
            $this->query = "
              UPDATE sb_beca_ciclo
              SET
               bnc_programa = '$bnc_programa',
                   bnc_solicitudes = '$bnc_solicitudes',
                       bnc_alumnosBeneficiados = '$bnc_alumnosBeneficiados',
                           bnc_becasCienSolicitadas = '$bnc_becasCienSolicitadas',
                           bnc_becasCienOtorgadas = '$bnc_becasCienOtorgadas',
                      bnc_becasCienSolicitadasNoDictaminadas = '$bnc_becasCienSolicitadasNoDictaminadas',
                          bnc_matriculaEsperada = '$bnc_matriculaEsperada',
                              bnc_becasPresupuestadas = '$bnc_becasPresupuestadas',
                          bnc_disponibilidadBecas = '$bnc_disponibilidadBecas',
                              bnc_disponibilidadRealBecas ='$bnc_disponibilidadRealBecas'
                 WHERE bnc_id = '$bnc_id'                 
              
            ";
            $this->execute_single_query();
            $this->mensaje = "Se actualizo beca_ciclo";
            
            
        }else{
            $this->mensaje = "Error";
        }
    }
    
    public function delete($id = ''){
        if($id != ''){
            if(is_int($id)){
                $this->query = "DELETE FROM sb_beca_ciclo
                    WHERE bnc_id = '$id'";
                $this->execute_single_query();
                $this->mensaje = "Se elimina beca ciclo";
            }
            
        }else{
            $this->mensaje = "Error";
        }
    }
    
    public function getBnc_id() {
        return $this->bnc_id;
    }

    public function getBnc_programa() {
        return $this->bnc_programa;
    }

    public function getBnc_solicitudes() {
        return $this->bnc_solicitudes;
    }

    public function getBnc_alumnosBeneficiados() {
        return $this->bnc_alumnosBeneficiados;
    }

    public function getBnc_becasCienSolicitadas() {
        return $this->bnc_becasCienSolicitadas;
    }

    public function getBnc_becasCienOtorgadas() {
        return $this->bnc_becasCienOtorgadas;
    }

    public function getBnc_becasCienSolicitadasNoDictaminadas() {
        return $this->bnc_becasCienSolicitadasNoDictaminadas;
    }

    public function getBnc_matriculaEsperada() {
        return $this->bnc_matriculaEsperada;
    }

    public function getBnc_becasPresupuestadas() {
        return $this->bnc_becasPresupuestadas;
    }

    public function getBnc_disponibilidadBecas() {
        return $this->bnc_disponibilidadBecas;
    }

    public function getBnc_disponibilidadRealBecas() {
        return $this->bnc_disponibilidadRealBecas;
    }

    public function getBnc_ciclo_escolar_fk() {
        return $this->bnc_ciclo_escolar_fk;
    }

        
    function __destruct(){
        
    }
}

?>
