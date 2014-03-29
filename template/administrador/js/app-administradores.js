App = {};
	
	administrador = {};
	var valido = false;
	var recargar = true;

	App.init = function(){
		App.module.actionAdministrador.init();
		App.module.actionTabla.init();
		App.module.actionRecargar.init();
		App.module.actionAgregarAdministrador.init();

		$("#adm-enviar-1").on('click', function(){
			App.module.actionAgregarAdministrador.init();
		})

	}

	App.module = {

		actionTabla:{},
		actionAdministrador:{},
		actionValidar:{},
		actionRecargar:{},
		actionAgregarAdministrador:{},
		actionModal:{},
		actionBorrarCampos:{},
		actionEjemplo:{},
		actionEliminar:{},
		actionActualizar:{},
		actionActualizar2:{}

	}
	
	App.module.actionAgregarAdministrador.init = function(){

		function valida_administradores(){
			var valida = false;
			if( $("#adm-nombre-1").val() != '' && $("#adm-apellido_paterno-1").val() != '' && $("#adm-correo-1").val() !='' && $("#adm-usuario-1").val() != '' && $("#adm-clave-1").val() != ''){
				valida = true;
			}
			return valida;
				
		}
		expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; 

			if(valida_administradores() && valido && expr.test(administrador.correo)){
				recargar = false;
				App.module.actionAdministrador.init();
				administrador.action = 'crear';

				$.post("crud/crud_administradores.php",administrador,function(data){

					App.module.actionBorrarCampos.init();
					$("#modal-show").html( App.module.actionModal.init("Mensaje del sistema", data.mensaje) );
					$("#modal-mostrar").modal("show");

				},'json').done(function(){
					$("#aceptar").click(function(){
						$("#modal-mostrar").modal("hide");
							App.module.actionTabla.init();
							recargar = true;
						});
					});
				
			}else{
		}
	}

	App.module.actionEliminar.init = function(){
		$(".confirm-delete").on('click',function(){
			var adm_id = $(this).attr('data-id');
			$("#modal-show").html( App.module.actionModal.init("Eliminar", "¿Desea eliminar al administrador?") );
			$("#modal-mostrar").modal("show");
			$("#cancelar").click(function(){
				$("#modal-mostrar").modal('hide');
			});
			$("#aceptar").click(function(){
				$.post("crud/crud_administradores.php",{action:'eliminar',id:adm_id,admin:administrador.admin}).done(function(data){
					
					$("#modal-mostrar").modal('hide');
					App.module.actionTabla.init();

				},'json');
			});
		});
	}

	App.module.actionActualizar2.init = function(){

	   	$("#adm-cancelar-1").click(function(){
	   		$("#adm-enviar-1").css('display','block');
			$("#adm-actualizar-1").css('display','none');
			$("#adm-cancelar-1").css('display','none');
			App.module.actionBorrarCampos.init();
			recargar = true;
	   	});

	   	
	    $("#modal-show").html(App.module.actionModal.init("Actualizar", "¿Desea actualizar al administrador?"));
		$("#adm-actualizar-1").click(function(){

			recargar = false;

				$("#modal-mostrar").modal("show");
				$("#cancelar").click(function(){
					$("#modal-mostrar").modal('hide');
					App.module.actionBorrarCampos.init();
					$("#adm-enviar-1").css('display','block');
					$("#adm-actualizar-1").css('display','none');
					$("#adm-cancelar-1").css('display','none');
					recargar = true;
				});
				$("#aceptar").click(function(){
					recargar = false;
					App.module.actionAdministrador.init();
					administrador.action = 'actualizar';

					$.post("crud/crud_administradores.php",administrador,function(data){

						App.module.actionBorrarCampos.init();

						$.gritter.add({     
							title: "Mensaje del sistema",      
							text: data.mensaje,
							sticky: true,
							time: "",
							class_name: "my-sticky-class",
							before_open: function(){

								if($(".gritter-item-wrapper").length == 1){return false;}}
								
							});
					},'json').done(function(){

						recargar = true;
						$("#adm-enviar-1").css('display','block');
						$("#adm-actualizar-1").css('display','none');
						$("#adm-cancelar-1").css('display','none');
						$("#modal-mostrar").modal('hide');
						App.module.actionTabla.init();

					});

				});
			});
	}

	App.module.actionActualizar.init = function(){
		
		$(".confirm-edit").click(function(){

			recargar = false;
			var adm_id = $(this).attr('data-id');
			$("#adm-enviar-1").css('display','none');
			$("#adm-actualizar-1").css('display','block');
			$("#adm-cancelar-1").css('display','block');

			$.post("crud/crud_administradores.php",{action:'get',id:adm_id},function(data){

				$("#adm-id-1").val(data['adm_id']);
				$("#adm-nombre-1").val(data['adm_nombre']);
				$("#adm-apellido_paterno-1").val(data['adm_apellidoPaterno']);
				$("#adm-apellido_materno-1").val(data['adm_nombre']);
				$("#adm-correo-1").val(data['adm_correo']);
				$("#adm-usuario-1").val(data['adm_usuario']);
				$("#adm-clave-1").val(data['adm_clave']);
				$("#adm-permiso-1").val(data['adm_permiso']);

			},'json').done(function(){

				App.module.actionActualizar2.init();

			});

			

		});
	}

	App.module.actionModal.init = function(titulo,mensaje){
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
		if(titulo == 'Eliminar' || titulo == 'Actualizar'){
			resultado += '<button id="cancelar" class="btn btn-default" type="button">Cancelar</button>';
		}
		resultado += '<button id="aceptar" class="btn btn-danger" type="button"> Aceptar</button>';
		resultado += '</div';
		resultado += '</div>';
		resultado += '</div>';
		resultado += '</div> ';
		return resultado;
	}

	App.module.actionRecargar.init = function(){
			var interval = setInterval(function(){
				if(recargar){
					App.module.actionValidar.init();
				}
			},1000);
	}

	App.module.actionAdministrador.init = function(){

		administrador.id = $("#adm-id-1").val();
		administrador.nombre = $("#adm-nombre-1").val();
		administrador.apellidoPaterno = $("#adm-apellido_paterno-1").val();
		administrador.apellidoMaterno = $("#adm-apellido_materno-1").val();
		administrador.correo = $("#adm-correo-1").val();
		administrador.usuario = $("#adm-usuario-1").val();
		administrador.clave = $("#adm-clave-1").val();
		administrador.permiso = $("#adm-permiso-1").val();
		administrador.action = '';
		administrador.admin = $("#-a").val();
	}

	App.module.actionBorrarCampos.init = function(){
		$("#adm-id-1").val('');
		$("#adm-nombre-1").val('');
		$("#adm-apellido_paterno-1").val('');
		$("#adm-apellido_materno-1").val('');
		$("#adm-correo-1").val('');
		$("#adm-usuario-1").val('');
		$("#adm-clave-1").val('');
		$("#adm-permiso-1").val('1');
	}

	App.module.actionTabla.init = function(){

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

			App.module.actionEliminar.init();
			App.module.actionActualizar.init();

		});
	}

	App.module.actionValidar.init = function(){

		App.module.actionAdministrador.init();

		administrador.action = 'validar';

		$.post("crud/crud_administradores.php",administrador,function(data){

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

		if( typeof($(".gritter-item-wrapper").html()) == 'undefined' ){
					valido = true;
				}else{
					valido = false;
				}
	}

	App.init();


