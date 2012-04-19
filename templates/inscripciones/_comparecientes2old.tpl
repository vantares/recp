{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkcompareciente2").click(function(evento){
       evento.preventDefault();   
       $("#cargando2").css("display", "inline");
       $("#listapersonacompareciente2").load("cargarpersonas.php", {template: 'inscripciones/_listadoresultpersonas.tpl', cedula: $("#compareciente2cedula").val(),
                                                                    nombre: $("#compareciente2nombre").val(), tipo: 'comparecientes2',
                                                                   },
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
            <td width="25%"><input type="text" id="compareciente2cedula" name="compareciente2cedula" value="{$persona.comparecientes2.cedula}" {$disabled}/></td>
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
        <td colspan="4" style="padding-left:10px;"><input type="text" name="comparecientes2nombre" id="comparecientes2nombre" value="{$persona.comparecientes2.nombre}" size=60 {$disabled}/></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="compareciente2edad" value="{$persona.comparecientes2.edad}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="compareciente2oficio" value="{$persona.comparecientes2.oficio}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="compareciente2domicilio" value="{$persona.comparecientes2.domicilio}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="compareciente2nacionalidad" value="{$persona.comparecientes2.nacionalidad}" {$disabled} /></td>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
        <td colspan="4"><div id="listapersonacompareciente2"></div><!--listapersona--></td>
    </tr>      
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>
