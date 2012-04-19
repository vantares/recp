{literal}
<script type="text/javascript"> 
$(function() {
    $("#fechanacimiento").datetimepicker();
});
</script>  
{/literal} 
<div id="cajadatos"> 
    <div id="contenidowizard">
       <div class="headerwizardizq">Datos de la persona encontrada</div>
       <div id="opciones">
             <a href="/modulos/tramites/">Busqueda de personas</a>
       </div><!--opciones-->           
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
	
	<form class="cmxform" id="formedit" method="post" action="">
    <div class="formulario">
          <div class="filaform">
              <div class="label">Nombre completo:&nbsp;</div>
              <div class="label">{$persona->request.nombre1}&nbsp;{$persona->request.nombre2}&nbsp;{$persona->request.apellido1}&nbsp;{$persona->request.apellido2}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Ocupaci&oacute;n:&nbsp;</div>
              <div class="label">{$persona->request.ocupacion}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          
		  <div class="filaform">
              <div class="label">Estado civil:&nbsp;</div>
              <div class="label">{$persona->request.estadocivil}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Domicilio:&nbsp;</div>
              <div class="label">{$persona->request.domicilio}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          
		  <div class="filaform">
              <div class="label">Sexo:&nbsp;</div>
              <div class="label">{if $persona->request.sexo == 0}Femenino{else}Masculino{/if}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Nacionalidad:&nbsp;</div>
              <div class="label">{$persona->request.nacionalidad}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Fecha de Nacimiento:&nbsp;</div>
              <div class="label">{$persona->request.fechanacimiento}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
		  
		  <div class="filaform">
              <div class="label">Ciudad de Nacimiento:&nbsp;</div>
              <div class="label">{$persona->request.ciudadnacimiento}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Municipio de Nacimiento:&nbsp;</div>
              <div class="label">{$persona->request.municipionacimiento}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Departamento de Nacimiento:&nbsp;</div>
              <div class="label">{$persona->request.departamentonacimiento}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Pa&iacute;s de Nacimiento:&nbsp;</div>
              <div class="label">{$persona->request.paisnacimiento}</div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filadatos noborde" style="float:right">
            <input class=" asistenciabutton submit" type="submit"  name="confirmar" value="Confirmar"/>  
            <input name="idpersona" type="hidden" value="{$persona->request.idpersona}"/>
			<input class=" asistenciabutton submit" type="submit"  name="cancelar" value="Cancelar"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->               
    </div><!--formulario-->
    </form>
 </div>