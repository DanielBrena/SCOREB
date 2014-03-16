$(document).ready(function(){
	
	var interval = setInterval(function(){
		actualizar();
	},100);

});

function actualizar(){
	$("#logs").load("../recargar/recargar_log.php");
}