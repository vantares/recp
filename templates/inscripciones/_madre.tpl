{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkmadre").click(function(evento){
       evento.preventDefault();   
       $("#cargando4").css("display", "inline");
       $("#listapersonamadre").load("/modulos/personas/cargarpersonas.php", {template: 'personas/_listadoresultpersonas.tpl', nombre: $("#nombremadre").val(), 
                                                                      cedula: $("#cedulamadre").val(), tipo: 'madre', module: 'inscripciones', defuncionb: $("#defuncionb").val()
                                                                   },
       function(){
            $("#cargando4").css("display", "none"); 
       });
    }); 
});
</script>
{/literal} 
<table width="80%"> 
    <tr><td>Madre</td></tr>
    {if $defuncionb != 'ok'}
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
    {/if}
    {if $defuncionb != 'ok'}
        <tr>
            <td colspan="4" style="padding-left:10px;"><input id="nombremadre" type="text" name="nombremadre" value="{$persona.madre.nombre}" size=60 {$disabled} /></td>
        </tr>
    {else}
        <tr>
            <td colspan="3" style="padding-left:10px;"><input id="nombremadre" type="text" name="nombremadre" value="{$persona.madre.nombre}" size=60 {$disabled} /></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkmadre">Chequear</a>
               {/if}
               </span>
            </td>
        </tr>

    {/if}
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    {if $defuncionb != 'ok'}
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
    {/if}
    <tr>
        <td colspan="4"><div id="listapersonamadre"></div><!--listapersona--></td>
    </tr>     
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>
