function pageselectCallback(page_index, jq,campos){
	// Get number of elements per pagionation page from form
	//var items_per_page = $('#items_per_page').val();
	var arrayresult = $("#result").val();  
	var campos = $("#campos").val();
	var opt = $('#opt').val().split(',');
	var primerarreglo = arrayresult.split('{');
	var max_elem = Math.min((page_index+1) * opt[2], primerarreglo.length);
	var newcontent = '';

	// Iterate through a selection of the content and build an HTML string
	if(arrayresult != '') {
		for(var i=page_index*opt[2];i<max_elem;i++) {
			segundoarreglo = primerarreglo[i].split('['); 
			camposarreglo =  campos.split(',');
			newcontent += '<div class="filadatos">';

			for(var j=0; j< camposarreglo.length; j++){
				var columnwidth= $('.filaencabezadoli:eq('+ j +')').css('width');
				var paddingl= $('.filaencabezadoli:eq('+ j +')').css('padding-left');
				newcontent += '<div class="filadatosli" style="text-align:center;width:'+columnwidth+';padding-left:'+ paddingl+'">' + segundoarreglo[camposarreglo[j]] + '</div>';   
			}
			//if( $("#tipoincripcion").val() != '') {
			var baseurl= $("input#baseurl").val();
			var opciones= $("input#options").val().split(';');
			var id= parseInt(segundoarreglo[0]);
			for(var opt=0; opt < opciones.length; opt++){
				var optconf= opciones[opt].split('|');
				//alert(optconf[1]);
				var conf= optconf[1].split(',');
				var icon= conf[0].split(':')[1];
				var title= conf[1].split(':')[1];
				var url= conf[2].split(':')[1];
				url=baseurl+url+'?action='+optconf[0]+'&'+'idsolicitud='+id;
				newcontent += '<div class="floatleft icons"><a href="'+ url +'" target="_self" class="option_'+optconf[0]+'" rel="'+id+'"><img src="/imagenes/'+icon+'.png" alt="'+title+'" title="'+ title +'" height="18" /></a></div>';
			}
			//newcontent += '<div class="floatleft icons"><a href="#" target="_blank"><img src="/imagenes/iconactaapertura.png" alt="acta" title="Acta o certificacion" width="18" height="18" /></a></div>';
			//newcontent += '<div class="floatleft icons"><a href="#" target="_blank"><img src="/imagenes/iconpartidas.png" alt="acta" title="Marcar para atender" width="18" height="18" /></a></div>';
			//newcontent += '<div class="floatleft icons"><a href="#" target="_blank"><img src="/imagenes/iconcierre.png" alt="acta" title="Marcar como atendida" width="18" height="18" /></a></div>';
			//}
			newcontent += '<div class="limpiar"></div></div><div class="limpiar"></div>';
			newcontent +=  '</div><!--filadatos-->';
		}
	} 
	else {
		newcontent += '<div class="filadatos" style="text-align:center;">No existen inscripciones registradas</div>';
	}

	// Replace old content with new content
	$('#Searchresult').html(newcontent);

	// Prevent click eventpropagation
	return false;
}
