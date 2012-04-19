<div id="listadoreco">
     <div class="cabecera"><h3>Listado de solicitudes contenidas en el recibo</h3></div>  
     <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:5%">Id</div>
           <div  class="filaencabezadoli primerafila" style="width:19%">Tipo de Certificaci&oacute;n</div> 
           <div  class="filaencabezadoli" style="width:20%; text-align:center">Tipo Tramite</div>
           <div  class="filaencabezadoli" style="width:20%; text-align:center">Fecha Registro</div>
           <div  class="filaencabezadoli" style="width:17%; text-align:center">Fecha Entrega</div> 
           <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div> 
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado noheight">
       {if $solicitudes}
           {section name=id loop=$solicitudes}
           {assign var=solicitudcert value=$solicitudes[id]->getSolicitudCertificacion()}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:5%">{$solicitudes[id]->request.idsolicitudtramite}</div>    
                <div class="filadatosli primerafila" style="width:19%">{$solicitudcert->request.tipocertificacion}</div>    
                <div class="filadatosli" style="width:20%; text-align:center">{$solicitudes[id]->request.tipotramite}</div>
                <div class="filadatosli" style="width:20%; text-align:center">{$solicitudcert->request.fecharegistro}</div> 
                <div class="filadatosli" style="width:17%; text-align:center">{$solicitudes[id]->request.fechaentrega}</div>  
                <div class="filadatosli noborde" style="width:15%; text-align:center" >  
                      <a class="class2" href="{'/modulos/tramites/_deletesolicitud.php/'|cat:$solicitudes[id]->request.idsolicitudtramite}"><img src="/imagenes/iconcancelar1.png" alt="delete" title="delete" width="18" height="18" /></a>   
                </div>                
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No se han registrado solicitudes</div>
      {/if}
    </div><!--listado-->  
    <div class="limpiar"></div>          
</div>