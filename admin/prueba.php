<?php 


require_once('../class/universidad/model.php');
require_once('../class/alumno/model.php');
require_once('../class/administrador/model.php');
require_once('../class/programa/model.php');
require_once('../class/tipoBeca/model.php');
require_once('../class/ciclo/model.php');
require_once('../class/becaCiclo/model.php');
require_once('../class/matricula/model.php');
require_once('../class/beca/model.php');
require_once('../class/log/model.php');
require_once('../class/alumnobeca/model.php');




$universidad = new Universidad();
$alumno = new Alumno();
$administrador = new Administrador();
$programa = new Programa();
$tipoBeca = new TipoBeca();
$ciclo = new CicloEscolar();
$becaNueva = new BecaCiclo();
$matricula = new Matricula();
$beca = new Beca();
$alumno_beca = new AlumnoBeca();
$log = new Log();

$array_data_logs = array(
    'log_id'=>'',
    'log_descripcion'=>'Agrego usuario',
    'log_creador' =>'Mario'
    
);
$array_data_universidad= array(
    'uni_id' => '',
    'uni_nombre' => 'URSE',
    'uni_descripcion' => 'Universidad URSE.'
    
);

$array_data_alumno = array(
    'alu_id' => '',
    'alu_nombre' => 'Daniel',
    'alu_apellidoPaterno' => 'Brena',
    'alu_apellidoMaterno' => 'Aquino'
);
 
$array_data_beca = array(
    'bec_id' => 1,
    'bec_fecha_recepcion' => '2014-02-14 12:00:00',
    'bec_programa' => 'Ingenieria en Software.',
    'bec_tipo_beca' => 'Socioeconomica',
    'bec_fechaCita' => '2014-04-11 13:00:00',
    'bec_porcentajeSolicitado' => 20,
    'bec_porcentajeAcordado' => '',
    'bec_pendiente' => 'Le faltaron hojas de luz',
    'bec_observaciones'=> 'Es un joven',
    'bec_grupo' => '');

$array_data_administrador = array(
    'adm_id' => '',
    'adm_nombre' => 'Mario',
    'adm_apellidoPaterno' =>'Brena',
    'adm_apellidoMaterno' => 'Aquino',
    'adm_correo' => 'mario@hotmail.com.com',
    'adm_usuario' => 'admin2',
    'adm_clave' => '12345',
    'adm_permiso' => '1'
);

$array_data_programa = array(
    'pro_id' => 2,
    'pro_nombre' => 'Ingenieria en Software.',
    'pro_descripcion' => 'Carrera de Ingenieria en Software.',
    
);

$array_data_matricula = array(
    'mat_id' => '',
    'mat_programa' => 'Ingenieria Civil.',
    'mat_matricula' => '',
    'mat_bajasAproximacion' => '',
    'mat_reinscripcionEsperada' => ''
    
    
);

$array_data_tipo_beca = array(
    'tip_id' => 1,
    'tip_nombre' => 'Socioeconomica.',
    'tip_descripcion' => 'Ayuda de los alumnos con bajos recursos.'
);

$array_data_ciclo = array(
    'cic_id' => '',
    'cic_fechaInicio' => '2011-01-01',
    'cic_fechaFinal' => '2012-01-01',
    'cic_informacion' => 'Ciclo escolar del año 2012'
);


$array_data_beca_ciclo = array(
    'bnc_id' => 1,
    'bnc_programa' => 'Ingenieria en Software.',
    'bnc_solicitudes' => 0,
    'bnc_alumnosBeneficiados' => '',
    'bnc_becasCienSolicitadas' => '',
    'bnc_becasCienOtorgadas' => '',
    'bnc_becasCienSolicitadasNoDictaminadas' => '',
    'bnc_matriculaEsperada' => '',
    'bnc_becasPresupuestadas' => '',
    'bnc_disponibilidadBecas' => '',
    'bnc_disponibilidadRealBecas' => ''
    );

/*$array_data_beca = array(
    'bec_id' => '',
    'bec_fecha_recepcion' =>'2014-03-25',
    'bec_alumno_fk' => 43,
    'bec_programa_fk' => 1,
    'bec_tipo_beca_fk' => 1,
    'bec_fecha_cita' => '2013-12-12',
    'bec_porcentajeSolicitado' => 40,
    'bec_porcentajeAcordado' => 15,
    'bec_pendiente' => 'papeles de luz',
    'bec_observaciones'=>'...',
    'bec_ciclo_escolar_fk' => 1
    
    
);
*/

$array_data_alumno_beca = array(
    'abc_id' => 1,
    'abc_alumno_fk' => 1,
    'abc_beca_fk' => 1,
    'abc_tipo' => 'Renovacion',
    'abc_activo' => '1'
    );

$ciclo->get('2013-01-01');
print $ciclo->mensaje;
?>