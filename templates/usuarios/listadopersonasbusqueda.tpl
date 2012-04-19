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
       <div class="headerwizardizq">{'Busqueda de Personas'|upper}</div> 
       <div id="opciones">
             <a href="/modulos/personas/addpersona.php">Nuevo</a>
       </div><!--opciones-->  
       <div class="limpiar"></div>
    </div><!--contenidowizard-->
    <form action="" method="post" name="buscar">
    <div class="filabusqueda">
        <div class="filabusquedali primerafila" style="width:170px">
            <div class="label largo50">Nombre 1&nbsp;</div>
            <div class="componente margintop3"><input name="nombre1" type="text" class="inputback" style="width:100px;" value="{$nombre1}" /></div>
            <div class="limpiar"></div>
        </div>
		<div class="filabusquedali primerafila" style="width:170px">
            <div class="label largo50">Nombre 2&nbsp;</div>
            <div class="componente margintop3"><input name="nombre2" type="text" class="inputback" style="width:100px;" value="{$nombre2}" /></div>
            <div class="limpiar"></div>
        </div>
        <div class="filabusquedali" style="width:170px">
            <div class="label" style="width:60px;">Apellido 1&nbsp;</div>
            <div class="componente margintop3"><input name="apellido1" type="text" class="inputback" style="width:100px;" value="{$apellido1}" /></div>
            <div class="limpiar"></div>
        </div> 
		<div class="filabusquedali" style="width:170px">
            <div class="label" style="width:60px;">Apellido 2&nbsp;</div>
            <div class="componente margintop3"><input name="apellido2" type="text" class="inputback" style="width:100px;" value="{$apellido2}" /></div>
            <div class="limpiar"></div>
        </div> 		
        <div class="filabusquedali" style="width:145px; padding-left: 10px;">
            <div class="guardar" onclick="buscar.submit()">Buscar</div>
        </div>              
        <div class="limpiar"></div>  
     </div><!--filabusqueda-->     
     </form>
     <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:370px">Nombre y Apellidos</div>
           <div  class="filaencabezadoli primerafila" style="width:175px; text-align:center">Fecha de Nacimiento</div>
           <div  class="filaencabezadoli primerafila" style="width:159px; text-align:center">Acciones</div> 
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado">
       {if $personasbd != ''}
           {section name=id loop=$personasbd}
            <div class="filadatos">
                <div class="filadatosli" style="width:370px; text-align:center">{$personasbd[id].nombre1}&nbsp;{$personasbd[id].apellido1}&nbsp;{$personasbd[id].apellido2}</div>
                <div class="filadatosli" style="width:370px; text-align:center">{$personasbd[id].fechanacimiento}</div> 
                <div class="filadatosli noborde" style="width:160px; text-align:center" ><a href="{'/modulos/tramites/index.php/idpersona/'|cat:$personasbd[id].idpersona}"><img src="/imagenes/iconaspirantes.png" alt="Verificar Datos" title="Verificar Datos" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
       {else}
         <div class="limpiar"></div> 
         <div class="noresults">No existen concordancias entre los datos entrados y las personas registradas en nuestro sistema</div>
       {/if}
    </div><!--listado-->         
</div><!--cajadatos-->