App = {};

	
	programa = {};
	tipobeca = {};
	beca = {};
	alumnobeca = {};
	alumno = {};

	var validoalumno = false;
	var validobeca = false;
	var recargar = true;

	App.init = function(){
		
		App.module.actionMostrarTabla.init();
		App.module.actionRecargar.init();
		//App.module.actionMostrarProgramas.init();
		App.module.actionPrograma.init();
		App.module.actionTipoBeca.init();
		App.module.actionMostrarTiposBecas.init();
		App.module.actionBeca.init();

		$("#bec-enviar-1").click(function(){
			App.module.actionAgregarBecario.init();
		});
	}

	App.module = {

		actionAgregarBecario:{},
		
		actionAlumno:{},
		actionValidarAlumno:{},

		actionRecargar:{},
		actionValidaciones:{},

		actionPrograma:{},
		actionMostrarProgramas:{},

		actionTipoBeca:{},
		actionMostrarTiposBecas:{},

		actionBeca:{},
		actionValidarBeca1:{},
		actionValidarBeca2:{},

		actionModal:{},
		actionBorrarCampos:{},

		actionMostrarTabla:{}

	}
	App.module.actionAgregarBecario.init = function(){
		if( validoalumno && validobeca){
			recargar = false;
			
			App.module.actionPrograma.init();
			App.module.actionBeca.init();
			App.module.actionTipoBeca.init();

			
			alumnobeca.id_alumno = alumno.id_alumno;
			alumnobeca.id_programa = programa.id_programa;
			alumnobeca.id_tipobeca = tipobeca.id_tipobeca;

			
			alumnobeca.fecha_cita = beca.fecha_cita;
			alumnobeca.porcentaje_solicitado = beca.porcentaje_solicitado;
			alumnobeca.porcentaje_acordado = beca.porcentaje_acordado;
			alumnobeca.pendiente = beca.pendiente;
			alumnobeca.observacion = beca.observacion;
			alumnobeca.grupo = beca.grupo;
			alumnobeca.recibe = beca.recibe;
			alumnobeca.asistencia = beca.asistencia;
			alumnobeca.action = 'crear';

			$.post("usr/crud/crud_renovacionbeca.php",alumnobeca,function(data){

				App.module.actionBorrarCampos.init();
					$("#modal-show").html( App.module.actionModal.init("Mensaje del sistema", data.mensaje) );
					console.log(data.mensaje);
					$("#modal-mostrar").modal("show");

				},'json').done(function(){
					$("#aceptar").click(function(){
						$("#modal-mostrar").modal("hide");
							//App.module.actionTabla.init();
							
							
								location.href="alumnos";
							recargar = true;
						});
					});

			
	
	console.log(alumnobeca);

			
		}
	}
	App.module.actionAlumno.init = function(){
		alumno.id_alumno = $("#alu-id-1").val();
		alumno.action = '';
	}

	App.module.actionBorrarCampos.init = function(){
		$("#alu-id-1").val('');
		$("#alu-nombre-1").val('');
		$("#alu-apellido-paterno-1").val('');
		$("#alu-apellido-materno-1").val('');
		$("#bec-programa-1").val('1');
		$("#bec-tipobeca-1").val('1');
		$("#alu-sexo-1").val('Masculino');
		$("#bec-fechacita-1").val('');
		$("#bec-porcentajesolicitado-1").val('');
		$("#bec-porcentajeacordado-1").val('0');
		$("#bec-pendiente-1").val('');
		$("#bec-observacion-1").val('');
		$("#bec-asistencia-1").val('1');
		$("#bec-recibe-1").val('');

	}

	
	App.module.actionPrograma.init = function(){
		programa.id_programa = $("#bec-programa-1").val();
		programa.action = '';
	}
	App.module.actionTipoBeca.init = function(){
		tipobeca.id_tipobeca = $("#bec-tipobeca-1").val();
		tipobeca.action = '';
	}
	App.module.actionBeca.init = function(){
		beca.asistencia = $("#bec-asistencia-1").val();
		beca.recibe = $("#bec-recibe-1").val();
		beca.fecha_cita = $("#bec-fechacita-1").val();
		beca.porcentaje_solicitado = $("#bec-porcentajesolicitado-1").val();
		beca.porcentaje_acordado = $("#bec-porcentajeacordado-1").val();
		beca.pendiente = $("#bec-pendiente-1").val();
		beca.observacion = $("#bec-observacion-1").val();
		beca.grupo = $("#bec-grupo-1").val();
	}

	
	App.module.actionValidarBeca1.init = function(){
		App.module.actionBeca.init();
		if(beca.recibe != '' ){
			return true;
		}else{
			return false;
		}
	}

	App.module.actionValidarAlumno.init = function(){
		App.module.actionAlumno.init();
		if(alumno.id_alumno != '' && $("#bec-grupo-1").val() != '' && $("#bec-fechacita-1").val() != ''){
			return true;
		}else{
			return false;
		}
	}

	App.module.actionValidarBeca2.init = function(){
		App.module.actionBeca.init();
		if(beca.porcentaje_solicitado != ''){
			return true;
		}else{
			return false;
		}
	}

	/*App.module.actionMostrarProgramas.init = function(){
		$.post('usr/crud/crud_renovacionbeca.php',{action:'mostrarprogramas'},function(data){
			var resultado = '';
			for(var i = 0; i < data.length; i++){
				resultado += '<option value="'+data[i]['pro_id']+'">'+data[i]['pro_nombre']+'</option>';
			}$("#bec-programa-1").html(resultado);
		},'json');
	}*/

	App.module.actionMostrarTiposBecas.init = function(){
		$.post('usr/crud/crud_renovacionbeca.php',{action:'mostrartiposbecas'},function(data){
			var resultado = '';
			for(var i = 0; i < data.length; i++){
				resultado += '<option value="'+data[i]['tip_id']+'">'+data[i]['tip_nombre']+'</option>';
			}$("#bec-tipobeca-1").html(resultado);
		},'json');
	}

	

	App.module.actionMostrarTabla.init = function(){
		$.post("usr/crud/crud_alumnobeca.php",{action:'mostrar'},function(data){
			var resultado = ''
			for(var i = 0; i< data.length; i++){
				
				resultado += '<tr>';
				resultado += '<td>'+data[i].alu_nombre+'</td>';
				resultado += '<td>'+data[i].alu_apellidoPaterno+' '+data[i].alu_apellidoMaterno+'</td>';
				resultado += '<td>'+data[i].alu_sexo+'</td>';
				resultado += '<td>'+data[i].pro_nombre+'</td>';
				resultado += '<td>'+data[i].tip_nombre+'</td>';
				resultado += '<td>'+data[i].cic_fechaInicio+'</td>';
				resultado += '<td >'+data[i].bec_recibe+'</td>';
				resultado += '<td >'+data[i].bec_fechaCita+'</td>';
				resultado += '<td>'+data[i].bec_porcentajeSolicitado+'</td>';
				resultado += '<td>'+data[i].abc_tipo+'</td>';
				
				resultado += '</tr>';
			}
			$("#bec-table-beca-alumno").html(resultado);

		},'json');
	}

	App.module.actionValidaciones.init = function(){
		if(App.module.actionValidarAlumno.init() ){
			$("#alu-validar-1").css('display','block');
			validoalumno = true;
		}else{
			$("#alu-validar-1").css('display','none');
			validoalumno = false;
		}

		if(App.module.actionValidarBeca1.init()){
			$("#bec-validar-pro-fe-1").css('display','block');
		}else{
			$("#bec-validar-pro-fe-1").css('display','none');
		}

		if(App.module.actionValidarBeca2.init()){
			$("#bec-validar-porcentajes-1").css('display','block');

		}else{
			$("#bec-validar-porcentajes-1").css('display','none');
		}

		if(App.module.actionValidarBeca1.init() && App.module.actionValidarBeca2.init()){
			validobeca = true;
		}else{
			validobeca = false;
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

	App.module.actionRecargar.init = function(){
		var interval = setInterval(function(){
			if(recargar){
				App.module.actionValidarAlumno.init();
				App.module.actionValidaciones.init();
				App.module.actionPrograma.init();
				App.module.actionTipoBeca.init();
				App.module.actionBeca.init();
				App.module.actionValidarBeca1.init();
				App.module.actionValidarBeca2.init();
				App.module.actionMostrarTabla.init();
			}
			

		},500);
	}


App.init();