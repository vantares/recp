<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscripcion Nacimiento</title>
</head>

<body>
<table width="803" border="0" style="font-size:12px; font-family:Verdana">
  <tr>
    <td width="170" valign="top"><table width="100%" border="0">
      <tr>
        <td align="right"><img src="/imagenes/logoNicaragua.png" alt="" width="162" height="141" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">NACIMIENTO</td>
      </tr>
      <tr>
        <td align="center">(ORIGINAL)</td>
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
            <td width="48%" style="border-bottom:#999999 1px solid;" align="center">{$Municipio|upper}</td>
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
        <td width="25%" height="25" style="border:#999999 1px solid;" align="center">{$inscripcionbd->request.inscrito1nombre1|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="25%" height="25" style="border:#999999 1px solid;" align="center">{$inscripcionbd->request.inscrito1nombre2|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="24%" height="25" style="border:#999999 1px solid;" align="center">{$inscripcionbd->request.inscrito1apellido1|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;" align="center">{$inscripcionbd->request.inscrito1apellido2|upper}</td>
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
        <td width="41%" style="border-bottom:#999999 1px solid;">{$Ciudad|upper}</td>
        <td width="14%">, MUNICIPIO DE</td>
        <td width="42%" style="border-bottom:#999999 1px solid;">{$Municipio|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="17%" align="right">DEPARTAMENTO DE</td>
        <td width="25%" style="border-bottom:#999999 1px solid;" align="center">{$Departamento|upper}</td>
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
        <td width="21%" style="border-bottom:#999999 1px solid;" align="center">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%d"|upper}</td>
        <td width="11%">DEL MES DE</td>
        <td width="23%" style="border-bottom:#999999 1px solid;" align="center">{$actabd->request.fecha|date_format:"%B"|upper}</td>
        <td width="10%">DEL AÑO</td>
        <td width="28%" style="width:150px;border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"}</td>
        <td width="1%" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">ANTE EL SUSCRITO REGISTRADOR DEL ESTADO CIVIL DE LAS PERSONAS Y EL SECRETARIO QUE AUTORIZA COMPARECE (N):</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1nombre|upper}</td>
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
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1oficio|upper}</td>
        <td width="3%">&nbsp;</td>
        <td width="28%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1domicilio|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="24%" style="border:#999999 1px solid;" height="25">{$nacimiento->request.compareciente1nacionalidad|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1cedula}</td>
      </tr>
      <tr>
        <td align="center">PROFESI&Oacute;N U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">NACIONALIDAD</td>
        <td>&nbsp;</td>
        <td align="center">C&Eacute;DULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$nacimiento->request.compareciente2nombre|upper}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$nacimiento->request.compareciente2edad} A&Ntilde;OS</td>
        </tr>
      <tr>
        <td align="center">NOMBRES Y APELLIDOS</td>
        <td>{$compareciente2.ncompareciente2}</td>
        <td width="28%" align="center">EDAD (EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$nacimiento->request.compareciente2oficio|upper}</td>
        <td width="3%">&nbsp;</td>
        <td width="28%" style="border:#999999 1px solid;" height="25">{$nacimiento->request.compareciente2domicilio|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="24%" style="border:#999999 1px solid;" height="25">{$nacimiento->request.compareciente2nacionalidad|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$nacimiento->request.compareciente2cedula}</td>
      </tr>
      <tr>
        <td align="center">PROFESI&Oacute;N U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">NACIONALIDAD</td>
        <td>&nbsp;</td>
        <td align="center">C&Eacute;DULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="18%">AVISA (N) QUE A LAS</td>
        <td width="45%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$hechovital->request.fechanacimiento|date_format:"%I"} CON {convertir_a_letras numero=$hechovital->request.fechanacimiento|date_format:"%M"} MINUTOS</td>
        <td width="6%">DE LA</td>
        <td width="31%" style="border-bottom:#999999 1px solid;">{if $hechovital->request.fechanacimiento|date_format:"%H">=12}TARDE{else}MA&Ntilde;ANA{/if}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="8%">DEL DIA</td>
        <td width="20%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$hechovital->request.fechanacimiento|date_format:"%d"}</td>
        <td width="10%">DE MES DE</td>
        <td width="17%" style="border-bottom:#999999 1px solid;">{$hechovital->request.fechanacimiento|date_format:"%B"|upper}</td>
        <td width="10%">DEL AÑO</td>
        <td width="28%" style="width:150px;border-bottom:#999999 1px solid;">{convertir_a_letras numero=$hechovital->request.fechanacimiento|date_format:"%Y"}</td>
        <td width="8%">EN LA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="25%"  height="25" style="border:#999999 1px solid;">{$hechovital->request.ciudadnacimiento|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="28%" height="25" style="border:#999999 1px solid;">{$hechovital->request.municipionacimiento|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="24%" height="25" style="border:#999999 1px solid;">{$hechovital->request.departamentonacimiento|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="17%" height="25" style="border:#999999 1px solid;">{$hechovital->request.paisnacimiento|upper}</td>
      </tr>
      <tr>
        <td align="center">COMARCA O CIUDAD</td>
        <td>&nbsp;</td>
        <td align="center">MUNICIPIO</td>
        <td>&nbsp;</td>
        <td align="center">DEPARTAMENTO</td>
        <td>&nbsp;</td>
        <td align="center">PA&Iacute;S</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="6%">NACIO</td>
        <td width="67%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1nombre1|upper} {$inscripcionbd->request.inscrito1nombre2|upper} {$inscripcionbd->request.inscrito1apellido1|upper} {$inscripcionbd->request.inscrito1apellido2|upper}</td>
        <td width="7%" align="right">SEXO</td>
        <td width="5%" align="center">M</td>
        <td width="5%" height="25" style="border:#999999 1px solid;">{if $hechovital->request.sexoinscrito=="m"}X{/if}</td>
        <td width="5%" align="center">F</td>
        <td width="5%" height="25" style="border:#999999 1px solid;">{if $hechovital->request.sexoinscrito=="f"}X{/if}</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center">NOMBRES Y APELLIDOS</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$hechovital->request.padrenombre|upper} </td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$nacimiento->request.edadpadre} A&Ntilde;OS</td>
        </tr>
      <tr>
        <td align="center">NOMBRES Y APELLIDOS DEL PADRE</td>
        <td>&nbsp;</td>
        <td width="28%" align="center">EDAD (EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="25%"  height="25" style="border:#999999 1px solid;">{$nacimiento->request.oficiopadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="28%" height="25" style="border:#999999 1px solid;">{$nacimiento->request.domiciliopadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="24%" height="25" style="border:#999999 1px solid;">{$nacimiento->request.nacionalidadpadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="17%" height="25" style="border:#999999 1px solid;">{$nacimiento->request.cedulapadre|upper}</td>
      </tr>
      <tr>
        <td align="center">PROFESI&Oacute;N U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">NACIONALIDAD</td>
        <td>&nbsp;</td>
        <td align="center">C&Eacute;DULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$hechovital->request.nombremadre|upper}</td>
        <td width="3%">&nbsp;</td>
         <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$nacimiento->request.edadmadre|upper} A&Ntilde;OS</td>
        </tr>
      <tr>
        <td align="center">NOMBRES Y APELLIDOS DE LA MADRE</td>
        <td>&nbsp;</td>
        <td width="28%" align="center">EDAD (EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="25%"  height="25" style="border:#999999 1px solid;">{$nacimiento->request.oficiomadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="28%" height="25" style="border:#999999 1px solid;">{$nacimiento->request.domiciliomadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="24%" height="25" style="border:#999999 1px solid;">{$nacimiento->request.nacionalidadmadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="17%" height="25" style="border:#999999 1px solid;">{$nacimiento->request.cedulamadre|upper}</td>
      </tr>
      <tr>
        <td align="center">PROFESI&Oacute;N U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">NACIONALIDAD</td>
        <td>&nbsp;</td>
        <td align="center">C&Eacute;DULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="23%">NACIDO EN EL EXTRANJERO:</td>
        <td width="77%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.enextranjero|upper}</td>
      </tr>
      <tr>
        <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="23%">DATOS ADICIONALES:</td>
        <td width="77%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.datosadicionales|upper}</td>
      </tr>
    </table></td>
  </tr>    
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="15%">OBSERVACIONES:</td>
        <td width="85%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.observaciones|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>    
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">LEIDA QUE FUE LA PRESENTE ACTA SE ENCUENTRA CONFORME, SE APRUEBA, RATIFICAMOS Y FIRMAMOS.</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="39%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
        <td width="26%">&nbsp;</td>
        <td width="35%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">COMPARECIENTE</td>
        <td>&nbsp;</td>
        <td align="center">COMPARECIENTE</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td style="border-bottom:#999999 1px solid;">&nbsp;</td>
        <td>&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" >REGISTRADOR</td>
        <td>&nbsp;</td>
        <td align="center">SECRETARIO</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
