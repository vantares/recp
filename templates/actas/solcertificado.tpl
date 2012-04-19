<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Solicitud Certificado</title>
</head>

<body>
<table width="815" border="0" style="font-family:Verdana; font-size:12px;">
  <tr>
    <td width="91"><img src="imagenes/cunno1.png" alt="" width="88" height="90" /></td>
    <td width="648" valign="top"><table width="100%" border="0">
      <tr>
        <td align="center"><h1 style="font-size:26px;margin:0;padding:0">ALCALDIA MUNICIPAL DE MATAGALPA</h1></td>
      </tr>
      <tr>
        <td align="center"><h3 style="font-size:18px;margin:0;padding:0">EL REGISTRO DEL ESTADO CIVIL</h3></td>
      </tr>
    </table></td>
    <td width="62"><img src="imagenes/cunno2.png" alt="" width="68" height="88" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" valign="top" style="font-size:20px">SOLICITUD DE CERTIFICADOS</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="12%">Certificado de:</td>
        <td width="48%" style="border-bottom:#999999 1px solid">{$solicitud.tiposolicitudcertificado}</td>
        <td width="15%">Fecha de Solicitud</td>
        <td width="25%" style="border-bottom:#999999 1px solid">{$solicitud.fechasolicitud}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="19%">Nombre del interesado</td>
        <td width="81%" style="border-bottom:#999999 1px solid">{$solicitud.interesado1nombre1} {$solicitud.interesado1nombre2} {$solicitud.interesado1apellido1} {$solicitud.interesado1apellido2}{if $solicitud.interesado2nombre1},{$solicitud.interesado2nombre1} {$solicitud.interesado2nombre2} {$solicitud.interesado2apellido1} {$solicitud.interesado2apellido2}{/if}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="17%">Fecha de Nacimiento</td>
        <td width="83%" style="border-bottom:#999999 1px solid">{$solicitud.fecha}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="16%">Nombre del Padre:</td>
        <td width="84%" style="border-bottom:#999999 1px solid">{$solicitud.padrenombre1}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="17%">Nombre de la Madre:</td>
        <td width="83%" style="border-bottom:#999999 1px solid">{$solicitud.madrenombre1}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="17%">Registrada en Tomo</td>
        <td width="17%" style="border-bottom:#999999 1px solid">&nbsp;{$solicitud.tomo}</td>
        <td width="5%">Folio</td>
        <td width="16%" style="border-bottom:#999999 1px solid">&nbsp;{$solicitud.folio}</td>
        <td width="7%">Partida</td>
        <td width="17%" style="border-bottom:#999999 1px solid">&nbsp;{$solicitud.partida}</td>
        <td width="3%">Año</td>
        <td width="18%" style="border-bottom:#999999 1px solid">&nbsp;{$solicitud.anyo}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="34%" style="border-bottom:#999999 1px solid">&nbsp;</td>
        <td width="33%">&nbsp;</td>
        <td width="33%" style="border-bottom:#999999 1px solid">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">Firma del Solicitante</td>
        <td>&nbsp;</td>
        <td align="center">Recepción</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">NOTA: Dentro de 8 días estan obligados a retirar sus partidas y como máximo un mes, si dentro de ese tiempo no fueron retirados serán solicitados nuevamente</td>
  </tr>
</table>
</body>
</html>
