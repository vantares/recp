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
    <form class="cmxform" id="formedit" method="post" action="">
      <div id="contenidowizard">
           <div class="headerwizardizq">{$titular|upper}</div>
           <div id="opciones">
                 <a href="{'/modulos/solicitudes/'}">Listado de Recibos</a>
           </div><!--opciones-->   
           <div class="limpiar"></div>
       </div><!--contenidowizard--> 
       <div class="limpiar"></div>
          
          <div class="filaform" style="padding-bottom: 5px;">
              <div class="label1"><b>Monto General:&nbsp;{$recibo->request.monto}</b></div>   
              <div class="limpiar"></div>
          </div><!--filaform-->
          
          <div id="listadoreco">
               {if $tiposolicitud == 'certificacion'}
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
                   {section name=id loop=$solicitudes}
                   {assign var=solicitudcert value=$solicitudes[id]->getSolicitudCertificacion()}
                    <div class="filadatos">
                        <div class="filadatosli primerafila" style="width:5%">{$solicitudes[id]->request.idsolicitudtramite}</div>    
                        <div class="filadatosli primerafila" style="width:19%">{$solicitudcert->request.tipocertificacion}</div>    
                        <div class="filadatosli" style="width:20%; text-align:center">{$solicitudes[id]->request.tipotramite}</div>
                        <div class="filadatosli" style="width:20%; text-align:center">{$solicitudcert->request.fecharegistro}</div> 
                        <div class="filadatosli" style="width:17%; text-align:center">{$solicitudes[id]->request.fechaentrega}</div>  
                        <div class="filadatosli noborde" style="width:15%; text-align:center" >  
                              <a href="{'/modulos/solicitudes/atendercertificaciones.php/'|cat:$solicitudes[id]->request.idsolicitudtramite}" target="_blank"><img src="/imagenes/iconacta.png" alt="Emitir Acta" title="Emitir Acta" width="18" height="18" /></a>
                              <a class="class2" href="{'/modulos/solicitudes/_finalizar.php/'|cat:$solicitudes[id]->request.idsolicitudtramite|cat:'/'|cat:$idrecibo}" ><img src="/imagenes/finish.png" alt="Solicitud Atendida" title="Solicitud Atendida" width="18" height="18" /></a>      
                        </div>                
                        <div class="limpiar"></div>
                  </div><!--filadatos-->
                  {/section}  
              {else}  
                       <div class="cabecera"><h3>Listado de solicitudes efectuadas</h3></div>  
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
                       {section name=id loop=$solicitudes}
                       {assign var=solicitudcert value=$solicitudes[id]->getSolicitudInscripcion()}
                        <div class="filadatos">
                            <div class="filadatosli primerafila" style="width:5%">{$solicitudes[id]->request.idsolicitudtramite}</div>    
                            <div class="filadatosli primerafila" style="width:19%">{$solicitudcert->request.tipoinscripcion}</div>    
                            <div class="filadatosli" style="width:20%; text-align:center">{$solicitudes[id]->request.tipotramite}</div>
                            <div class="filadatosli" style="width:20%; text-align:center">{$solicitudcert->request.fecharegistro}</div> 
                            <div class="filadatosli" style="width:17%; text-align:center">{$solicitudes[id]->request.fechaentrega}</div>  
                            {if $solicitudes[id]->request.estado != 2}
                            <div class="filadatosli noborde" style="width:15%; text-align:center" >  
                                  <a href="{'/modulos/solicitudes/atenderinscripciones.php/'|cat:$solicitudes[id]->request.idsolicitudtramite}" target="_blank"><img src="/imagenes/iconacta.png" alt="Atender Solicitud" title="Atender Solicitud" width="18" height="18" /></a>   
                                  <a class="class2" href="{'/modulos/solicitudes/_finalizar.php/'|cat:$solicitudes[id]->request.idsolicitudtramite|cat:'/'|cat:$idrecibo}" ><img src="/imagenes/finish.png" alt="Finalizar Solicitud" title="Finalizar Solicitud" width="18" height="18" /></a>      
                            </div> 
                            {elseif $solicitudes[id]->request.estado == 2 } 
                              <div class="filadatosli noborde" style="width:15%; text-align:center" >Procesada</div>
                            {/if}              
                            <div class="limpiar"></div>
                      </div><!--filadatos-->
                      {/section}    
              {/if}
            </div><!--listado-->            

          
          <div class="filadatos noborde" style="float:right">               
            <input name="idrecibo" type="hidden" value="{$recibo->request.idrecibo}"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->
               
     </div><!--formulario-->
    </form>
 </div>