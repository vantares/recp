{literal}
<script type="text/javascript"> 
$(document).ready(
    function() {
  #     $("#cmdfechaentrega").load("/modulos/tramites/_fechaentrega.php",{valorcombo: $('#tipotramitecmb').val()});
    }

);
</script>
{/literal}
<div>        
<div class="filaform">
      <div class="label">Tipo de Tr&aacute;mite:</div>
      <div class="component">
          <select name="tipotramitecmb" id="tipotramitecmb"  class="listwizard selectwizard" disabled="disabled" >
             <option value="">Seleccionar Tr&aacute;mite</option>
             {section name=idtipotramite loop=$arrayTipotramite}
                <option value="{$arrayTipotramite[idtipotramite].tipotramite}" {if $arrayTipotramite[idtipotramite].idtipotramite == $tipotramite}selected{/if} >{$arrayTipotramite[idtipotramite].tipotramite}</option>
             {/section}
          </select>
          <input  type="hidden"  name="tipotramite" id="tipotramite" value="{$tipotramite}"/> 
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->
  <div id="cmdfechaentrega" class="filaform" style="padding-bottom: 10px;">
       {include file="tramites/_fechaentrega.tpl"}
  </div><!--filaform-->
  <div class="filaform">
      <div class="label">Titular Registral 1:</div>
      <div class="component">
          <input name="solicitante1" id="solicitante1" type="text" class="listwizard selectwizard" style="width:200px;" value="{$recibo->request.nombrecliente}"/>
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->

  <div class="filaform" id="compareciente2">
      <div class="label">Titular Registral 2:</div>
      <div class="component">
          <input name="solicitante2" id="solicitante2" type="text" class="listwizard selectwizard" style="width:200px;" value=""/>
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->
</div>
