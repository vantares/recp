{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#inscripcion").validate({
        rules: {
            folio: {
                required: true,
                number: true,               
            },
            partida: {
                required: true,
                number: true,            
            },
            compareciente1cedula: {
                required: true,
                number: true,            
            },  
            fechadefuncion: {
                required: true,
            },
            fechanacimiento: {
                required: true,
            }, 
            fechainscripcion: {
                required: true,
            },                
            compareciente1nombre: {
                required: true,
            },  
            compareciente1edad: {
                required: true,
                number: true,
            },     
            tomoinscripcionnacimiento: {
                required: true,
                number: true,
            }, 
            folioinscripcionnacimiento: {
                required: true,
                number: true,
            }, 
            partidainscripcionnacimiento: {
                required: true,
                number: true,
            },  
            cedulafallecido: {
                notEqualTo: "#compareciente1cedula",
            },
            inscrito1nombre1: "required", 
            inscrito1apellido1: "required",  
            inscrito1apellido2: "required", 
            ciudadnacimiento: "required",  
            municipionacimiento: "required",
            departamentonacimiento: "required", 
            paisnacimiento: "required", 
            ciudadinscripcion: "required", 
            municipioinscripcion: "required",
            departamentoinscripcion: "required",   
            causamuerte: "required",   
            ciudaddefuncion: "required", 
            municipiodefuncion: "required", 
            paisdefuncion: "required", 
            lugarinscripcionnacimiento: "required",   
        },
        messages: {
            folio: "Introduzca un n&uacute;mero",
            partida: "Introduzca un n&uacute;mero", 
            fechadefuncion: "Fecha de defuncion no puede estar vacia",
            fechanacimiento: "Fecha de nacimiento no puede estar vacia", 
            fechainscripcion: "Fecha de inscripcion no puede estar vacia",
            compareciente1cedula: "Introduzca un numero",
            inscrito1nombre1: "El primer nombre no puede estar vacio", 
            inscrito1apellido1: "El primer apellido no puede estar vacio",
            inscrito1apellido2: "El segundo apellido no puede estar vacio",
            ciudadnacimiento: "La ciudad nacimiento no puede estar vacia", 
            municipionacimiento: "El municipio nacimiento no puede estar vacio",
            departamentonacimiento: "El departamento nacimiento no puede estar vacio",
            paisnacimiento: "El pais nacimiento no puede estar vacio", 
            ciudadinscripcion: "La ciudad inscripcion no puede estar vacia",
            municipioinscripcion: "El municipio inscripcion no puede estar vacio", 
            departamentoinscripcion: "El departamento inscripcion no puede estar vacio",
            causamuerte: "La causa de la muerte no pude estar vacia",  
            ciudaddefuncion: "La ciudad defuncion no pude estar vacia", 
            compareciente1nombre: "El nombre del compareciente no puede estar vacio",
            compareciente1edad: "Introduzca un numero",  
            municipiodefuncion: "El municipio defuncion no puede estar vacio", 
            paisdefuncion: "El pais defuncion no puede estar vacio", 
            lugarinscripcionnacimiento: "El lugar inscripcion de nacimiento no puede estar vacio",  
            tomoinscripcionnacimiento: "Introduzca un n&uacute;mero", 
            folioinscripcionnacimiento: "Introduzca un n&uacute;mero",
            partidainscripcionnacimiento: "Introduzca un n&uacute;mero",
            cedulafallecido: "No puede tener la misma cedula que los comparecientes",                                       
        }
    });
   
});
</script>
<script type="text/javascript">
$(function() {
    $("#fechainscripcion").datetimepicker();
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
{/literal}
<div id="cajadatos"> 
    <div id="contenidowizard">
       <div class="headerwizardizq">Inscripci&oacute;n de defuncion</div> 
       <div id="opciones">
             <a href="/modulos/inscripciones/adddefuncion.php">Nueva</a>
       </div><!--opciones-->  
       <div id="opciones">
             <a href="/modulos/inscripciones/listardefunciones.php">Listado</a>
       </div><!--opciones-->           
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    {if $notice != ''} 
        {include file="notice.tpl"}  
    {else}    
    <form name="inscripcion" action="{$url}" method="post" id="inscripcion">
    {include file="inscripciones/_generales.tpl"}
    <br />
    <fieldset>
        <legend>COMPARECIENTES</legend>
           <div id="cargando1" style="display:none; color: green;">Cargando...</div>
           <div id="compareciente1">
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
        <div id="datosnacimiento">
             {include file="inscripciones/_nacimientodefuncion.tpl"}
        </div>
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
            <input  type="hidden"  name="tipoinscripcion" value="Defunciones"/> 
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