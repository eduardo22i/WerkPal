<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}

$menu = "offers";

?>
<?php require_once('Connections/userin.php'); ?>
<?php require_once('Models/general.php'); ?>


<?php require_once('Controllers/controller_message.php'); ?>
<?php $messages = new controller_message();  ?>
<?php  $messages->findAll($_SESSION['MM_Usernameid']);  ?>



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


<div id="messagescontainer">
	<h1>Ofertas</h1>
    
	<?php if (count($messages->recordset )>0 ) { ?>
	<?php foreach ($messages->recordset as $message) { ?>
	
    <div class="messagesinbox <?php if ($message->isread == 0) { echo "notread";} ?>">
    	 <div  class="userimage" >
         	<img src="<?php echo $message->from->photo; ?>" width="100%"/>
        </div>
         
        <h1><?php echo $message->from->completename; ?> necesita de tus servicios en <?php echo $message->cityhaswork->work->name ;?></h1>
        <h2>Trabajo en <?php echo $message->cityhaswork->work->name ;?></h2>
        <p>en <?php echo $message->message; ?></p>
       	 
        
		<?php if ( $message->isaccepted==0) { ?>
     	<a href="message.php?id=<?php echo $message->id; ?>" class="whitebtn">Ver</a>
        <?php } else  if ( $message->isaccepted ==1) { ?>
        <a href="message.php?id=<?php echo $message->id; ?>" class="whitebtn">Aceptado</a>
        <?php } else  if ( $message->isaccepted ==2) { ?>
        <a href="message.php?id=<?php echo $message->id; ?>" class="whitebtn">Rechazado</a>
        <?php } ?>
        
        <a href="message.php?id=<?php echo $message->id; ?>">Ver Mas</a>
        
        <div class="clear"></div>
    </div>
    <?php }  ?>
    <?php } else { ?>
    	 <?php errorAlert(); ?>
    <?php } ?>
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
