{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkpersona").click(function(evento){
       evento.preventDefault();   
       $("#cargando1").css("display", "inline");
       $("#listapersonas").load("/modulos/personas/cargarpersonas.php", {idpersona: $("#cedula").val(), template: 'personas/_listadoresultpersonas.tpl', accion: 'add',
                                                                        nombre: $("#nombre").val(), tipo: 'persona', cedula: $("#cedula").val(), module: 'pagos'}, function(){
       $("#cargando1").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="80%"> 
    <tr><td>Persona</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%">
                <input type="text" id="cedula" name="cedula" value="{$persona.persona.cedula}" {$disabled}>
                <input type="hidden" id="idpersona" name="idpersona" value="{$persona.persona.idpersona}" >
            </td>
            <td width="17%"><span class="chequear">   
                   <a href="#" id="checkpersona">Chequear</a> 
               </span> 
            </td>
            <td width="58%"><div class="error">{$error}</div></td>
          </tr>
          <tr>
            <td>Cedula</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
        <td colspan="2" style="padding-left:10px;"><input type="text" name="nombre" id="nombre" value="{$persona.persona.nombre}" size=40 {$disabled}></td>
        <td style="padding-left:10px;">
            <select name="estadocivil" {$disabled} style="width:150px;">  
                <option value="soltero" {if $persona.persona.estadocivil == 'soltero'}selected{/if}>Soltero</option> 
                <option value="casado" {if $persona.persona.estadocivil == 'casado'}selected{/if}>Casado</option>
            </select>  
        </td> 
         <td class="tcenter">
             <select name="sexo" {$disabled}>
                <option value="m"  {if $persona.persona.sexo == 'm'}selected{/if}>Masculino</option>
                <option value="f" {if $persona.persona.sexo == 'f'}selected{/if}>Femenino</option>
            </select>            
         </td>                 
    </tr>
    <tr>
        <td colspan="2" class="tcenter">Nombre y Apellidos</td>
        <td class="tcenter">Estado Civil</td>
        <td class="tcenter">Sexo</td> 
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="edad" value="{$persona.persona.edad}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="ocupacion" value="{$persona.persona.ocupacion}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="domicilio" value="{$persona.persona.domicilio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="nacionalidad" value="{$persona.persona.nacionalidad}" {$disabled}></td>
         <input type="hidden" name="idpersona" value="{$persona.persona.idpersona}" {$disabled}>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
        <td colspan="4"><div id="listapersonas"></div><!--listapersona--></td>
    </tr>     
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>
