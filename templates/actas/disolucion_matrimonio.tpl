<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="805" border="0" style="font-size:12px;font-family:Verdana">
  <tr>
    <td width="93" align="right"><img src="/imagenes/logoNica.png" alt="" width="103" height="88" /></td>
    <td width="630" valign="top"><table width="100%" border="0">
      <tr>
        <td align="center"><h1 style="font-size:26px; margin:0;padding:0px">ALCALDIA MUNICIPAL DE MATAGALPA</h1></td>
      </tr>
      <tr>
        <td align="center" style="font-size:18px;">Telf:772-2780 / 772-3456</td>
        </tr>
    </table></td>
    <td width="68"><img src="/imagenes/cunno2.png" alt="" width="68" height="90" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center"><h2 style="font-size:18px; margin:0;padding:0px">REGISTRO CIVIL</h2></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" style="font-size:16px;">CERTIFICACION DE DISOLUCION DEL VINCULO MATRIMONIAL</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="68%">EL SUSCRITO REGISTRADOR DEL ESTADO CIVIL DE LAS PERSONAS DEL MUNICIPIO DE</td>
        <td width="32%" style="border-bottom:#999999 1px solid;">{$Municipio|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="27%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
        <td width="17%">DEPARTAMENTO DE</td>
        <td width="16%" style="border-bottom:#999999 1px solid;">{$Departamento|upper}</td>
        <td width="40%">Y SECRETARIA QUE AUTORIZA Y CERTIFICA QUE</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="70%">QUE EN LIBRO DE DISOLUCION DE VINCULO MATRIMONIAL CORRESPONDIENTE AL AÑO</td>
        <td width="30%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="20%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
        <td width="59%">SE ENCUENTRA INSCRITA EL ACTA DE DIVORCIO QUE LITERALMENTE DICE</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="7%">PARTIDA</td>
        <td width="32%" style="border-bottom:#999999 1px solid;">{$actabd->request.partida}</td>
        <td width="5%">TOMO</td>
        <td width="25%" style="border-bottom:#999999 1px solid;">{$numero}</td>
        <td width="5%">FOLIO</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{$actabd->request.folio}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="3%">EN</td>
        <td width="40%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.municipioinscripcion|upper}</td>
        <td width="16%">DEPARTAMENTO DE</td>
        <td width="41%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.departamentoinscripcion|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="7%">DEL DIA</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%l"}</td>
        <td width="8%">DEL MES</td>
        <td width="25%" style="border-bottom:#999999 1px solid;">{$actabd->request.fecha|date_format:"%B"|upper}</td>
        <td width="8%">DEL AÑO</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">ANTE EL SUSCRITO REGISTRADOR DEL ESTADO CIVIL DE LAS PERSONAS Y SECRETARIA QUE AUTORIZA COMPARECE:</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.compareciente1nombre|upper}</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="5%">EDAD</td>
        <td width="38%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$inscripcionbd->request.compareciente1edad|upper}  A&Ntilde;OS</td>
        <td width="6%">OFICIO</td>
        <td width="38%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.compareciente1oficio|upper}</td>
        <td width="13%">ESTADO CIVIL</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="23%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
        <td width="10%">DOMICILIO</td>
        <td width="35%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.compareciente1domicilio|upper}</td>
        <td width="32%">Y PRESENTA PARA SU INSCRIPCION LA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="13%">SENTENCIA DE</td>
        <td width="87%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
        </tr>
      <tr>
        <td>DICTADA POR</td>
        <td style="border-bottom:#999999 1px solid;">{$actojuridico->request.jueznotario|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="24%">JUEZ CIVIL DEL DISTRITO DE</td>
        <td width="47%" style="border-bottom:#999999 1px solid;">{$actojuridico->request.nombrejuzgado|upper}</td>
        <td width="29%">QUE EN SUS PARTES CONDUCENTES</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="10%">DICE: A LAS</td>
        <td width="29%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%I"}</td>
        <td width="6%">DE LA</td>
        <td width="23%" style="border-bottom:#999999 1px solid;">{if $actabd->request.fecha|date_format:"%H">=12}TARDE{else}MA&Ntilde;ANA{/if}</td>
        <td width="7%">DEL DIA</td>
        <td width="25%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%l"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="10%" height="18">DEL MES DE</td>
        <td width="30%" style="border-bottom:#999999 1px solid;">{$actabd->request.fecha|date_format:"%B"|upper}</td>
        <td width="8%">DEL AÑO</td>
        <td width="29%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"}</td>
        <td width="23%">EN LA QUE ORDENA LA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="34%">DISOLUCION DEL VINCULO MATRIMONIAL</td>
        <td width="63%" style="border-bottom:#999999 1px solid;">{$disolucionmatrimonio->request.conyuge1nombre|upper}</td>
        <td width="3%">Y</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="66%" style="border-bottom:#999999 1px solid;">{$disolucionmatrimonio->request.conyuge2nombre|upper}</td>
        <td width="34%">EN DICHO MATRIMONIO PROCREAR A LOS</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="16%">SIGUIENTES HIJOS</td>
        <td width="84%" style="border-bottom:#999999 1px solid;">{$hijos}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="31%">EL GUARDA MENORES LE QUEDA AL (A)</td>
        <td width="69%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="49%">EL PADRE PASARA LA PENSION ALIMENTICIA MENSUAL DE CS</td>
        <td width="51%" style="border-bottom:#999999 1px solid;">{$disolucionmatrimonio->request.pensionalimenticia}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="9%">EN LETRAS</td>
        <td width="91%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$disolucionmatrimonio->request.pensionalimenticia}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="13%">BIEN INMUEBLE</td>
        <td width="87%" style="border-bottom:#999999 1px solid;">{$disolucionmatrimonio->request.propietarioinmueble|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="14%">OBSERVACIONES</td>
        <td width="86%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.observaciones|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="6%">A LOS</td>
        <td width="29%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$fecha|date_format:"%l"}</td>
        <td width="11%">DEL MES DE</td>
        <td width="22%" style="border-bottom:#999999 1px solid;">{$fecha|date_format:"%B"|upper}</td>
        <td width="4%">AÑO</td>
        <td width="28%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$fecha|date_format:"%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</body>
</html>
