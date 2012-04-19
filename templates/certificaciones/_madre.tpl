<table width="80%"> 
    <tr><td>Madre</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="cedulamadre" name="cedulamadre" value="{$madre->request.cedula}" {$disabled} /></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkmadre">Chequear</a>
               {/if} 
               </span>
            </td>
            <td width="58%"><div class="error">{$error}</div></td>
          </tr>
          <tr>
            <td>Cedula</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;"><input type="text" name="nombremadre" value="{$madre->request.nombre}" size=60 {$disabled} /></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="edadmadre" value="{$madre->request.edad}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="oficiomadre" value="{$madre->request.oficio}"  {$disabled} /></td>
         <td class="tcenter"><input type="text" name="domiciliomadre" value="{$madre->request.domicilio}" {$disabled} /></td>
         <td class="tcenter"><input type="text" name="nacionalidadmadre" value="{$madre->request.nacionalidad}" {$disabled} /></td>
    </tr>
    <tr>
        <td class="tcenter">Edad</td>
        <td class="tcenter">Profesion</td>
        <td class="tcenter">Domicilio</td>
        <td class="tcenter">Nacionalidad</td>
    </tr>
    <tr>
        <td colspan="4"><hr /></td>
    </tr>
</table>
