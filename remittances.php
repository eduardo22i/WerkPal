<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}

$menu = "money";
?>

<?php require_once('Connections/userin.php'); ?>
<?php require_once('Models/general.php'); ?>

<?php require_once('Connections/chanceamigo.php'); ?>
<?php


if (isset($_POST['MM_insert'])) {
	
	
	
	
	
	
	$insertSQL = sprintf("INSERT INTO transactions (id_user_to, id_user_from, type, price) VALUES 
  											 		  (%s, %s, %s, %s)",
						   GetSQLValueString($_SESSION['MM_Usernameid'], "int"),
						   GetSQLValueString("2", "int"),
						   GetSQLValueString("R", "text"),
						   GetSQLValueString($_POST['cantidad'], "double"));	
						   					  
	mysql_select_db($database_chanceamigo, $chanceamigo);
  	$Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	
	$pin = mysql_insert_id();
	
}



?>


<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Remittances</title>
<!-- InstanceEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css"  />

<!-- InstanceBeginEditable name="head" -->
<script src="js/mymoney.js" type="text/javascript" ></script>
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
	<?php echo $userinfo; ?>

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

<div class="midinerocontainer">

	<section id="mymoney"></section>

    
	<h1>Enviar Remesa</h1>
    <?php if (!isset($_POST['MM_insert']) ) { ?>
    <form method="post" action="remittances.php">
    	<input type="number" name="cantidad" placeholder="Cantidad" min="0" value="0">
    	<input type="submit" value="Enviar" />
	 	<input type="hidden" name="MM_insert" value="remesa" />
    </form>
     <?php } else { ?>
     <p>Remesa enviada</p>
     <p><strong>Pin: </strong><? echo $pin; ?></p>
     <?php }?>
</div>

<div class="clear"></div>
<!-- InstanceEndEditable -->
</div>

<footer>
<img src="images/werkpalLogo.svg" width="92" />
Werkpal, Tegucigalpa 2014
</footer>

</body>
<!-- InstanceEnd --></html>
