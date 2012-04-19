{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checknacimiento1").click(function(evento){
       evento.preventDefault();   
       $("#cargando_nacimiento1").css("display", "inline");
       $("#datosnacimiento1").load("cargardatosnacimiento.php", {idtomo: $("#conyuge1tomoinscripcion").val(), folio: $("#conyuge1folioinscripcion").val(), tipo: 'conyuge1', template: 'inscripciones/_nacimientoconyuge1.tpl'}, 
       function(){
            $("#cargando_nacimiento1").css("display", "none"); 
       });
    }); 
});
</script>
{/literal}
<table width="80%">
    <tr>
        <td>Nacimiento Conyuge Var&oacute;n</td>
    </tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" id="conyuge1tomoinscripcion" name="conyuge1tomoinscripcion" value="{$arraynacimiento.conyuge1.numero}" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" id="conyuge1folioinscripcion" name="conyuge1folioinscripcion" value="{$arraynacimiento.conyuge1.actabd->request.folio}"  {$disabled}/></td>          
            <td class="tcenter" width="25%"><input type="text" name="conyuge1partidainscripcion" value="{$arraynacimiento.conyuge1.actabd->request.partida}" {$disabled}/></td>
            <td width="15%">
                <span class="chequear">
                   {if $add != ''}<a href="#" id="checknacimiento1">Chequear</a>{/if} 
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
            <td class="tcenter" width="25%"><input type="text" name="conyuge1anyoinscripcion" value="{$arraynacimiento.conyuge1.anyo}"  {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" name="conyuge1lugarinscripcion" value="{$arraynacimiento.conyuge1.inscripcion->request.municipioinscripcion}"  {$disabled}/></td>          
            {* <td class="tcenter" width="25%"><input type="text" name="conyuge1lugarinscripcion" value="{$arraynacimiento.conyuge1.inscripcion->request.municipioinscripcion|cat:' '|cat:$arraynacimiento.conyuge1->request.departamentoinscripcion}"  {$disabled}/></td> *}         
            <td class="tcenter" width="25%">&nbsp; </td>
            <td width="15%">&nbsp; </td>
          </tr>
          <tr>
            <td>a&ntilde;o </td>
            <td>Inscrito en </td> 
            <td>&nbsp;</td> 
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>      
    <tr>
        <td colspan="4"><div class="error">{$error}</div></td>
    </tr>    
    <tr>
        <td colspan="4"><hr /></td>
    </tr>    
</table> 
