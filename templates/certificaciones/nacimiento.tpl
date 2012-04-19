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
            compareciente1nombre: {
                required: true,
            },  
            compareciente1edad: {
                required: true,
                number: true,
            }, 
            fechanacimiento: {
                required: true,
            }, 
            fechainscripcion: {
                required: true,
            },                        
            inscrito1nombre1: "required", 
            inscrito1apellido1: "required",  
            inscrito1apellido2: "required",  
            ciudadinscripcion: "required", 
            municipioinscripcion: "required",
            departamentoinscripcion: "required",
            ciudadnacimiento: "required",  
            municipionacimiento: "required",
            departamentonacimiento: "required", 
            paisnacimiento: "required", 
            compareciente1cedula: {
                required: true,
                number: true,            
            }, 
                       
        },
        messages: {
            folio: "Introduzca un numero",
            partida: "Introduzca un numero", 
            compareciente1cedula: "Introduzca un numero", 
            compareciente1nombre: "El nombre del compareciente no puede estar vacio",
            compareciente1edad: "Introduzca un numero", 
            inscrito1nombre1: "El primer nombre no puede estar vacio", 
            inscrito1apellido1: "El primer apellido no puede estar vacio",
            inscrito1apellido2: "El segundo apellido no puede estar vacio",
            ciudadinscripcion: "La ciudad inscripcion no puede estar vacia",
            municipioinscripcion: "El municipio inscripcion no puede estar vacio", 
            departamentoinscripcion: "El departamento inscripcion no puede estar vacio",
            ciudadnacimiento: "La ciudad nacimiento no puede estar vacia", 
            municipionacimiento: "El municipio nacimiento no puede estar vacio",
            departamentonacimiento: "El departamento nacimiento no puede estar vacio",
            paisnacimiento: "El pais nacimiento no puede estar vacio", 
            fechanacimiento: "Fecha de nacimiento no puede estar vacia", 
            fechainscripcion: "Fecha de inscripcion no puede estar vacia",                    
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
{/literal}
<div id="cajadatos"> 
    <div id="contenidowizard">
       <div class="headerwizardizq">Certificaci&oacute;n de nacimiento</div>            
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    {if $notice != ''} 
       {include file="notice.tpl"}
    {else}    
    <form name="certificacion" action="{$url}" method="post" id="certificacion">
    <fieldset>
        <legend>General</legend>
        <table width="65%">
            <tr>
                <td align="right">Tomo</td>
                <td><input type="text" name="tomo" value="{$tomo}" size=5  {$disabled}/></td>
     
                <td align="right">Folio</td>
                <td><input type="text" name="folio" value="{$acta->request.folio}" size=5  {$disabled}/></td>
                <td align="right">Partida</td>
                <td><input type="text" name= "partida" value="{$acta->request.partida}"  size=5 {$disabled} /></td>
            </tr>
            </table> 
            <table width="65%"> 
            <tr>
                <td width="120">Fecha Inscripcion</td>
                <td colspan="3" align="left" width="360">
                <input type="text" id="fechainscripcion" name="fechainscripcion" value="{$acta->request.fecha}" {$disabled}/>
                </td>
            </tr>
        </table>
    </fieldset>
    <br />
    <fieldset>
        <legend>COMPARECIENTES</legend>
           <div id="cargando1" style="display:none; color: green;">Cargando...</div>
           <div id="compareciente1">
              {include file="certificaciones/_comparecientes1.tpl"}
           </div>
           <div id="cargando2" style="display:none; color: green;">Cargando...</div>
           <div id="compareciente2">{include file="certificaciones/_comparecientes2.tpl"}</div>
        </table>
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
                <td class="tcenter"><input type="text" id="fechanacimiento" name="fechanacimiento" value="{$hechovital->request.fechanacimiento}" {$disabled}></td>
            </tr>
            <tr>
                <td class="tcenter">Sexo</td>
                <td class="tcenter">Fecha Nacimiento</td>
            </tr>
            <tr>
                <td class="tcenter"><input type="text" name="ciudadnacimiento" value="{$hechovital->request.ciudadnacimiento}"  {$disabled} /></td>
                <td class="tcenter"><input type="text" name="municipionacimiento" value="{$hechovital->request.municipionacimiento}"  {$disabled} /></td>
                <td class="tcenter"><input type="text" name="departamentonacimiento" value="{$hechovital->request.departamentonacimiento}"  {$disabled} /></td>
                <td class="tcenter"><input type="text" name="paisnacimiento" value="{$hechovital->request.paisnacimiento}"  {$disabled} /></td>
            </tr>
            <tr>
                <td class="tcenter">Ciudad</td>
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
        </fieldset>
        <br />
        <fieldset>
            <legend>Padres</legend>
               <div id="cargando3" style="display:none; color: green;">Cargando...</div>
               <div id="padre">
                  {include file="certificaciones/_padre.tpl"}
               </div>
               <div id="cargando4" style="display:none; color: green;">Cargando...</div>
               <div id="madre">{include file="certificaciones/_madre.tpl"}</div>
            </table>
        </fieldset>
    <br /> 
    <fieldset>
        <legend>Registro</legend>
        <table>
        <tr>
            <td>Registrador</td>
            <td>
               <input type="text" name="nombreregistrador" value="{$inscripcion->request.nombreregistrador}"  {$disabled} />
            </td>
            <td>Secretario</td>
            <td>
               <input type="text" name="nombresecretario" value="{$inscripcion->request.nombresecretario}"  {$disabled} />           
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
            <input class=" asistenciabutton submit" type="submit"  name="certificar" value="Certificar"/>  
        {/if}    
        <div class="limpiar"></div>
      </div><!--filadatos-->          
    </form>
    {/if}
</div><!--cajadatos-->