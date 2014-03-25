<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}
$menu = "money";
?>
<?php require_once('Connections/userin.php'); ?>
<?php require_once('Models/general.php'); ?>

<?php require_once('Controllers/controller_message.php'); ?>
<?php $controller_message = new controller_message();  ?>
<?php $message = $controller_message->findForUser($_GET['id'], $user->id);  ?>


<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Checkout</title>
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
    
    <h1>Vista Previa</h1>
    
    <?php  if (!($message) == "") { ?> 
        <p>Trabajo como <?php echo $message->cityhaswork->work->name; ?></p>
        <p>en <?php echo $message->cityhaswork->city->name;?></p>
        
        <p><strong>Precio: </strong> $ <?php echo $message->cityhaswork->price;?></p>
        <p><strong>Día: </strong><?php echo $message->date; ?></p>
        <p><strong>Horas: </strong><?php echo $message->hours; ?></p>
        <p><strong>Mensaje: </strong><?php echo $message->message;?></p>
        
        <div>
        <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $message->latitude; ?>,<?php echo $message->longitude; ?>&zoom=16&size=600x300&maptype=roadmap
    &markers=color:blue%7Clabel:S%7C<?php echo $message->latitude; ?>,<?php echo $message->longitude; ?>&markers=color:green%7Clabel:G%7C40.711614,-74.012318&sensor=true" />
        </div>
        
        <hr />
        
        <h1>Checkout</h1>
        
        <!--
        TODO: As open source project, feel free to insert your payment method.
        -->
        <form>
        	<p>Tarjeta de Credito</p>
        	<input type="text" placeholder="XXXX-XXXX-XXXX-XXXX" pattern="1111-1111-1111-1111" />
            
           <p>Códgio de Seguridad</p>
           <input type="text" placeholder="XXX"  maxlength="3" />
           
           <p>Fecha de Expiración</p>
           
           <p>Mes</p>
           <select name="month">
        		<?php for ($i =1; $i<= 12 ; $i++) { ?>
	        	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
    	       <?php } ?>
           </select>

           <p>Año</p>
           <select name="year">
        		<?php for ($i =2013; $i<= 2014 ; $i++) { ?>
        		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
           	<?php } ?>
           </select>
           
           <input type="submit" value="Pagar" />
        </form>
        
    <?php } else {   ?>
    
    	<h1>Oups....</h1>
       <p>No tienes permiso, para mirar este enlace. </p>
       <img src="images/boy/sad.svg" />
	   
	   <script>window.location = 'pendingpayments.php'; </script>
	 
     <?php } ?>
        
    <div class="clear"></div>
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
