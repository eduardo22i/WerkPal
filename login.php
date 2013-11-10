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
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "seva";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  //header("Location: ". $MM_restrictGoTo); 
  //exit;
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

$showlogin = true;

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user']) && isset($_POST['login'])) {
  $loginUsername=$_POST['user'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "malo.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_chanceamigo, $chanceamigo);
   
  $LoginRS__query=sprintf("SELECT * FROM users WHERE user=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
  
  $LoginRS = mysql_query($LoginRS__query, $chanceamigo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
	
	//User information
	$row_users = mysql_fetch_assoc($LoginRS);	
	$_SESSION['MM_Usernameid'] = $row_users['id'];
	
	$welcome = true;
	
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
	
	
  } else {
	 $showlogin = false;
    header("Location: ". $MM_redirectLoginFailed );
  }
}

?>



<?php

mysql_select_db($database_chanceamigo, $chanceamigo);
$query_works = sprintf("SELECT * FROM works");
$works = mysql_query($query_works, $chanceamigo) or die(mysql_error());
$row_works = mysql_fetch_assoc($works);
$totalRows_works = mysql_num_rows($works);


mysql_select_db($database_chanceamigo, $chanceamigo);
$query_cities = sprintf("SELECT * FROM cities");
$cities = mysql_query($query_cities, $chanceamigo) or die(mysql_error());
$row_cities = mysql_fetch_assoc($cities);
$totalRows_cities = mysql_num_rows($cities);

?>

<?php 
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="yaexiste.php";
  $loginUsername = $_POST['user'];
  $LoginRS__query = sprintf("SELECT user FROM users WHERE user=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_chanceamigo, $chanceamigo);
  $LoginRS=mysql_query($LoginRS__query, $chanceamigo) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  
  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
	  
	  
	
	$MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "newuser")) {
  $insertSQL = sprintf("INSERT INTO users (name, lastname, email, user, password, idcity, photo) VALUES 
  											 (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['newemail'], "text"),
                       GetSQLValueString($_POST['newuser'], "text"),
                       GetSQLValueString($_POST['newpassword'], "text"),
                       GetSQLValueString($_POST['idcity'], "int"),
                       GetSQLValueString($_POST['photo'], "text"));		   
  mysql_select_db($database_chanceamigo, $chanceamigo);
  $Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
  $iduser = mysql_insert_id();
  
  
  for ($i = 0; $i< $totalRows_works; $i++) {
	  if (isset($_POST['CheckboxGroup'.$i])) {
	  $insertSQL = sprintf("INSERT INTO usershaveworks (idUser, idCityhaswork ) Values
	  														(%s, %s)",
							 GetSQLValueString($iduser, "text"),
                          GetSQLValueString($_POST['CheckboxGroup'.$i], "text"));
	  mysql_select_db($database_chanceamigo, $chanceamigo);
  	  $Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	  }
  }
  
  $insertGoTo = "cuenta.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

?>

<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Login</title>
<script>
function showHint(str)
{
var xmlhttp;
if (str.length==0)
  { 
  document.getElementById("tableofworks").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("tableofworks").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","tableofworks.php?idcity="+str,true);
xmlhttp.send();
}
</script>
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

<?php if ($welcome == false) { ?>
<div class="register">

<h1>Registro</h1>

<p>Sign up in 30 seconds. No credit card required. Find  the best options for works.</p>

<form method="post" action="login.php">
	
	  <input type="text" name="name"  placeholder="Nombre"/> 
	  <input type="text" name="lastname"  placeholder="Apellido"/>
	  <input type="text" name="newemail"  placeholder="Correo Electronico"/>
	  <input type="text" name="newuser"  placeholder="Usuario"/>
	  <input type="password" name="newpassword"  placeholder="Contraseña" />
	
	  
	  <select name="idcity" onChange="showHint(this.value)">
      <option>Elige una cuidad</option>
      <option>.........................</option>
	  <?php do {  ?>
	    <option value="<?php echo $row_cities['id'] ;?>"><?php echo $row_cities['name'] ;?></option>
	  <?php } while ($row_cities = mysql_fetch_assoc($cities)); ?>
	  </select>
	  
	
	  <div id="tableofworks"> 
      </div>
	  
      
	  <input type="submit" value="Registrar" />
	  <input type="hidden" name="MM_insert" value="newuser" />
	  </p>
</form>
	<div class="clear"></div>
</div>


<div class="login">

  <h1>Iniciar Sessión</h1>
  <form method="post" action="login.php">
  <?php
  if ($showlogin==false) { ?>
          <p class="error">Error en datos</p>
  <?php } ?>
  <input type="text" name="user"  placeholder="Usuario"/>
  <input type="password" name="password"  placeholder="Contraseña" />
  <input type="submit" value="Seleccionar" />
  <input type="hidden" name="login" value="true" />
  </form>

</div>
<?php } else { ?>
<h1>Welcome</h1>

<?php }  ?>
<div class="clear"></div>
<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
