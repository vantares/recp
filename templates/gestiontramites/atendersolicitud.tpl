<script type="text/javascript">
{literal}
$(function(){
	$(".addasresponse").live('click',function(){
		var idinscripcion= $(this).attr('rel');
		if($('#datosinscripcion').length > 0){
			if($("#contenidowizard_inscripcion").length==0){
			$("#datosinscripcion").before('<div id="contenidowizard_inscripcion" class="contenidowizard"><div class="headerwizardizq">Datos de inscripci&oacute;n</div><div class="limpiar"></div> </div>');
			}
			$("#datosinscripcion").load("/modulos/inscripciones/detalles{/literal}{$rubrosolicitud}{literal}.php?id="+idinscripcion+" #inscripcion");
		}
		else{
			//$("#solicitud").after('<div id="datosinscripcion"></div>');
			if($("#contenidowizard_inscripcion").length==0){
			$("#datosinscripcion").before('<div id="contenidowizard_inscripcion" class="contenidowizard"><div class="headerwizardizq">Datos de inscripci&oacute;n</div><div class="limpiar"></div> </div>');
			}
			$("#datosinscripcion").load("/modulos/inscripciones/detalles{/literal}{$rubrosolicitud}{literal}.php?id="+idinscripcion+" #inscripcion");
		}
		$("input#idinscripcion").val(idinscripcion);
	});
	// peticion asincrona de lista de inscripciones
	$("#applyfilter").click(function(event){
		event.preventDefault();
		//datos para filtrar
		var nombre_inscrito= $("#nombreinscrito1").val();
		var qsa= $("#filtroinscripciones input").serialize();
		$("#inscriptionlist").load("/modulos/gestiontramites/filtro_inscripciones.php?"+qsa);
	});
});
{/literal}
</script>
<form action="/modulos/gestiontramites/atendersolicitud?idsolicitud={$solicitud.idsolicitudtramite}" method="post" class="formulario">
<input type="hidden" id="idinscripcion" name="idinscripcion" value=""/ >

<div id="cajadatos">  
    <div id="contenidowizard">
       <div class="headerwizardizq">Solicitud a atender</div> 
       <div id="opciones">
             <a href="/modulos/gestiontramites/">Listado</a>
       </div><!--opciones-->           
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
<fieldset id="solicitud" class="visible">
<legend>Solicitud de tramite</legend>
<input type="hidden" name="idsolicitudtramite" id="idsolicitudtramite" value="{$solicitudidsolicitudtramite}"/>
<div class="filaform" style="padding-bottom: 10px;">
<div class="label">fecha entrega:</div>
<div class="component">
<input name="solicitante1" id="solicitante1" type="text" class="listwizard selectwizard" style="width:200px;" value="{$solicitud.fechaentrega}"/>
<div class="limpiar"></div>
</div>
</div><!--filaform-->
<div class="limpiar"></div>
<div class="filaform">
<div class="label">Solicitante 1:</div>
<div class="component">
<input name="solicitante1" id="solicitante1" type="text" class="listwizard selectwizard" style="width:200px;" value="{$solicitud.solicitante1}"/>
<div class="limpiar"></div>
</div>
</div><!--filaform-->
<div class="limpiar"></div>
<div class="filaform" id="compareciente2">
<div class="label">Solicitante 2:</div>
<div class="component">
<input name="solicitante2" id="solicitante2" type="text" class="listwizard selectwizard" style="width:200px;" value="{$solicitud.solicitante2}"/>
<div class="limpiar"></div>
</div>
</div><!--filaform-->
<div class="limpiar"></div>

<div class="limpiar"></div>
<div class="filaform">
<div class="label">Excento de Pago:</div>
<div class="component">
<input type="checkbox" id="estaexcento" name="estaexcento" value="1" {if $solicitud and $solicitud->request.excento!='f' or $recibo.idrecibo} checked="checked"{/if}> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
<div class="limpiar"></div>
</fieldset> 

{if $solicitud.tipotramite==1 }
<fieldset id="tiposolicitud_1" class="solicitud_data"> 
<legend>Solicitud Inscripci&oacute;n</legend>  
<div class="filaform">
<div class="label">Tipo de inscripci&oacute;n:&nbsp;</div>
<div class="component">
<select name="tipoinscripcion" id="tipoinscripcion"  class="listwizard selectwizard"  readonly="readonly" disabled="disabled">
<option value="">Seleccionar Tipo Inscripci&oacute;n</option>
{section name=inscripcion loop=$arrayRubros}
<option value="{$arrayRubros[inscripcion].nombre}" {if $arrayRubros[inscripcion].nombre==$solicitudtramite.tipoinscripcion } selected="selected" {/if} readonly="readonly">{$arrayRubros[inscripcion].nombre}</option>
{/section}
</select>  
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->               
<div id="reconocido">                              
<div class="filaform">
<div class="label">Nombre inscrito 1:&nbsp;</div>
<div class="component">
<input name="nombreinscrito1" id="nombreinscrito1" type="text" size="10" class="listwizard selectwizard" style="width:200px;" value="{$solicitudtramite.nombreinscrito1}"/>
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform" id="inscrito2">
<div class="label">Nombre inscrito 2:&nbsp;</div>
<div class="component">
<input name="nombreinscrito2" id="nombreinscrito2" type="text" size="10" class="listwizard selectwizard" style="width:200px;"  value="{$solicitudtramite.nombreinscrito2}"/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
</div>

<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Cantidad:&nbsp;</div>
<div class="component">
<input name="cant" id="cant" type="text" size="10" value="1" class="listwizard selectwizard" /> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
</fieldset>
{elseif $solicitud.tipotramite==2}
<fieldset id="tiposolicitud_2" class="solicitud_data"> 
<legend>Solicitud Certificaci&oacute;n</legend>  
<div class="filaform">
<div class="label">Tipo de certificaci&oacute;n:&nbsp;</div>
<div class="component">
<select name="tipocertificacion" id="tipocertificacion"  class="listwizard selectwizard"  >
<option value="">Seleccionar Tipo Certificaci&oacute;n</option>
{section name=certificacion loop=$arrayRubros}
<option value="{$arrayRubros[certificacion].nombre}">{$arrayRubros[certificacion].nombre}</option>
{/section}
</select>  
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Fecha de nacimiento:&nbsp;</div>
<div class="component">
<input type="text" id="fechanacimiento" name="fechanacimiento" value="{$solicitudtramite.fechanacimiento}" {$disabled}/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform">
<div class="label">Nombre del padre:&nbsp;</div>
<div class="component">
<input name="nombrepadre" id="nombrepadre" type="text" size="10" class="listwizard selectwizard" style="width:200px;" value="{$solicitudtramite.nombrepadre}"/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform">
<div class="label">Nombre de la madre:&nbsp;</div>
<div class="component">
<input name="nombremadre" id="nombremadre" type="text" size="10" class="listwizard selectwizard" style="width:200px;" value="{$solicitudtramite.nombremadre}"/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform">
<div class="label">Tomo:&nbsp;</div>
<div class="component">
<input name="tomo" id="tomo" type="text" size="10" class="listwizard selectwizard" value="{$solicitudtramite.tomo}"/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform">
<div class="label">Folio:&nbsp;</div>
<div class="component">
<input name="folio" id="folio" type="text" size="10" class="listwizard selectwizard"  value="{$solicitudtramite.folio}"/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform">
<div class="label">Partida:&nbsp;</div>
<div class="component">
<input name="partida" id="partida" type="text" size="10" class="listwizard selectwizard" value="{$solicitudtramite.partida}" /> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform">
<div class="label">A&ntilde;o:&nbsp;</div>
<div class="component">
<input name="anyo" id="anyo" type="text" size="10" value="{$anyo}" class="listwizard selectwizard" value="{$solicitudtramite.anyo}" /> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Fecha de registro:&nbsp;</div>
<div class="component">
<input type="text" id="fecharegistro" name="fecharegistro" value="{$solicitudtramite.fecharegistro}" {$disabled}/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Fecha de inscripcion:&nbsp;</div>
<div class="component">
<input type="text" id="fechainscripcion" name="fechainscripcion" value="{$solicitudtramite.fechainscripcion}" {$disabled}/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Cantidad:&nbsp;</div>
<div class="component">
<input name="cant" id="cant" type="text" size="10" value="1" class="listwizard selectwizard" /> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->

</fieldset>
<!-- datos de la sertificacion  --->
<fieldset>
<legend>Datos de la certificaci&oacute;n </legend>
<p class="label"> Complete estos datos para la emisi&oacute;n de la certificaci&oacute;n</p><br/>
<div class="limpiar"></div>
<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Departamento de registro</div>
<div class="component">
<input type="text" id="departamentoregistro" name="departamentoregistro" value="{$certificacion.departamentoregistro}" {$disabled}/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
<div class="filaform" style="padding-bottom: 10px;">
<div class="label">A&ntilde;o de registro</div>
<div class="component">
<input type="text" id="anyoregistro" name="anyoregistro" value="{$certificacion.anyoregistro}" {$disabled}/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Lugar de emisi&oacute;n</div>
<div class="component">
<input type="text" id="lugaremision" name="lugaremision" value="{$certificacion.lugaremision}" {$disabled}/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Fecha de emisi&oacute;</div>
<div class="component">
<input type="text" id="fechaemision" name="fechaemision" value="{$certificacion.fechaemision}" {$disabled}/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Nombre del Registrador</div>
<div class="component">
<select name="nombreregistrador" class="listwizard selectwizard"  {$disabled}>
{section name=id loop=$Registradores}
 <option value="{$Registradores[id].nombreusuario}" {if $Registradores[id].nombreusuario == $certificacion.nombreregistrador}selected{/if}>{$Registradores[id].nombreusuario}</option>
{/section}
</select>
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Nombre del Secretario</div>
<div class="component">
<select name="nombresecretario" class="listwizard selectwizard"  {$disabled}>
{section name=id loop=$Secretarios}
 <option value="{$Secretarios[id].nombreusuario}" {if $Secretarios[id].nombreusuario == $certificacion.nombresecretario}selected{/if}>{$Secretarios[id].nombreusuario}</option>
{/section}
</select>            
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
<div class="filaform" style="padding-bottom: 10px;">
<div class="label">Tipo de certificai&oacute;n</div>
<div class="component">
<input type="text" id="tipocertificado" name="tipocertificado" value="{$certificacion.tipocertificado}" {$disabled}/> 
<div class="limpiar"></div>
</div>
<div class="limpiar"></div>
</div><!--filaform-->
</fieldset>
{/if}

<div id="datosinscripcion">

</div>

<fieldset id="filtroinscripciones" class="filabusqueda">
<!-- legend>Filtro de Inscripciones</legend -->
<label for="nombre">Nombres</label><input type="text" name="nombre" id="nombre" value=""/>
<label for="fechainicial">fecha inicio</label><input type="text" name="fechainicial" id="fechainicial" value=""/>
<label for="fechafinal">fecha fin</label><input type="text" name="fechafinal" id="fechafinal" value=""/>
<div class="limpiar"></div>
<label for="idtomo">tomo</label><input type="text" name="idtomo" id="idtomo" value=""/>
<label for="folio">folio</label><input type="text" name="folio" id="folio" value=""/>
<label for="partida">partida</label><input type="text" name="partida" id="partida" value=""/>
<input name="tipoinscripcion" id="tipoinscripcion" type="hidden" value="{$tipoinscripcion}"/> 
<input type="submit" name="applyfilter" id="applyfilter" value="buscar"/>
</fieldset>

<div id="inscriptionlist">
       <div id="opciones">
             <a href="{$urlnueva}">Nuevo</a>
       </div><!--opciones-->  
<table style="border-collapse:collapse; border: solid 1px #666666;">
<caption>Incripciones de: {$tipoinscripcion}</caption>
<thead>
<tr class="filaencabezado">
<th style="width:7%">Tomo</th>
<th style="width:7%">Folio</th>
<th style="width:7%">Partida</th>
<th style="width:30%">Inscritos</th>
<th style="width:7%">Accciones</th>
</tr>
</thead>
<tbody>
{foreach item=inscripcion from=$inscripciones}
<tr class="filadatos">
<td>{$inscripcion.numero}</td>
<td>{$inscripcion.folio}</td>
<td>{$inscripcion.partida}</td>
<td>{$inscripcion.inscrito1nombre1}</td>
<td><a href="#" rel="{$inscripcion.idinscripcion}" class="addasresponse"><img src="/imagenes/iconpartidas.png"/></a></td>
</tr>
{/foreach}
</tbody>
</table>
</div>


<div class="filadatos noborde" style="float:right">
<input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
<input name="tipo" type="hidden" value="{$tipo}"/>
<input type="hidden" name="action" value="respond"/>
<div class="limpiar"></div>
</div><!--filadatos--> 

</div>
</form>
