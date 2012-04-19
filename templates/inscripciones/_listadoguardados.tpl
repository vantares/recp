<div id="listadoreco">
     <div class="cabecera"><h3>Listado de Hijos Reconocidos</h3></div>  
     <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:10%">inscripcion</div>
           <div  class="filaencabezadoli primerafila" style="width:7%">Tomo</div> 
           <div  class="filaencabezadoli" style="width:7%; text-align:center">Folio</div>
           <div  class="filaencabezadoli" style="width:40%; text-align:center">Nombre</div>
           <div  class="filaencabezadoli" style="width:17%; text-align:center">Fecha Nacimiento</div> 
           <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div> 
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado noheight">
       {if $reconocidosbd}
           {section name=id loop=$reconocidosbd}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:10%">{$reconocidosbd[id]->request.idinscripcion}</div>
                <div class="filadatosli primerafila" style="width:7%">{$reconocidosbd[id]->request.tomo}</div> 
                <div class="filadatosli" style="width:7%; text-align:center">{$reconocidosbd[id]->request.folio}</div>
                <div class="filadatosli" style="width:40%; text-align:center">{$reconocidosbd[id]->request.nombrereconocido}</div> 
                <div class="filadatosli" style="width:17%; text-align:center">{$reconocidosbd[id]->request.fechanacimiento}</div>  
                <div class="filadatosli noborde" style="width:15%; text-align:center" >
                   <div  class="floatleft icons">  
                      <a class="class2" href="{'/modulos/inscripciones/__deleteguardado.php'|cat:'/'|cat:$reconocidosbd[id]->request.idguarda|cat:'/'|cat:$reconocidosbd[id]->request.idinscripcion}"><img src="/imagenes/iconcancelar1.png" alt="delete" title="delete" width="18" height="18" /></a>
                   </div>  
                   <div class="limpiar"></div>  
                </div>                
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
      {/if}
    </div><!--listado-->       
</div>
