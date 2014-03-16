var fechaInicio = '';
var fechaFinal = '';
var informacion;
$(document).ready(function(){
	$("#enviar-ciclo-escolar").css('display','none');
	fechaInicio= $("#dan-fechaInicio-ciclo-escolar").val();
		fechaInicio = fechaInicio.split("-");
		fechaInicio = fechaInicio[2]+"-"+fechaInicio[1]+"-"+fechaInicio[0];
		fechaFinal =$("#dan-fechaFinal-ciclo-escolar").val();
		fechaFinal = fechaFinal.split("-");
		fechaFinal = fechaFinal[2]+"-"+fechaFinal[1]+"-"+fechaFinal[0];
	informacion = $("#dan-informacion-ciclo-escolar").val();
	$("#tabla_ciclo_escolar").load("../recargar/recargar_tabla_ciclo_escolar.php");

	var interval = setInterval(function(){ actualizar() },500);

	$("#enviar-ciclo-escolar").click(function(){
		$.post("../peticion/peticion_ciclo_escolar.php",{cic_fechaInicio: fechaInicio,cic_fechaFinal: fechaFinal,cic_informacion:informacion}).done(function(){
			$("#tabla_ciclo_escolar").load("../recargar/recargar_tabla_ciclo_escolar.php");
		});
		$("#dan-fechaInicio-ciclo-escolar").val('');
		$("#dan-fechaFinal-ciclo-escolar").val('');
		$("#dan-informacion-ciclo-escolar").val('');

	});
});


function actualizar(){
		fechaInicio= $("#dan-fechaInicio-ciclo-escolar").val();
		if(fechaInicio != ''){
			fechaInicio = fechaInicio.split("-");
			fechaInicio = fechaInicio[2]+"-"+fechaInicio[1]+"-"+fechaInicio[0];
			$("#validar-ciclo-escolar").load("../validacion/validacion_ciclo_escolar.php?cic_fechaInicio=" + fechaInicio);
			console.log("fechainicio " +fechaInicio);
		}
		

		fechaFinal =$("#dan-fechaFinal-ciclo-escolar").val();
		fechaFinal = fechaFinal.split("-");
		fechaFinal = fechaFinal[2]+"-"+fechaFinal[1]+"-"+fechaFinal[0];
		informacion = $("#dan-informacion-ciclo-escolar").val();
		console.log(fechaInicio);
	//$("#validar-ciclo-escolar").load("../validacion/validacion_ciclo_escolar.php?cic_fechaInicio=" + fechaInicio);
	if($("#validar-ciclo-escolar").text() == '' && fechaInicio != ''  ){
		$("#enviar-ciclo-escolar").css('display','block');
	}else{
		$("#enviar-ciclo-escolar").css('display','none');
	}
}

