<?php 

$link = mysql_connect('localhost', 'root', 'danielbrena2')
    or die('No se pudo conectar: ' . mysql_error());

mysql_select_db('beca') or die('No se pudo seleccionar la base de datos');

if($_POST){
	$q=mysql_real_escape_string(($_POST['searchword']));

	$sql_res=mysql_query("SELECT * FROM vista_beca_alumno WHERE bec_porcentajeAcordado = 0 AND (alu_nombre LIKE '%$q%' OR alu_apellidoPaterno  LIKE '%$q%'  OR alu_apellidoMaterno  LIKE '%$q%')   GROUP BY alu_nombre, alu_apellidoPaterno,alu_apellidoMaterno ");

	while($row=mysql_fetch_array($sql_res))
	{
	
	$bec_id = $row['bec_id'];	
	$nombre=$row['alu_nombre'];
	$apellidoPaterno=$row['alu_apellidoPaterno'];
	$apellidoMaterno=$row['alu_apellidoMaterno'];
	$tipoBeca = $row['tip_nombre'];
	$tipo = $row['abc_tipo'];
	$programa = $row['pro_nombre'];
	$cicloescolar = $row['cic_fechaInicio'];
	$fechacita = $row['bec_fechaCita'];
	$porcentajeS = $row['bec_porcentajeSolicitado'];
	$pendiente = $row['bec_pendiente'];
	$observacion = $row['bec_observaciones'];

	$re_nombre='<b>'.$q.'</b>';
	$re_apellidoPaterno='<b>'.$q.'</b>';
	$final_nombre = str_ireplace($q, $re_nombre, $nombre);
	$final_apellidoPaterno = str_ireplace($q, $re_apellidoPaterno, $apellidoPaterno);

?>

<?php echo "<tr>"; ?>

<?php echo "<td data-id='".$bec_id."'>".$bec_id."</td>" ?>&nbsp;
<?php echo "<td>".$final_nombre."</td>" ?>&nbsp;
<?php echo "<td>".$final_apellidoPaterno. " " .$apellidoMaterno."</td>" ?>&nbsp;
<?php echo "<td>".$programa."</td>" ?>&nbsp;
<?php echo "<td>".$tipoBeca."</td>" ?>&nbsp;
<?php echo "<td>".$tipo."</td>" ?>&nbsp;
<?php echo "<td>".$cicloescolar."</td>" ?>&nbsp;
<?php echo "<td>".$fecharecepcion."</td>" ?>&nbsp;
<?php echo "<td>".$fechacita."</td>" ?>&nbsp;
<?php echo "<td id='p'>".$porcentajeS."</td>" ?>&nbsp;
<?php echo "<td>".$pendiente."</td>" ?>&nbsp;
<?php echo "<td>".$observacion."</td>" ?>&nbsp;
<?php echo "<td><button data-id='".$bec_id."' data-val='".$porcentajeS."' class='btn btn-primary btn-xs confirm-edit'><i class='icon-pencil'></i></button>"?>&nbsp;
<?php echo "</tr>"; ?>
<?php echo "<script type='text/javascript' src='js/app-otorgarbeca1.js'></script>"; ?>
<?php
}
}
else
{}


 ?>