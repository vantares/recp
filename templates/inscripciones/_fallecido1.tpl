{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkfallecido").click(function(evento){
       evento.preventDefault();   
       $("#cargando5").css("display", "inline");
       $("#fallecido").load("cargarpersona.php", {idpersona: document.inscripcion.cedulafallecido.value, template: 'inscripciones/_fallecido.tpl', tipo: 'fallecido' , accion: 'add', inscrito: 1}, 
       function(){
            $("#cargando5").css("display", "none"); 
       });
    }); 
});
</script>
<script type="text/javascript"> 
$(function() {
    $("#fechadefuncion").datetimepicker();
});
</script>  
{/literal} 
<table width="100%">
    <tr>
        <td>Fallecido</td>
    </tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="cedulafallecido" name="cedulafallecido" value="{$persona.fallecido.cedula}" {$disabled}></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkfallecido">Chequear</a>
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
        <td class="tcenter"><input type="text" name="inscrito1nombre1" value="{$persona.fallecido.nombre1}" {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito1nombre2" value="{$persona.fallecido.nombre2}"  {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito1apellido1" value="{$persona.fallecido.apellido1}"  {$disabled}/></td>
        <td class="tcenter"><input type="text" name="inscrito1apellido2" value="{$persona.fallecido.apellido2}" {$disabled}/></td>
    </tr>
    <tr>
        <td class="tcenter">Nombre 1</td>
        <td class="tcenter">Nombre 2</td>
        <td class="tcenter">Apellido 1</td>
        <td class="tcenter">Apellido 2</td>
    </tr>
    <tr>
        <td class="tcenter"><input type="text" name="domiciliofallecido" value="{$persona.fallecido.domicilio}" {$disabled}/></td>
        <td class="tcenter"><input type="text" name="nacionalidadfallecido" value="{$persona.fallecido.nacionalidad}"  {$disabled}/></td>
        <td class="tcenter" colspan="2"><input type="text" name="conyugenombre" value="{$defuncion->request.conyugenombre}" size=40  {$disabled}/></td>
        
    </tr>
    <tr>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
        <td colspan="2" class="tcenter">Nombre Conyuge</td>
    </tr>    
    <tr>
        <td class="tcenter">
        <select name="estadocivil" {$disabled}>
            <option value="casado" {if $persona.fallecido.estadocivil == 'casado'}selected{/if}>Casado</option>
            <option value="divorciado" {if $persona.fallecido.estadocivil == 'divorciado'}selected{/if}>Divorciado</option>
            <option value="soltero" {if $persona.fallecido.estadocivil == 'soltero'}selected{/if}>Soltero</option> 
        </select>
        </td>
        <td class="tcenter"><input type="text" id="fechadefuncion" name="fechadefuncion" value="{$fechadefuncion}"></td>
        <td class="tcenter"><input type="text" name="oficiofallecido" value="{$persona.fallecido.oficio}"></td>
        <td class="tcenter"><input type="text" name="edadfallecido" value="{$persona.fallecido.edad}"></td>  
    </tr>
    <tr>
        <td class="tcenter">Estado Civil</td>
        <td class="tcenter">Fecha Defuncion</td>
        <td class="tcenter">Oficio</td>
        <td class="tcenter">Edad</td>
    </tr>
    <tr>
        <td class="tcenter"><input type="text" name="ciudaddefuncion" value="{$persona.fallecido.ciudad}"  {$disabled} /></td>
        <td class="tcenter"><input type="text" name="municipiodefuncion" value="{$persona.fallecido.municipio}"  {$disabled} /></td>
        <td class="tcenter"><input type="text" name="departamentodefuncion" value="{$persona.fallecido.departamento}"  {$disabled} /></td>
        <td class="tcenter"><input type="text" name="paisdefuncion" value="{$persona.fallecido.pais}"  {$disabled} /></td>
    </tr>
    <tr>
        <td class="tcenter">Ciudad</td>
        <td class="tcenter">Municipio</td>
        <td class="tcenter">Departamento</td>
        <td class="tcenter">Pais</td>
    </tr>
    <tr>
        <td colspan="4">
          <select name="causamuerte" class="listwizard selectwizard"  {$disabled}>
              {section name=id loop=$arrayCausaMuertes}
                 <option value="{$arrayCausaMuertes[id].causamuerte}" {if $arrayCausaMuertes[id].causamuerte == $defuncion->request.causamuerte}selected{/if}>{$arrayCausaMuertes[id].definicion}</option>
              {/section}
           </select>        
        </td>
    </tr>
    <tr>
        <td class="tcenter">Causa de Muerte</td>
    </tr>    
</table>