<?php //initialize the session
if (!isset($_SESSION)) {
  session_start();
}
//$userstay = true;
?>


<?php
if (!isset($_SESSION['MM_Username']) ) {
	echo "<script>document.location.href = 'login.php?required=true&iduser=". $_GET['iduser'] . "&idcityhaswork=". $_GET['idcityhaswork'] . "';</script>";
}

?>
<?php require_once('Connections/userin.php'); ?>
<?php require_once('Models/general.php'); ?>


<?php require_once('Controllers/controller_user.php'); ?>
<?php $usercontroller = new controller_user(); ?>
<?php $selecteduser = $usercontroller->find($_GET['iduser']);  ?>

<?php require_once('Controllers/controller_cityhaswork.php'); ?>
<?php $cityhasworkcontroller = new controller_cityhaswork();  ?>
<?php $cityhaswork = $cityhasworkcontroller->find($_GET['idcityhaswork']);  ?>



<?php require_once('Controllers/controller_message.php'); ?>
<?php $messagecontroller = new controller_message();  ?>
<?php 
if (isset($_POST['insert'])) {
	
	$s = $_POST['year'] ."-" .$_POST['month'] . "-".$_POST['day']." ". $_POST['hour']. ":".$_POST['minutes'].":00";
	//$date = strtotime($s);
	
	$messagecontroller->insert($user->id ,$selecteduser->id, $cityhaswork->id, $s, $_POST['hours'],  $_POST['latitude'],  $_POST['longitude'], $_POST['message']);
	 
	$sent = true;
}
?>



<!doctype html>
<html><!-- InstanceBegin template="/Templates/maintemplate.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Send Message</title>
<!-- InstanceEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css"  />

<!-- InstanceBeginEditable name="head" -->


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
	  map.setZoom(18);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
	  document.getElementById("locationlatitude").value = marker.position.lat();
	  document.getElementById("locationlongitude").value = marker.position.lng();
	  document.getElementById("messagedetails").style.display = "block";

    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>


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
<?php if (!$sent ) { ?>
<div id="profileinformation">
  	 <div class="userinfo">
     	<h1><?php echo $selecteduser->completename; ?></h1>
        <img src="images/world.svg" width="14" /><h2><?php echo  $selecteduser->city->name; ?></h2>
        <p><strong> <?php echo $cityhaswork->work->name; ?></strong>: $ <?php printf("%1\$.2f", $cityhaswork->price); ?> por hora</p>
     </div>
     <div class="userimage" >
     	<img src="<?php echo  $selecteduser->photo; ?>" width="190" alt="<?php echo  $selecteduser->name; ?> " >
     </div>
     <div class="clear"></div>
</div>

<div class="clear"></div>
<hr/>

<div id="sendmessagecontainer">
	

    <h1>Ubicación del Trabajo</h1>
    <div id="map-canvas"></div>
      
 	   
      <div id="panel">
      	<input id="address" type="text" value="" placeholder="Dirreción">
      	<input type="button" value="Buscar" onclick="codeAddress()" style="float:right;">
        <div class="clear"></div>
      </div>
      
    
	<form method="post" action="sendmessage.php?iduser=<?php echo $_GET['iduser'];?>&idcityhaswork=<?php echo $_GET['idcityhaswork'];?>" id="messagedetails" style="display:none;">
    	<h1>Fecha del Trabajo</h1>
    	<p>Día</p>
		<select name="day">
        	<?php for ($i =1; $i<= 31 ; $i++) { ?>
        	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
           <?php } ?>
       </select>
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
       
       <p>Hora</p>
       <select name="hour">
        	<?php for ($i =0; $i<= 24 ; $i++) { ?>
        	<option value="<?php echo $i; ?>"><?php if ($i<10) echo "0".$i; else echo $i; ?></option>
           <?php } ?>
       </select>
       
       <p>Minutes</p>
       <select name="minutes">
        	<?php for ($i =0; $i<= 60 ; $i = $i+5) { ?>
        	<option value="<?php echo $i; ?>"><?php if ($i<10) echo "0".$i; else echo $i; ?></option>
           <?php } ?>
       </select>
       
       <h1>Detalles del Trabajo</h1>
       
       <p>Número de horas</p>
       <input type="number" name="hours"  placeholder="Hours" max="12" min="1" value="1"/> 
       
       <p>Mensaje</p>
      <textarea  name="message" cols="100" rows="10" placeholder="Your message" ></textarea>
 
      <input type="hidden" name="latitude" id="locationlatitude" placeholder="Latitude" value="" />
      <input type="hidden" name="longitude" id="locationlongitude" placeholder="Longitude" />
      
      
      <input type="hidden" name="insert" value="send" />
      <input type="submit" value="Send" />
    </form>
	
</div>
<?php  } else {  ?>
<h1>Mensaje enviado!</h1>
<a href="#" class="btn">Continuar</a>
<?php  } ?>

<div class="clear"></div>


<!-- InstanceEndEditable -->
</div>

<footer>
<img src="images/werkpalLogo.svg" width="92" />
Werkpal, Tegucigalpa 2014
</footer>

</body>
<!-- InstanceEnd --></html>
