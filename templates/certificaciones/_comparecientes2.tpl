{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkcompareciente2").click(function(evento){
       evento.preventDefault();   
       $("#cargando2").css("display", "inline");
       $("#compareciente2").load("cargarpersona.php", {idpersona: $("#compareciente2cedula").val(), template: 'inscripciones/_comparecientes2.tpl', tipo: 'compareciente2', accion: 'add'}, 
       function(){
            $("#cargando2").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="80%"> 
    <tr><td>Compareciente 2</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="compareciente2cedula" name="compareciente2cedula" value="{$compareciente2->request.cedula}" {$disabled}/></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkcompareciente2">Chequear</a>
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
        <td colspan="4" style="padding-left:10px;"><input type="text" name="compareciente2nombre" value="{$compareciente2->request.nombre}" size=60 {$disabled}/></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="compareciente2edad" value="{$compareciente2->request.edad}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="compareciente2oficio" value="{$compareciente2->request.oficio}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="compareciente2domicilio" value="{$compareciente2->request.domicilio}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="compareciente2nacionalidad" value="{$compareciente2->request.nacionalidad}" {$disabled} /></td>
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
