/*$(document).ready(function(){
	$('.confirm-edit').click(function(){

	 var id_ = $(this).attr('data-id');
	 var mensaje = $(this).attr('data-val');

		if($("tr").length == 2){
			$("#modal-show").html( modal("Otorgar porcentaje", mensaje) );
			$("#modal-mostrar").modal("show");
			$("#aceptar").click(function(){
				var valornuevo =$("#enviar-p").val();
				console.log(valornuevo);
				console.log(id_);
				$.post("crud/crud_otorgarbeca1.php",{action:'actualizar',valor: valornuevo,id:id_},function(data){
					
					$.gritter.add({     
				   		title: "Tenemos un problema!",      
				 		text: data.mensaje,

				   		sticky: true,
				    	time: "",
				    	class_name: "my-sticky-class",
				    	before_open: function(){
				    		if($(".gritter-item-wrapper").length == 1){return false;}}
						});
					$("#pro-nombre-1").val('');

				
				},'json').done(function(){
					$("#modal-mostrar").modal("hide");
				});

			});

		}	
	  
	});



});

function modal(titulo,mensaje){
		var resultado = '';
		resultado += '<div class="modal fade" id="modal-mostrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
	    resultado += '<div class="modal-dialog">';
		resultado += '<div class="modal-content">';
		resultado += '<div class="modal-header">';
		resultado += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		resultado += '<h4 class="modal-title">'+ titulo +'</h4>';
		resultado += '</div>';
		resultado += '<div class="modal-body">'
			resultado += '<div class="col-lg-7">';
			resultado += '<div class="input-group m-bot15">';
            resultado += '<input type="text" value="'+mensaje+'" class="form-control" id="enviar-p" placeholder="0">';
            resultado += '<span class="input-group-addon">%</span>';
			resultado += '</div>';
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
*/
function mifun(){
	
	$(document).ready(function(){
		$("#myModal2").modal("show");
	});

}

function modal(titulo,mensaje){
		var resultado = '';
		resultado += '<div class="modal fade" id="modal-mostrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
	    resultado += '<div class="modal-dialog">';
		resultado += '<div class="modal-content">';
		resultado += '<div class="modal-header">';
		resultado += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		resultado += '<h4 class="modal-title">'+ titulo +'</h4>';
		resultado += '</div>';
		resultado += '<div class="modal-body">'
			resultado += '<div class="col-lg-7">';
			resultado += '<div class="input-group m-bot15">';
            resultado += '<input type="text" value="'+mensaje+'" class="form-control" id="enviar-p" placeholder="0">';
            resultado += '<span class="input-group-addon">%</span>';
			resultado += '</div>';
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