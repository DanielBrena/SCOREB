App = {};

	alumno = {};
	App.init = function(){
		$("#alu-enviar-1").click(function(){
			App.module.actionActualizarAlumno.init();
		});
	}

	App.module = {

		actionAlumno:{},
		actionActualizarAlumno:{},
		actionModal:{}
	};

	App.module.actionActualizarAlumno.init = function(){
		App.module.actionAlumno.init();
		alumno.action = 'actualizar';
		if(alumno.nombre != '' && alumno.apellidoPaterno != ''){
			$("#modal-show").html( App.module.actionModal.init("Mensaje del sistema", "¿Desea actulizar la información del alumno?") );
					
				$("#modal-mostrar").modal("show");
				$("#cancelar").click(function(){
					$("#modal-mostrar").modal('hide');
					
					
				});
				$("#aceptar").click(function(){
					
					$("#modal-mostrar").modal('hide');
					
					$.post("crud/crud_editar.php",alumno,function(data){

						
						
							$("#modal-show").html( App.module.actionModal.init("Mensaje del sistema", data.mensaje) );
							
							$("#modal-mostrar").modal("show");

						},'json').done(function(){
							$("#aceptar").click(function(){

								$("#modal-mostrar").modal("hide");
									//App.module.actionTabla.init();
									
									$.gritter.removeAll();
									location.href ="alumnos.php";
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

	App.module.actionAlumno.init = function(){
		alumno.id = $("#alu-id-1").val();
		alumno.nombre = $("#alu-nombre-1").val();
		alumno.apellidoPaterno = $("#alu-apellidoPaterno-1").val();
		alumno.apellidoMaterno = $("#alu-apellidoMaterno-1").val();
		alumno.sexo = $("#alu-sexo-1").val();
		alumno.action = '';
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