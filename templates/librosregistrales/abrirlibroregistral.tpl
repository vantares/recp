{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#formabrir").validate({
        rules: {
            codigo: "number"
        },
        messages: {
            codigo: "El C&oacute;digo tiene que ser un n&uacute;mero"
        }
    });
});
</script>
{/literal}
<div id="cajadatos">   
    <form class="cmxform" id="formabrir" method="post" action="">  
       <div id="contenidowizard">
           <div class="headerwizardizq">{$titular|upper}</div> 
           <div id="opciones">
                 <a href="/modulos/libroregistrales/crearlibroregistral.php">Nuevo Libro</a>
           </div><!--opciones-->  
           <div id="opciones">
                 <a href="/modulos/librosregistrales">Listado</a>
           </div><!--opciones-->           
           <div class="limpiar"></div>
       </div><!--contenidowizard-->
       {if $notice != ''} 
           {include file="notice.tpl"}
       {else}
       <div class="formulario">
          <div class="filaform">
              <div class="label">Rubro</div>
              <div class="component">
                  <select name="idrubro" class="listwizard selectwizard">
                      {section name=rubro loop=$arrayRubros}
                         <option value="{$arrayRubros[rubro].idrubro}">{$arrayRubros[rubro].nombre}</option>
                      {/section}
                   </select></div>
              <div class="limpiar"></div>
          </div><!--filaform--> 
   
          <div class="filaform">
              <div class="label">C&oacute;digo del libro registral</div>
              <div class="component"><input name="codigo" type="text" class="listwizard selectwizard" size="10" value="{$codigo}"/></div>
              <div class="limpiar"></div>
          </div><!--filaform-->             
          <div class="filadatos noborde" style="float:right">
            <input class=" buttomadd submit" type="submit" value="Abrir"/>  
            <input name="abrir" type="hidden" value="1"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->                         
       </div><!--formulario-->
       {/if} 
    </form>
 </div>    