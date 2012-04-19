<?php 
$menu = "<div class=\"arrowlistmenu\">\n";     
$areasbd = new area();
foreach($_SESSION['areas'] as $key => $area) {
    $areabd = $areasbd->getArea($key);
    if((!in_array($areabd->request['padre'],$_SESSION['areas'])) && ($areabd->request['visible'] == 1)) {
        if($areabd->getCanSubtAreas() > 0) {        
            $menu.= "<h3 class=\"menuheader expandable\">".$area."</h3>\n"; 
            $menu.= "<ul class=\"categoryitems\">\n"; 
            foreach($_SESSION['subareas'][$key] as $subarea){
                 $menu.= "<li><a href=\"".$subarea['url']."\">&gt;&gt; ".$subarea['nombre']."</a></li> \n";        
            }   
            $menu.= "</ul>\n";                
        } else {
           $menu.= "<h3 class=\"menuheader\"><a href=\"".$areabd->request['url']."\">".$areabd->request['nombre']."</a></h3>\n";
        } 
    }       
}
$menu.=  "</div><!--arrowlistmenu-->";                                    
$smarty->assign('menu',$menu);                           
?>
