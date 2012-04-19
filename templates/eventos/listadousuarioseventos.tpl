<div id="cajadatos"> 
	<div id="contenidowizard">
	   <div class="headerwizardizq">{$titular|upper}</div>
       <div class="limpiar"></div>  
	</div><!--contenidowizard-->
    
    <div class="filabusqueda">
         <div class="filabusquedali primerafila" style="width:339px">
             <div class="label" style="width:50px">Rol:&nbsp;</div>
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
             <div class="label" style="width:50px">Perfil:&nbsp;</div>
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
           <div  class="filaencabezadoli primerafila" style="width:555px">Usuarios</div> 
           <div  class="filaencabezadoli" style="width:110px; text-align:center">Acciones</div>
           <div class="limpiar"></div>
      </div><!--filaencabezado-->  
      <div class="listado">
       {if $arrayTrazas != ''}
           {section name=traza loop=$arrayTrazas}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:555px">{$arrayTrazas[traza].nombreusuario}</div> 
                <div class="filadatosli noborde" style="width:110px; text-align:center" ><a href="{'/modulos/eventos/usuarioeventos.php/'|cat:$arrayTrazas[traza].nombreusuario}"><img src="/imagenes/opciones.png" alt="Ver Trazas" title="Ver Trazas" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
            </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen Trazas registradas en el Sistema</div>
      {/if}
    </div><!--listado--> 
</div><!--cajadatos-->