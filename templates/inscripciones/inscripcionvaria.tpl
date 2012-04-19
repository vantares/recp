{literal}
<script type="text/javascript"> 
$().ready(function() {
    // validate signup form on keyup and submit
    $("#inscripcion").validate({
        rules: {
            codigo: "number",
            folio: {
                required: true,
                number: true               
            },
            partida: {
                required: true,
                number: true            
            },
            compareciente1cedula: {
                required: true,
            },
            compareciente1nombre: {
                required: true
            },  
            compareciente1edad: {
                required: true,
                number: true
            }, 
            fechainscripcion: {
                required: true
            },  
            fechadictament: {
                required: true
            },                    
            folioinscripcion: {
                required: true,
                number: true               
            },
            tomoinscripcion: {
                required: true,
                number: true               
            },            
            partidainscripcion: {
                required: true,
                number: true            
            },
            inscrito1nombre1: "required", 
            inscrito1apellido1: "required",  
            //inscrito1apellido2: "required", 
            inscrito2nombre1: "required", 
            inscrito2apellido1: "required",  
            //inscrito2apellido2: "required",  
            jueznotario: "required",  
            lugardictament: "required", 
            partesconducentes: "required"            
        },
        messages: {
            codigo: "El C&oacute;digo tiene que ser un n&uacute;mero",
            folio: "Introduzca un n&uacute;mero",
            partida: "Introduzca un n&uacute;mero", 
            compareciente1cedula: "Introduzca un numero", 
            compareciente1nombre: "El nombre del compareciente no puede estar vacio",
            compareciente1edad: "Introduzca un numero",
            inscrito1nombre1: "El primer nombre no puede estar vacio", 
            inscrito1apellido1: "El primer apellido no puede estar vacio",
            //inscrito1apellido2: "El segundo apellido no puede estar vacio", 
            inscrito2nombre1: "El primer nombre no puede estar vacio", 
            inscrito2apellido1: "El primer apellido no puede estar vacio",
            //inscrito2apellido2: "El segundo apellido no puede estar vacio",         
            folioinscripcion: "El folio tiene que ser un n&uacute;mero",
            tomoinscripcion: "El tomo tiene que ser un n&uacute;mero",
            partidainscripcion: "La partida tiene que ser un n&uacute;mero",
            jueznotario: "El juez notario no puede estar vacio",
            lugardictament: "El lugar disctament no puede estar vacio", 
            fechainscripcion: "Fecha de inscripcion no puede estar vacia",
            fechadictament: "Fecha dictament no puede estar vacia", 
            partesconducentes: "La parte conducente no puede estar vacio"             

        }
    });
});
</script>
<script type="text/javascript">
$(function() {
    $("#fechainscripcion").datetimepicker();
});
$(function() {
    $("#fechadictament").datetimepicker();
});
</script>
<script type="text/javascript"> 
    function setFolioPartida(tomo) {
        var partida = document.inscripcion.elements['partidas['+tomo+']'];
        var folio = document.inscripcion.elements['folios['+tomo+']'];
        document.inscripcion.folio.value =  folio.value;
        document.inscripcion.partida.value =  partida.value; 
    }
</script>
<script type="text/javascript"> 
$(document).ready(
    function() {
        $("#tipootrainscripcion").change (
            function() {
                $("#template").load("cargartemplate.php",{valorcombo: this.value});
            }
        )
    }

);
</script>
<script type="text/javascript">
$(function() {
    $("#checknotamarginal").click(function() {  
        if($("#checknotamarginal").is(':checked')) {
            $('#notamarginal').removeClass('oculto');
            $('#notamarginal').addClass('visible');
            $("#checknotamarginal").attr("checked",'true'); 
        } else {
            $('#notamarginal').removeClass('visible');
            $('#notamarginal').addClass('oculto');
            $("#checknotamarginal").attr("checked",'');
        }
    });
});
</script>
{/literal} 
<div id="cajadatos">
    <div id="contenidowizard">
       <div class="headerwizardizq">{$titular}</div> 
       <div id="opciones">
             <a href="{$urladd}">Nueva</a>
       </div><!--opciones-->  
       <div id="opciones">
             <a href="{$urllistado}">Listado</a>
       </div><!--opciones-->           
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    {if $notice != ''} 
       {include file="notice.tpl"}
    {else} 
    {if $etiqueta == 'edit'} 
    <br /> 
    <div>  
        <label><input type="checkbox" name="checknotamarginal" id="checknotamarginal" {if $visiblenotamarginal} checked="checked"{/if} value="1" />&nbsp;<b>MODIFICACIONES EN EL REGISTRO CIVIL</b>&nbsp;(marque para que pueda asentar las modificaciones)</label>
    </div>
    <fieldset id="notamarginal" class="{if $visiblenotamarginal} visible  {else} oculto {/if}">
        <legend>Modificaciones del Registro civil</legend>
           <div id="notamarginal">
              {include file="inscripciones/_addnotamarginal.tpl"}
           </div>
            {if $visiblenotamarginal}
            <div id="listadoreco">
                 <div class="filaencabezado">
                      <div  class="filaencabezadoli primerafila" style="width:7%">Id</div> 
                       <div  class="filaencabezadoli " style="width:57%; text-align:center">T&iacute;tulo</div>
                       <div  class="filaencabezadoli" style="width:17%; text-align:center">&nbsp;</div> 
                       <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div> 
                       <div class="limpiar"></div>
                  </div><!--filaencabezado-->
                  <div class="listado noheight">
                   {if $notasmarginalesbd}
                       {section name=id loop=$notasmarginalesbd}
                        <div class="filadatos">
                            <div  class="filaencabezadoli primerafila" style="width:7%">{$notasmarginalesbd[id]->request.idnotamarginal}</div>
                            <div class="filadatosli" style="width:57%; text-align:center">{$notasmarginalesbd[id]->request.actomodificador}</div>
                                <div class="filadatosli" style="width:17%; text-align:center">&nbsp;</div>  
                            <div class="filadatosli noborde" style="width:15%; text-align:center" >
                               <div  class="floatleft icons">  
                                  <a href="{'/modulos/inscripciones/notamarginal.php'|cat:'/'|cat:$notasmarginalesbd[id]->request.idnotamarginal|cat:'/'|cat:$notasmarginalesbd[id]->request.idinscripcion}" target="_blank" ><img src="/imagenes/iconrefresh.png" alt="detalles" title="detalles" width="18" height="18" /></a>
                               </div>  
                               <div  class="floatleft icons">  
                                  <a class="classnotamarginal" href="{'/modulos/inscripciones/__deletenotamarginal.php'|cat:'/'|cat:$notasmarginalesbd[id]->request.idnotamarginal|cat:'/'|cat:$notasmarginalesbd[id]->request.idinscripcion}"><img src="/imagenes/iconcancelar1.png" alt="delete" title="delete" width="18" height="18" /></a>
                               </div>                                
                               <div class="limpiar"></div>  
                            </div>                
                            <div class="limpiar"></div>
                      </div><!--filadatos-->
                      {/section}
                  {/if}
                </div><!--listado-->       
            </div>
            {/if}           
           
    </fieldset> 
    {/if} 
     <br />        
     <form id="inscripcion" name="inscripcion" action="{$url}" method="post" > 
        {include file="inscripciones/_generales.tpl"}
        <br />  
        <fieldset>
            <legend>COMPARECIENTES</legend>
               <div id="cargando1" style="display:none; color: green;">Cargando...</div>
               <div id="comparecientes1">
                  {include file="inscripciones/_comparecientes1.tpl"}
               </div>
        </fieldset>
        <br />
        <fieldset>
            <legend>Acto Juridico</legend>
            <table width="100%">
                <tr>
                    <td class="tcenter"><input type="text" name="jueznotario" value="{$actojuridico->request.jueznotario}" {$disabled}/></td>
                    <td class="tcenter"><input type="text" name="nombrejuzgado" value="{$actojuridico->request.nombrejuzgado}"  {$disabled}/></td>
                    <td class="tcenter"><input type="text" name="lugarjuzgado" value="{$actojuridico->request.lugarjuzgado}"  {$disabled}/></td>
                    <td class="tcenter"><input type="text" id="fechadictament" name="fechadictament" value="{$fechadictament}" {$disabled}></td>
                </tr>
                <tr>
                    <td class="tcenter">Juez/Notario</td>
                    <td class="tcenter">Nombre Juzgado</td>
                    <td class="tcenter">Lugar Juzgado</td>
                    <td class="tcenter">Fecha dictamen</td> 
                </tr>
                <tr>
                  <td colspan="4" align="left"><label>Parte Conducente:
                     <textarea cols="50" name="partesconducentes" rows="5"  {$disabled}>{$inscripcionvaria->request.partesconducentes}</textarea>
                  </label></td>
                </tr>

            </table>            
        </fieldset> 
        <fieldset>
            <legend>Tipo de Inscripcion</legend>
              <table width="100%">
                <tr>
                  <td colspan="4" align="left"  style="padding-left:10px;">
                     {if $etiqueta != 'edit'}
                      <select name="tipootrainscripcion" id="tipootrainscripcion" {$disabled}>
                        <option value="reconocimiento">Reconocimiento de Filiaci&oacute;n</option>
                        <option value="declaracion mayoria edad">Declaraci&oacute;n de Mayor&iacute;a de Edad</option>
                        <option value="anulacion de asientos registrales">Cancelaci&oacute;n de Asientos Registrales</option>                         
                        <option value="rectificacion de partida nacimiento">Rectificaci&oacute;n de Partida</option>                         
                        <option value="guarda">Otorgar la Guarda</option>   
                        <option value="emancipacion">Emancipaci&oacute;n</option> 
                        <option value="declararacion ausencia">Declaraci&oacute;n de Ausencia</option>
                        <option value="interdiccion">Interdicci&oacute;n Civil</option>
                        <option value="posesion notoria estado">Posesi&oacute;n Notoria del Estado</option> 
                        <option value="identificacion notarial">Identificaci&oacute;n Notarial</option>   
                      </select>
                     {else}
                         {$inscripcionvaria->request.tipootrainscripcion}  
                         <input  type="hidden"  name="tipootrainscripcion" value="{$inscripcionvaria->request.tipootrainscripcion}"/> 
                     {/if}
                  </td>
                </tr>              
              </table>               
        </fieldset>        
        <br />  
          <div id=template>
              {include file="inscripciones/_tipootrainscripcion.tpl"}
          </div>
        <br /> 
        <fieldset>
        <legend>Otros</legend>
        <br />  
        <table>
            <tr><td><b>En el extranjero:</b><td></tr>
            <tr><td><textarea cols="50" name="enextranjero" rows="5"  {$disabled}>{$inscripcion->request.enextranjero}</textarea><td></tr>
        </table>
        <br />  
        <table>
            <tr><td><b>Observaciones</b><td></tr>
            <tr><td><textarea cols="50" name="observaciones" rows="5"  {$disabled}>{$inscripcion->request.observaciones}</textarea><td></tr>
        </table>
        <br />
        <table>
            <tr><td><b>Datos Adicionales</b><td></tr>
            <tr><td><textarea cols="50" name="datosadicionales" rows="5"  {$disabled}>{$inscripcion->request.datosadicionales}</textarea><td></tr>
        </table>          
        </fieldset> 
        <br /> 
        <fieldset>
            <legend>Registro</legend>
            <table>
            <tr>
                <td>Registrador</td>
                <td>
                      <select name="nombreregistrador" class="listwizard selectwizard"  {$disabled}>
                          {section name=id loop=$Registradores}
                             <option value="{$Registradores[id].nombreusuario}" {if $Registradores[id].nombreusuario == $inscripcion->request.nombreregistrador}selected{/if}>{$Registradores[id].nombreusuario}</option>
                          {/section}
                       </select>
                </td>
                <td>Secretario</td>
                <td>
                      <select name="nombresecretario" class="listwizard selectwizard"  {$disabled}>
                          {section name=id loop=$Secretarios}
                             <option value="{$Secretarios[id].nombreusuario}" {if $Secretarios[id].nombreusuario == $inscripcion->request.nombresecretario}selected{/if}>{$Secretarios[id].nombreusuario}</option>
                          {/section}
                       </select>            
                 </td>
            </tr>
            </table>
        </fieldset> 
        <br /> 
        <div class="filadatos noborde" style="float:right">
        {if $add == ''}
            <input  type="hidden"  name="idinscripcion" value="{$inscripcion->request.idinscripcion}"/>
            <input  type="hidden"  name="id" value="{$inscripcion->request.idinscripcion}"/>
            <input  type="hidden"  name="tipoinscripcion" value="Inscripciones Varias"/> 
            <input  type="hidden"  name="numeroserie" value="{$inscripcion->request.numeroserie}"/> 
            <input  type="hidden"  name="municipioinscripcion" value="{$inscripcion->request.municipioinscripcion}"/>
            <input  type="hidden"  name="ciudadinscripcion" value="{$inscripcion->request.ciudadinscripcion}"/>
            <input  type="hidden"  name="departamentoinscripcion" value="{$inscripcion->request.departamentoinscripcion}"/>             
        {/if}
        {if $disabled == ''}
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="salvar"/>  
        {/if}    
        <div class="limpiar"></div>
       </div><!--filadatos-->                                           
     </form>
    {/if}
</div><!-- Caja Datos -->
