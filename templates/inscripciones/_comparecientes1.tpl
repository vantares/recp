{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkcompareciente1").click(function(evento){
       evento.preventDefault();   
       $("#cargando1").css("display", "inline");
       $("#listapersonacompareciente1").load("/modulos/personas/cargarpersonas.php", {template: 'personas/_listadoresultpersonas.tpl', nombre: $("#compareciente1nombre").val(), 
                                                                                      cedula: $("#compareciente1cedula").val(), tipo: 'comparecientes1', module: 'inscripciones'
                                                                   },
       function(){
            $("#cargando1").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="80%"> 
    <tr><td>Compareciente 1</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="compareciente1cedula" name="compareciente1cedula" value="{$persona.comparecientes1.cedula}" {$disabled}></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkcompareciente1">Chequear</a>
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
        <td colspan="4" style="padding-left:10px;"><input type="text" name="compareciente1nombre" id="compareciente1nombre" value="{$persona.comparecientes1.nombre}" size=60 {$disabled}></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="compareciente1edad" value="{$persona.comparecientes1.edad}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="compareciente1oficio" value="{$persona.comparecientes1.oficio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="compareciente1domicilio" value="{$persona.comparecientes1.domicilio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="compareciente1nacionalidad" value="{$persona.comparecientes1.nacionalidad}" {$disabled}></td>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
        <td colspan="4"><div id="listapersonacompareciente1"></div><!--listapersona--></td>
    </tr>     
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>
