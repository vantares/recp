<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscripcion de Matrimonio</title>
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
      <tr>
        <td align="center">MATRIMONIO</td>
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
            <td width="48%" style="border-bottom:#999999 1px solid;">{$Municipio}</td>
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
        <td width="51%" align="right">Serie&nbsp;</td>
        <td width="49%">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">Tomo&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$actabd->getNoTomo()}</td>
      </tr>
      <tr>
        <td align="right">Folio&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$actabd->request.folio}</td>
      </tr>
      <tr>
        <td align="right">Partida&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$actabd->request.partida}</td>
      </tr>
      <tr>
        <td align="right">Fecha&nbsp;</td>
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
    <td colspan="3" valign="top">CONYUGUE VARON</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1nombre1}</td>
        <td width="7%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1nombre2}</td>
        <td width="7%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1apellido1}</td>
        <td width="6%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$inscripcionbd->request.inscrito1apellido2}</td>
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
    <td colspan="3" valign="top">CONYUGUE MUJER</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$matrimonio->request.inscrito2nombre1}</td>
        <td width="7%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$matrimonio->request.inscrito2nombre2}</td>
        <td width="7%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$matrimonio->request.inscrito2apellido1}</td>
        <td width="6%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$matrimonio->request.inscrito2apellido2}</td>
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
        <td width="42%" style="border-bottom:#999999 1px solid;">{$Ciudad}</td>
        <td width="13%">.MUNICIPIO DE</td>
        <td width="42%" style="border-bottom:#999999 1px solid;">{$Municipio}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="17%" align="right">DEPARTAMENTO DE</td>
        <td width="24%" style="border-bottom:#999999 1px solid;">{$Departamento}</td>
        <td width="6%" align="right" > A LAS</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%I"}</td>
        <td width="6%" align="right">DEL LA</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{if $actabd->request.fecha|date_format:"%I">=12}Tarde{else}Ma&ntilde;ana{/if}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="7%" align="right">DEL DIA</td>
        <td width="24%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actabd->request.fecha|date_format:"%l"}</td>
        <td width="16%" align="right" >DEL MES DE</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{$actabd->request.fecha|date_format:"%B"}</td>
        <td width="36%" align="left">DEL AÑO {convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"}</td>
        <td width="12%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>  
  <tr>
    <td colspan="3" valign="top">ANTE EL SUSCRITO REGISTRADOR DEL ESTADO CIVIL DE LAS PERSONAS Y EL SECRETARIO QUE AUTORIZA COMPARECE(N):</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1nombre} </td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$inscripcionbd->request.compareciente1edad}</td>
        </tr>
      <tr>
        <td align="center">NOMBRE Y APELLIDOS</td>
        <td>&nbsp;</td>
        <td width="28%" align="center">EDAD(EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1oficio}</td>
        <td width="3%">&nbsp;</td>
        <td width="31%" style="border:#999999 1px solid;" height="25">&nbsp;</td>
        <td width="2%">&nbsp;</td>
        <td width="21%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1domicilio}</td>
        <td width="2%">&nbsp;</td>

        <td width="18%" style="border:#999999 1px solid;" height="25">{$inscripcionbd->request.compareciente1cedula}</td>
      </tr>
      <tr>
        <td align="center">PROFESION U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">ESTADO CIVIL</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">CEDULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">Y PRESENTA PARA SU INSCRIPCION EL OFICIO DICTADO O AUTORIZADO POR:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="60%" style="border:#999999 1px solid;" height="25">{$actojuridico->request.jueznotario}</td>
        <td width="40%">QUE EN SUS PARTES CONDUCENTES DICE QUE</td>
      </tr>
      <tr>
        <td align="center">NOMBRE Y APELLIDOS DEL JUEZ O NOTARIO</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="6%">A LAS</td>
        <td width="31%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actojuridico->request.fechadictament|date_format:"%I"}</td>
        <td width="6%">DE LA</td>
        <td width="29%" style="border-bottom:#999999 1px solid;">{if $actojuridico->request.fechadictament|date_format:"%I">=12}Tarde{else}Ma&ntilde;ana{/if}</td>
        <td width="7%">DEL DIA</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{convertir_a_letras numero=$actojuridico->request.fechadictament|date_format:"%l"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="11%">DEL MES DE</td>
        <td width="25%" style="border-bottom:#999999 1px solid;">{$actojuridico->request.fechadictament|date_format:"%B"}</td>
        <td width="25%">DEL AÑO {convertir_a_letras numero=$actojuridico->request.fechadictament|date_format:"%Y"}</td>
        <td width="14%">&nbsp;</td>
        <td width="25%">SE UNIERON EN MATRIMONIO</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge1nombre}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$matrimonio->request.conyuge1edad}</td>
        </tr>
      <tr>
        <td align="center">NOMBRE Y APELLIDOS DEL CONYUGE</td>
        <td>&nbsp;</td>
        <td width="28%" align="center">EDAD(EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="36%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge1oficio}</td>
        <td width="2%">&nbsp;</td>
        <td width="28%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge1estadocivilanterior}</td>
        <td width="2%">&nbsp;</td>
        <td width="32%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge1nacionalidad}</td>
      </tr>
      <tr>
        <td align="center">PROFESION U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">ESTADO CIVIL ANTERIOR</td>
        <td>&nbsp;</td>
        <td align="center">NACIONALIDAD</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="71%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge1domicilio}</td>
        <td width="2%">&nbsp;</td>
        <td width="27%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge1cedula}</td>
      </tr>
      <tr>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">CEDULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge2nombre}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$matrimonio->request.conyuge2edad}</td>
        </tr>
      <tr>
        <td align="center">NOMBRE Y APELLIDOS DE LA CONYUGE</td>
        <td>&nbsp;</td>
        <td width="28%" align="center">EDAD(EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="36%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge2oficio}</td>
        <td width="2%">&nbsp;</td>
        <td width="28%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge2estadocivilanterior}</td>
        <td width="2%">&nbsp;</td>
        <td width="32%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge2nacionalidad}</td>
      </tr>
      <tr>
        <td align="center">PROFESION U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">ESTADO CIVIL ANTERIOR</td>
        <td>&nbsp;</td>
        <td align="center">NACIONALIDAD</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="71%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge2domicilio}</td>
        <td width="2%">&nbsp;</td>
        <td width="27%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.conyuge2cedula}</td>
      </tr>
      <tr>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">CEDULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">PRESENCIARON EL ACTO COMO TESTIGO LOS SEÑORES</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo1nombre}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$matrimonio->request.testigo1edad}</td>
        </tr>
      <tr>
        <td align="center">NOMBRE Y APELLIDOS</td>
        <td>&nbsp;</td>
        <td width="28%" align="center">EDAD(EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo1oficio}</td>
        <td width="3%">&nbsp;</td>
        <td width="21%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo1estadocivil}</td>
        <td width="2%">&nbsp;</td>
        <td width="31%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo1domicilio}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo1cedula}</td>
      </tr>
      <tr>
        <td align="center">PROFESION U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">ESTADO CIVIL</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">CEDULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo2nombre}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{convertir_a_letras numero=$matrimonio->request.testigo2edad}</td>
        </tr>
      <tr>
        <td align="center">NOMBRE Y APELLIDOS</td>
        <td>&nbsp;</td>
        <td width="28%" align="center">EDAD(EN LETRAS)</td>
        <td width="5%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo2oficio}</td>
        <td width="3%">&nbsp;</td>
        <td width="21%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo2estadocivil}</td>
        <td width="2%">&nbsp;</td>
        <td width="31%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo2domicilio}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$matrimonio->request.testigo2cedula}</td>
      </tr>
      <tr>
        <td align="center">PROFESION U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">ESTADO CIVIL</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">CEDULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
</table>

<table width="805" border="0" style="font-family:Verdana; font-size:12px">
  <tr>
    <td>EN DICHO MATRIMONIO SE RECONOCIERON LOS SIGUIENTES HIJOS:</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="158" align="right">NOMBRES</td>
        <td width="254" align="right">FECHA DE NACIMIENTO</td>
        <td width="158">&nbsp;</td>
        <td width="211">LUGAR DE NACIMIENTO</td>
      </tr>
    </table></td>
  </tr>
{section name=i loop=$reconocidos}
  <tr>
    <td style="border-bottom:#999 1px solid">{$reconocidos[i]->request.nombrereconocido} {$reconocidos[i]->request.fechanacimiento|date_format:"%D"} {$reconocidos[i]->request.lugarnacimiento}</td>
  </tr>
{/section}
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="208">MATRIMONIO EN EL EXTRANJERO</td>
        <td width="587" style="border-bottom:#999 1px solid">{$inscripcionbd->request.enextrangero}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="133">DATOS ADICIONALES</td>
        <td width="662" style="border-bottom:#999 1px solid">{$inscripcionbd->request.datosadicionales}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="107">OBSERVACIONES</td>
        <td width="688" style="border-bottom:#999 1px solid">{$inscripcionbd->request.observaciones}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="236">MODIFICACIONES DEL ESTADO CIVIL</td>
        <td width="559" style="border-bottom:#999 1px solid">{$modificacion}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="604">LEIDA QUE FUE LA PRESENTE ACTA SE ENCUENTRA CONFORME, SE APRUEBA RATIFICA Y FIRMAN</td>
        <td width="191" style="border-bottom:#999 1px solid">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="239" style="border-bottom:#999 1px solid">{$inscripcionbd->request.nombreregistrador}</td>
        <td width="313">&nbsp;</td>
        <td width="239" style="border-bottom:#999 1px solid">{$inscripcionbd->request.nombresecretario}</td>
      </tr>
      <tr>
        <td align="center">REGISTRADOR</td>
        <td>&nbsp;</td>
        <td align="center">SECRETARIO</td>
      </tr>
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
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>NACIMIENTO</td>
  </tr>
  <tr>
    <td>CONYUGE VARON</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="90" height="16">INSCRITO EN</td>
        <td width="226" style="border-bottom:#999 1px solid">{$matrimonio->request.conyuge1lugarinscripcion}</td>
        <td width="37">TOMO</td>
        <td width="71" style="border-bottom:#999 1px solid">{$matrimonio->request.conyuge1tomoinscripcion}</td>
        <td width="40">FOLIO</td>
        <td width="73" style="border-bottom:#999 1px solid">{$matrimonio->request.conyuge1folioinscripcion}</td>
        <td width="54">PARTIDA</td>
        <td width="70" align="right" style="border-bottom:#999 1px solid"></td>
        <td width="32" align="right">A&Ntilde;O</td>
        <td width="70" style="border-bottom:#999 1px solid">{$matrimonio->request.conyuge1anyoinscripcion}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>CONYUGE MUJER</td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="90" height="16">INSCRITO EN</td>
        <td width="226" style="border-bottom:#999 1px solid">{$matrimonio->request.conyuge2lugarinscripcion}</td>
        <td width="37">TOMO</td>
        <td width="71" style="border-bottom:#999 1px solid">{$matrimonio->request.conyuge2tomoinscripcion}</td>
        <td width="40">FOLIO</td>
        <td width="73" style="border-bottom:#999 1px solid">{$matrimonio->request.conyuge2folioinscripcion}</td>
        <td width="54">PARTIDA</td>
        <td width="70" align="right" style="border-bottom:#999 1px solid"></td>
        <td width="32" align="right">A&Ntilde;O</td>
        <td width="70" style="border-bottom:#999 1px solid">{$matrimonio->request.conyuge2anyoinscripcion}</td>
      </tr>
    </table></td>
  </tr>
</table>


</body>
</html>
