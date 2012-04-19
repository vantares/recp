{literal}
<script type="text/javascript">  
$().ready(function() {
    // validate signup form on keyup and submit
    $("#formedit").validate({
        rules: {
            nombrerol: "required",
            definicion: "required"     
        },
        messages: {
            nombreusuario: "Introduzca el nombre del Rol",
            definicion: "Introduzca la definici&oacute;n del rol"
        }
    });
});
</script>
<script type="text/javascript">
function f_setlist(firstlist,secondlist,combo)
{
first = firstlist;
second = secondlist;
//first = eval("document.formedit." + firstlist);
//second = eval("document.formedit." + secondlist);
com = eval("document.formedit." + combo);
 for (i=0;i < first.options.length;i++)
 {
  if (first.options[i].selected == true)
   {
     exit = false;
     for (j=0; j< second.options.length;j++)
     {
       second.options[j].selected = true;
       if (first.options[i].text == second.options[j].text)
       {
         exit = true;
         j = second.options.length;
       }
       
     }
     if (exit == false)
     {
     ins = first.options[i].text;
     val = first.options[i].value;
     pos = second.options.length;
     second.options[pos]= new Option(ins,val);
     com.checked = true;
     }
   }
 }
}

function del_list(secondlist,combo)
{
second = secondlist;
//second = eval("document.formedit." + secondlist);
com = eval("document.formedit." + combo);
 for (i=0;i < second.options.length;i++)
 {
  if (second.options[i].selected == true)
   {
      second.options[i] = null;
      i--;
   }
 }
if (second.options.length == 0)
{com.checked = false;}
}
function fchecked() {
     if(document.formedit.projectstatus.options.length == 0) this.checked = false; else {this.checked = true;}
}
</script>  
{/literal}

<div id="cajadatos"> 
	<form class="cmxform" id="formedit" method="post" action="" name="formedit">
		<div id="contenidowizard">
		   <div class="headerwizardizq">{$titular|upper}</div> 
		   <div id="opciones">
				 <a href="/modulos/roles/">Listado de Roles</a>
		   </div><!--opciones--> 
		   <div class="limpiar"></div>
		</div><!--contenidowizard--> 
		
	    <div class="formulario">		
          <div class="filaform">
              <div class="label">Nombre:</div>
              <div class="component">
                  <input name="nombrerol" id="nombrerol" type="text" class="listwizard selectwizard" style="width:200px;" value="{$rol->request.nombrerol}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
		  
		  <div class="filaform">
              <div class="label">Definici&oacute;n:</div>
              <div class="component">
                  <input name="definicion" id="definicion" type="text" size="10" class="listwizard selectwizard" style="width:200px;" value="{$rol->request.definicion}"/> 
                  <div class="limpiar"></div>
              </div>
              <div class="limpiar"></div>
          </div><!--filaform-->
		  
		  <div class="wizardcampos">
			  <div class="headerwizardizq">Todas las &aacute;reas</div>
			  <div class="limpiar"></div>
			  <div class="wizardcampolist">
				  <div class="listwizardizq">
                      <input type="checkbox" id="pro_status" onclick="javascript:fchecked()">
					  <select id="areas" name="areas" size="5" style="width:230px;" class="listwizard" multiple="multiple">
						{section name=area loop=$arrayAreas}
							<option value="{$arrayAreas[area].idarea}">{$arrayAreas[area].nombre}</option>
						{/section}
					  </select>
				  </div><!--listwizardizq-->
				  <div class="listwizardder">
                     <input type="button" class="buttonderdoblelist"  onclick="javascript: f_setlist(document.formedit.areas,document.formedit.rolareas,'pro_status')"><br>
                     <input type="button"  class="buttonizqdoblelist"  onclick="javascript: del_list(document.formedit.rolareas,'pro_status')">
				  </div><!--listwizardder-->
			  </div><!--wizardcampolist-->
			  <div class="limpiar"></div>
		  </div><!--wizardcampo-->
		  <div class="wizardcampos" style="margin-left:10px;" >
			  <div class="headerwizardizq">&Aacute;reas del Rol</div>
			  <div class="limpiar"></div>
			  <div class="wizardcampolist">
				  <div class="listwizardizq">
					  <select id="rolareas" name="rolareas[]" size="5" style="width:250px;" class="listwizard" multiple="multiple">
						{section name=area loop=$arrayRolAreas}
							<option value="{$arrayRolAreas[area].idarea}">{$arrayRolAreas[area].nombre}</option>
						{/section}
					  </select>
				  </div><!--listwizardizq-->
			  </div><!--wizardcampolist-->
			  <div class="limpiar"></div>
		  </div><!--wizardcampo-->
		  <div class="limpiar"></div>
		  
		  <div class="wizardcampos">
			  <div class="headerwizardizq">Privilegios</div>
			  <div class="limpiar"></div>
			  <div class="wizardcampolist">
				  <div class="listwizardizq">
                      <input type="checkbox" id="pro_status" onclick="javascript:fchecked()">
					  <select id="privilegios" name="privilegios[]" size="5" style="width:230px;" class="listwizard" multiple="multiple">
						{section name=privilegio loop=$arrayPrivilegios}
							<option value="{$arrayPrivilegios[privilegio].idprivilegio}">{$arrayPrivilegios[privilegio].nombre}</option>
						{/section}
					  </select>
				  </div><!--listwizardizq-->
				  <div class="listwizardder">
                     <input type="button" class="buttonderdoblelist"  onclick="javascript: f_setlist(document.formedit.privilegios,document.formedit.privilegiosasignados,'pro_status')"><br>
                     <input type="button"  class="buttonizqdoblelist"  onclick="javascript: del_list(document.formedit.privilegiosasignados,'pro_status')">
				  </div><!--listwizardder-->
			  </div><!--wizardcampolist-->
			  <div class="limpiar"></div>
		  </div><!--wizardcampo-->
		  <div class="wizardcampos" style="margin-left:10px;" >
			  <div class="headerwizardizq">Privilegios Asignados</div>
			  <div class="limpiar"></div>
			  <div class="wizardcampolist">
				  <div class="listwizardizq">
					  <select id="privilegiosasignados[]" name="privilegiosasignados" size="5" style="width:250px;" class="listwizard" multiple="multiple">
						{section name=privilegio loop=$arrayPrivilegiosAsignados}
							<option value="{$arrayPrivilegiosAsignados[privilegio].idprivilegio}">{$arrayPrivilegiosAsignados[privilegio].nombre}</option>
						{/section}
					  </select>
				  </div><!--listwizardizq-->
			  </div><!--wizardcampolist-->
			  <div class="limpiar"></div>
		  </div><!--wizardcampo-->
		  <div class="limpiar"></div>
		  
		  <div class="filadatos noborde" style="float:right">
            <input class=" asistenciabutton submit" type="submit"  name="salvar" value="Salvar"/>  
            <input name="idrol" type="hidden" value="{$rol->request.idrol}"/>
            <div class="limpiar"></div>
          </div><!--filadatos-->
		</div><!--formulario-->
    </form>	
</div><!--cajadatos-->