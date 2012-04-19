{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checktestigo2").click(function(evento){
       evento.preventDefault();   
       $("#cargando_testigo2").css("display", "inline");
       $("#testigo2").load("/modulos/personas/cargarpersona.php", {idpersona: document.inscripcion.testigo2cedula.value, template: 'inscripciones/_testigo2.tpl', tipo: 'testigo2' , accion: 'add'}, 
       function(){
            $("#cargando_testigo2").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="80%"> 
    <tr><td>Segundo Testigo</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="testigo2cedula" name="testigo2cedula" value="{$persona.testigo2.cedula}" {$disabled}></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checktestigo2">Chequear</a>
               {/if} 
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
        <td colspan="4" style="padding-left:10px;"><input type="text" name="testigo2nombre" value="{$persona.testigo2.nombre}" size=60 {$disabled}></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="testigo2edad" value="{$persona.testigo2.edad}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="testigo2oficio" value="{$persona.testigo2.oficio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="testigo2domicilio" value="{$persona.testigo2.domicilio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="testigo2nacionalidad" value="{$persona.testigo2.nacionalidad}" {$disabled}></td>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
         <td class="tcenter">
            <select name="testigo2estadocivil" {$disabled}>
                <option value="casado" {if $persona.testigo2.estadocivil == 'casado'}selected{/if}>Casado</option>
                <option value="soltero" {if $persona.testigo2.estadocivil == 'soltero'}selected{/if}>Soltero</option> 
            </select>         
         </td>
         <td class="tcenter">&nbsp;</td>
         <td class="tcenter">&nbsp;</td>
         <td class="tcenter">&nbsp;</td>
    </tr>
    <tr>
        <td class="tcenter">Estado Civil</td>
        <td class="tcenter">&nbsp;</td>
        <td class="tcenter">&nbsp;</td>
        <td class="tcenter">&nbsp;</td>
    </tr>    
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>
