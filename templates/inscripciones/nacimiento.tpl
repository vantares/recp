{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#inscripcion").validate({
        rules: {
            folio: {
                required: true,
                number: true               
            },
            partida: {
                required: true,
                number: true            
            },
            compareciente1nombre: {
                required: true
            },  
            compareciente1edad: {
                required: true,
                number: true
            }, 
            fechanacimiento: {
                required: true
            }, 
            fechainscripcion: {
                required: true
            }, 
            cedulapadre: {
                notEqualTo: "#cedulamadre",
            },    
            cedulamadre: {
                notEqualTo: "#cedulapadre",
            },    
            nombremadre: {
                notEqualTo: "#padrenombre"
            },       
            padrenombre: {
                notEqualTo: "#nombremadre"
            },                                                
            inscrito1nombre1: "required", 
            inscrito1apellido1: "required",  
            ciudadinscripcion: "required", 
            municipioinscripcion: "required",
            departamentoinscripcion: "required",
            ciudadnacimiento: "required",  
            municipionacimiento: "required",
            departamentonacimiento: "required", 
            paisnacimiento: "required", 
            compareciente1cedula: "required" 
                       
        },
        messages: {
            folio: "Introduzca un numero",
            partida: "Introduzca un numero", 
            compareciente1cedula: "Introduzca un numero", 
            compareciente1nombre: "El nombre del compareciente no puede estar vacio",
            compareciente1edad: "Introduzca un numero", 
            inscrito1nombre1: "El primer nombre no puede estar vacio", 
            inscrito1apellido1: "El primer apellido no puede estar vacio",
            ciudadinscripcion: "La ciudad inscripcion no puede estar vacia",
            municipioinscripcion: "El municipio inscripcion no puede estar vacio", 
            departamentoinscripcion: "El departamento inscripcion no puede estar vacio",
            ciudadnacimiento: "La ciudad nacimiento no puede estar vacia", 
            municipionacimiento: "El municipio nacimiento no puede estar vacio",
            departamentonacimiento: "El departamento nacimiento no puede estar vacio",
            paisnacimiento: "El pais nacimiento no puede estar vacio", 
            fechanacimiento: "Fecha de nacimiento no puede estar vacia", 
            fechainscripcion: "Fecha de inscripcion no puede estar vacia",  
            cedulapadre: {
                notEqualTo: "La cedula de los padres no puede ser la misma"
            },   
            cedulamadre: {
                notEqualTo: "La cedula de los padres no puede ser la misma"
            },  
            nombremadre:"El nombre de los padres no puede ser la misma",
            padrenombre:"El nombre de los padres no puede ser la misma"                        
        }
    });
   
});
</script>
<script type="text/javascript">
$(function() {
    $("#fechainscripcion").datetimepicker();
});
$(function() {
    $("#fechanacimiento").datetimepicker();
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
       <div class="headerwizardizq">Inscripci&oacute;n de nacimiento</div> 
       <div id="opciones">
             <a href="/modulos/inscripciones/addnacimiento.php">Nueva</a>
       </div><!--opciones-->  
       <div id="opciones">
             <a href="/modulos/inscripciones/listarnacimientos.php">Listado</a>
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
     <br />
    {/if} 
    <form name="inscripcion" action="{$url}" method="post" id="inscripcion">
    {include file="inscripciones/_generales.tpl"}
    <br />
    <fieldset>
        <legend>COMPARECIENTES</legend>
           <div id="cargando1" style="display:none; color: green;">Cargando...</div>
           <div id="comparecientes1">
              {include file="inscripciones/_comparecientes1.tpl"}
           </div>
           <div id="cargando2" style="display:none; color: green;">Cargando...</div>
           <div id="comparecientes2">{include file="inscripciones/_comparecientes2.tpl"}</div>
    </fieldset>
    <br />
    <fieldset>
        <legend>Titular </legend>
        <table width="100%">
            <tr>
                <td>Nacido<input type="hidden" name="persona1" value=""></td>
            </tr>
            <tr>
                <td class="tcenter"><input type="text" name="inscrito1nombre1" value="{$inscripcion->request.inscrito1nombre1}" {$disabled}/></td>
                <td class="tcenter"><input type="text" name="inscrito1nombre2" value="{$inscripcion->request.inscrito1nombre2}"  {$disabled}/></td>
                <td class="tcenter"><input type="text" name="inscrito1apellido1" value="{$inscripcion->request.inscrito1apellido1}"  {$disabled}/></td>
                <td class="tcenter"><input type="text" name="inscrito1apellido2" value="{$inscripcion->request.inscrito1apellido2}" {$disabled}/></td>
            </tr>
            <tr>
                <td class="tcenter">Nombre 1</td>
                <td class="tcenter">Nombre 2</td>
                <td class="tcenter">Apellido 1</td>
                <td class="tcenter">Apellido 2</td>
            </tr>
            <tr>
                <td class="tcenter">
                <select name="sexoinscrito" {$disabled}>
                    <option value="m"  {if $sexoinscrito == 'm'}selected{/if}>Masculino</option>
                    <option value="f" {if $sexoinscrito == 'f'}selected{/if}>Femenino</option>
                </select>
                </td>
                <td class="tcenter"><input type="text" id="fechanacimiento" name="fechanacimiento" value="{$fechanacimiento}" {$disabled}></td>
            </tr>
            <tr>
                <td class="tcenter">Sexo</td>
                <td class="tcenter">Fecha Nacimiento</td>
            </tr>
            <tr>
                <td class="tcenter"><input type="text" name="ciudadnacimiento" value="{$Provincia}"  {$disabled} /></td>
                <td class="tcenter"><input type="text" name="municipionacimiento" value="{$Municipio}"  {$disabled} /></td>
                <td class="tcenter"><input type="text" name="departamentonacimiento" value="{$Departamento}"  {$disabled} /></td>
                <td class="tcenter"><input type="text" name="paisnacimiento" value="{$Pais}"  {$disabled} /></td>
            </tr>
            <tr>
                <td class="tcenter">Ciudad/Comarca</td>
                <td class="tcenter">Municipio</td>
                <td class="tcenter">Departamento</td>
                <td class="tcenter">Pais</td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend>Otros</legend>
        <table>
            <tr><td><b>Nacido  en el extranjero:</b><td></tr>
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
            <legend>Padres</legend>
               <div id="cargando3" style="display:none; color: green;">Cargando...</div>
               <div id="padre">
                  {include file="inscripciones/_padre.tpl"}
               </div>
               <div id="cargando4" style="display:none; color: green;">Cargando...</div>
               <div id="madre">{include file="inscripciones/_madre.tpl"}</div>
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
      <div class="filadatos noborde" style="float:right">
        {if $add == ''}
            <input  type="hidden"  name="idinscripcion" value="{$inscripcion->request.idinscripcion}"/>
            <input  type="hidden"  name="tipoinscripcion" value="Nacimientos"/> 
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
</div><!--cajadatos-->
