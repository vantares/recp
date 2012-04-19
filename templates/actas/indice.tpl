<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Indice de Tomo</title>
</head>

<body>
<table width="803" border="0" style="font-size:12px; font-family:Verdana">
  <tr>
    <td width="170" valign="top"><table width="100%" border="0">
      <tr>
        <td align="right"><img src="imagenes/logo.png" alt="" width="84" height="69" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="466"><table width="100%" border="0">
      <tr>
        <td align="center"><h1 style="font-size:18px;margin:0;padding:0">CONSEJO SUPREMO ELECTORAL</h1></td>
      </tr>
      <tr>
        <td align="center" ><h2 style="font-size:15px;margin:0;padding:0">REGISTRO DEL ESTADO CIVIL DE LAS PERSONAS</h2></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          <tr>
            <td width="25%" align="right">DE:</td>
            <td width="48%" style="border-bottom:#999999 1px solid;">{$Provincia|upper}</td>
            <td width="27%">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="center">MUNICIPIO</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="153"><table width="100%" border="0">
      <tr>
          <td width="46%" align="right">A&Ntilde;O&nbsp;</td>
        <td width="54%" style="border-bottom:#999999 1px solid;">{$valores.year}</td>
      </tr>
      <tr>
        <td align="right">TOMO&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$valores.numero}</td>
      </tr>
      <tr>
        <td align="right">FECHA&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$valores.indice->request.fecha|date_format:"%d/%m/%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="10%">INDICE DE:</td>
        <td width="32%" style="border-bottom:#999999 1px solid;">{$valores.rubro|upper}</td>
        <td width="58%">&nbsp;</td>
      </tr>
      <tr>
        <td>(ORIGINAL)</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#999999">
      <tr>
        <td width="4%">No</td>
        <td width="44%" align="center">NOMBRES Y APELLIDOS DE LOS INSCRITOS</td>
        <td width="9%" align="center">PARTIDA<br />
          NUMERO<br /></td>
        <td width="9%" align="center">FOLIO</td>
        <td width="9%" align="center">RUBRO</td>
        <td width="25%" align="center">OBSERVACIONES</td>
      </tr>
     {section loop=25 name=i}
      <tr>
        <td height="30" align="center">{$smarty.section.i.iteration}</td>
        <td>{$valores.items[i].inscritos|upper}</td>
        <td align="center">{$valores.items[i].partida}</td>
        <td align="center">{$valores.items[i].folio}</td>
        <td align="center">{if $valores.items[i].subrubro}{$valores.items[i].subrubro}{elseif $valores.items[i].rubro}{$valores.items[i].rubro}{/if}</td>
        <td>{*$valores.items[i].observaciones*}</td>
      </tr>
     {/section}
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="9%">&nbsp;</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{$valores.registrador|upper}</td>
        <td width="35%">&nbsp;</td>
        <td width="23%" style="border-bottom:#999999 1px solid;">{$valores.secretario|upper}</td>
        <td width="7%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center">REGISTRADOR</td>
        <td>&nbsp;</td>
        <td align="center">SECRETARIO</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
