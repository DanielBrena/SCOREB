$(document).ready(function(){
	
	var idPagina = $("body").attr('data-page');
	
	switch(idPagina){
		case 'index':
			paginaIndex();

		break;

		case 'administradores' : 

			paginaAdministradores();

		break;
	}

});

function paginaIndex(){
	console.log("Pagina de inicio");

}

function paginaAdministradores(){
	console.log("Pagina de administradores");
	var administrador = {};
	
	var validacion = false;

	$(document).keypress(function(e){

			if(e.which == 82){
				console.log(2);

				$("#modal-show").html(modal("Recuperar","Tal vez hubo un problema en el sistema, pero se guardo el ultimo registro."));
				$("#modal-mostrar").modal('show');
				$("#aceptar").click(function(){
					$("#modal-mostrar").modal('hide');
					recovery_administradores();
				});				
			}
			
		});

	var interval = setInterval(function(){
		
		administrador.nombre = $("#adm-nombre-1").val();
		administrador.apellidoPaterno = $("#adm-apellido_paterno-1").val();
		administrador.apellidoMaterno = $("#adm-apellido_materno-1").val();
		administrador.correo = $("#adm-correo-1").val();
		administrador.usuario = $("#adm-usuario-1").val();
		administrador.clave = $("#adm-clave-1").val();
		administrador.permiso = $("#adm-permiso-1").val();
		administrador.action = 'crear';

		administrador_validar = {};
		administrador_validar.action = 'validar';
		administrador_validar.nombre = administrador.nombre;
		administrador_validar.apellidoPaterno = administrador.apellidoPaterno;
		administrador_validar.usuario = administrador.usuario;
		administrador_validar.correo = administrador.correo;

		expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		$.post("crud/crud.php",administrador_validar,function(data){
				if(typeof data.mensaje != "string"){
				validacion = true;
				console.log("si");				

			}else{
				validacion = false;
				console.log("no");
			}

			$.gritter.add({     
		   				title: "Tenemos un problema!",      
		 				text: data.mensaje,
		   				sticky: true,
		    			time: "",
		    			class_name: "my-sticky-class",
		    			before_open: function(){
		    				if($(".gritter-item-wrapper").length == 1){return false;}}
						});
		},'json');
			
		
		if(administrador.nombre != '' && administrador.apellidoPaterno != '' && administrador.correo != '' && expr.test(administrador.correo)  && administrador.clave !='' && !validacion){
			$("#adm-enviar-1").css('display','block');
			var administrador_recuperar = administrador;
			administrador_recuperar = JSON.stringify(administrador_recuperar);
			localStorage.setItem('administrador_recovery',administrador_recuperar);
		}else{
			$("#adm-enviar-1").css('display','none');
		}

	},1000);

	$("#adm-enviar-1").click(function(){
		if(administrador.nombre != '' && administrador.apellidoPaterno != '' && administrador.correo != '' && administrador.clave !=''){
			console.log("Validado");
			clearInterval(interval);
			$.post("crud/crud.php",administrador,function(data){
				clear_administradores();
				
				$("#modal-show").html(modal("Mensaje del sistema", data.mensaje));
				
				$("#modal-mostrar").modal("show");

			},'json').done(function(){
				$("#aceptar").click(function(){
					$("#modal-mostrar").modal("hide");
					paginaAdministradores();
				});
			});
			
			
				
		}else{
			console.log("Mal");
		}
	});
	
	$.post('crud/crud.php',{action:'mostrar'},function(data){
		$.each(data['rows'], function(key, val) {
        //valResp=valResp+'<li id="' + key + '">' + val + '</li>';
        	console.log(val);
        });
	},'ajax');
}

/**
	Modal para mostrar el exito o error al agregar
*/

function modal(titulo, mensaje){
	var resultado = '';
	resultado += '<div class="modal fade" id="modal-mostrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
    resultado += '<div class="modal-dialog">';
	resultado += '<div class="modal-content">';
	resultado += '<div class="modal-header">';
	resultado += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
	resultado += '<h4 class="modal-title">'+ titulo +'</h4>';
	resultado += '</div>';
	resultado += '<div class="modal-body">'
	resultado += mensaje;
 	resultado += '</div>';
	resultado += '<div class="modal-footer">';
	resultado += '<button id="aceptar" class="btn btn-danger" type="button"> Aceptar</button>';
	resultado += '</div';
	resultado += '</div>';
	resultado += '</div>';
	resultado += '</div> ';
	return resultado;
}

function clear_administradores(){
	
	$("#adm-nombre-1").val('');
	$("#adm-apellido_paterno-1").val('');
	$("#adm-apellido_materno-1").val('');
	$("#adm-correo-1").val('');
	$("#adm-usuario-1").val('');
	$("#adm-clave-1").val('');
}

function recovery_administradores(){
	var resultado = localStorage.getItem('administrador_recovery');
	var aux = JSON.parse(resultado);
	$("#adm-nombre-1").val(aux.nombre);
	$("#adm-apellido_paterno-1").val(aux.apellidoPaterno);
	$("#adm-apellido_materno-1").val(aux.apellidoMaterno);
	$("#adm-correo-1").val(aux.correo);
	$("#adm-usuario-1").val(aux.usuario);
	$("#adm-clave-1").val('');
}