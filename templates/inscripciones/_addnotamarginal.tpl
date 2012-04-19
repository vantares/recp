{literal}
<script type="text/javascript"> 
$().ready(function() {
    // validate signup form on keyup and submit
    $("#addnotamarginal").validate({
        rules: {
            cuerpo: "required"            
        },
        messages: {
            cuerpo: "El cuerpo no puede estar vacio"
        }
    });
});
$(function() {
    $("#fechamarginacion").datetimepicker();
});

</script>
<script type="text/javascript"> 
    $(document).ready(function() {
        // Fourth example
        $('a.classnotamarginal').click(function(event) {
             location.href = $(this).attr('href');
        }).confirm({
            timeout:3000,
            dialogShow:'fadeIn',
            dialogSpeed:'slow',
            buttons: {
                wrapper:'<button></button>',
                separator:'  '
            }  
        });
    });
</script>  
{/literal}
<form name="addnotamarginal" action="__addnotamarginal.php" method="post" id="addnotamarginal">
<fieldset>
<legend>Datos de la Nota Marginal</legend>
    <table>
        <tr><td><b>Acto modificador:</b><td></tr> 
        <tr><td><input type="text" name="actomodificador" value="" size=60  {$disabled}/><td></tr>
    </table>
    <table style="border: dashed 1px #666666;">
        <tr><td colspan="6"><b>Datos de la inscripci&oacute;n modificadora</b><td></tr> 
        <tr><td colspan="6"><b><br/><td></tr> 
        <tr><td><b>Lugar de inscripci&oacute;n</b><td> 
        <td><b>Libro (Rubro)</b><td> 
        <td><b>Tomo </b><td>
        <td><b>Folio</b><td>
        <td><b>Partida</b><td>
        <td><b>A&ntilde;o</b><td>
	</tr> 
        <tr><td><input type="text" name="lugarinscripcion" value="" size="15"  {$disabled}/><td>
        <td><input type="text" name="libroinscripcion" value="" size="15"  {$disabled}/><td>
        <td><input type="text" name="tomoinscripcion" value="" size="7"  {$disabled}/><td>
        <td><input type="text" name="folioinscripcion" value="" size="7"  {$disabled}/><td>
        <td><input type="text" name="partidainscripcion" value="" size="7"  {$disabled}/><td>
        <td><input type="text" name="anyoinscripcion" value="" size="5"  {$disabled}/><td></tr>

    </table>
    <table>
        <tr><td><b>Fecha de la marginaci&oacute;n:</b><td></tr> 
        <tr><td><input type="text" id="fechamarginacion" name="fechamarginacion" value="" size=14  {$disabled}/><td></tr>
    </table>

    <table>
        <tr><td><b>Modificacion:</b><td></tr>
        <tr><td><textarea cols="70" name="modificacion" id="modificacion" rows="4"  {$disabled}></textarea><td></tr>
    </table>
    <br />
    <table>
        <tr><td><b>Cuerpo</b><td></tr>
        <tr><td><textarea cols="70" name="cuerpo" id="cuerpo" rows="4"  {$disabled}></textarea><td></tr>
    </table>
    </fieldset> 
<div class="filadatos noborde" style="float:right">
    <input  type="hidden"  id="idinscripcion" name="idinscripcion" value="{$idinscripcionmarginal}"/>
    <input  type="hidden"  id="idnotamarginal" name="idnotamarginal" value="{$idnotamarginal}"/> 
    {if $disabled == ''}
      <div style="padding-right:20px;">
        <input class=" asistenciabutton submit" type="submit"  id="add" name="add" value="adicionar"/> 
      </div>   
    {/if}    
    <div class="limpiar"></div>
</div><!--filadatos--> 
 <div class="limpiar"></div>  
</form>
