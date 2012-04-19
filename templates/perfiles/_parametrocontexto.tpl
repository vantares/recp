<div class="formulario">
     <form class="cmxform" id="formedit3" method="post" action="/modulos/perfiles/configuracioncontexto.php" name="formedit3"> 
      
      <div class="filaform">
          <div class="label">Par&aacute;metro:</div>
          <div class="component">
              <select name="idparametro2" id="idparametro2"  class="listwizard selectwizard" >
                 <option value="">Seleccionar Parametro</option>
                 {section name=parametro loop=$arrayParametros}
                    <option value="{$arrayParametros[parametro].idparametro}" {if $arrayParametros[parametro].idparametro == $parametro->request.idparametro}selected{/if}>{$arrayParametros[parametro].definicion}</option>
                 {/section}
              </select>
              <div class="limpiar"></div>
          </div>
          <div class="limpiar"></div>
      </div><!--filaform-->
      
      <div class="filaform">
          <div class="label">Contexto:</div>
          <div class="component">
              <select name="idcontexto" id="idcontexto"  class="listwizard selectwizard" >
                 <option value="">Seleccionar Contexto</option>
                 {section name=contexto loop=$arrayContextos}
                    <option value="{$arrayContextos[contexto].idcontexto}" {if $arrayContextos[contexto].idcontexto == $contexto->request.idcontexto}selected{/if}>{$arrayContextos[contexto].descripcion}</option>
                 {/section}
              </select>
              <div class="limpiar"></div>
          </div>
          <div class="limpiar"></div>
      </div><!--filaform-->
      
      <div class="filaform">
          <div class="label">Valor:</div>
          <div class="component">
              <input name="valor" id="valor" type="text" size="10" class="listwizard selectwizard" style="width:200px;" value="{$confcontexto->request.valor}"/> 
              <div class="limpiar"></div>
          </div>
          <div class="limpiar"></div>
      </div><!--filaform-->
      
      <div class="filadatos noborde" style="padding-left:350px">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="idparametro" type="hidden" value="{$confcontexto->request.idparametro}"/>
            <input name="idcontexto" type="hidden" value="{$confcontexto->request.idcontexto}"/> 
            <div class="limpiar"></div>
      </div><!--filadatos-->
      </form>
      <div class="limpiar"></div> 
                          
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:555px">Nombre del Par&aacute;metro</div> 
           <div  class="filaencabezadoli" style="width:149px; text-align:center">Acciones</div>
           <div class="limpiar"></div>
      </div><!--filaencabezado-->  
      <div class="listado">
       {if $arrayParametros != ''}
           {section name=parametro loop=$arrayParametros}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:555px">{$arrayParametros[parametro].definicion}</div> 
                <div class="filadatosli noborde" style="width:149px; text-align:center" ><a href="{'/modulos/perfiles/editperfil.php/edit/'|cat:$arrayParametros[parametro].idparametro}"><img src="/imagenes/iconedit.png" alt="Editar Parametro" title="Editar Parametro" width="18" height="18" /></a>&nbsp;&nbsp;&nbsp;<a class="class2" href="{'/modulos/perfiles/'|cat:$arrayParametros[parametro].idparametro}"><img src="/imagenes/iconcancelar1.png" alt="Eliminar Par&aacute;metro" title="Eliminar Par&aacute;metro" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
            </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen par&aacute;metros registrados en el Sistema</div>
      {/if}
      </div><!--listado--> 
</div>