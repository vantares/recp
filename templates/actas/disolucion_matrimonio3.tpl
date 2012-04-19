<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="803" border="0" style="font-size:12px; font-family:Verdana">
  <tr>
    <td width="170" valign="top"><table width="100%" border="0">
      <tr>
        <td align="right"><img src="imagenes/cunno3.png" alt="" width="50" height="56" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">DISOLUCION VICULO MATRIMONIAL</td>
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
            <td width="48%" style="border-bottom:#999999 1px solid;">{$smarty.const.MUNICIPIO}</td>
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
        <td style="border-bottom:#999999 1px solid;">{$inscripcion.tomo}</td>
      </tr>
      <tr>
        <td align="right">Folio&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$inscripcion.folio}</td>
      </tr>
      <tr>
        <td align="right">Partida&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$inscripcion.partida}</td>
      </tr>
      <tr>
        <td align="right">Fecha&nbsp;</td>
        <td style="border-bottom:#999999 1px solid;">{$inscripcion.fechainscripcion|date_format:"%d/%m/%Y"}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">CONYUGE VARON</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="25%" height="25" style="border:#999999 1px solid;">{$esposo.nombre1}</td>
        <td width="2%">&nbsp;</td>
        <td width="25%" height="25" style="border:#999999 1px solid;">{$esposo.nombre2}</td>
        <td width="2%">&nbsp;</td>
        <td width="25%" height="25" style="border:#999999 1px solid;">{$esposo.apellido1}</td>
        <td width="1%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$esposo.apellido2}</td>
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
    <td colspan="3" valign="top">CONYUGE MUJER</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="25%" height="25" style="border:#999999 1px solid;">{$esposo.nombre1}</td>
        <td width="2%">&nbsp;</td>
        <td width="25%" height="25" style="border:#999999 1px solid;">{$esposo.nombre2}</td>
        <td width="2%">&nbsp;</td>
        <td width="24%" height="25" style="border:#999999 1px solid;">{$esposo.apellido1}</td>
        <td width="2%">&nbsp;</td>
        <td width="20%" height="25" style="border:#999999 1px solid;">{$esposo.apellido2}</td>
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
        <td width="42%" style="border-bottom:#999999 1px solid;">{$smarty.const.CIUDAD}</td>
        <td width="13%">.MUNICIPIO DE</td>
        <td width="42%" style="border-bottom:#999999 1px solid;">{$smarty.const.MUNICIPIO}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="16%" align="right">DEPARTAMENTO DE</td>
        <td width="25%" style="border-bottom:#999999 1px solid;">{$smarty.const.DEPARTAMENTO}</td>
        <td width="6%" align="right" > A LAS</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{$inscripcion.fechainscripcion|date_format:"%I"}</td>
        <td width="6%" align="right">DEL LA</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{if $inscripcion.fechainscripcion|date_format:"%I">=12}Tarde{else}Ma&ntilde;ana{/if}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="12%">DEL DIA</td>
        <td width="13%" style="border-bottom:#999999 1px solid;">{$inscripcion.fechainscripcion|date_format:"%l"}</td>
        <td width="10%">DEL MES DE</td>
        <td width="12%" style="border-bottom:#999999 1px solid;">{$inscripcion.fechainscripcion|date_format:"%B"}</td>
        <td width="29%">DEL  MIL NOVECIENTOS NOVENTA Y</td>
        <td width="24%" style="border-bottom:#999999 1px solid;">{$inscripcion.fechainscripcion|date_format:"%y"}</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">ANTE EL SUSCRITO REGISTRADOR DEL ESTADO CIVIL DE LAS PERSONAS Y EL SECRETARIO QUE AUTORIZA COMPARECE(N):</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$compareciente1.nombre1} {$compareciente1.nombre2} {$compareciente1.apellido1} {$compareciente1.apellido2}{if $compareciente2} , {$compareciente2.nombre1} {$compareciente2.nombre2} {$compareciente2.apellido1} {$compareciente2.apellido2}{/if}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{$compareciente1.edad} a&ntilde;os {if $compareciente2} , {$compareciente2.edad} a&ntilde;os{/if}</td>
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
        <td width="23%" style="border:#999999 1px solid;" height="25">>{$compareciente1.ocupacion}{if $compareciente2} , {$compareciente2.ocupacion}{/if}</td>
        <td width="3%">&nbsp;</td>
        <td width="21%" style="border:#999999 1px solid;" height="25">{$compareciente1.ocupacion}{if $compareciente2} , {$compareciente2.domicilio}{/if}</td>
        <td width="2%">&nbsp;</td>
        <td width="31%" style="border:#999999 1px solid;" height="25">{$compareciente1.ocupacion}{if $compareciente2} , {$compareciente2.nacionalidad}{/if}</td>
        <td width="2%">&nbsp;</td>
        <td width="18%" style="border:#999999 1px solid;" height="25">{$compareciente1.ocupacion}{if $compareciente2} , {$compareciente2.cedula}{/if}</td>
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
    <td colspan="3" valign="top">Y PRESENTA PARA SU INSCRIPCION LA SENTENCIA DICTADA POR:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="45%" style="border:#999999 1px solid;" height="25">{$acto.jueznotario}</td>
        <td width="2%">&nbsp;</td>
        <td width="28%" style="border:#999999 1px solid;" height="25">{$acto.nombrejuzgado}</td>
        <td width="2%" >&nbsp;</td>
        <td width="23%" style="border:#999999 1px solid;" height="25">{$acto.lugarjuzgado}</td>
      </tr>
      <tr>
        <td align="center">NOMBRE Y APELLIDOS DEL JUEZ </td>
        <td>&nbsp;</td>
        <td align="center">NOMBRE DEL JUZGADO</td>
        <td align="center">&nbsp;</td>
        <td align="center">DE</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">QUE EN SUS PARTES CONDUCENTES DICE:</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
	<td width="5%">A LAS</td>
        <td width="32%" style="border-bottom:#999999 1px solid;">{$acto.fechadictamen|date_format:"%I"}</td>
        <td width="6%">DE LA</td>
        <td width="29%" style="border-bottom:#999999 1px solid;">>{if $acto.fechadictamen|date_format:"%I">=12}Tarde{else}Ma&ntilde;ana{/if}</td>
        <td width="7%">DEL DIA</td>
        <td width="21%" style="border-bottom:#999999 1px solid;">{$acto.fechadictamen|date_format:"%l"}</td>

      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="10%">DEL MES DE</td>
        <td width="26%" style="border-bottom:#999999 1px solid;">{$acto.fechadictamen|date_format:"%B"}</td>
        <td width="15%">DEL AÃ DOS MIL</td>
        <td width="24%" style="border-bottom:#999999 1px solid;">{$acto.fechadictamen|date_format:"%Y"}</td>
        <td width="25%">SE UNIERON EN MATRIMONIO</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td height="25" colspan="4">EN LA QUE ORDENA LA INSCRIPCION DE LA DISOLUCION DEL VINCULO MATRIMONIAL DE:</td>
        </tr>
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$esposo.nombre1} {$esposo.nombre2} {$esposo.apellido1} {$esposo.apellido2}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{$esposo.edad}</td>
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
        <td width="23%" style="border:#999999 1px solid;" height="25">{$esposo.ocupacion}</td>
        <td width="4%">&nbsp;</td>
        <td width="30%" style="border:#999999 1px solid;" height="25">{$esposo.domicilio}</td>
        <td width="2%">&nbsp;</td>
        <td width="20%" style="border:#999999 1px solid;" height="25">{$esposo.nacionalidad}</td>
        <td width="2%">&nbsp;</td>
        <td width="19%" style="border:#999999 1px solid;" height="25">{$esposo.cedula}</td>
      </tr>
      <tr>
        <td align="center">PROFESION U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">NACIONALIDAD</td>
        <td>&nbsp;</td>
        <td align="center">CEDULA</td>
      </tr>
    </table></td>
  </tr>
    <tr>
    <td colspan="3" valign="top"><table width="100%" border="0">
      <tr>
        <td width="64%" style="border:#999999 1px solid;" height="25">{$esposa.nombre1} {$esposa.nombre2} {$esposa.apellido1} {$esposa.apellido2}</td>
        <td width="3%">&nbsp;</td>
        <td height="25" colspan="2" style="border:#999999 1px solid;">{$esposa.edad}</td>
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
        <td width="23%" style="border:#999999 1px solid;" height="25">{$esposa.ocupacion}</td>
        <td width="4%">&nbsp;</td>
        <td width="30%" style="border:#999999 1px solid;" height="25">{$esposa.domicilio}</td>
        <td width="2%">&nbsp;</td>
        <td width="20%" style="border:#999999 1px solid;" height="25">{$esposa.nacionalidad}</td>
        <td width="2%">&nbsp;</td>
        <td width="19%" style="border:#999999 1px solid;" height="25">{$esposa.cedula}</td>
      </tr>
      <tr>
        <td align="center">PROFESION U OFICIO</td>
        <td>&nbsp;</td>
        <td align="center">DOMICILIO</td>
        <td>&nbsp;</td>
        <td align="center">NACIONALIDAD</td>
        <td>&nbsp;</td>
        <td align="center">CEDULA</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top">EN DICHO MATRIMONIO PROCREARON A LOS SIGUIENTES HIJO(S)</td>
  </tr>
{section name=i loop=$hijos}
  <tr>
    <td style="border-bottom:#999 1px solid">{$hijos[i].nombre1} {$hijos[i].nombre2} {$hijos[i].apellido1} {$hijos[i].apellido2} {$hijos[i].fechanacimiento|date_format:"%D"} {$hijos[i].ciudadnacimiento}</td>
  </tr>
{/section}
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="border-bottom:#999999 1px solid;">&nbsp;</td>
  </tr>
</table>

<table width="805" border="0" style="font-family:Verdana; font-size:12px">
  <tr>
    <td>LA GUARDIA DE LOS HIJOS MENORES QUEDA EN PODER DE:</td>
  </tr>
  <tr>
    <td style="border:#999999 1px solid;" height="25">{$disolucion.custodio}</td>
  </tr>
  <tr>
    <td align="center">NOMBRE Y APELLIDOS</td>
  </tr>
  <tr>
    <td>PENSION ALIMENTICIA POR LA CANTIDAD DE:</td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="79%" style="border:#999999 1px solid;" height="25">&nbsp;</td>
        <td width="2%">&nbsp;</td>
        <td width="19%" style="border:#999999 1px solid;" height="25">C${$disolucion.pension}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="53%">BIEN INMUEBLE AFECTADO POR LA DISOLUCION DEL MATRIMONIO</td>
        <td width="12%" align="right">RUSTICO</td>
        <td width="5%" style="border:#999999 1px solid;" height="25">{if $disolucion.tipoinmueble=='rustico'}X{/if}</td>
        <td width="12%" align="right">URBANO</td>
        <td width="5%"  style="border:#999999 1px solid;" height="25">{if $disolucion.tipoinmueble=='urbano'}X{/if}</td>
        <td width="13%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="16%">INSCRITO BAJO No</td>
        <td width="23%" style="border-bottom:#999 1px solid">"{$disolucion.partidainmueble}</td>
        <td width="6%">TOMO</td>
        <td width="16%" style="border-bottom:#999 1px solid">{$disolucion.tomoinmueble}</td>
        <td width="5%">FOLIO</td>
        <td width="13%" style="border-bottom:#999 1px solid">{$disolucion.folioinmueble}</td>
        <td width="8%">ASIENTO</td>
        <td width="13%" style="border-bottom:#999 1px solid">{$disolucion.asientoinmueble}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="83%">DEL LIBRO DE PROPIEDADES SECCION DE DERECHOS REALES DEL REGISTRO PUBLICO DE LA CIUDAD DE</td>
        <td width="17%" style="border-bottom:#999 1px solid">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="12%">A NOMBRE DE</td>
        <td width="88%" style="border:#999999 1px solid;" height="25">{$disolucion.propietarioinmueble}</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center">NOMBRE Y APELLIDOS</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="805" border="0">
      <tr>
        <td width="375">DISOLUSION DEL VICULO MATRIMONIAL EN EL EXTRANJERO</td>
        <td width="420" style="border-bottom:#999 1px solid">{$inscripcion.enextrangero}</td>
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
        <td width="662" style="border-bottom:#999 1px solid">{$disolucion.datosadicionales}</td>
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
        <td width="688" style="border-bottom:#999 1px solid">{$inscripcion.observaciones}</td>
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
        <td width="236">MODIFICACIONES DEL ESTADO CIVIL</td>
        <td width="559" style="border-bottom:#999 1px solid">{disolucion.estadocivil}</td>
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
        <td width="85" height="16">INSCRITO EN</td>
        <td width="231" style="border-bottom:#999 1px solid">&nbsp;</td>
        <td width="37">TOMO</td>
        <td width="71" style="border-bottom:#999 1px solid">&nbsp;</td>
        <td width="40">FOLIO</td>
        <td width="73" style="border-bottom:#999 1px solid">&nbsp;</td>
        <td width="54">PARTIDA</td>
        <td width="70" align="right" style="border-bottom:#999 1px solid">&nbsp;</td>
        <td width="32" align="right">AÃ</td>
        <td width="70" style="border-bottom:#999 1px solid">&nbsp;</td>
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
        <td width="85" height="16">INSCRITO EN</td>
        <td width="231" style="border-bottom:#999 1px solid">&nbsp;</td>
        <td width="37">TOMO</td>
        <td width="71" style="border-bottom:#999 1px solid">&nbsp;</td>
        <td width="40">FOLIO</td>
        <td width="73" style="border-bottom:#999 1px solid">&nbsp;</td>
        <td width="54">PARTIDA</td>
        <td width="70" align="right" style="border-bottom:#999 1px solid">&nbsp;</td>
        <td width="32" align="right">AÃ</td>
        <td width="70" style="border-bottom:#999 1px solid">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
