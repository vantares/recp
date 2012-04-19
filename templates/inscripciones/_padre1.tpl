{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkpadre").click(function(evento){
       evento.preventDefault();   
       $("#cargando3").css("display", "inline");
       $("#padre").load("cargarpersona.php", {idpersona: $("#cedulapadre").val(), template: 'inscripciones/_padre.tpl', tipo: 'padre', accion: 'add'}, function(){
            $("#cargando3").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="80%"> 
    <tr><td>Padre</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="cedulapadre" name="cedulapadre" value="{$persona.padre.cedula}" {$disabled}></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkpadre">Chequear</a>
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
        <td colspan="4" style="padding-left:10px;"><input type="text" name="padrenombre" value="{$persona.padre.nombre}" size=60 {$disabled}></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="edadpadre" value="{$persona.padre.edad}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="oficiopadre" value="{$persona.padre.oficio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="domiciliopadre" value="{$persona.padre.domicilio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="nacionalidadpadre" value="{$persona.padre.nacionalidad}" {$disabled}></td>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>
