<fieldset id="tiposolicitud_1" class="solicitud_data oculto"> 
<legend>Solicitud Inscripci&oacute;n</legend>  
<input type="hidden" name="idsolicitudinscripcion" id="idsolicitudinscripcion" value="{$solicitudtramite.idsolicitudinscripcion}"/>
<div class="filaform">
<div class="label">Tipo de inscripci&oacute;n:&nbsp;</div>
<div class="component">
<select name="tipoinscripcion" id="tipoinscripcion"  class="listwizard selectwizard"  >
<option value="">Seleccionar Tipo Inscripci&oacute;n</option>
{section name=inscripcion loop=$arrayRubros}
<option value="{$arrayRubros[inscripcion].nombre}" {if $arrayRubros[inscripcion].nombre==$solicitudtramite.tipoinscripcion } selected="selected" {/if}>{$arrayRubros[inscripcion].nombre}</option>
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
{if !$solicitud and $recibo.idrecibo}
<div class="filadatos noborde" style="float:right; margin-right:20px; margin-bottom:5px;" >
	<input class="asistenciabutton submit" type="submit"  id="salvar" name="salvar" value="Adicionar"/>  
	<div class="limpiar"></div>
</div><!--filadatos-->                              
{/if}
</fieldset>
