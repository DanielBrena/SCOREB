App = {};

	configuracion ={};
	App.init = function(){

		$("#enviar-porcentaje").click(function(){
			App.module.actionActualizarPorcentaje.init();
		});
	}

	App.module = {

		actionActualizarPorcentaje:{},
		actionConfiguracion:{}

	};

	App.module.actionConfiguracion.init = function(){
		configuracion.id = $("#porcentaje-matricula").attr('data-id');
		configuracion.valor = $("#porcentaje-matricula").val();
		configuracion.action = '';
	}

	App.module.actionActualizarPorcentaje.init = function(){
		App.module.actionConfiguracion.init();
		configuracion.action = 'actualizarPorcentaje';
		console.log(configuracion);
		$.post("crud/crud_index.php",configuracion,function(data){
			console.log(data.mensaje);
		},'json');
	}


App.init();