<?php
class notificacionTable extends Table {
  function notificacionTable() {
    $this->Table('notificacion');
    $this->key = 'idnotificacion';
    $this->title = 'Notificaciones';
    $this->maxrows = 20;
    $this->order = 'idnotificacion';
    $this->addColumn('idnotificacion','serial',0,1,0,'Id');
    $this->addColumn('serie','varchar',20,0,0,'Serie');
    $this->addColumn('tiponotificacion','varchar',20,0,0,'Tipo Notificacion');  
    $this->addColumn('lugarorigen','varchar',20,0,0,'Lugar Origen');  
    $this->addColumn('lugardestino','varchar',20,0,0,'Lugar Destino');
    $this->addColumn('municipio','varchar',30,0,0,'Municipio'); 
    $this->addColumn('departamento','varchar',20,0,0,'Departamento');  
    $this->addColumn('libroorigen','varchar',30,0,0,'Libro Origen'); 
    $this->addColumn('tomoorigen','int',0,0,0,'Tomo Origen');  
    $this->addColumn('folioorigen','int',0,0,0,'Folio Origen'); 
    $this->addColumn('partida','int',0,0,0,'Partida');
    $this->addColumn('fechainscripcionorigen','date',0,0,0,'Fecha Inscripcion Origen');
    $this->addColumn('cuerpo','text',0,0,0,'Cuerpo');
    $this->addColumn('librodestino','varchar',30,0,0,'Libro Destino');   
    $this->addColumn('tomodestino','int',0,0,0,'Tomo Destino');  
    $this->addColumn('foliodestino','int',0,0,0,'Folio Destino');  
    $this->addColumn('fechainscripciondestino','date',0,0,0,'Fecha Inscripcion Destino');  
    $this->addColumn('fechaexpedicion','date',0,0,0,'Fecha Inscripcion Destino');
    $this->addColumn('partidadestino','int',0,0,0,'Partida Destino'); 
    $this->addColumn('registrador','varchar',255,0,0,'Registrador'); 
    $this->addColumn('secretario','varchar',255,0,0,'Registrador');       
  }
}

//Doublekey
class despachoTable extends TableDoubleKey {
  function despachoTable() {
    $this->Table('despacho');
    $this->key1 = 'idnotificacion';
    $this->key2 = 'idinscripcion';
    $this->maxrows = 20;
    $this->title ='Despacho';
    $this->addColumn('idnotificacion','int',0,0,'notificacion','IdNotificacion'); 
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion'); 
  } 
} 


class inscripcionTable extends Table {  
  function inscripcionTable() {
    $this->Table('inscripcion');
    $this->key = 'idinscripcion';
    $this->title = 'Inscripciones';
    $this->maxrows = 20;
    $this->order = 'idinscripcion';
    $this->addColumn('idinscripcion','int',0,0,'asientoregistral','Id');
    $this->addColumn('numeroserie','varchar',20,0,0,'Serie');
    $this->addColumn('tipoinscripcion','varchar',50,0,0,'Tipo Incripcion');  
    $this->addColumn('inscrito1nombre1','varchar',30,0,0,'Inscrito 1 Nombre1'); 
    $this->addColumn('inscrito1nombre2','varchar',30,0,0,'Inscrito 1 Nombre2'); 
    $this->addColumn('inscrito1apellido1','varchar',30,0,0,'Inscrito 1 Apellido1'); 
    $this->addColumn('inscrito1apellido2','varchar',30,0,0,'Inscrito 1 Apellido2');
    $this->addColumn('ciudadinscripcion','varchar',30,0,0,'Ciudad Inscripcion');  
    $this->addColumn('municipioinscripcion','varchar',30,0,0,'Municipio Inscripcion');  
    $this->addColumn('departamentoinscripcion','varchar',30,0,0,'Departamento Inscripcion');   
    $this->addColumn('compareciente1nombre','varchar',30,0,0,'Compareciente1 Nombre'); 
    $this->addColumn('compareciente1edad','varchar',20,0,0,'Compareciente1 Edad');
    $this->addColumn('compareciente1oficio','varchar',30,0,0,'Compareciente1 Oficio'); 
    $this->addColumn('compareciente1domicilio','varchar',500,0,0,'Compareciente1 Domicilio');  
    $this->addColumn('compareciente1cedula','varchar',16,0,0,'Compareciente1 Cedula');   
    $this->addColumn('enextranjero','varchar',500,0,0,'En Extranjero');  
    $this->addColumn('observaciones','varchar',500,0,0,'Observaciones');    
    $this->addColumn('nombreregistrador','varchar',50,0,0,'Nombre Registrador');   
    $this->addColumn('nombresecretario','varchar',50,0,0,'Nombre Secretario'); 
    $this->addColumn('datosadicionales','varchar',500,0,0,'Datos Adicionales'); 
  }
}

class notamarginalTable extends Table {
  function notamarginalTable() {
    $this->Table('notamarginal');
    $this->key = 'idnotamarginal';
    $this->title = 'Notas Marginales';
    $this->maxrows = 20;
    $this->order = 'idnotamarginal';
    $this->addColumn('idnotamarginal','int',0,0,'asientoregistral','Id');
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion'); 
    $this->addColumn('actomodificador','varchar',50,0,0,'Acto Modificador');  
    $this->addColumn('lugarinscripcion','varchar',255,0,0,'Lugar Inscripcion');  
    $this->addColumn('libroinscripcion','varchar',50,0,0,'Libro Inscripcion');
    $this->addColumn('tomoinscripcion','int',0,0,0,'Tomo Inscripcion'); 
    $this->addColumn('folioinscripcion','int',0,0,0,'Folio Inscripcion');  
    $this->addColumn('partidainscripcion','int',0,0,0,'Partida Inscripcion'); 
    $this->addColumn('anyoinscripcion','int',0,0,0,'A?o Inscripcion'); 
    $this->addColumn('modificacion','text',0,0,0,'Modificacion'); 
    $this->addColumn('cuerpo','text',0,0,0,'Cuerpo');
    $this->addColumn('fechamarginacion','datetime',0,0,0,'fecha marginacion');
  }
}

//Doublekey
class recepcionTable extends TableDoubleKey {
  function recepcionTable() {
    $this->Table('recepcion');
    $this->key1 = 'idnotificacion';
    $this->key2 = 'idnotamarginal';
    $this->maxrows = 20;
    $this->title ='Recepcion';
    $this->addColumn('idnotificacion','int',0,0,'notificacion','IdNotificacion'); 
    $this->addColumn('idnotamarginal','int',0,0,'notamarginal','IdNotaMarginal');
  } 
} 

class disolucionmatrimonioTable extends Table {
  function disolucionmatrimonioTable() {
    $this->Table('disolucionmatrimonio');
    $this->key = 'iddisolucionmatrimonio';
    $this->title = 'Disoluciones de Matrimonio';
    $this->maxrows = 20;
    $this->order = 'iddisolucionmatrimonio';
    $this->addColumn('iddisolucionmatrimonio','int',0,0,'actojuridico','Id Disolucion matrimonio');
    $this->addColumn('inscrito2nombre1','varchar',30,0,0,'Inscrito 2 Nombre1'); 
    $this->addColumn('inscrito2nombre2','varchar',30,0,0,'Inscrito 2 Nombre2'); 
    $this->addColumn('inscrito2apellido1','varchar',30,0,0,'Inscrito 2 Apellido1'); 
    $this->addColumn('inscrito2apellido2','varchar',30,0,0,'Inscrito 2 Apellido2');
    $this->addColumn('conyuge1nombre','varchar',255,0,0,'Conyuge1 Nombre'); 
    $this->addColumn('conyuge1edad','varchar',20,0,0,'Conyuge1 Edad');  
    $this->addColumn('conyuge1oficio','varchar',30,0,0,'Conyuge1 Oficio'); 
    $this->addColumn('conyuge1estadocivilanterior','varchar',20,0,0,'Conyuge1 Estado Civil Anterior');  
    $this->addColumn('conyuge1nacionalidad','varchar',30,0,0,'Conyuge1 Nacionalidad');
    $this->addColumn('conyuge1domicilio','varchar',30,0,0,'Conyuge1 Domicilio');  
    $this->addColumn('conyuge1cedula','varchar',16,0,0,'Conyuge1 Cedula');  
    $this->addColumn('conyuge2nombre','varchar',255,0,0,'Conyuge2 Nombre'); 
    $this->addColumn('conyuge2edad','varchar',20,0,0,'Conyuge2 Edad');  
    $this->addColumn('conyuge2oficio','varchar',30,0,0,'Conyuge2 Oficio'); 
    $this->addColumn('conyuge2estadocivilanterior','varchar',20,0,0,'Conyuge2 Estado Civil Anterior');  
    $this->addColumn('conyuge2nacionalidad','varchar',30,0,0,'Conyuge2 Nacionalidad');
    $this->addColumn('conyuge2domicilio','varchar',30,0,0,'Conyuge2 Domicilio');  
    $this->addColumn('conyuge2cedula','varchar',16,0,0,'Conyuge2 Cedula');  
    $this->addColumn('custodionombre','varchar',255,0,0,'Custodio Nombre'); 
    $this->addColumn('pensionalimenticia','numeric',6.2,0,0,'Pension Alimentaria');
    $this->addColumn('tipoinmuebleafectado','varchar',10,0,0,'Tipo Inmueble Afectado'); 
    $this->addColumn('lugarregistroinmueble','varchar',50,0,0,'Lugar Registro Inmueble');
    $this->addColumn('tomoregistroinmueble','int',0,0,0,'Tomo Registro Inmueble');    
    $this->addColumn('folioregistroinmueble','int',0,0,0,'Folio Registro Inmueble'); 
    $this->addColumn('partidaregistroinmueble','int',0,0,0,'Partida Registro Inmueble'); 
    $this->addColumn('asientoregistroinmueble','int',0,0,0,'Tomo Registro Inmueble'); 
    $this->addColumn('propietarioinmueble','varchar',255,0,0,'Propietario Inmueble');  
    $this->addColumn('conyuge1lugarinscripcion','varchar',50,0,0,'Conyuge1 Lugar Inscripcion'); 
    $this->addColumn('conyuge1tomoinscripcion','int',0,0,0,'Conyuge1 Tomo Inscripcion');  
    $this->addColumn('conyuge1folioinscripcion','int',0,0,0,'Conyuge1 Folio Inscripcion');  
    $this->addColumn('conyuge1partidainscripcion','int',0,0,0,'Conyuge1 Partida Inscripcion');
    $this->addColumn('conyuge1anyoinscripcion','int',0,0,0,'Conyuge1 Anyo Inscripcion');     
    $this->addColumn('conyuge2lugarinscripcion','varchar',50,0,0,'Conyuge2 Lugar Inscripcion'); 
    $this->addColumn('conyuge2tomoinscripcion','int',0,0,0,'Conyuge2 Tomo Inscripcion');  
    $this->addColumn('conyuge2folioinscripcion','int',0,0,0,'Conyuge2 Folio Inscripcion');  
    $this->addColumn('conyuge2partidainscripcion','int',0,0,0,'Conyuge2 Partida Inscripcion');
    $this->addColumn('conyuge2anyoinscripcion','int',0,0,0,'Conyuge2 Anyo Inscripcion'); 
    $this->addColumn('tomomatrimonio','int',0,0,0,'Tomo Matrimonio');
    $this->addColumn('foliomatrimonio','int',0,0,0,'Folio Matrimonio'); 
    $this->addColumn('partidamatrimonio','int',0,0,0,'Partida Matrimonio');
  }
}

//Doublekey
class disolucionTable extends TableDoubleKey {
  function disolucionTable() {
    $this->Table('disolucion');
    $this->key1 = 'iddisolucionmatrimonio';
    $this->key2 = 'idinscripcion';
    $this->maxrows = 20;
    $this->title ='Disolucion';
    $this->addColumn('iddisolucionmatrimonio','int',0,0,'disolucionmatrimonio','Id Disolucion matrimonio'); 
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion');
  } 
}  

class correccionTable extends Table {
  function correccionTable() {
    $this->Table('correccion');
    $this->key = 'idcorreccion';
    $this->title = 'Correcciones';
    $this->maxrows = 20;
    $this->order = 'idcorreccion';
    $this->addColumn('idcorreccion','serial',0,1,0,'Id');
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion'); 
    $this->addColumn('testado','varchar',100,0,0,'Testado');
    $this->addColumn('entrelineado','varchar',100,0,0,'entrelineado');
  }
}

class documentodigitalTable extends Table {
  function documentodigitalTable() {
    $this->Table('documentodigital');
    $this->key = 'iddocumentodigital';
    $this->title = 'Documentos Digitales';
    $this->maxrows = 20;
    $this->order = 'iddocumentodigital';
    $this->addColumn('iddocumentodigital','serial',0,1,0,'Id');
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion');
    $this->addColumn('nombrearchivo','varchar',50,0,0,'Nombre Archivo');
    $this->addColumn('direccionlocal','varchar',255,0,0,'Direccion Local');
    $this->addColumn('url','varchar',255,0,0,'Url');
  }
}


class guardaTable extends Table {
  function guardaTable() {
    $this->Table('guarda');
    $this->key = 'idguarda';
    $this->title = 'Guardas';
    $this->maxrows = 20;
    $this->order = 'idguarda';
    $this->addColumn('idguarda','serial',0,1,0,'Id');
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion');
    $this->addColumn('nombrereconocido','varchar',255,0,0,'Nombre Reconocido');
    $this->addColumn('fechanacimiento','date',0,0,0,'Fecha Nacimiento');
    $this->addColumn('lugarnacimiento','varchar',50,0,0,'Lugar Nacimiento');
    $this->addColumn('tomo','int',0,0,0,'Tomo');
    $this->addColumn('folio','int',0,0,0,'Folio');
    $this->addColumn('partida','int',0,0,0,'Partida');
    $this->addColumn('anyo','int',0,0,0,'Partida'); 
  }
}

class reconocimientoTable extends Table {
  function reconocimientoTable() {
    $this->Table('reconocimiento');
    $this->key = 'idreconocimiento';
    $this->title = 'Reconocimiento';
    $this->maxrows = 20;
    $this->order = 'idreconocimiento';
    $this->addColumn('idreconocimiento','serial',0,1,0,'Id');
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion');
    $this->addColumn('nombrereconocido','varchar',255,0,0,'Nombre Reconocido');
    $this->addColumn('fechanacimiento','date',0,0,0,'Fecha Nacimiento');
    $this->addColumn('lugarnacimiento','varchar',50,0,0,'Lugar Nacimiento');
    $this->addColumn('tomo','int',0,0,0,'Tomo');
    $this->addColumn('folio','int',0,0,0,'Folio');
    $this->addColumn('partida','int',0,0,0,'Partida');
    $this->addColumn('anyo','int',0,0,0,'Partida'); 
  }
}

class personaTable extends Table {
  function personaTable() {
    $this->Table('persona');
    $this->key = 'idpersona';
    $this->title = 'Personas';
    $this->maxrows = 20;
    $this->order = 'idpersona';
    $this->addColumn('idpersona','serial',0,1,0,'id');
    $this->addColumn('nombre1','varchar',20,0,0,'Nombre1');
    $this->addColumn('nombre2','varchar',20,0,0,'Nombre2');
    $this->addColumn('apellido1','varchar',20,0,0,'Apellido1');  
    $this->addColumn('apellido2','varchar',20,0,0,'Apellido2'); 
    $this->addColumn('ocupacion','varchar',30,0,0,'Ocupacion'); 
    $this->addColumn('estadocivil','varchar',10,0,0,'Estado Civil'); 
    $this->addColumn('domicilio','varchar',500,0,0,'Domicilio');
    $this->addColumn('sexo','varchar',1,0,0,'Sexo'); 
    $this->addColumn('nacionalidad','varchar',50,0,0,'Nacionalidad');
    $this->addColumn('fechanacimiento','date',0,0,0,'Fecha Nacimiento');
    $this->addColumn('ciudadnacimiento','varchar',30,0,0,'Ciudad Nacimiento'); 
    $this->addColumn('municipionacimiento','varchar',30,0,0,'Municipio Nacimiento'); 
    $this->addColumn('departamentonacimiento','varchar',30,0,0,'Departamento Nacimiento'); 
    $this->addColumn('paisnacimiento','varchar',30,0,0,'Pais Nacimiento');  
  }
}

//Doublekey
class reconocidoTable extends TableDoubleKey {
  function reconocidoTable() {
    $this->Table('reconocido');
    $this->key1 = 'idpersona';
    $this->key2 = 'idreconocimiento';
    $this->maxrows = 20;
    $this->title ='Reconocido';
    $this->addColumn('idpersona','int',0,0,'persona','IdPersona'); 
    $this->addColumn('idreconocimiento','int',0,0,'reconocimiento','IdReconocimiento'); 
  } 
}  

//Doublekey
class participacionTable extends TableDoubleKey {
  function participacionTable() {
    $this->Table('participacion');
    $this->key1 = 'idpersona';
    $this->key2 = 'idinscripcion';
    $this->maxrows = 20;
    $this->title ='Participacion';
    $this->addColumn('idpersona','int',0,0,'persona','IdPersona'); 
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion'); 
    $this->addColumn('formaparticipacion','varchar',50,0,0,'Forma Participacion'); 
  } 
}  

//Doublekey
class guardadoTable extends TableDoubleKey {
  function guardadoTable() {
    $this->Table('guardado');
    $this->key1 = 'idpersona';
    $this->key2 = 'idguarda';
    $this->maxrows = 20;
    $this->title ='Guardado';
    $this->addColumn('idpersona','int',0,0,'persona','IdPersona'); 
    $this->addColumn('idguarda','int',0,0,'guarda','IdGuarda'); 
  } 
} 

class actojuridicoTable extends Table {
  function actojuridicoTable() {
    $this->Table('actojuridico');
    $this->key = 'idactojuridico';
    $this->title = 'Acto Juridico';
    $this->maxrows = 20;
    $this->order = 'idactojuridico';
    $this->addColumn('idactojuridico','int',0,0,'inscripcion','IdActoJuridico');
    $this->addColumn('jueznotario','varchar',255,0,0,'Juez Notario');
    $this->addColumn('nombrejuzgado','varchar',30,0,0,'Nombre Juzgado');
    $this->addColumn('lugarjuzgado','varchar',30,0,0,'Lugar Juzgado');
    $this->addColumn('fechadictament','datetime',0,0,0,'Fecha Dictament'); 
  }
}


class inscripcionvariaTable extends Table {
  function inscripcionvariaTable() {
    $this->Table('inscripcionvaria');
    $this->key = 'idinscripcionvaria';
    $this->title = 'Inscripciones Varias';
    $this->maxrows = 20;
    $this->order = 'idinscripcionvaria';
    $this->addColumn('idinscripcionvaria','int',0,0,'actojuridico','id');
    $this->addColumn('titulo','varchar',50,0,0,'Titulo'); 
    $this->addColumn('tipootrainscripcion','varchar',20,0,0,'Tipo Transcripcion'); 
    $this->addColumn('partesconducentes','varchar',500,0,0,'Partes Conducentes');
    $this->addColumn('lugarinscripcionnacimiento','varchar',50,0,0,'Lugar Inscripcion Nacimiento'); 
    $this->addColumn('tomoinscripcionnacimiento','varchar',50,0,0,'Tomo Inscripcion Nacimiento');  
    $this->addColumn('folioinscripcionnacimiento','int',0,0,0,'Folio Inscripcion Nacimiento'); 
    $this->addColumn('partidainscripcionnacimiento','int',0,0,0,'Folio Inscripcion Nacimiento');
    $this->addColumn('anyoinscripcionnacimiento','int',0,0,0,'A&ntilde;o Inscripcion Nacimiento');
  }
}

class reciboTable extends Table {
  function reciboTable() {
    $this->Table('recibo');
    $this->key = 'idrecibo';
    $this->title = 'Recibo';
    $this->maxrows = 20;
    $this->order = 'idrecibo';
    $this->addColumn('idrecibo','serial',0,1,0,'id');
    $this->addColumn('codigorecibo','varchar',30,0,0,'Codigo Recibo'); 
    $this->addColumn('nombrecliente','varchar',50,0,0,'Nombre Cliente');
    $this->addColumn('monto','numeric',6.2,0,0,'Monto'); 
    $this->addColumn('concepto','varchar',100,0,0,'Concepto'); 
    $this->addColumn('codigo','varchar',10,0,0,'Codigo');  
    $this->addColumn('fecha','date',0,0,0,'Fecha'); 
    $this->addColumn('idformapago','int',0,0,'formasdepago','Forma Pago');
    $this->addColumn('numerocheque','varchar',20,0,0,'Numero Cheque');
    $this->addColumn('banco','varchar',50,0,0,'Banco'); 
    $this->addColumn('codigocontribuyente','varchar',30,0,0,'Banco'); 
    $this->addColumn('numerocuenta','varchar',40,0,0,'Banco');
    $this->addColumn('estado','int',0,0,0,'Estado');
  }
}

//Doublekey
class clienteTable extends TableDoubleKey {
  function clienteTable() {
    $this->Table('cliente');
    $this->key1 = 'idpersona';
    $this->key2 = 'idrecibo';
    $this->maxrows = 20;
    $this->title ='Clientes';
    $this->addColumn('idpersona','int',0,0,'persona','IdPersona'); 
    $this->addColumn('idrecibo','int',0,0,'recibo','IdRecibo'); 
  } 
}

//Doublekey
class pagoTable extends TableDoubleKey {
  function pagoTable() {
    $this->Table('pago');
    $this->key1 = 'idrecibo';
    $this->key2 = 'idsolicitudtramite';
    $this->maxrows = 20;
    $this->title ='Pagos';
    $this->addColumn('idrecibo','int',0,0,'recibo','IdRecibo');
    $this->addColumn('idsolicitudtramite','int',0,0,'solicitudtramite','IdSolicitudtramite');     
  } 
} 

class ciudadanoTable extends Table {
  function ciudadanoTable() {
    $this->Table('ciudadano');
    $this->key = 'idciudadano';
    $this->title = 'Ciudadano';
    $this->maxrows = 20;
    $this->order = 'idciudadano';
    $this->addColumn('idciudadano','int',0,0,'persona','Id');
    $this->addColumn('cedula','varchar',16,0,0,'Cedula');
    $this->addColumn('centrovotacion','int',0,0,0,'Centro Votacion');
    $this->addColumn('jvr','int',0,0,0,'Jvr');
    $this->addColumn('ubicacion','varchar',500,0,0,'Ubicacion'); 
    $this->addColumn('direccion','varchar',500,0,0,'Direccion'); 
    $this->addColumn('municipio','varchar',30,0,0,'Municipio'); 
    $this->addColumn('ciudad','varchar',30,0,0,'Direccion');
    $this->addColumn('departamento','varchar',30,0,0,'Direccion'); 
  }
}

class asientoregistralTable extends Table {
  function asientoregistralTable() {
    $this->Table('asientoregistral');
    $this->key = 'idasiento';
    $this->title = 'Asientos Registrales';
    $this->maxrows = 20;
    $this->order = 'idasiento';
    $this->addColumn('idasiento','serial',0,0,0,'Id');
    $this->addColumn('fecha','datetime',0,0,0,'fecha');
  }
}

class itempagadoTable extends Table {
  function itempagadoTable() {
    $this->Table('itempagado');
    $this->key = 'iditempagado';
    $this->title = 'Item pagado';
    $this->maxrows = 20;
    $this->order = 'iditempagado';
    $this->addColumn('iditempagado','serial',0,1,0,'Id');
     $this->addColumn('idrecibo','int',0,0,'recibo','IdRecibo');   
    $this->addColumn('cant','int',0,0,0,'Cantidad');
    $this->addColumn('tipotramite','varchar',20,0,0,'Tipo Tramite');
    $this->addColumn('tarifa','numeric',3.2,0,0,'Tarifa'); 
  }
}

class actaTable extends Table {
  function actaTable() {
    $this->Table('acta');
    $this->key = 'idacta';
    $this->title = 'Actas';
    $this->maxrows = 20;
    $this->order = 'idacta';
    $this->addColumn('idacta','serial',0,1,0,'Id');
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion');
    $this->addColumn('idtomo','int',0,0,'tomo','IdTomo');
    $this->addColumn('folio','int',0,0,0,'Folio'); 
    $this->addColumn('partida','int',0,0,0,'Partida'); 
    $this->addColumn('fecha','date',0,0,0,'Fecha');
  }
}  

class libroregistralTable extends Table {
  function libroregistralTable() {
    $this->Table('libroregistral');
    $this->key = 'idlibro';
    $this->title = 'Libros Registrales';
    $this->maxrows = 20;
    $this->order = 'idlibro';
    $this->addColumn('idlibro','serial',0,1,0,'Id');
    $this->addColumn('codigo','varchar',10,0,0,'Codigo');
    $this->addColumn('idrubro','int',0,0,'rubro','Rubro');
  }
}

class tomoTable extends Table {
  function tomoTable() {
    $this->Table('tomo');
    $this->key = 'idtomo';
    $this->title = 'tomo';
    $this->maxrows = 20;
    $this->order = 'idtomo';
    $this->addColumn('idtomo','serial',0,1,0,'Id');
    $this->addColumn('idlibro','int',0,0,'libroregistral','IdLibro');
    $this->addColumn('numero','int',0,0,0,'Numero'); 
    $this->addColumn('estado','varchar',10,0,0,'Estado'); 
    $this->addColumn('anyo','int',0,0,0,'Anyo'); 
  }
}




class indiceTable extends Table {
  function indiceTable() {
    $this->Table('indice');
    $this->key = 'idtomo';
    $this->title = 'Indices';
    $this->maxrows = 20;
    $this->order = 'idtomo';
    $this->addColumn('idtomo','int',0,0,'tomo','Id');
    $this->addColumn('fecha','date',0,0,0,'Fecha');
    $this->addColumn('registrador','varchar',30,0,0,'Registrador');  
    $this->addColumn('secretario','varchar',30,0,0,'Secretario');
  }
}

class aperturaTable extends Table {
  function aperturaTable() {
    $this->Table('apertura');
    $this->key = 'idtomo';
    $this->title = 'Aperturas';
    $this->maxrows = 20;
    $this->order = 'idtomo';
    $this->addColumn('idtomo','int',0,0,'tomo','Id');
    $this->addColumn('fecha','date',0,0,0,'Fecha');
    $this->addColumn('registrador','varchar',30,0,0,'Registrador');  
    $this->addColumn('secretario','varchar',30,0,0,'Secretario');
  }
}

class cierreTable extends Table {
  function cierreTable() {
    $this->Table('cierre');
    $this->key = 'idtomo';
    $this->title = 'Cierres';
    $this->maxrows = 20;
    $this->order = 'idtomo';
    $this->addColumn('idtomo','int',0,0,'tomo','Id');
    $this->addColumn('fecha','date',0,0,0,'Fecha');
    $this->addColumn('registrador','varchar',30,0,0,'Registrador');  
    $this->addColumn('secretario','varchar',30,0,0,'Secretario');
  }
}


class reporteTable extends Table {
  function reporteTable() {
    $this->Table('reporte');
    $this->key = 'idreporte';
    $this->title = 'Reportes';
    $this->maxrows = 20;
    $this->order = 'idreporte';
    $this->addColumn('idreporte','serial',0,1,0,'Id');
    $this->addColumn('tiporeporte','varchar',20,0,0,'Tipo Reporte');
    $this->addColumn('fechaelaboracion','date',0,0,0,'Fecha Elaboracion');  
    $this->addColumn('fechainicio','date',0,0,0,'Fecha Inicio'); 
    $this->addColumn('fechafin','date',0,0,0,'Fecha Fin'); 
    $this->addColumn('funcionario','varchar',255,0,0,'Funcionario'); 
    $this->addColumn('observaciones','varchar',255,0,0,'Funcionario');

  }
}

class eventoTable extends Table {
  function eventoTable() {
    $this->Table('evento');
    $this->key = 'idevento';
    $this->title = 'Eventos';
    $this->maxrows = 20;
    $this->order = 'fechaocurrencia DESC';
    $this->addColumn('idevento','serial',0,1,0,'Id');
    $this->addColumn('fechaocurrencia','date',0,0,0,'Fecha Ocurrencia');
    $this->addColumn('tipoevento','varchar',60,0,0,'Tipo Evento');
    $this->addColumn('cliente','varchar',15,0,0,'Cliente');
    $this->addColumn('nombreusuario','varchar',30,0,0,'Nombre Usuario');
    $this->addColumn('clave','varchar',30,0,0,'Clave');
    $this->addColumn('descripcion','varchar',500,0,0,'Descripcion');
  }
}

class documentoTable extends Table {
  function documentoTable() {
    $this->Table('documento');
    $this->key = 'iddocumento';
    $this->title = 'Documento Digital';
    $this->maxrows = 20;
    $this->order = 'iddocumento';
    $this->addColumn('iddocumento','serial',0,1,0,'Id');
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','Id');
    $this->addColumn('nombreimagen','file',0,0,0,'NombreImagen');
    $this->addColumn('url','varchar',500,0,0,'URL');
    $this->addColumn('palabraClave','varchar',500,0,0,'Palabra Clave');
  }
}

class tipotramiteTable extends Table {
  function tipotramiteTable() {
    $this->Table('tipotramite');
    $this->key = 'idtipotramite';
    $this->title = 'Tipos Tramite';
    $this->maxrows = 20;
    $this->order = 'idtipotramite';
    $this->addColumn('idtipotramite','serial',0,1,0,'Id');
    $this->addColumn('tipotramite','varchar',50,0,0,'Nombre');
  }
}

class tarifaTable extends Table {
  function tarifaTable() {
    $this->Table('tarifa');
    $this->key = 'idtarifa';
    $this->title = 'Tarifas';
    $this->maxrows = 20;
    $this->order = 'idtarifa';
    $this->addColumn('idtarifa','serial',0,1,0,'Id');
    $this->addColumn('monto','numeric',6.2,0,0,'Monto');   
    $this->addColumn('diasespera','int',0,0,0,'Dias de Espera');
    $this->addColumn('idtipotramite','int',0,0,'tipotramite','Tipo Tramite');
  }
}

//doublekey
class progenieTable extends TableDoubleKey {
  function progenieTable() {
    $this->Table('progenie');
    $this->key1 = 'padre';
    $this->key2 = 'hijo';
    $this->maxrows = 20;
    $this->title ='Progenie';
    $this->addColumn('padre','int',0,0,'persona','Padre');
    $this->addColumn('hijo','int',0,0,'persona','Hijo');  
  } 
} 

class unionmatrimonialTable extends Table {
  function unionmatrimonialTable() {
    $this->Table('progenie');
    $this->key = 'idunionmatrimonial';
    $this->title = 'Progenie';
    $this->maxrows = 20;
    $this->order = 'idtarifa';
    $this->addColumn('idunionmatrimonial','serial',0,1,0,'Id'); 
    $this->addColumn('conyuge1','int',0,0,'persona','Conyuge1');
    $this->addColumn('conyugue2','int',0,0,'persona','Conyuge2');   
    $this->addColumn('vigente','bool',0,0,0,'Vigente');
  }
}

class usuarioTable extends Table {
  function usuarioTable() {
    $this->Table('Usuario');
    $this->key = 'idusuario';
    $this->title = 'Usuarios';
    $this->maxrows = 20;
    $this->order = 'idusuario';
    $this->addColumn('idusuario','serial',0,1,0,'Id'); 
    $this->addColumn('idperfil','int',0,0,'perfil','Conyuge1');
    $this->addColumn('idrol','int',0,0,'rol','Conyuge2');   
    $this->addColumn('nombreusuario','varchar',30,0,0,'Nombre Usuario'); 
    $this->addColumn('clave','varchar',50,0,0,'Clave'); 
    $this->addColumn('nombre','varchar',20,0,0,'Nombre');
    $this->addColumn('email','varchar',50,0,0,'Email');
    $this->addColumn('preguntaconfirmacion','varchar',100,0,0,'Pregunta Confirmacion');  
    $this->addColumn('respuestaconfirmacion','varchar',100,0,0,'Respuesta Confirmacion');
    $this->addColumn('estado','varchar',10,0,0,'Estado');
    $this->addColumn('fechaingreso','date',0,0,0,'Fecha');
  }
}

class perfilTable extends Table {
  function perfilTable() {
    $this->Table('perfil');
    $this->key = 'idperfil';
    $this->title = 'Perfiles';
    $this->maxrows = 20;
    $this->order = 'idperfil';
    $this->addColumn('idperfil','serial',0,1,0,'Id');
    $this->addColumn('nombre','varchar',30,0,0,'Nombre'); 
    $this->addColumn('descripcion','text',0,0,0,'Descripcion'); 
  }
}

//Doublekey
class definicionperfilTable extends TableDoubleKey {
  function definicionperfilTable() {
    $this->Table('definicionperfil');
    $this->key1 = 'idperfil';
    $this->key2 = 'idparametro';
    $this->title = 'Definicion Perfil';
    $this->maxrows = 20;     
    $this->addColumn('idperfil','perfil',0,0,'perfil','IdPerfil'); 
    $this->addColumn('idparametro','int',0,0,'parametro','IdParametro');
    $this->addColumn('valor','varchar',50,0,0,'Valor');
  }
}

class parametroTable extends Table {
  function parametroTable() {
    $this->Table('parametro');
    $this->key = 'idparametro';
    $this->title = 'Parametro';
    $this->maxrows = 20;
    $this->order = 'idparametro';
    $this->addColumn('idparametro','serial',0,1,0,'Id');
    $this->addColumn('clave','varchar',20,0,0,'Clave');
    $this->addColumn('tipo','varchar',20,0,0,'Tipo');
    $this->addColumn('definicion','text',0,0,0,'Definicion');
  }
}

//Doublekey
class configuracioncontextoTable extends TableDoubleKey {
  function configuracioncontextoTable() {
    $this->Table('configuracioncontexto');
    $this->key1 = 'idparametro';
    $this->key2 = 'idcontexto';
    $this->maxrows = 20;
    $this->title ='Configuracion Contexto';
    $this->addColumn('idparametro','int',0,0,'parametro','IdParametro');
    $this->addColumn('idcontexto','int',0,0,'contexto','IdContexto');
    $this->addColumn('valor','varchar',50,0,0,'Valor');
  } 
} 

class contextoTable extends Table {
  function contextoTable() {
    $this->Table('contexto');
    $this->key = 'idcontexto';
    $this->title = 'Contexto';
    $this->maxrows = 20;
    $this->order = 'idcontexto';
    $this->addColumn('idcontexto','serial',0,1,0,'Id');
    $this->addColumn('nombre','varchar',20,0,0,'Nombre');
    $this->addColumn('descripcion','text',0,0,0,'Descripcion');
  }
}

class rolTable extends Table {
  function rolTable() {
    $this->Table('rol');
    $this->key = 'idrol';
    $this->title = 'Roles';
    $this->maxrows = 20;
    $this->order = 'idrol';
    $this->addColumn('idrol','serial',0,1,0,'Id');
    $this->addColumn('nombrerol','varchar',30,0,0,'Nombre Rol');
    $this->addColumn('definicion','varchar',500,0,0,'Definicion');
  }
}

class privilegioTable extends Table {
  function privilegioTable() {
    $this->Table('privilegio');
    $this->key = 'idprivilegio';
    $this->title = 'Privilegios';
    $this->maxrows = 20;
    $this->order = 'idprivilegio';
    $this->addColumn('idprivilegio','serial',0,1,0,'Id');
    $this->addColumn('nombre','varchar',30,0,0,'Nombre Rol');
    $this->addColumn('definicion','varchar',500,0,0,'Definicion');
  }
}
//DobleKey
class asignacionprivilegioTable extends TableDoubleKey {
  function asignacionprivilegioTable() {
    $this->Table('asignacionprivilegio');
    $this->key1 = 'idprivilegio';
    $this->key2 = 'idrol';
    $this->maxrows = 20;
    $this->title ='Asignacion Privilegios';
    $this->addColumn('idprivilegio','int',0,0,'privilegio','IdPrivilegio');
    $this->addColumn('idrol','int',0,0,'rol','IdRol');
  } 
} 

class solicitudcertificacionTable extends Table {
  function solicitudcertificacionTable() {
    $this->Table('solicitudcertificacion');
    $this->key = 'idsolicitudcertificacion';
    $this->title = 'Solicitudes de Certificacion';
    $this->maxrows = 20;
    $this->order = 'idsolicitudcertificacion';
    $this->addColumn('idsolicitudcertificacion','int',0,0,'solicitudtramite','ID');
    $this->addColumn('tipocertificacion','varchar',20,0,0,'Tipo Certificacion');
    $this->addColumn('fechanacimiento','date',0,0,0,'fecha nacimiento');
    $this->addColumn('nombrepadre','varchar',50,0,0,'NombrePadre');
    $this->addColumn('nombremadre','varchar',50,0,0,'NombreMadre'); 
    $this->addColumn('tomo','int',0,0,0,'Tomo');  
    $this->addColumn('folio','int',0,0,0,'Folio');
    $this->addColumn('partida','int',0,0,0,'Partida');
    $this->addColumn('anyo','int',0,0,0,'A?o'); 
    $this->addColumn('fecharegistro','date',0,0,0,'fecha registro');
    $this->addColumn('fechainscripcion','date',0,0,0,'fecha inscripcion');
  }
}

class solicitudtramiteTable extends Table {
  function solicitudtramiteTable() {
    $this->Table('solicitudtramite');
    $this->key = 'idsolicitudtramite';
    $this->title = 'Solicitudes de Tramite';
    $this->maxrows = 20;
    $this->order = 'idsolicitudtramite';
    $this->addColumn('idsolicitudtramite','serial',0,1,0,'ID');
    $this->addColumn('tipotramite','varchar',20,0,0,'Tipo Tramite');
    $this->addColumn('excento','bool',0,0,0,'excento');
    $this->addColumn('prioridad','int',0,0,0,'Prioridad');
    $this->addColumn('fecha','datetime',0,0,0,'NombreMadre'); 
    $this->addColumn('fechaentrega','date',0,0,0,'Fecha Entrega');  
    $this->addColumn('estado','varchar',10,0,0,'Estado');
    $this->addColumn('solicitante1','varchar',255,0,0,'Solicitante1');  
    $this->addColumn('solicitante2','varchar',255,0,0,'Solicitante2');
  }
}

class solicitudinscripcionTable extends Table {
  function solicitudinscripcionTable() {
    $this->Table('solicitudinscripcion');
    $this->key = 'idsolicitudinscripcion';
    $this->title = 'Solicitudes de Incripcion';
    $this->maxrows = 20;
    $this->order = 'idsolicitudinscripcion';
    $this->addColumn('idsolicitudinscripcion','int',0,0,'solicitudtramite','ID');
    $this->addColumn('tipoinscripcion','varchar',20,0,0,'Tipo Inscripcion');
    $this->addColumn('nombreinscrito1','varchar',255,0,0,'NombreInscrito1');
    $this->addColumn('nombreinscrito2','varchar',255,0,0,'NombreInscrito2'); 
  }
}

class certificacionTable extends Table {
  function certificacionTable() {
    $this->Table('certificacion');
    $this->key = 'idcertificacion';
    $this->title = 'Certificaciones';
    $this->maxrows = 20;
    $this->order = 'idcertificacion';
    $this->addColumn('idcertificacion','serial',0,1,0,'ID');
    $this->addColumn('codigo','varchar',20,0,0,'Codigo');
    $this->addColumn('departamentoregistro','varchar',30,0,0,'Codigo');  
    $this->addColumn('anyoregistro','int',0,0,0,'A?o Registro');  
    $this->addColumn('lugaremision','varchar',255,0,0,'Lugar emision');
    $this->addColumn('fechaemision','date',0,0,0,'Fecha Emision');
    $this->addColumn('nombreregistrador','varchar',255,0,0,'NombreRegistrador');
    $this->addColumn('nombresecretario','varchar',255,0,0,'Nombresecretario'); 
    $this->addColumn('idsolicitud','int',0,0,0,'Id Solicitud');  
    $this->addColumn('tipocertificado','varchar',20,0,0,'TipoCertificado'); 
  }
}

//DobleKey
class respuestasolicitudcertificacionTable extends TableDoubleKey {
  function respuestasolicitudcertificacionTable() {
    $this->Table('respuestasolicitudcertificacion');
    $this->key1 = 'idcertificacion';
    $this->key2 = 'idsolicitudcertificacion';
    $this->maxrows = 20;
    $this->title ='Respuesta Solicitud Certificacion';
    $this->addColumn('idcertificacion','int',0,0,'certificacion','IdCertificacion');
    $this->addColumn('idsolicitudcertificacion','int',0,0,'solicitudcertificacion','IdSolicitudCertificacion');
  } 
}

//DobleKey
class respuestasolicitudinscripcionTable extends TableDoubleKey {
  function respuestasolicitudinscripcionTable() {
    $this->Table('respuestasolicitudinscripcion');
    $this->key1 = 'idinscripcion';
    $this->key2 = 'idsolicitudinscripcion';
    $this->maxrows = 20;
    $this->title ='Respuesta Solicitud Inscripcion';
    $this->addColumn('idinscripcion','int',0,0,'inscripcion','IdInscripcion');
    $this->addColumn('idsolicitudinscripcion','int',0,0,'solicitudinscripcion','IdSolicitudInscripcion');
  } 
} 

class organizacionTable extends Table {
  function organizacionTable() {
    $this->Table('organizacion');
    $this->key = 'idorganizacion';
    $this->title = 'organizacion';
    $this->maxrows = 20;
    $this->order = 'idorganizacion';
    $this->addColumn('idorganizacion','serial',0,1,0,'Id');
    $this->addColumn('nombre','varchar',50,0,0,'Nombre');
    $this->addColumn('direccion','varchar',100,0,0,'Direccion');
    $this->addColumn('telefono','varchar',14,0,0,'Telefono');
    $this->addColumn('fax','varchar',14,0,0,'Fax');
  }
}
//DobleKey  
class patrocinioTable extends TableDoubleKey {
  function patrocinioTable() {
    $this->Table('patrocinio');
    $this->key1 = 'idsolicitudtramite';
    $this->key2 = 'idorganizacion';
    $this->maxrows = 20;
    $this->title ='Patrocinio';
    $this->addColumn('idsolicitudtramite','int',0,0,'solicitudtramite','IdSolicitudTramite');
    $this->addColumn('idorganizacion','int',0,0,'organizacion','IdOrganizacion');
  } 
} 


class reposicionmatrimonioTable extends Table {
  function reposicionmatrimonioTable() {
    $this->Table('reposicionmatrimonio');
    $this->key = 'idreposicionmatrimonio';
    $this->title = 'Reposicion Matrimonios';
    $this->maxrows = 20;
    $this->order = 'idreposicionmatrimonio';
    $this->addColumn('idreposicionmatrimonio','int',0,0,'actojuridico','Id');
    $this->addColumn('inscrito2nombre1','varchar',30,0,0,'Inscrito2 Nombre1');
    $this->addColumn('inscrito2nombre2','varchar',30,0,0,'Inscrito2 Nombre2');  
    $this->addColumn('inscrito2apellido1','varchar',30,0,0,'Inscrito2 Apellido1');
    $this->addColumn('inscrito2apellido2','varchar',30,0,0,'Inscrito2 Apellido2');  
    $this->addColumn('conyuge1nombre','varchar',100,0,0,'Conyuge1 Nombre');  
    $this->addColumn('conyuge1edad','varchar',20,0,0,'Conyuge1 Edad'); 
    $this->addColumn('conyuge1oficio','varchar',30,0,0,'Conyuge1 Oficio');  
    $this->addColumn('conyuge1estadocivilanterior','varchar',20,0,0,'Conyuge1 Estado Civil Anterior');  
    $this->addColumn('conyuge1nacionalidad','varchar',30,0,0,'Conyuge1 Nacionalidad'); 
    $this->addColumn('conyuge1domicilio','varchar',500,0,0,'Conyuge1 Domicilio'); 
    $this->addColumn('conyuge1cedula','varchar',16,0,0,'Conyuge1 Cedula'); 
    $this->addColumn('conyuge2nombre','varchar',100,0,0,'Conyuge2 Nombre');  
    $this->addColumn('conyuge2edad','varchar',20,0,0,'Conyuge2 Edad'); 
    $this->addColumn('conyuge2oficio','varchar',30,0,0,'Conyuge2 Oficio');  
    $this->addColumn('conyuge2estadocivilanterior','varchar',20,0,0,'Conyuge2 Estado Civil Anterior');  
    $this->addColumn('conyuge2nacionalidad','varchar',30,0,0,'Conyuge2 Nacionalidad'); 
    $this->addColumn('conyuge2domicilio','varchar',500,0,0,'Conyuge2 Domicilio'); 
    $this->addColumn('conyuge2cedula','varchar',16,0,0,'Conyuge2 Cedula'); 
    $this->addColumn('testigo1nombre','varchar',100,0,0,'Testigo1 Nombre');
    $this->addColumn('testigo1edad','varchar',20,0,0,'Testigo1 Edad');
    $this->addColumn('testigo1oficio','varchar',30,0,0,'Testigo1 Oficio'); 
    $this->addColumn('testigo1estadocivil','varchar',30,0,0,'Testigo1 Estado Civil'); 
    $this->addColumn('testigo1domicilio','varchar',500,0,0,'Testigo1 Domicilio'); 
    $this->addColumn('testigo1cedula','varchar',16,0,0,'Testigo2 Cedula');
    $this->addColumn('testigo2nombre','varchar',100,0,0,'Testigo1 Nombre');
    $this->addColumn('testigo2edad','varchar',20,0,0,'Testigo1 Edad');
    $this->addColumn('testigo2oficio','varchar',30,0,0,'Testigo1 Oficio'); 
    $this->addColumn('testigo2estadocivil','varchar',30,0,0,'Testigo1 Estado Civil'); 
    $this->addColumn('testigo2domicilio','varchar',500,0,0,'Testigo1 Domicilio'); 
    $this->addColumn('testigo2cedula','varchar',16,0,0,'Testigo2 Cedula');
    $this->addColumn('conyuge1lugarinscripcion','varchar',50,0,0,'Conyuge1 Lugar Inscripcion');
    $this->addColumn('conyuge1tomoinscripcion','int',0,0,0,'Conyuge1 Tomo Inscripcion');
    $this->addColumn('conyuge1folioinscripcion','int',0,0,0,'Conyuge1 Folio Inscripcion'); 
    $this->addColumn('conyuge1partidainscripcion','int',0,0,0,'Conyuge1 Partida Inscripcion');
    $this->addColumn('conyuge1anyoinscripcion','int',0,0,0,'Conyuge1 A?o Inscripcion');
    $this->addColumn('conyuge2lugarinscripcion','varchar',50,0,0,'Conyuge2 Lugar Inscripcion');
    $this->addColumn('conyuge2tomoinscripcion','int',0,0,0,'Conyuge2 Tomo Inscripcion');
    $this->addColumn('conyuge2folioinscripcion','int',0,0,0,'Conyuge2 Folio Inscripcion'); 
    $this->addColumn('conyuge2partidainscripcion','int',0,0,0,'Conyuge2 Partida Inscripcion');
    $this->addColumn('conyuge2anyoinscripcion','int',0,0,0,'Conyuge2 A?o Inscripcion');      
	// adicionados para registrar los datos del oficio
    $this->addColumn('oficiojueznotario','varchar',255,0,0,'Juez Notario');
    $this->addColumn('oficiomunicipio','varchar',30,0,0,'Municipio Sentencia');
    $this->addColumn('oficiodepartamento','varchar',30,0,0,'Depto Sentencia');
    $this->addColumn('oficiofecha','datetime',0,0,0,'Fecha Sentencia');
	// nombre completo del padre y la madre en caso de conocerse estos para cada conyuge
    $this->addColumn('conyuge1nombrepadre','varchar',500,0,0,'Conyuge1 Nombre del Padre');  
    $this->addColumn('conyuge1nombremadre','varchar',500,0,0,'Conyuge1 Nombre de la Madre');  
    $this->addColumn('conyuge2nombrepadre','varchar',500,0,0,'Conyuge2 Nombre del Padre');  
    $this->addColumn('conyuge2nombremadre','varchar',500,0,0,'Conyuge2 Nombre de la Madre');  
  }
}

class matrimonioTable extends Table {
  function matrimonioTable() {
    $this->Table('matrimonio');
    $this->key = 'idmatrimonio';
    $this->title = 'Matrimonios';
    $this->maxrows = 20;
    $this->order = 'idmatrimonio';
    $this->addColumn('idmatrimonio','int',0,0,'actojuridico','Id');
    $this->addColumn('inscrito2nombre1','varchar',30,0,0,'Inscrito2 Nombre1');
    $this->addColumn('inscrito2nombre2','varchar',30,0,0,'Inscrito2 Nombre2');  
    $this->addColumn('inscrito2apellido1','varchar',30,0,0,'Inscrito2 Apellido1');
    $this->addColumn('inscrito2apellido2','varchar',30,0,0,'Inscrito2 Apellido2');  
    $this->addColumn('conyuge1nombre','varchar',255,0,0,'Conyuge1 Nombre');  
    $this->addColumn('conyuge1edad','varchar',20,0,0,'Conyuge1 Edad'); 
    $this->addColumn('conyuge1oficio','varchar',30,0,0,'Conyuge1 Oficio');  
    $this->addColumn('conyuge1estadocivilanterior','varchar',20,0,0,'Conyuge1 Estado Civil Anterior');  
    $this->addColumn('conyuge1nacionalidad','varchar',30,0,0,'Conyuge1 Nacionalidad'); 
    $this->addColumn('conyuge1domicilio','varchar',500,0,0,'Conyuge1 Domicilio'); 
    $this->addColumn('conyuge1cedula','varchar',16,0,0,'Conyuge1 Cedula'); 
    $this->addColumn('conyuge2nombre','varchar',255,0,0,'Conyuge2 Nombre');  
    $this->addColumn('conyuge2edad','varchar',20,0,0,'Conyuge2 Edad'); 
    $this->addColumn('conyuge2oficio','varchar',30,0,0,'Conyuge2 Oficio');  
    $this->addColumn('conyuge2estadocivilanterior','varchar',20,0,0,'Conyuge2 Estado Civil Anterior');  
    $this->addColumn('conyuge2nacionalidad','varchar',30,0,0,'Conyuge2 Nacionalidad'); 
    $this->addColumn('conyuge2domicilio','varchar',500,0,0,'Conyuge2 Domicilio'); 
    $this->addColumn('conyuge2cedula','varchar',16,0,0,'Conyuge2 Cedula'); 
    $this->addColumn('testigo1nombre','varchar',255,0,0,'Testigo1 Nombre');
    $this->addColumn('testigo1edad','varchar',20,0,0,'Testigo1 Edad');
    $this->addColumn('testigo1oficio','varchar',30,0,0,'Testigo1 Oficio'); 
    $this->addColumn('testigo1estadocivil','varchar',30,0,0,'Testigo1 Estado Civil'); 
    $this->addColumn('testigo1domicilio','varchar',500,0,0,'Testigo1 Domicilio'); 
    $this->addColumn('testigo1cedula','varchar',16,0,0,'Testigo2 Cedula');
    $this->addColumn('testigo2nombre','varchar',255,0,0,'Testigo1 Nombre');
    $this->addColumn('testigo2edad','varchar',20,0,0,'Testigo1 Edad');
    $this->addColumn('testigo2oficio','varchar',30,0,0,'Testigo1 Oficio'); 
    $this->addColumn('testigo2estadocivil','varchar',30,0,0,'Testigo1 Estado Civil'); 
    $this->addColumn('testigo2domicilio','varchar',500,0,0,'Testigo1 Domicilio'); 
    $this->addColumn('testigo2cedula','varchar',16,0,0,'Testigo1 Cedula');
    $this->addColumn('conyuge1lugarinscripcion','varchar',50,0,0,'Conyuge1 Lugar Inscripcion');
    $this->addColumn('conyuge1tomoinscripcion','int',0,0,0,'Conyuge1 Tomo Inscripcion');
    $this->addColumn('conyuge1folioinscripcion','int',0,0,0,'Conyuge1 Folio Inscripcion'); 
    $this->addColumn('conyuge1partidainscripcion','int',0,0,0,'Conyuge1 Partida Inscripcion');
    $this->addColumn('conyuge1anyoinscripcion','int',0,0,0,'Conyuge1 A?o Inscripcion');
    $this->addColumn('conyuge2lugarinscripcion','varchar',50,0,0,'Conyuge2 Lugar Inscripcion');
    $this->addColumn('conyuge2tomoinscripcion','int',0,0,0,'Conyuge2 Tomo Inscripcion');
    $this->addColumn('conyuge2folioinscripcion','int',0,0,0,'Conyuge2 Folio Inscripcion'); 
    $this->addColumn('conyuge2partidainscripcion','int',0,0,0,'Conyuge2 Partida Inscripcion');
    $this->addColumn('conyuge2anyoinscripcion','int',0,0,0,'Conyuge2 A?o Inscripcion');     
  }
}

class reposicionhechovitalTable extends Table {
  function reposicionhechovitalTable() {
    $this->Table('reposicionhechovital');
    $this->key = 'idreposicionhechovital';
    $this->title = 'Reposicion Hecho Vital';
    $this->maxrows = 20;
    $this->order = 'idreposicionhechovital';
    $this->addColumn('idreposicionhechovital','int',0,0,'inscripcion','Id');
    $this->addColumn('jueznotario','varchar',255,0,0,'JuezNotario');
    $this->addColumn('nombrejuzgado','varchar',30,0,0,'Nombre Juzgado');
    $this->addColumn('lugarjuzgado','varchar',30,0,0,'Lugar Juzgado'); 
    $this->addColumn('fechadictament','datetime',0,0,0,'Fecha Dictament');  
    $this->addColumn('sexoinscrito','varchar',1,0,0,'Sexo Inscrito');
    $this->addColumn('padrenombre','varchar',255,0,0,'Nombre Padre'); 
    $this->addColumn('nombremadre','varchar',255,0,0,'Nombre Madre');
    $this->addColumn('ciudadnacimiento','varchar',30,0,0,'Ciudad Nacimento');
    $this->addColumn('municipionacimiento','varchar',30,0,0,'Municipio Nacimento'); 
    $this->addColumn('departamentonacimiento','varchar',30,0,0,'Departamento Nacimento'); 
    $this->addColumn('paisnacimiento','varchar',30,0,0,'Pais Nacimento'); 
    $this->addColumn('fechanacimiento','datetime',0,0,0,'Fecha Nacimento'); 
  }
}


class reposicionnacimientoTable extends Table {
  function reposicionnacimientoTable() {
    $this->Table('reposicionnacimiento');
    $this->key = 'idreposicionnacimiento';
    $this->title = 'Reposicion Nacimiento';
    $this->maxrows = 20;
    $this->order = 'idreposicionnacimiento';
    $this->addColumn('idreposicionnacimiento','int',0,0,'reposicionhechovital','Id');
    $this->addColumn('lugarinscripciondefuncion','varchar',50,0,0,'Lugar Inscripcion Defuncion'); 
    $this->addColumn('tomoinscripciondefuncion','int',0,0,0,'Tomo Inscripcion Defuncion');
    $this->addColumn('folioinscripciondefuncion','int',0,0,0,'Folio Inscripcion Defuncion');
    $this->addColumn('partidainscripciondefuncion','int',0,0,0,'Partida Inscripcion Defuncion');
    $this->addColumn('anyoinscripciondefuncion','int',0,0,0,'A?o Inscripcion Defuncion'); 
    $this->addColumn('edadpadre','varchar',30,0,0,'EdadPadre');
    $this->addColumn('oficiopadre','varchar',500,0,0,'OficioPadre');  
    $this->addColumn('domiciliopadre','varchar',500,0,0,'DomicilioPadre'); 
    $this->addColumn('nacionalidadpadre','varchar',200,0,0,'Nacionalidadpadre'); 
    $this->addColumn('cedulapadre','varchar',30,0,0,'Cedulapadre');  
    $this->addColumn('edadmadre','varchar',30,0,0,'Edadmadre');
    $this->addColumn('oficiomadre','varchar',500,0,0,'Oficiomadre'); 
    $this->addColumn('domiciliomadre','varchar',500,0,0,'Domiciliomadre');  
    $this->addColumn('nacionalidadmadre','varchar',500,0,0,'Nacionalidadmadre'); 
    $this->addColumn('cedulamadre','varchar',30,0,0,'Cedulamadre'); 
    
  }
}

class reposiciondefuncionTable extends Table {
  function reposiciondefuncionTable() {
    $this->Table('reposiciondefuncion');
    $this->key = 'idreposiciondefuncion';
    $this->title = 'Reposicion Defuncion';
    $this->maxrows = 20;
    $this->order = 'idreposiciondefuncion';
    $this->addColumn('idreposiciondefuncion','int',0,0,'reposicionhechovital','Id');
    $this->addColumn('causamuerte','varchar',30,0,0,'Causa Muerte'); 
    $this->addColumn('fechadefuncion','datetime',0,0,0,'Causa Muerte'); 
    $this->addColumn('ciudaddefuncion','varchar',30,0,0,'Ciudad Defuncion'); 
    $this->addColumn('municipiodefuncion','varchar',30,0,0,'Municipio Defuncion');
    $this->addColumn('departamentodefuncion','varchar',30,0,0,'Departamento Defuncion');  
    $this->addColumn('paisdefuncion','varchar',30,0,0,'Pais Defuncion'); 
    $this->addColumn('conyugenombre','varchar',255,0,0,'Conyuge Nombre'); 
    $this->addColumn('lugarinscripcionnacimiento','varchar',50,0,0,'Lugar Inscripcion Defuncion'); 
    $this->addColumn('tomoinscripcionnacimiento','int',0,0,0,'Tomo Inscripcion Defuncion');
    $this->addColumn('folioinscripcionnacimiento','int',0,0,0,'Folio Inscripcion Defuncion');
    $this->addColumn('partidainscripcionnacimiento','int',0,0,0,'Partida Inscripcion Defuncion');
  }
}

class hechovitalTable extends Table {
  function hechovitalTable() {
    $this->Table('hechovital');
    $this->key = 'idhechovital';
    $this->title = 'Hecho Vital';
    $this->maxrows = 20;
    $this->order = 'idhechovital';
    $this->addColumn('idhechovital','int',0,0,'inscripcion','Id');
    $this->addColumn('sexoinscrito','varchar',1,0,0,'Sexo Inscrito');
    $this->addColumn('padrenombre','varchar',255,0,0,'Nombre Padre'); 
    $this->addColumn('nombremadre','varchar',255,0,0,'Nombre Madre');
    $this->addColumn('ciudadnacimiento','varchar',30,0,0,'Ciudad Nacimento');
    $this->addColumn('municipionacimiento','varchar',30,0,0,'Municipio Nacimento'); 
    $this->addColumn('departamentonacimiento','varchar',30,0,0,'Departamento Nacimento'); 
    $this->addColumn('paisnacimiento','varchar',30,0,0,'Pais Nacimento'); 
    $this->addColumn('fechanacimiento','datetime',0,0,0,'Fecha Nacimento'); 
  }
}

class nacimientoTable extends Table {
  function nacimientoTable() {
     $this->Table('nacimiento');
     $this->key='idnacimiento';
     $this->title='Nacimientos';
     $this->order='idnacimiento';
     $this->addColumn('idnacimiento','int',0,0,'hechovital','Id');
     $this->addColumn('edadpadre','varchar',20,0,0,'EdadPadre');
     $this->addColumn('oficiopadre','varchar',30,0,0,'OficioPadre');  
     $this->addColumn('domiciliopadre','varchar',30,0,0,'DomicilioPadre'); 
     $this->addColumn('nacionalidadpadre','varchar',30,0,0,'Nacionalidadpadre'); 
     $this->addColumn('cedulapadre','varchar',16,0,0,'Cedulapadre');  
     $this->addColumn('edadmadre','varchar',20,0,0,'Edadmadre');
     $this->addColumn('oficiomadre','varchar',30,0,0,'Oficiomadre'); 
     $this->addColumn('domiciliomadre','varchar',30,0,0,'Domiciliomadre');  
     $this->addColumn('nacionalidadmadre','varchar',30,0,0,'Nacionalidadmadre'); 
     $this->addColumn('cedulamadre','varchar',16,0,0,'Cedulamadre'); 
     $this->addColumn('compareciente1nacionalidad','varchar',30,0,0,'Compareciente1 Nacionalidad');
     $this->addColumn('compareciente2nombre','varchar',30,0,0,'Compareciente2 Nombre'); 
     $this->addColumn('compareciente2edad','varchar',20,0,0,'Compareciente2 Edad'); 
     $this->addColumn('compareciente2oficio','varchar',30,0,0,'Compareciente2 Oficio'); 
     $this->addColumn('compareciente2domicilio','varchar',30,0,0,'Compareciente2 Domicilio');
     $this->addColumn('compareciente2nacionalidad','varchar',30,0,0,'Compareciente2 Nacionalidad');
     $this->addColumn('compareciente2cedula','varchar',16,0,0,'Compareciente2 Cedula'); 
     $this->addColumn('lugarinscripciondefuncion','varchar',50,0,0,'Lugar Inscripcion Defuncion'); 
     $this->addColumn('tomoinscripciondefuncion','int',0,0,0,'Tomo Inscripcion Defuncion');
     $this->addColumn('folioinscripciondefuncion','int',0,0,0,'Folio Inscripcion Defuncion');
     $this->addColumn('partidainscripciondefuncion','int',0,0,0,'Partida Inscripcion Defuncion');
     $this->addColumn('anyoinscripciondefuncion','int',0,0,0,'A?o Inscripcion Defuncion');      
  }
}

class defuncionTable extends Table {
  function defuncionTable() {
    $this->Table('defuncion');
    $this->key = 'iddefuncion';
    $this->title = 'Defunciones';
    $this->maxrows = 20;
    $this->order = 'iddefuncion';
    $this->addColumn('iddefuncion','int',0,0,'hechovital','Id');
    $this->addColumn('causamuerte','varchar',30,0,0,'Causa Muerte'); 
    $this->addColumn('fechadefuncion','date',0,0,0,'Causa Muerte'); 
    $this->addColumn('ciudaddefuncion','varchar',30,0,0,'Ciudad Defuncion'); 
    $this->addColumn('municipiodefuncion','varchar',30,0,0,'Municipio Defuncion');
    $this->addColumn('departamentodefuncion','varchar',30,0,0,'Departamento Defuncion');  
    $this->addColumn('paisdefuncion','varchar',30,0,0,'Pais Defuncion'); 
    $this->addColumn('edadfallecido','varchar',20,0,0,'Edad Fallecido'); 
    $this->addColumn('oficiofallecido','varchar',30,0,0,'Oficio Fallecido'); 
    $this->addColumn('estadocivil','varchar',20,0,0,'Estado civil');
    $this->addColumn('domiciliofallecido','varchar',500,0,0,'Domicilio Fallecido');  
    $this->addColumn('nacionalidadfallecido','varchar',30,0,0,'Nacionalidad Fallecido'); 
    $this->addColumn('cedulafallecido','varchar',16,0,0,'Cedula Fallecido');  
    $this->addColumn('conyugenombre','varchar',255,0,0,'Conyuge Nombre');
    $this->addColumn('lugarinscripcionnacimiento','varchar',50,0,0,'Lugar Inscripcion Nacimiento'); 
    $this->addColumn('tomoinscripcionnacimiento','int',0,0,0,'Tomo Inscripcion Nacimiento');
    $this->addColumn('folioinscripcionnacimiento','int',0,0,0,'Folio Inscripcion Nacimiento');
    $this->addColumn('partidainscripcionnacimiento','int',0,0,0,'Partida Inscripcion Nacimiento');
  }
} 

class areaTable extends Table {
  function areaTable() {
    $this->Table('area');
    $this->key = 'idarea';
    $this->title = 'Areas';
    $this->maxrows = 20;
    $this->order = 'nombre';
    $this->addColumn('idarea','serial',0,1,0,'Id');
    $this->addColumn('nombre','varchar',50,0,0,'Nombre');
    $this->addColumn('url','varchar',255,0,0,'Url'); 
    $this->addColumn('padre','int',0,0,0,'Padre');
    $this->addColumn('orden','int',0,0,0,'Orden');
    $this->addColumn('visible','int',0,0,0,'Visible');
    $this->addColumn('independiente','int',0,0,0,'Independiente');
  }
}

class rubroTable extends Table {
  function rubroTable() {
    $this->Table('rubro');
    $this->key = 'idrubro';
    $this->title = 'Rubros';
    $this->maxrows = 20;
    $this->order = 'idrubro';
    $this->addColumn('idrubro','serial',0,1,0,'Id');
    $this->addColumn('nombre','varchar',100,0,0,'Nombre');
  }
}

class causamuerteTable extends Table {
  function causamuerteTable() {
    $this->Table('causamuerte');
    $this->key = 'causamuerte';
    $this->title = 'Causas de Muertes';
    $this->maxrows = 20;
    $this->order = 'causamuerte';
    $this->addColumn('causamuerte','varchar',0,0,0,'Id');
    $this->addColumn('definicion','varchar',500,0,0,'Nombre');
  }
}
//Doublekey
class rol_areasTable extends TableDoubleKey {
  function rol_areasTable() {
    $this->Table('rol_areas');
    $this->key1 = 'idrol';
    $this->key2 = 'idarea';
    $this->maxrows = 20;
    $this->title ='Rol Areas';
    $this->addColumn('idrol','int',0,0,'rol','IdRol');
    $this->addColumn('idarea','int',0,0,'area','IdArea');
  } 
}
//Doublekey  
class itemindiceTable extends TableDoubleKey {
    function itemindiceTable() {
        $this->Table('itemindice');
        $this->key1 = 'idindice';
        $this->key2 = 'idtomo';
        $this->maxrows = 20;
        $this->title ='Elementos del Indice';
        $this->addColumn('idindice','serial',0,1,0,'IdIndice');
        $this->addColumn('idtomo','int',0,0,'tomo','IdTomo');
        $this->addColumn('inscritos','varchar',500,0,0,'Inscritos'); 
        $this->addColumn('partida','int',0,0,0,'Partida'); 
        $this->addColumn('folio','int',0,0,0,'Folio'); 
        $this->addColumn('rubro','int',0,0,0,'Rubro');
        $this->addColumn('observaciones','text',0,0,0,'Observaciones');
    } 
}

class formasdepagoTable extends Table {
  function formasdepagoTable() {
    $this->Table('formasdepago');
    $this->key = 'idformapago';
    $this->title = 'Formas de Pago';
    $this->maxrows = 20;
    $this->order = 'formapago';
    $this->addColumn('idformapago','serial',0,1,0,'Id');
    $this->addColumn('formapago','varchar',500,0,0,'Nombre');
  }
}







