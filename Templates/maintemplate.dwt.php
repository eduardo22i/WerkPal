<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- TemplateEndEditable -->
<link href="../style.css" rel="stylesheet" type="text/css"  />

<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>

<header>
	<div id="headercontainer">
    	<a href="http://werkpal.com/"><img src="../images/toplogo.svg" width="185" height="30" /></a>
    	<?php if (isset($_SESSION['MM_Username'])) { ?>
    	<ul>
       		<li><a href="../home.php"> Inicio</a> </li>
	    	<li><a href="../money.php"> Dinero</a> </li>
	       <li><a href="../messages.php">Mensajes</a></li>
           <li><a href="../profile.php"> Perfil</a> </li>
           <li><a href="../login.php?doLogout=true"> Salir</a> </li>

    	</ul>
	    <?php } ?>
        <div class="clear"></div>
    </div>
</header>

<div id="content">
	<!-- TemplateBeginEditable name="showuserinfo" -->
	
	<!-- TemplateEndEditable -->
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
    
<!-- TemplateBeginEditable name="content" -->

<!-- TemplateEndEditable -->
</div>

<footer>
<img src="../images/werkpalLogo.svg" width="92" />
Werkpal, Tegucigalpa 2014
</footer>

</body>
</html>
