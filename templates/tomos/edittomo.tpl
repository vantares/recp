{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#formedit").validate({
        rules: {
            registrador: "required",
            secretario: "required",        
            numero: {
                required: true,
                number: true
            },
            anyo: {
                required: true,
                number: true,
                minlength: 4,
                maxlength: 4 
            }
        },
        messages: {
            registrador: "Introduzca el nombre del Registrador",
            secretario: "Introduzca el nombre del Secretario",        
            numero: "El valor tiene que ser un numero",
            anyo: "El a&ntilde;o es un numero de 4 cifras"
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
                 <a href="/modulos/tomos/edittomo.php/add">Nuevo Tomo</a>
           </div><!--opciones-->  
           <div id="opciones">
                 <a href="{'/modulos/tomos/index.php/'|cat:$smarty.session.libroregistral}">Listado</a>
           </div><!--opciones-->           
           <div class="limpiar"></div>
       </div><!--contenidowizard-->
       {if $notice != ''} 
           {include file="notice.tpl"}
       {else}
       <div class="formulario">
          <div class="filaform">
              <div class="label">Nombre Registrador</div>
              <div class="component">
                  <select name="registrador" class="listwizard selectwizard"  {$disabled}>
                      {section name=id loop=$Registradores}
                         <option value="{$Registradores[id].nombreusuario}" {if $Registradores[id].nombreusuario == $inscripcion->request.nombreregistrador}selected{/if}>{$Registradores[id].nombreusuario}</option>
                      {/section}
                   </select>                  
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          <div class="filaform">
              <div class="label">Nombre Secretario</div>
              <div class="component">
                  <select name="secretario" class="listwizard selectwizard"  {$disabled}>
                      {section name=id loop=$Secretarios}
                         <option value="{$Secretarios[id].nombreusuario}" {if $Secretarios[id].nombreusuario == $inscripcion->request.nombresecretario}selected{/if}>{$Secretarios[id].nombreusuario}</option>
                      {/section}
                   </select>               
                  <div class="limpiar"></div> 
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->       
          <div class="filaform">
              <div class="label">N&uacute;mero del tomo</div>
              <div class="component">
                  <input name="numero" type="text" class="listwizard selectwizard" size="10" value="{$tomo->getNumero()}"/>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->   
          <div class="filaform">
              <div class="label">A&ntilde;o</div>
              <div class="component"><input name="anyo" type="text" class="listwizard selectwizard" size="10" value="{$anyo}"/></div>
              <div class="limpiar"></div>
          </div><!--filaform--> 
          <div class="filadatos noborde" style="float:right">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="abrir" type="hidden" value="1"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->                         
       </div><!--formulario-->
       {/if} 
    </form>
 </div>    
