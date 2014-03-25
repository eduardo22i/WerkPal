<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}

$menu = "offers";

?>

<?php require_once('Connections/userin.php'); ?>
<?php require_once('Models/general.php'); ?>



<?php require('Controllers/controller_message.php'); ?>
<?php $controller_message = new controller_message();  ?>
<?php $message = $controller_message->findForUser($_GET['id'], $user->id);  ?>

<?php $controller_message->updateMessageViewFromUser($_GET['id'], $user->id);  ?>


<?php require_once('Connections/acceptwork.php'); ?>



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

<div id="messagecontainer">
	<?php  if (!($message) == "") { ?> 
	<h1>Trabajo como <?php echo $message->cityhaswork->work->name; ?></h1>
    <h2>en <?php echo $message->cityhaswork->city->name;?></h2>
    
    <p><strong>Precio: </strong> $ <?php echo $message->cityhaswork->price;?></p>
    <p><strong>Día: </strong><?php echo $message->date; ?></p>
    <p><strong>Horas: </strong><?php echo $message->hours; ?></p>
    <p><strong>Mensaje: </strong><?php echo $message->message;?></p>
    
    <div>
    <div id="map-canvas"></div>
    <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $message->latitude; ?>,<?php echo $message->longitude; ?>&zoom=16&size=600x300&maptype=roadmap
&markers=color:blue%7Clabel:S%7C<?php echo $message->latitude; ?>,<?php echo $message->longitude; ?>&markers=color:green%7Clabel:G%7C40.711614,-74.012318&sensor=true" />
    </div>
    
    <div class="btns">
    <?php if ( $message->isaccepted ==0) { ?>
    		<a href="message.php?accept=true&id=<?php echo $_GET['id']; ?>" class="btn">Aceptar</a>
    		<a href="message.php?ignore=true&id=<?php echo $_GET['id']; ?>" class="btn">Ignorar</a>
    <?php } else  if ( $message->isaccepted ==1) { ?>
        <a href="message.php?id=<?php echo $_GET['id']; ?>" class="btn">Aceptado</a>
    <?php } else  if ( $message->isaccepted ==2) { ?>
        <a href="message.php?id=<?php echo $_GET['id']; ?>" class="btn">Rechazado</a>
     <?php } ?>
     <?php } else {   ?>
     <h1>Oups....</h1>
     <p>No tienes permiso, para mirar este enlace. </p>
     <img src="images/boy/sad.svg" />
	 <script>window.location = 'messages.php'; </script>
	 
     <?php } ?>
    <div class="clear"></div>
   </div>
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
