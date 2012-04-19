       <div class="formulario">
		<input type="hidden" name="idrecibo" id="idrecibo" value="{$recibo.idrecibo}"/>
          <div class="filaform">
              <div class="label">C&oacute;digo del recibo:&nbsp;</div>
              <div class="component">
                  <input name="codigorecibo" id="codigorecibo" type="text" class="listwizard selectwizard" value="{$recibo.codigorecibo}"  /> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          <div class="filaform" style="padding-bottom: 5px;">
              <div class="label">Nombre del Cliente:&nbsp;</div>
              <div class="component">
                  <input name="nombre" id="nombre" type="text" class="listwizard selectwizard" style="width:200px;" value="{$recibo.nombrecliente}"  /> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          {if $excento != 'excento'}
          <div class="filaform" style="padding-bottom: 5px;">
              <div class="label">Monto:&nbsp;</div>   
              <div class="component">
			        <input name="monto" id="monto" type="text" class="listwizard selectwizard" style="width:100px;" value="{$recibo.monto}"  />
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
		  {/if}
          
          <div class="filaform">
              <div class="label">Concepto:&nbsp;</div>
              <div class="component">
                      <input name="concepto" id="concepto" type="text" class="listwizard selectwizard" style="width:200px;" value="{$recibo.concepto}"  /> 
               </div>  
               <div class="limpiar"></div>
          </div><!--filaform-->
          <div class="filaform">
              <div class="label">C&oacute;digo:&nbsp;</div>
              <div class="component">
                  <input name="codigo" id="codigo" type="text" class="listwizard selectwizard"  value="{$recibo.codigo}"  />
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
              <div class="filaform">
                  <div class="label">Forma de pago:&nbsp;</div>
                  <div class="component">
                        <select  id="formapago" name="formapago"  >
                            {section name=id loop=$arrayFormapago}
                               <option value="{$arrayFormapago[id].idformapago}" {if $arrayFormapago[id].idformapago == $recibo.idformapago}}selected{/if}>{$arrayFormapago[id].formapago}</option>
                           {/section} 
                        </select>    
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
          
          {if $solicitud->request.excento != "t"}  
          <div class="filaform">
              <div class="label">N&uacute;mero de cheque:&nbsp;</div>
              <div class="component">
                  <input name="numerocheque" id="numerocheque" type="text" class="listwizard selectwizard" value="{$recibo.numerocheque}"  />
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
		  
          <div class="filaform">
              <div class="label">Banco:&nbsp;</div>
              <div class="component">
                  <input name="banco" id="banco" type="text" class="listwizard selectwizard" style="width:200px;" value="{$recibo.banco}"  />
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
		  
		  <div class="filaform">
              <div class="label">C&oacute;digo de contribuyente:&nbsp;</div>
              <div class="component">
                  <input name="codigocontribuyente" id="codigocontribuyente" type="text" class="listwizard selectwizard" value="{$recibo.codigocontribuyente}"  />
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">N&uacute;mero de cuenta:&nbsp;</div>
              <div class="component">
                  <input name="numerocuenta" id="numerocuenta" type="text" class="listwizard selectwizard" value="{$recibo.numerocuenta}"  />
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          {/if}
     </div><!--formulario-->
