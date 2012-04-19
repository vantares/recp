{literal}
<script type="text/javascript">
$(document).ready(function() {
    // Fourth example
    $('a.class2').click(function(event) {
         location.href = $(this).attr('href');
    }).confirm({
        timeout:3000,
        dialogShow:'fadeIn',
        dialogSpeed:'slow',
        buttons: {
            wrapper:'<button></button>',
            separator:'  '
        }  
    });
});
</script>  
{/literal}
<div id="cajadatos"> 
	<div id="contenidowizard">
	   <div class="headerwizardizq">{$titular|upper}</div> 
	   <div id="opciones">
			 <a href="/modulos/tarifas/edittarifa.php/add">Nuevo</a>
	   </div><!--opciones--> 
	   <div class="limpiar"></div>
	</div><!--contenidowizard-->                       
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:100px">Identificador</div> 
		   <div  class="filaencabezadoli primerafila" style="width:355px">Monto</div> 
           <div  class="filaencabezadoli " style="width:155px;text-align:center">Tipo Tramite</div>  
           <div  class="filaencabezadoli" style="width:149px; text-align:center">Acciones</div>
           <div  class="limpiar"></div>
      </div><!--filaencabezado-->  
      <div class="listado">
       {if $arrayTarifas != ''}
           {section name=tarifa loop=$arrayTarifas}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:100px">{$arrayTarifas[tarifa].idtarifa}</div>
				<div class="filadatosli primerafila" style="width:355px">{$arrayTarifas[tarifa].monto}</div> 	
                <div class="filadatosli" style="width:155px;text-align:center">{$arrayTarifas[tarifa].tipotramite}</div> 			
                <div class="filadatosli noborde" style="width:149px; text-align:center" ><a href="{'/modulos/tarifas/edittarifa.php/edit/'|cat:$arrayTarifas[tarifa].idtarifa}"><img src="/imagenes/iconedit.png" alt="Editar Tarifa" title="Editar Tarifa" width="18" height="18" /></a>&nbsp;&nbsp;&nbsp;<a class="class2" href="{'/modulos/tarifas/'|cat:$arrayTarifas[tarifa].idtarifa}"><img src="/imagenes/iconcancelar1.png" alt="Eliminar Tarifa" title="Eliminar Tarifa" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
            </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen tarifas registradas en el Sistema</div>
      {/if}
    </div><!--listado--> 
</div><!--cajadatos-->