var actualizar;
var administrador = {};

$(document).ready(function(){
	//actualizar = false;
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
	//var administrador = {};
	
	var validacion = false;
	
	show_table_administradores();

	

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
		administrador.id = $("#adm-id-1").val();
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

		$.post("crud/crud_administradores.php",administrador_validar,function(data){
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
			
		
		if( valida_administradores() /*administrador.nombre != '' && administrador.apellidoPaterno != '' && administrador.correo != '' && expr.test(administrador.correo)  && administrador.clave !=''*/ && !validacion){
			$("#adm-enviar-1").css('display','block');
			var administrador_recuperar = administrador;
			administrador_recuperar = JSON.stringify(administrador_recuperar);
			localStorage.setItem('administrador_recovery',administrador_recuperar);
		}else{
			$("#adm-enviar-1").css('display','none');
		}

	},1000);


	//if( $("#adm-enviar-1").text() == "Enviar"){
		$("#adm-enviar-1").click(function(){
			if( valida_administradores() /*administrador.nombre != '' && administrador.apellidoPaterno != '' && administrador.correo != '' && administrador.clave !=''*/ ){
				console.log("Validado");
				clearInterval(interval);

				
					console.log("Enviar");
					$.post("crud/crud_administradores.php",administrador,function(data){
						clear_administradores();
						//actualizar = false;
						$("#modal-show").html(modal("Mensaje del sistema", data.mensaje));
						
						$("#modal-mostrar").modal("show");

					},'json').done(function(){
						$("#aceptar").click(function(){
							$("#modal-mostrar").modal("hide");
							paginaAdministradores();
						});
					});

				/*else{
					console.log("Actualizar");

					administrador.action = 'actualizar';

					$.post("crud/crud.php",administrador,function(data){
						clear_administradores();
						actualizar = false;
						$("#modal-show").html(modal("Mensaje del sistema", data.mensaje));
						
						$("#modal-mostrar").modal("show");

					},'json').done(function(){
						$("#aceptar").click(function(){
							$("#modal-mostrar").modal("hide");

							paginaAdministradores();
						});
					});
				}*/
				
					
			}else{
				console.log("Mal");
			}
		});
	//}else{
		//console.log("Actualizar presionado");
	//}

	
	$(".confirm-edit").click(function(){
			
			//actualizar = true;
			$("#adm-cancelar-1").css('display','block');
			$("#adm-enviar-1").attr('class','btn btn-primary');
			$("#adm-enviar-1").text("Actualizar");
			$("#adm-enviar-1").attr('id','adm-actualizar-1');
			$("#adm-actualizar-1").css("display",'block');

			

			var adm_id= $(this).attr('data-id');
			console.log(adm_id);

			console.log("Editar");
			$.post("crud/crud_administradores.php",{action:'get',id:adm_id},function(data){
				//console.log(data['adm_nombre']);
				$("#adm-id-1").val(data['adm_id']);
				$("#adm-nombre-1").val(data['adm_nombre']);
				$("#adm-apellido_paterno-1").val(data['adm_apellidoPaterno']);
				$("#adm-apellido_materno-1").val(data['adm_nombre']);
				$("#adm-correo-1").val(data['adm_correo']);
				$("#adm-usuario-1").val(data['adm_usuario']);
				$("#adm-clave-1").val(data['adm_clave']);
				$("#adm-permiso-1").val(data['adm_permiso']);

			},'json').done(function(){

				

			});
		});
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

function valida_administradores(){
	var valida = false;
	if( $("#adm-nombre-1").val() != '' && $("#adm-apellido_paterno-1").val() != '' && $("#adm-correo-1").val() !='' && $("#adm-usuario-1").val() != '' && $("#adm-clave-1").val() != ''){
		valida = true;
	}
	return valida;
		
}
function clear_administradores(){
	$("#adm-id-1").val('');
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
	$("#adm-id-1").val(aux.id);
	$("#adm-nombre-1").val(aux.nombre);
	$("#adm-apellido_paterno-1").val(aux.apellidoPaterno);
	$("#adm-apellido_materno-1").val(aux.apellidoMaterno);
	$("#adm-correo-1").val(aux.correo);
	$("#adm-usuario-1").val(aux.usuario);
	$("#adm-clave-1").val('');
	$("#adm_permiso-2").val(aux.permiso);
}

function show_table_administradores(){
	
	$.post('crud/crud_administradores.php',{action:'mostrar'},function(data){
		var resultado = '';
		for(var i = 0; i < data.length; i++){
			resultado += data[i]['adm_id'];
			resultado += '<tr>';
				resultado += '<td>'+data[i]['adm_permiso']+'</td>';
			    resultado += '<td class="hidden-phone">'+data[i]['adm_nombre']+" "+data[i]['adm_apellidoPaterno']+'</td>';
			    resultado += '<td class="hidden-phone">'+data[i]['adm_correo']+'</td>';
			    resultado += '<td><spam class="label label-info label-mini">'+data[i]['adm_estado']+'</spam></td>';
				resultado += '<td>';
				resultado += '<button data-id="'+data[i]['adm_id']+'"  class="btn btn-primary btn-xs confirm-edit"><i class="icon-pencil "></i></button>';
			 	resultado += '<button data-id="'+data[i]['adm_id']+'" class="btn btn-danger btn-xs confirm-delete"><i  class="icon-trash"></i></button>';
			    resultado += '</td>';
			resultado += '<tr>';
		}
		$("#adm-table-administradores").html(resultado);
	},'json').done(function(){
		


	});

	/**
		Editar
		*/
		

		$("#adm-actualizar-1").click(function(){
					console.log("presionado")
				});

	$("#adm-cancelar-1").click(function(){
				//actualizar = false;
				$("#adm-actualizar-1").attr('id','adm-enviar-1');
				$("#adm-cancelar-1").css('display','none');
				$("#adm-enviar-1").attr('class','btn btn-danger');

				$("#adm-enviar-1").text("Enviar");
				//$("#adm-enviar-1").css('display','none');

				clear_administradores();
				//paginaAdministradores();
			});

			

		/**
		Eliminar
		*/

}