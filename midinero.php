<?php require_once('Connections/chanceamigo.php'); ?>
<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>

<?php


$insertSQL = sprintf("SELECT * FROM users WHERE id = ". $_SESSION['MM_Usernameid'] );
mysql_select_db($database_chanceamigo, $chanceamigo);
$user = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);




mysql_select_db($database_chanceamigo, $chanceamigo);
$query_transactions = sprintf("SELECT price as money, type FROM transactions WHERE id_user_to = " . $_SESSION['MM_Usernameid']);
$transactions = mysql_query($query_transactions, $chanceamigo) or die(mysql_error());
$row_transactions = mysql_fetch_assoc($transactions);
$totalRows_transactions = mysql_num_rows($transactions);

$mymoney = 0;
do {
	if ($row_transactions['type'] == "D") {
		$mymoney  =  $mymoney  + $row_transactions['money'];
	} else if ($row_transactions['type'] == "R") {
		$mymoney  =  $mymoney  - $row_transactions['money'];
	}
} while ($row_transactions = mysql_fetch_assoc($transactions));

?>
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

<div class="midinerocontainer">
	<h2>Mi dinero</h2>
	
    <div class="panel">
    	<h1>Saldo a la Fecha</h1>
    	<p>$ <?php echo $mymoney; ?></p>
	</div>
    
    <div class="clear"></div>
    <a href="enviarremesa.php" class="btn">Enviar Remesas</a>
  
    <a href="enviarremesacomprar.php" class="btn">Comprar en Honduras</a>
</div>
<div class="clear"></div>
<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
