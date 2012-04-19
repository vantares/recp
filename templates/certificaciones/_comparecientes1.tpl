<table width="80%"> 
    <tr><td>Compareciente 1</td></tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="25%"><input type="text" id="compareciente1cedula" name="compareciente1cedula" value="{$compareciente1->request.cedula}" {$disabled}></td>
            <td width="17%"><span class="chequear">
               {if $add != ''}
                   <a href="#" id="checkcompareciente1">Chequear</a>
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
        <td colspan="4" style="padding-left:10px;"><input type="text" name="compareciente1nombre" value="{$compareciente1->request.nombre}" size=60 {$disabled}></td>
    </tr>
    <tr>
        <td colspan="4" style="padding-left:10px;">Nombre y Apellidos</td>
    </tr>
    <tr>
         <td class="tcenter"><input type="text" name="compareciente1edad" value="{$compareciente1->request.edad}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="compareciente1oficio" value="{$compareciente1->request.oficio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="compareciente1domicilio" value="{$compareciente1->request.domicilio}" {$disabled}></td>
         <td class="tcenter"><input type="text" name="compareciente1nacionalidad" value="{$compareciente1->request.nacionalidad}" {$disabled}></td>
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
