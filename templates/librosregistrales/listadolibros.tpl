<div id="cajadatos">         
   <div id="contenidowizard">
       <div class="headerwizardizq">{$titular|upper}</div> 
       <div id="opciones">
             <a href="/modulos/librosregistrales/crearlibroregistral.php">Nuevo Libro</a>
       </div><!--opciones-->  
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
    <form action="" method="post" name="buscar">
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:7%">Codigo</div>
           <div  class="filaencabezadoli primerafila" style="width:25%">Rubro</div> 
           <div  class="filaencabezadoli" style="width:20%; text-align:center">&Uacute;ltimo Tomo</div>
           <div  class="filaencabezadoli" style="width:20%; text-align:center">Cantidad Tomos</div>
           <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div> 
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado">
       {if $arrayLibros != ''}
           {section name=libro loop=$arrayLibros}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:7%">{$arrayLibros[libro].codigo}</div>
                <div class="filadatosli primerafila" style="width:25%">{$arrayLibros[libro].rubro}</div> 
                <div class="filadatosli" style="width:20%; text-align:center"><span class="numeroverde"><b>{$arrayLibros[libro].ultimotomo}</span></b></div>
                <div class="filadatosli" style="width:20%; text-align:center"><span class="numeroverde"><b>{$arrayLibros[libro].cantlibro}</span></b></div> 
                <div class="filadatosli noborde" style="width:15%; text-align:center" ><a href="{'/modulos/tomos/index.php/'|cat:$arrayLibros[libro].idlibro}"><img src="/imagenes/iconaspirantes.png" alt="tomos" title="tomos" width="25" height="19" /></a></div>
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen Libros Registrales para ese rubro registrados</div>
      {/if}
    </div><!--listado-->   
    </form>                       
</div><!--cajadatos-->