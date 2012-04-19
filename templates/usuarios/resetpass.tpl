{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#formedit").validate({
        rules: {
            clave: "required",
            confpass: {
                required: true,
                equalTo: "#clave"
            }     
        },
        messages: {       
            clave: "Introduzca la contrase&ntilde;a",
            confpass: {
                required: "Introduzca la confirmaci&oacute;n de la contrase&ntilde;a",
                equalTo: "La contrase&ntilde;a y la confirmaci&oacute;n deben coincidir"
            }
        }
    });
});
</script> 
{/literal}
<div id="cajadatos">  
    <form class="cmxform" id="formedit" method="post" action="">
      <div id="contenidowizard">
           <div class="headerwizardizq">{$titular|upper}</div>   
           <div id="opciones">
                 <a href="{'/modulos/usuarios/'}">Listado Usuarios</a>
           </div><!--opciones-->           
           <div class="limpiar"></div>
       </div><!--contenidowizard--> 
       <div class="limpiar"></div>
	   <div class="formulario">
	      <div class="filaform">
              <div class="label">Contrase&ntilde;a:</div>
              <div class="component">
                  <input name="clave" id="clave" type="password" class="listwizard selectwizard" value=""/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Confirmar Contrase&ntilde;a:</div>
              <div class="component">
                  <input name="confpass" id="confpass" type="password" class="listwizard selectwizard" value=""/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          
		  <div class="filadatos noborde" style="float:right">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="idusuario" id="idusuario" type="hidden" value="{$usuario->request.idusuario}"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->
		  
       </div><!--formulario-->
    </form>
 </div>