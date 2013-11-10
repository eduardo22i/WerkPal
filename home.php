<?php require_once('Models/general.php'); ?>
<?php require_once('Controllers/controller_userhasworks.php'); ?>
<?php $obj = new controller_userhasworks(); ?>
<?php $obj->findAll($_SESSION['MM_Usernameid']); ?>

<?php require_once('Controllers/controller_user.php'); ?>
<?php $user = new controller_user(); ?>
<?php $user->find($_SESSION['MM_Usernameid']); ?>



<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Home</title>
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

<div id="homeinformation">
	<h1><?php echo  $user->user->name; ?> <?php print $user->user->lastname; ?></h1>
    <h2><?php echo  $user->user->city->city->name; ?></h2>
	<p> <?php echo  $user->user->biography; ?></p>


    <!-- Información del usuario, width 74%, float right, border solid, border top y bottom 1px: -->
    <?php foreach ($obj->recordset as $userhaswork) { ?>
    <div class="homedetails">
    
        <!-- Imagen de role: -->
        <img src="<?php echo $userhaswork->cityhaswork->work->badgePhoto; ?>" class="icon" />
    
        <!-- Detalles de  -->
        <h1><?php echo $userhaswork->cityhaswork->work->name; ?></h1>
    
        <div class="homedetailsrank">
            <img src="images/star.png" width="23" height="23" />
           <img src="images/star.png" width="23" height="23" />
           <img src="images/star.png" width="23" height="23" />
           <img src="images/star.png" width="23" height="23" />
           <img src="images/star.png" width="23" height="23" />
        </div>
    
        <h2>$ <?php  printf("%1\$.2f", $userhaswork->cityhaswork->price); ?> por Hora</h2>
    </div>
    
    <?php }  ?>

</div>
<div class="clear"></div>

<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
