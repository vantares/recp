<div id="cajadatos"> 
    <div id="contenidowizard">
       <div class="headerwizardizq">Nota Marginal No {$notamarginalbd->request.notamarginal} Detalles</div> 
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    <form name="inscripcion" action="{$url}" method="post" id="inscripcion">
    <fieldset>
        <legend>General</legend>
        <table width="65%">
            <tr>
                <td align="right">IdNotaMarginal</td>
                <td>
                   {$notamarginalbd->request.idnotamarginal}
                </td>
                <td align="right">IdInscripcion</td>
                <td>{$notamarginalbd->request.idinscripcion}</td>
            </tr>
            </table> 
    </fieldset>
    <br />
    <fieldset>
        <legend>Datos Inscripcion </legend>
        <table width="100%">
            <tr>
                <td width="16%" align="right">Tomo Inscripcion:</td>
                <td width="25%" align="left"><b>{$notamarginalbd->request.tomoinscripcion}</b></td>
                <td width="14%" align="right">Folio Inscripcion:</td>
                <td width="24%" align="left"><b>{$notamarginalbd->request.folioinscripcion}</b></td>
                <td width="22%" align="right">&nbsp;</td>
                <td width="1%" class="tcenter">&nbsp;</td>
            </tr>
            <tr>
                <td align="right">Partida Inscripcion:</td>
                <td align="left"><b>{$notamarginalbd->request.partidainscripcion}</b></td>
                <td align="right">A&ntilde;o Inscripci&oacute;n:</td>
                <td align="left"><b>{$notamarginalbd->request.anyoinscripcion}</b></td>
                <td class="tcenter">&nbsp;</td>
                <td class="tcenter">&nbsp;</td>                
            </tr>
            <tr>
                <td align="right">Lugar Inscripcion:</td>
                <td align="left"><b>{$notamarginalbd->request.lugarinscripcion}</b></td>
                <td align="right">Libro Inscripci&oacute;n:</td>
                <td align="left"><b>{$notamarginalbd->request.libroinscripcion}</b></td>
                <td class="tcenter">&nbsp;</td>
                <td class="tcenter">&nbsp;</td>             
            </tr>
        </table>
    </fieldset>
    <fieldset>
        <legend>Modificaciones</legend>
        <table>
            <tr>
              <td><b>Acto modificador:</b></td>
              <td>{$notamarginalbd->request.actomodificador}</td>
            </tr>
        </table>        
        <table>
            <tr><td><b>Modificacion</b></td></tr>
            <tr><td><p>{$notamarginalbd->request.modificacion|nl2br}<p><td></tr>
        </table>
        <br />
        <table>
            <tr><td><b>Cuerpo</b></td></tr>
            <tr><td><p>{$notamarginalbd->request.cuerpo|nl2br}<p></td></tr>
        </table>
        </fieldset>
        <br />
</div><!--cajadatos-->