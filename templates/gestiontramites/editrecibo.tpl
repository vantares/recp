{literal}
<script type="text/javascript">
$().ready(function() {
	var reglas = {codigorecibo: "required", monto: {required:!$("#estaexcento").is(":checked"), number:true}, nombre: "required", sexo: "required", estadocivil: "required"};
	var mensajes = {codigorecibo: "Introduzca el codigo del recibo", monto: {required:"Este campo es requerido",number:"No es un monto valido"}, nombre: "Debe introducir el nombre de la persona que solicita el servicio", edad: "Debe introducir la edad de la persona", domicilio: "Debe introducir el domicilio", nacionalidad: "Debe introducir la nacionalidad"};
	//reglas['codigorecibo']= "required";

	$("#formedit").validate({
                rules: reglas,
                messages: mensajes
	});
    // validate signup form on keyup and submit
            
});
</script>
<script type="text/javascript"> 
$(function() {
	//code to hide topic selection, disable for demo
	//TODO: complete esta seccion de codigo
	//activar desactivar los controles al checkear
	var estaexcento= $("#estaexcento");
	var excento = $("#excento");
	var pagado = $("#pagado");
	// newsletter topics are optional, hide at first
	var inital = estaexcento.is(":checked");
	var pagoInputs = pagado.find("input, select, textarea").attr("disabled", inital);
	var excentoInputs = excento.find("input, select, textarea").attr("disabled", !inital);
	// show when newsletter is checked
	estaexcento.click(function() {
		excento[this.checked ? "addClass" : "removeClass"]("visible");
		excento[this.checked ? "removeClass" : "addClass"]("oculto");
		pagado[this.checked ? "removeClass" : "addClass"]("visible");
		pagado[this.checked ? "addClass" : "removeClass"]( "oculto");
		pagoInputs.attr("disabled", this.checked);
		excentoInputs.attr("disabled", !this.checked );
	});
	//End seccion
	//remplazar al bloque a continuacion
	/*
    $("#check").click(function() {  
        if($("#check").is(':checked')) {
            $('#excento').removeClass('oculto');
            $('#excento').addClass('visible');
            $('#excentopago').removeClass('visible');
            $('#excentopago').addClass('oculto'); 
            $('#codigorecibo').attr('value', $('#numerorecibo').val());
            $("#check").attr("checked",'true');
            $("#formedit").validate({
                rules: { 
                    idorganizacion: "required"      
                },
                messages: {  
                    idorganizacion: "especifique la oganizacion que patrocina el tramite"
                }
            }); 
        } else {
            $('#excento').removeClass('visible');
            $('#excento').addClass('oculto');
            $('#excentopago').removeClass('oculto');
            $('#excentopago').addClass('visible');    
            $('#codigorecibo').attr('value', '');         
            $("#check").attr("checked",'');
        }
    });
	*/
});
</script> 
{/literal}
<div id="cajadatos">  
    <form class="cmxform" id="formedit" method="post" action="">
      <div id="contenidowizard">
           <div class="headerwizardizq">{$titular|upper}</div>   
           <div class="limpiar"></div>
       </div><!--contenidowizard--> 
       <div class="limpiar"></div>

       <div class="formulario">
          <div class="filaform">
              <div class="label">C&oacute;digo del recibo:&nbsp;</div>
              <div class="component">
                  <input name="codigorecibo" id="codigorecibo" type="text" class="listwizard selectwizard" value="{$recibo->request.codigorecibo}"  /> 
                  <input name="numerorecibo" id="numerorecibo" type="hidden" value="{$numero}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          <div class="filaform">
              <div class="label">Excento de Pago:</div>
              <div class="component">
                  <input type="checkbox" id="estaexcento" name="estaexcento" value="1"> 
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
                  
            </div><!--excento-->
          </fieldset> 
          <fieldset>
             <legend>Cargar datos del Cliente</legend>
             <div id="cargando1" style="display:none; color: green;">Cargando...</div>
             <div id="persona">
                {include file="pagos/_persona.tpl"}
             </div>
          </fieldset>
          <br /> 
          <div id="pagado" class="visible">
          <fieldset>
             <legend>Datos del pago realizado</legend>
              <div class="filaform" style="padding-bottom: 5px;">
                  <div class="label">Monto:&nbsp;</div>   
                  <div class="component">
                      <input name="monto" id="monto" type="text" class="listwizard selectwizard" style="width:200px;" value="{$recibo->request.monto}" /> 
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
              
              <div class="filaform">
                  <div class="label">Concepto:&nbsp;</div>
                  <div class="component">
                      <input name="concepto" id="concepto" type="text" class="listwizard selectwizard" style="width:200px;" value="{$recibo->request.concepto}" /> 
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
     
              <div class="filaform">
                  <div class="label">C&oacute;digo:&nbsp;</div>
                  <div class="component">
                      <input name="codigo" id="codigo" type="text" class="listwizard selectwizard"  value="{$recibo->request.codigo}"  />
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
     
              <div class="filaform">
                  <div class="label">Forma de pago:&nbsp;</div>
                  <div class="component">
                        <select  id="formapago" name="formapago" {$disabled}>
                            {section name=id loop=$arrayFormapago}
                               <option value="{$arrayFormapago[id].idformapago}" {if $arrayFormapago[id].idformapago == $recibo->request.idformapago}}selected{/if}>{$arrayFormapago[id].formapago}</option>
                           {/section} 
                        </select>    
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->

              <div class="filaform">
                  <div class="label">N&uacute;mero de cheque:&nbsp;</div>
                  <div class="component">
                      <input name="numerocheque" id="numerocheque" type="text" class="listwizard selectwizard" value="{$recibo->request.numerocheque}"  />
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
		      
              <div class="filaform">
                  <div class="label">Banco:&nbsp;</div>
                  <div class="component">
                      <input name="banco" id="banco" type="text" class="listwizard selectwizard" style="width:200px;" value="{$recibo->request.banco}" />
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
		      
		      <div class="filaform">
                  <div class="label">C&oacute;digo de contribuyente:&nbsp;</div>
                  <div class="component">
                      <input name="codigocontribuyente" id="codigocontribuyente" type="text" class="listwizard selectwizard" value="{$recibo->request.codigocontribuyente}" />
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
     
              <div class="filaform">
                  <div class="label">N&uacute;mero de cuenta:&nbsp;</div>
                  <div class="component">
                      <input name="numerocuenta" id="numerocuenta" type="text" class="listwizard selectwizard" value="{$recibo->request.numerocuenta}" />
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
          </div>
	</fieldset>
          <div class="filadatos noborde" style="float:right">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="idrecibo" type="hidden" value="{$recibo->request.idrecibo}"/>
            <input name="tipo" type="hidden" value="{$tipo}"/>
            <div class="limpiar"></div>
          </div><!--filadatos--> 
     </div><!--formulario-->
    </form>
 </div>
