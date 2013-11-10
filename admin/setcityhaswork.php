<?php require_once('../Connections/chanceamigo.php'); ?>

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

$added = false;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "register")) {
  $insertSQL = sprintf("INSERT INTO cityhaswork (idcity, idwork, price) VALUES 
  											 (%s, %s, %s)",
                       GetSQLValueString($_POST['idcity'], "int"),
                       GetSQLValueString($_POST['idwork'], "int"),
                       GetSQLValueString($_POST['salary'], "double"));		   
  mysql_select_db($database_chanceamigo, $chanceamigo);
  $Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
  $iduser = mysql_insert_id();
  
  $added = true;

  
}

?>

<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<link href="../style.css" rel="stylesheet" type="text/css"  />

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<header>
	<div id="headercontainer"><img src="../images/Logo.png" width="150" height="150" />
    <?php if (isset($_SESSION['MM_Username'])) { ?>
    <ul>
    	<li><a href="../home.php"> Inicio</a> </li>
    	<li><a href="../midinero.php"> Mi Dinero</a> </li>
       <li><a href="../enviarremesa.php">Enviar Remesa</a></li>
       <li><a href="../messages.php">Mensajes</a></li>
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

<?php 
if ($added) {
	echo "<p>¡Agregado con exito!</p>";
}
?>
<form method="post" action="setcityhaswork.php">
	
	  
	  
	  <select name="idcity" >
      <option>Elige una cuidad</option>
      <option>.........................</option>
	  <?php do {  ?>
	    <option value="<?php echo $row_cities['id'] ;?>"><?php echo $row_cities['name'] ;?></option>
	  <?php } while ($row_cities = mysql_fetch_assoc($cities)); ?>
	  </select>
	  
	<select name="idwork" >
      <option>Elige un Trabajo</option>
      <option>.........................</option>
	  <?php do {  ?>
	    <option value="<?php echo $row_works['id'] ;?>"><?php echo $row_works['name'] ;?></option>
	  <?php } while ($row_works = mysql_fetch_assoc($works)); ?>
	  </select>
	  
     <input type="text" name="salary"  placeholder="Precio" />

	 
	  
      
	  <input type="submit"  value="register" />
	  <input type="hidden" name="MM_insert" value="register" />

</form>


<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
