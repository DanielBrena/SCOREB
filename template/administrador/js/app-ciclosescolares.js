App = {};
	
	cicloescolar = {};
	var valido = false;
	var recargar = true;

	App.init = function(){
		//App.module.actionAdministrador.init();

		App.module.actionCicloEscolar.init();
		App.module.actionTabla.init();
		App.module.actionRecargar.init();
		App.module.actionAgregarCicloEscolar.init();

		$("#cic-enviar-1").on('click', function(){
			App.module.actionAgregarCicloEscolar.init();
		})

	}

	App.module = {
		actionAgregarCicloEscolar:{},
		actionTabla:{},
		actionModal:{},
		actionActualizar:{},
		actionCicloEscolar:{},
		actionRecargar:{},
		actionValidar:{},
		actionBorrarCampos:{},
		actionEliminar:{},
		actionActualizar:{},
		actionActualizar2:{},
		actionActivar:{}

	};

	App.module.actionCicloEscolar.init = function(){
		cicloescolar.id = $("#cic-id-1").val();
		cicloescolar.fechainicio = $("#cic-fechainicio-1").val();
		cicloescolar.fechafinal = $("#cic-fechafinal-1").val();
		cicloescolar.descripcion = $("#cic-descripcion-1").val();
		cicloescolar.action = '';
	}

	App.module.actionAgregarCicloEscolar.init = function(){
		function valida_ciclos_escolares(){
			var valida = false;
			if( $("#cic-fechainicio-1").val() != ''){
				valida = true;
			}
			return valida;
				
		}
		

			if(valida_ciclos_escolares() && valido ){

				recargar = false;
				App.module.actionCicloEscolar.init();
				cicloescolar.action = 'crear';
				console.log(cicloescolar);
				$.post("crud/crud_ciclosescolares.php",cicloescolar,function(data){

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

	App.module.actionActivar.init = function(){
		$(".confirm-activate").on('click',function(){
			var cic_id = $(this).attr('data-id');
			$("#modal-show").html( App.module.actionModal.init("Eliminar", "¿Desea activar el ciclo escolar?") );
			$("#modal-mostrar").modal("show");
			$("#cancelar").click(function(){
				$("#modal-mostrar").modal('hide');
			});
			$("#aceptar").click(function(){
				$.post("crud/crud_ciclosescolares.php",{action:'activar',id:cic_id}).done(function(data){
					
					$("#modal-mostrar").modal('hide');
					App.module.actionTabla.init();
					App.module.actionActualizar.init();
				},'json');
			});
		});
	}

	App.module.actionActualizar2.init = function(){

	   	$("#cic-cancelar-1").click(function(){
	   		$("#cic-enviar-1").css('display','block');
			$("#cic-actualizar-1").css('display','none');
			$("#cic-cancelar-1").css('display','none');
			App.module.actionBorrarCampos.init();
			recargar = true;
	   	});

	   	
	    $("#modal-show").html(App.module.actionModal.init("Actualizar", "¿Desea actualizar el ciclo escolar?"));
		$("#cic-actualizar-1").click(function(){

			recargar = false;

				$("#modal-mostrar").modal("show");
				$("#cancelar").click(function(){
					$("#modal-mostrar").modal('hide');
					App.module.actionBorrarCampos.init();
					$("#cic-enviar-1").css('display','block');
					$("#cic-actualizar-1").css('display','none');
					$("#cic-cancelar-1").css('display','none');
					recargar = true;
				});
				$("#aceptar").click(function(){
					recargar = false;
					App.module.actionCicloEscolar.init();
					cicloescolar.action = 'actualizar';

					$.post("crud/crud_ciclosescolares.php",cicloescolar,function(data){

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
						$("#cic-enviar-1").css('display','block');
						$("#cic-actualizar-1").css('display','none');
						$("#cic-cancelar-1").css('display','none');
						$("#modal-mostrar").modal('hide');
						App.module.actionTabla.init();

					});

				});
			});
	}

	App.module.actionActualizar.init = function(){
		
		$(".confirm-edit").click(function(){

			recargar = false;
			var cic_id = $(this).attr('data-id');
			$("#cic-enviar-1").css('display','none');
			$("#cic-actualizar-1").css('display','block');
			$("#cic-cancelar-1").css('display','block');

			$.post("crud/crud_ciclosescolares.php",{action:'get',id:cic_id},function(data){

				$("#cic-id-1").val(data['cic_id']);

				$("#cic-fechainicio-1").val(data['cic_fechaInicio']);

				$("#cic-fechafinal-1").val(data['cic_fechaFinal']);

				$("#cic-descripcion-1").val(data['cic_descripcion']);
				

			},'json').done(function(){

				App.module.actionActualizar2.init();
				App.module.actionCicloEscolar.init();

			});

			

		});
	}

	App.module.actionEliminar.init = function(){
		$(".confirm-delete").on('click',function(){
			var cic_id = $(this).attr('data-id');
			$("#modal-show").html( App.module.actionModal.init("Eliminar", "¿Desea eliminar el ciclo escolar?") );
			$("#modal-mostrar").modal("show");
			$("#cancelar").click(function(){
				$("#modal-mostrar").modal('hide');
			});
			$("#aceptar").click(function(){
				$.post("crud/crud_ciclosescolares.php",{action:'eliminar',id:cic_id}).done(function(data){
					
					$("#modal-mostrar").modal('hide');
					App.module.actionTabla.init();
					App.module.actionActualizar.init();
				},'json');
			});
		});
	}

	App.module.actionValidar.init = function(){

		App.module.actionCicloEscolar.init();

		cicloescolar.action = 'validar';

		$.post("crud/crud_ciclosescolares.php",cicloescolar,function(data){

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

		$.post('crud/crud_ciclosescolares.php',{action:'mostrar'},function(data){
			var resultado = '';
			for(var i = 0; i < data.length; i++){
				
				resultado += '<tr>';
				resultado += '<td>'+data[i]['cic_fechaInicio']+'</td>';
				resultado += '<td>'+data[i]['cic_fechaFinal']+'</td>';
				resultado += '<td>'+data[i]['cic_descripcion']+'</td>';
				resultado += '<td><spam class="label label-info label-mini">'+data[i]['cic_activar']+'</spam></td>';
				resultado += '<td>';
				resultado += '<button  data-id="'+data[i]['cic_id']+'" class="btn btn-success btn-xs confirm-activate"><i class="icon-check-sign"></i></button>';
				resultado += '<button data-id="'+data[i]['cic_id']+'"  class="btn btn-primary btn-xs confirm-edit"><i class="icon-pencil "></i></button>';
				resultado += '<button data-id="'+data[i]['cic_id']+'" class="btn btn-danger btn-xs confirm-delete"><i  class="icon-trash"></i></button>';
				resultado += '</td>';
				resultado += '</tr>';
			}
			$("#cic-table-ciclosescolares").html(resultado);
		},'json').done(function(){

			//App.module.actionEliminar.init();
			//App.module.actionActualizar.init();
			App.module.actionActivar.init();
			App.module.actionEliminar.init();
			App.module.actionActualizar.init();
		});

	}

	App.module.actionBorrarCampos.init = function(){
		$("#cic-id-1").val('');
		$("#cic-fechainicio-1").val('');
		$("#cic-fechafinal-1").val('');
		$("#cic-descripcion-1").val('');
	}


	App.module.actionRecargar.init = function(){
		var interval = setInterval(function(){
			if(recargar){
				App.module.actionValidar.init();
			}
		},1000);
	}


App.init();


