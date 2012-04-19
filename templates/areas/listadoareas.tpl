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
             <a href="/modulos/areas/editarea.php/add">Nuevo</a>
       </div><!--opciones--> 
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
	<form action="" method="post" name="buscar">
                        
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:290px">Nombre del &Aacute;rea</div> 
           <div  class="filaencabezadoli" style="width:80px; text-align:center">Visible</div>
           <div  class="filaencabezadoli" style="width:175px; text-align:center">Independiente</div> 
           <div  class="filaencabezadoli" style="width:159px; text-align:center">Acciones</div>
           <div class="limpiar"></div>
      </div><!--filaencabezado-->  
      <div class="listado">
       {if $arrayAreas != ''}
           {section name=area loop=$arrayAreas}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:290px">{$arrayAreas[area].nombre}</div>
                <div class="filadatosli" style="width:80px; text-align:center">{if $arrayAreas[area].visible == 1}Si{else}No{/if}</span></div> 
                <div class="filadatosli" style="width:175px; text-align:center">{if $arrayAreas[area].independiente}Si{else}No{/if}</span></div>
                <div class="filadatosli noborde" style="width:160px; text-align:center" ><a href="{'/modulos/areas/editarea.php/edit/'|cat:$arrayAreas[area].idarea}"><img src="/imagenes/iconedit.png" alt="Editar &Aacute;rea" title="Editar &Aacute;rea" width="18" height="18" /></a>&nbsp;&nbsp;&nbsp;<a class="class2" href="{'/modulos/areas/index.php'|cat:'/'|cat:$arrayAreas[area].idarea}"><img src="/imagenes/iconcancelar1.png" alt="Eliminar &Aacute;rea" title="Eliminar &Aacute;rea" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
       {else}
         <div class="noresults">No existen &Aacute;reas registradas en el Sistema</div>
       {/if}
    </div><!--listado-->   
    </form>                       
 </div><!--cajadatos-->