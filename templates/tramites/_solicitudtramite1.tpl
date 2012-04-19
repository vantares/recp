<div>        
<div class="filaform">
      <div class="label">Tipo de Tr&aacute;mite:</div>
      <div class="component">
          <select name="tipotramite" id="tipotramite"  class="listwizard selectwizard"  >
             <option value="">Seleccionar Tr&aacute;mite</option>
             {section name=idtipotramite loop=$arrayTipotramite}
                <option value="{$arrayTipotramite[idtipotramite].nombre}" {if $arrayTipotramite[idtipotramite].idtipotramite == $tipotramite->request.idtipotramite}selected{/if}>{$arrayTipotramite[idtipotramite].nombre}</option>
             {/section}
          </select>  
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->

  <div class="filaform">
      <div class="label">Excento de Pago:</div>
      <div class="component">
          <input type="checkbox" id="check" name="check" value="1"> 
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->
  <fieldset id="excento" class="{if $excento} visible  {else} oculto {/if}">
    <legend>Patrocinio</legend>
    <div id="cargando_reconocido" style="display:none; color: green;">Cargando...</div>
    <div id="reconocido">
    
      <div class="filaform">
          <div class="label">Organizaci&oacute;n:</div>
          <div class="component">
              <select name="idorganizacion" id="idorganizacion"  class="listwizard selectwizard"  >
                 <option value="">Seleccionar Organizacion</option>
                 {section name=organizacion loop=$arrayOrganizacion}
                    <option value="{$arrayOrganizacion[organizacion].idorganizacion}">{$arrayOrganizacion[organizacion].nombre}</option>
                 {/section}
              </select>  
              <div class="limpiar"></div>
          </div>
          <div class="limpiar"></div>
      </div><!--filaform-->
          
    </div><!--reconocido-->
  </fieldset> 
  
  <div class="filaform">
      <div class="label">Prioridad:</div>
      <div class="component">
          <input name="prioridad" id="prioridad" type="text" class="listwizard selectwizard" style="width:100px;" value=""/> 
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->

  <div class="filaform" style="padding-bottom: 10px;">
      <div class="label">Fecha de Entrega:</div>
      <div class="component">
          <input type="text" id="fechaentrega" name="fechaentrega" value="{$fechaentrega}" {$disabled}/>
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->

  <div class="filaform">
      <div class="label">Estado:</div>
      <div class="component">
          <input name="estado" id="estado" type="text" class="listwizard selectwizard" style="width:200px;" value=""/>
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->

  <div class="filaform">
      <div class="label">Solicitante 1:</div>
      <div class="component">
          <input name="solicitante1" id="solicitante1" type="text" class="listwizard selectwizard" style="width:200px;" value=""/>
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->

  <div class="filaform">
      <div class="label">Solicitante 2:</div>
      <div class="component">
          <input name="solicitante2" id="solicitante2" type="text" class="listwizard selectwizard" style="width:200px;" value=""/>
          <div class="limpiar"></div>
      </div>
      <div class="limpiar"></div>
  </div><!--filaform-->
</div>