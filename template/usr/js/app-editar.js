App = {};

	var alumno = {};
	var programa = {};
	var tipobeca = {};
	var beca = {};
	var alumnobeca = {}

	var recargar = true;	
	var validobeca = false;
	var validolumno = false;
	App.init = function(){
		App.module.actionActualizar.init();
		$("#bec-enviar-1").click(function(){
			App.module.actionActualizarBeca.init();
		})
	}

	App.module = {
		actionAlumno:{},
		actionPrograma:{},
		actionBeca:{},
		actionTipoBeca:{},

		actionValidarAlumno:{},
		actionValidarBeca1:{},
		actionValidarBeca2:{},

		actionActualizar:{},
		actionValidaciones:{},
		actionActualizarBeca:{}
	};

	App.module.actionActualizarBeca.init = function(){
		if(validolumno && validobeca){
			recargar = false;
			App.module.actionPrograma.init();
					App.module.actionBeca.init();
					App.module.actionTipoBeca.init();

					alumnobeca.id = alumno.id;
					alumnobeca.idb = beca.idb;
					alumnobeca.nombre_alumno = alumno.nombre_alumno;
					alumnobeca.apellidopaterno_alumno = alumno.apellidopaterno_alumno;
					alumnobeca.apellidomaterno_alumno = alumno.apellidomaterno_alumno;
					alumnobeca.sexo = alumno.sexo;

					alumnobeca.id_programa = programa.id_programa;
					alumnobeca.id_tipobeca = tipobeca.id_tipobeca;

					
					alumnobeca.fecha_cita = beca.fecha_cita;
					alumnobeca.porcentaje_solicitado = beca.porcentaje_solicitado;
					alumnobeca.porcentaje_acordado = beca.porcentaje_acordado;
					alumnobeca.pendiente = beca.pendiente;
					alumnobeca.observacion = beca.observacion;
					alumnobeca.recibe = beca.recibe;
					alumnobeca.asistencia = beca.asistencia;
					alumnobeca.action = 'actualizar';
					console.log(alumnobeca);
					$.post("usr/crud/crud_editar.php",alumnobeca,function(data){
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
						location.href = "alumnos.php";
						recargar = true;
					});


		}else{
			$.gritter.add({     
		   		title: "Tenemos un problema! ",      
		 		text: 'Faltan algunos campos.',

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
		alumno.nombre_alumno = $("#alu-nombre-1").val();
		alumno.apellidopaterno_alumno = $("#alu-apellido-paterno-1").val();
		alumno.apellidomaterno_alumno = $("#alu-apellido-materno-1").val();
		alumno.sexo = $("#alu-sexo-1").val();
		alumno.action = '';
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
		beca.idb = $("#bec-id-1").val();
		beca.asistencia = $("#bec-asistencia-1").val();
		beca.recibe = $("#bec-recibe-1").val();
		beca.fecha_cita = $("#bec-fechacita-1").val();
		beca.porcentaje_solicitado = $("#bec-porcentajesolicitado-1").val();
		beca.porcentaje_acordado = $("#bec-porcentajeacordado-1").val();
		beca.pendiente = $("#bec-pendiente-1").val();
		beca.observacion = $("#bec-observacion-1").val();
	}

	App.module.actionValidarAlumno.init = function(){
		App.module.actionAlumno.init();
		App.module.actionBeca.init();
		if(alumno.nombre_alumno != '' && alumno.apellidopaterno_alumno != '' && beca.fecha_cita != ''){
			validolumno = true;
			return true;
		}else{
			validolumno = false;
			return false;
		}
	}
	App.module.actionValidarBeca1.init = function(){
		App.module.actionBeca.init();
		if(beca.recibe != '' ){
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

	App.module.actionValidaciones.init = function(){
		if(App.module.actionValidarAlumno.init()){
			$("#alu-validar-1").css('display','block');
		}else{
			$("#alu-validar-1").css('display','none');
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


	App.module.actionActualizar.init = function(){
		var interval = setInterval(function(){
			if(recargar){
				App.module.actionValidaciones.init();
			App.module.actionBeca.init();
			App.module.actionAlumno.init();
			App.module.actionPrograma.init();
			App.module.actionValidarBeca2.init();
			App.module.actionValidarBeca1.init();
			App.module.actionTipoBeca.init();
			}
			
		},1000);
	}

App.init();