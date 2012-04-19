{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#nacimiento").validate({
        rules: {
            folio: {
                required: true,
                number: true               
            },
            partida: {
                required: true,
                number: true            
            },
            compareciente1cedula: {
                required: true,
                number: true            
            }            
        },
        messages: {
            folio: "Introduzca un numero",
            partida: "Introduzca un numero", 
            compareciente1cedula: "Introduzca un numero"
        }
    });
   
});
</script>
<script type="text/javascript">
$(function() {
    $("#fechainscripcion").datetimepicker();
});
$(function() {
    $("#fechanacimiento").datetimepicker();
});
</script> 
<script type="text/javascript"> 
    function setFolioPartida(tomo) {
        var partida = document.nacimiento.elements['partidas['+tomo+']'];
        var folio = document.nacimiento.elements['folios['+tomo+']'];
        document.nacimiento.folio.value =  folio.value;
        document.nacimiento.partida.value =  partida.value; 
    }
</script> 
{/literal}
<div id="cajadatos"> 
    <div id="contenidowizard">
       <div class="headerwizardizq">Defini&oacute;n de perfiles</div> 
       {if $action == 'edit'} 
       <div id="opciones">
             <a href="/modulos/perfiles/editperfil.php/add">Nuevo Perfil</a>
       </div><!--opciones-->
       {/if}  
       <div id="opciones">
             <a href="/modulos/perfiles/">Listado de Perfiles</a>
       </div><!--opciones-->           
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
       
    <fieldset>
        <legend>Perfil</legend>
           <div id="cargando1" style="display:none; color: green;">Cargando...</div>
           <div id="perfiles">
              {include file="perfiles/_perfiles.tpl"}
           </div>
    </fieldset>
    {if $action == 'edit'}
    <fieldset>
        <legend>Par&aacute;metros del Perfil</legend>
           <div id="cargando2" style="display:none; color: green;">Cargando...</div>
           <div id="parametros">
              {include file="perfiles/_parametros.tpl"}
           </div>
    </fieldset>
    <fieldset>
        <legend>Contexto del Perfil</legend>
           <div id="cargando3" style="display:none; color: green;">Cargando...</div>
           <div id="contextos">
              {include file="perfiles/_parametrocontexto.tpl"}
           </div>
        </fieldset>
    <br />     
    {/if}
</div><!--cajadatos-->