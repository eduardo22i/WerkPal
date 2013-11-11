<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>PalEnterprises</title>
<!-- InstanceEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css"  />

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<header>
	<div id="headercontainer"><a href="http://wildgriffin.com/werkpal/"><img src="images/Logo.png" width="150" height="150" /></a>
    <?php if (isset($_SESSION['MM_Username'])) { ?>
    <ul>
    	<li><a href="home.php"> Inicio</a> </li>
    	<li><a href="midinero.php"> Mi Dinero</a> </li>
       <li><a href="enviarremesa.php">Enviar Remesa</a></li>
       <li><a href="messages.php">Mensajes</a></li>
    </ul>
    <?php } ?>
    </div>
</header>

<div id="content">
	<?php if (isset($_SESSION['MM_Username'])) { ?>
    
    <div id="informationUser">
        <img src="images/user_default_photo.png" >
        <p><?php echo $_SESSION['MM_Username']; ?></p>
        <p>22 años</p>
        <p><a href="messages.php" class="whitebtn" >Mensajes</a></p>
    </div>
    
    <?php } ?>

<!-- InstanceBeginEditable name="content" -->
<div id="indexlanding">
	<div id="indexlandingcontent" >
    	<div class="info">
    	<h1>Helping People Help People</h1>
        <p>La idea consiste en crear una plataforma digital que lo ayude a generar y administrar su dinero de forma fácil y seguir.</p>
        
        </div>
        <iframe width="560" height="315" src="//www.youtube.com/embed/VsABOksxEYg" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<div id="indexcontainer" >



<h1>Elige una Opción / Choose an Option</h1>

<div id="indexoptionscontainer" >
    
    <div id="indexneedajob">
    	 <img src="images/logo_werkpal.png" width="100" class="iconsstart"/>
        <h1>¿Buscas Empleo?</h1>
        <p>Seguramente tenemos empleos 
    temporales para tus habilidades.</p>
        <p>Registrate y empieza a trabajar.</p>
        <a href="login.php" class="whitebtn">Iniciar</a>
    </div>
    
    <div id="indexneedsomethingdone"> 
         <img src="images/logo_monypal.png" width="100" class="iconsstart"/>
        <h1>Need something done?</h1>
        <p>Discover our big selection of accesible manpower near you.</p>
        <a href="findaservice.php" class="whitebtn">Start</a>
    </div>
    
    <div class="clear"></div>
    
    
</div>

<h1>¿Porqué PalEnterprises?</h1>


<p>Nuestra propuesta es una solución integrada a los diferentes problemas que padecen los inmigrantes ilegales en su lucha por una vida mejor. La idea consiste en crear una plataforma digital que lo ayude a generar y administrar su dinero de forma fácil y segura. El inmigrante o creemos mejor llamarlo Pal, nuestro Pal llegará a Estados Unidos o cualquier país de oportunidad en busca de empleo, nosotros en medio de distintos touch-points le invitaremos a crear un perfil con sus habilidades y éstas ingresarán a una base de datos donde podrán ser seleccionados por empleadores.</p>

<p>Al obtener empleos serán remunerados a través de nuestra página y dónde podrán manejar su dinero de una mejor forma, además de obtener descuentos en establecimientos tanto en Estados Unidos como en su país natal, opción de enviar remesas, etc. Nos convertiremos en su amigo y al mismo tiempo es su socio en su empresa de conseguir una vida mejor para él y los suyos.</p>

</div>
<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
