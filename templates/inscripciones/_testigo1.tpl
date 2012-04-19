{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checktestigo1").click(function(evento){
       evento.preventDefault();   
       $("#cargando_testigo1").css("display", "inline");
       $("#testigo1").load("/modulos/personas/cargarpersona.php", {idpersona: document.inscripcion.testigo1cedula.value, template: 'inscripciones/_testigo1.tpl', tipo: 'testigo1' , accion: 'add'}, 
       function(){
            $("#cargando_testigo1").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="80%"> 
    <tr><td>Primer Testigo</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="testigo1cedula" name="testigo1cedula" value="{$persona.testigo1.cedula}" {$disabled}></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checktestigo1">Chequear</a>
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
        <td colspan="4" style="padding-left:10px;"><input type="text" name="testigo1nombre" value="{$persona.testigo1.nombre}" size=60 {$disabled}></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="testigo1edad" value="{$persona.testigo1.edad}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="testigo1oficio" value="{$persona.testigo1.oficio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="testigo1domicilio" value="{$persona.testigo1.domicilio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="testigo1nacionalidad" value="{$persona.testigo1.nacionalidad}" {$disabled}></td>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
         <td class="tcenter">
            <select name="testigo1estadocivil" {$disabled}>
                <option value="casado" {if $persona.testigo1.estadocivil == 'casado'}selected{/if}>Casado</option>
                <option value="soltero" {if $persona.testigo1.estadocivil == 'soltero'}selected{/if}>Soltero</option> 
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
