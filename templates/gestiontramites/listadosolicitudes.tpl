{literal}
<script type="text/javascript">
// When document has loaded, initialize pagination and form 
$(document).ready(function(){
		// Create pagination element with options from form
		var arrayresult = $("#result").val();
		var opt = $('#opt').val().split(',');  
		var primerarreglo = arrayresult.split('{'); 
		$("#Pagination").pagination(primerarreglo.length, {num_edge_entries: opt[0], num_display_entries: opt[1], items_per_page: opt[2], callback: pageselectCallback});
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
<!-- 
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
</div>
 -->
<!--filabusqueda-->     
</form>

<div id="Pagination" class="pagination"></div>
<div class="limpiar"></div>     
<div class="filaencabezado">
<div  class="filaencabezadoli primerafila" style="width:62px">Id</div> 
<div  class="filaencabezadoli" style="width:89px; text-align:center">Tipo</div>
<div  class="filaencabezadoli" style="width:89px; text-align:center">Sub Tipo</div>
<div  class="filaencabezadoli" style="width:115px; text-align:center">Fecha</div>   
<div  class="filaencabezadoli" style="width:115px; text-align:center">Entrega</div>
<div  class="filaencabezadoli" style="width:140px; text-align:center">Estado</div>
<div  class="filaencabezadoli" style="width:168px; text-align:center">Solicitante</div> 
<div  class="filaencabezadoli" style="width:80px; text-align:center">Acciones</div> 
<div class="limpiar"></div>
</div><!--filaencabezado-->
<div id="Searchresult" class="listado"></div><!--listado-->
<!-- Variables de las opciones del Navegador -->  
<input  type="hidden"  name="result" id="result" value="{$arraySolicitud}"/> 
<input  type="hidden"  name="tipoincripcion" id="tipoincripcion" value="{$inscripcion}"/> 
<input  type="hidden"  name="pagina" id="pagina" value="{$pagina}"/>
<input  type="hidden"  name="paginad" id="paginad" value="{$paginad}"/>
<input  type="hidden"  name="opt" id="opt" value="{$smarty.const.OPT}"/>
<input  type="hidden"  name="campos" id="campos" value="{$arrayPosiciones}"/> 
<input  type="hidden"  name="configs" id="configs" value="{$options}"/>
<input type="hidden" name="baseurl" id="baseurl" value="http://registro.alcaldiamatagalpa.gob.ni/modulos/gestiontramites" />
<!-- input type="hidden" name="options" id="options" value="edit|icon:iconactaapertura,title:Editar,url:/editsolicitudtramite.php;response|icon:iconpartidas,title:Atender,url:/atendersolicitud.php;del|icon:iconcierre,title:Borrar,url:/editsolicitudtramite.php" / -->
<input type="hidden" name="options" id="options" value="edit|icon:iconactaapertura,title:Editar,url:/editsolicitudtramite.php;response|icon:iconpartidas,title:Atender,url:/atendersolicitud.php" />
</div><!--cajadatos-->
