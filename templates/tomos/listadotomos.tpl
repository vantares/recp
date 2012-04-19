<div id="cajadatos">         
   <div id="contenidowizard">
       <div class="headerwizardizq">{$titular|upper}</div> 
       <div id="opciones">
             <a href="/modulos/librosregistrales">Libros Registrales</a>
       </div><!--opciones--> 
       <div id="opciones">
             <a href="/modulos/tomos/edittomo.php/add">Nuevo</a>
       </div><!--opciones--> 
       <div class="limpiar"></div>
   </div><!--contenidowizard-->
    <form action="" method="post" name="buscar">
    <div class="filabusqueda">
         <div class="filabusquedali primerafila" style="width:339px">
             <div class="label" style="width:50px">Estado</div>
             <div class="componente padtop3">
                  <select name="estado" class="listwizard selectwizard" onchange="javascript:document.buscar.submit();">
                      <option value="">Selecionar Estado</option>
                      <option value="abierto" {if $estado == 'abierto'} selected {/if}>Abierto</option>
                      <option value="cerrado" {if $estado == 'cerrado'} selected {/if}>Cerrado</option> 
                   </select>             
             </div>
             <div class="limpiar"></div>
         </div>
         <div class="limpiar"></div>
      </div><!--filabusqueda-->                        
      <div class="filaencabezado">
           <div  class="filaencabezadoli primerafila" style="width:5%">Codigo</div>
           <div  class="filaencabezadoli primerafila" style="width:7%">N&uacute;mero</div> 
           <div  class="filaencabezadoli" style="width:10%; text-align:center">Estado</div>
           <div  class="filaencabezadoli" style="width:10%; text-align:center">A&ntilde;o</div>
           <div  class="filaencabezadoli" style="width:10%; text-align:center">Cant Partidas</div> 
           <div  class="filaencabezadoli" style="width:10%; text-align:center">Cant Folios</div>
           <div  class="filaencabezadoli" style="width:12%; text-align:center">Fecha Apertura</div>
           <div  class="filaencabezadoli" style="width:12%; text-align:center">Fecha Cierre</div> 
           <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div>
           <div class="limpiar"></div>
      </div><!--filaencabezado-->
      <div class="listado">
       {if $arrayTomos != ''}
           {section name=tomo loop=$arrayTomos}
            <div class="filadatos">
                <div class="filadatosli primerafila" style="width:5%">{$arrayTomos[tomo].idtomo}</div>
                <div class="filadatosli primerafila" style="width:7%">{$arrayTomos[tomo].numero}</div> 
                <div class="filadatosli" style="width:10%; text-align:center">{$arrayTomos[tomo].estado}</div>
                <div class="filadatosli" style="width:10%; text-align:center">{$arrayTomos[tomo].anyo}</div> 
                <div class="filadatosli" style="width:10%; text-align:center">{$arrayTomos[tomo].cantpartidas}</div> 
                <div class="filadatosli" style="width:10%; text-align:center">{$arrayTomos[tomo].cantfolios}</div> 
                <div class="filadatosli" style="width:12%; text-align:center">{$arrayTomos[tomo].fechaapertura}</div>
                <div class="filadatosli" style="width:12%; text-align:center">{$arrayTomos[tomo].fechacierre}</div>
                <div align="center" class="filadatosli noborde" style="width:20%;">
                    <div style="float:left; width:auto; padding-right:3px;padding-left:3px;"><a href="{'/actas.php?acta=apertura&idtomo='|cat:$arrayTomos[tomo].idtomo}" target="_blank"><img src="/imagenes/iconactaapertura.png" alt="acta apertura" title="acta apertura" width="25" height="25" /></a></div>
                    <div style="float:left; width:auto; padding-right:3px;padding-left:3px;"><a href="{'/modulos/tomos/partidas_registradas/'|cat:$arrayTomos[tomo].idtomo}"><img src="/imagenes/iconpartidas.png" alt="partidas registradas" title="partidas registradas" width="25" height="25" /></a></div>
                    {if $arrayTomos[tomo].cantpartidas > 0 && $arrayTomos[tomo].estado != 'cerrado'}
                         <div style="float:left; width:auto; padding-right:3px;padding-left:3px;"><a href="{'/modulos/tomos/cerrartomo.php/'|cat:$arrayTomos[tomo].idtomo}"><img src="/imagenes/iconaspirantes.png" alt="cerrar tomo" title="cerrar tomo" width="25" height="19" /></a></div>
                    {/if}
                    {if $arrayTomos[tomo].estado == 'cerrado'} 
                        <div style="float:left; width:auto; padding-right:3px;padding-left:3px;"><a href="{'/actas.php?acta=indice&idtomo='|cat:$arrayTomos[tomo].idtomo}" target="_blank"><img src="/imagenes/iconindice.png" alt="acta indice" title="acta indice" width="25" height="25" /></a></div>
                        <div style="float:left; width:auto; padding-right:3px;padding-left:3px;"><a href="{'/actas.php?acta=cierre&idtomo='|cat:$arrayTomos[tomo].idtomo}" target="_blank"><img src="/imagenes/iconcierre.png" alt="acta de cierre" title="acta de cierre" width="25" height="25" /></a></div>
                    {/if}
                </div>
                <div class="limpiar"></div>
          </div><!--filadatos-->
          {/section}
      {else}
         <div class="noresults">No existen Tomos registrados en este libro</div>
      {/if}
    </div><!--listado-->   
    </form>                       
 </div><!--cajadatos-->