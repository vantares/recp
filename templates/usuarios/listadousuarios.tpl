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
             <a href="/modulos/usuarios/usuarioedit.php/add">Nuevo</a>
       </div><!--opciones--> 
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
	<form action="" method="post" name="buscar">
    <div class="filabusqueda">
         <div class="filabusquedali primerafila" style="width:339px">
             <div class="label" style="width:50px">Rol&nbsp;</div>
             <div class="componente padtop3">
                  <select name="idrol" class="listwizard selectwizard" onchange="javascript:document.buscar.submit();">
                      <option value="">Selecionar Rol</option>
                      {section name=rol loop=$arrayRoles}
                         <option value="{$arrayRoles[rol].idrol}" {if $arrayRoles[rol].idrol == $idrol}selected{/if}>{$arrayRoles[rol].nombrerol}</option>
                      {/section}
                   </select>             
             </div>
             <div class="limpiar"></div>
         </div>
         <div class="filabusquedali primerafila" style="width:339px">
             <div class="label" style="width:50px">Perfil&nbsp;</div>
             <div class="componente padtop3">
                  <select name="idperfil" class="listwizard selectwizard" onchange="javascript:document.buscar.submit();">
                      <option value="">Selecionar Perfil</option>
                      {section name=perfil loop=$arrayPerfiles}
                         <option value="{$arrayPerfiles[perfil].idperfil}" {if $arrayPerfiles[perfil].idperfil == $idperfil}selected{/if}>{$arrayPerfiles[perfil].nombre}</option>
                      {/section}
                   </select>             
             </div>
             <div class="limpiar"></div>
         </div>
         <div class="limpiar"></div>
      </div><!--filabusqueda-->                        
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:125px">Nombre</div>
           <div  class="filaencabezadoli primerafila" style="width:75px">Login</div> 
           <div  class="filaencabezadoli" style="width:90px; text-align:center">Rol</div>
           <div  class="filaencabezadoli" style="width:80px; text-align:center">Perfil</div>
           <div  class="filaencabezadoli" style="width:175px; text-align:center">Correo</div> 
           <div  class="filaencabezadoli" style="width:159px; text-align:center">Acciones</div>
           <div class="limpiar"></div>
      </div><!--filaencabezado-->  
      <div class="listado">
       {if $arrayUsuarios != ''}
           {section name=usuario loop=$arrayUsuarios}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:125px">{$arrayUsuarios[usuario].nombreusuario}</div>
                <div class="filadatosli primerafila" style="width:75px">{$arrayUsuarios[usuario].nombre}</div> 
                <div class="filadatosli" style="width:90px; text-align:center">{$arrayUsuarios[usuario].rol}</span></div>
                <div class="filadatosli" style="width:80px; text-align:center">{$arrayUsuarios[usuario].perfil}</span></div> 
                <div class="filadatosli" style="width:175px; text-align:center">{$arrayUsuarios[usuario].email}</span></div>
                <div class="filadatosli noborde" style="width:160px; text-align:center" ><a href="{'/modulos/usuarios/usuarioedit.php/edit/'|cat:$arrayUsuarios[usuario].idusuario}"><img src="/imagenes/iconedit.png" alt="Editar Usuario" title="Editar Usuario" width="18" height="18" /></a>&nbsp;&nbsp;&nbsp;<a href="{'/modulos/usuarios/reset.php/'|cat:$arrayUsuarios[usuario].idusuario}"><img src="/imagenes/iconrefresh.png" alt="Cambiar Contrase&ntilde;a" title="Cambiar Contrase&ntilde;a" width="18" height="18" /></a>&nbsp;&nbsp;&nbsp;<a class="class2" href="{'/modulos/usuarios/index.php'|cat:'/'|cat:$arrayUsuarios[usuario].idusuario}"><img src="/imagenes/iconcancelar1.png" alt="Eliminar Usuario" title="Eliminar Usuario" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen Usuarios registrados en el Sistema</div>
      {/if}
    </div><!--listado-->   
    </form>                       
 </div><!--cajadatos-->