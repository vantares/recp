{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkmatrimonio").click(function(evento){
       evento.preventDefault();   
       $("#cargar_matrimonio").css("display", "inline");
       $("#datosmatrimonio").load("cargardatosmatrimonio.php", {idtomo: $("#tomom").val(), folio: $("#foliom").val(), template: 'inscripciones/_datosmatrimonio.tpl'}, 
       function(){
            $("#cargar_matrimonio").css("display", "none"); 
       });
    }); 
});
</script>
{/literal}
<table width="100%">
    <tr>
        <td>Datos del Matrimonio</td>
    </tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" id="tomom" name="tomom" value="{$idtomom}" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" id="foliom" name="foliom" value="{$foliom}"  {$disabled}/></td> 
            <td class="tcenter" width="25%"><input type="text" id="partidam" name="partidam" value="{$partidam}"  {$disabled}/></td>         
            <td width="15%"><span class="chequear">
                <span class="chequear">
                   {if $add != '' || $visiblenacimiento}
                      <a href="#" id="checkmatrimonio">Chequear</a>
                   {/if} 
                 </span>
            </td>
            <td width="35%"><div class="error">{$errormat}</div></td>
          </tr>
          <tr>
            <td>Tomo</td>
            <td>Folio</td> 
            <td>Partida</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>    
</table> 