var nombre;
var descripcion;
$(document).ready(function(){
	$("#enviar-tipo-beca").css('display','none');
	nombre = $("#dan-nombre-tipo-beca").val();
	descripcion = $("#dan-descripcion-tipo-beca").val();
	$("#tabla_tipo_becas").load("../recargar/recargar_tabla_tipo_beca.php");
	var interval = setInterval(function(){ actualizar() },500);

	$("#enviar-tipo-beca").click(function(){
		$.post("../peticion/peticion_tipo_beca.php",{tip_nombre: nombre,tip_descripcion: descripcion}).done(function(){
			$("#tabla_tipo_becas").load("../recargar/recargar_tabla_tipo_beca.php");
		});
		$("#dan-nombre-tipo-beca").val('');
		$("#dan-descripcion-tipo-beca").val('');
	});
});


function actualizar(){
	nombre = $("#dan-nombre-tipo-beca").val();
	descripcion = $("#dan-descripcion-tipo-beca").val();
	$("#validar-tipo-beca").load("../validacion/validacion_tipo_beca.php?tip_nombre=" + nombre);
	if($("#validar-tipo-beca").text() == '' && nombre != ''  ){
		$("#enviar-tipo-beca").css('display','block');
	}else{
		$("#enviar-tipo-beca").css('display','none');
	}
}

