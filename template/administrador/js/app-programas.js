App = {};
	
	programa = {};
	var valido = false;
	var recargar = true;

	App.init = function(){
		//App.module.actionAdministrador.init();

		App.module.actionPrograma.init();
		App.module.actionTabla.init();
		App.module.actionRecargar.init();
		App.module.actionAgregarPrograma.init();

		$("#pro-enviar-1").on('click', function(){
			App.module.actionAgregarPrograma.init();
		})

	}

	App.module = {
		actionAgregarPrograma:{},
		actionTabla:{},
		actionModal:{},
		actionActualizar:{},
		actionPrograma:{},
		actionRecargar:{},
		actionValidar:{},
		actionBorrarCampos:{},
		actionEliminar:{},
		actionActualizar:{},
		actionActualizar2:{}

	};

	App.module.actionPrograma.init = function(){
		programa.id = $("#pro-id-1").val();
		programa.nombre = $("#pro-nombre-1").val();
		programa.descripcion = $("#pro-descripcion-1").val();
		programa.action = '';
	}

	App.module.actionAgregarPrograma.init = function(){
		function valida_programas(){
			var valida = false;
			if( $("#pro-nombre-1").val() != ''){
				valida = true;
			}
			return valida;
				
		}
		

			if(valida_programas() && valido ){
				recargar = false;
				App.module.actionPrograma.init();
				programa.action = 'crear';

				$.post("crud/crud_programas.php",programa,function(data){

					App.module.actionBorrarCampos.init();
					$("#modal-show").html( App.module.actionModal.init("Mensaje del sistema", data.mensaje) );
					console.log(data.mensaje);
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

	App.module.actionActualizar2.init = function(){

	   	$("#pro-cancelar-1").click(function(){
	   		$("#pro-enviar-1").css('display','block');
			$("#pro-actualizar-1").css('display','none');
			$("#pro-cancelar-1").css('display','none');
			App.module.actionBorrarCampos.init();
			recargar = true;
	   	});

	   	
	    $("#modal-show").html(App.module.actionModal.init("Actualizar", "¿Desea actualizar el programa?"));
		$("#pro-actualizar-1").click(function(){

			recargar = false;

				$("#modal-mostrar").modal("show");
				$("#cancelar").click(function(){
					$("#modal-mostrar").modal('hide');
					App.module.actionBorrarCampos.init();
					$("#pro-enviar-1").css('display','block');
					$("#pro-actualizar-1").css('display','none');
					$("#pro-cancelar-1").css('display','none');
					recargar = true;
				});
				$("#aceptar").click(function(){
					recargar = false;
					App.module.actionPrograma.init();
					programa.action = 'actualizar';

					$.post("crud/crud_programas.php",programa,function(data){

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
						$("#pro-enviar-1").css('display','block');
						$("#pro-actualizar-1").css('display','none');
						$("#pro-cancelar-1").css('display','none');
						$("#modal-mostrar").modal('hide');
						App.module.actionTabla.init();

					});

				});
			});
	}

	App.module.actionActualizar.init = function(){
		
		$(".confirm-edit").click(function(){

			recargar = false;
			var pro_id = $(this).attr('data-id');
			$("#pro-enviar-1").css('display','none');
			$("#pro-actualizar-1").css('display','block');
			$("#pro-cancelar-1").css('display','block');

			$.post("crud/crud_programas.php",{action:'get',id:pro_id},function(data){

				$("#pro-id-1").val(data['pro_id']);
				$("#pro-nombre-1").val(data['pro_nombre']);
				$("#pro-descripcion-1").val(data['pro_descripcion']);
				

			},'json').done(function(){

				App.module.actionActualizar2.init();

			});

			

		});
	}

	App.module.actionEliminar.init = function(){
		$(".confirm-delete").on('click',function(){
			var pro_id = $(this).attr('data-id');
			$("#modal-show").html( App.module.actionModal.init("Eliminar", "¿Desea eliminar programa?") );
			$("#modal-mostrar").modal("show");
			$("#cancelar").click(function(){
				$("#modal-mostrar").modal('hide');
			});
			$("#aceptar").click(function(){
				$.post("crud/crud_programas.php",{action:'eliminar',id:pro_id}).done(function(data){
					
					$("#modal-mostrar").modal('hide');
					App.module.actionTabla.init();
					App.module.actionActualizar.init();
				},'json');
			});
		});
	}

	App.module.actionValidar.init = function(){

		App.module.actionPrograma.init();

		programa.action = 'validar';

		$.post("crud/crud_programas.php",programa,function(data){

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

	App.module.actionTabla.init = function(){

		$.post('crud/crud_programas.php',{action:'mostrar'},function(data){
			var resultado = '';
			for(var i = 0; i < data.length; i++){
				
				resultado += '<tr>';
				resultado += '<td>'+data[i]['pro_nombre']+'</td>';
				resultado += '<td>'+data[i]['pro_descripcion']+'</td>';
				resultado += '<td>';
				resultado += '<button data-id="'+data[i]['pro_id']+'"  class="btn btn-primary btn-xs confirm-edit"><i class="icon-pencil "></i></button>';
				resultado += '<button data-id="'+data[i]['pro_id']+'" class="btn btn-danger btn-xs confirm-delete"><i  class="icon-trash"></i></button>';
				resultado += '</td>';
				resultado += '</tr>';
			}
			$("#pro-table-programas").html(resultado);
		},'json').done(function(){

			//App.module.actionEliminar.init();
			//App.module.actionActualizar.init();
			App.module.actionEliminar.init();
			App.module.actionActualizar.init();
		});

	}

	App.module.actionBorrarCampos.init = function(){
		$("#pro-id-1").val('');
		$("#pro-nombre-1").val('');
		$("#pro-descripcion-1").val('');
	}


	App.module.actionRecargar.init = function(){
		var interval = setInterval(function(){
			if(recargar){
				App.module.actionValidar.init();
			}
		},1000);
	}


App.init();


