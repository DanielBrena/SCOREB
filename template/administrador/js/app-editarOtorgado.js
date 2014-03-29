App = {};

	beca = {};
	App.init = function(){
		$("#bec-enviar-1").click(function(){
			App.module.actionActualizarBeca.init();
		});
	}

	App.module = {

		actionBeca:{},
		actionActualizarBeca:{},
		actionModal:{}
	};

	App.module.actionActualizarBeca.init = function(){
		App.module.actionBeca.init();
		beca.action = 'actualizarBeca';
		if(beca.porcentajeAcordado != ''){
			$("#modal-show").html( App.module.actionModal.init("Mensaje del sistema", "¿Desea actulizar la información del alumno?") );
					
				$("#modal-mostrar").modal("show");
				$("#cancelar").click(function(){
					$("#modal-mostrar").modal('hide');
					
					
				});
				$("#aceptar").click(function(){
					
					$("#modal-mostrar").modal('hide');
					
					$.post("crud/crud_editar.php",beca,function(data){

						
						
							$("#modal-show").html( App.module.actionModal.init("Mensaje del sistema", data.mensaje) );
							
							$("#modal-mostrar").modal("show");

						},'json').done(function(){
							$("#aceptar").click(function(){

								$("#modal-mostrar").modal("hide");
									//App.module.actionTabla.init();
									
									$.gritter.removeAll();
									location.href ="cambiarPorcentajeAcordado.php";
								});
							});

					
					


				});
		}else{
			$.gritter.add({     
		   		title: "Tenemos un problema!",      
		 		text: 'Faltan algunos campos que rellenar.',

		   		sticky: true,
		    	time: "",
		    	class_name: "my-sticky-class",
		    	before_open: function(){
		    		if($(".gritter-item-wrapper").length == 1){return false;}}
			});
		}
		
	}

	App.module.actionBeca.init = function(){
		beca.idB = $("#bec-id-1").val();
		beca.porcentajeAcordado = $("#bec-acordado-1").val();
		beca.action = '';
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
		if(titulo == 'Eliminar' || titulo == 'Actualizar' || titulo == 'Mensaje del sistema: posible duplicado'){
			resultado += '<button id="cancelar" class="btn btn-default" type="button">Cancelar</button>';
		}
		resultado += '<button id="aceptar" class="btn btn-danger" type="button"> Aceptar</button>';
		resultado += '</div';
		resultado += '</div>';
		resultado += '</div>';
		resultado += '</div> ';
		return resultado;
	}

App.init();	