{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkmadre").click(function(evento){
       evento.preventDefault();   
       $("#cargando4").css("display", "inline");
       $("#madre").load("cargarpersona.php", {idpersona: $("#cedulamadre").val(), template: 'inscripciones/_madre.tpl', tipo: 'madre', accion: 'add'}, function(){
            $("#cargando4").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="80%"> 
    <tr><td>Madre</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="cedulamadre" name="cedulamadre" value="{$persona.madre.cedula}" {$disabled} /></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkmadre">Chequear</a>
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
        <td colspan="4" style="padding-left:10px;"><input type="text" name="nombremadre" value="{$persona.madre.nombre}" size=60 {$disabled} /></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="edadmadre" value="{$persona.madre.edad}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="oficiomadre" value="{$persona.madre.oficio}"  {$disabled} /></td>
         <td class="tcenter"><input type="text" name="domiciliomadre" value="{$persona.madre.domicilio}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="nacionalidadmadre" value="{$persona.madre.nacionalidad}" {$disabled} /></td>
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
