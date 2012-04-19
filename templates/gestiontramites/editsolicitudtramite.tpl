{literal}
<script type="text/javascript">
$().ready(function() {
	var reglas = {codigorecibo: "required", monto: {required:!$("#estaexcento").is(":checked"), number:true}, nombre: "required", sexo: "required", estadocivil: "required"};
	var mensajes = {codigorecibo: "Introduzca el codigo del recibo", monto: {required:"Este campo es requerido",number:"No es un monto valido"}, nombre: "Debe introducir el nombre de la persona que solicita el servicio", edad: "Debe introducir la edad de la persona", domicilio: "Debe introducir el domicilio", nacionalidad: "Debe introducir la nacionalidad"};
	//reglas['codigorecibo']= "required";

	$("#formedit").validate({
                rules: reglas,
                messages: mensajes
	});
    // validate signup form on keyup and submit
            
});
</script>
<script type="text/javascript"> 
$(function() {
	//code to hide topic selection, disable for demo
	//TODO: complete esta seccion de codigo
	//activar desactivar los controles al checkear
	var estaexcento= $("#estaexcento");
	var excento = $("#excento");
	var pagado = $("#pagado");
	//deshabilitar todos los controles en caso de que se este en modo de visualizacion

	// newsletter topics are optional, hide at first
	var initial = estaexcento.is(":checked");
	//var pagoInputs = pagado.find("input, select, textarea").attr("disabled", initial);
	//var excentoInputs = excento.find("input, select, textarea").attr("disabled", !initial);
	/*
	if(initial){
		excento.toggleClass("oculto");
		excento.toggleClass("visible");
		pagado.toggleClass("oculto");
		pagado.toggleClass( "visible");
	}
	else{
		excento.toggleClass("visible");
		excento.toggleClass("oculto");
		pagado.toggleClass("visible");
		pagado.toggleClass("oculto");
	}
	*/
	// show when newsletter is checked
	estaexcento.click(function() {
		excento[this.checked ? "addClass" : "removeClass"]("visible");
		excento[this.checked ? "removeClass" : "addClass"]("oculto");
		pagado[this.checked ? "removeClass" : "addClass"]("visible");
		pagado[this.checked ? "addClass" : "removeClass"]( "oculto");
		//pagoInputs.attr("disabled", this.checked);
		//excentoInputs.attr("disabled", !this.checked );
	});
	//End seccion
	//remplazar al bloque a continuacion
	// cargar tipo espefico de solicitud
	var existtipotramite= $("select#tipotramite option").is(":selected");
	if(existtipotramite){
		 var tipotramite= $("select#tipotramite option:selected").val();
		 $(".solicitud_data.visible").toggleClass('visible').toggleClass('oculto');
		 $("#tiposolicitud_"+tipotramite).toggleClass('oculto').toggleClass('visible');
	}
	$("select#tipotramite").change(function(){
		 var tiposolicitud= $("select#tipotramite option:selected").val();
		 $(".solicitud_data.visible").toggleClass('visible').toggleClass('oculto');
		 $("#tiposolicitud_"+tiposolicitud).toggleClass('oculto').toggleClass('visible');
	});
    $("#fechaentrega").datepicker();
    $("#fechanacimiento").datepicker();
    $("#fecharegistro").datepicker();
    $("#fechainscripcion").datepicker();

	// campos readonly en caso de estar editando un registro
	var idrecibo= $("input#idrecibo").val();
	var idsolicitudtramite= $("input#idsolicitudtramite").val();
	if(!isNaN(parseInt(idrecibo)) || !isNaN(parseInt(idsolicitudtramite))){
		$("#estaexcento").attr("readonly","readonly").attr("disabled","disabled");
	}
	/*
	 * comentar en caso que sea posible editar un registro ingresado
	 */
	 //alert(parseInt(idrecibo));
	 /*
	if(!isNaN(parseInt(idrecibo))){
		$("#reciboasociado input, #reciboasociado select, #reciboasociado textarea").attr("readonly","readonly");
	}

	if(!isNaN(parseInt(idsolicitudtramite))){
		$("#solicitud input, #solicitud select, #solicitud textarea").attr("readonly","readonly");
		$("#solicitud select").attr("disabled","disabled");
		$("#tiposolicitud_1 input, #tiposolicitud_1 select, #tiposolicitud_1 textarea").attr("readonly","readonly");
		$("#tiposolicitud_1 select").attr("disabled","disabled");
		$("#tiposolicitud_2 input, #tiposolicitud_2 select, #tiposolicitud_2 textarea").attr("readonly","readonly");
		$("#tiposolicitud_2 select").attr("disabled","disabled");
	}
	*/
});
</script> 
{/literal}
<div id="cajadatos">  
<form class="cmxform" id="formedit" method="post" action="">
<div id="contenidowizard">
<div class="headerwizardizq">{$titular|upper}</div>   
       <div id="opciones">
             <a href="/modulos/gestiontramites/">Listado</a>
       </div><!--opciones-->           
<div class="limpiar"></div>
</div><!--contenidowizard--> 
<div class="limpiar"></div>
<div class="formulario">
<!-- datos generales de la solicitud  -->
<fieldset id="solicitud" class="visible">
	<legend>Solicitud de tramite</legend>
	<input type="hidden" name="idsolicitudtramite" id="idsolicitudtramite" value="{$solicitud->request.idsolicitudtramite}"/>
	<div id="cmdfechaentrega" class="filaform" style="padding-bottom: 10px;">
		{include file="gestiontramites/_fechaentrega.tpl"}
	</div><!--filaform-->
	<div class="filaform">
		<div class="label">Solicitante 1:</div>
		<div class="component">
		<input name="solicitante1" id="solicitante1" type="text" class="listwizard selectwizard" style="width:200px;" value="{$solicitud->request.solicitante1}"/>
		<div class="limpiar"></div>
		</div>
	</div><!--filaform-->
	<div class="limpiar"></div>
	<div class="filaform" id="compareciente2">
		<div class="label">Solicitante 2:</div>
		<div class="component">
			<input name="solicitante2" id="solicitante2" type="text" class="listwizard selectwizard" style="width:200px;" value="{$solicitud->request.solicitante2}"/>
			<div class="limpiar"></div>
		</div>
	</div><!--filaform-->
	<div class="limpiar"></div>
	<div class="filaform">
		<div class="label">Tipo de Tr&aacute;mite:</div>
		<div class="component">
			<select name="tipotramite" id="tipotramite"  class="listwizard selectwizard" >
			<option value="">Seleccionar Tr&aacute;mite</option>

			{section name=idtipotramite loop=$arrayTipotramite}
				<option value="{$arrayTipotramite[idtipotramite].idtipotramite}" {if $arrayTipotramite[idtipotramite].idtipotramite == $solicitud->request.tipotramite}selected{/if} >{$arrayTipotramite[idtipotramite].tipotramite}</option>
			{/section}
			</select>
			<div class="limpiar"></div>
		</div>
		<div class="limpiar"></div>
	</div><!--filaform-->
	<div class="limpiar"></div>
	<div class="filaform">
		<div class="label">Excento de Pago:</div>
		<div class="component">
			<input type="checkbox" id="estaexcento" name="estaexcento" value="1" {if $solicitud and $solicitud->request.excento!='f' or $recibo.idrecibo} checked="checked"{/if}> 
			<div class="limpiar"></div>
		</div>
	<div class="limpiar"></div>

	</div><!--filaform-->
	<div class="limpiar"></div>
</fieldset> 

{include file="gestiontramites/solicitudinscripcion.tpl"}
{include file="gestiontramites/solicitudcertificado.tpl"}
{include file="gestiontramites/patrocinio.tpl"}

<div id="pagado" class="{if !$solicitud or $solicitud->request.excento=='f' } visible  {else} oculto {/if}">
	<fieldset id="reciboasociado"> 
		<legend>Datos del Recibo Asociado</legend>  
		{include file="gestiontramites/recibo.tpl"}
	</fieldset>  
</div><!-- pagado -->
{if $recibo}
{include file="gestiontramites/listadosolicitudesrecibo.tpl"}
{/if}
<input type="hidden" id="action" name="action" value="{$action|default:'add'}" />
<div class="filadatos noborde" style="float:right">
<input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
<input name="tipo" type="hidden" value="{$tipo}"/>
<div class="limpiar"></div>
</div><!--filadatos--> 
</div><!--formulario-->
</form>
</div>
