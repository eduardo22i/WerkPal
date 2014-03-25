<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once('Connections/userin.php'); ?>

<?php require_once('Models/general.php'); ?>

<?php require_once('Controllers/controller_userhasworks.php'); ?>
<?php $obj = new controller_userhasworks(); ?>
<?php $userworks = $obj->findAll($user->id); ?>


<?php require_once('Controllers/controller_review.php'); ?>
<?php $controller_review = new controller_review(); ?>




<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Profile</title>
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

<div id="profileinformation">
	<div class="userinfo">
    	<h1><?php echo $user->completename; ?></h1>
	    <img src="images/world.svg" width="14" /><h2><?php echo  $user->city->name; ?></h2>
	 	<p> <?php echo  $user->biography; ?></p>
    </div>
    <div class="userimage" >
    	<img src="<?php echo  $user->photo; ?>" width="190" alt="<?php echo  $user->name; ?> " >
	</div>


	<div class="clear"></div>
	
    <hr />
	<h1>Fuertes</h1>    
    <?php foreach ($userworks as $userhaswork) { ?>
    <div class="profiledetails">
    
        <!-- Imagen de role: -->
        <img src="<?php echo $userhaswork->cityhaswork->work->badgePhoto; ?>" class="icon" />
           
        
        <div class="profiledetailsrank">
           <img src="images/star.png" width="23" height="23" />
           <img src="images/star.png" width="23" height="23" />
           <img src="images/star.png" width="23" height="23" />
           <img src="images/star.png" width="23" height="23" />
           <img src="images/star.png" width="23" height="23" />
        </div>
        
         <h1><?php echo $userhaswork->cityhaswork->work->name; ?></h1>
        
        <h2>$ <?php  printf("%1\$.2f", $userhaswork->cityhaswork->price); ?> por Hora</h2>
        
    
        
        <div class="clear"></div>
    </div>
    
    <?php }  ?>
    
	
    <hr />
	<h1>Reseñas</h1>
 <?php foreach ($userworks as $userhaswork) { ?>
 	<?php $reviews = $controller_review->findToUser($userhaswork->id); ?>
    	<section class="review">
        <h1> <?php echo $userhaswork->cityhaswork->work->name; ?></h1>
         
    	<?php if (count($reviews) > 0 ) { ?>
            <?php foreach ($reviews as $review) { ?>
            	
              <section class="inreview">
              <span class="totalreview"><?php echo $review->review; ?> / 10</span>
              <p class="comment"><?php echo $review->comment; ?></p> 
               			   
 
              <h1><?php echo $review->reviewer->completename; ?></h1> <span class="date">- <?php echo date("M d, Y", strtotime($review->created)); ?> </span>
              </section>
            <?php } ?>

     	<?php } else { ?>
        <?php errorAlert(); ?>
     	<?php }  ?>
        </section>
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
