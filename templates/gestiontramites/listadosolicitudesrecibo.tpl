<div id="listadoreco">
     <div class="cabecera"><h3>Listado de solicitudes contenidas en el recibo</h3></div>  
     <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:5%">Id</div>
           <div  class="filaencabezadoli primerafila" style="width:19%">Tipo de Certificaci&oacute;n</div> 
           <div  class="filaencabezadoli" style="width:20%; text-align:center">Tipo Tramite</div>
           <div  class="filaencabezadoli" style="width:20%; text-align:center">Fecha solicitud</div>
           <div  class="filaencabezadoli" style="width:17%; text-align:center">Fecha Entrega</div> 
           <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div> 
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado noheight">
       {if $solicitudes}
           {foreach item=solicitudrecibo from=$solicitudes}
            <div class="filadatos">
				<!--  una solicitud  -->
                <div class="filadatosli primerafila" style="width:5%">{$solicitudrecibo->request.idsolicitudtramite}</div>    
                <div class="filadatosli primerafila" style="width:19%">{*$solicitudrecibo->request.tipocertificacion*}</div>    
                <div class="filadatosli" style="width:20%; text-align:center">{$solicitudrecibo->request.tipotramite}</div>
                <div class="filadatosli" style="width:20%; text-align:center">{$solicitudrecibo->request.fecha}</div> 
                <div class="filadatosli" style="width:17%; text-align:center">{$solicitudrecibo->request.fechaentrega}</div>  
                <div class="filadatosli noborde" style="width:15%; text-align:center" >  
                      <a class="class2" href="{'/modulos/gestiontramites/_deletesolicitud.php/'|cat:$solicitudrecibo->request.idsolicitudtramite}"><img src="/imagenes/iconcancelar1.png" alt="delete" title="delete" width="18" height="18" /></a>   
                </div>                
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/foreach}
      {else}
         <div class="noresults">No se han registrado solicitudes</div>
      {/if}
    </div><!--listado-->  
    <div class="limpiar"></div>          
</div>
