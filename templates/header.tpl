<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Alcaldia de Matagalpa</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="/css/style.css"/>
  <link rel="stylesheet" type="text/css" href="/css/smoothness/datetimepicker.css"/>
  <link rel="stylesheet" type="text/css" href="/css/smoothness/jquery-ui-1.7.2.custom.css"/>
  <link rel="stylesheet" type="text/css" href="/css/paginatorskins/pagination.css"/>
  <link type="text/css" href="/css/smoothness/ui.all.css" rel="stylesheet" /> 
  <script language="JavaScript" type="text/javascript" src="/js/ddaccordion.js"></script>
  <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.2.pack.js"></script>
  <script language="JavaScript" type="text/javascript" src="/js/jquery-1.4.3.js"></script>  
  <script language="JavaScript" type="text/javascript" src="/js/validate/cmxforms.js"></script> 
  <script type="text/javascript" src="/js/ui/ui.core.js"></script>
  <script type="text/javascript" src="/js/ui/ui.datepicker.js"></script>  
  <script type="text/javascript" src="/js/ui/ui.datetimepicker"></script> 
  <script type="text/javascript" src="/js/ui/ui.datepicker-es.js"></script> 
  <script type="text/javascript" src="/js/jquery.confirm.js"></script>  
  <script type="text/javascript" src="/js/paginator/jquery.pagination.js"></script>  
  {if not $callback }
  <script type="text/javascript" src="/js/paginator/callback.js"></script>
  {else}
  <script type="text/javascript" src="/js/paginator/{$callback}.js"></script>
  {/if}
  <script language="JavaScript" type="text/javascript" src="/js/validate/jquery.validate.js"></script> 
 {literal}
    <script type="text/javascript">
    ddaccordion.init({
        headerclass: "expandable", //Shared CSS class name of headers group that are expandable
        contentclass: "categoryitems", //Shared CSS class name of contents group
        collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
        defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
        animatedefault: false, //Should contents open by default be animated into view?
        persiststate: true, //persist state of opened contents within browser session?
        toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
        togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
        animatespeed: "normal" //speed of animation: "fast", "normal", or "slow"
    })
    </script> 
  {/literal} 
</head>
<body>
   <div align="center">
     <div id="contenedor">
         <div id="esquinaizq">
             <div id="menutop">
               <div id="menutopder">
                  <div class="cerrar"><a href="/logout.php">cerrar sessi&oacute;n</a></div> 
               </div> 
               <div class="limpiar"></div>
             </div>
             <div id="header1">
                 <div id="header">
                    <div id="logo" class="paddingleftlogo">
                       <div class="logoizq"><img src="/imagenes/logo.png" alt="" width="130" height="174"/></div>
                       <div class="limpiar"></div>
                    </div><!--logo-->
                 </div><!--header-->
             </div><!--header1-->
             <div id="cuerpo">
                 <div id="separador"></div>
                 <div id="contenido">
                     <div id="headercontenido">
                         <div id="headercontenidoizq">{$smarty.session.rol|upper}</div>  
                         <div id="headercontenidoder">
                             <div class="floatleft" style="width:auto">{$smarty.session.usuario}</div>
                             <div class="floatright" style="width:auto"><span class="camino">{$camino}</span></div>   
                         </div><!--headercontenidoder--> 
                         <div class="limpiar"></div>
                     </div><!--headercontenido--> 
                     <div id="datos">
                        <div id="menudatos">
                           {$menu}
                        </div><!--menudatos-->
                                       
