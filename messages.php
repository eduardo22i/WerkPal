<?php require_once('Models/general.php'); ?>

<?php require('Controllers/controller_user.php'); ?>
<?php $user = new controller_user(); ?>
<?php $user->find($_SESSION['MM_Usernameid']);  ?>


<?php require('Controllers/controller_message.php'); ?>
<?php $messages = new controller_message();  ?>
<?php $messages->findAll($_SESSION['MM_Usernameid']);  ?>



<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Messages</title>
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


<div id="messagescontainer">
	<?php if (count($messages->recordset )>0 ) { ?>
	<?php foreach ($messages->recordset as $message) { ?>
	
    <div class="messagesinbox <?php if ($message->isread == 0) { echo "notread";} ?>">
    	<?php if ( $message->isaccepted==0) { ?>
     	<a href="message.php?id=<?php echo $message->id; ?>" class="whitebtn">Ver</a>
        <?php } else  if ( $message->isaccepted ==1) { ?>
        <a href="message.php?id=<?php echo $message->id; ?>" class="whitebtn">Aceptado</a>
        <?php } else  if ( $message->isaccepted ==2) { ?>
        <a href="message.php?id=<?php echo $message->id; ?>" class="whitebtn">Rechazado</a>
        <?php } ?>
    	<h1>Trabajo como <?php echo $message->cityhaswork->work->name ;?></h1>
       <p>en <?php echo $message->cityhaswork->city->name ; ?></p>
       
        <div class="clear"></div>
    </div>
    <?php }  ?>
    <?php } else { ?>
    	<p>Todavía no tienes mensajes</p>
    <?php } ?>
</div>


<div class="clear"></div>
<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
