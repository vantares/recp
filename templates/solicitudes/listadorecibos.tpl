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
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
	<form action="" method="post" name="buscar">                        
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:40%;">Nombre del Cliente</div>
           <div  class="filaencabezadoli primerafila" style="width:20%; text-align:center" align="center">Cantidad</div>
           <div  class="filaencabezadoli primerafila" style="width:20%; text-align:center" align="center">Fecha</div>        
           <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div>
           <div class="limpiar"></div>
      </div><!--filaencabezado-->  
      <div class="listado">
       {if $arrayRecibos != ''}
           {section name=recibo loop=$arrayRecibos}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:40%;">{$arrayRecibos[recibo].nombrecliente}</div>
                <div class="filadatosli primerafila" style="width:20%; text-align:center" align="center">{$arrayRecibos[recibo].cant}</div> 
                <div class="filadatosli primerafila" style="width:20%; text-align:center" align="center">{$arrayRecibos[recibo].fecha}</div>                                 
                <div class="filadatosli noborde" style="width:15%; text-align:center" >
                    <a href="{'/modulos/solicitudes/chequearrecibo.php/'|cat:$arrayRecibos[recibo].idrecibo}" ><img src="/imagenes/iconedit.png" alt="Chequear Recibo" title="Chequear Recibo" width="18" height="18" /></a>
                </div>
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen recibos de pagos registrados en el Sistema</div>
      {/if}
    </div><!--listado-->   
    </form>                       
 </div><!--cajadatos-->