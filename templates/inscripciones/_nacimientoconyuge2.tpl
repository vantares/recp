{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checknacimiento2").click(function(evento){
       evento.preventDefault();   
       $("#cargando_nacimiento2").css("display", "inline");
       $("#datosnacimiento2").load("cargardatosnacimiento.php", {idtomo: $("#conyuge2tomoinscripcion").val(), folio: $("#conyuge2folioinscripcion").val(), tipo: 'conyuge2', template: 'inscripciones/_nacimientoconyuge2.tpl'}, 
       function(){
            $("#cargando_nacimiento2").css("display", "none"); 
       });
    }); 
});
</script>
{/literal}
<table width="80%">
    <tr>
        <td>Nacimiento Conyuge Mujer</td>
    </tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" id="conyuge2tomoinscripcion" name="conyuge2tomoinscripcion" value="{$arraynacimiento.conyuge2.numero}" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" id="conyuge2folioinscripcion" name="conyuge2folioinscripcion" value="{$arraynacimiento.conyuge2.actabd->request.folio}"  {$disabled}/></td>          
            <td class="tcenter" width="25%"><input type="text" name="conyuge2partidainscripcion" value="{$arraynacimiento.conyuge2.actabd->request.partida}" {$disabled}/></td>
            <td width="15%"><span class="chequear">
                <span class="chequear">
                   {if $add != ''}<a href="#" id="checknacimiento2">Chequear</a>{/if} 
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
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" name="conyuge2anyoinscripcion" value="{$arraynacimiento.conyuge2.anyo}"  {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" name="conyuge2lugarinscripcion" value="{$arraynacimiento.conyuge2.inscripcion->request.municipioinscripcion}"  {$disabled}/></td>          
            {* <td class="tcenter" width="25%"><input type="text" name="conyuge2lugarinscripcion" value="{$arraynacimiento.conyuge2.inscripcion->request.municipioinscripcion|cat:' '|cat:$inscripcion->request.departamentoinscripcion}"  {$disabled}/></td> *}         
            <td class="tcenter" width="25%">&nbsp;</td>
            <td width="15%">&nbsp;</td>
          </tr>
          <tr>
            <td>a&ntilde;o</td>
            <td>Inscrito en</td> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>  
    <tr>
        <td colspan="4"><div class="error">{$error}</div></td>
    </tr>     
</table> 
