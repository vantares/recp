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
            //newcontent += '<div class="filadatosli primerafila" style="width:7%">' + segundoarreglo[camposarreglo[0]] + '</div>';
            newcontent += '<div class="filadatosli primerafila" style="width:7%"><span class="numeroverde"><b>' + segundoarreglo[camposarreglo[1]] + '</b></span></div>';
            newcontent += '<div class="filadatosli" style="width:7%; text-align:center"><span class="numeroverde"><b>' +segundoarreglo[camposarreglo[2]] + '</span></b></div>';
            newcontent += '<div class="filadatosli" style="width:7%; text-align:center"><span class="numeroverde"><b>' +segundoarreglo[camposarreglo[8]] + '</span></b></div>';
            newcontent += '<div class="filadatosli" style="width:37%; text-align:center">' + segundoarreglo[camposarreglo[3]] + segundoarreglo[camposarreglo[4]] + segundoarreglo[camposarreglo[5]] + segundoarreglo[camposarreglo[6]] + '</div>';
            newcontent += '<div class="filadatosli" style="width:15%; text-align:center">' + segundoarreglo[camposarreglo[7]] + '</div>';           
            newcontent += '<div class="filadatosli noborde" style="width:15%; text-align:center"><div class="floatleft icons"><a href="/modulos/inscripciones/' + $("#pagina").val() + '?id=' + segundoarreglo[camposarreglo[0]] + '"><img src="/imagenes/iconedit.png" alt="editar" title="editar" width="18" height="18" /></a></div>';
            newcontent += '<div class="floatleft icons"><a href="/modulos/inscripciones/' + $("#paginad").val() + '?id=' + segundoarreglo[camposarreglo[0]] + '"><img src="/imagenes/iconrefresh.png" alt="detalles" title="detalles" width="18" height="18" /></a></div>';
            if( $("#tipoincripcion").val() != '') {
                newcontent += '<div class="floatleft icons"><a href="/modulos/inscripciones/actas.php/' + $("#tipoincripcion").val() + '/' + segundoarreglo[camposarreglo[0]] + '" target="_blank"><img src="/imagenes/iconacta.png" alt="acta" title="acta" width="18" height="18" /></a></div>';
            }
            newcontent += '<div class="limpiar"></div></div><div class="limpiar"></div>';
            newcontent +=  '</div><!--filadatos-->';
        }
    } else {
        newcontent += '<div class="filadatos" style="text-align:center;">No existen inscripciones registradas</div>';
    }    
    
    // Replace old content with new content
    $('#Searchresult').html(newcontent);
    
    // Prevent click eventpropagation
    return false;
}
