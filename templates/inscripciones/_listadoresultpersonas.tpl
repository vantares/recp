{literal}
<script type="text/javascript">
$(document).ready(function() {
    $("#listado" + $("#tipo").val()).click(function(evento){
        if(evento.target.id != '') {
            evento.preventDefault();   
            nombre = evento.target.id.split('_'); 
            $("#cargar_adicionar_" + nombre[1]).css("display", "inline");
            $("#" + $("#tipo").val()).load("__cargarpersona.php", {tipo: $("#tipo").val(), idpersona: $("#idpersona_" + nombre[1]).val(), template: 'inscripciones/_' + $("#tipo").val() + '.tpl'},
            function(){
                $("#cargar_adicionar_" + nombre[1]).css("display", "none"); 
            });
        }
    }); 
});
</script>
{/literal} 
{if $arrayresultados}
    <div class="cabecera"><h3>Resultados de la Busqueda</h3></div> 
    <div id="{'listado'|cat:$tipo}">
         <div class="filaencabezado">
               <div  class="filaencabezadoli primerafila" style="width:10%">cedula</div>
               <div  class="filaencabezadoli" style="width:47%; text-align:center">Nombre</div>
               <div  class="filaencabezadoli" style="width:15%; text-align:center">Acciones</div> 
               <div class="limpiar"></div>
          </div><!--filaencabezado-->
          <div class="listado noheight">
               {section name=i loop=$arrayresultados}   
                <div class="filadatos">
                    <div class="filadatosli primerafila" style="width:10%">{$arrayresultados[i].cedula}</div>
                    <div class="filadatosli" style="width:47%; text-align:center">{$arrayresultados[i].nombre1|cat:' '|cat:$arrayresultados[i].nombre2|cat:' '|cat:$arrayresultados[i].apellido1|cat:' '|cat:$arrayresultados[i].apellido2}</div> 
                    <div class="filadatosli noborde" style="width:15%; text-align:center" >
                       <div  class="floatleft icons">  
                          <a href="#" ><img  src="/imagenes/iconadd.png" id="{'adicionar_'|cat:$smarty.section.i.iteration}" alt="adicionar" title="adicionar" width="27" height="22" /></a>
                       </div>  
                        <div  id="{'cargar_adicionar_'|cat:$smarty.section.i.iteration}" style="display:none"; class="floatleft icons">  
                            <img  src="/imagenes/icon-ajax-loading.gif" alt="adicionar" title="adicionar" width="16" height="16" />
                            <input  type="hidden"  name="{'idpersona_'|cat:$smarty.section.i.iteration}" id="{'idpersona_'|cat:$smarty.section.i.iteration}" value="{$arrayresultados[i].idpersona}"/>  
                       
                       </div>                       
                       <div class="limpiar"></div>  
                    </div>                
                    <div class="limpiar"></div>
              </div><!--filadatos-->
              {/section}
              <input  type="hidden"  id="tipo" name="tipo" value="{$tipo}"/> 
        </div><!--listado-->       
    </div>
    <div class="limpiar"></div> 
{/if}  