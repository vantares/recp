{literal}
<script type="text/javascript"> 
$(function() {
    $("#fechanacimiento").datetimepicker();
});
</script>  
<script type="text/javascript"> 
$().ready(function() {
    // validate signup form on keyup and submit
    $("#inscripcion").validate({
        rules: {
            nombre1: {
                required: true
            },
            apellido1: {
                required: true
            },            
            estadocivil: {
                required: true
            },
            sexo: {
                required: true
            }
        },
        messages: {
            nombre1: "El primer nombre no puede estar vacio",
            apellido1: "El primer apellido no puede estar vacio",
            sexo: "El sexo no puede estar vacio",
            estadocivil: "El estado civil no puede estar vacio"
        }
    });
});
</script>
{/literal} 
<div id="cajadatos"> 
    <div id="contenidowizard">
       <div class="headerwizardizq">Registro de Personas</div> 
       <div id="opciones">
             <a href="/modulos/personas/addpersona.php">Nueva</a>
       </div><!--opciones-->  
       <div id="opciones">
             <a href="/modulos/personas/">Listado</a>
       </div><!--opciones-->           
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    {if $notice != ''} 
        {include file="notice.tpl"}
    {else}    
    <form name="inscripcion" action="{$url}" method="post" id="inscripcion">       
        <fieldset>
            <legend>Datos Personales</legend>
            <table width="80%"> 
                <tr>
                     <td class="tcenter"><input type="text" name="nombre1" value="{$persona->request.nombre1}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="nombre2" value="{$persona->request.nombre2}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="apellido1" value="{$persona->request.apellido1}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="apellido2" value="{$persona->request.apellido2}" {$disabled}></td>
                </tr>
                <tr>
                    <td class="tcenter">Primer Nombre</td>
                    <td class="tcenter">Segundo Nombre</td>
                    <td class="tcenter">Primer Apellido</td>
                    <td class="tcenter">Segundo Apellido</td>
                </tr>
                <tr>
                     <td class="tcenter"><input type="text" name="ocupacion" value="{$persona->request.ocupacion}" {$disabled}></td>
                     <td class="tcenter">
                        <select name="estadocivil" {$disabled}>
                            <option value="casado" {if $persona->request.estadocivil == 'casado'}selected{/if}>Casado</option>
                            <option value="divorciado" {if $persona->request.estadocivil == 'divorciado'}selected{/if}>Divorciado</option>
                            <option value="soltero" {if $persona->request.estadocivil == 'soltero'}selected{/if}>Soltero</option> 
                        </select>                     
                     </td>
                     <td class="tcenter"><input type="text" name="domicilio" value="{$persona->request.domicilio}" {$disabled}></td>
                     <td class="tcenter">
                         <select name="sexo" {$disabled}>
                            <option value="m"  {if $persona->request.sexo == 'm'}selected{/if}>Masculino</option>
                            <option value="f" {if $persona->request.sexo == 'f'}selected{/if}>Femenino</option>
                        </select>            
                     </td>
                </tr>
                <tr>
                    <td class="tcenter">Ocupacion</td>
                    <td class="tcenter">Estado Civil</td>
                    <td class="tcenter">Domicilio</td>
                    <td class="tcenter">Sexo</td>
                </tr>
                <tr>
                     <td class="tcenter"><input type="text" name="nacionalidad" value="{$persona->request.nacionalidad}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="ciudadnacimiento" value="{$persona->request.ciudadnacimiento}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="municipionacimiento" value="{$persona->request.municipionacimiento}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="paisnacimiento" value="{$persona->request.paisnacimiento}" {$disabled}></td>
                </tr>
                <tr>
                    <td class="tcenter">Nacionalidad</td>
                    <td class="tcenter">Ciudad Nacimiento</td>
                    <td class="tcenter">Municipio Nacimiento</td>
                    <td class="tcenter">Pais Nacimiento</td>
                </tr> 
                <tr>
                     <td class="tcenter"><input type="text" id="fechanacimiento" name="fechanacimiento" value="{$persona->request.fechanacimiento}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="departamentonacimiento" value="{$persona->request.departamentonacimiento}" {$disabled}></td>
                     <td class="tcenter">&nbsp;</td>
                     <td class="tcenter">&nbsp;</td>
                </tr>
                <tr>
                    <td class="tcenter">Fecha Nacimiento</td>
                    <td class="tcenter">Departamento Nacimiento</td>
                    <td class="tcenter">&nbsp;</td>
                    <td class="tcenter">&nbsp;</td>
                </tr>                
                <tr>
                    <td colspan="4"><hr /></td>
                </tr>
                <tr>
                     <td class="tcenter"><input type="text" name="cedula" value="{$ciudadano->request.cedula}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="centrovotacion" value="{$ciudadano->request.centrovotacion}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="jvr" value="{$ciudadano->request.jvr}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="municipio" value="{$ciudadano->request.municipio}" {$disabled}></td>
                </tr>
                <tr>
                    <td class="tcenter">Cedula</td>
                    <td class="tcenter">Centro Votacion</td>
                    <td class="tcenter">Jvr</td>
                    <td class="tcenter">Municipio</td>
                </tr>
                <tr>
                     <td class="tcenter"><input type="text" name="ciudad" value="{$ciudadano->request.ciudad}" {$disabled}></td>
                     <td class="tcenter"><input type="text" name="departamento" value="{$ciudadano->request.departamento}" {$disabled}></td>
                     <td class="tcenter">&nbsp;</td>
                     <td class="tcenter">&nbsp;</td>
                </tr>
                <tr>
                    <td class="tcenter">Ciudad</td>
                    <td class="tcenter">Departamento</td>
                    <td class="tcenter">&nbsp;</td>
                    <td class="tcenter">&nbsp;</td>
                </tr>         
                <tr>
                    <td colspan="4">
                        <table>
                            <tr><td><b>Direccion</b><td></tr>
                            <tr><td><textarea cols="50" name="direccion" rows="5"  {$disabled}>{$ciudadano->request.direccion}</textarea><td></tr>
                        </table>        
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table>
                            <tr><td><b>Ubicacion</b><td></tr>
                            <tr><td><textarea cols="50" name="ubicacion" rows="5"  {$disabled}>{$ciudadano->request.ubicacion}</textarea><td></tr>
                        </table>        
                    </td>
                </tr>                
            </table>
        </fieldset>
        <div class="filadatos noborde" style="float:right">
            {if $add == ''}
                <input  type="hidden"  name="idpersona" value="{$persona->request.idpersona}"/>
            {/if}
            {if $disabled == ''}
                <input class=" asistenciabutton submit" type="submit"  name="salvar" value="salvar"/>  
            {/if}    
            <div class="limpiar"></div>
        </div><!--filadatos-->          
    </form>
    {/if}
</div><!--cajadatos-->