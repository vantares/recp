<div id="cajadatos">
   <div id="contenidowizard">
       <div class="headerwizardizq">{$titular|upper}</div>
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
    
    <form action="" method="post" name="buscar">
    <div class="filabusqueda">        
        <div class="filabusquedali primerafila" style="width:170px"> 
            <div class="label largo50">Nombre&nbsp;</div>
            <div class="componente margintop3"><input name="nombre" type="text" class="inputback" style="width:100px;" value="{$nombre}" /></div>
            <div class="limpiar"></div>
        </div>        
        <div class="filabusquedali primerafila" style="width:200px"> 
            <div class="label">Apellido 1&nbsp;</div>
            <div class="componente margintop3"><input name="apellido1" type="text" class="inputback" style="width:100px;" value="{$apellido1}" /></div>
            <div class="limpiar"></div>
        </div>       
        <div class="filabusquedali" style="width:150px">
            <div class="label largo100">A&ntilde;o&nbsp;</div>
            <div class="componente margintop3"><input name="anyo" type="text" class="inputback" style="width:50px;" value="{$anyo}" /></div>
            <div class="limpiar"></div>
        </div> 
        <div class="filabusquedali" style="width:100px; padding-left: 10px;">
            <div class="guardar" onclick="buscar.submit()">Buscar</div>
        </div>              
        <div class="limpiar"></div>    
     </div><!--filabusqueda-->     
     </form>
     
      <div class="filaencabezado">
          <div  class="filaencabezadoli" style="width:15%; text-align:center">No. de serie</div> 
          <div  class="filaencabezadoli primerafila" style="width:40%">Nombre y apellidos</div>
          <div  class="filaencabezadoli" style="width:23%; text-align:center">Tipo de tr&aacute;mite</div>
          <div  class="filaencabezadoli" style="width:20%; text-align:center">Acciones</div>
          <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado">
        {if $arrayInscripciones != ''}
            {section name=inscripcion loop=$arrayInscripciones}
            <div class="filadatos">
                   <div class="filadatosli " style="width:15%; text-align:center">{$arrayInscripciones[inscripcion].numeroserie}</div>
                   <div class="filadatosli primerafila" style="width:40%">{$arrayInscripciones[inscripcion].inscrito1nombre1}&nbsp;{$arrayInscripciones[inscripcion].inscrito1nombre2}&nbsp;{$arrayInscripciones[inscripcion].inscrito1apellido1}&nbsp;{$arrayInscripciones[inscripcion].inscrito1apellido2}</div>
                   <div class="filadatosli" style="width:23%; text-align:center"><span class="numeroverde">{$arrayInscripciones[inscripcion].tipoinscripcion}</span></div>
                   <div class="filadatosli noborde" style="width:18%; text-align:center" ><a href="{'/modulos/certificaciones/addcertnacimiento.php/'|cat:$arrayInscripciones[inscripcion].idinscripcion}"><img src="/imagenes/opciones.png" alt="Certificar" title="Certificar" width="18" height="18" /></a></div>
                   <div class="limpiar"></div>
            </div><!--filadatos-->
            {/section}
        {else}
            <div class="noresults">No existen coincidencias en el Sistema con los datos consultados.</div>
        {/if}
    </div><!--listado-->   
 </div>