{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#formedit").validate({
        rules: {
            nombre: "required",
            orden: {
                required: true,
				number: true,
                maxlength: 2            
            }    
        },
        messages: {
            nombre: "Introduzca el nombre del area", 
            orden: {
                required: "Introduzca el orden del area",
				number: "El orden del area debe ser un numero",
                maxlength: "La maxima cantidad de caracteres del orden es 2"            
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
                 <a href="{'/modulos/areas/'}">Listado de Areas</a>
           </div><!--opciones--> 
           <div class="limpiar"></div>
       </div><!--contenidowizard--> 
       <div class="limpiar"></div>

       <div class="formulario">
          <div class="filaform">
              <div class="label">Nombre del Area:</div>
              <div class="component">
                  <input name="nombre" id="nombre" type="text" class="listwizard selectwizard" style="width:200px;" value="{$area->request.nombre}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Url:</div>
              <div class="component">
                  <input name="url" id="url" type="text" class="listwizard selectwizard" value="{$area->request.url}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Padre:</div>
              <div class="component">
                  <select name="padre" id="padre"  class="listwizard selectwizard" >
                     <option value="">Selecionar Padre</option>
                     {section name=idpadre loop=$arrayAreas}
                        <option value="{$arrayAreas[idpadre].idarea}" {if $arrayAreas[idpadre].idarea == $area->request.padre}selected{/if}>{$arrayAreas[idpadre].nombre}</option>
                     {/section}
                  </select>
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
		  
		  <div class="filaform">
              <div class="label">Orden:</div>
              <div class="component">
                  <input name="orden" id="orden" type="text" class="listwizard selectwizard" value="{$area->request.orden}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform--> 
 
          <div class="filaform">
              <div class="label">Visible:</div>
              <div class="component">
                  <input type="checkbox" name="check1" id="check1" {if $area->request.visible == '1'}checked {/if}  />&nbsp;&nbsp;
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
		  
		  <div class="filaform">
              <div class="label">Independiente:</div>
              <div class="component">
                  <input type="checkbox" name="check2" id="check2" {if $area->request.independiente == '1'}checked {/if}  />&nbsp;&nbsp;
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filadatos noborde" style="float:right">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="idarea" type="hidden" value="{$area->request.idarea}"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->
               
     </div><!--formulario-->
    </form>
 </div>