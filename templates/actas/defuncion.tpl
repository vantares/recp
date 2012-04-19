<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscripcion Defuncion</title>
</head>

<body>
<table width="803" border="0" style="font-size:12px; font-family:Verdana">
  <tr>
    <td width="170" valign="top"><table width="100%" border="0">
      <tr>
        <td align="right"><img src="/imagenes/logoNica.png" alt="" width="103" height="88" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">DEFUNCION</td>
      </tr>
      <tr>
        <td align="center">(ORIGINAL)</td>
      </tr>
    </table></td>
    <td width="466"><table width="100%" border="0">
      <tr>
        <td align="center"><h1 style="font-size:18px;margin:0;padding:0">DEL CONSEJO SUPREMO ELECTORAL</h1></td>
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
    <td width="153"><table width="100%" border="0">
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
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1nombre1|upper}</td>
        <td width="7%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1nombre2|upper}</td>
        <td width="7%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1apellido1|upper}</td>
        <td width="6%">&nbsp;</td>
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
    <td colspan="3" valign="top"><table width="100%" border="0">
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
        <td width="17%" align="right">DEPARTAMENTO DE</td>
        <td width="25%" style="border-bottom:#999999 1px solid;">{$Departamento|upper}</td>
        <td width="6%" align="right" > A LAS</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%I"}</td>
        <td width="6%" align="right">DE LA</td>
        <td width="25%" style="border-bottom:#999999 1px solid;">{if $actabd->request.fecha|date_format:"%H">=12}TARDE{else}MA&Ntilde;ANA{/if}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="7%">DEL DIA</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%l"}</td>
        <td width="11%" >DEL MES DE</td>
        <td width="22%" style="border-bottom:#999999 1px solid;">{$actabd->request.fecha|date_format:"%B"|upper}</td>
        <td width="10%">DEL AÑO</td>
        <td width="28%" style="width:150px;border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">ANTE EL SUSCRITO REGISTRADOR DEL ESTADO CIVIL DE LAS PERSONAS Y EL SECRETARIO QUE AUTORIZA COMPARECE:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1nombre|upper}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$inscripcionbd->request.compareciente1edad|upper}  A&Ntilde;OS</td>
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
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1oficio|upper}</td>
        <td width="3%">&nbsp;</td>
        <td width="21%" style="border:#999999 1px solid;" height="25"></td>
        <td width="2%">&nbsp;</td>
        <td width="31%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1domicilio|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1cedula}</td>
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
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="17%">Y AVISA QUE A LAS</td>
        <td width="45%" style="border-bottom:#999999 1px solid;" >{convertir_a_letras numero=$defuncion->request.fechadefuncion|date_format:"%I"}</td>
        <td width="6%">DE LA</td>
        <td width="34%" style="border-bottom:#999999 1px solid;">{if $defuncion->request.fechadefuncion|date_format:"%H">=12}TARDE{else}MA&Ntilde;ANA{/if}</td>      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="7%">DEL DIA</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$defuncion->request.fechadefuncion|date_format:"%l"}</td>
        <td width="11%" >DEL MES DE</td>
        <td width="22%" style="border-bottom:#999999 1px solid;">{$defuncion->request.fechadefuncion|date_format:"%B"|upper}</td>
        <td width="10%">DEL AÑO</td>
        <td width="28%" style="width:150px;border-bottom:#999999 1px solid;">{convertir_a_letras numero=$defuncion->request.fechadefuncion|date_format:"%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">FALLECIO:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">
      <table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.inscrito1nombre1|upper} {$inscripcionbd->request.inscrito1nombre2|upper} {$inscripcionbd->request.inscrito1apellido1|upper} {$inscripcionbd->request.inscrito1apellido2|upper}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$defuncion->request.edadfallecido}  A&Ntilde;OS</td>
        </tr>
      <tr>
        <td align="center">NOMBRES Y APELLIDOS</td>
        <td>&nbsp;</td>
        <td width="29%" align="center">EDAD (EN LETRAS)</td>
        <td width="4%">&nbsp;</td>
      </tr>
    </table>    </td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="5%" height="16">SEXO</td>
        <td width="3%" align="right">M</td>
        <td width="4%" style="border:#999999 1px solid;" height="25">{if $hechovital->request.sexoinscrito=="m"}X{/if}</td>
        <td width="4%" align="right">F</td>
        <td width="4%" style="border:#999999 1px solid;" height="25">{if $hechovital->request.sexoinscrito=="f"}X{/if}</td>
        <td width="3%">&nbsp;</td>
        <td width="19%" style="border:#999999 1px solid;" height="25">{$defuncion->request.oficiofallecido|upper}</td>
        <td width="1%">&nbsp;</td>
        <td width="22%" style="border:#999999 1px solid;" height="25">{$defuncion->request.estadocivil|upper}</td>
        <td width="1%">&nbsp;</td>
        <td width="34%" style="border:#999999 1px solid;" height="25">{$defuncion->request.domiciliofallecido|upper}</td>
      </tr>
      <tr>
        <td height="16" colspan="6">&nbsp;</td>
        <td align="center" >PROFESI&Oacute;N U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center" >ESTADO CIVIL</td>
        <td>&nbsp;</td>
        <td align="center" >DOMICILIO</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="24%" style="border:#999999 1px solid;" height="25">{$defuncion->request.nacionalidadfallecido|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="20%" style="border:#999999 1px solid;" height="25">{$defuncion->request.cedulafallecido|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="52%" style="border:#999999 1px solid;" height="25">{$defuncion->request.causamuerte|upper}</td>
      </tr>
      <tr>
        <td align="center">NACIONALIDAD</td>
        <td>&nbsp;</td>
        <td align="center">C&Eacute;DULA</td>
        <td>&nbsp;</td>
        <td align="center">CAUSA DE LA MUERTE</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">
    <table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$defuncion->request.conyugenombre|upper}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;"></td>
        </tr>
      <tr>
        <td align="center">NOMBRES Y APELLIDOS DEL CONYUGE</td>
        <td>&nbsp;</td>
        <td width="29%" align="center">EDAD (EN LETRAS)</td>
        <td width="4%">&nbsp;</td>
      </tr>
    </table>    </td>
  </tr>
  <tr>
    <td colspan="3" valign="top">HABIENDO NACIDO EN:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="24%" style="border:#999999 1px solid;" height="25">{$hechovital->request.ciudadnacimiento|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$hechovital->request.municipionacimiento|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="25%" style="border:#999999 1px solid;" height="25">{$hechovital->request.departamentonacimiento|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="22%" style="border:#999999 1px solid;" height="25">{$hechovital->request.paisnacimiento|upper}</td>
      </tr>
      <tr>
        <td align="center" >COMARCA O CIUDAD</td>
        <td>&nbsp;</td>
        <td align="center">MUNICIPIO</td>
        <td>&nbsp;</td>
        <td align="center" >DEPARTAMENTO</td>
        <td>&nbsp;</td>
        <td align="center" >PAIS</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="2%">EL</td>
        <td width="98%" style="border:#999999 1px solid;" height="25">
        {convertir_a_letras numero=$hechovital->request.fechanacimiento|date_format:"%e"} DE {$hechovital->request.fechanacimiento|date_format:"%B"|upper} DE {convertir_a_letras numero=$hechovital->request.fechanacimiento|date_format:"%Y"} 
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><table width="100%" border="0">
          <tr>
            <td width="32%" align="center">DIA</td>
            <td width="29%" align="center">MES</td>
            <td width="39%" align="center">AÑO (EN LETRAS)</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="18%" align="left">FUERON SUS PADRES:</td>
        <td width="39%" style="border:#999999 1px solid;" height="25">{$hechovital->request.padrenombre|upper}</td>
        <td width="1%">&nbsp;</td>
        <td width="42%" style="border:#999999 1px solid;" height="25">{$hechovital->request.nombremadre|upper}</td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
        <td align="center">NOMBRES Y APELLIDOS DEL PADRE</td>
        <td>&nbsp;</td>
        <td align="center">NOMBRES Y APELLIDOS DE LA MADRE</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="25%">FALLECIDO EN EL EXTRANJERO</td>
        <td width="75%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.enextranjero|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="18%">DATOS ADICIONALES</td>
        <td width="82%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.datosadicionales|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr> 
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="14%">OBSERVACIONES</td>
        <td width="86%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.observaciones|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>  
  <tr>
    <td colspan="3" valign="top">LEIDA QUE FUE LA PRESENTE ACTA SE ENCUENTRA CONFORME, SE APRUEBA, RATIFICA Y FIRMAN:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td>&nbsp;</td>
        <td >&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="31%">&nbsp;</td>
        <td width="36%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
        <td width="33%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center">COMPARECIENTE</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="31%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
        <td width="38%">&nbsp;</td>
        <td width="31%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">REGISTRADOR</td>
        <td>&nbsp;</td>
        <td align="center">SECRETARIO</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td valign="bottom">&nbsp;</td>
        <td>&nbsp;</td>
        <td valign="bottom">&nbsp;</td>
        <td>&nbsp;</td>
        <td valign="bottom">&nbsp;</td>
        <td>&nbsp;</td>
        <td valign="bottom">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="12%">NACIMIENTO: INSCRITO EN:</td>
        <td width="23%" style="border-bottom:#999999 1px solid;" valign="bottom">{$defuncion->request.lugarinscripcionnacimiento|upper}</td>
        <td width="5%" valign="bottom">TOMO</td>
        <td width="9%" style="border-bottom:#999999 1px solid;" valign="bottom">{$defuncion->request.tomoinscripcionnacimiento|upper}</td>
        <td width="6%" valign="bottom">FOLIO</td>
        <td width="11%" style="border-bottom:#999999 1px solid;" valign="bottom">{$defuncion->request.folioinscripcionnacimiento|upper}</td>
        <td width="7%" valign="bottom">PARTIDA</td>
        <td width="12%" style="border-bottom:#999999 1px solid;" valign="bottom">{$defuncion->request.partidainscripcionnacimiento|upper}</td>
        <td width="4%" valign="bottom">AÑO</td>
        <td width="12%" style="border-bottom:#999999 1px solid;" valign="bottom">{$hechovital->request.fechanacimiento|date_format:"%Y"}</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
