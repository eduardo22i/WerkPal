<?php
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
  $_SESSION['MM_Usernameid'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['MM_Usernameid']);

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

if (!(isset($userstay)) ) {
	
	$MM_restrictGoTo = "login.php";
	if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))   ) {   
	  $MM_qsChar = "?";
	  $MM_referrer = $_SERVER['PHP_SELF'];
	  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
	  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
	  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
	  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
	  header("Location: ". $MM_restrictGoTo); 
	  exit;
	}
}
?>



<?php 

if (!(isset($userstay)) ) {
	
	require_once('Controllers/controller_user.php'); 
	
	$user_controler = new controller_user(); 
	
	$user = $user_controler->find($_SESSION['MM_Usernameid']); 
	
	$userinfo =  '<div id="informationUser">
			<div class="userimage">
			<img src=" '. $user->photo .' " >
			</div>
			<h1>' . $user->completename . '</h1>
			<img src="images/world.svg" width="14" /><h2>'. $user->city->name . '</h2>
			';

	switch ($menu) {
		case "money":
			$userinfo .=  ' <hr/>
    <ul>
    	<li><a href="money.php" >Transacciones</a></li>
       <li><a href="remittances.php">Remesas</a></li>
       <li><a href="buy.php">Compras</a></li>
	   <li><a href="pendingpayments.php">Pagos Pendientes</a></li>

    </ul>';
	break;
	case "offers":
			$userinfo .=  ' <hr/>
    <ul>
    	<li><a href="messages.php" >Mensajes</a></li>
       <li><a href="findaservice.php">Contratar</a></li>
       <li><a href="makereview.php">Hacer Reseña</a></li>
    </ul>';

		
		break;
		
		
	}
	
	$userinfo .=  '</div> ';
	
}
?>