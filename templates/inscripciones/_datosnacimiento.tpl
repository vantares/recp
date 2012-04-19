{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checknacimiento").click(function(evento){
       evento.preventDefault();   
       $("#cargandopadres").css("display", "inline");
       $("#datospadres").load("cargardatospadres.php", {idtomo: $("#tomoinscripcionnacimiento").val(), folio: $("#folioinscripcionnacimiento").val(), partida: $("#partidainscripcionnacimiento").val() }, 
       function(){
            $("#cargandopadres").css("display", "none"); 
       });
    }); 
});
</script>
{/literal}
<fieldset id="datospadres">
<legend>Datos del nacimiento</legend> 
<table width="100%">
    <tr>
        <td>Si conoce los datos de la inscripci&oacute;n de nacimiento introduzcalos aqu&iacute;</td>
    </tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" id="tomoinscripcionnacimiento" name="tomoinscripcionnacimiento" value="" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" id="folioinscripcionnacimiento" name="folioinscripcionnacimiento" value=""  {$disabled}/></td> 
            <td class="tcenter" width="25%"><input type="text" id="partidainscripcionnacimiento" name="partidainscripcionnacimiento" value=""  {$disabled}/></td>         
            <td width="15%"><span class="chequear">
                <span class="chequear">
                     <a href="#" id="checknacimiento">Chequear</a>
                 </span>
            </td>
            <td width="35%"><div class="error">{$error}</div></td>
          </tr>
          <tr>
            <td>Tomo</td>
            <td>Folio</td> 
            <td>partida</td> 
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>    
</table>
 </fieldset>  