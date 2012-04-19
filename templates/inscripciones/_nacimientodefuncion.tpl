{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checknacimiento").click(function(evento){
       evento.preventDefault();   
       $("#cargando6").css("display", "inline");
       $("#datosnacimientodefuncion").load("cargardatosnacimiento.php", {idtomo: $("#tomoinscripcionnacimiento").val(), folio: $("#folioinscripcionnacimiento").val(), tipo: 'fallecido', template: 'inscripciones/_nacimientodefuncion.tpl', defuncionb: 'ok'}, 
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
<div id="datosnacimientodefuncion">
    <fieldset>
        <legend>Datos del Nacimiento </legend>
        <div id="cargando6" style="display:none; color: green;">Cargando...</div>
        <div id="datosnacimiento">
            {include file="inscripciones/_nacimiento.tpl"}
        </div>
    </fieldset>          
    <fieldset>
        <legend>Padres</legend>
           <div id="cargando3" style="display:none; color: green;">Cargando...</div>
           <div id="padre">
              {include file="inscripciones/_padre.tpl"}
           </div>
           <div id="cargando4" style="display:none; color: green;">Cargando...</div>
           <div id="madre">{include file="inscripciones/_madre.tpl"}</div>
        </table>
    </fieldset>
</div>    