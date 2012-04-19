<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cierre del libro</title>
</head>

<body>
<table width="805" border="0" style="font-family:Verdana; font-size:12px">
  <tr>
    <td width="110" align="right">
        <table width="100%" border="0">
          <tr>
            <td align="center"><img src="/imagenes/logoApertura.png" alt="" width="58" height="77" /></td>
          </tr>
          <tr>
            <td align="center">ORIGINAL</td>
          </tr>
        </table>  
    </td>
    <td colspan="3" align="center"><table width="100%" border="0">
      <tr>
        <td align="center"><h1 style="font-size:15px;margin:0;padding:0">CONSEJO SUPREMO ELECTORAL</h1></td>
      </tr>
      <tr>
        <td align="center">REGISTRO DEL ESTADO CIVIL DE LAS PERSONAS</td>
      </tr>
    </table></td>
    <td width="116"><table width="100%" border="0">
      <tr>
        <td align="left"><h4 style="font-size:12px">Serie </h4></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="155" align="right">De:</td>
    <td width="200" style="border-bottom:#999999 1px solid">{$Provincia|upper}</td>
    <td width="202">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">MUNICIPIO</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" height="100">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="center"><h3>ACTA DE CIERRE</h3></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" height="100">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>  
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><table width="100%" border="0">
      
      <tr>
        <td align="right"><table width="100%" border="0">
          <tr>
            <td width="22%">En el Municipio de</td>
            <td width="77%" style="border-bottom:#999999 1px solid">{$Municipio|upper}</td>
            <td width="1%">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right"><table width="100%" border="0">
          <tr>
            <td width="26%">del Departamento de</td>
            <td width="73%" style="border-bottom:#999999 1px solid">{$Departamento|upper}</td>
            <td width="1%" align="left" >,</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;el suscrito Registrador del Estado Civil de las Personas, hace constar que a la fecha</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="25%">se cierra el libro de</td>
        <td width="74%" style="border-bottom:#999999 1px solid">{$valores.rubro|upper}</td>
        <td width="1%">,</td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="68%">que se llevó durante el presente año y el cual consta de </td>
            <td width="34%" style="border-bottom:#999999 1px solid">{$valores.cantfolios}</td>
            <td width="2%">folios</td>
          </tr>
        </table></td>
        <td>,</td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0">
          <tr>
            <td width="5%">con</td>
            <td width="28%" style="border-bottom:#999999 1px solid">{$valores.cantpartidas}</td>
            <td width="39%">asientos, siendo el tomo número</td>
            <td width="28%" style="border-bottom:#999999 1px solid">{$valores.numero}</td>
          </tr>
        </table></td>
        <td>.</td>
      </tr>
      <tr>
        <td colspan="2" height="30">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0">
          <tr>
            <td width="63%">En fe de lo cual firmamos y sellamos la presente a los</td>
            <td width="37%" style="border-bottom:#999999 1px solid">{convertir_a_letras numero=$cierre->request.fecha|date_format:"%d" modificador="lower"}</td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0">
          <tr>
            <td width="19%">días del mes de</td>
            <td width="21%" style="border-bottom:#999999 1px solid">{$cierre->request.fecha|date_format:"%B"|upper}</td>
            <td width="5%">&nbsp;del</td><td width="49%" style="border-bottom:#999999 1px solid"> {convertir_a_letras numero=$cierre->request.fecha|date_format:"%Y" modificador="lower"}</td>
          </tr>
        </table></td>
        <td>.</td>
      </tr>
      <tr>
        <td colspan="2" height="50">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="0">
          <tr>
            <td width="32%" style="border-bottom:#999999 1px solid">{$valores.registrador|upper}</td>
            <td width="35%">&nbsp;</td>
            <td width="33%" style="border-bottom:#999999 1px solid">{$valores.secretario|upper}</td>
          </tr>
          <tr>
            <td align="center">REGISTRADOR</td>
            <td>&nbsp;</td>
            <td align="center">SECRETARIO</td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
