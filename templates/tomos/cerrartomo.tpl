{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#cierretomo").validate({
        rules: {
            fechacierre: {
                required: true,
                date: true
            } 
                       
        },
        messages: {
            fechacierre: "Fecha de cierre no puede estar vacia"                    
        }
    });
   
});
</script>
<script type="text/javascript">
$(function() {
    $("#fechacierre").datepicker();
});
</script>  
{/literal}
<div id="cajadatos"> 
    <div id="contenidowizard">
       <div class="headerwizardizq">{$titular}</div> 
       <div id="opciones">
             <a href="/modulos/tomos">Listado</a>
       </div><!--opciones-->           
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    {if $notice != ''} 
       {include file="notice.tpl"}
    {else} 
    <form name="cierretomo" action="/modulos/tomos/cerrartomo.php" method="post" id="cierretomo">
    <fieldset>
        <legend>Datos del Cierre</legend>
        <table width="100%">
            <tr>
               <td width="14%" align="right" class="tcenter">Fecha Cierre:&nbsp;</td>
              <td width="86%" align="left"><input type="text" id="fechacierre" name="fecha" value="{$fechacierre}" {$disabled}></td>
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend>Registro</legend>
        <table>
        <tr>
            <td>Registrador</td>
            <td>
                  <select name="registrador" class="listwizard selectwizard"  {$disabled}>
                      {section name=id loop=$Registradores}
                         <option value="{$Registradores[id].nombreusuario}" {if $Registradores[id].nombreusuario == $cierrebd->request.registrador}selected{/if}>{$Registradores[id].nombreusuario}</option>
                      {/section}
                   </select>
            </td>
            <td>Secretario</td>
            <td>
                  <select name="secretario" class="listwizard selectwizard"  {$disabled}>
                      {section name=id loop=$Secretarios}
                         <option value="{$Secretarios[id].nombreusuario}" {if $Secretarios[id].nombreusuario == $cierrebd->request.secretario}selected{/if}>{$Secretarios[id].nombreusuario}</option>
                      {/section}
                   </select>            
             </td>
        </tr>
        </table>
    </fieldset> 
      <div class="filadatos noborde" style="float:right">
            <input  type="hidden"  name="idtomo" value="{$idtomo}"/>
            <input class=" asistenciabutton submit" type="submit"  name="cerrar" value="cerrar"/>  
        <div class="limpiar"></div>
      </div><!--filadatos-->          
    </form>
    {/if}
</div><!--cajadatos-->