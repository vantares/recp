<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reposicion Defuncion</title>
</head>

<body>
<table width="815" border="0" cellspacing="0" cellpadding="0" style="font-family:Verdana; font-size:10px">
  <tr>
    <td width="173" align="right" valign="top"><img src="imagenes/logo.png" width="49" height="50" alt="" /></td>
    <td width="507" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><h1 style="font-size:18px; margin:0;padding:0">CONSEJO SUPREMO ELECTORAL</h1></td>
      </tr>
      <tr>
        <td align="center"><h2 style="font-size:15px; margin:0;padding:0">REGISTRO DEL ESTADO CIVIL DE LAS PERSONAS</h2></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="16%"><center>&nbsp;</center></td>
            <td width="28%" align="right">DE MUNICIPIO</td>
            <td width="28%" style="border-bottom:#999 1px solid"><center>{$Municipio}</center></td>
            <td width="28%"><center>&nbsp;</center></td>
          </tr>
          <tr>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td colspan="2"><center>&nbsp;</center></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="135" rowspan="2" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="47%" align="right">SERIE</td>
        <td width="53%"><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td align="right">TOMO</td>
        <td style="border-bottom:#999 1px solid"><center>{$actabd->getNoTomo()}</center></td>
      </tr>
      <tr>
        <td align="right">FOLIO</td>
        <td style="border-bottom:#999 1px solid"><center>{$actabd->request.folio}</center></td>
      </tr>
      <tr>
        <td align="right">PARTIDA</td>
        <td style="border-bottom:#999 1px solid"><center>{$actabd->request.partida}</center></td>
      </tr>
      <tr>
        <td align="right">FECHA</td>
        <td style="border-bottom:#999 1px solid"><center>{$actabd->request.fecha|date_format:"%d/%m/%Y"}</center></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>DEFUNCION (REPOSICI&Oacute;N)</td>
      </tr>
      <tr>
        <td align="center">(ORIGINAL)</td>
      </tr>
    </table></td>
    <td><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><center>&nbsp;</center></td>
    <td><center>&nbsp;</center></td>
    <td valign="bottom"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24%" style="border:#999 1px solid"  height="25"><center>{$inscripcionbd->request.inscrito1nombre1|upper}</center></td>
            <td width="2%"><center>&nbsp;</center></td>
            <td width="24%" style="border:#999 1px solid"  height="25"><center>{$inscripcionbd->request.inscrito1nombre2|upper}</center></td>
            <td width="2%"><center>&nbsp;</center></td>
            <td width="24%" style="border:#999 1px solid"  height="25"><center>{$inscripcionbd->request.inscrito1apellido1|upper}</center></td>
            <td width="2%"><center>&nbsp;</center></td>
            <td width="22%" style="border:#999 1px solid"  height="25"><center>{$inscripcionbd->request.inscrito1apellido2|upper}</center></td>
          </tr>
          <tr>
            <td align="center">PRIMER NOMBRE</td>
            <td><center>&nbsp;</center></td>
            <td align="center">SEGUNDO NOMBRE</td>
            <td><center>&nbsp;</center></td>
            <td align="center">PRIMER APELLIDO</td>
            <td><center>&nbsp;</center></td>
            <td align="center">SEGUNDO APELLIDO</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
          </tr>
          <tr>
            <td width="2%">EN</td>
            <td width="28%" style="border-bottom:#999 1px solid"><center>{$Ciudad|upper}</center></td>
            <td width="12%">, MUNICIPIO DE</td>
            <td width="24%" style="border-bottom:#999 1px solid"><center>{$Municipio|upper}</center></td>
            <td width="14%">, DEPARTAMENTO DE</td>
            <td width="20%" style="border-bottom:#999 1px solid"><center>{$Departamento|upper}</center></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
          </tr>
          <tr>
            <td width="5%">A LAS</td>
            <td width="22%" style="border-bottom:#999 1px solid"><center>{convertir_a_letras numero=$actabd->request.fecha|date_format:"%I"}</center></td>
            <td width="5%">DE LA</td>
            <td width="19%" style="border-bottom:#999 1px solid"><center>{if $actabd->request.fecha|date_format:"%I">=12}TARDE{else}MA&Ntilde;ANA{/if}</center></td>
            <td width="6%" >DEL DIA</td>
            <td width="17%" style="border-bottom:#999 1px solid"><center>{convertir_a_letras numero=$actabd->request.fecha|date_format:"%l"|upper}</center></td>
            <td width="10%">DEL MES DE</td>
            <td width="16%" style="border-bottom:#999 1px solid"><center>{$actabd->request.fecha|date_format:"%B"|upper}</center></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%">DE </td>
            <td width="33%" style="border-bottom:#999 1px solid"><center>{convertir_a_letras numero=$actabd->request.fecha|date_format:"%Y"|upper}</center></td>
            <td width="67%"> ANTE EL SUSCRITO REGISTRADOR DEL ESTADO CIVIL DE LAS PERSONAS Y EL SECRETARIO QUE</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>AUTORIZA COMPARECE:</td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="63%" style="border:#999 1px solid"  height="25"><center>{$inscripcionbd->request.compareciente1nombre|upper}</center></td>
            <td width="4%"><center>&nbsp;</center></td>
            <td width="33%" style="border:#999 1px solid"  height="25"><center>{convertir_a_letras numero=$inscripcionbd->request.compareciente1edad} A&Ntilde;OS</center></td>
          </tr>
          <tr>
            <td align="center">NOMBRE Y APELLIDOS</td>
            <td><center>&nbsp;</center></td>
            <td align="center">EDAD (EN LETRAS)</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="45%" style="border:#999 1px solid"  height="25"><center>{convertir_a_letras numero=$inscripcionbd->request.compareciente1ocupacion|upper}</center></td>
            <td width="2%"><center>&nbsp;</center></td>
            <td width="28%" style="border:#999 1px solid"  height="25"><center>{$inscripcionbd->request.compareciente1domicilio|upper}</center></td>
            <td width="2%"><center>&nbsp;</center></td>
            <td width="23%" style="border:#999 1px solid"  height="25"><center>{$inscripcionbd->request.compareciente1cedula}</center></td>
          </tr>
          <tr>
            <td align="center">PROFESI&Oacute;N U OFICIO</td>
            <td><center>&nbsp;</center></td>
            <td align="center">DOMICILIO</td>
            <td><center>&nbsp;</center></td>
            <td align="center">C&Eacute;DULA</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td>Y PRESENTA PARA SU INSCRIPCI&Oacute;N LA SENTENCIA DICTADA POR:</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="45%" style="border:#999 1px solid"  height="25"><center>{$repohechovital->request.jueznotario|upper}</center></td>
            <td width="2%"><center>&nbsp;</center></td>
            <td width="28%" style="border:#999 1px solid"  height="25"><center>{$repohechovital->request.nombrejuzgado|upper}</center></td>
            <td width="2%"><center>&nbsp;</center></td>
            <td width="23%" style="border:#999 1px solid"  height="25"><center>{$repohechovital->request.lugarjuzgado|upper}</center></td>
          </tr>
          <tr>
            <td align="center">NOMBRE Y APELLIDOS DEL JUEZ</td>
            <td><center>&nbsp;</center></td>
            <td align="center">NOMBRE DEL JUZGADO</td>
            <td><center>&nbsp;</center></td>
            <td align="center">DE</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
          </tr>
          <tr>
            <td width="5%">A LAS</td>
            <td width="22%" style="border-bottom:#999 1px solid"><center>{convertir_a_letras numero=$repohechovital->request.fechadictament|date_format:"%I"}</center></td>
            <td width="5%">DE LA</td>
            <td width="19%" style="border-bottom:#999 1px solid"><center>{if $repohechovital->request.fechadictament|date_format:"%I"|upper>=12}TARDE{else}MA&Ntilde;ANA{/if}</center></td>
            <td width="6%" >DEL DIA</td>
            <td width="17%" style="border-bottom:#999 1px solid"><center>{convertir_a_letras numero=$repohechovital->request.fechadictament|date_format:"%l"}</center></td>
            <td width="10%">DEL MES DE</td>
            <td width="16%" style="border-bottom:#999 1px solid"><center>{$repohechovital->request.fechadictament|date_format:"%B"|upper}</center></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="7%">DEL A&Ntilde;O </td>
            <td width="34%" style="border-bottom:#999 1px solid"><center>{convertir_a_letras numero=$repohechovital->request.fechadictament|date_format:"%Y"}</center></td>
            <td width="65%">EN LA QUE ORDENA INSCRIBIR LA PARTIDA DE DEFUNCION DE:</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="61%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border:#999 1px solid" height="25"><center>{$inscripcionbd->request.nombre1|upper} {$inscripcionbd->request.nombre2|upper} {$inscripcionbd->request.apellido1|upper} {$inscripcionbd->request.apellido2|upper}</center></td>
              </tr>
              <tr>
                <td align="center">NOMBRE Y APELLIDOS</td>
              </tr>
            </table></td>
            <td width="6%" align="right">SEXO</td>
            <td width="7%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="41%" align="right">M</td>
                <td width="59%" style="border:#999 1px solid" height="25"><center>{if $repohechovital->request.sexoinscrito=="m"}X{/if}</center></td>
              </tr>
              <tr>
                <td><center>&nbsp;</center></td>
                <td><center>&nbsp;</center></td>
              </tr>
              <tr>
                <td align="right">F</td>
                <td style="border:#999 1px solid" height="25"><center>{if $repohechovital->request.sexoinscrito=="f"}X{/if}</center></td>
              </tr>
            </table></td>
            <td width="8%"><center>&nbsp;</center></td>
            <td width="18%">HABIENDO NACIDO EN LA </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%" style="border:#999 1px solid" height="25"><center>{$repohechovital->request.ciudadnacimiento|upper}</center></td>
            <td width="4%"><center>&nbsp;</center></td>
            <td width="24%" style="border:#999 1px solid" height="25"><center>{$repohechovital->request.municipionacimiento|upper}</center></td>
            <td width="3%"><center>&nbsp;</center></td>
            <td width="23%" style="border:#999 1px solid" height="25"><center>{$repohechovital->request.departamentonacimiento|upper}</center></td>
            <td width="3%"><center>&nbsp;</center></td>
            <td width="18%" style="border:#999 1px solid" height="25"><center>{$repohechovital->request.paisnacimiento|upper}</center></td>
          </tr>
          <tr>
            <td align="center" >COMARCA O CIUDAD</td>
            <td><center>&nbsp;</center></td>
            <td align="center" >MUNICIPIO</td>
            <td><center>&nbsp;</center></td>
            <td align="center" >DEPARTAMENTO</td>
            <td><center>&nbsp;</center></td>
            <td align="center">PAIS</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="2%">EL</td>
            <td height="25" colspan="3" style="border:#999 1px solid"><center>{convertir_a_letras numero=$repohechovital->request.fechanacimiento|date_format:"%e"} DE {$repohechovital->request.fechanacimiento|date_format:"%B"|upper} DE {convertir_a_letras numero=$repohechovital->request.fechanacimiento|date_format:"%Y"}</center></td>
            <td height="25"><center>&nbsp;</center></td>
          </tr>
          <tr>
            <td><center>&nbsp;</center></td>
            <td width="16%" align="center" >DIA</td>
            <td width="26%" align="center" >MES</td>
            <td width="29%" align="center" >AÑO (EN LETRAS)</td>
            <td width="27%" ><center>&nbsp;</center></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="11%">Y FALLECIO EL</td>
            <td height="25" colspan="3" style="border:#999 1px solid"><center>{convertir_a_letras numero=$repodefuncion->request.fechadefuncion|date_format:"%e"|upper} DE {$repodefuncion->request.fechadefuncion|date_format:"%B"|upper} DE {convertir_a_letras numero=$repodefuncion->request.fechadefuncion|date_format:"%Y"|upper}</center></td>
            <td height="25"><center>&nbsp;</center></td>
          </tr>
          <tr>
            <td><center>&nbsp;</center></td>
            <td width="18%" align="center" >DIA</td>
            <td width="28%" align="center" >MES</td>
            <td width="34%" align="center" >AÑO (EN LETRAS)</td>
            <td width="9%" ><center>&nbsp;</center></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%" style="border:#999 1px solid" height="25"><center>{$repodefuncion->request.causamuerte|upper}</center></td>
            <td width="4%"><center>&nbsp;</center></td>
            <td width="24%" style="border:#999 1px solid" height="25"><center>{$repodefuncion->request.ciudaddefuncion|upper}</center></td>
            <td width="3%"><center>&nbsp;</center></td>
            <td width="23%" style="border:#999 1px solid" height="25"><center>{$repodefuncion->request.municipiodefuncion|upper}</center></td>
            <td width="3%"><center>&nbsp;</center></td>
            <td width="18%" style="border:#999 1px solid" height="25"><center>{$repodefuncion->request.departamentodefuncion|upper}</center></td>
          </tr>
          <tr>
            <td align="center" >CAUSA DE LA MUERTE</td>
            <td><center>&nbsp;</center></td>
            <td align="center" >COMARCA O CIUDAD</td>
            <td><center>&nbsp;</center></td>
            <td align="center" >MUNICIPIO</td>
            <td><center>&nbsp;</center></td>
            <td align="center">DEPARTAMENTO</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="4%" height="12" valign="bottom">PAIS</td>
            <td width="14%" valign="bottom" style="border-bottom:#999 1px solid"><center>{$repodefuncion->request.paisdefuncion|upper}</center></td>
            <td width="5%"><center>&nbsp;</center></td>
            <td width="77%" style="border:#999 1px solid" height="25"><center>{$repodefuncion->request.conyugenombre|upper}</center></td>
          </tr>
          <tr>
            <td height="12" valign="bottom"><center>&nbsp;</center></td>
            <td valign="bottom"><center>&nbsp;</center></td>
            <td><center>&nbsp;</center></td>
            <td align="center">NOMBRE Y APELLIDOS DEL CONYUGE</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td>FUERON SUS PADRES:</td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="49%" style="border:#999 1px solid"  height="25"><center>{$repohechovital->request.padrenombre|upper}</center></td>
            <td width="3%"><center>&nbsp;</center></td>
            <td width="48%" style="border:#999 1px solid"  height="25"><center>{$repohechovital->request.nombremadre|upper}</center></td>
          </tr>
          <tr>
            <td align="center">NOMBRE Y APELLIDOS DEL PADRE</td>
            <td><center>&nbsp;</center></td>
            <td align="center">NOMBRE Y APELLIDOS DE LA MADRE</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="21%">FALLECIDO EN EL EXTRANJERO:</td>
            <td width="79%" style="border-bottom:#999 1px solid"><center>{$inscripcionbd->request.enextrangero|upper}</center></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="15%">DATOS ADICIONALES:</td>
            <td width="85%" style="border-bottom:#999 1px solid"><center>{$inscripcionbd->request.datosadicionales|upper}</center></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="12%">OBSERVACIONES:</td>
            <td width="88%" style="border-bottom:#999 1px solid"><center>{$inscripcionbd->request.observaciones|upper}</center></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
      </tr>  
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
      </tr>  
      <tr>
        <td><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
      </tr>                             
    </table></td>
  </tr>
</table>




<table width="815" border="0" cellspacing="0" cellpadding="0" style="font-family:Verdana; font-size:12px">
  <tr>
    <td height="50"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td height="50"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td>YO, EL REGISTRADOR DOY FE, DE HABER TENIDO A LA VISTA LA SENTENCIA DE REPOSICI&Oacute;N DE PARTIDA DE DEFUNCION. LEIDA QUE FUE LA PRESENTE ACTA SE ENCUENTRA CONFORME, SE APRUEBA RATIFICA Y FIRMAN:</td>
  </tr>
  <tr>
    <td height="50"><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="32%"><center>&nbsp;</center></td>
        <td width="37%" style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
        <td width="31%"><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td><center>&nbsp;</center></td>
        <td align="center">COMPARECIENTE</td>
        <td><center>&nbsp;</center></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><center>&nbsp;</center></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="31%" style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
        <td width="40%"><center>&nbsp;</center></td>
        <td width="29%" style="border-bottom:#999 1px solid"><center>&nbsp;</center></td>
      </tr>
      <tr>
        <td align="center">REGISTRADOR</td>
        <td><center>&nbsp;</center></td>
        <td align="center">SECRETARIO</td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
