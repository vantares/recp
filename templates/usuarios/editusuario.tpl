{literal}
<script type="text/javascript">
$().ready(function() {
    // validate signup form on keyup and submit
    $("#formedit").validate({
        rules: {
            nombre: "required",
            nombreusuario: "required",    
            email: {
                required: true,
                email: true            
            },
            idperfil: "required",  
            idrol: "required",
            clave: {
                required: true
            },
            confpass: {
                required: true,
                equalTo: "#clave"
            }     
        },
        messages: {
            nombreusuario: "Introduzca el nombre del Usuario",
            nombre: "Introduzca el login del Usuario",        
            clave: "Introduzca la contrase&ntilde;a",
            confpass: {
                required: "Introduzca la confirmaci&oacute;n de la contrase&ntilde;a",
                equalTo: "La contrase&ntilde;a y la confirmaci&oacute;n deben coincidir"
            }, 
            email: "Introduzca un correo valido",
            idperfil: "Introduzca el perfil al cual pertenece el Usuario",
            idrol: "Introduzca el rol que ocupa el Usuario"
        }
    });
});
</script> 
{/literal}
<div id="cajadatos">  
    <form class="cmxform" id="formedit" method="post" action="">
      <div id="contenidowizard">
           <div class="headerwizardizq">{$titular|upper}</div>   
           <div id="opciones">
                 <a href="{'/modulos/usuarios/'}">Listado Usuarios</a>
           </div><!--opciones--> 
           {if $args[1] == "edit"}
           <div id="opciones">
                 <a href="/modulos/usuarios/reset.php/{$usuario->request.idusuario}">Cambiar Contrase&ntilde;a</a>
           </div><!--opciones-->
           {/if}
           <div class="limpiar"></div>
       </div><!--contenidowizard--> 
       <div class="limpiar"></div>

       <div class="formulario">
          <div class="filaform">
              <div class="label">Nombre:</div>
              <div class="component">
                  <input name="nombreusuario" id="nombreusuario" type="text" class="listwizard selectwizard" style="width:200px;" value="{$usuario->request.nombreusuario}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Login:</div>
              <div class="component">
                  <input name="nombre" id="nombre" type="text" class="listwizard selectwizard" value="{$usuario->request.nombre}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          {if $args[1] != "edit"}
          <div class="filaform">
              <div class="label">Contrase&ntilde;a:</div>
              <div class="component">
                  <input name="clave" id="clave" type="password" class="listwizard selectwizard" value=""/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Confirmar Contrase&ntilde;a:</div>
              <div class="component">
                  <input name="confpass" id="confpass" type="password" class="listwizard selectwizard" value=""/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
          {/if}
          <div class="filaform">
              <div class="label">Pregunta:</div>
              <div class="component">
                  <input name="preguntaconfirmacion" id="preguntaconfirmacion" type="text" class="listwizard selectwizard" style="width:200px;" value="{$usuario->request.preguntaconfirmacion}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Respuesta:</div>
              <div class="component">
                  <input name="respuestaconfirmacion" id="respuestaconfirmacion" type="text" class="listwizard selectwizard" style="width:200px;" value="{$usuario->request.respuestaconfirmacion}"/>
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Correo:</div>
              <div class="component">
                  <input name="email" id="email" type="text" class="listwizard selectwizard" style="width:200px;" value="{$usuario->request.email}"/>
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Perfil:</div>
              <div class="component">
                  <select name="idperfil" id="idperfil"  class="listwizard selectwizard" >
                     <option value="">Selecionar Perfil</option>
                     {section name=perfil loop=$arrayPerfiles}
                        <option value="{$arrayPerfiles[perfil].idperfil}" {if $arrayPerfiles[perfil].idperfil == $usuario->request.idperfil}selected{/if}>{$arrayPerfiles[perfil].nombre}</option>
                     {/section}
                  </select>
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Rol:</div>
              <div class="component">
                 <select name="idrol" id="idrol" class="listwizard selectwizard" >
                     <option value="">Selecionar Rol</option>
                     {section name=rol loop=$arrayRoles}
                        <option value="{$arrayRoles[rol].idrol}" {if $arrayRoles[rol].idrol == $usuario->request.idrol}selected{/if}>{$arrayRoles[rol].nombrerol}</option>
                     {/section}
                  </select>
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filaform">
              <div class="label">Estado:</div>
              <div class="component">
                  <input type="checkbox" name="check" id="check" {if $usuario->request.estado == 'A'}checked {/if} value="A" />&nbsp;&nbsp;Activo
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
 
          <div class="filadatos noborde" style="float:right">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="idusuario" type="hidden" value="{$usuario->request.idusuario}"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->
               
     </div><!--formulario-->
    </form>
 </div>