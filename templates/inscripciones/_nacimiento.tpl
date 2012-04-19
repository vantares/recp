{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checknacimiento").click(function(evento){
       evento.preventDefault();   
       $("#cargando6").css("display", "inline");
       $("#datosnacimiento").load("cargardatosnacimiento.php", {idtomo: $("#tomoinscripcionnacimiento").val(), folio: $("#folioinscripcionnacimiento").val(), tipo: 'fallecido', template: 'inscripciones/_nacimiento.tpl'}, 
       function(){
            $("#cargando6").css("display", "none"); 
       });           
    }); 
});
</script>
<script type="text/javascript"> 
$(function() {
    $("#fechanacimiento").datetimepicker();
});
</script>  
{/literal}
<table width="100%">
    <tr>
        <td>Nacido<input type="hidden" name="persona1" value=""></td>
    </tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" id="tomoinscripcionnacimiento" name="tomoinscripcionnacimiento" value="{$arraynacimiento.fallecido.numero}" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" id="folioinscripcionnacimiento" name="folioinscripcionnacimiento" value="{$arraynacimiento.fallecido.actabd->request.folio}"  {$disabled}/></td>          
            <td class="tcenter" width="25%"><input type="text" name="partidainscripcionnacimiento" value="{$arraynacimiento.fallecido.actabd->request.partida}" {$disabled}/></td>
            <td width="15%"><span class="chequear">
                <span class="chequear">
                   {if $add != '' || $visiblenacimiento}
                      <a href="#" id="checknacimiento">Chequear</a>
                   {/if} 
                 </span>
            </td>
          </tr>
          <tr>
            <td>Tomo</td>
            <td>Folio</td> 
            <td>Partida</td> 
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr> 
    <tr>  
        <td colspan="4" class="tcenter" width="25%"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" id="fechanacimiento" name="fechanacimiento" value="{if $arraynacimiento.fallecido.hechovital->request.fechanacimiento != ''}{$arraynacimiento.fallecido.hechovital->request.fechanacimiento}{else}{$fechainscripcion}{/if}"  {$disabled}/></td>
            <td class="tcenter" width="25%">
                <input type="text" name="lugarinscripcionnacimiento" value="{$arraynacimiento.fallecido.inscripcion->request.municipioinscripcion|cat:' '|cat:$inscripcion->request.departamentoinscripcion}"  {$disabled}/>
            </td>
            <td class="tcenter" width="25%"><input type="text" name="ciudadnacimiento" value="{$arraynacimiento.fallecido.hechovital->request.ciudadnacimiento}" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" name="municipionacimiento" value="{$arraynacimiento.fallecido.hechovital->request.municipionacimiento}" {$disabled}/></td>
          </tr>
          <tr>
            <td class="tcenter">Fecha de Nacimiento</td>
            <td class="tcenter">Lugar Inscripcion</td>
            <td class="tcenter">Ciudad</td>
            <td class="tcenter">Municipio</td>
          </tr>
        </table></td>
    </tr>       
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" name="departamentonacimiento" value="{$arraynacimiento.fallecido.hechovital->request.departamentonacimiento}"  {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" name="paisnacimiento" value="{$arraynacimiento.fallecido.hechovital->request.paisnacimiento}"  {$disabled}/></td>
            <td class="tcenter" width="25%">
                <select name="sexoinscrito" {$disabled}>
                    <option value="m"  {if $arraynacimiento.fallecido.hechovital->request.sexoinscrito == 'm'}selected{/if}>Masculino</option>
                    <option value="f" {if $arraynacimiento.fallecido.hechovital->request.sexoinscrito == 'f'}selected{/if}>Femenino</option>
                </select>        
            </td>
            <td class="tcenter" width="15%">&nbsp;</td>          
          </tr>
          <tr>
            <td class="tcenter">Departamento</td>
            <td class="tcenter">Pais</td>
            <td class="tcenter">Sexo</td>
            <td class="tcenter">&nbsp;</td>
          </tr>
        </table></td>
    </tr>       
    <tr>
        <td colspan="4"><div class="error">{$error}</div></td>
    </tr>       
</table> 