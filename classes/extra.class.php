<?php
class usuario extends usuarioTable {
    //Obtener Perfil
    public function checkUser($user,$pass,&$error) {   
        $user = $this->getVar("SELECT nombre FROM usuario WHERE nombre LIKE '" . $user."'");  
        if($user) {
            $user_exists = $this->getVar("SELECT idusuario FROM usuario WHERE nombre LIKE '" . $user . "' AND clave LIKE '" . md5($pass) . "'"); 
            if(!$user_exists) {
                $error = 'usuario y password invalidos';
            }    
        } else {
            $error = 'usuario no valido';
        }    
        return ($error == '') ? $user_exists : 0;           
    } 
    
    public function getUser($valor) {
        if(!is_array($valor) && $valor > 0) {
            $userbd = $this->readRecord($valor); 
        } elseif(is_array($valor)) {
            $userbd = $valor;
        }  else {
            return null;
        }         
        $this->request['idusuario'] = $userbd['idusuario'];
        $this->request['idrol'] = $userbd['idrol'];
        $this->request['idperfil'] = $userbd['idperfil'];
        $this->request['nombreusuario'] = $userbd['nombreusuario']; 
        $this->request['nombre'] = $userbd['nombre'];  
        $this->request['clave'] = $userbd['clave']; 
        $this->request['email'] = $userbd['email'];
        $this->request['preguntaconfirmacion'] = $userbd['preguntaconfirmacion'];
        $this->request['respuestaconfirmacion'] = $userbd['respuestaconfirmacion']; 
        $this->request['estado'] = $userbd['estado'];  
        $this->request['fechaingreso'] = $userbd['fechaingreso'];
        return $this;
    } 
        
    public function getRol() {
        $rol = new rolTable();
        $rolbd = $rol->readRecord($this->request['idrol']);
        return $rolbd['definicion'];                                                              
    } 
    
    public function checkCredenciales($array) {
        $cant = 0;    
        foreach($array as $valor) {
            $credenciales = $this->readDataSQL("SELECT count(*) 
                                                 FROM rol_areas 
                                           INNER JOIN area
                                                   ON rol_areas.idarea = area.idarea
                                                WHERE area.nombre='".$valor."'");
                                                
            $cant += $credenciales[0]['count'];                                     
        }
        return ($cant > 0) ? true : false;
                                                
    } 
    
    public function getAreas() {
        $Areas = $this->readDataSQL("SELECT area.* 
                                       FROM rol_areas 
                                 INNER JOIN area
                                         ON rol_areas.idarea = area.idarea
                                      WHERE rol_areas.idrol=".$this->request['idrol']."
                                        AND area.padre=0 
                                         OR area.independiente=1"); 
        return $Areas;                                      
    } 
    
    public function getLastEvents() {
        $evento = new eventoTable();
        $evento->order = 'idevento DESC';
        $evento->limit = 10;
        $eventosbd =  $evento->readDataFilter("nombreusuario='".$this->request['nombre']."'
                                               AND clave='".$this->request['clave']."'");
        return $eventosbd;        
    }
    
    public function getEvents() {
        $evento = new eventoTable();
        $evento->order = 'idevento DESC';
        $eventosbd =  $evento->readDataFilter("nombreusuario='".$this->request['nombre']."'
                                               AND clave='".$this->request['clave']."'");
        return $eventosbd;        
    }
    
    public function getPerfil() {
        $perfil = new perfil();
        $perfilbd = $perfil->getPerfil($this->request['idperfil']);
        return $perfilbd;
    }
    
    public function getUsersByRol($rol) {
        $users = $this->readDataFilter("rol.nombrerol='".$rol."'");
        return  $users;
    }

    public function getUserByLogin($login){
       $user = new usuario();
       $users = $user->readDataFilter("usuario.nombre='".$login."'");
       return  $users;
    }
    public function getPerfilArreglo() {
        $perfil = new perfilTable();
        $perfilbd = $perfil->readRecord($this->request['idperfil']);
        return $perfilbd['descripcion'];
    }
    
    public function existeOtroLogin($idusuario,$nombre){
        $user = new usuario();
        $userdb = $user->readDataFilter("idusuario!='".$idusuario."' AND nombre='".$nombre."'");
        if($userdb->request['nombre']!=""){
          return true;
        }else{
          return false;
        }
    }	
}

class perfil extends  perfilTable{
    public function getPerfil($valor) {
        if(!is_array($valor) && $valor > 0) {
            $perfilbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $perfilbd = $valor;
        }  else {
            return null;
        }        
        $this->request['idperfil'] = $perfilbd['idperfil'];
        $this->request['nombre'] = $perfilbd['nombre'];
        $this->request['descripcion'] = $perfilbd['descripcion'];
        return $this;
    } 
   
    public function getParametro($parametro,$contexto='') {
        if($contexto == '') {
            $parametro = $this->getVar("SELECT definicionperfil.valor
                                          FROM definicionperfil 
                                    INNER JOIN parametro
                                            ON definicionperfil.idparametro = parametro.idparametro
                                         WHERE parametro.clave='".$parametro."'
                                           AND idperfil=".$this->request['idperfil']);
        }
        return $parametro;
    }
    
    public function getDefiniciones(){
        $sql = "SELECT definicionperfil.*
                  FROM definicionperfil 
                 WHERE definicionperfil.idperfil='".$this->request['idperfil']."'";
        $array = $this->readDataSQL($sql);
        return $array;
    }                                
}   
   
 
 
class area extends areaTable {   
   public function getArea($valor) {
        if(!is_array($valor) && $valor > 0) {
            $areabd = $this->readRecord($valor); 
        } elseif(is_array($valor)) {
            $areabd = $valor;
        }  else {
            return null;
        }        
        $this->request['idarea'] = $areabd['idarea'];
        $this->request['nombre'] = $areabd['nombre'];
        $this->request['url'] = $areabd['url'];
        $this->request['orden'] = $areabd['orden']; 
        $this->request['padre'] = $areabd['padre']; 
        $this->request['visible'] = $areabd['visible'];  
        $this->request['independiente'] = $areabd['independiente'];
        return $this;
   }
   
   public function getAreaByNombre($nombre){
        $areabd = $this->readDataFilter("area.nombre = '".$nombre."'");

        if(is_array($areabd)){    
            $this->request['idarea'] = $areabd[0]['idarea'];
            $this->request['nombre'] = $areabd[0]['nombre'];
            $this->request['url'] = $areabd[0]['url'];
            $this->request['orden'] = $areabd[0]['orden']; 
            $this->request['padre'] = $areabd[0]['padre']; 
            $this->request['visible'] = $areabd[0]['visible'];  
            $this->request['independiente'] = $areabd[0]['independiente'];
            return $this;
        }else{
            return NULL;
        }        
   }
   
   public function getAreaByNombreAndPadre($nombre,$idpadre){
       $areabd = $this->readDataFilter("area.nombre = '".$nombre."' AND area.padre ='".$idpadre."'");
        
        if(is_array($areabd)){
            $this->request['idarea'] = $areabd[0]['idarea'];
            $this->request['nombre'] = $areabd[0]['nombre'];
            $this->request['url'] = $areabd[0]['url'];
            $this->request['orden'] = $areabd[0]['orden']; 
            $this->request['padre'] = $areabd[0]['padre']; 
            $this->request['visible'] = $areabd[0]['visible'];  
            $this->request['independiente'] = $areabd['independiente'];
            return $this;
        } else {
            return NULL;
        } 
   }  
   
   public function getAreasLimitadas(){
        $filter = "independiente = 1 OR padre = 0";
        return $this->readDataFilter($filter);
   } 
   
   public function getSubAreas() {
        $this->order = 'orden';                                                   
        return $this->readDataFilter("padre=".$this->request['idarea']." AND visible=1");
   }
   
   public function getCanSubtAreas() {
        $cant = $this->getVar("SELECT count(*) 
                                 FROM area 
                                WHERE padre=".$this->request['idarea']."
                                  AND visible=1");  
        return $cant;                                  
   }    
}

class rubro extends rubroTable {
    public function getAll() {
       return $this->readData();
    } 
}

class tomo extends tomoTable {
     public function getTomo($valor) {
        if(!is_array($valor) && $valor > 0) {
            $tomobd = $this->readRecord($valor); 
        } elseif(is_array($valor)) {
            $tomobd = $valor;
        }  else {
            return null;
        }            
        $this->request['idtomo'] = $tomobd['idtomo'];
        $this->request['idlibro'] = $tomobd['idlibro']; 
        $this->request['numero'] = $tomobd['numero'];
        $this->request['estado'] = $tomobd['estado'];
        $this->request['anyo'] = $tomobd['anyo'];
        return $this;         
     }
     
     public function getlastId() {
         return $this->getVar("SELECT MAX(".$this->key.") FROM tomo");
     } 
     
     public function getNumero() {
         return $this->getVar("SELECT MAX(numero) FROM tomo WHERE idlibro=".$this->request['idlibro']) + 1;
     }     
      
     public function getCantpartidas() {
         return $this->getVar("SELECT count(*) FROM acta WHERE idtomo=".$this->request['idtomo']);   
     }       
     
     public function getCantFolios() {
         $folios = $this->readDataSQL("SELECT DISTINCT(acta.folio) FROM acta WHERE idtomo=".$this->request['idtomo']); 
         return (is_array($folios)) ? count($folios) : 0;
     }      

     

     public function getApertura() {
         $apertura = new apertura();
         $aperturabd = $apertura->readRecord($this->request['idtomo']);
         return $aperturabd;
     } 
     
     public function getCierre() {
         $cierre = new cierre();
         $cierrebd = $cierre->readRecord($this->request['idtomo']);
         return $cierre->getCierre($cierrebd);
     } 
     
     public function getTomosAbiertos($idlibro) {
         $tomos = $this->readDataFilter("tomo.estado='abierto' AND tomo.idlibro=".$idlibro);
         return $tomos;
     } 
     
     public function getLastPartida() {
         return $this->getVar("SELECT MAX(partida) FROM acta WHERE idtomo=".$this->request['idtomo']);
     }

     public function getLastFolio() {
         return $this->getVar("SELECT MAX(folio) FROM acta WHERE idtomo=".$this->request['idtomo']);     
     }
     
     public function getIdTomoByLibroNumero($libro,$numero) {
         return $this->getVar("SELECT tomo.idtomo 
                                 FROM tomo 
                           INNER JOIN libroregistral
                                   ON tomo.idlibro = libroregistral.idlibro
                           INNER JOIN rubro
                                   ON libroregistral.idrubro = rubro.idrubro     
                                WHERE rubro.nombre='".$libro."' AND tomo.numero=".$numero);     
     }
     
     public function CrearIndices($idtomo) {
         $acta = new acta($idtomo);
         $arrayactasbd = $acta->getActasByTomo($idtomo);
         foreach($arrayactasbd as $actabd) {
             $itemindice = new itemindiceTable();
             $itemindice->request['idtomo'] = $idtomo;
             $itemindice->request['inscritos'] = $actabd['inscritos']; 
             $itemindice->request['folio'] = $actabd['folio'];
             $itemindice->request['partida'] = $actabd['partida']; 
             $itemindice->request['rubro'] = $actabd['rubro']; 
             $itemindice->request['observaciones'] = $actabd['observaciones']; 
             try {
                $itemindice->addRecord();
             }
             catch (Exception $e) {
                $mesage = "Error  ('{$e->getMessage()}')\n{$e}\n";
                $error = true;
             }               
         }    
     } 
     
     public function getRubro() {
        return $this->getVar("SELECT rubro.nombre 
                                FROM libroregistral, rubro 
                                WHERE libroregistral.idrubro = rubro.idrubro
                                  AND libroregistral.idlibro = ".$this->request['idlibro']);
     }   
     
     public function getPartidas() {
        return $this->readDataSQL("SELECT acta.*, inscripcion.inscrito1nombre1, inscripcion.inscrito1nombre2,
                                          inscripcion.inscrito1apellido1,inscrito1apellido2        
                                     FROM acta 
                               INNER JOIN inscripcion
                                       ON acta.idinscripcion =  inscripcion.idinscripcion
                                     WHERE idtomo=".$this->request['idtomo']);
     }    
   
} 

class libroregistral extends libroregistralTable {
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    } 

    public function getCodigo() {
        return $this->getVar("SELECT MAX(codigo) FROM libroregistral") + 1;
    }

    public function getCantTomos() {
        return $this->getVar("SELECT count(*) FROM tomo WHERE idlibro=".$this->request['idlibro']);  
    } 

    public function getLibro($valor) {
        if(!is_array($valor) && $valor > 0) {
            $librobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $librobd = $valor;
        }  else {
            return null;
        }         
        $this->request['idlibro'] = $librobd['idlibro'];
        $this->request['codigo'] = $librobd['codigo'];
        $this->request['idrubro'] = $librobd['idrubro'];
        return $this;        
    } 

    public function getUltimoTomo() {
        return $this->getVar("SELECT MAX(numero) FROM tomo WHERE idlibro=".$this->request['idlibro']);  
    }

    public function getNomRubro() {
        return $this->getVar("SELECT rubro.nombre 
                                FROM rubro 
                           LEFT JOIN libroregistral 
                                  ON rubro.idrubro = libroregistral.idrubro
                               WHERE libroregistral.idlibro=".$this->request['idlibro']);  
    }

    public function checkRubro($rubro) {
        $rubro = $this->getVar("SELECT idrubro 
                                  FROM libroregistral 
                                 WHERE idrubro=".$rubro);
        return ($rubro) ? true : false;                          
    }  

    public function getLibroByRubro($rubro) {
        $libro = $this->readDataFilter("rubro.nombre='".$rubro."'");
        return $this->getLibro($libro[0]['idlibro']);     
    }  

    public function getTomosAbiertos() {
        $tomo = new tomo();
        return $tomo->getTomosAbiertos($this->request['idlibro']);
    }   
    public function getTomos(){
		return $this->readDataSQL("SELECT tomo.* FROM tomo WHERE tomo.idlibro=".$this->request['idlibro']);
    }
}

class apertura extends aperturaTable {
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    } 
}

class evento extends eventoTable {
    public function getEvento($valor){
        if(!is_array($valor) && $valor > 0) {
            $eventobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $eventobd = $valor;
        }  else {
            return null;
        }
        $this->request['idevento'] = $eventobd['idevento'];
        $this->request['fechaocurrencia'] = $eventobd['fechaocurrencia'];
        $this->request['tipoevento'] = $eventobd['tipoevento'];
        $this->request['cliente'] = $eventobd['cliente'];
        $this->request['nombreusuario'] = $eventobd['nombreusuario'];
        $this->request['clave'] = $eventobd['clave'];
        $this->request['descripcion'] = $eventobd['descripcion'];
        return $this;
    }    
}

class cierre extends cierreTable {
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }    
    public function getCierre($valor) {
        if(!is_array($valor) && $valor > 0) {
            $cierrebd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $cierrebd = $valor;
        }  else {
            return null;
        } 
        $this->request['idtomo'] = $cierrebd['idtomo'];
        $this->request['fecha'] = $cierrebd['fecha'];
        $this->request['registrador'] = $cierrebd['registrador'];
        $this->request['secretario'] = $cierrebd['secretario']; 
        return $this;        
    }   
}


class indice extends indiceTable {
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }
        
    public function getIndice($valor) {
        if(!is_array($valor) && $valor > 0) {
            $indicebd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $indicebd = $valor;
        }  else {
            return null;
        } 
        $this->request['idtomo'] = $indicebd['idtomo'];
        $this->request['fecha'] = $indicebd['fecha'];
        $this->request['registrador'] = $indicebd['registrador'];
        $this->request['secretario'] = $indicebd['secretario']; 
        return $this;        
    } 
    
    public function getItems() {
	/* utilizar esta consulta en lugar de la anterior
SELECT itm.idindice,itm.idtomo, itm.inscritos, itm.partida, itm.folio, itm.observaciones, r.nombre as rubro, a.idinscripcion, iotr.tipootrainscripcion as subrubro from itemindice itm left outer join rubro r on r.idrubro=itm.rubro left outer join acta a on (a.idtomo=itm.idtomo and a.folio=itm.folio and a.partida=itm.partida) left outer join inscripcionvaria iotr on a.idinscripcion=iotr.idinscripcionvaria where itm.idtomo=20; */
        //return $this->readDataSQL("SELECT * FROM itemindice WHERE idtomo = ".$this->request['idtomo']);
        return $this->readDataSQL("SELECT itm.idindice,itm.idtomo, itm.inscritos, itm.partida, itm.folio, itm.observaciones, r.nombre as rubro, a.idinscripcion, iotr.tipootrainscripcion as subrubro from itemindice itm left outer join rubro r on r.idrubro=itm.rubro left outer join acta a on (a.idtomo=itm.idtomo and a.folio=itm.folio and a.partida=itm.partida) left outer join inscripcionvaria iotr on a.idinscripcion=iotr.idinscripcionvaria where itm.idtomo=".$this->request['idtomo']);
    }  
}

class persona extends personaTable {
    public function getPersona($valor) {
        if(!is_array($valor) && $valor > 0) {
            $personabd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $personabd = $valor;
        }  else {
            return null;
        }          
        $this->request['idpersona'] = $personabd['idpersona'];
        $this->request['nombre1'] = $personabd['nombre1'];
        $this->request['nombre2'] = $personabd['nombre2'];
        $this->request['apellido1'] = $personabd['apellido1']; 
        $this->request['apellido2'] = $personabd['apellido2'];  
        $this->request['ocupacion'] = $personabd['ocupacion']; 
        $this->request['estadocivil'] = $personabd['estadocivil']; 
        $this->request['domicilio'] = $personabd['domicilio'];
        $this->request['sexo'] = $personabd['sexo'];
        $this->request['nacionalidad'] = $personabd['nacionalidad']; 
        $this->request['fechanacimiento'] = $personabd['fechanacimiento'];
        $this->request['ciudadnacimiento'] = $personabd['ciudadnacimiento']; 
        $this->request['municipionacimiento'] = $personabd['municipionacimiento']; 
        $this->request['departamentonacimiento'] = $personabd['departamentonacimiento'];
        $this->request['paisnacimiento'] = $personabd['paisnacimiento']; 
        return $this;
    }                                                                 
    
    public function getPersonaByCedula($cedula) {
         $idpersona = $this->getVar("SELECT idciudadano 
                                       FROM ciudadano
                                      WHERE cedula='".$cedula."'"); 
         return ($idpersona) ? $this->getPersona($idpersona) : '';                             
    }

    public function getIdByCedula($cedula) {
         $idpersona = $this->getVar("SELECT idciudadano 
                                       FROM ciudadano
                                      WHERE cedula='".$cedula."'"); 
         return $idpersona;                          
    } 
        
    
    public function getCiudadano() {
        $ciudadano = new ciudadano();
        return $ciudadano->getCiudadano($this->request['idpersona']);
    } 
    
    public function getEdad() {
        $annonacimiento = explode('-',$this->request['fechanacimiento']);
        $annoactual = date('Y');
        return  $annoactual -  $annonacimiento[0];
    } 
    
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    } 
    
    public function delete() {
         $ciudadano = new ciudadano();
         $ciudadano->deleteRecord($this->request[$this->key]);
         $participacion = new participacion();
         $participacion->deleteByPersona($this->request[$this->key]);
         $cliente = new cliente();
         $clientebd = $cliente->readDataFilter('cliente.idpersona='.$this->request[$this->key]);
         if($clientebd) {
             $recibo = new recibo();
             $pago = new pago();
             foreach ($clientebd as $arrcliente) {
                 $cliente->deleteRecord($arrcliente['idpersona'],$arrcliente['idrecibo']);
                 $solicitudtramite = $pago->getSolicitudtramiteByIdrecibo($arrcliente['idrecibo']);
                 $solicitudtramite->delete();
                 $recibobd = $recibo->getRecibo($arrcliente['idrecibo']);
                 $recibo->delete();
             }
         }
         $this->deleteRecord();
         
    }
    
    public function getReconocimiento(){
        $sql = "SELECT reconocido.*
                  FROM reconocido
                 WHERE reconocido.idpersona ='".$this->request['idpersona']."'";
        $reconocidodb =  $this->readDataSQL($sql);
        $reconocimientos = new reconocimiento();
        $reconocimiento = $reconocimientos->getReconocimiento($reconocidodb[0]['idreconocimiento']);
        return $reconocimiento;
    }
    
    public function getInscripcion(){
        $reconocimiento = $this->getReconocimiento();
        return $reconocimiento->getInscripcion();
    }  
    
    public function getIdByName($nombre) {
         $nombrebd = explode(' ',trim($nombre));
         $filter = '';
         switch (count($nombrebd)) {
             case 4:
                  $nombre1 = $nombrebd[0];
                  $nombre2 = $nombrebd[1];
                  $apellido1 = $nombrebd[2];
                  $apellido2 = $nombrebd[3];
                  break;
             case 3:
                  $nombre1 = $nombrebd[0];
                  $apellido1 = $nombrebd[1];
                  $apellido2 = $nombrebd[2];
                  break;
             case 2:
                  $nombre1 = $nombrebd[0];
                  $apellido1 = $nombrebd[1];
                  break;
             default:
                 break;
         }
         $filter.= ($nombre1 != '') ? " AND nombre1='".$nombre1."'" : "";
         $filter.= ($nombre2 != '') ? " AND nombre2='".$nombre2."'" : "";
         $filter.= ($apellido1 != '') ? " AND apellido1='".$apellido1."'" : "";
         $filter.= ($apellido2 != '') ? " AND apellido2='".$apellido2."'" : "";
         $idpersona = $this->getVar("SELECT idpersona 
                                       FROM persona
                                      WHERE idpersona!='-1'".$filter);
         return $idpersona;                          
    }        
}

class reconocido extends reconocidoTable{
    public function getReconocido($idpersona, $idreconocimiento) {
         $reconocidobd = $this->readRecord($idpersona, $idreconocimiento);
                   
         $this->request['idpersona'] = $reconocidobd['idpersona'];
         $this->request['idreconocimiento'] = $reconocidobd['idreconocimiento'];      
         return $this; 
     }
}

class ciudadano extends ciudadanoTable {   
     public function getCiudadano($valor) {
         if(!is_array($valor) && $valor > 0) {
             $ciudadanobd = $this->readRecord($valor);
         } elseif(is_array($valor)) {
             $ciudadanobd = $valor;
         } else {
             return null;
         }          
         $this->request['idciudadano'] = $ciudadanobd['idciudadano'];
         $this->request['cedula'] = $ciudadanobd['cedula']; 
         $this->request['centrovotacion'] = $ciudadanobd['centrovotacion']; 
         $this->request['jvr'] = $ciudadanobd['jvr'];
         $this->request['ubicacion'] = $ciudadanobd['ubicacion'];
         $this->request['direccion'] = $ciudadanobd['direccion']; 
         $this->request['municipio'] = $ciudadanobd['municipio'];
         $this->request['ciudad'] = $ciudadanobd['ciudad'];
         $this->request['departamento'] = $ciudadanobd['departamento']; 
         return $this; 
     }    
}

class inscripcion extends inscripcionTable {
    public function getInscripcion($valor) {
        if(!is_array($valor) && $valor > 0) {
            $inscripcionbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $inscripcionbd = $valor;
        } else {
           return null;
        } 
        $this->request['idinscripcion'] = $inscripcionbd['idinscripcion'];
        $this->request['numeroserie'] = $inscripcionbd['numeroserie'];
        $this->request['tipoinscripcion'] = $inscripcionbd['tipoinscripcion'];
        $this->request['inscrito1nombre1'] = $inscripcionbd['inscrito1nombre1'];
        $this->request['inscrito1nombre2'] = $inscripcionbd['inscrito1nombre2'];
        $this->request['inscrito1apellido1'] = $inscripcionbd['inscrito1apellido1']; 
        $this->request['inscrito1apellido2'] = $inscripcionbd['inscrito1apellido2']; 
        $this->request['ciudadinscripcion'] = $inscripcionbd['ciudadinscripcion'];
        $this->request['municipioinscripcion'] = $inscripcionbd['municipioinscripcion'];
        $this->request['departamentoinscripcion'] = $inscripcionbd['departamentoinscripcion']; 
        $this->request['compareciente1nombre'] = $inscripcionbd['compareciente1nombre']; 
        $this->request['compareciente1edad'] = $inscripcionbd['compareciente1edad']; 
        $this->request['compareciente1oficio'] = $inscripcionbd['compareciente1oficio']; 
        $this->request['compareciente1domicilio'] = $inscripcionbd['compareciente1domicilio']; 
        $this->request['compareciente1cedula'] = $inscripcionbd['compareciente1cedula'];  
        $this->request['enextranjero'] = $inscripcionbd['enextranjero']; 
        $this->request['observaciones'] = $inscripcionbd['observaciones']; 
        $this->request['datosadicionales'] = $inscripcionbd['datosadicionales'];
        $this->request['nombreregistrador'] = $inscripcionbd['nombreregistrador']; 
        $this->request['nombresecretario'] = $inscripcionbd['nombresecretario']; 
        $this->request['datosadicionales'] = $inscripcionbd['datosadicionales'];
        return $this;          
    }    
    
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    } 
    
    public function getLastNoserie() {
        return $this->getVar("SELECT MAX('numeroserie') FROM ".$this->name);
    } 
    
    public function getActa() {
        $acta = new acta();
        return $acta->getByInscripcion($this->request[$this->key]);
    }
    
    public function getHechoVital() {
        $hechovital = new hechovital();
        return $hechovital->getHechoVital($this->request[$this->key]);
    }  
     
    public function getRepoHechoVital() {
        $repohechovital = new reposicionhechovital();
        return $repohechovital->getRepoHechoVital($this->request[$this->key]);
    }
      
    public function getActojuridico() {
        $actojuridico = new actojuridico();
        return $actojuridico->getActojuridico($this->request[$this->key]);
    }   
       
    public function getNotasmarginales() {
       $notamarginal = new notamarginal();
       return $notamarginal->getNotasmarginalesByInscripcion($this->request[$this->key]);    
    }
    
    public function getTomo(){
        $acta = $this->getActa();
        $notomo = $acta->getNoTomo();
        $tomos = new tomo();
        $tomo = $tomos->getTomoByNumero($notomo);
        return $tomo;
    }
} 

class acta extends actaTable {
    public function getActa($valor) {
        if(!is_array($valor) && $valor > 0) {
            $actabd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $actabd = $valor;
        } else {
            return null;
        }
        $this->request['idacta'] = $actabd['idacta'];
        $this->request['idinscripcion'] = $actabd['idinscripcion'];
        $this->request['idtomo'] = $actabd['idtomo'];
        $this->request['folio'] = $actabd['folio'];
        $this->request['partida'] = $actabd['partida'];
        $this->request['fecha'] = $actabd['fecha'];
        return $this;
    }    
    public function getByInscripcion($idinscripcion) {
        $id = $this->getVar("SELECT idacta FROM acta WHERE idinscripcion=".$idinscripcion);
        $actabd = $this->getActa($id);
        return $actabd;    
    } 
      
    public function getNoTomo() {
       $notomo = $this->getVar("SELECT numero FROM tomo WHERE idtomo=".$this->request['idtomo']);
       return $notomo; 
    }
    
    public function getNacimientoByTomoFolio($idtomo,$folio) {
       $actabd = $this->readDataFilter('acta.idtomo='.$idtomo.' AND acta.folio=' . $folio); 
       $nacimiento = new nacimiento();
       $nacimientobd = $nacimiento->getNacimiento($actabd[0]['idinscripcion']);
       return $nacimientobd; 
    }  
    
    public function getInscripcionByTomoFolio($idtomo,$folio) {
       $actabd = $this->readDataFilter('acta.idtomo='.$idtomo.' AND acta.folio=' . $folio); 
       $inscripcion = new inscripcion();
       $inscripcionbd = $inscripcion->getInscripcion($actabd[0]['idinscripcion']);
       return $inscripcionbd; 
    }     
     
    public function getRepoNacimientoByTomoFolio($idtomo,$folio) {
       $actabd = $this->readDataFilter('acta.idtomo='.$idtomo.' AND acta.folio='.$folio); 
       $reponacimiento = new reposicionnacimiento();
       $reponacimientobd = $reponacimiento->getReposicionnacimiento($actabd[0]['idinscripcion']);
       return $reponacimientobd; 
    }  
    
    public function getMatrimonioByTomoFolio($idtomo,$folio) {
       $actabd = $this->readDataFilter('acta.idtomo='.$idtomo.' AND acta.folio=' . $folio); 
       $matrimonio = new matrimonio();
       $matrimoniobd = $matrimonio->getMatrimonio($actabd[0]['idinscripcion']);
       return $matrimoniobd; 
    }
    
    public function getDisolucionMatrimonioByTomoFolio($idtomo,$folio) {
       $actabd = $this->readDataFilter('acta.idtomo='.$idtomo.' AND acta.folio=' . $folio); 
       $disolucionmatrimonio = new disolucionmatrimonio();
       $disolucionmatrimoniobd = $disolucionmatrimonio->getDisolucionmatrimonio($actabd[0]['idinscripcion']);
       return $disolucionmatrimoniobd; 
    }    
    
    public function getActasByTomo($idtomo) {
       $arrayactasbd = $this->readDataFilter('acta.idtomo='.$idtomo);
       $arrayactas = '';
       $contador=0;
       $tomo = new tomo(); 
       $inscripcion = new inscripcion();
       $libroregistral = new libroregistral();
       foreach($arrayactasbd as $actabd) {
           $arrayactas[$contador]['idtomo'] = $idtomo;
           $inscripcionbd = $inscripcion->getInscripcion($actabd['idinscripcion']);
           $inscritos =  $inscripcionbd->request['inscrito1nombre1']. ' '.$inscripcionbd->request['inscrito1nombre2'].' '.$inscripcionbd->request['inscrito1apellido1'].' '.$inscripcionbd->request['inscrito1apellido2'];
           if(($inscripcionbd->request['tipoinscripcion'] == 'Matrimonios')|| $inscripcionbd->request['tipoinscripcion'] == 'Disolucion Vinculo Matrimonial') {
               if($inscripcionbd->request['tipoinscripcion'] == 'Matrimonios') {
                   $matrimonio = $this->getMatrimonioByTomoFolio($idtomo,$actabd['folio']);
                   $inscritos.= '<br>'.$matrimonio->request['inscrito2nombre1']. ' '.$matrimonio->request['inscrito2nombre2'].' '.$matrimonio->request['inscrito2apellido1'].' '.$matrimonio->request['inscrito2apellido2']; 
               } else {
                   $disolucionmatrimonio = $this->getDisolucionMatrimonioByTomoFolio($idtomo,$actabd['folio']);
                   $inscritos.= '<br>'.$disolucionmatrimonio->request['inscrito2nombre1']. ' '.$disolucionmatrimonio->request['inscrito2nombre2'].' '.$disolucionmatrimonio->request['inscrito2apellido1'].' '.$disolucionmatrimonio->request['inscrito2apellido2']; 
               }
           }
           $arrayactas[$contador]['inscritos'] = $inscritos;
           $arrayactas[$contador]['observaciones'] = $inscripcionbd->request['observaciones'];
           $arrayactas[$contador]['folio'] = $actabd['folio'];
           $arrayactas[$contador]['partida'] = $actabd['partida'];
           $tomobd = $tomo->getTomo($idtomo);
           $libroregistralbd = $libroregistral->getLibro($tomobd->request['idlibro']);
           $arrayactas[$contador]['rubro'] = $libroregistralbd->request['idrubro']; 
           $contador++;
       }
       return $arrayactas; 
    }           
}

class hechovital extends hechovitalTable {    
    public function getHechoVital($valor) {
        if(!is_array($valor) && $valor > 0) {
            $hechovitalbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $hechovitalbd = $valor;
        } else {
            return null;
        }
        $this->request['idhechovital'] = $hechovitalbd['idhechovital'];
        $this->request['sexoinscrito'] = $hechovitalbd['sexoinscrito'];
        $this->request['padrenombre'] = $hechovitalbd['padrenombre'];
        $this->request['nombremadre'] = $hechovitalbd['nombremadre']; 
        $this->request['ciudadnacimiento'] = $hechovitalbd['ciudadnacimiento'];
        $this->request['municipionacimiento'] = $hechovitalbd['municipionacimiento'];
        $this->request['departamentonacimiento'] = $hechovitalbd['departamentonacimiento'];  
        $this->request['paisnacimiento'] = $hechovitalbd['paisnacimiento'];  
        $this->request['fechanacimiento'] = $hechovitalbd['fechanacimiento'];   
        return $this;
    }     
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }
    public function getNacimiento(){
       $nacimiento = new nacimiento();
       return $nacimiento->getNacimiento($this->request[$this->key]);
    } 
    
    public function getDefuncion(){
       $defuncion = new defuncion();
       return $defuncion->getDefuncion($this->request[$this->key]);
    } 
        
}

class nacimiento extends nacimientoTable {    
    public function getNacimiento($valor) {
        if(!is_array($valor) && $valor > 0) {
            $nacimientolbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $nacimientolbd = $valor;
        } else {
            return null;
        }
        $this->request['idnacimiento'] = $nacimientolbd['idnacimiento'];
        $this->request['edadpadre'] = $nacimientolbd['edadpadre'];
        $this->request['oficiopadre'] = $nacimientolbd['oficiopadre'];
        $this->request['domiciliopadre'] = $nacimientolbd['domiciliopadre'];
        $this->request['nacionalidadpadre'] = $nacimientolbd['nacionalidadpadre'];
        $this->request['cedulapadre'] = $nacimientolbd['cedulapadre'];
        $this->request['edadmadre'] = $nacimientolbd['edadmadre'];  
        $this->request['oficiomadre'] = $nacimientolbd['oficiomadre'];  
        $this->request['domiciliopadre'] = $nacimientolbd['domiciliopadre']; 
        $this->request['domiciliomadre'] = $nacimientolbd['domiciliomadre'];
        $this->request['nacionalidadmadre'] = $nacimientolbd['nacionalidadmadre'];  
        $this->request['cedulamadre'] = $nacimientolbd['cedulamadre']; 
        $this->request['compareciente1nacionalidad'] = $nacimientolbd['compareciente1nacionalidad']; 
        $this->request['compareciente2nombre'] = $nacimientolbd['compareciente2nombre']; 
        $this->request['compareciente2edad'] = $nacimientolbd['compareciente2edad'];    
        $this->request['compareciente2oficio'] = $nacimientolbd['compareciente2oficio'];    
        $this->request['compareciente2domicilio'] = $nacimientolbd['compareciente2domicilio'];    
        $this->request['compareciente2nacionalidad'] = $nacimientolbd['compareciente2nacionalidad']; 
        $this->request['compareciente2cedula'] = $nacimientolbd['compareciente2cedula'];    
        $this->request['lugarinscripciondefuncion'] = $nacimientolbd['lugarinscripciondefuncion'];    
        $this->request['tomoinscripciondefuncion'] = $nacimientolbd['tomoinscripciondefuncion'];  
        $this->request['folioinscripciondefuncion'] = $nacimientolbd['folioinscripciondefuncion'];    
        $this->request['partidainscripciondefuncion'] = $nacimientolbd['partidainscripciondefuncion'];   
        $this->request['anyoinscripciondefuncion'] = $nacimientolbd['anyoinscripciondefuncion'];       
        return $this;
    }  
}

class asientoregistral extends asientoregistralTable {    
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    } 
    
}

class rol extends rolTable {
    public function getRol($valor) {
        if(!is_array($valor) && $valor > 0) {
            $rolbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $rolbd = $valor;
        }  else {
            return null;
        }        
        $this->request['idrol'] = $rolbd['idrol'];
        $this->request['nombrerol'] = $rolbd['nombrerol'];
        $this->request['definicion'] = $rolbd['definicion']; 
        return $this;
    } 
        
    public function getAreas() {
        $Areas = $this->readDataSQL("SELECT area.* 
                                       FROM rol_areas 
                                 INNER JOIN area
                                         ON rol_areas.idarea = area.idarea
                                      WHERE rol_areas.idrol=".$this->request['idrol']); 
        return $Areas;                                      
    }

    public function getPrivilegios() {
        $privilegios = $this->readDataSQL("SELECT privilegio.* 
                                       FROM privilegio 
                                 INNER JOIN asignacionprivilegio
                                         ON privilegio.idprivilegio = asignacionprivilegio.idprivilegio
                                      WHERE asignacionprivilegio.idrol=".$this->request['idrol']); 
        return $privilegios;                                      
    } 
    
    public function getCantAreas() {
        $cant = $this->readDataSQL("SELECT count(*) 
                                       FROM rol_areas 
                                 INNER JOIN area
                                         ON rol_areas.idarea = area.idarea
                                      WHERE rol_areas.idrol=".$this->request['idrol']); 
        return $cant;         
    }

    public function setAreas($arrayAreas) {
        //elimino primero a todas las relaciones que incluyen a este rol
        $this->deleteAreas(); 
        foreach ($arrayAreas as $area=> $valor){      
            $rolareas = new rol_areasTable();
            $_REQUEST['idarea'] = $valor;
            $_REQUEST['idrol'] = $this->request['idrol'];
            $rolareas->readEnv(); 
            $rolareas->addRecord();
        }  
    } 
    
    public function setPrivilegios($arrayPrivilegiosAsignados) {
        //elimino primero a todas las relaciones que incluyen a este rol
        $this->deletePrivilegios();
        foreach ($arrayPrivilegiosAsignados as $privilegio => $valor){
            $priveligio = new privilegioTable();
            $_REQUEST['idprivilegio'] = $valor;
            $_REQUEST['idrol'] = $this->request['idrol'];
            $priveligio->readEnv(); 
            $priveligio->addRecord();
        }
    } 
    
    public function deleteAreas() {
        $rolareas = new rol_areasTable();          
        $sql = "DELETE FROM rol_areas
                 WHERE rol_areas.idrol ='".$this->request['idrol']."'";
        $rolareas->readDataSQL($sql); 
    } 

    public function deletePrivilegios() {
        $privilegioasignado = new asignacionprivilegioTable();       
        $sql = "DELETE FROM asignacionprivilegio
                 WHERE asignacionprivilegio.idrol ='".$this->request['idrol']."'";
        $privilegioasignado->readDataSQL($sql); 
    } 
    
    public function deleteUsuario() {
        $privilegioasignado = new asignacionprivilegioTable();      
        $sql = "DELETE FROM usuario
                 WHERE usuario.idrol ='".$this->request['idrol']."'";
        $privilegioasignado->readDataSQL($sql); 
    }     
    
    public function delete() {
        $this->deletePrivilegios(); 
        $this->deleteAreas();
        $this->deleteUsuario();
        $this->deleteRecord();
        
    }
    
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }    
}

class defuncion extends defuncionTable {    
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }
    
    public function getDefuncion($valor) {
        if(!is_array($valor) && $valor > 0) {
            $defuncionbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $defuncionbd = $valor;
        } else {
            return null;
        }
        $this->request['iddefuncion'] = $defuncionbd['iddefuncion'];
        $this->request['causamuerte'] = $defuncionbd['causamuerte'];
        $this->request['fechadefuncion'] = $defuncionbd['fechadefuncion'];
        $this->request['ciudaddefuncion'] = $defuncionbd['ciudaddefuncion'];
        $this->request['municipiodefuncion'] = $defuncionbd['municipiodefuncion'];
        $this->request['departamentodefuncion'] = $defuncionbd['departamentodefuncion'];
        $this->request['paisdefuncion'] = $defuncionbd['paisdefuncion'];  
        $this->request['edadfallecido'] = $defuncionbd['edadfallecido'];  
        $this->request['oficiofallecido'] = $defuncionbd['oficiofallecido']; 
        $this->request['estadocivil'] = $defuncionbd['estadocivil'];
        $this->request['domiciliofallecido'] = $defuncionbd['domiciliofallecido'];  
        $this->request['nacionalidadfallecido'] = $defuncionbd['nacionalidadfallecido']; 
        $this->request['cedulafallecido'] = $defuncionbd['cedulafallecido']; 
        $this->request['conyugenombre'] = $defuncionbd['conyugenombre']; 
        $this->request['lugarinscripcionnacimiento'] = $defuncionbd['lugarinscripcionnacimiento'];    
        $this->request['tomoinscripcionnacimiento'] = $defuncionbd['tomoinscripcionnacimiento'];    
        $this->request['folioinscripcionnacimiento'] = $defuncionbd['folioinscripcionnacimiento'];    
        $this->request['partidainscripcionnacimiento'] = $defuncionbd['partidainscripcionnacimiento']; 
        return $this;    
    } 
    
    public function getInscripcionNacimiento() {
         $tomo = new tomo();
         $idtomo = $tomo->getIdTomoByLibroNumero('Nacimientos',$this->request['tomoinscripcionnacimiento']);
         $idinscripcion = 0;
         if($idtomo) {
             $idinscripcion = $this->getVar("SELECT idinscripcion FROM acta
                                                                 WHERE idtomo=".$idtomo."
                                                                   AND folio=".$this->request['folioinscripcionnacimiento']); 
             $inscripcion = new inscripcion();
         }                                                      
         return  ($idinscripcion > 0) ? $inscripcion->getInscripcion($idinscripcion) : NULL;                                                         
    }  
    
    public function getEdad() {
        $inscripcion = $this->getInscripcionNacimiento();
        $hechovital = $inscripcion->getHechoVital();
        $annonacimiento = explode('-',$hechovital->request['fechanacimiento']);
        $annodefuncion = explode('-',$this->request['fechadefuncion']);
        return  $annodefuncion[0] -  $annonacimiento[0];
    }       
}

class participacion extends participacionTable {
    public function deleteByPersona($id) {
        $participaciones = $this->readDataFilter('participacion.idpersona='.$id);
        if($participacionesicipaciones) {
            foreach($participaciones as $participacion) {
                $this->deleteRecord($participacion['idpersona'],$participacion['idinscripcion']);
            }
        }
    }    
}

class matrimonio extends matrimonioTable {
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }    
    public function getMatrimonio($valor) {
        if(!is_array($valor) && $valor > 0) {
            $matrimoniobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $matrimoniobd = $valor;
        } else {
            return null;
        } 
        $this->request['idmatrimonio'] = $matrimoniobd['idmatrimonio'];
        $this->request['inscrito2nombre1'] = $matrimoniobd['inscrito2nombre1'];
        $this->request['inscrito2nombre2'] = $matrimoniobd['inscrito2nombre2'];
        $this->request['inscrito2apellido1'] = $matrimoniobd['inscrito2apellido1'];
        $this->request['inscrito2apellido2'] = $matrimoniobd['inscrito2apellido2'];
        $this->request['conyuge1nombre'] = $matrimoniobd['conyuge1nombre'];
        $this->request['conyuge1edad'] = $matrimoniobd['conyuge1edad'];  
        $this->request['conyuge1oficio'] = $matrimoniobd['conyuge1oficio'];  
        $this->request['conyuge1estadocivilanterior'] = $matrimoniobd['conyuge1estadocivilanterior']; 
        $this->request['conyuge1nacionalidad'] = $matrimoniobd['conyuge1nacionalidad'];
        $this->request['conyuge1domicilio'] = $matrimoniobd['conyuge1domicilio'];  
        $this->request['conyuge1cedula'] = $matrimoniobd['conyuge1cedula']; 
        $this->request['conyuge2nombre'] = $matrimoniobd['conyuge2nombre']; 
        $this->request['conyuge2edad'] = $matrimoniobd['conyuge2edad'];    
        $this->request['conyuge2oficio'] = $matrimoniobd['conyuge2oficio'];    
        $this->request['conyuge2nacionalidad'] = $matrimoniobd['conyuge2nacionalidad'];    
        $this->request['conyuge2estadocivilanterior'] = $matrimoniobd['conyuge2estadocivilanterior']; 
        $this->request['conyuge2domicilio'] = $matrimoniobd['conyuge2domicilio'];  
        $this->request['conyuge2cedula'] = $matrimoniobd['conyuge2cedula'];      
        $this->request['testigo1nombre'] = $matrimoniobd['testigo1nombre']; 
        $this->request['testigo1edad'] = $matrimoniobd['testigo1edad'];    
        $this->request['testigo1oficio'] = $matrimoniobd['testigo1oficio'];    
        $this->request['testigo1estadocivil'] = $matrimoniobd['testigo1estadocivil']; 
        $this->request['testigo1domicilio'] = $matrimoniobd['testigo1domicilio'];  
        $this->request['testigo1cedula'] = $matrimoniobd['testigo1cedula'];  
        $this->request['testigo2nombre'] = $matrimoniobd['testigo2nombre']; 
        $this->request['testigo2edad'] = $matrimoniobd['testigo2edad'];    
        $this->request['testigo2oficio'] = $matrimoniobd['testigo2oficio'];    
        $this->request['testigo2estadocivil'] = $matrimoniobd['testigo2estadocivil']; 
        $this->request['testigo2domicilio'] = $matrimoniobd['testigo2domicilio'];  
        $this->request['testigo2cedula'] = $matrimoniobd['testigo2cedula'];  
        $this->request['conyuge1lugarinscripcion'] = $matrimoniobd['conyuge1lugarinscripcion']; 
        $this->request['conyuge1tomoinscripcion'] = $matrimoniobd['conyuge1tomoinscripcion'];    
        $this->request['conyuge1folioinscripcion'] = $matrimoniobd['conyuge1folioinscripcion'];    
        $this->request['conyuge1partidainscripcion'] = $matrimoniobd['conyuge1partidainscripcion']; 
        $this->request['conyuge1anyoinscripcion'] = $matrimoniobd['conyuge1anyoinscripcion'];  
        $this->request['conyuge2lugarinscripcion'] = $matrimoniobd['conyuge1lugarinscripcion']; 
        $this->request['conyuge2tomoinscripcion'] = $matrimoniobd['conyuge2tomoinscripcion'];    
        $this->request['conyuge2folioinscripcion'] = $matrimoniobd['conyuge2folioinscripcion'];    
        $this->request['conyuge2partidainscripcion'] = $matrimoniobd['conyuge2partidainscripcion']; 
        $this->request['conyuge2anyoinscripcion'] = $matrimoniobd['conyuge2anyoinscripcion'];                              
        return $this;          
    }
    
    public function getNacimientoConyuge($conyuge) {
         $tomo = new tomo();
         $idinscripcion = 0;
         $idtomo = $tomo->getIdTomoByLibroNumero('Nacimientos',$this->request[$conyuge.'tomoinscripcion']);
         if($idtomo) {
             $idinscripcion = $this->getVar("SELECT idinscripcion FROM acta
                                                                 WHERE idtomo=".$idtomo."
                                                                   AND folio=".$this->request[$conyuge.'folioinscripcion']); 
             $inscripcion = new inscripcion();
         }                                                               
	//print_r($inscripcion);
         return  ($idinscripcion > 0) ? $inscripcion->getInscripcion($idinscripcion) : NULL;   
    }
        
}

class reposicionmatrimonio extends reposicionmatrimonioTable {
    public function getReposicionmatrimonio($valor) {
        if(!is_array($valor) && $valor > 0) {
            $repomatrimoniobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $repomatrimoniobd = $valor;
        } else {
            return null;
        } 
        $this->request['idreposicionmatrimonio'] = $repomatrimoniobd['idreposicionmatrimonio'];
        $this->request['inscrito2nombre1'] = $repomatrimoniobd['inscrito2nombre1'];
        $this->request['inscrito2nombre2'] = $repomatrimoniobd['inscrito2nombre2'];
        $this->request['inscrito2apellido1'] = $repomatrimoniobd['inscrito2apellido1'];
        $this->request['inscrito2apellido2'] = $repomatrimoniobd['inscrito2apellido2'];
        $this->request['conyuge1nombre'] = $repomatrimoniobd['conyuge1nombre'];
        $this->request['conyuge1edad'] = $repomatrimoniobd['conyuge1edad'];  
        $this->request['conyuge1oficio'] = $repomatrimoniobd['conyuge1oficio'];  
        $this->request['conyuge1estadocivilanterior'] = $repomatrimoniobd['conyuge1estadocivilanterior']; 
        $this->request['conyuge1nacionalidad'] = $repomatrimoniobd['estadocivil'];
        $this->request['conyuge1domicilio'] = $repomatrimoniobd['conyuge1domicilio'];  
        $this->request['conyuge1cedula'] = $repomatrimoniobd['conyuge1cedula']; 
        $this->request['conyuge2nombre'] = $repomatrimoniobd['conyuge2nombre']; 
        $this->request['conyugenombre'] = $repomatrimoniobd['conyugenombre']; 
        $this->request['conyuge2edad'] = $repomatrimoniobd['conyuge2edad'];    
        $this->request['conyuge2oficio'] = $repomatrimoniobd['conyuge2oficio'];    
        $this->request['conyuge2nacionalidad'] = $repomatrimoniobd['conyuge2nacionalidad'];    
        $this->request['conyuge2estadocivilanterior'] = $repomatrimoniobd['conyuge2estadocivilanterior']; 
        $this->request['conyuge2domicilio'] = $repomatrimoniobd['conyuge2domicilio'];  
        $this->request['conyuge2cedula'] = $repomatrimoniobd['conyuge2cedula'];      
        $this->request['testigo1nombre'] = $repomatrimoniobd['testigo1nombre']; 
        $this->request['testigo1edad'] = $repomatrimoniobd['testigo1edad'];    
        $this->request['testigo1oficio'] = $repomatrimoniobd['testigo1oficio'];    
        $this->request['testigo1estadocivil'] = $repomatrimoniobd['testigo1estadocivil']; 
        $this->request['testigo1domicilio'] = $repomatrimoniobd['testigo1domicilio'];  
        $this->request['testigo1cedula'] = $repomatrimoniobd['testigo1cedula'];  
        $this->request['testigo2nombre'] = $repomatrimoniobd['testigo1nombre']; 
        $this->request['testigo2edad'] = $repomatrimoniobd['testigo1edad'];    
        $this->request['testigo2oficio'] = $repomatrimoniobd['testigo1oficio'];    
        $this->request['testigo2estadocivil'] = $repomatrimoniobd['testigo1estadocivil']; 
        $this->request['testigo2domicilio'] = $repomatrimoniobd['testigo1domicilio'];  
        $this->request['testigo2cedula'] = $repomatrimoniobd['testigo2cedula']; 
        $this->request['conyuge1lugarinscripcion'] = $repomatrimoniobd['conyuge1lugarinscripcion']; 
        $this->request['conyuge1tomoinscripcion'] = $repomatrimoniobd['conyuge1tomoinscripcion'];    
        $this->request['conyuge1folioinscripcion'] = $repomatrimoniobd['conyuge1folioinscripcion'];    
        $this->request['conyuge1partidainscripcion'] = $repomatrimoniobd['conyuge1partidainscripcion']; 
        $this->request['conyuge1anyoinscripcion'] = $repomatrimoniobd['conyuge1anyoinscripcion'];  
        $this->request['conyuge2lugarinscripcion'] = $repomatrimoniobd['conyuge2lugarinscripcion']; 
        $this->request['conyuge2tomoinscripcion'] = $repomatrimoniobd['conyuge2tomoinscripcion'];    
        $this->request['conyuge2folioinscripcion'] = $repomatrimoniobd['conyuge2folioinscripcion'];    
        $this->request['conyuge2partidainscripcion'] = $repomatrimoniobd['conyuge2partidainscripcion']; 
        $this->request['conyuge2anyoinscripcion'] = $repomatrimoniobd['conyuge2anyoinscripcion'];                          
	// campos dicionales
	// datos del oficio de matrimonio
        $this->request['oficiojueznotario'] = $repomatrimoniobd['oficiojueznotario'];
        $this->request['oficiomunicipio'] = $repomatrimoniobd['oficiomunicipio'];
        $this->request['oficiodepartamento'] = $repomatrimoniobd['oficiodepartamento'];
        $this->request['oficiofecha'] = $repomatrimoniobd['oficiofecha'];
	//nombres de los padre
        $this->request['conyuge1nombrepadre'] = $repomatrimoniobd['conyuge1nombrepadre'];
        $this->request['conyuge1nombremadre'] = $repomatrimoniobd['conyuge1nombremadre'];
        $this->request['conyuge2nombrepadre'] = $repomatrimoniobd['conyuge2nombrepadre'];
        $this->request['conyuge2nombremadre'] = $repomatrimoniobd['conyuge2nombremadre'];
        return $this;          
    }  

    public function getNacimientoConyuge($conyuge) {
         $idinscripcion = $this->getVar("SELECT idinscripcion FROM acta
                                                             WHERE idtomo=".$this->request[$conyuge.'tomoinscripcion']."
                                                               AND folio=".$this->request[$conyuge.'folioinscripcion']); 
         $inscripcion = new inscripcion();
         return  $inscripcion->getInscripcion($idinscripcion);  
    }          
}

class actojuridico extends actojuridicoTable {
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }
    
    public function getActojuridico($valor) {
         if(!is_array($valor) && $valor > 0) {
            $actojuridicobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $actojuridicobd = $valor;
        } else {
            return null;
        } 
        $this->request['idactojuridico'] = $actojuridicobd['idactojuridico'];
        $this->request['jueznotario'] = $actojuridicobd['jueznotario'];
        $this->request['nombrejuzgado'] = $actojuridicobd['nombrejuzgado']; 
        $this->request['lugarjuzgado'] = $actojuridicobd['lugarjuzgado'];
        $this->request['fechadictament'] = $actojuridicobd['fechadictament'];
        return $this;
    }
     
    public function getMatrimonio(){
       $matrimonio = new matrimonio();
       return $matrimonio->getMatrimonio($this->request[$this->key]);
    }  
    
    public function getReposicionmatrimonio(){
       $repomatrimonio = new reposicionmatrimonio();
       return $repomatrimonio->getReposicionmatrimonio($this->request[$this->key]);
    } 
    
    public function getInscripcionvaria() {
       $inscripcionvaria = new inscripcionvaria();
       return  $inscripcionvaria->getInscripcionvaria($this->request[$this->key]);
    } 
    
    public function getDisolucionmatrimonio(){
       $disolucionmatrimonio = new disolucionmatrimonio();
       return $disolucionmatrimonio->getDisolucionmatrimonio($this->request[$this->key]);
    }            
}

class reposicionnacimiento extends reposicionnacimientoTable {
    public function getReposicionnacimiento($valor) {
        if(!is_array($valor) && $valor > 0) {
            $reponacimientobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $reponacimientobd = $valor;
        } else {
            return null;
        } 
        $this->request['idreposicionnacimiento'] = $reponacimientobd['idreposicionnacimiento'];
        $this->request['lugarinscripciondefuncion'] = $reponacimientobd['lugarinscripciondefuncion'];
        $this->request['tomoinscripciondefuncion'] = $reponacimientobd['tomoinscripciondefuncion'];
        $this->request['folioinscripciondefuncion'] = $reponacimientobd['folioinscripciondefuncion'];
        $this->request['partidainscripciondefuncion'] = $reponacimientobd['partidainscripciondefuncion']; 
        $this->request['anyoinscripciondefuncion'] = $reponacimientobd['anyoinscripciondefuncion'];
        $this->request['edadpadre'] = $reponacimientobd['edadpadre'];
        $this->request['oficiopadre'] = $reponacimientobd['oficiopadre'];
        $this->request['domiciliopadre'] = $reponacimientobd['domiciliopadre'];
        $this->request['nacionalidadpadre'] = $reponacimientobd['nacionalidadpadre'];
        $this->request['cedulapadre'] = $reponacimientobd['cedulapadre'];
        $this->request['edadmadre'] = $reponacimientobd['edadmadre'];  
        $this->request['oficiomadre'] = $reponacimientobd['oficiomadre'];  
        $this->request['domiciliopadre'] = $reponacimientobd['domiciliopadre']; 
        $this->request['domiciliomadre'] = $reponacimientobd['domiciliomadre'];
        $this->request['nacionalidadmadre'] = $reponacimientobd['nacionalidadmadre'];  
        $this->request['cedulamadre'] = $reponacimientobd['cedulamadre']; 
        return $this;      
    } 
} 

class reposiciondefuncion extends reposiciondefuncionTable {
    public function getReposiciondefuncion($valor) {
        if(!is_array($valor) && $valor > 0) {
            $repodefuncionbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $repodefuncionbd = $valor;
        } else {
            return null;
        } 
        $this->request['idreposiciondefuncion'] = $repodefuncionbd['idreposiciondefuncion'];
        $this->request['causamuerte'] = $repodefuncionbd['causamuerte'];
        $this->request['fechadefuncion'] = $repodefuncionbd['fechadefuncion'];
        $this->request['ciudaddefuncion'] = $repodefuncionbd['ciudaddefuncion'];
        $this->request['municipiodefuncion'] = $repodefuncionbd['municipiodefuncion'];
        $this->request['departamentodefuncion'] = $repodefuncionbd['departamentodefuncion'];
        $this->request['paisdefuncion'] = $repodefuncionbd['paisdefuncion'];  
        $this->request['estadocivil'] = $repodefuncionbd['estadocivil'];
        $this->request['conyugenombre'] = $repodefuncionbd['conyugenombre']; 
        $this->request['lugarinscripcionnacimiento'] = $repodefuncionbd['lugarinscripcionnacimiento'];    
        $this->request['tomoinscripcionnacimiento'] = $repodefuncionbd['tomoinscripcionnacimiento'];    
        $this->request['folioinscripcionnacimiento'] = $repodefuncionbd['folioinscripcionnacimiento'];    
        $this->request['partidainscripcionnacimiento'] = $repodefuncionbd['partidainscripcionnacimiento'];  
        return $this;      
    } 
    
    public function getInscripcionNacimiento() {
         $tomo = new tomo();
         $idtomo = $tomo->getIdTomoByLibroNumero('Reposicion Defuncion',$this->request['tomoinscripcionnacimiento']);
         $idinscripcion = 0;
         if($idtomo) {
             $idinscripcion = $this->getVar("SELECT idinscripcion FROM acta
                                                                 WHERE idtomo=".$idtomo."
                                                                   AND folio=".$this->request['folioinscripcionnacimiento']); 
             $inscripcion = new inscripcion();
         }
         return  ($idinscripcion > 0) ? $inscripcion->getInscripcion($idinscripcion) : NULL;                                                         
    }      
    
    
} 

class reposicionhechovital extends reposicionhechovitalTable {
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }
        
    public function getRepoHechoVital($valor) {
        if(!is_array($valor) && $valor > 0) {
            $repohechovitalbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $repohechovitalbd = $valor;
        } else {
            return null;
        } 
        $this->request['idreposicionhechovital'] = $repohechovitalbd['idreposicionhechovital'];
        $this->request['jueznotario'] = $repohechovitalbd['jueznotario'];
        $this->request['nombrejuzgado'] = $repohechovitalbd['nombrejuzgado']; 
        $this->request['lugarjuzgado'] = $repohechovitalbd['lugarjuzgado'];
        $this->request['fechadictament'] = $repohechovitalbd['fechadictament'];        
        $this->request['sexoinscrito'] = $repohechovitalbd['sexoinscrito'];
        $this->request['padrenombre'] = $repohechovitalbd['padrenombre'];
        $this->request['nombremadre'] = $repohechovitalbd['nombremadre'];
        $this->request['ciudadnacimiento'] = $repohechovitalbd['ciudadnacimiento']; 
        $this->request['municipionacimiento'] = $repohechovitalbd['municipionacimiento'];   
        $this->request['departamentonacimiento'] = $repohechovitalbd['municipionacimiento'];
        $this->request['paisnacimiento'] = $repohechovitalbd['municipionacimiento'];
        $this->request['fechanacimiento'] = $repohechovitalbd['fechanacimiento'];  
        return $this;   
    } 
    
    public function getReposicionnacimiento() {
       $reponacimiento = new reposicionnacimiento();
       return $reponacimiento->getReposicionnacimiento($this->request[$this->key]);    
    }   
    
    public function getReposiciondefuncion() {
       $repodefuncion = new reposiciondefuncion();
       return $repodefuncion->getReposiciondefuncion($this->request[$this->key]);    
    }
} 

class definicionperfil extends definicionperfilTable {
    public function getDefinicionperfil($idperfil,$idparametro){
        $DFbd = $this->readRecord($idperfil,$idparametro); 
        $this->request['idperfil'] = $DFbd['idperfil'];
        $this->request['idparametro'] = $DFbd['idparametro'];
        $this->request['valor'] = $DFbd['valor'];   
        return $this;
    }
    
    public function getExistedefinicion($idperfil,$idparametro){
        $DFbd = $this->getDefinicionperfil($idperfil,$idparametro);
        if(is_null($DFbd->request['valor'])){
            return false;
        }else{
            return true;
        }
    }
}

class parametro extends parametroTable {
    public function getParametro($valor){
        if(!is_array($valor) && $valor > 0) {
            $parametrobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $parametrobd = $valor;
        }  else {
            return null;
        }
        $this->request['idparametro'] = $parametrobd['idparametro'];
        $this->request['clave'] = $parametrobd['clave'];
        $this->request['tipo'] = $parametrobd['tipo']; 
        $this->request['definicion'] = $parametrobd['definicion'];
        return $this;
    }
}

class configuracioncontexto extends configuracioncontextoTable {
    public function getConfiguracioncontexto($idparametro,$idcontexto){
        $confbd = $this->readRecord($idparametro,$idcontexto);
        $this->request['idparametro'] = $confbd['idparametro'];
        $this->request['idcontexto'] = $confbd['idcontexto'];
        $this->request['valor'] = $confbd['valor']; 
        return $this;
    }
}

class contexto extends contextoTable {
    public function getContexto($valor){
        if(!is_array($valor) && $valor > 0) {
            $contextobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $contextobd = $valor;
        } else {
           return null;
        } 
        $this->request['idcontexto'] = $contextobd['idcontexto'];
        $this->request['nombre'] = $contextobd['nombre'];
        $this->request['descripcion'] = $contextobd['descripcion']; 
        return $this;
    }
}
//cambiar
class solicitudtramite extends solicitudtramiteTable{
    public function getSolicitudtramite($valor){
        if(!is_array($valor) && $valor > 0) {
            $solicitudbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $solicitudbd = $valor;
        } else {
           return null;
        }
        $this->request['idsolicitudtramite'] = $solicitudbd['idsolicitudtramite'];
        $this->request['tipotramite'] = $solicitudbd['tipotramite'];
        $this->request['excento'] = $solicitudbd['excento']; 
        $this->request['prioridad'] = $solicitudbd['prioridad']; 
        $this->request['fecha'] = $solicitudbd['fecha']; 
        $this->request['fechaentrega'] = $solicitudbd['fechaentrega']; 
        $this->request['estado'] = $solicitudbd['estado']; 
        $this->request['solicitante1'] = $solicitudbd['solicitante1']; 
        $this->request['solicitante2'] = $solicitudbd['solicitante2']; 
        return $this;
    } 
    
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }

    public function getTipotramite(){
        $tipotramites = new tipotramite();
        $tipotramite = $tipotramites->readDataFilter("tipotramite.tipotramite='".$this->request['tipotramite']."'");
        return $tipotramite;
    }
    
    public function getTipoSolicitud(){
        $tipo1 = $this->getSolicitudCertificacion();
        $tipo2 = $this->getSolicitudInscripcion();
        
        if(!is_null($tipo1)){
            return 'certificacion';
        }elseif(!is_null($tipo2)){
            return 'inscripcion';        
        }
    }
    
    public function getSolicitudInscripcion(){
        $solicitudes = new solicitudinscripcion();
        $inscripcion = $solicitudes->getSolicitudinscripcion($this->request['idsolicitudtramite']); 
        if(is_null($inscripcion->request['idsolicitudinscripcion'])){
            return NULL;
        }else{
            return $inscripcion;
        }        
    }
    
    public function getSolicitudCertificacion(){
        $solicitudes = new solicitudcertificacion();
        $certificacion = $solicitudes->getSolicitudcertificacion($this->request['idsolicitudtramite']);
        if(is_null($certificacion->request['idsolicitudcertificacion'])){
            return NULL;
        }else{
            return $certificacion;
        } 
    }
    
    public function getPatrocinio(){
        $sql = "SELECT patrocinio.*    
                  FROM patrocinio
                 WHERE patrocinio.idsolicitudtramite = '".$this->request['idsolicitudtramite']."'";
        $patrociniodb = $this->readDataSQL($sql);
        if(is_null($patrociniodb[0]['idorganizacion'])){
            return NULL;
        }else{
            $patrocinios = new patrocinio();
            $patrocinio = $patrocinios->getPatrocinio($this->request['idsolicitudtramite'],$patrociniodb[0]['idorganizacion']);
            return $patrocinio;
        }
    }
    
    public function getPago(){
        $sql = "SELECT pago.*    
                  FROM pago
                 WHERE pago.idsolicitudtramite = '".$this->request['idsolicitudtramite']."'";
        $pagodb = $this->readDataSQL($sql);
        if(is_null($pagodb[0]['idrecibo'])){
            return NULL;
        }else{
            $pagos = new pago();
            $pago = $pagos->getPago($pagodb[0]['idrecibo'], $this->request['idsolicitudtramite']);
            return $pago;
        }
    }
    
    public function deleteSolicitudInscripcion(){
        $inscripcion = $this->getSolicitudInscripcion();   
        if(!is_null($inscripcion)) $inscripcion->delete();
    }
    
    public function deleteSolicitudCertificacion(){
        $certificacion = $this->getSolicitudCertificacion();
        if(!is_null($certificacion)) $certificacion->delete();
    }
    
    public function deletePatrocinio(){
        $patrocinio = $this->getPatrocinio();
        if(!is_null($patrocinio)) $patrocinio->deleteRecord();
    }
    
    public function deletePago(){
        $pago = $this->getPago();
        if(!is_null($pago)) $pago->deleteRecord();
    }
    
    public function delete(){
        $this->deletePago();
        $this->deleteSolicitudInscripcion();
        $this->deleteSolicitudCertificacion();
        $this->deletePatrocinio();         
        $this->deleteRecord();
    }
}
//cambiar
class solicitudcertificacion extends solicitudcertificacionTable {
    public function getSolicitudcertificacion($valor){
        if(!is_array($valor) && $valor > 0) {
            $solicitudbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $solicitudbd = $valor;
        } else {
           return null;
        }
        $this->request['idsolicitudcertificacion'] = $solicitudbd['idsolicitudcertificacion'];
        $this->request['tipocertificacion'] = $solicitudbd['tipocertificacion'];
        $this->request['fechanacimiento'] = $solicitudbd['fechanacimiento'];
        $this->request['nombrepadre'] = $solicitudbd['nombrepadre']; 
        $this->request['nombremadre'] = $solicitudbd['nombremadre'];  
        $this->request['tomo'] = $solicitudbd['tomo']; 
        $this->request['folio'] = $solicitudbd['folio']; 
        $this->request['partida'] = $solicitudbd['partida']; 
        $this->request['anyo'] = $solicitudbd['anyo']; 
        $this->request['fecharegistro'] = $solicitudbd['fecharegistro']; 
        $this->request['fechainscripcion'] = $solicitudbd['fechainscripcion']; 
        return $this;
    }
    
    public function getRespuesta(){
        $sql = "SELECT respuestasolicitudcertificacion.*    
                  FROM respuestasolicitudcertificacion
                 WHERE respuestasolicitudcertificacion.idsolicitudcertificacion = '".$this->request['idsolicitudcertificacion']."'";
        $respuestadb = $this->readDataSQL($sql);
        if(is_null($respuestadb[0]['idcertificacion'])){
            return NULL;
        } else{
            $respuestas = new respuestasolicitudcertificacion();
            $respuesta = $respuestas->getRespuestaSolicitudCertificacion($respuestadb[0]['idcertificacion'],$this->request['idsolicitudcertificacion']);
            return $respuesta;
        }    
    }
    
    public function deleteRespuesta(){
        $respuesta = $this->getRespuesta();
        if(!is_null($respuesta))$respuesta->deleteRecord();
    }
    
    public function delete(){
       //$this->deleteRespuesta();
       $this->deleteRecord();
    }    
}
//cambiar
class solicitudinscripcion extends solicitudinscripcionTable {
    public function getSolicitudinscripcion($valor){
        if(!is_array($valor) && $valor > 0) {  
            $solicitudbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $solicitudbd = $valor;
        } else {
           return null;
        }
        $this->request['idsolicitudinscripcion'] = $solicitudbd['idsolicitudinscripcion'];
        $this->request['tipoinscripcion'] = $solicitudbd['tipoinscripcion'];
        $this->request['nombreinscrito1'] = $solicitudbd['nombreinscrito1']; 
        $this->request['nombreinscrito2'] = $solicitudbd['nombreinscrito2']; 
        return $this;
    }
    
    public function getRespuesta(){
        $sql = "SELECT respuestasolicitudinscripcion.*    
                  FROM respuestasolicitudinscripcion
                 WHERE respuestasolicitudinscripcion.idsolicitudinscripcion = '".$this->request['idsolicitudinscripcion']."'";
        $respuestadb = $this->readDataSQL($sql);
        if(is_null($respuestadb[0]['idinscripcion'])){
            return NULL;
        } else{
            $respuestas = new respuestasolicitudinscripcion();
            $respuesta = $respuestas->getRespuestaSolicitudInscripcion($respuestadb[0]['idinscripcion'],$this->request['idsolicitudinscripcion']);
            return $respuesta;
        }              
    }
    
    public function deleteRespuesta(){
        $respuesta = $this->getRespuesta();
        if(!is_null($respuesta))$respuesta->deleteRecord();
    }
    
    public function delete(){
       //$this->deleteRespuesta();
       $this->deleteRecord();
    }     
}

class respuestasolicitudcertificacion extends respuestasolicitudcertificacionTable {
    public function getRespuestaSolicitudCertificacion($idcertificacion,$idsolicitudcertificacion){
        $this->request['idcertificacion'] = $idcertificacion;         
        $this->request['idsolicitudcertificacion'] = $idsolicitudcertificacion;
        return $this;
    }
}

class respuestasolicitudinscripcion extends respuestasolicitudinscripcionTable {
    public function getRespuestaSolicitudInscripcion($idinscripcion,$idsolicitudinscripcion){
        $this->request['idinscripcion'] = $idinscripcion;         
        $this->request['idsolicitudinscripcion'] = $idsolicitudinscripcion;
        return $this;
    }
}

class reconocimiento extends reconocimientoTable {
    public function getReconocimiento($valor){
        if(!is_array($valor) && $valor > 0) {
            $reconocimientobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $reconocimientobd = $valor;
        } else {
            return null;
        }         
        $this->request['idreconocimiento'] = $reconocimientobd['idreconocimiento'];
        $this->request['idinscripcion'] = $reconocimientobd['idinscripcion'];
        $this->request['nombrereconocido'] = $reconocimientobd['nombrereconocido']; 
        $this->request['fechanacimiento'] = $reconocimientobd['fechanacimiento']; 
        $this->request['lugarnacimiento'] = $reconocimientobd['lugarnacimiento']; 
        $this->request['tomo'] = $reconocimientobd['tomo']; 
        $this->request['folio'] = $reconocimientobd['folio']; 
        $this->request['partida'] = $reconocimientobd['partida']; 
        $this->request['anyo'] = $reconocimientobd['anyo'];
        return $this;
    } 
    
    public function getReconocidosByInscripcion($idinscripcion){
        $reconocidos = $this->readDataFilter('reconocimiento.idinscripcion='.$idinscripcion);
        if($reconocidos) {
            foreach($reconocidos as $key => $reconocido) {
                $reconocidobd = new reconocimiento(); 
                $reconocidobd = $reconocidobd->getReconocimiento($reconocido);
                $reconocidos[$key] = $reconocidobd;
            } 
        }
        return $reconocidos;   
    }
    
    public function checkReconocido($idreconocimiento) {
        $reconocido = $this->readRecord($idreconocimiento);
        return ($reconocido) ? true : false;
          
    }    
    
    public function getInscripcion(){
        $inscripciones = new inscripcion();
        $inscripcion = $inscripciones->getInscripcion($this->request['idinscripcion']);
        return $inscripcion;    
    }   
} 

class guarda extends guardaTable {
    public function getGuarda($valor){
        if(!is_array($valor) && $valor > 0) {
            $guardabd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $guardabd = $valor;
        } else {
            return null;
        }         
        $this->request['idguarda'] = $guardabd['idguarda'];
        $this->request['idinscripcion'] = $guardabd['idinscripcion'];
        $this->request['nombrereconocido'] = $guardabd['nombrereconocido']; 
        $this->request['fechanacimiento'] = $guardabd['fechanacimiento']; 
        $this->request['lugarnacimiento'] = $guardabd['lugarnacimiento']; 
        $this->request['tomo'] = $guardabd['tomo']; 
        $this->request['folio'] = $guardabd['folio']; 
        $this->request['partida'] = $guardabd['partida']; 
        $this->request['anyo'] = $guardabd['anyo'];
        return $this;
    } 
    
    public function getGuardadosByInscripcion($idinscripcion){
        $guardados = $this->readDataFilter('guarda.idinscripcion='.$idinscripcion);
        if($guardados) {
            foreach($guardados as $key => $guardado) {
                $guardadobd = new guarda(); 
                $guardadobd = $guardadobd->getGuarda($guardado);
                $guardados[$key] = $guardadobd;
            } 
        }
        return $guardados;   
    }
    
    public function checkGuarda($idguarda) {
        $guardado = $this->readRecord($idguarda);
        return ($guardado) ? true : false;
          
    }    
    
    public function getInscripcion(){
        $inscripciones = new inscripcion();
        $inscripcion = $inscripciones->getInscripcion($this->request['idinscripcion']);
        return $inscripcion;    
    }   
} 

class organizacion extends organizacionTable {
    public function getOrganizacion($valor){
        if(!is_array($valor) && $valor > 0) {
            $organizacionbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $organizacionbd = $valor;
        } else {
            return null;
        }         
        $this->request['idorganizacion'] = $organizacionbd['idorganizacion'];
        $this->request['nombre'] = $organizacionbd['nombre'];
        $this->request['direccion'] = $organizacionbd['direccion']; 
        $this->request['telefono'] = $organizacionbd['telefono']; 
        $this->request['fax'] = $organizacionbd['fax']; 
        return $this;
    }
    
    public function getAll() {
       return $this->readData();
    }    
}

class patrocinio extends patrocinioTable {
    public function getPatrocinio($idsolicitudtramite,$idorganizacion){   
        $this->request['idsolicitudtramite'] = $idsolicitudtramite;         
        $this->request['idorganizacion'] = $idorganizacion;        
        return $this;
    }
}

class tarifa extends tarifaTable {
    public function getTarifa($valor){
        if(!is_array($valor) && $valor > 0) {
            $tarifabd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $tarifabd = $valor;
        } else {
            return null;
        }
        $this->request['idtarifa'] = $tarifabd['idtarifa'];         
        $this->request['monto'] = $tarifabd['monto'];   
        $this->request['diasespera'] = $tarifabd['diasespera']; 
        $this->request['idtipotramite'] = $tarifabd['idtipotramite'];       
        return $this;
    }
    
    public function getNombreTipotramite(){
        $tipotramite = new tipotramite();
        $tipo = $tipotramite->getTipotramite($this->request['idtipotramite']);
        return $tipo->request['tipotramite'];
    }
    
    public function getTarifabyTipotramiteAndDias($idtipotramite,$diasespera){ 
        $sql = "SELECT MAX(tarifa.diasespera) 
                    AS elmax
                  FROM tarifa
                 WHERE tarifa.idtipotramite ='".$idtipotramite."'";
        $max =  $this->readDataSQL($sql);
        if( $diasespera >= $max[0]['elmax'] ){
            $value = $this->readDataFilter("tarifa.idtipotramite = '".$idtipotramite."' AND tarifa.diasespera = '".$max[0]['elmax']."'");
        }else{
            $value = $this->readDataFilter("tarifa.idtipotramite = '".$idtipotramite."' AND tarifa.diasespera = '".$diasespera."'");
        }
        return $value;
    }
    
    public function getDiasDefaultbyTipotramite($idtipotramite){ 
        $sql = "SELECT MAX(tarifa.diasespera) 
                    AS elmax
                  FROM tarifa
                 WHERE tarifa.idtipotramite ='".$idtipotramite."'";
        $max =  $this->readDataSQL($sql);
        return $max[0]['elmax'];
    }    
}

class tipotramite extends tipotramiteTable {
    public function getTipotramite($valor){
        if(!is_array($valor) && $valor > 0) {
            $tipotramitebd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $tipotramitebd = $valor;
        } else {
            return null;
        }
        $this->request['idtipotramite'] = $tipotramitebd['idtipotramite'];         
        $this->request['tipotramite'] = $tipotramitebd['tipotramite'];  
        return $this;
    }
    
    public function getTipotramitebyname($nombre){
        return $this->readDataFilter("tipotramite='".$nombre."'");
    }
    
    public function getMonto($diasespera){
        $tarifas = new tarifa();
        $tarifa = $tarifas->getTarifabyTipotramiteAndDias($this->request['idtipotramite'],$diasespera);
        return $tarifa[0]['monto'];
    }
    
    public function getAll() {
       return $this->readData();
    }    

}

class recibo extends reciboTable {
    public function getRecibo($valor){
        if(!is_array($valor) && $valor > 0) {
            $recibobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $recibobd = $valor;
        } else {
            return null;
        }
        $this->request['idrecibo'] = $recibobd['idrecibo'];         
        $this->request['codigorecibo'] = $recibobd['codigorecibo']; 
        $this->request['nombrecliente'] = $recibobd['nombrecliente'];  
        $this->request['monto'] = $recibobd['monto'];  
        $this->request['concepto'] = $recibobd['concepto'];  
        $this->request['codigo'] = $recibobd['codigo'];  
        $this->request['fecha'] = $recibobd['fecha'];  
        $this->request['idformapago'] = $recibobd['idformapago'];  
        $this->request['numerocheque'] = $recibobd['numerocheque'];  
        $this->request['banco'] = $recibobd['banco'];  
        $this->request['codigocontribuyente'] = $recibobd['codigocontribuyente'];  
        $this->request['numerocuenta'] = $recibobd['numerocuenta'];  
        $this->request['estado'] = $recibobd['estado'];        
        return $this;
    }
    
    public function getTipoSolicitud(){
        $solicitudes = new solicitudtramite();
        $arrayPagos = $this->getPago();
        $solicitud = $solicitudes->getSolicitudtramite($arrayPagos[0]['idsolicitudtramite']);
        return $solicitud->getTipoSolicitud();    
    }
    
    public function getlastId() {
        return $this->getVar("SELECT MAX(".$this->key.") FROM ".$this->name);
    }
    
    public function getlastCodigo() {
        return $this->getVar("SELECT MAX(codigorecibo) FROM ".$this->name);
    }    

    public function getItempagado(){
        $itempagado = new itempagado();
        $itempagadobd = $itempagado->readDataFilter("idrecibo='".$this->request['idrecibo']."'");
        if(!$itempagadobd){ 
            return NULL;                 
        }else{
            $item = $itempagado->getItempagado($itempagadobd[0]);                 
            return $item; 
        }
    }
    
    public function getCliente(){
        $sql = "SELECT cliente.*    
                  FROM cliente
                 WHERE cliente.idrecibo = '".$this->request['idrecibo']."'";
        $clientedb = $this->readDataSQL($sql);
        if(is_null($clientedb[0]['idpersona'])){
            return NULL;
        }else{
            $clientes = new cliente();
            $cliente = $clientes->getCliente($clientedb[0]['idpersona'], $this->request['idrecibo']);
            return $cliente;        
        }        
    }
    
    public function getPersona(){
        $cliente = $this->getCliente();
        $personas = new persona();
        $persona = $personas->getPersona($cliente->request['idpersona']);
        return $persona; 
    }

    public function getPago(){
        $sql = "SELECT pago.*    
                  FROM pago
                 WHERE pago.idrecibo = '".$this->request['idrecibo']."'";
        $pagodb = $this->readDataSQL($sql);
        if(is_null($pagodb[0]['idsolicitudtramite'])){
            return NULL;
        }else{
            return $pagodb;
        }        
    }
    
    public function getSolicitudesTramites(){        
        $arrayPagos = $this->getPago();  
        //$allsolicitudes = new solicitudtramite();
        if(is_array($arrayPagos)){
            foreach($arrayPagos as $pagodb){
				$allsolicitudes = new solicitudtramite();
                $id = $pagodb['idsolicitudtramite'];    
                $solicitud = $allsolicitudes->getSolicitudtramite($id);
                $arraySolicitudes[$id] = $solicitud;
				error_log(print_r($solicitud->request,1));
				error_log(print_r($arraySolicitudes[$id]->request,1));
				unset($allsolicitudes);
            }        
			//error_log(print_r($arraySolicitudes,1));
            return $arraySolicitudes;
        }else{
            return NULL;
        }
    }
        
    public function deleteItempagado(){
        $itempagado = $this->getItempagado();    
        if(!is_null($itempagado)){           
            $itempagado->deleteRecord($itempagado->request['iditempagado']);  
        }
    }
    
    public function getSolicitudesT(){  
        $arraySolicitudes = $this->readDataSQL("SELECT solicitudtramite.* 
                                                  FROM  solicitudtramite
                                            INNER JOIN  pago
                                                    ON  solicitudtramite.idsolicitudtramite = pago.idsolicitudtramite
                                            INNER JOIN  recibo 
                                                    ON pago.idrecibo = recibo.idrecibo        
                                                 WHERE recibo.idrecibo=".$this->request[$this->key]);
       
       $arraySolicitudesTramites = '';
       
       if(is_array($arraySolicitudes)){
           foreach($arraySolicitudes as $key => $solicitud) {
               $solicitudtramite = new solicitudtramite();
               $solicitudbd = $solicitudtramite->getSolicitudtramite($solicitud);
               $arraySolicitudesTramites[$key] = $solicitudbd;
           }        
       }
       
       return $arraySolicitudesTramites;                                          
    }    
    
    public function deletePago(){
        $pago = $this->getPago();
        if(!is_null($pago)){
            $solicitudes = new solicitudtramite();
            $solicitud = $solicitudes->getSolicitudtramite($pago->request['idsolicitudtramite']);
            //$solicitud->delete();
            $pago->deleteRecord();
        }
    }   
    
    public function deleteCliente(){
        $cliente = NULL;
        $cliente = $this->getCliente();  
        if(!is_null($cliente)) $cliente->deleteRecord();
    }
        
    public function delete(){
        $this->deleteItempagado(); 
        $this->deleteCliente();  
        $this->deletePago();
        $this->deleteRecord(); 
    }
} 

class itempagado extends itempagadoTable {
    public function getItempagado($valor){
        if(!is_array($valor) && $valor > 0) {  
            $itempagadobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $itempagadobd = $valor;
        } else {
            return null;
        }
        
        $this->request['iditempagado'] = $itempagadobd['iditempagado'];
        $this->request['idrecibo'] = $itempagadobd['idrecibo'];
        $this->request['cant'] = $itempagadobd['cant'];
        $this->request['tipotramite'] = $itempagadobd['tipotramite'];
        $this->request['tarifa'] = $itempagadobd['tarifa'];
        return $this;    
    }
    
    public function getItemByIdRecibo($idrecibo){
        $itempagadobd = $this->readDataFilter("itempagado.idrecibo ='".$idrecibo."'"); 
        return $itempagadobd;    
    } 
}

class cliente extends clienteTable {
    public function getCliente($idpersona,$idrecibo){
        $recibo = $this->readRecord($idpersona,$idrecibo);
        $this->request['idpersona'] = $recibo['idpersona'];
        $this->request['idrecibo'] = $recibo['idrecibo']; 
        return $this;
    }
    
    public function getPersonaByIdrecibo($idrecibo){
        $clienteDB = $this->readDataFilter("cliente.idrecibo='".$idrecibo."'");
        $allpersonas = new persona();
        $persona = $allpersonas->getPersona($clienteDB[0]['idpersona']);      
        return $persona; 
    }
}
//cambiar
class pago extends pagoTable {
    public function getPago($idrecibo,$idsolicitudtramite){
        $pago = $this->readRecord($idrecibo,$idsolicitudtramite);
        $this->request['idsolicitudtramite'] = $pago['idsolicitudtramite'];
        $this->request['idrecibo'] = $pago['idrecibo']; 
        return $this;
    }
    
    public function getSolicitudtramiteByIdrecibo($idrecibo){
        $pagoDB = $this->readDataFilter("pago.idrecibo='".$idrecibo."'");
        $solicitudes = new solicitudtramite();
        $solicitud = $solicitudes->getSolicitudtramite($pagoDB[0]['idsolicitudtramite']);
        return $solicitud;
    }
    
    public function getCantidadbyIdRecibo($idrecibo){
        $count = $this->readDataSQL("SELECT count(*) 
                                       FROM pago 
                                      WHERE pago.idrecibo='".$idrecibo."'");
                                                
        return $count[0]['count'];     
    }
}

class inscripcionvaria extends inscripcionvariaTable { 
    public function getInscripcionvaria($valor) {
        if(!is_array($valor) && $valor > 0) {
            $inscripcionvariabd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $inscripcionvariabd = $valor;
        } else {
            return null;
        } 
        $this->request['idinscripcionvaria'] = $inscripcionvariabd['idinscripcionvaria'];
        $this->request['titulo'] = $inscripcionvariabd['titulo'];
        $this->request['tipootrainscripcion'] = $inscripcionvariabd['tipootrainscripcion'];
        $this->request['partesconducentes'] = $inscripcionvariabd['partesconducentes'];
        $this->request['lugarinscripcionnacimiento'] = $inscripcionvariabd['lugarinscripcionnacimiento'];
        $this->request['tomoinscripcionnacimiento'] = $inscripcionvariabd['tomoinscripcionnacimiento'];
        $this->request['folioinscripcionnacimiento'] = $inscripcionvariabd['folioinscripcionnacimiento'];  
        $this->request['partidainscripcionnacimiento'] = $inscripcionvariabd['partidainscripcionnacimiento'];
        $this->request['anyoinscripcionnacimiento'] = $inscripcionvariabd['anyoinscripcionnacimiento'];
        return $this;          
    }
    
    public function getInscripcionNacimiento() {
         $tomo = new tomo();
         $idtomo = $tomo->getIdTomoByLibroNumero('Inscripciones Varias',$this->request['tomoinscripcionnacimiento']);
         $idinscripcion = 0;
         if($idtomo) {
             $idinscripcion = $this->getVar("SELECT idinscripcion FROM acta
                                                                 WHERE idtomo=".$idtomo."
                                                                   AND folio=".$this->request['folioinscripcionnacimiento']);
             $inscripcion = new inscripcion();
         }
         return  ($idinscripcion > 0) ? $inscripcion->getInscripcion($idinscripcion) : NULL;
    }       
}

class notamarginal extends notamarginalTable { 
    public function getNotamarginal($valor) {
        if(!is_array($valor) && $valor > 0) {
            $notamarginalbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $notamarginalbd = $valor;
        } else {
            return null;
        } 
        $this->request['idnotamarginal'] = $notamarginalbd['idnotamarginal'];
        $this->request['idinscripcion'] = $notamarginalbd['idinscripcion'];
        $this->request['actomodificador'] = $notamarginalbd['actomodificador'];
        $this->request['lugarinscripcion'] = $notamarginalbd['lugarinscripcion'];
        $this->request['libroinscripcion'] = $notamarginalbd['libroinscripcion'];
        $this->request['folioinscripcion'] = $notamarginalbd['folioinscripcion'];
        $this->request['tomoinscripcion'] = $notamarginalbd['tomoinscripcion'];  
        $this->request['partidainscripcion'] = $notamarginalbd['partidainscripcion'];
        $this->request['anyoinscripcion'] = $notamarginalbd['anyoinscripcion'];
        $this->request['modificacion'] = $notamarginalbd['modificacion']; 
        $this->request['cuerpo'] = $notamarginalbd['cuerpo'];
        return $this;          
    }
    
    public function getNotasmarginalesByInscripcion($inscripcion) {
       $arraynotamarginalbd = $this->readDataFilter("notamarginal.idinscripcion=".$inscripcion);
       $contador = 0;
       if(is_array($arraynotamarginalbd)) {
           foreach($arraynotamarginalbd as $notamarginalbd) {
              $notamarginal = new notamarginal();
              $notamarginal1 = $notamarginal->getNotamarginal($notamarginalbd); 
              $arrayNotasMarginales[$contador] = $notamarginal1;
              $contador++;
           } 
       }
       return $arrayNotasMarginales;
    }    
}

class disolucionmatrimonio extends disolucionmatrimonioTable { 
    public function getDisolucionmatrimonio($valor) {
        if(!is_array($valor) && $valor > 0) {
            $disolucionmatrimoniobd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $disolucionmatrimoniobd = $valor;
        } else {
            return null;
        } 
        $this->request['iddisolucionmatrimonio'] = $disolucionmatrimoniobd['iddisolucionmatrimonio'];
        $this->request['inscrito2nombre1'] = $disolucionmatrimoniobd['inscrito2nombre1'];
        $this->request['inscrito2nombre2'] = $disolucionmatrimoniobd['inscrito2nombre2'];
        $this->request['inscrito2apellido1'] = $disolucionmatrimoniobd['inscrito2apellido1'];
        $this->request['inscrito2apellido2'] = $disolucionmatrimoniobd['inscrito2apellido2'];
        $this->request['conyuge1nombre'] = $disolucionmatrimoniobd['conyuge1nombre'];
        $this->request['conyuge1edad'] = $disolucionmatrimoniobd['conyuge1edad'];  
        $this->request['conyuge1oficio'] = $disolucionmatrimoniobd['conyuge1oficio'];
        $this->request['conyuge1nacionalidad'] = $disolucionmatrimoniobd['conyuge1nacionalidad'];
        $this->request['conyuge1domicilio'] = $disolucionmatrimoniobd['conyuge1domicilio']; 
        $this->request['conyuge1cedula'] = $disolucionmatrimoniobd['conyuge2cedula'];
        $this->request['conyuge2nombre'] = $disolucionmatrimoniobd['conyuge2nombre'];
        $this->request['conyuge2edad'] = $disolucionmatrimoniobd['conyuge2edad'];  
        $this->request['conyuge2oficio'] = $disolucionmatrimoniobd['conyuge2oficio'];
        $this->request['conyuge2nacionalidad'] = $disolucionmatrimoniobd['conyuge2nacionalidad'];
        $this->request['conyuge2domicilio'] = $disolucionmatrimoniobd['conyuge2domicilio']; 
        $this->request['conyuge2cedula'] = $disolucionmatrimoniobd['conyuge2cedula']; 
        $this->request['custodionombre'] = $disolucionmatrimoniobd['custodionombre'];
        $this->request['pensionalimenticia'] = $disolucionmatrimoniobd['pensionalimenticia'];  
        $this->request['tipoinmuebleafectado'] = $disolucionmatrimoniobd['tipoinmuebleafectado'];
        $this->request['lugarregistroinmueble'] = $disolucionmatrimoniobd['lugarregistroinmueble'];
        $this->request['tomoregistroinmueble'] = $disolucionmatrimoniobd['tomoregistroinmueble']; 
        $this->request['folioregistroinmueble'] = $disolucionmatrimoniobd['folioregistroinmueble'];      
        $this->request['partidaregistroinmueble'] = $disolucionmatrimoniobd['partidaregistroinmueble'];  
        $this->request['asientoregistroinmueble'] = $disolucionmatrimoniobd['asientoregistroinmueble'];
        $this->request['propietarioinmueble'] = $disolucionmatrimoniobd['propietarioinmueble'];
        $this->request['conyuge1lugarinscripcion'] = $disolucionmatrimoniobd['conyuge1lugarinscripcion']; 
        $this->request['conyuge1tomoinscripcion'] = $disolucionmatrimoniobd['conyuge1tomoinscripcion'];  
        $this->request['conyuge1folioinscripcion'] = $disolucionmatrimoniobd['conyuge1folioinscripcion']; 
        $this->request['conyuge1partidainscripcion'] = $disolucionmatrimoniobd['conyuge1partidainscripcion'];    
        $this->request['conyuge1anyoinscripcion'] = $disolucionmatrimoniobd['conyuge1anyoinscripcion']; 
        $this->request['conyugue2lugarinscripcion'] = $disolucionmatrimoniobd['conyugue2lugarinscripcion']; 
        $this->request['conyuge2tomoinscripcion'] = $disolucionmatrimoniobd['conyuge2tomoinscripcion'];  
        $this->request['conyuge2folioinscripcion'] = $disolucionmatrimoniobd['conyuge2folioinscripcion']; 
        $this->request['conyuge2partidainscripcion'] = $disolucionmatrimoniobd['conyuge2partidainscripcion'];    
        $this->request['conyuge2anyoinscripcion'] = $disolucionmatrimoniobd['conyuge2anyoinscripcion']; 
        $this->request['tomomatrimonio'] = $disolucionmatrimoniobd['tomomatrimonio'];    
        $this->request['foliomatrimonio'] = $disolucionmatrimoniobd['foliomatrimonio'];     
        $this->request['partidamatrimonio'] = $disolucionmatrimoniobd['partidamatrimonio'];            
        return $this;          
    }
    
    public function getIdMatrimonio() {
        $tomo = new tomo();
	//TODO: revisar esta funcio pude causar un problema al desconocerse el 
        $idtomo = $tomo->getIdTomoByLibroNumero('Matrimonios',$this->request['tomomatrimonio']);
        $idinscripcion = 0;
        if($idtomo) {
           $idinscripcion =  $this->getVar("SELECT idinscripcion FROM acta WHERE acta.idtomo=".$idtomo." AND acta.folio=".$this->request['foliomatrimonio']." AND acta.partida=".$this->request['partidamatrimonio']);
        }
        return ($idinscripcion != '' && $idinscripcion > 0) ? $idinscripcion : NULL;
    }    
}

class certificacion extends certificacionTable{
    public function getCertificacion($valor){
        if(!is_array($valor) && $valor > 0) {  
            $certificacionbd = $this->readRecord($valor);
        } elseif(is_array($valor)) {
            $certificacionbd = $valor;
        } else {
            return null;
        }
        
        $this->request['idcertificacion'] = $certificacionbd['idcertificacion'];
        $this->request['codigo'] = $certificacionbd['codigo'];
        $this->request['departamentoregistro'] = $certificacionbd['departamentoregistro'];
        $this->request['anyoregistro'] = $certificacionbd['anyoregistro'];
        $this->request['lugaremision'] = $certificacionbd['lugaremision'];
        $this->request['fechaemision'] = $certificacionbd['fechaemision'];
        $this->request['nombreregistrador'] = $certificacionbd['nombreregistrador'];
        $this->request['nombresecretario'] = $certificacionbd['nombresecretario'];  
        $this->request['idsolicitud'] = $certificacionbd['idsolicitud'];
        $this->request['tipocertificado'] = $certificacionbd['tipocertificado'];  
        return $this; 
    }
}
 
//Clases Independientes de las Tablas
class TFechas {
    function getCantDias($fecha1,$fecha2) {
       $fechaini = explode('-',$fecha1);
       $fechafin = explode('-',$fecha2);    
       $timestamp1 = mktime(0,0,0,$fechaini[1],$fechaini[2],$fechaini[0]);
       $timestamp2 = mktime(0,0,0,$fechafin[1],$fechafin[2],$fechafin[0]);
       $segundos_diferencia = $timestamp1 - $timestamp2; 
       return ceil($segundos_diferencia / (60 * 60 * 24));      
    }
    
    function suma_fechas($fecha,$ndias) {
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            list($ano,$mes,$dia)=split("/", $fecha);
        if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
           list($ano,$mes,$dia)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$ano) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("Y-m-d",$nueva);
        return ($nuevafecha);  
    }    

    function resta_fechas($fecha,$ndias) {
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
            list($ano,$mes,$dia)=split("/", $fecha);
        if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
            list($ano,$mes,$dia)=split("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$ano) - $ndias * 24 * 60 * 60;
        $nuevafecha=date("Y-m-d",$nueva);
        return ($nuevafecha);  
    }    
  
    function recortar_fecha($fecha){
        $fecharecortada = explode(" ", $fecha);
        return $fecharecortada;
    }
}

class TCadena {
    function convert_sqlData_toString($arreglo) {
        $primero = true;
        foreach ($arreglo as $valor) {
           $esprimero = true;
           $arrayElementos = '';
           foreach($valor as $key => $valor2) {
              if($esprimero) { 
                  $arrayElementos .= $valor2;
                  $esprimero = false;
              } else {
                 $arrayElementos .= "[ " . $valor2;  
              }
              //echo $key.'<br><br><br>'; 
           }
           
           if($primero) {
               $arrayResult .= $arrayElementos;
               $primero = false;
           } else {
               $arrayResult .= "{ " . $arrayElementos;
           } 
           
        } 
        return $arrayResult;   
    } 
    
    function getPosArrayByObject($object,$arrayCampos) {
        $elements = $object[0];
        $arrayPosiciones = '';
        if(is_array($elements)) {
            $contador = 0;
            //Obtengo arreglo de llaves
            $keys = '';
            foreach($elements as $key => $element) {
                $keys[$contador] = $key;
                $contador++;       
            }
            //obtengo la posicion
            $esprimero = true;
            foreach($arrayCampos as $campo) {
                $encontrado = false;
                $posicion = 0;
                while(!$encontrado && $posicion < count($keys)) {
                   if($campo == $keys[$posicion]) {
                      $encontrado = true;
                      if($esprimero) {
                         $arrayPosiciones .= $posicion ;
                         $esprimero = false; 
                      } else {
                          $arrayPosiciones .= ','.$posicion;
                      }   
                   } 
                   $posicion++;   
                }  
            }
        }
        return $arrayPosiciones;   
    } 
}   
    
