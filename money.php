<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}

$menu = "money";
?>
<?php require_once('Connections/userin.php'); ?>
<?php require_once('Models/general.php'); ?>

<?php require_once('Controllers/controller_transaction.php'); ?>
<?php $transaction_controller = new controller_transaction();  ?>
<?php $transactions = $transaction_controller->findAllFromUser($user->id);  ?>




<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>My Money</title>
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
    
    <div class="clear"></div>
    
    <h1>Transacciones</h1>
    <?php if (count($transactions) > 0 ) { ?>
    	<?php foreach ($transactions as $transaction) { ?>
        <div class="moneytransacctionsbox">
            <div  class="userimage" >
                <img src="<?php echo $transaction->from->photo; ?>" width="100%"/>
            </div>
            <h1><?php echo $transaction->from->completename; ?></h1>
            <p class="date"><?php echo $transaction->date; ?></p>
            <p class="type <?php if ( $transaction->type == "D") echo "greentype"; else if ($transaction->type == "R") echo "redtype"; ?>"><?php if ( $transaction->type == "D") echo "Acreditado"; else if ($transaction->type == "R") echo "Debitado"; else echo "En espera";?></p>
            <p class="price"> <?php echo number_format($transaction->price,2); ?></p>
            <div class="clear"></div>

        </div>
        <?php } ?>
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

