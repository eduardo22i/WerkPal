<?php require('Controllers/controller_user.php'); ?>
<?php $usercontroller = new controller_user(); ?>
<?php $user = $usercontroller->find($_GET['iduser']);  ?>


<?php require('Controllers/controller_message.php'); ?>
<?php $message = new controller_message();  ?>
<?php //$message->find($_GET['id']);  ?>



<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
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

<div id="informationUser">
        <img src="images/user_default_photo.png" >
        <p><?php echo $user->completename ?></p>
 </div>
    
<div id="messagecontainer">
	<h1>Trabajo como <?php echo $message->message->cityhaswork->work->name; ?></h1>
    <h2>en <?php echo $message->message->cityhaswork->city->name;?></h2>
    
    <p><strong>Precio: </strong> $ <?php echo $message->message->cityhaswork->price;?></p>
    <p><strong>Día: </strong><?php echo $message->message->date; ?></p>
    <p><strong>Horas: </strong><?php echo $message->message->hours; ?></p>
    <p><strong>Mensaje: </strong><?php echo $message->message->message;?></p>
    
    <div>
    <div id="map-canvas"></div>
    <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $message->message->latitude; ?>,<?php echo $message->message->longitude; ?>&zoom=13&size=600x300&maptype=roadmap
&markers=color:blue%7Clabel:S%7C<?php echo $message->message->latitude; ?>,<?php echo $message->message->longitude; ?>&markers=color:green%7Clabel:G%7C40.711614,-74.012318&sensor=true" />
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
