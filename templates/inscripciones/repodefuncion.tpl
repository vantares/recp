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
            fechadefuncion: {
                required: true,
                daterangemax: "#fechanacimiento"
            },
            fechanacimiento: {
                required: true,
                daterangemin: "#fechadefuncion"
            },
            fechainscripcion: {
                required: true
            }, 
            fechadictament: {
                required: true
            },             
            tomoinscripcionnacimiento: {
                required: true,
                number: true
            }, 
            folioinscripcionnacimiento: {
                required: true,
                number: true
            }, 
            partidainscripcionnacimiento: {
                required: true,
                number: true
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
            causamuerte: "required",   
            ciudaddefuncion: "required", 
            municipiodefuncion: "required", 
            paisdefuncion: "required",   
            lugarinscripcionnacimiento: "required",  
            inscrito1nombre1: "required", 
            inscrito1apellido1: "required"  
        },
        messages: {
            folio: "Introduzca un numero",
            partida: "Introduzca un numero", 
            fechadefuncion: {
                required: "Fecha de defuncion no puede estar vacia",
                daterangemax: "La Fecha de defuncion no puede ser menor que la de nacimiento"
            },
            fechanacimiento: {
                required: "Fecha de nacimiento no puede estar vacia",
                daterangemin: "La Fecha de nacimiento no puede ser mayor que la de defuncion"
            },
            compareciente1cedula: "Introduzca un numero",
            compareciente1nombre: "El nombre del compareciente no puede estar vacio",
            compareciente1edad: "Introduzca un numero",              
            ciudadinscripcion: "La ciudad inscripcion no puede estar vacia",
            municipioinscripcion: "El municipio inscripcion no puede estar vacio", 
            departamentoinscripcion: "El departamento inscripcion no puede estar vacio",
            ciudadnacimiento: "La ciudad nacimiento no puede estar vacia", 
            causamuerte: "La causa de la muerte no pude estar vacia",  
            ciudaddefuncion: "La ciudad defuncion no pude estar vacia",
            municipiodefuncion: "El municipio defuncion no puede estar vacio", 
            paisdefuncion: "El pais defuncion no puede estar vacio", 
            lugarinscripcionnacimiento: "El lugar inscripcion de nacimiento no puede estar vacio",  
            tomoinscripcionnacimiento: "Introduzca un n&uacute;mero", 
            folioinscripcionnacimiento: "Introduzca un n&uacute;mero",
            partidainscripcionnacimiento: "Introduzca un n&uacute;mero",  
            inscrito1nombre1: "El primer nombre no puede estar vacio", 
            inscrito1apellido1: "El primer apellido no puede estar vacio",
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
    $("#fechadictament").datetimepicker();
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
       <div class="headerwizardizq">Reposici&oacute;n de defuncion</div> 
       <div id="opciones">
             <a href="/modulos/inscripciones/addrepodefuncion.php">Nueva</a>
       </div><!--opciones-->  
       <div id="opciones">
             <a href="/modulos/inscripciones/listarrepodefunciones.php">Listado</a>
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
    </fieldset>
    <br /> 
    <fieldset>
        <legend>Datos del Difunto </legend>
        <div id="cargando5" style="display:none; color: green;">Cargando...</div>   
        <div id="fallecido">
           <table width="100%">   
            {include file="inscripciones/_fallecido.tpl"}    
        </div>
    </fieldset> 
    <br /> 
    <fieldset>
        <legend>Acto Juridico</legend>
        <table width="100%">
            <tr>
                <td class="tcenter"><input type="text" name="jueznotario" value="{$repohechovital->request.jueznotario}" {$disabled}/></td>
                <td class="tcenter"><input type="text" name="nombrejuzgado" value="{$repohechovital->request.nombrejuzgado}"  {$disabled}/></td>
                <td class="tcenter"><input type="text" name="lugarjuzgado" value="{$repohechovital->request.lugarjuzgado}"  {$disabled}/></td>
            </tr>
            <tr>
                <td class="tcenter">Juez</td>
                <td class="tcenter">Nombre Juzgado</td>
                <td class="tcenter">Lugar Juzgado</td>
            </tr>
            <tr>
                <td class="tcenter"><input type="text" id="fechadictament" name="fechadictament" value="{$fechadictament}" {$disabled}></td>
            </tr>
            <tr>
                <td class="tcenter">Fecha dictamen</td>
            </tr>
        </table>
    </fieldset>  
    <br />     
    <fieldset>
        <legend>Datos del Nacimiento </legend>
        <div id="cargando6" style="display:none; color: green;">Cargando...</div>
        <div id="datosnacimiento">
            {include file="inscripciones/_nacimiento.tpl"}
        </div>
    </fieldset> 
    <br />  
    <fieldset>
        <legend>Otros</legend>
        <table>
            <tr><td><b>Fallecido  en el extranjero:</b><td></tr>
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
            <input  type="hidden"  name="tipoinscripcion" value="Reposicion Defuncion"/> 
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
