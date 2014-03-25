<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}
$userstay = true;
?>
<?php require_once('Connections/userin.php'); ?>
<?php require_once('Models/general.php'); ?>


<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Werkpal</title>
<!-- InstanceEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css"  />

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<header>
	<div id="headercontainer">
    	<a href="http://werkpal.com/"><img src="images/toplogo.svg" width="185" height="30" /></a>
    	<?php if (isset($_SESSION['MM_Username'])) { ?>
    	<ul>
       		<li><a href="home.php"> Inicio</a> </li>
	    	<li><a href="money.php"> Dinero</a> </li>
	       <li><a href="messages.php">Mensajes</a></li>
           <li><a href="profile.php"> Perfil</a> </li>
           <li><a href="login.php?doLogout=true"> Salir</a> </li>

    	</ul>
	    <?php } ?>
        <div class="clear"></div>
    </div>
</header>

<div id="content">
	<!-- InstanceBeginEditable name="showuserinfo" -->
	
	<!-- InstanceEndEditable -->
	<!--
	<?php if (isset($_SESSION['MM_Username'])) { ?>
    
    <div id="informationUser">
        <img src="images/user_default_photo.png" >
        <p><?php echo $_SESSION['MM_Username']; ?></p>
        <p>22 años</p>
        <p><a href="messages.php" class="whitebtn" >Mensajes</a></p>
    </div>
    
    <?php } ?>
    -->
    
<!-- InstanceBeginEditable name="content" -->
<div id="indexlanding">
	<h1>¿Que Buscas?</h1>
</div>

<div id="indexcontainer" >



<div id="indexoptionscontainer" >
    
    <div id="indexneedajob" class="box">
    	 <img src="images/boy/searching.svg" class="iconsstart"/>
        <h1>Trabajo</h1>
        <p>Seguramente tenemos empleos 
    temporales para tus habilidades.</p>
        <a href="login.php" class="whitebtn">Ver Mas</a>
    </div>
    
    <div id="indexneedsomethingdone"  class="box"> 
        <img src="images/boy/hire.svg" class="iconsstart"/>
        <h1>Contratar</h1>
        <p>Discover our big selection of accesible manpower near you.</p>
        <a href="findaservice.php" class="whitebtn">Ver Mas</a>
    </div>
    
    <div class="clear"></div>
    
    
</div>

<h1>Acerca</h1>


<p>Nuestra propuesta es una solución integrada a los diferentes problemas que padecen los inmigrantes ilegales en su lucha por una vida mejor. La idea consiste en crear una plataforma digital que lo ayude a generar y administrar su dinero de forma fácil y segura. El inmigrante o creemos mejor llamarlo Pal, nuestro Pal llegará a Estados Unidos o cualquier país de oportunidad en busca de empleo, nosotros en medio de distintos touch-points le invitaremos a crear un perfil con sus habilidades y éstas ingresarán a una base de datos donde podrán ser seleccionados por empleadores.</p>

<p>Al obtener empleos serán remunerados a través de nuestra página y dónde podrán manejar su dinero de una mejor forma, además de obtener descuentos en establecimientos tanto en Estados Unidos como en su país natal, opción de enviar remesas, etc. Nos convertiremos en su amigo y al mismo tiempo es su socio en su empresa de conseguir una vida mejor para él y los suyos.</p>

</div>
<!-- InstanceEndEditable -->
</div>

<footer>
<img src="images/werkpalLogo.svg" width="92" />
Werkpal, Tegucigalpa 2014
</footer>

</body>
<!-- InstanceEnd --></html>
