<fieldset>
    <div id="cargar_matrimonio" style="display:none; color: green;">Cargando...</div>
    <div>{include file="inscripciones/_matrimonio.tpl"}</div>
</fieldset>   
<br />         
<fieldset>
    <legend>CONYUGES</legend>
       <div id="cargando_conyuge1" style="display:none; color: green;">Cargando...</div>
       <div id="conyuge1">
          {include file="inscripciones/_conyuge1.tpl"}
       </div>
       <div id="cargando_conyuge2" style="display:none; color: green;">Cargando...</div>
       <div id="conyuge2">{include file="inscripciones/_conyuge2.tpl"}</div>
</fieldset>       
<br /> 
<fieldset>
    <legend>COMPARECIENTES</legend>
       <div id="cargando1" style="display:none; color: green;">Cargando...</div>
       <div id="comparecientes1">
          {include file="inscripciones/_comparecientes1.tpl"}
       </div>
</fieldset>
<br />
 <fieldset>
    <legend>Inscripciones Nacimiento</legend>
       <div id="cargando_nacimiento1" style="display:none; color: green;">Cargando...</div>
       <div id="datosnacimiento1">
          {include file="inscripciones/_nacimientoconyuge1.tpl"}
       </div>
       <div id="cargando_nacimiento2" style="display:none; color: green;">Cargando...</div>
       <div id="datosnacimiento2">{include file="inscripciones/_nacimientoconyuge2.tpl"}</div>
</fieldset> 
<br />
{if $etiqueta == 'edit' || $visiblehijo} 
<br />
<div>  
    <label><b>HIJOS RECONOCIDOS</b></label>
</div>
<fieldset id="hijos" class="{if $visiblehijo} visible  {else} oculto {/if}">
    <legend>Hijos</legend>
        {if $visiblehijo}
        <div id="listadoreco">
             <div class="filaencabezado">
                   <div  class="filaencabezadoli primerafila" style="width:10%">inscripcion</div>
                   <div  class="filaencabezadoli primerafila" style="width:7%">Tomo</div> 
                   <div  class="filaencabezadoli" style="width:7%; text-align:center">Folio</div>
                   <div  class="filaencabezadoli" style="width:40%; text-align:center">Nombre</div>
                   <div  class="filaencabezadoli" style="width:17%; text-align:center">&nbsp;</div> 
                   <div  class="filaencabezadoli" style="width:15%; text-align:center">&nbsp;</div> 
                   <div class="limpiar"></div>
              </div><!--filaencabezado-->
              <div class="listado noheight">
               {if $reconocidosbd}
                   {section name=id loop=$reconocidosbd}
                    <div class="filadatos">
                        <div class="filadatosli primerafila" style="width:10%">{$reconocidosbd[id]->request.idinscripcion}</div>
                        <div class="filadatosli primerafila" style="width:7%">{$reconocidosbd[id]->request.tomo}</div> 
                        <div class="filadatosli" style="width:7%; text-align:center">{$reconocidosbd[id]->request.folio}</div>
                        <div class="filadatosli" style="width:40%; text-align:center">{$reconocidosbd[id]->request.nombrereconocido}</div> 
                        <div class="filadatosli" style="width:17%; text-align:center">&nbsp;</div>  
                        <div class="limpiar"></div>
                  </div><!--filadatos-->
                  {/section}
              {/if}
            </div><!--listado-->       
        </div>
        {/if}           
       
</fieldset> 
{/if}
<div class="filadatos noborde" style="float:right">
    {if $add == ''}
        <input  type="hidden"  name="idinscripcion" value="{$inscripcion->request.idinscripcion}"/>
        <input  type="hidden"  name="id" value="{$inscripcion->request.idinscripcion}"/>
        <input  type="hidden"  name="tipoinscripcion" value="{$tipo}"/> 
        <input  type="hidden"  name="numeroserie" value="{$inscripcion->request.numeroserie}"/> 
        <input  type="hidden"  name="municipioinscripcion" value="{$inscripcion->request.municipioinscripcion}"/>
        <input  type="hidden"  name="ciudadinscripcion" value="{$inscripcion->request.ciudadinscripcion}"/>
        <input  type="hidden"  name="departamentoinscripcion" value="{$inscripcion->request.departamentoinscripcion}"/>             
    {/if}
    {if $disabled == ''}
        <input class=" asistenciabutton submit" type="submit"  name="salvar" value="salvar"/>  
    {/if}    
    <div class="limpiar"></div>
  </div><!--filadatos--> 
</form> 