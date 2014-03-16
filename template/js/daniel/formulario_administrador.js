var nombre ;
var apellidoP;
var apellidoM;
var correo;
var usuario;
var permiso;
var clave;


$(document).ready(function(){

	clave = $("#dan-clave").val();

	$('#myModal').on('show', function() {
	    var id = $(this).data('id');
	    var removeBtn = $(this).find('.btn-default');
	});


	$('.confirm-delete').on('click', function(e) {
	   	 e.preventDefault();

	    var id = $(this).data('id');
	    $('#myModal').data('id', id).modal('show');
	});
	


	$('#eliminar').click(function() {
	    $('#myModal').modal('hide');
	  	var id = $('#myModal').data('id');
	  	$.post("../eliminacion/eliminacion_administrador.php",{adm_id: id});
	  	window.location.reload();
	});		
	var interval = setInterval(function(){ actualizar() },500);

});

function actualizar(){
	
	 clave = $("#dan-clave").val();
	 nombre = $("#dan-nombre").val();
	 apellidoP = $("#dan-apellidoP").val();
	 apellidoM = $("#dan-apellidoM").val();
	 correo = $("#dan-correo").val();
	 usuario = $("#dan-usuario").val();
	 permiso = $("#dan-permiso").val();

	 $("#validar_administrador").load('../validacion/validacion_administrador.php?adm_nombre='+nombre+'&adm_usuario='+usuario+'&adm_apellidoPaterno='+apellidoP+'&adm_correo='+correo);

	$("#dan-nombre_").text(nombre);
	$("#dan-apellidoP_").text(apellidoP);
	$("#dan-apellidoM_").text(apellidoM);
	$("#dan-correo_").text(correo);
	$("#dan-usuario_").text(usuario);
	$("#dan-permiso_").text(permiso);

	if($("#validar_administrador").text() != '' || nombre == '' || apellidoP == '' || correo == '' || clave == ''){
		
		$("#enviar").css('display','none');
	}else{
		$("#enviar").css('display','block');
	}
}

