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
    if(arrayresult.length > 0) {
        for(var i=page_index*opt[2];i<max_elem;i++)
        {
            segundoarreglo = primerarreglo[i].split('['); 
            camposarreglo =  campos.split(',');
            newcontent += '<div class="filadatos">';
            newcontent += '<div class="filadatosli primerafila" style="width:50%">' + segundoarreglo[camposarreglo[2]] + '</div>';
            newcontent += '<div class="filadatosli" style="width:20%;text-align:center">' + segundoarreglo[camposarreglo[1]] + '</div>';
            newcontent += '<div class="filadatosli noborde" style="width:20%; text-align:center">' + segundoarreglo[camposarreglo[0]] + '</div>';
            newcontent += '<div class="limpiar"></div></div><div class="limpiar"></div>';
            newcontent +=  '</div><!--filadatos-->';
        }
    } else {
           newcontent += '<div class="filadatos">';
           newcontent += '<div class="filadatosli noborde" style="width:97%; text-align:center"">No se encontraron resultados</div>';
           newcontent +=  '</div><!--filadatos-->'
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
             <a href="/modulos/eventos/trazasporusuarios.php">Listado de usuarios</a>
       </div><!--opciones-->
       <div id="opciones">
             <a href="/modulos/eventos/">Todas las trazas</a>
       </div><!--opciones--> 
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
    
    <form action="" method="post" name="buscar">
    <div class="filabusqueda">        
        <div class="filabusquedali primerafila" style="width:170px">
            {if $value != true} 
            <div class="label largo50">Nombre&nbsp;</div>
            <div class="componente margintop3"><input name="nombre" type="text" class="inputback" style="width:100px;" value="{$nombre}" /></div>
            <div class="limpiar"></div>
            {/if} 
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
        <div class="filabusquedali" style="width:100px; padding-left: 10px;">
            <div class="guardar" onclick="buscar.submit()">Buscar</div>
        </div>              
        <div class="limpiar"></div>    
     </div><!--filabusqueda-->  
     </form>
     <div id="Pagination" class="pagination"></div>
     <div class="limpiar"></div>
     <div class="filaencabezado">
          <div  class="filaencabezadoli primerafila" style="width:50%">Descripcion</div>
          <div  class="filaencabezadoli" style="width:20%; text-align:center">Usuario</div>
          <div  class="filaencabezadoli" style="width:28%; text-align:center">Fecha</div>
          <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div id="Searchresult" class="listado"></div><!--listado-->
     <input  type="hidden"  name="opt" id="opt" value="{$smarty.const.OPT}"/>
     <input  type="hidden"  name="campos" id="campos" value="1,4,6"/>  
     <input  type="hidden"  name="result" id="result" value="{$arrayEventos}"/>        
 </div>