<fieldset id="excento" class="{if $solicitud and $solicitud->request.excento=='t' } visible  {else} oculto {/if}">
<legend>Patrocinio</legend>
<div class="filaform">
	<div class="label">Organizaci&oacute;n:</div>
	<div class="component">
		<select name="idorganizacion" id="idorganizacion"  class="listwizard selectwizard"  >
		<option value="">Seleccionar Organizacion</option>
		{section name=organizacion loop=$arrayOrganizacion}
		<option value="{$arrayOrganizacion[organizacion].idorganizacion}" {if $arrayOrganizacion[organizacion].idorganizacion==$patrocinio.idorganizacion} selected="selected"{/if}>{$arrayOrganizacion[organizacion].nombre}</option>
		{/section}
		</select>  
		<div class="limpiar"></div>
	</div>
	<div class="limpiar"></div>
</div><!--filaform-->
</fieldset> 
