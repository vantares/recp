<table style="border-collapse:collapse; border: solid 1px #666666;">
<caption>Incripciones de: </caption>
<thead>
<tr class="filaencabezado">
<th style="width:7%">Tomo</th>
<th style="width:7%">Folio</th>
<th style="width:7%">Partida</th>
<th style="width:30%">Inscritos</th>
<th style="width:7%">Accciones</th>
</tr>
</thead>
<tbody>
{foreach item=inscripcion from=$inscripciones}
<tr class="filadatos">
<td>{$inscripcion.numero}</td>
<td>{$inscripcion.folio}</td>
<td>{$inscripcion.partida}</td>
<td>{$inscripcion.inscrito1nombre1}</td>
<td><a href="#" rel="{$inscripcion.idinscripcion}" class="addasresponse"><img src="/imagenes/iconpartidas.png"/></a></td>
</tr>
{/foreach}
</tbody>
</table>

