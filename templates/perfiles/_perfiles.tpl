{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkmadre").click(function(evento){
       evento.preventDefault();   
       $("#cargando1").css("display", "inline");
       $("#perfiles").load("addperfil.php", {idperfil: document.inscripcion.idperfil.value, template: 'perfiles/_perfiles.tpl', tipo: 'perfil', accion: 'edit'}, function(){
            $("#cargando1").css("display", "none"); 
       });
    }); 
});
</script>
{/literal}
<div class="formulario">
     <form class="cmxform" id="formedit" method="post" action="" name="formedit"> 
     <div class="filaform">
          <div class="label">Nombre:</div>
          <div class="component">
              <input name="nombre" id="nombre" type="text" class="listwizard selectwizard" style="width:200px;" value="{$perfil->request.nombre}"/> 
              <div class="limpiar"></div>
          </div>
          <div class="limpiar"></div>
      </div><!--filaform-->
      
      <div class="filaform">
          <div class="label">Definici&oacute;n:</div>
          <div class="component">
              <input name="descripcion" id="descripcion" type="text" size="10" class="listwizard selectwizard" style="width:200px;" value="{$perfil->request.descripcion}"/> 
              <div class="limpiar"></div>
          </div>
          <div class="limpiar"></div>
      </div><!--filaform--> 
      <div class="filadatos noborde" style="padding-left:350px">
            <input class=" asistenciabutton submit" type="submit" id="salvar"  name="salvar" value="Salvar"/>  
            <input name="idperfil" type="hidden" value="{$perfil->request.idperfil}"/>
            <div class="limpiar"></div>
      </div><!--filadatos-->
      </form>
</div>