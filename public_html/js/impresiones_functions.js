$(function(){
	$("a.option_select").click(
		function(event){
			event.preventDefault();
			var currselection= $("#solicitudes_seleccionadas").val();
			var idsolicitud= $(this).attr("rel");
			var arr_sol= currselection.split(',');
			var index_sol=  arr_sol.indexOf(idsolicitud);
			if(index_sol >= 0){
				$(this).find("img").attr("src","/imagenes/iconpartidas.png");
				arr_sol.splice(index_sol,1);
			}
			else{
				arr_sol.push(idsolicitud);
				//arr_sol.splice(0,0,idsolicitud);
				$(this).find("img").attr("src","/imagenes/flechitabotonverde.gif");
			}
			currselection= arr_sol.join(',');
			$("#solicitudes_seleccionadas").val(currselection);
		});
});
