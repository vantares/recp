
<div class="formulario">
     <form class="cmxform" id="formedit2" method="post" action="/modulos/perfiles/definicionperfil.php" name="formedit2"> 
      
      <div class="filaform">
          <div class="label">Par&aacute;metro:</div>
          <div class="component">
              <select name="idparametro1" id="idparametro"  class="listwizard selectwizard" >
                 <option value="">Seleccionar Parametro</option>
                 {section name=parametro loop=$arrayParametros}
                    <option value="{$arrayParametros[parametro].idparametro}" {if $arrayParametros[parametro].idparametro == $definicionperfil->request.idparametro}selected{/if}>{$arrayParametros[parametro].definicion}</option>
                 {/section}
              </select>
              <input name="parametro" type="hidden" />
			  <input name="idperfil" type="hidden" value="{$idperfil}"/>
              <div class="limpiar"></div>
          </div>
          <div class="limpiar"></div>
      </div><!--filaform-->
      
      <div class="filaform">
          <div class="label">Valor:</div>
          <div class="component">
              <input name="valor" id="valor" type="text" size="10" class="listwizard selectwizard" style="width:200px;" value="{$definicionperfil->request.valor}"/> 
              <div class="limpiar"></div>
          </div>
          <div class="limpiar"></div>
      </div><!--filaform-->
      
      <div class="filadatos noborde" style="padding-left:350px">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="idparametro" type="hidden" value="{$definicionperfil->request.idparametro}"/>
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
       {if $arrayDefiniciones != ''}
           {section name=definicion loop=$arrayDefiniciones}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:555px">{$arrayDefiniciones[definicion].idparametro}</div> 
                <div class="filadatosli noborde" style="width:149px; text-align:center" ><a href="{'/modulos/perfiles/editperfil.php/edit/'|cat:$arrayParametros[parametro].idparametro}"><img src="/imagenes/iconedit.png" alt="Editar Parametro" title="Editar Parametro" width="18" height="18" /></a>&nbsp;&nbsp;&nbsp;<a class="class2" href="{'/modulos/perfiles/'|cat:$arrayParametros[parametro].idparametro}"><img src="/imagenes/iconcancelar1.png" alt="Eliminar Par&aacute;metro" title="Eliminar Par&aacute;metro" width="18" height="18" /></a></div>
                <div class="limpiar"></div>
            </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen par&aacute;metros registrados en el Sistema</div>
      {/if}
      </div><!--listado--> 
</div>