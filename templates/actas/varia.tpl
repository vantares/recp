<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscripcion Varia</title>
</head>

<body>
<table width="805" border="0" style="font-family:Verdana; font-size:12px">
  <tr>
    <td colspan="3">    </td>
  </tr>
  <tr>
    <td width="138" valign="top"><table width="100%" border="0">
      <tr>
        <td align="right"><img src="/imagenes/logoNica.png" alt="" width="103" height="88" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td width="535"><table width="100%" border="0">
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
            <td width="48%" style="border-bottom:#999999 1px solid;">{$Municipio|upper}</td>
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
    <td width="124"><table width="100%" border="0">
      <tr>
        <td width="51%" align="right">SERIE&nbsp;</td>
        <td width="49%">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">TOMO&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$actabd->getNoTomo()}</td>
      </tr>
      <tr>
        <td align="right">FOLIO&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$actabd->request.folio}</td>
      </tr>
      <tr>
        <td align="right">PARTIDA&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$actabd->request.partida}</td>
      </tr>
      <tr>
        <td align="right">FECHA&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$actabd->request.fecha|date_format:"%d/%m/%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="22%">ACTA DE INSCRIPCION DE</td>
        <td width="38%" style="border-bottom:#999 1px solid">{$inscripcionvaria->request.tipootrainscripcion|upper}</td>
        <td width="40%">&nbsp;</td>
      </tr>
      <tr>
        <td>(ORIGINAL)</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="25%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1nombre1|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="25%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1nombre2|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="24%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1apellido1|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1apellido2|upper}</td>
      </tr>
      <tr>
        <td height="25" align="center">PRIMER NOMBRE</td>
        <td>&nbsp;</td>
        <td height="25" align="center">SEGUNDO NOMBRE</td>
        <td>&nbsp;</td>
        <td height="25" align="center">PRIMER APELLIDO</td>
        <td>&nbsp;</td>
        <td height="25" align="center">SEGUNDO APELLIDO</td>
      </tr>
    </table></td>
  </tr>  
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="3%">EN</td>
        <td width="42%" style="border-bottom:#999999 1px solid;">{$Ciudad|upper}</td>
        <td width="14%">, MUNICIPIO DE</td>
        <td width="41%" style="border-bottom:#999999 1px solid;">{$Municipio|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="16%">DEPARTAMENTO DE</td>
        <td width="26%" style="border-bottom:#999999 1px solid;" align="center">{$Departamento|upper}</td>
        <td width="6%" align="right" > A LAS</td>
        <td width="21%" style="border-bottom:#999999 1px solid;" align="center">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%I"}</td>
        <td width="6%" align="right">DE LA</td>
        <td width="25%" style="border-bottom:#999999 1px solid;" align="center">{if $actabd->request.fecha|date_format:"%H">=12}TARDE{else}MA&Ntilde;ANA{/if}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="7%">DEL DIA</td>
        <td width="21%" style="border-bottom:#999999 1px solid;" align="center">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%l"|upper}</td>
        <td width="11%">DEL MES DE</td>
        <td width="23%" style="border-bottom:#999999 1px solid;" align="center">{$actabd->request.fecha|date_format:"%B"|upper}</td>
        <td width="10%">DEL AÑO</td>
        <td width="28%" style="width:150px;border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"}</td>
        <td width="1%" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>    
  <tr>
    <td colspan="3">ANTE EL SUSCRITO REGISTRADOR DEL ESTADO CIVIL DE LAS PERSONAS Y EL SECRETARIO QUE AUTORIZA COMPARECE:</td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1nombre|upper} </td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$inscripcionbd->request.compareciente1edad} A&Ntilde;OS</td>
        </tr>
      <tr>
        <td align="center">NOMBRES Y APELLIDOS</td>
        <td>&nbsp;</td>
        <td width="28%" align="center">EDAD (EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1oficio|upper}</td>
        <td width="3%">&nbsp;</td>
        <td width="21%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1estadocivil|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="31%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1domicilio|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1cedula|upper}</td>
      </tr>
      <tr>
        <td align="center">PROFESI&Oacute;N U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">ESTADO CIVIL</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">C&Eacute;DULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="27%">Y SOLICITA LA INSCRIPCION DE:</td>
        <td width="73%" style="border-bottom:#999999 1px solid;">{$inscripcionvaria->request.tipootrainscripcion|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="25%">(DICTADA O AUTORIZADA POR):</td>
        <td width="75%" style="border-bottom:#999999 1px solid;">{$actojuridico->request.jueznotario|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="38%">LA QUE EN SUS PARTES CONDUCENTES DICE:</td>
        <td width="60%" style="border-bottom:#999999 1px solid;">{$inscripcionvaria->request.partesconducentes|upper}</td>
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
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr> 
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr> 
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>     
  <tr>
    <td colspan="3"><table width="805" border="0">
      <tr>
        <td width="247">ACTOS OCURRIDOS  EN EL EXTRANJERO:</td>
        <td width="548" style="border-bottom:#999 1px solid">{$inscripcionbd->request.enextrangero|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="805" border="0">
      <tr>
        <td width="140">DATOS ADICIONALES:</td>
        <td width="662" style="border-bottom:#999 1px solid">{$inscripcionbd->request.datosadicionales|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>  
  <tr>
    <td colspan="3"><table width="805" border="0">
      <tr>
        <td width="107">OBSERVACIONES:</td>
        <td width="688" style="border-bottom:#999 1px solid">{$inscripcionbd->request.observaciones|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>   
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>    
  <tr>
    <td colspan="3"><table width="805" border="0">
      <tr>
        <td width="236">MODIFICACIONES DEL ESTADO CIVIL:</td>
        <td width="559" style="border-bottom:#999 1px solid">{$modificacion|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>  
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>   
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>     
  <tr>
    <td colspan="3"><table width="805" border="0">
      <tr>
        <td>LEIDA QUE FUE LA PRESENTE ACTA SE ENCUENTRA CONFORME, SE APRUEBA, RATIFICA Y FIRMAN PONIENDO RAZON DE TAL MODIFICACION DEL ESTADO CIVIL EN EL ASIENTO ORIGINAL:</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><table width="805" border="0">
      <tr>
        <td align="center">&nbsp;</td>
        <td style="border-bottom:#999 1px solid">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center">COMPARECIENTE</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom:#999 1px solid">&nbsp;</td>
        <td >&nbsp;</td>
        <td style="border-bottom:#999 1px solid">&nbsp;</td>
      </tr>
      <tr>
        <td width="239" align="center">REGISTRADOR</td>
        <td width="313">&nbsp;</td>
        <td width="239" align="center">SECRETARIO</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">NACIMIENTO:</td>
  </tr>
  <tr>
    <td colspan="3"><table width="805" border="0">
      <tr>
        <td width="90" height="16">INSCRITO EN:</td>
        <td width="226" style="border-bottom:#999 1px solid">{$inscripcionvaria->request.lugarinscripcionnacimiento|upper}</td>
        <td width="37">TOMO</td>
        <td width="71" style="border-bottom:#999 1px solid">{$inscripcionvaria->request.tomoinscripcionnacimiento|upper}</td>
        <td width="40">FOLIO</td>
        <td width="73" style="border-bottom:#999 1px solid">{$inscripcionvaria->request.folioinscripcionnacimiento|upper}</td>
        <td width="54">PARTIDA</td>
        <td width="70" align="right" style="border-bottom:#999 1px solid">{$inscripcionvaria->request.partidainscripcionnacimiento|upper}</td>
        <td width="32" align="right">AÑO</td>
        <td width="70" style="border-bottom:#999 1px solid">{$inscripcionvaria->request.anyoinscripcionnacimiento|upper}</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
