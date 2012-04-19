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
	<div id="contenidowizard">
	   <div class="headerwizardizq">{$titular|upper}</div> 
	   <div id="opciones">
			 <a href="/modulos/roles/editrol.php/add">Nuevo</a>
	   </div><!--opciones--> 
	   <div class="limpiar"></div>
	</div><!--contenidowizard-->                       
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:555px">Nombre del Rol</div> 
           <div  class="filaencabezadoli" style="width:149px; text-align:center">Acciones</div>
           <div class="limpiar"></div>
      </div><!--filaencabezado-->  
      <div class="listado">
       {if $arrayRoles != ''}
           {section name=rol loop=$arrayRoles}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:555px">{$arrayRoles[rol].nombrerol}</div> 
                <div class="filadatosli noborde" style="width:149px; text-align:center" ><a href="{'/modulos/roles/editrol.php/edit/'|cat:$arrayRoles[rol].idrol}"><img src="/imagenes/iconedit.png" alt="Editar Rol" title="Editar Rol" width="18" height="18" /></a>&nbsp;&nbsp;&nbsp;<a class="class2" href="{'/modulos/roles/index.php/'|cat:$arrayRoles[rol].idrol}"><img src="/imagenes/iconcancelar1.png" alt="Eliminar Rol" title="Eliminar Rol" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
            </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen Roles registrados en el Sistema</div>
      {/if}
    </div><!--listado--> 
</div><!--cajadatos-->