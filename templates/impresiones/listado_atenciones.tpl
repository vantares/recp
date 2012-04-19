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
<script type="text/javascript" src="/js/impresiones_functions.js">
</script>  
{/literal}
<div id="cajadatos">         
<div id="contenidowizard">
<div class="headerwizardizq">{$titular|upper}</div> 
<div id="opciones">
<a href="{$urlnueva}" target="_blank">Listado solicitudes</a>
</div><!--opciones-->  
<div class="limpiar"></div>
</div><!--contenidowizard-->
<form action="" method="get" name="buscar">
<div class="filabusqueda">
<div class="filabusquedali primerafila" style="">
<div class="label">Tipo tramite&nbsp;&nbsp;</div>
<div class="componente margintop3">

<select name="tipotramite" id="tipotramite"  class="listwizard selectwizard" >
<option value="">Seleccionar Tr&aacute;mite</option>

{section name=idtipotramite loop=$arrayTipotramite}
	<option value="{$arrayTipotramite[idtipotramite].idtipotramite}" {if $arrayTipotramite[idtipotramite].idtipotramite == $smarty.request.tipotramite}selected="selected"{/if} >{$arrayTipotramite[idtipotramite].tipotramite}</option>
{/section}
</select>
</div>
<div class="limpiar"></div>
</div>
<div class="filabusquedali primerafila" style="">
<div class="label">Sub tipo &nbsp;&nbsp;</div>
<div class="componente margintop3">
<select name="sub_tipo" id="sub_tipo"  class="listwizard selectwizard"  >
<option value="">Seleccionar Tipo Inscripci&oacute;n</option>
{section name=inscripcion loop=$arrayRubros}
<option value="{$arrayRubros[inscripcion].nombre}" {if $arrayRubros[inscripcion].nombre==$smarty.request.sub_tipo } selected="selected" {/if}>{$arrayRubros[inscripcion].nombre}</option>
{/section}
</select>  
</div>
<div class="limpiar"></div>
</div>
<div class="filabusquedali" style="width:145px; padding-left: 10px;">
<div class="guardar" onclick="buscar.submit()">Buscar</div>
</div>              
</div>
<!--filabusqueda-->     
</form>

<div id="Pagination" class="pagination"></div>
<div class="limpiar"></div>     
<div class="filaencabezado">
<div  class="filaencabezadoli primerafila" style="width:62px">Id</div> 
<div  class="filaencabezadoli" style="width:89px; text-align:center">Tipo</div>
<div  class="filaencabezadoli" style="width:89px; text-align:center">Sub Tipo</div>
<div  class="filaencabezadoli" style="width:115px; text-align:center">Fecha</div>   
<div  class="filaencabezadoli" style="width:115px; text-align:center">Entraga</div>
<div  class="filaencabezadoli" style="width:140px; text-align:center">Estado</div>
<div  class="filaencabezadoli" style="width:168px; text-align:center">Solicitante</div> 
<div  class="filaencabezadoli" style="width:80px; text-align:center">Acciones</div> 
<div class="limpiar"></div>
</div><!--filaencabezado-->
<div id="Searchresult" class="listado"></div><!--listado-->
<!-- Variables de las opciones del Navegador -->  
<div class="filadatos noborde" style="float:right">

<input  type="hidden"  name="result" id="result" value="{$arraySolicitud}"/> 
<input  type="hidden"  name="tipoincripcion" id="tipoincripcion" value="{$inscripcion}"/> 
<input  type="hidden"  name="pagina" id="pagina" value="{$pagina}"/>
<input  type="hidden"  name="paginad" id="paginad" value="{$paginad}"/>
<input  type="hidden"  name="opt" id="opt" value="{$smarty.const.OPT}"/>
<input  type="hidden"  name="campos" id="campos" value="{$arrayPosiciones}"/> 
<input  type="hidden"  name="configs" id="configs" value="{$options}"/>
<input type="hidden" name="baseurl" id="baseurl" value="/modulos/impresiones" />
<!-- input type="hidden" name="options" id="options" value="edit|icon:iconactaapertura,title:Editar,url:/editsolicitudtramite.php;response|icon:iconpartidas,title:Atender,url:/atendersolicitud.php;del|icon:iconcierre,title:Borrar,url:/editsolicitudtramite.php" / -->
<input type="hidden" name="options" id="options" value="edit|icon:iconactaapertura,title:Editar,url:/editsolicitudtramite.php;select|icon:iconpartidas,title:Marcar,url:#" />
<form action="print_block.pdf" method="post">
<input type="hidden" name="solicitudes_seleccionadas" id="solicitudes_seleccionadas"/>
<input type="hidden" name="tipobloque" id="tipobloque" value="{$smarty.request.tipotramite}"/>
<input class=" asistenciabutton submit" type="submit"  name="print" value="Imprimir seleccionadas" style="width:220px;"/>  
<div class="limpiar"></div>
</form>
</div><!--filadatos-->                   
</div><!--cajadatos-->
