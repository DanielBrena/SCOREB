App = {};
	
	var programa = {};
	var matricula = {};
	var recargar = true;
	var matriculavalida = false;

	App.init = function(){
		App.module.actionMostrarProgramas.init();
		App.module.actionRecargar.init();
		App.module.actionTabla.init();
		$("#mat-enviar-1").click(function(){
			App.module.actionAgregarMatricula.init();
		});
	}



	App.module = {

		actionAgregarMatricula:{},

		actionPrograma:{},
		actionMostrarProgramas:{},

		actionMatricula:{},
		actionValidarMatricula:{},

		actionValidaciones:{},

		actionRecargar:{},
		actionEliminar:{},

		actionModal:{},
		actionBorrarCampos:{}, 
		actionActualizar:{}, 
		actionActualizar2:{},

		actionTabla:{}	

	};

	App.module.actionAgregarMatricula.init = function(){
		if(matriculavalida){
			recargar = false;
			App.module.actionMatricula.init();
			matricula.action = 'crear';

			$.post("crud/crud_matricula.php",matricula,function(data){

				App.module.actionBorrarCampos.init();
					$("#modal-show").html( App.module.actionModal.init("Mensaje del sistema", data.mensaje) );
					console.log(data.mensaje);
					$("#modal-mostrar").modal("show");

				},'json').done(function(){
					$("#aceptar").click(function(){
						$("#modal-mostrar").modal("hide");
							
							recargar = true;
							App.module.actionTabla.init();
						});
				});

			console.log(matricula);
		}
	}

	App.module.actionValidarMatricula.init = function(){
		App.module.actionMatricula.init();

		if(matricula.matac != '' && matricula.mat != '' && matricula.bajas != '' && matricula.reinscripcion != ''){
			return true;
		}else{
			return false;
		}
	}

	App.module.actionValidaciones.init = function(){
		if(App.module.actionValidarMatricula.init()){
			matriculavalida = true;
		}else{
			matriculavalida = false;
		}
	}

	App.module.actionMatricula.init = function(){
		App.module.actionPrograma.init();
		matricula.id = $("#mat-id-1").val();
		matricula.pro = programa.id_programa;
		matricula.matac = $("#mat-matricula-esperada-1").val();
		matricula.mat = $("#mat-matricula-ciclo-1").val();
		matricula.bajas = $("#mat-bajas-1").val();
		matricula.reinscripcion = matricula.mat - matricula.bajas;
		matricula.action = '';
	}

	App.module.actionPrograma.init = function(){
		programa.id_programa = $("#mat-programa-1").val();
		programa.action = '';
	}

	App.module.actionEliminar.init = function(){
		$(".confirm-delete").on('click',function(){
			var mat_id = $(this).attr('data-id');
			$("#modal-show").html( App.module.actionModal.init("Eliminar", "¿Desea eliminar matricula?") );
			$("#modal-mostrar").modal("show");
			$("#cancelar").click(function(){
				$("#modal-mostrar").modal('hide');
			});
			$("#aceptar").click(function(){
				$.post("crud/crud_matricula.php",{action:'eliminar',id:mat_id}).done(function(data){
					
					$("#modal-mostrar").modal('hide');
					App.module.actionTabla.init();
					App.module.actionActualizar.init();
				},'json');
			});
		});
	}


	App.module.actionActualizar2.init = function(){

	   	$("#mat-cancelar-1").click(function(){
	   		$("#mat-enviar-1").css('display','block');
			$("#mat-actualizar-1").css('display','none');
			$("#mat-cancelar-1").css('display','none');
			App.module.actionBorrarCampos.init();
			recargar = true;
	   	});

	   	
	    $("#modal-show").html(App.module.actionModal.init("Actualizar", "¿Desea actualizar la matricula?"));
		$("#mat-actualizar-1").click(function(){

			recargar = false;

				$("#modal-mostrar").modal("show");
				$("#cancelar").click(function(){
					$("#modal-mostrar").modal('hide');
					App.module.actionBorrarCampos.init();
					$("#mat-enviar-1").css('display','block');
					$("#mat-actualizar-1").css('display','none');
					$("#mat-cancelar-1").css('display','none');
					recargar = true;
				});
				$("#aceptar").click(function(){
					recargar = false;
					App.module.actionMatricula.init();
					matricula.action = 'actualizar';

					$.post("crud/crud_matricula.php",matricula,function(data){

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
						$("#mat-enviar-1").css('display','block');
						$("#mat-actualizar-1").css('display','none');
						$("#mat-cancelar-1").css('display','none');
						$("#modal-mostrar").modal('hide');
						App.module.actionTabla.init();

					});

				});
			});
	}

	App.module.actionActualizar.init = function(){
		
		$(".confirm-edit").click(function(){

			recargar = false;
			var mat_id = $(this).attr('data-id');
			$("#mat-enviar-1").css('display','none');
			$("#mat-actualizar-1").css('display','block');
			$("#mat-cancelar-1").css('display','block');

			$.post("crud/crud_matricula.php",{action:'get',id:mat_id},function(data){

				$("#mat-id-1").val(data['mat_id']);
				$("#mat-programa-1").val(data['mat_programa']);
				$("#mat-matricula-esperada-1").val(data['mat_matricula_actual']);
				$("#mat-matricula-ciclo-1").val(data['mat_matricula']);
				$("#mat-bajas-1").val(data['mat_bajasAproximacion']);
				//$("#mat-reinscripcion-1").val(data['mat_reinscripcionEsperada']);
				

			},'json').done(function(){

				App.module.actionActualizar2.init();

			});

			

		});
	}

	App.module.actionMostrarProgramas.init = function(){
		
		
		$.post('crud/crud_matricula.php',{action:'mostrarProgramas'},function(data){
			var resultado = '';
			for(var i = 0; i < data.length; i++){
				resultado += '<option value="'+data[i]['pro_id']+'">'+data[i]['pro_nombre']+'</option>';
			}$("#mat-programa-1").html(resultado);
		},'json');
		
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

		$.post('crud/crud_matricula.php',{action:'mostrarTabla'},function(data){
			var resultado = '';
			for(var i = 0; i < data.length; i++){
				
				resultado += '<tr>';
				resultado += '<td>'+data[i]['programa']+'</td>';
				resultado += '<td>'+data[i]['matricula_actual']+'</td>';
				resultado += '<td>'+data[i]['matricula']+'</td>';
				resultado += '<td>'+data[i]['bajas']+'</td>';
				resultado += '<td>'+data[i]['reinscripcion']+'</td>';
				resultado += '<td>';
				resultado += '<button data-id="'+data[i]['mat_id']+'"  class="btn btn-primary btn-xs confirm-edit"><i class="icon-pencil "></i></button>';
				resultado += '<button data-id="'+data[i]['mat_id']+'" class="btn btn-danger btn-xs confirm-delete"><i  class="icon-trash"></i></button>';
				resultado += '</td>';
				resultado += '</tr>';
			}
			$("#mat-table-matricula").html(resultado);
		},'json').done(function(){

			App.module.actionEliminar.init();
			App.module.actionActualizar.init();
		});
	}

	App.module.actionBorrarCampos.init = function(){
		$("#mat-matricula-esperada-1").val('');
		$("#mat-matricula-ciclo-1").val('');
		$("#mat-bajas-1").val('');
		//$("#mat-reinscripcion-1").val('');
	}

	App.module.actionRecargar.init = function(){
		var interval = setInterval(function(){
			if(recargar){
				App.module.actionPrograma.init();
				App.module.actionValidaciones.init();
			}
		},1000);
	}

App.init();