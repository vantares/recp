<fieldset>
    <legend>{$encabezado}</legend>
      <div id="cargando_inscrito" style="display:none; color: green;">Cargando...</div>
      <div id="inscrito">
         {include file="inscripciones/_inscrito.tpl"}
      </div>
       <input type="hidden" name="titulo" value="{$titulo}"  size=5 /> 
</fieldset>