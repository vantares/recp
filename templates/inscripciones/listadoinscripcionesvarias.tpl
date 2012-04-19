{literal}
<script type="text/javascript">
$(function() {
    $("#fechainicial").datepicker();
});
$(function() {
    $("#fechafinal").datepicker();
});

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
        for(var i=page_index*opt[2];i<max_elem;i++)
        {
            segundoarreglo = primerarreglo[i].split('['); 
            camposarreglo =  campos.split(',');
            newcontent += '<div class="filadatos">';
            //newcontent += '<div class="filadatosli primerafila" style="width:7%">' + segundoarreglo[camposarreglo[0]] + '</div>';
            newcontent += '<div class="filadatosli primerafila" style="width:7%"><span class="numeroverde"><b>' + segundoarreglo[camposarreglo[1]] + '</b></span></div>';
            newcontent += '<div class="filadatosli" style="width:7%; text-align:center"><span class="numeroverde"><b>' +segundoarreglo[camposarreglo[2]] + '</span></b></div>';
            newcontent += '<div class="filadatosli" style="width:7%; text-align:center"><span class="numeroverde"><b>' +segundoarreglo[camposarreglo[3]] + '</span></b></div>';
            newcontent += '<div class="filadatosli" style="width:20%; text-align:center">' + segundoarreglo[camposarreglo[4]] + '</div>';
            newcontent += '<div class="filadatosli" style="width:25%; text-align:center">' + segundoarreglo[camposarreglo[5]] + segundoarreglo[camposarreglo[6]] + segundoarreglo[camposarreglo[7]] + segundoarreglo[camposarreglo[8]] + '</div>';
            newcontent += '<div class="filadatosli" style="width:17%; text-align:center">' + segundoarreglo[camposarreglo[9]] + '</div>';
            newcontent += '<div class="filadatosli noborde" style="width:15%; text-align:center"><div class="floatleft icons"><a href="/modulos/inscripciones/' + $("#pagina").val() + '?id=' + segundoarreglo[camposarreglo[0]] + '"><img src="/imagenes/iconedit.png" alt="editar" title="editar" width="18" height="18" /></a></div>';
            newcontent += '<div class="floatleft icons"><a href="/modulos/inscripciones/' + $("#paginad").val() + '?id=' + segundoarreglo[camposarreglo[0]] + '&detalle=1"><img src="/imagenes/iconrefresh.png" alt="detalles" title="detalles" width="18" height="18" /></a></div>';
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

// When document has loaded, initialize pagination and form 
$(document).ready(function(){
    // Create pagination element with options from form
    var arrayresult = $("#result").val();
    var opt = $('#opt').val().split(',');  
    var primerarreglo = arrayresult.split('{'); 
    $("#Pagination").pagination(primerarreglo.length, {num_edge_entries: opt[0], num_display_entries: opt[1], items_per_page: opt[2] ,callback: pageselectCallback});
});
</script>  
{/literal}
<div id="cajadatos">         
    <div id="contenidowizard">
       <div class="headerwizardizq">{$titular|upper}</div> 
       <div id="opciones">
             <a href="{$urlnueva}">Nuevo</a>
       </div><!--opciones-->  
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    <form action="" method="post" name="buscar">
    <div class="filabusqueda">
        <div class="filabusquedali primerafila" style="width:170px">
            <div class="label largo50">Nombre&nbsp;</div>
            <div class="componente margintop3"><input name="nombre" type="text" class="inputback" style="width:100px;" value="{$nombre}" /></div>
            <div class="limpiar"></div>
        </div>
        <div class="filabusquedali" style="width:170px">
            <div class="label" style="width:60px;">Apellido1&nbsp;</div>
            <div class="componente margintop3"><input name="apellido1" type="text" class="inputback" style="width:100px;" value="{$apellido1}" /></div>
            <div class="limpiar"></div>
        </div>    
        <div class="filabusquedali" style="width:170px">
            <div class="label" style="width:60px;">Apellido2&nbsp;</div>
            <div class="componente margintop3"><input name="apellido2" type="text" class="inputback" style="width:100px;" value="{$apellido2}" /></div>
            <div class="limpiar"></div>
        </div>              
        <div class="filabusquedali" style="width:145px; padding-left: 10px;">
            <div class="guardar" onclick="buscar.submit()">Buscar</div>
        </div>              
        <div class="limpiar"></div>
        <div class="filabusquedali primerafila" style="width:108px;" >
            <div class="label">Tomo&nbsp;</div> 
            <div class="componente margintop3">
                <input name="idtomo" type="text" class="inputback" style="width:50px;" value="{$idtomo}"/>
            </div> 
            <div class="limpiar"></div> 
        </div>
        <div class="filabusquedali" style="width:108px;">
            <div class="label">Folio&nbsp;</div> 
            <div class="componente margintop3"><input name="folio" type="text" class="inputback" style="width:50px;" value="{$folio}"/></div> 
            <div class="limpiar"></div> 
        </div>         
        <div class="filabusquedali" style="width:200px">
            <div class="label largo100">Fecha Inicial&nbsp;</div>
            <div class="componente margintop3"><input name="fechainicial" id="fechainicial" type="text" class="inputback" style="width:110px;" value="{$fechainicial}"/></div>
            <div class="limpiar"></div>
        </div>
        <div class="filabusquedali" style="width:220px; padding-left: 10px;">
            <div class="label largo100">Fecha Final&nbsp;</div> 
            <div class="componente margintop3"><input name="fechafinal" id="fechafinal" type="text" class="inputback" style="width:110px;" value="{$fechafinal}"/></div> 
            <div class="limpiar"></div> 
        </div>  
     
        <div class="limpiar"></div>   
     </div><!--filabusqueda-->     
     </form>
     <div id="Pagination" class="pagination"></div> 
     <div class="limpiar"></div> 
     <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:7%">Tomo</div> 
           <div  class="filaencabezadoli" style="width:7%; text-align:center">Folio</div>
           <div  class="filaencabezadoli" style="width:7%; text-align:center">Partida</div>
           <div  class="filaencabezadoli" style="width:20%; text-align:center">Tipo Inscripci&oacute;n</div>
           <div  class="filaencabezadoli" style="width:25%; text-align:center">Inscrito</div>
           <div  class="filaencabezadoli" style="width:17%; text-align:center">Fecha</div>
           <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div> 
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div id="Searchresult" class="listado"></div><!--listado-->
      <!-- Variables de las opciones del Navegador -->  
      <input  type="hidden"  name="result" id="result" value="{$arrayInscripcion}"/>  
      <input  type="hidden"  name="pagina" id="pagina" value="{$pagina}"/>
      <input  type="hidden"  name="paginad" id="paginad" value="{$paginad}"/>
      <input  type="hidden"  name="tipoincripcion" id="tipoincripcion" value="{$inscripcion}"/> 
      <input  type="hidden"  name="opt" id="opt" value="{$smarty.const.OPT}"/>
      <input  type="hidden"  name="campos" id="campos" value="0,25,22,23,26,3,4,5,6,24"/>   
</div><!--cajadatos-->
