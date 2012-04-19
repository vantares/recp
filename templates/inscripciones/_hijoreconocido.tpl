{literal}
<script type="text/javascript">
$().ready(function() {
    $("#checkreconocido").click(function(evento){
       evento.preventDefault();   
       $("#cargando_reconocido").css("display", "inline");
       $("#reconocido").load("cargarreconocido.php", {idtomo: $("#tomo").val(), folio: $("#folio").val(), partida: $("#partida").val(), 
                                                      template: 'inscripciones/_listadoresultreconocidos.tpl', id: $("#idinscripcion").val(),
                                                      nombre1: $("#nombre1").val(), nombre2: $("#nombre2").val(), apellido1: $("#apellido1").val(),
                                                      apellido2: $("#apellido2").val(), fechanacimiento: $("#fechanacimiento").val(), lugarnacimiento: $("#lugarnacimiento").val()
                                                     },
                                                       
       function(){
            $("#cargando_reconocido").css("display", "none"); 
       });
    }); 
});
$(function() {
    $("#reconocidofechanacimiento").datetimepicker();
});
</script>
<script type="text/javascript"> 
$().ready(function() {
    // validate signup form on keyup and submit
    $("#addreconocido").validate({
        rules: {
            folio: {
                required: true,
                number: true               
            },
            tomo: {
                required: true,
                number: true               
            },            
            partida: {
                required: true,
                number: true            
            },
            fechanacimiento: {
                required: true,
                datetime: true            
            },
            nombrereconocido: "required"            
        },
        messages: {
            folio: "El folio tiene que ser un n&uacute;mero",
            tomo: "El tomo tiene que ser un n&uacute;mero",
            partida: "La partida tiene que ser un n&uacute;mero",
            fechanacimiento: "La fecha de nacimiento no es correcta",
            nombrereconocido:"El nombre no puede estar vacio"
        }
    });
});
</script>
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
<form name="addreconocido" action="__addreconocido.php" method="post" id="addreconocido">
<table width="80%">
    <tr>
        <td colspan="4">
          Si los datos del reconocido no estan registrados introduzcalos y de click en el boton adicionar<br>
          Si desea buscar algun reconocido introduzca los datos que tiene sobre el mismo y de click en chequear, escoger el
          reconocido en el listado resultante dando click en el icono.
        </td>
    </tr>
    <tr>
        <td>Hijo</td>
    </tr>
    <tr>  
        <td colspan="4" class="tcenter"><table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td class="tcenter" width="25%"><input type="text" id="tomo" name="tomo" value="" {$disabled}/></td>
            <td class="tcenter" width="25%"><input type="text" id="folio" name="folio" value=""  {$disabled}/></td>          
            <td width="15%">
                <span class="chequear">
                   <a href="#" id="checkreconocido">Chequear</a> 
                 </span>
            </td>
            <td width="35%"><div class="error">{$error}</div></td>
          </tr>
          <tr>
            <td>Tomo</td>
            <td>Folio</td> 
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>  
    <tr>
        <td class="tcenter"><input type="text" name="nombre1" id="nombre1" value="" {$disabled}/></td>
        <td class="tcenter"><input type="text" name="nombre2" id="nombre2" value=""  {$disabled}/></td>
        <td class="tcenter">
            <input type="text" name="apellido1" id="apellido1" value=""  {$disabled}/>
        </td>
        <td class="tcenter"><input type="text" id="apellido2" name="apellido2" value="" {$disabled}/></td>
    </tr>
    <tr>
        <td class="tcenter">Primer Nombre</td>
        <td class="tcenter">Segundo Nombre</td>
        <td class="tcenter">Primer Apellido </td>
        <td class="tcenter">Segundo Apellido</td>
    </tr>    
    <tr>
        <td class="tcenter"><input type="text" name="partida" id="partida" value="" {$disabled}/></td>
        <td class="tcenter"><input type="text" name="anyo"  id="anyo" value=""  {$disabled}/></td>
        <td class="tcenter">
            <input type="text" name="lugarnacimiento" id="lugarnacimiento" value=""  {$disabled}/>
        </td>
        <td class="tcenter"><input type="text" id="reconocidofechanacimiento" name="reconocidofechanacimiento" value="" {$disabled}/></td>
    </tr>
    <tr>
        <td class="tcenter">Partida</td>
        <td class="tcenter">a&ntilde;o</td>
        <td class="tcenter">Lugar Nacimiento </td>
        <td class="tcenter">Fecha Nacimiento</td>
    </tr>
</table>
<div class="filadatos noborde" style="float:right">
    <input  type="hidden"  id="idinscripcion" name="idinscripcion" value="{$idinscripcionmatrimonio}"/>
    {if $disabled == ''}
      <div style="padding-right:20px;">
        <input class=" asistenciabutton submit" type="submit"  id="add" name="add" value="adicionar"/> 
      </div>   
    {/if}    
    <div class="limpiar"></div>
</div><!--filadatos--> 
 <div class="limpiar"></div>  
<div id="reconocido"></div><!--reconocido-->
</form>
