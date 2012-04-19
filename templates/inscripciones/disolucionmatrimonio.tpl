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
            compareciente1nombre: {
                required: true
            },  
            compareciente1edad: {
                required: true,
                number: true
            },  
            testigo1cedula: {
                required: true,
            }, 
            testigo2cedula: {
                required: true,
            },                         
            fechainscripcion: {
                required: true
            },  
            fechadictament: {
                required: true
            }, 
            conyuge1partidainscripcion: {
                required: true,
                number: true
            },     
            conyuge1tomoinscripcion: {
                required: true,
                number: true
            },  
            conyuge1folioinscripcion: {
                required: true,
                number: true
            }, 
            conyuge2partidainscripcion: {
                required: true,
                number: true
            },     
            conyuge2tomoinscripcion: {
                required: true,
                number: true
            },  
            conyuge2folioinscripcion: {
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
            testigo1nombre: "required", 
            testigo2nombre: "required", 
            conyuge1lugarinscripcion: "required",  
            conyuge2lugarinscripcion: "required" 
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
            jueznotario: "El juez notario no puede estar vacio",                                     
            lugardictament: "El lugar disctament no puede estar vacio", 
            fechainscripcion: "Fecha de inscripcion no puede estar vacia",
            fechadictament: "Fecha dictament no puede estar vacia", 
            testigo1cedula: "Introduzca Cedula", 
            testigo2cedula: "Introduzca Cedula",  
            testigo1nombre: "Nombre del testigo no puede estar vacio", 
            testigo2nombre: "Nombre del testigo no puede estar vacio", 
            conyuge1lugarinscripcion: "El lugar Inscripcion no puede estar vacio", 
            conyuge1folioinscripcion: "Introduzca un n&uacute;mero",
            conyuge1tomoinscripcion: "Introduzca un n&uacute;mero",
            conyuge1partidainscripcion: "Introduzca un n&uacute;mero",   
            conyuge2lugarinscripcion: "El lugar Inscripcion no puede estar vacio", 
            conyuge2folioinscripcion: "Introduzca un n&uacute;mero",
            conyuge2tomoinscripcion: "Introduzca un n&uacute;mero",
            conyuge2partidainscripcion: "Introduzca un n&uacute;mero"                                                       
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
$(function() {
    $("#checkhijos").click(function() {  
        if($("#checkhijos").is(':checked')) {
            $('#hijos').removeClass('oculto');
            $('#hijos').addClass('visible');
            $("#checkhijos").attr("checked",'true'); 
        } else {
            $('#hijos').removeClass('visible');
            $('#hijos').addClass('oculto');
            $("#checkhijos").attr("checked",'');
        }
    });
});
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
    <br />  
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
            <div id="listadonota">
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
    <br /> 
    <div>  
        <label><input type="checkbox" name="checkhijos" id="checkhijos" {if $visiblehijo} checked="checked"{/if} value="1" />&nbsp;<b>HIJOS PROCREADOS</b>&nbsp;</label>
    </div>
    <fieldset id="hijos" class="{if $visiblehijo} visible  {else} oculto {/if}">
        <legend>Hijos</legend>
           <div id="cargando_reconocido" style="display:none; color: green;">Cargando...</div>
           <div>
              {include file="inscripciones/_hijoguardado.tpl"}
           </div>
            {if $visiblehijo}{include file="inscripciones/_listadoguardados.tpl"}{else}<div id="listadoreco"></div>{/if}           
    </fieldset> 
    {/if} 
     <br /> 
    <form id="inscripcion" name="inscripcion" action="{$url}" method="post">
    {include file="inscripciones/_generales.tpl"}
     <br /> 
    <fieldset>
        <legend>Custodia</legend>
        <table width="100%">
           <tr><td>La custodia quedando en:</td></tr>
        </table>
        <table width="100%">
            <tr>
                <td align="left"  width="360"><input type="text" name="custodionombre" value="{$disolucionmatrimonio->request.custodionombre}" {$disabled} size=60/></td>
            </tr>
            <tr>
                <td align="left">Nombre y Apellidos</td>
            </tr>
            <tr>
                <td class="left"><input type="text" id="pensionalimenticia" name="pensionalimenticia" value="{$disolucionmatrimonio->request.pensionalimenticia}" {$disabled}></td>
            </tr>
            <tr>
                <td class="left">Pension Alimenticia</td>
            </tr>
        </table>
    </fieldset>    
    <br />  
    <fieldset>
         <legend>Inscripcion de Propiedad</legend> 
            <table width="100%" border="0">
              <tr>
                <td colspan="2"><label>Tipo Inmueble
                  <select name="tipoinmuebleafectado" id="tipoinmuebleafectado">
                    <option value="rustico" {if $disolucionmatrimonio->request.tipoinmuebleafectado == 'rustico'} selected {/if}>Rustico</option>
                    <option value="urbano" {if $disolucionmatrimonio->request.tipoinmuebleafectado == 'urbano'} selected {/if}>Urbano</option>
                  </select>
                </label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="37%"><label>Asiento:
                  <input type="text" name="asientoregistroinmueble" id="asientoregistroinmueble" value="{$disolucionmatrimonio->request.asientoregistroinmueble}"/>
                </label></td>
                <td width="63%"><label>Registro de la propieda inmueble y mercantil
                  <input type="text" name="lugarregistroinmueble" id="lugarregistroinmueble" size=30 value="{$disolucionmatrimonio->request.lugarregistroinmueble}"/>
                </label></td>
              </tr>
              <tr>
                <td colspan="2">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"><table width="100%" border="0">
                  <tr>
                    <td><label>Tomo:
                      <input type="text" name="tomoregistroinmueble" id="tomoregistroinmueble" value="{$disolucionmatrimonio->request.tomoregistroinmueble}"/>
                    </label></td>
                    <td><label>Folio:
                      <input type="text" name="folioregistroinmueble" id="folioregistroinmueble" value="{$disolucionmatrimonio->request.folioregistroinmueble}"/>
                    </label></td>
                    <td><label>Partida
                      <input type="text" name="partidaregistroinmueble" id="partidaregistroinmueble" value="{$disolucionmatrimonio->request.partidaregistroinmueble}" />
                    </label></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2">Propietario del Inmueble:</td>
              </tr>
              <tr>
                <td colspan="2"><input type="text" name="propietarioinmueble" id="propietarioinmueble" size=60 value="{$disolucionmatrimonio->request.propietarioinmueble}" /></td>
              </tr>
            </table>         
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
        </table>
    </fieldset>
    <fieldset>
        <legend>Otros</legend>
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
    <div id="datosmatrimonio">
        <div>{include file="inscripciones/_datosmatrimonio.tpl"}</div>
    </div> 
   {/if}
   
</div><!--cajadatos-->
