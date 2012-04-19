<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Alcaldia de Matagalpa</title>
  <link rel="stylesheet" type="text/css" href="/css/style.css"/>
  <link rel="stylesheet" type="text/css" href="/css/menu.css"/> 
  <link rel="stylesheet" type="text/css" href="/css/validationEngine.jquery.css.css"/> 
  {literal}
  <!--[if lt IE 8]>
   <style type="text/css">
   li a {display:inline-block;}
   li a {display:block;}
   </style>
   <![endif]-->  
  {/literal} 
</head>
<body>
   <div align="center" class="paddingtop20">
     <div id="contenedor">
         <div id="esquinaizq">
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
            <div id="cajalogin" align="center">
                <form id="login" name="login" method="post" action="/login.php">
                    <div id="cajalogincenter">
                        <div>Nombre de Usuario</div>
                        <input class="input" type="text" value="" required="yes" name="usuario"/>
                        <div style="height: 18px;"></div>
                        <div>Contrase&ntilde;a</div>
                        <input class="input" type="password" target="container" value="" required="yes" name="password"/>
                        <div style="height: 15px;"></div>
                        <div style="padding-left: 60px;">
                        <input class="bottomlogin" type="submit" value="Validar Usuario" />
                        </div>

                    </div>
                    <div id="cajaloginbottom"></div>
                </form>
                <div class="errorlogin" style="padding-top:10px">{$erroruser}</div>
            </div>
            <br/> 
            <div class="limpiar"/>
         </div><!--cuerpo-->
         <div class="limpiar"></div>
        </div><!--esquinaizq-->
       <div class="limpiar"></div>
     </div><!--contenedor-->    
   </div><!--center-->
</body>
</html>