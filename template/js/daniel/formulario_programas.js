var nombre;
var descripcion;
$(document).ready(function(){
	$("#enviar-programa").css('display','none');
	nombre = $("#dan-nombre-programa").val();
	descripcion = $("#dan-descripcion-programa").val();
	$("#tabla_programas").load("../recargar/recargar_tabla_programas.php");
	var interval = setInterval(function(){ actualizar() },500);

	$("#enviar-programa").click(function(){
		$.post("../peticion/peticion_programa.php",{pro_nombre: nombre,pro_descripcion: descripcion}).done(function(){
			$("#tabla_programas").load("../recargar/recargar_tabla_programas.php");
		});
		$("#dan-nombre-programa").val('');
		$("#dan-descripcion-programa").val('');
	});
});


function actualizar(){
	nombre = $("#dan-nombre-programa").val();
	descripcion = $("#dan-descripcion-programa").val();
	console.log(nombre);
	$("#validar-programa").load("../validacion/validacion_programa.php?pro_nombre=" + nombre);
	if($("#validar-programa").text() == '' && nombre != ''  ){
		$("#enviar-programa").css('display','block');
	}else{
		$("#enviar-programa").css('display','none');
	}
}

