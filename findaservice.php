<?php require_once('Models/general.php'); ?>
<?php require_once('Controllers/controller_city.php'); ?>
<?php $cities = new controller_city(); ?>
<?php $cities->findAll( ); ?>


<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Find Workers</title>
<script>


function showHint2(str) {
	var xmlhttp;
	if (str.length==0) { 
	  document.getElementById("tableofworks").innerHTML="";
	  return;
	}
	if (window.XMLHttpRequest)  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("tableofworkers").innerHTML=xmlhttp.responseText;
	   }
	}
	xmlhttp.open("GET","tableofworkers.php?idcityhaswork="+str,true);
	xmlhttp.send();
}

function showHint(str) {
	var xmlhttp;
	if (str.length==0) { 
	  document.getElementById("tableofworks").innerHTML="";
	  return;
	}
	if (window.XMLHttpRequest)  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	} else {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("tableofworks").innerHTML=xmlhttp.responseText;
		document.getElementById("tableofworkers").innerHTML="";
	   }
	}
	xmlhttp.open("GET","tableofworks_price.php?idcity="+str,true);
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
	<div id="headercontainer"><a href="http://wildgriffin.com/werkpal/"><img src="images/Logo.png" width="150" height="150" /></a>
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

<div id="findaservicecontainer">
    <h1>Search for someone who can help you</h1>
    <form>
        <select name="idcity" onChange="showHint(this.value)">
        <option>Choose your city</option>
        <option>.........................</option>
        <?php foreach ($cities->recordset as $city) {  ?>
        <option value="<?php echo $city->id ; ?>"><?php echo $city->name; ?></option>
        <?php } ?>
        </select>
        
            
        <div id="tableofworks"> </div>
        <div id="tableofworkers"> </div>
    </form>
    <img src="images/worker.png" class="imgdetail" />
    
    <div class="clear"></div>
</div>

<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
