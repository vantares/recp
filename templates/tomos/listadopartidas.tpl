<div id="cajadatos">         
   <div id="contenidowizard">
       <div class="headerwizardizq">{'Partidas Registradas del Tomo '|cat:$tomo_numero|cat:' del libro de '|cat:$libroregistral|upper}</div> 
       <div id="opciones">
             <a href="/modulos/tomos/">Listado Tomos</a>
       </div><!--opciones--> 
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
    <form action="" method="post" name="buscar">
      <div class="filaencabezado">
           <!-- div  class="filaencabezadoli primerafila" style="width:5%">Codigo</div>
           <div  class="filaencabezadoli" style="width:10%; text-align:center">IdInscripcion</div  --> 
           <div  class="filaencabezadoli" style="width:10%; text-align:center">Tomo</div>
           <div  class="filaencabezadoli" style="width:10%; text-align:center">Folio</div>
           <div  class="filaencabezadoli" style="width:10%; text-align:center">Partida</div>
           <div  class="filaencabezadoli" style="width:30%; text-align:center">Inscrito</div>  
           <div  class="filaencabezadoli" style="width:22%; text-align:center">Fecha</div>
           <div  class="filaencabezadoli noborde" style="width:17%; text-align:center">Acciones</div> 
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado">
       {if $arrayPartidas}
           {section name=i loop=$arrayPartidas}
            <div class="filadatos">
                {* <div class="filadatosli primerafila" style="width:5%">{$arrayPartidas[i].idacta}</div> 
                <div class="filadatosli" style="width:10%; text-align:center">{$arrayPartidas[i].idinscripcion}</div> 
                <div class="filadatosli" style="width:10%; text-align:center">{$arrayPartidas[i].idtomo}</div> *}
                <div class="filadatosli" style="width:10%; text-align:center">{$tomo_numero}</div>
                <div class="filadatosli" style="width:10%; text-align:center">{$arrayPartidas[i].folio}</div> 
                <div class="filadatosli" style="width:10%; text-align:center">{$arrayPartidas[i].partida}</div> 
                <div  class="filadatosli" style="width:30%; text-align:center;"><a style="color:#333;text-decoration:underline" href="{$url|cat:$arrayPartidas[i].idinscripcion}">{$arrayPartidas[i].inscrito1nombre1} {$arrayPartidas[i].inscrito1nombre2} {$arrayPartidas[i].inscrito1apellido1} {$arrayPartidas[i].inscrito1apellido2}</a></div> 
                <div class="filadatosli" style="width:22%; text-align:center">{$arrayPartidas[i].fecha}</div>
                <div class="filadatosli noborde" style="width:15%; text-align:center">
			<div class="floatleft icons"><a href="{$url|cat:$arrayPartidas[i].idinscripcion}"><img src="/imagenes/iconrefresh.png" alt="detalles" title="detalles" height="18" width="18"/></a></div><div class="limpiar"></div>
		</div>
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen Partidas registradas para este Tomo</div>
      {/if}
    </div><!--listado-->   
    </form>                       
 </div><!--cajadatos-->
