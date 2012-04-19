{literal}
<script type="text/javascript">
$(function() {
    $("#fechainicial").datepicker();
});
$(function() {
    $("#fechafinal").datepicker();
});
</script>  
{/literal}

<div id="cajadatos">
   <div id="contenidowizard">
       <div class="headerwizardizq">{$titular|upper}</div>
       <div id="opciones">
             <a href="/modulos/eventos/trazasporusuarios.php">Listado de usuarios</a>
       </div><!--opciones-->
       <div id="opciones">
             <a href="/modulos/eventos/">Todas las trazas</a>
       </div><!--opciones--> 
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
    
    <form action="" method="post" name="buscar">
    <div class="filabusqueda">        
        <div class="filabusquedali primerafila" style="width:170px">
            {if $value != true} 
            <div class="label largo50">Nombre&nbsp;</div>
            <div class="componente margintop3"><input name="nombre" type="text" class="inputback" style="width:100px;" value="{$nombre}" /></div>
            <div class="limpiar"></div>
            {/if} 
        </div>
       
        <div class="filabusquedali" style="width:200px">
            <div class="label largo100">Fecha Inicial&nbsp;</div>
            <div class="componente margintop3"><input name="fechainicial" id="fechainicial" type="text" class="inputback" style="width:110px;" value="{$fechainicial}"/></div>
            <div class="limpiar"></div>
        </div>
        <div class="filabusquedali" style="width:220px; padding-left: 10px;">
            <div class="label largo100">Fecha Final&nbsp;</div> 
            <div class="componente margintop3"><input name="fechafinal" id="fechafinal" type="text" class="inputback" style="width:110px;" value="{$fechafinal}"/></div> 
            <div class="limpiar"></div> 
        </div>  
        <div class="filabusquedali" style="width:100px; padding-left: 10px;">
            <div class="guardar" onclick="buscar.submit()">Buscar</div>
        </div>              
        <div class="limpiar"></div>    
     </div><!--filabusqueda-->     
     </form>
     
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