{literal}
<script type="text/javascript"> 
$(document).ready(
    function() {
        $("#tipoinscripcion").change (
            function() {
                if($("#tipoinscripcion").val() == 'Nacimientos') {
                     $("#compareciente2").removeClass('oculto'); 
                     $("#inscrito2").addClass('oculto'); 
                } else {
                   $("#compareciente2").addClass('oculto');
                   $("#inscrito2").removeClass('oculto');
                } 
                if(($("#tipoinscripcion").val() == 'Matrimonios') || ($("#tipoinscripcion").val() == 'Reposicion Matrimonio') 
                   || ($("#tipoinscripcion").val() == 'Disolucion Vinculo Matrimonial')) { 
                   $("#inscrito2").addClass('visible');
                   $("#compareciente2").addClass('oculto'); 
                } else {
                   $("#inscrito2").addClass('oculto'); 
                   $("#inscrito2").removeClass('visible'); 
                }
            }
        )
    }

);
</script>
<script type="text/javascript"> 
$().ready(function() {
    // validate signup form on keyup and submit
    $("#formedit").validate({
        rules: {
            tipotramitecmb: "required",
            solicitante1: "required",  
            solicitante2: {
                required: ($("#tipoinscripcion").val() == 'Nacimientos') ? true : false
            },
            nombreinscrito1: "required",
            nombreinscrito2: {
                required: (($("#tipoinscripcion").val() == 'Matrimonios') || ($("#tipoinscripcion").val() == 'Reposicion Matrimonio') || ($("#tipoinscripcion").val() == 'Disolucion Vinculo Matrimonial')) ? true : false
            },            
            cant: {
                required: true,
                number: true,
                maxlength: 2
            },
            tomo: {
                number: true,
                maxlength: 2
            },
            folio: {
                number: true,
                maxlength: 2
            },
            partida: {
                number: true,
                maxlength: 2
            },
            tipocertificacion: "required",
            tipoinscripcion: "required", 
            fechaentrega: {
                required: true,
                date: true
            }                          
        },
        messages: {
            tipotramitecmb: "Debe especificar el tipo de tramite que se desea realizar",
            solicitante1: "Especifique el Compareciente # 1",
            solicitante2: "Especifique el Compareciente # 2",
            cant: {
                required: "Introduzca la cantidad solicitada",
                number: "La cantidad debe ser un numero",
                maxlength: "El maximo numero de caracteres en este campo es 2"
            },
            tomo: {
                number: "Debe ser un numero",
                maxlength: "El maximo numero de caracteres en este campo es 2"
            },
            folio: {
                number: "Debe ser un numero",
                maxlength: "El maximo numero de caracteres en este campo es 2"
            },
            partida: {
                number: "Debe ser un numero",
                maxlength: "El maximo numero de caracteres en este campo es 2"
            },
            tipocertificacion: "Debe especificar el tipo de certificacion",
            tipoinscripcion: "Debe especificar el tipo de inscripcion", 
            nombreinscrito1: "Debe especificar el nombre del inscrito1",
            fechaentrega: "Introduzca una fecha de entrega valida"
        }           
    });
});
</script>

<script type="text/javascript">
$(function() {
    $("#fechaentrega").datepicker();
    $("#fechanacimiento").datepicker();
    $("#fecharegistro").datepicker();
    $("#fechainscripcion").datepicker();
});
</script>

<script type="text/javascript">
$(function() {
    $("#checkSolicitudInsc").click(function() {  
        if($("#checkSolicitudInsc").is(':checked')) {
            $('#SolicitudInsc').removeClass('oculto');
            $('#SolicitudInsc').addClass('visible');
            $("#checkSolicitudInsc").attr("checked",'true'); 
        } else {
            $('#SolicitudInsc').removeClass('visible');
            $('#SolicitudInsc').addClass('oculto');
            $("#checkSolicitudInsc").attr("checked",'');
        }
    });
});

$(function() {
    $("#checkSolicitudCert").click(function() {  
        if($("#checkSolicitudCert").is(':checked')) {
            $('#SolicitudCert').removeClass('oculto');
            $('#SolicitudCert').addClass('visible');
            $("#checkSolicitudCert").attr("checked",'true'); 
        } else {
            $('#SolicitudCert').removeClass('visible');
            $('#SolicitudCert').addClass('oculto');
            $("#checkSolicitudCert").attr("checked",'');
        }
    });
});

$(function() {
    $("#checkrecibo").click(function() {  
        if($("#checkrecibo").is(':checked')) {
            $('#reciboasociado').removeClass('oculto');
            $('#reciboasociado').addClass('visible');
            $("#checkrecibo").attr("checked",'true'); 
        } else {
            $('#reciboasociado').removeClass('visible');
            $('#reciboasociado').addClass('oculto');
            $("#checkrecibo").attr("checked",'');
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
             <a href="/gestiontramites/">Listado</a>
       </div><!--opciones-->           
           <div class="limpiar"></div>
       </div><!--contenidowizard--> 
       <div class="limpiar"></div>

       <div class="formulario">
          <div>  
             <label><input type="checkbox" name="checkrecibo" id="checkrecibo" value="1" />&nbsp;<b>DATOS DEL RECIBO</b>&nbsp;(marque para que pueda ver los datos del recibo asociado)</label>
          </div>
          <fieldset id="reciboasociado" class="oculto"> 
              <legend>Datos del Recibo Asociado</legend>  
               {include file="tramites/recibo.tpl"}
          </fieldset>  
          {if $tipo == "inscripcion"}  
          <fieldset id="SolicitudInsc" class="visible">
            <legend>Solicitud de inscripci&oacute;n</legend>
               <div id="cargando_reconocido" style="display:none; color: green;">Cargando...</div>
               <div class="filaform">
                  <div class="label">Tipo de inscripci&oacute;n:&nbsp;</div>
                       <div class="component">
                          <select name="tipoinscripcion" id="tipoinscripcion"  class="listwizard selectwizard"  >
                             <option value="">Seleccionar Tipo Inscripci&oacute;n</option>
                             {section name=inscripcion loop=$arrayRubros}
                                <option value="{$arrayRubros[inscripcion].nombre}">{$arrayRubros[inscripcion].nombre}</option>
                             {/section}
                          </select>  
                          <div class="limpiar"></div>
                      </div>
                  <div class="limpiar"></div>
               </div><!--filaform-->               
               <div id="persona">
                {include file="tramites/_solicitudtramite.tpl"}
               </div>
               <div id="reconocido">                              
                  <div class="filaform">
                      <div class="label">Nombre inscrito 1:&nbsp;</div>
                      <div class="component">
                          <input name="nombreinscrito1" id="nombreinscrito1" type="text" size="10" class="listwizard selectwizard" style="width:200px;" />
                          <div class="limpiar"></div>
                      </div>
                      <div class="limpiar"></div>
                  </div><!--filaform-->
                  
                  <div class="filaform" id="inscrito2">
                      <div class="label">Nombre inscrito 2:&nbsp;</div>
                      <div class="component">
                          <input name="nombreinscrito2" id="nombreinscrito2" type="text" size="10" class="listwizard selectwizard" style="width:200px;" /> 
                          <div class="limpiar"></div>
                      </div>
                      <div class="limpiar"></div>
                  </div><!--filaform-->
               </div>
               
               <div class="filaform" style="padding-bottom: 10px;">
                  <div class="label">Cantidad:&nbsp;</div>
                  <div class="component">
                      <input name="cant" id="cant" type="text" size="10" value="1" class="listwizard selectwizard" /> 
                      <div class="limpiar"></div>
                  </div>
                  <div class="limpiar"></div>
              </div><!--filaform-->
              
               <div class="filadatos noborde" style="float:right; margin-right:20px; margin-bottom:5px;" >
                  <input class=" asistenciabutton submit" type="submit"  id="salvar" name="salvar" value="Adicionar"/>  
                  <div class="limpiar"></div>
              </div><!--filadatos--> 
          </fieldset>
              <div>
                     {include file="tramites/_listadoinsc.tpl"} 
              </div>              
          {/if}  
          {if $tipo == "certificacion"}
          <fieldset id="SolicitudCert" class="visible">
            <legend>Solicitud de certificaci&oacute;n</legend>
               <div id="cargando_reconocido" style="display:none; color: green;">Cargando...</div>
               <div id="persona">
                {include file="tramites/_solicitudtramite.tpl"}
               </div>
               <div id="reconocido">
                     <div class="filaform">
                          <div class="label">Tipo de certificaci&oacute;n:&nbsp;</div>
                          <div class="component">
                              <select name="tipocertificacion" id="tipocertificacion"  class="listwizard selectwizard"  >
                                 <option value="">Seleccionar Tipo Certificaci&oacute;n</option>
                                 {section name=certificacion loop=$arrayRubros}
                                    <option value="{$arrayRubros[certificacion].nombre}">{$arrayRubros[certificacion].nombre}</option>
                                 {/section}
                              </select>  
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->
                      
                      <div class="filaform" style="padding-bottom: 10px;">
                          <div class="label">Fecha de nacimiento:&nbsp;</div>
                          <div class="component">
                              <input type="text" id="fechanacimiento" name="fechanacimiento" value="{$fechanacimiento}" {$disabled}/> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->
                      
                      <div class="filaform">
                          <div class="label">Nombre del padre:&nbsp;</div>
                          <div class="component">
                              <input name="nombrepadre" id="nombrepadre" type="text" size="10" class="listwizard selectwizard" style="width:200px;" /> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->
                      
                      <div class="filaform">
                          <div class="label">Nombre de la madre:&nbsp;</div>
                          <div class="component">
                              <input name="nombremadre" id="nombremadre" type="text" size="10" class="listwizard selectwizard" style="width:200px;" /> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->
                      
                      <div class="filaform">
                          <div class="label">Tomo:&nbsp;</div>
                          <div class="component">
                              <input name="tomo" id="tomo" type="text" size="10" class="listwizard selectwizard" /> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->

                      <div class="filaform">
                          <div class="label">Folio:&nbsp;</div>
                          <div class="component">
                              <input name="folio" id="folio" type="text" size="10" class="listwizard selectwizard" /> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->

                      <div class="filaform">
                          <div class="label">Partida:&nbsp;</div>
                          <div class="component">
                              <input name="partida" id="partida" type="text" size="10" class="listwizard selectwizard" /> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->

                      <div class="filaform">
                          <div class="label">A&ntilde;o:&nbsp;</div>
                          <div class="component">
                              <input name="anyo" id="anyo" type="text" size="10" value="{$anyo}" class="listwizard selectwizard" /> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->

                      <div class="filaform" style="padding-bottom: 10px;">
                          <div class="label">Fecha de registro:&nbsp;</div>
                          <div class="component">
                              <input type="text" id="fecharegistro" name="fecharegistro" value="{$fecharegistro}" {$disabled}/> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->
                      
                      <div class="filaform" style="padding-bottom: 10px;">
                          <div class="label">Fecha de inscripcion:&nbsp;</div>
                          <div class="component">
                              <input type="text" id="fechainscripcion" name="fechainscripcion" value="{$fechainscripcion}" {$disabled}/> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->
                      
                      <div class="filaform" style="padding-bottom: 10px;">
                          <div class="label">Cantidad:&nbsp;</div>
                          <div class="component">
                              <input name="cant" id="cant" type="text" size="10" value="1" class="listwizard selectwizard" /> 
                              <div class="limpiar"></div>
                          </div>
                          <div class="limpiar"></div>
                      </div><!--filaform-->
               </div> 
              <div class="filadatos noborde" style="float:right; margin-right:20px; margin-bottom:5px;" >
                <input class=" asistenciabutton submit" type="submit"  id="salvar" name="salvar" value="Adicionar"/>  
                <div class="limpiar"></div>
              </div><!--filadatos-->                              
          </fieldset>
              <div>
                     {include file="tramites/_listadocertif.tpl"} 
              </div>
         {/if}          
         <div class="limpiar">&nbsp;</div>
          <div class="filadatos noborde" style="float:right;">
            {if $solicitudes}
                <a href="{'/modulos/tramites/_finalizarrecibo.php/'|cat:$recibo->request.idrecibo}"><img src="/imagenes/buttom_end.jpg" width="131" height="21" /></a>
            {/if}  
            <div class="limpiar"></div>
          </div><!--filadatos-->
          <div class="limpiar"></div>                 
     </div><!--formulario-->
    </form>
    
 </div>
