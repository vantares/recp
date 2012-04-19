<div id="cajadatos">         
    <span class="titular">ULTIMAS TRAZAS REALIZADAS</span>
    <div class="filaencabezado">
          <div  class="filaencabezadoli primerafila" style="width:50%">Descripcion</div>
          <div  class="filaencabezadoli" style="width:20%; text-align:center">Usuario</div>
          <div  class="filaencabezadoli" style="width:28%; text-align:center">Fecha</div>
          <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado">
        {section name=evento loop=$arrayEventos}
        <div class="filadatos">
               <div class="filadatosli primerafila" style="width:50%">{$arrayEventos[evento].descripcion}</div>
               <div class="filadatosli" style="width:20%; text-align:center"><span class="numeroverde">{$arrayEventos[evento].nombreusuario}</span></div>
               <div class="filadatosli noborde" style="width:20%; text-align:center" >{$arrayEventos[evento].fechaocurrencia|date_format:"%b %d, %Y "|capitalize}</div>
               <div class="limpiar"></div>
        </div><!--filadatos-->
        {/section}
    </div><!--listado-->   
 </div>