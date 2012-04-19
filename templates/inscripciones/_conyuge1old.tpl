{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkconyuge1").click(function(evento){
       evento.preventDefault();   
       $("#cargando_conyuge1").css("display", "inline");
       $("#listapersonaconyuge1").load("cargarpersonas.php", {template: 'inscripciones/_listadoresultpersonas.tpl', cedula: $("#conyuge1cedula").val(),
                                                      nombre1: $("#inscrito1nombre1").val(), nombre2: $("#inscrito1nombre2").val(), apellido1: $("#inscrito1apellido1").val(),
                                                      apellido2: $("#inscrito1apellido2").val(), tipo: 'conyuge1',
                                                     },
                                                       
       function(){
            $("#cargando_conyuge1").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="95%"> 
    <tr><td>Conyuge Var&oacute;n</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="conyuge1cedula" name="conyuge1cedula" value="{$persona.conyuge1.cedula}" {$disabled}></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkconyuge1">Chequear</a>
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
        <td class="tcenter"><input type="text" name="inscrito1nombre1" id="inscrito1nombre1" value="{$persona.conyuge1.nombre1}" {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito1nombre2" id="inscrito1nombre2" value="{$persona.conyuge1.nombre2}"  {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito1apellido1" id="inscrito1apellido1" value="{$persona.conyuge1.apellido1}"  {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito1apellido2" id="inscrito1apellido2" value="{$persona.conyuge1.apellido2}" {$disabled}/></td>
    </tr>
    <tr>
        <td class="tcenter">Nombre 1</td>
        <td class="tcenter">Nombre 2</td>
        <td class="tcenter">Apellido 1</td>
        <td class="tcenter">Apellido 2</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="conyuge1edad" value="{$persona.conyuge1.edad}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="conyuge1oficio" value="{$persona.conyuge1.oficio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="conyuge1domicilio" value="{$persona.conyuge1.domicilio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="conyuge1nacionalidad" value="{$persona.conyuge1.nacionalidad}" {$disabled}></td>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
         <td class="tcenter">
            <select name="conyuge1estadocivilanterior" {$disabled}>
                <option value="casado" {if $persona.conyuge1.estadocivil == 'casado'}selected{/if}>Casado</option>
                <option value="divorciado" {if $persona.conyuge1.estadocivil == 'divorciado'}selected{/if}>Divorciado</option>
                <option value="soltero" {if $persona.conyuge1.estadocivil == 'soltero'}selected{/if}>Soltero</option> 
            </select>         
         </td>
         <td class="tcenter">&nbsp;</td>
         <td class="tcenter">&nbsp;</td>
         <td class="tcenter">&nbsp;</td>
    </tr>
    <tr>
        <td class="tcenter">Estado Civil Anterior</td>
        <td class="tcenter">&nbsp;</td>
        <td class="tcenter">&nbsp;</td>
        <td class="tcenter">&nbsp;</td>
    </tr>    
    <tr>
        <td colspan="4"><div id="listapersonaconyuge1"></div><!--listapersona--></td>
    </tr>   
      
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>
 
