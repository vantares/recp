<fieldset>
    <legend>General</legend>
    <table width="65%">
        <tr>
            <td align="right">Tomo</td>
            <td>
             <select name="idtomo" id="idtomo" onchange="javascript:setFolioPartida(document.inscripcion.idtomo.value)" {$disabled}>
             {if ($arrayTomos != '') && $etiqueta != 'edit'}
             {foreach key=key item=item from=$arrayTomos}
                 <option value="{$item.idtomo}" {if $item.idtomo == $tomo}selected{/if} >{$item.numero}</option>
             {/foreach}
             {else}
                <option value="{$tomo}">{$tomobd->request.numero}</option>
             {/if}
             </select>
            </td>
            {foreach key=key item=item from=$arrayPartFolio} 
               <input type="hidden" name="partidas[{$key}]" value="{$item.partida}"  size=5 />
               <input type="hidden" name="folios[{$key}]" value="{$item.folio}"  size=5 />
            {/foreach}     
            <td align="right">Folio</td>
            <td><input type="text" name="folio" value="{$folio}" size=5  {$disabled}/></td>
            <td align="right">{if $tipo == 'Disolucion Vinculo Matrimonial'} Asiento {else} Partida {/if}</td>
            <td><input type="text" name= "partida" value="{$partida}"  size=5 {$disabled} /></td>
        </tr>
        </table> 
        <table width="65%"> 
        <tr>
            <td width="120">Fecha Inscripcion</td>
            <td colspan="3" align="left" width="360">
            <input type="text" id="fechainscripcion" name="fechainscripcion" value="{$fechainscripcion}" {$disabled}/>
            </td>
        </tr>
    </table>
</fieldset>