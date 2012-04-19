<fieldset id="tiposolicitud_2" class="solicitud_data oculto"> 
<legend>Solicitud Certificaci&oacute;n</legend>  
<input type="hidden" name="idsolicitudcertificacion" id="idsolicitudcertificacion" value="{$solicitudtramite.idsolicitudcertificacion}"/>
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

{if !$solicitud and $recibo.idrecibo}
<div class="filadatos noborde" style="float:right; margin-right:20px; margin-bottom:5px;" >
	<input class="asistenciabutton submit" type="submit"  id="salvar" name="salvar" value="Adicionar"/>  
	<div class="limpiar"></div>
</div><!--filadatos-->                              
{/if}
</fieldset>
