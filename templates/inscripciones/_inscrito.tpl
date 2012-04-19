{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkinscrito").click(function(evento){
       evento.preventDefault();   
       $("#cargando_inscrito").css("display", "inline");
       $("#inscrito").load("cargardatosnacimiento.php", {idtomo: $("#tomoinscripcionnacimiento").val(), folio: $("#folioinscripcionnacimiento").val(), tipo: 'inscrito', template: 'inscripciones/_inscrito.tpl', id: $("#idinscripcion").val()}, 
       function(){
            $("#cargando_inscrito").css("display", "none"); 
       });
    }); 
});
</script>

{/literal}
<table width="80%">
    <tr>
        <td>Datos de la partida Nacimiento</td>
    </tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" id="tomoinscripcionnacimiento" name="tomoinscripcionnacimiento" value="{$arraynacimiento.inscrito.tomo}" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" id="folioinscripcionnacimiento" name="folioinscripcionnacimiento" value="{$arraynacimiento.inscrito.actabd->request.folio}"  {$disabled}/></td>          
            <td class="tcenter" width="25%"><input type="text" name="partidainscripcionnacimiento" value="{$arraynacimiento.inscrito.actabd->request.partida}" {$disabled}/></td>
            <td width="15%">
                <span class="chequear">
                   {if $add != ''}<a href="#" id="checkinscrito">Chequear</a>{/if} 
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
            <td class="tcenter" width="25%"><input type="text" name="inscrito1nombre1" value="{$arraynacimiento.inscrito.inscripcion->request.inscrito1nombre1}" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" name="inscrito1nombre2" value="{$arraynacimiento.inscrito.inscripcion->request.inscrito1nombre2}"  {$disabled}/></td>          
            <td class="tcenter" width="25%"><input type="text" name="inscrito1apellido1" value="{$arraynacimiento.inscrito.inscripcion->request.inscrito1apellido1}"  {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" name="inscrito1apellido2" value="{$arraynacimiento.inscrito.inscripcion->request.inscrito1apellido2}"  {$disabled}/></td>  
          </tr>
          <tr>
            <td>Nombre1</td>
            <td>Nombre2</td>
            <td>Apellido1</td> 
            <td>Apellido2</td>
          </tr>
        </table></td>
    </tr>     
    <tr>
       <td><input type="text" name="anyoinscripcionnacimiento" value="{$arraynacimiento.inscrito.anyo}" {$disabled} size=20/></td>
       <td colspan="2"><input type="text" name="lugarinscripcionnacimiento" value="{$arraynacimiento.inscrito.hechovital->request.ciudadnacimiento|cat:' '|cat:$arraynacimiento.inscrito.hechovital->request.departamentonacimiento}" {$disabled} size=40/></td>
        
    </tr>
    <tr>
        <td>A&ntilde;o Inscripci&oacute;n</td>
        <td colspan="2">Lugar Inscripcion</td>
    </tr>
    <tr>
        <td colspan="4">{$error}</td>
    </tr>     
    <tr>
        <td colspan="4"><hr /></td>
    </tr>    
</table> 