<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reposicion Nacimiento</title>
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
        <td align="center">NACIMIENTO (REPOSICI&Oacute;N)</td>
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
        <td width="51%" align="right">TOMO&nbsp;</td>
        <td width="49%" style="border-bottom:#999999 1px solid;">{$actabd->getNoTomo()}</td>
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
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="3%">EN</td>
        <td width="42%" style="border-bottom:#999999 1px solid;">{$Ciudad|upper}</td>
        <td width="13%">, MUNICIPIO DE</td>
        <td width="42%" style="border-bottom:#999999 1px solid;">{$Municipio|upper}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="17%" align="right">DEPARTAMENTO DE</td>
        <td width="24%" style="border-bottom:#999999 1px solid;">{$Departamento|upper}</td>
        <td width="6%" align="right" > A LAS</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%I"}</td>
        <td width="6%" align="right">DE LA</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{if $actabd->request.fecha|date_format:"%H">=12}TARDE{else}MA&Ntilde;ANA{/if}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="7%">DEL DIA</td>
        <td width="22%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%l"}</td>
        <td width="11%">DEL MES DE</td>
        <td width="22%" style="border-bottom:#999999 1px solid;">{$actabd->request.fecha|date_format:"%B"|upper}</td>
        <td width="10%">DEL AÑO</td>
        <td width="28%" style="width:150px;border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">ANTE EL SUSCRITO REGISTRADOR  Y  SECRETARIO QUE AUTORIZA COMPARECE (N):</td>
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
        <td width="44%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1domicilio|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="28%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.compareciente1cedula|upper}</td>
        </tr>
      <tr>
        <td align="center">PROFESI&Oacute;N U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">C&Eacute;DULA</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">Y PRESENTA PARA SU INSCRIPCI&Oacute;N LA SENTENCIA DICTADA POR:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="52%" style="border:#999999 1px solid;" height="25">{$repohechovital->request.jueznotario|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="25%" style="border:#999999 1px solid;" height="25">{$repohechovital->request.nombrejuzgado|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="19%" height="25" style="border:#999999 1px solid;">{$repohechovital->request.lugarjuzgado|upper}</td>
        </tr>
      <tr>
        <td align="center">NOMBRES Y APELLIDOS DEL JUEZ</td>
        <td>&nbsp;</td>
        <td align="center">JUZGADO</td>
        <td>&nbsp;</td>
        <td align="center">DE</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="6%">A LAS</td>
        <td width="45%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$repohechovital->request.fechadictament|date_format:"%I"}</td>
        <td width="6%">DE LA</td>
        <td width="43%" style="border-bottom:#999999 1px solid;">{if $repohechovital->request.fechadictament|date_format:"%H">=12}TARDE{else}MA&Ntilde;ANA{/if}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="7%">DEL DIA</td>
        <td width="27%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$repohechovital->request.fechadictament|date_format:"%l"}</td>
        <td width="11%">DEL MES DE</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{$repohechovital->request.fechadictament|date_format:"%B"|upper}</td>
        <td width="10%">DEL AÑO</td>
        <td width="28%" style="width:150px;border-bottom:#999999 1px solid;">{convertir_a_letras numero=$repohechovital->request.fechadictament|date_format:"%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">EN LA QUE ORDENA INSCRIBIR LA PARTIDA DE NACIMIENTO DE:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="75%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.inscrito1nombre1|upper} {$inscripcionbd->request.inscrito1nombre2|upper} {$inscripcionbd->request.inscrito1apellido1|upper} {$inscripcionbd->request.inscrito1apellido2|upper}</td>
        <td width="6%" align="center">SEXO</td>
        <td width="4%" align="center">M</td>
        <td width="5%" style="border:#999999 1px solid;" height="25">{if $repohechovital->request.sexoinscrito=="m"}X{/if}</td>
        <td width="5%" align="center">F</td>
        <td width="5%" style="border:#999999 1px solid;" height="25">{if $repohechovital->request.sexoinscrito=="y"}X{/if}</td>
      </tr>
      <tr>
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
        <td width="14%">QUIEN NACIO EN</td>
        <td width="39%" style="border-bottom:#999999 1px solid;">{$repohechovital->request.ciudadnacimiento|upper}</td>
        <td width="13%">, MUNICIPIO DE</td>
        <td width="35%" style="border-bottom:#999999 1px solid;">{$repohechovital->request.municipionacimiento|upper}</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="17%">DEPARTAMENTO DE</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{$repohechovital->request.departamentonacimiento|upper}</td>
        <td width="5%">PAIS</td>
        <td width="19%" style="border-bottom:#999999 1px solid;">{$repohechovital->request.paisnacimiento|upper}</td>
        <td width="6%">A LAS</td>
        <td width="27%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$repohechovital->request.fechanacimiento|date_format:"%I"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="6%">DE LA</td>
        <td width="13%" style="border-bottom:#999999 1px solid;">{if $repohechovital->request.fechanacimiento|date_format:"%H">=12}TARDE{else}MA&Ntilde;ANA{/if}</td>
        <td width="8%">DEL DIA</td>
        <td width="14%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$repohechovital->request.fechanacimiento|date_format:"%l"}</td>
        <td width="11%">DEL MES DE</td>
        <td width="13%" style="border-bottom:#999999 1px solid;">{$repohechovital->request.fechanacimiento|date_format:"%B"|upper}</td>
        <td width="10%">DEL AÑO</td>
        <td width="28%" style="width:150px;border-bottom:#999999 1px solid;">{convertir_a_letras numero=$repohechovital->request.fechanacimiento|date_format:"%Y"}</td>
        <td width="9%"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$repohechovital->request.padrenombre|upper} </td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$reponacimiento->request.edadpadre} A&Ntilde;OS</td>
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
        <td width="23%" style="border:#999999 1px solid;" height="25">{$reponacimiento->request.oficiopadre|upper}</td>
        <td width="3%">&nbsp;</td>
        <td width="31%" style="border:#999999 1px solid;" height="25">{$reponacimiento->request.domiciliopadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="21%" style="border:#999999 1px solid;" height="25">{$reponacimiento->request.nacionalidadpadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$reponacimiento->request.cedulapadre|upper}</td>
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
        <td width="64%" style="border:#999999 1px solid;" height="25">{$repohechovital->request.nombremadre|upper}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$reponacimiento->request.edadmadre} A&Ntilde;OS</td>
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
        <td width="23%" style="border:#999999 1px solid;" height="25">{$reponacimiento->request.oficiomadre|upper}</td>
        <td width="3%">&nbsp;</td>
        <td width="31%" style="border:#999999 1px solid;" height="25">{$reponacimiento->request.domiciliomadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="21%" style="border:#999999 1px solid;" height="25">{$reponacimiento->request.nacionalidadmadre|upper}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$reponacimiento->request.cedulamadre}</td>
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
        <td width="23%">NACIDO EN EL EXTRANJERO</td>
        <td width="77%" style="border-bottom:#999999 1px solid;">{$inscripcionbd->request.enextranjero|upper}</td>
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
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">YO EL REGISTRADO DOY FE, DE HABER TENIDO A LA VISTA LA SENTENCIA DE REPOSICI&Oacute;N DE PARTIDA DE NACIMIENTO, LEIDA QUE FUE LA PRESENTE ACTA SE ENCUENTRA CONFORME, SE APRUEBA, RATIFICA Y FIRMAN:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="28%">&nbsp;</td>
        <td width="45%" style="border-bottom:#999999 1px solid;">&nbsp;</td>
        <td width="27%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center">COMPARECIENTE</td>
        <td>&nbsp;</td>
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
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
