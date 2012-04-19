<?php
class TDate {
    public function arraydatetostring($array) {
        $day = ($array['day'] < 10) ? '0'.$array['day'] : $array['month'];
        $month = ($array['month'] < 10) ? '0'.$array['month'] : $array['month'];
        $date = $array['year'].'-'.$month.'-'.$day;
        return $date; 
    }
    
    public function stringtoarraydate($cadena,$separador,$idioma='en') {
        $arrayaux = explode($separador,$cadena);
        switch ($idioma) { 
            case 'en'://Pendientes
                $array['month'] = $arrayaux[0];
                $array['day']= $arrayaux[1];
                $array['year'] = $arrayaux[2]; 
            break;
            case 'es'://Rechazados  
                $array['month'] = $arrayaux[1];
                $array['day']= $arrayaux[0];
                $array['year'] = $arrayaux[2];                      
        }        
        return $array;      
    } 
    
    public function convertdate($date,$separador,$idioma='en') {
        $dateconvert = explode($separador,$date);
        switch ($idioma) {
            case 'en'://Pendientes
                $result = $dateconvert[2].'-'.$dateconvert[1].'-'.$dateconvert[0];
                break;
            case 'es'://Rechazados
                $result = $dateconvert[0].'-'.$dateconvert[1].'-'.$dateconvert[2]; ;
                break;                   
        }
        return $result;              
    } 
    
    public function comparedate($fechaini,$fechafin,$operator) {
        $arrayfechaini = $this->stringtoarraydate($fechaini);
        $arrayfechafin = $this->stringtoarraydate($fechafin);
        $error = '';
        if(!checkdate($arrayfechaini['month'], $arrayfechaini['day'], $arrayfechaini['year'])){ 
            $error = 'fecha inicio invalida';      
        }elseif(!checkdate($arrayfechafin['month'], $arrayfechafin['day'], $arrayfechafin['year'])) {
            $error .= ($error != '') ? ', ' : '';
            $error .= 'fecha final invalida';
        } else {
             $fechainigerorian = gregoriantojd($arrayfechaini['month'], $arrayfechaini['day'], $arrayfechaini['year']);   
             $fechafingerorian = gregoriantojd($arrayfechafin['month'], $arrayfechafin['day'], $arrayfechafin['year']); 
             $error .= ($error != '') ? ', ' : ''; 
             switch ($operador) {
                case '<='://menor igual
                    $error .= ($fechainigerorian <= $fechafingerorian) ? '' : 'la fecha inicial no puede ser mayor que la final';
                    break;
                case '<'://menor    
                    $error .= ($fechainigerorian < $fechafingerorian) ? '' : 'la fecha inicial no puede ser mayor o igual que la final';
                    break;  
                case '>='://mayor igual
                    $error .= ($fechainigerorian >= $fechafingerorian) ? '' : 'la fecha inicial no puede ser menor o igual que la final';
                    break;                                      
                case '>'://mayor   
                    $error .= ($fechainigerorian > $fechafingerorian) ? '' : 'la fecha inicial no puede ser menor que la final';
                    break;  
                case '==':
                default:
                    $error .= ($fechainigerorian == $fechafingerorian) ? '' : 'la fecha inicial no puede ser igual que la final';
             }    
        }
        return $error;    
            
    }    
}   
?>
