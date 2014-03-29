App = {};

	
	App.init = function(){
		App.module.actionMostrarAlumnos.init();
	}

	App.module = {
		actionMostrarAlumnos:{}
	};

	App.module.actionMostrarAlumnos.init = function(){
		var resultado = '';
		$.post("usr/crud/crud_alumnos",{action:'mostrarAlumnos'},function(data){
			for(var i = 0; i < data.length; i++){
				resultado +=  '<tr class="gradeX">';
				resultado += '<td>'+data[i].alu_id+'</td>';
				resultado +=  '<td>'+data[i].alu_nombre+'</td>';
				resultado +=  '<td>'+data[i].alu_apellidoPaterno+'</td>';
				resultado +=  '<td class="hidden-phone">'+data[i].alu_apellidoPaterno+'</td>';
				resultado +=  '<td class="center hidden-phone">Link</td>';
				
				resultado +=  '</tr>';
			}
			$("#table-alumnos-1").html(resultado);
		},'json');
	}




App.init();	
