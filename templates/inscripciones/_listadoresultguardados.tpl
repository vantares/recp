{literal}
<script type="text/javascript">
$(document).ready(function() {
    $("#listadoresultreco").click(function(evento){
        if(evento.target.id != '') {
            evento.preventDefault();   
            nombre = evento.target.id.split('_'); 
            $("#cargar_adicionar_" + nombre[1]).css("display", "inline");
		alert('text');
            $("#listadoreco").load("__addguardado.php", {inscripcionmatrimonio: $("#inscripcionmatrimonio").val(), idinscripcionnacimiento: $("#inscripcion_" + nombre[1]).val(), ajax:1},
            function(){
                $("#cargar_adicionar_" + nombre[1]).css("display", "none"); 
            });
        }
    }); 
});
</script>
{/literal} 
{if $arrayreconocidos}
    <div class="cabecera"><h3>Resultados de la Busqueda</h3></div> 
    <div id="listadoresultreco">
         <div class="filaencabezado">
               <div  class="filaencabezadoli primerafila" style="width:10%">inscripcion</div>
               <div  class="filaencabezadoli primerafila" style="width:7%">Tomo</div> 
               <div  class="filaencabezadoli" style="width:7%; text-align:center">Folio</div>
               <div  class="filaencabezadoli" style="width:7%; text-align:center">Partida</div> 
               <div  class="filaencabezadoli" style="width:33%; text-align:center">Nombre</div>
               <div  class="filaencabezadoli" style="width:17%; text-align:center">Fecha Nacimiento</div> 
               <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div> 
               <div class="limpiar"></div>
          </div><!--filaencabezado-->
          <div class="listado noheight">
               {section name=i loop=$arrayreconocidos}   
                <div class="filadatos">
                    <div class="filadatosli primerafila" style="width:10%">{$arrayreconocidos[i].idinscripcion}</div>
                    <div class="filadatosli primerafila" style="width:7%">{$arrayreconocidos[i].numero}</div> 
                    <div class="filadatosli" style="width:7%; text-align:center">{$arrayreconocidos[i].folio}</div>
                    <div class="filadatosli" style="width:7%; text-align:center">{$arrayreconocidos[i].partida}</div>
                    <div class="filadatosli" style="width:33%; text-align:center">{$arrayreconocidos[i].inscrito1nombre1|cat:' '|cat:$arrayreconocidos[i].inscrito1nombre2|cat:' '|cat:$arrayreconocidos[i].inscrito1apellido1|cat:' '|cat:$arrayreconocidos[i].inscrito1apellido2}</div> 
                    <div class="filadatosli" style="width:17%; text-align:center">{$arrayreconocidos[i].fechanacimiento}</div>  
                    <div class="filadatosli noborde" style="width:15%; text-align:center" >
                       <div  class="floatleft icons">  
                          <a href="#" ><img  src="/imagenes/iconadd.png" id="{'adicionar_'|cat:$smarty.section.i.iteration}" alt="adicionar" title="adicionar" width="27" height="22" /></a>
                       </div>  
                        <div  id="{'cargar_adicionar_'|cat:$smarty.section.i.iteration}" style="display:none"; class="floatleft icons">  
                            <img  src="/imagenes/icon-ajax-loading.gif" alt="adicionar" title="adicionar" width="16" height="16" />
                            <input  type="hidden"  name="{'inscripcion_'|cat:$smarty.section.i.iteration}" id="{'inscripcion_'|cat:$smarty.section.i.iteration}" value="{$arrayreconocidos[i].idinscripcion}"/>  
                       
                       </div>                       
                       <div class="limpiar"></div>  
                    </div>                
                    <div class="limpiar"></div>
              </div><!--filadatos-->
              {/section}
              <input  type="hidden"  id="inscripcionmatrimonio" name="inscripcionmatrimonio" value="{$idinscripcionmatrimonio}"/> 
        </div><!--listado-->       
    </div>
    <div class="limpiar"></div> 
{/if}  
