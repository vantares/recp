{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkconyuge2").click(function(evento){
       evento.preventDefault();   
       $("#cargando_conyuge2").css("display", "inline");
       $("#listapersonaconyuge2").load("/modulos/personas/cargarpersonas.php", {template: 'personas/_listadoresultpersonas.tpl', cedula: $("#conyuge2cedula").val(),
                                                      nombre1: $("#inscrito2nombre1").val(), nombre2: $("#inscrito2nombre2").val(), apellido1: $("#inscrito2apellido1").val(),
                                                      apellido2: $("#inscrito2apellido2").val(), cedula: $("#conyuge2cedula").val(), tipo: 'conyuge2', module: 'inscripciones'
                                                     },
                                                       
       function(){
            $("#cargando_conyuge2").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="95%"> 
    <tr><td>Conyuge Mujer</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="conyuge2cedula" name="conyuge2cedula" value="{$persona.conyuge2.cedula}" {$disabled}></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkconyuge2">Chequear</a>
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
        <td class="tcenter"><input type="text" name="inscrito2nombre1" id="inscrito2nombre1" value="{$persona.conyuge2.nombre1}" {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito2nombre2" id="inscrito2nombre2" value="{$persona.conyuge2.nombre2}"  {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito2apellido1" id="inscrito2apellido1"  value="{$persona.conyuge2.apellido1}"  {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito2apellido2" id="inscrito2apellido2" value="{$persona.conyuge2.apellido2}" {$disabled}/></td>    
    </tr>
    <tr>
        <td class="tcenter">Nombre 1</td>
        <td class="tcenter">Nombre 2</td>
        <td class="tcenter">Apellido 1</td>
        <td class="tcenter">Apellido 2</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="conyuge2edad" value="{$persona.conyuge2.edad}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="conyuge2oficio" value="{$persona.conyuge2.oficio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="conyuge2domicilio" value="{$persona.conyuge2.domicilio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="conyuge2nacionalidad" value="{$persona.conyuge2.nacionalidad}" {$disabled}></td>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
         <td class="tcenter">
            <select name="conyuge2estadocivilanterior" {$disabled}>
                <option value="casado" {if $persona.conyuge2.estadocivil == 'casado'}selected{/if}>Casado</option>
                <option value="soltero" {if $persona.conyuge2.estadocivil == 'soltero'}selected{/if}>Soltero</option> 
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
        <td colspan="4"><div id="listapersonaconyuge2"></div><!--listapersona--></td>
    </tr>        
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>