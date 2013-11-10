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
	<div id="headercontainer"><img src="../images/Logo.png" width="150" height="150" />
    <?php if (isset($_SESSION['MM_Username'])) { ?>
    <ul>
    	<li><a href="../home.php"> Inicio</a> </li>
    	<li><a href="../midinero.php"> Mi Dinero</a> </li>
       <li><a href="../enviarremesa.php">Enviar Remesa</a></li>
       <li><a href="../messages.php">Mensajes</a></li>
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

<!-- TemplateBeginEditable name="content" -->

<!-- TemplateEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
</html>
