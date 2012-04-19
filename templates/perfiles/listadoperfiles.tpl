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
			 <a href="/modulos/perfiles/editperfil.php/add">Nuevo Perfil</a>
	   </div><!--opciones--> 
	   <div class="limpiar"></div>
	</div><!--contenidowizard-->                       
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:555px">Nombre del Perfil</div> 
           <div  class="filaencabezadoli" style="width:149px; text-align:center">Acciones</div>
           <div class="limpiar"></div>
      </div><!--filaencabezado-->  
      <div class="listado">
       {if $arrayPerfiles != ''}
           {section name=perfil loop=$arrayPerfiles}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:555px">{$arrayPerfiles[perfil].nombre}</div> 
                <div class="filadatosli noborde" style="width:149px; text-align:center" ><a href='/modulos/perfiles/editperfil.php?accion=edit&idperfil={$arrayPerfiles[perfil].idperfil}'><img src="/imagenes/iconedit.png" alt="Editar Perfil" title="Editar Perfil" width="18" height="18" /></a>&nbsp;&nbsp;&nbsp;<a class="class2" href="{'/modulos/perfiles/'|cat:$arrayPerfiles[perfil].idperfil}"><img src="/imagenes/iconcancelar1.png" alt="Eliminar Perfil" title="Eliminar Perfil" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
            </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen Perfiles registrados en el Sistema</div>
      {/if}
    </div><!--listado--> 
</div><!--cajadatos-->