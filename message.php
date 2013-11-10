<?php require_once('Connections/chanceamigo.php'); ?>

<?php require_once('Models/general.php'); ?>

<?php require('Controllers/controller_user.php'); ?>
<?php $user = new controller_user(); ?>
<?php $user->find($_SESSION['MM_Usernameid']);  ?>


<?php require('Controllers/controller_message.php'); ?>
<?php $message = new controller_message();  ?>
<?php $message->find($_GET['id']);  ?>

<?php

$insertSQL = sprintf("UPDATE messages
						SET isread=1
						WHERE id=".$_GET['id']);
mysql_select_db($database_chanceamigo, $chanceamigo);
$Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	
if (isset($_GET['accept'])) {
	
	$insertSQL = sprintf("UPDATE messages
							SET isaccepted=1
							WHERE id=".$_GET['id']);
	mysql_select_db($database_chanceamigo, $chanceamigo);
  	$Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	
	
	$query_messages = sprintf("SELECT m.id as id, m.idto, m.idfrom,  m.date, m.hours, m.isaccepted, w.name as workname, c.name as city, cw.price as price
							 FROM ((messages m
							 JOIN cityhaswork cw
							 ON m.idcityhaswork = cw.id)
							 JOIN works w
							 ON cw.idwork = w.id)
							 JOIN cities c
							 ON cw.idcity = c.id
 							 WHERE m.id=".$_GET['id']);
							 
	
	//$query_messages = sprintf("SELECT * FROM messages WHERE id = ".$_GET['id']);
	$messages = mysql_query($query_messages, $chanceamigo) or die(mysql_error());
	$row_messages = mysql_fetch_assoc($messages);
	$totalRows_messages = mysql_num_rows($messages);
	
	
	
	
	
	$insertSQL = sprintf("INSERT INTO transactions (id_user_to, id_user_from, type, price) VALUES 
  											 		  (%s, %s, %s, %s)",
						   GetSQLValueString($row_messages['idto'], "int"),
						   GetSQLValueString($row_messages['idfrom'], "int"),
						   GetSQLValueString("D", "text"),
						   GetSQLValueString($row_messages['price'] * $row_messages['hours'] , "double"));						  
	mysql_select_db($database_chanceamigo, $chanceamigo);
  	$Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	
	
}

if (isset($_GET['ignore'])) {
	
	$insertSQL = sprintf("UPDATE messages
							SET isaccepted=2
							WHERE id=".$_GET['id']);
	mysql_select_db($database_chanceamigo, $chanceamigo);
  	$Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	
	
}


?>


<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Mensaje</title>
<!-- InstanceEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css"  />

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<header>
	<div id="headercontainer"><img src="images/Logo.png" width="150" height="150" />
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

<div id="messagecontainer">
	<h1>Trabajo como <?php echo $message->message->cityhaswork->work->name; ?></h1>
    <h2>en <?php echo $message->message->cityhaswork->city->name;?></h2>
    
    <p><strong>Precio: </strong> $ <?php echo $message->message->cityhaswork->price;?></p>
    <p><strong>Día: </strong><?php echo $message->message->date; ?></p>
    <p><strong>Horas: </strong><?php echo $message->message->hours; ?></p>
    <p><strong>Mensaje: </strong><?php echo $message->message->message;?></p>
    
    <div>
    <img src="http://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap
&markers=color:blue%7Clabel:S%<?php echo $message->message->latitude; ?>,<?php echo $message->message->longitude; ?>&sensor=true" />
    </div>
    
    <div class="btns">
    <?php if ( $message->message->isaccepted ==0) { ?>
     	 
    		<a href="message.php?accept=true&id=<?php echo $_GET['id']; ?>" class="btn">Aceptar</a>
    		<a href="message.php?ignore=true&id=<?php echo $_GET['id']; ?>" class="btn">Ignorar</a>
    	
    <?php } else  if ( $message->message->isaccepted ==1) { ?>
        <a href="message.php?id=<?php echo $_GET['id']; ?>" class="btn">Aceptado</a>
    <?php } else  if ( $message->message->isaccepted ==2) { ?>
        <a href="message.php?id=<?php echo $_GET['id']; ?>" class="btn">Rechazado</a>
     <?php } ?>
    <div class="clear"></div>
   </div>
</div>

<div class="clear"></div>
<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
