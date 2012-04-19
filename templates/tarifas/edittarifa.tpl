{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#formedit").validate({
        rules: {
            monto: "required",
            diasespera: "required", 
            idtipotramite: "required"   
        },
        messages: {
            monto: "Introduzca el monto a pagar",
            diasespera: "Introduzca los dias de espera",  
            idtipotramite: "Introduzca el tipo de tramite"
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
                 <a href="{'/modulos/tarifas/'}">Listado de Tarifas</a>
           </div><!--opciones-->
           <div class="limpiar"></div>
       </div><!--contenidowizard--> 
       <div class="limpiar"></div>

       <div class="formulario">
          <div class="filaform">
              <div class="label">Monto:</div>
              <div class="component">
                  <input name="monto" id="monto" type="text" class="listwizard selectwizard" value="{$tarifa->request.monto}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">D&iacute;as de espera:</div>
              <div class="component">
                  <input name="diasespera" id="diasespera" type="text" class="listwizard selectwizard" value="{$tarifa->request.diasespera}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          
 
          <div class="filaform">
              <div class="label">Tipo de Tramite:</div>
              <div class="component">
                  <select name="idtipotramite" id="idtipotramite"  class="listwizard selectwizard" >
                     <option value="">Selecionar Tipo Tramite</option>
                     {section name=tipotramite loop=$arrayTipotramites}
                        <option value="{$arrayTipotramites[tipotramite].idtipotramite}" {if $arrayTipotramites[tipotramite].idtipotramite == $tarifa->request.idtipotramite}selected{/if}>{$arrayTipotramites[tipotramite].tipotramite}</option>
                     {/section}
                  </select>
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filadatos noborde" style="float:right">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="idtarifa" type="hidden" value="{$tarifa->request.idtarifa}"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->
               
     </div><!--formulario-->
    </form>
 </div>