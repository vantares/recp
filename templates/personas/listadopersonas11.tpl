{literal}
<script type="text/javascript">
$(function() {
    $("#fechainicial").datepicker();
});
$(function() {
    $("#fechafinal").datepicker();
});

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
       <div class="headerwizardizq">{'Listado de Personas'|upper}</div> 
       <div id="opciones">
             <a href="/modulos/personas/addpersona.php">Nuevo</a>
       </div><!--opciones-->  
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    <form action="" method="post" name="buscar">
    <div class="filabusqueda">
        <div class="filabusquedali primerafila" style="width:170px">
            <div class="label largo50">Nombre&nbsp;</div>
            <div class="componente margintop3"><input name="nombre" type="text" class="inputback" style="width:100px;" value="{$nombre}" /></div>
            <div class="limpiar"></div>
        </div>
        <div class="filabusquedali" style="width:170px">
            <div class="label" style="width:60px;">Apellido&nbsp;</div>
            <div class="componente margintop3"><input name="apellido" type="text" class="inputback" style="width:100px;" value="{$apellido}" /></div>
            <div class="limpiar"></div>
        </div>    
        <div class="filabusquedali" style="width:145px; padding-left: 10px;">
            <div class="guardar" onclick="buscar.submit()">Buscar</div>
        </div>              
        <div class="limpiar"></div>
        <div class="filabusquedali primerafila" style="width:200px">
            <div class="label largo100">Fecha Inicial&nbsp;</div>
            <div class="componente margintop3"><input name="fechainicial" id="fechainicial" type="text" class="inputback" style="width:110px;" value="{$fechainicial}"/></div>
            <div class="limpiar"></div>
        </div>
        <div class="filabusquedali" style="width:220px; padding-left: 10px;">
            <div class="label largo100">Fecha Final&nbsp;</div> 
            <div class="componente margintop3"><input name="fechafinal" id="fechafinal" type="text" class="inputback" style="width:110px;" value="{$fechafinal}"/></div> 
            <div class="limpiar"></div> 
        </div>  
     
        <div class="limpiar"></div>   
     </div><!--filabusqueda-->     
     </form>
     <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:7%">Codigo</div>
           <div  class="filaencabezadoli primerafila" style="width:7%">Cedula</div> 
            <div  class="filaencabezadoli" style="width:47%; text-align:center">Nombre</div>
            <div  class="filaencabezadoli primerafila" style="width:15%">Fecha Nacimiento</div> 
           <div  class="filaencabezadoli" style="width:19%; text-align:center">Acciones</div> 
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado">
       {if $personasbd != ''}
           {section name=id loop=$personasbd}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:7%">{$personasbd[id].idpersona}</div>
                <div class="filadatosli primerafila" style="width:7%">{$personasbd[id].cedula}</div> 
                <div class="filadatosli" style="width:47%; text-align:center">{$personasbd[id].nombre1|cat:' '|cat:$personasbd[id].nombre2|cat:' '|cat:$personasbd[id].apellido1|cat:' '|cat:$personasbd[id].apellido2}</div>
                <div class="filadatosli" style="width:16%; text-align:center">{$personasbd[id].fechanacimiento}</div> 
                <div class="filadatosli noborde" style="width:19%; text-align:center" >
                   <div class="floatleft icons">
                        <a href="{'/modulos/personas/editpersona'|cat:'/'|cat:$personasbd[id].idpersona}"><img src="/imagenes/iconedit.png" alt="editar" title="editar" width="18" height="18" /></a>
                   </div>
                   <div class="floatleft icons">  
                      <a href="{'/modulos/personas/editpersona'|cat:'/'|cat:$personasbd[id].idpersona|cat:'/1'}"><img src="/imagenes/iconrefresh.png" alt="detalles" title="detalles" width="18" height="18" /></a>
                   </div>
                   <div  class="floatleft icons">  
                      <a class="class2" href="{'/modulos/personas/__deletepersona.php'|cat:'/'|cat:$personasbd[id].idpersona}"><img src="/imagenes/iconcancelar1.png" alt="delete" title="delete" width="18" height="18" /></a>
                   </div>                   
                   <div class="limpiar"></div>  
                </div>                
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
      {else}
         <div class="limpiar"></div> 
         <div class="noresults">No existen Partidas Registradas</div>
      {/if}
    </div><!--listado-->   
                           
</div><!--cajadatos-->