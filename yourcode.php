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
<h1>Encuentra el Valor de M</h1>

<small>No sabes el valor de M (La pendiente de la función) ayudamos a encontrarla :( </small>



<?php if(isset($_GET['code'])) {  ?>

<p id="valuediv"></p>


<p id="Contrgrast">them</p>

<p> <?php echo $_GET['code']; ?> </p>
<?php }  ?>

<form>
<p>y = x * m + b</p>
<p>
var x = <?php $xw = rand(1,50); echo $xw; ?>;
var y = <?php $yw =  rand(1,50); echo $yw; ?>;
var b = <?php $bw =  rand(1,50); echo $bw; ?>;
</p>
<textarea name="code" cols="100" rows="20">

var x = <?php $xw = rand(1,50); echo $xw; ?>;
var y = <?php $yw =  rand(1,50); echo $yw; ?>;
var b = <?php $bw =  rand(1,50); echo $bw; ?>;



</textarea>
<input type="hidden" value="<?php echo ($yw - $bw) / ($xw) ?>" name="m" ?>
<input type="submit" value="Tratar" />
</form>
<script>
<?php echo $_GET['code']; ?>

var docu = document.getElementById('valuediv');
var therealm = (y - b ) / x;

if (m != null) {
	
	if (therealm == m ) {
		
		docu.innerHTML = m;
		var docu = document.getElementById('Contrgrast').innerHTML = "Buen trabajo! Te ganaste un churro! :)";
	
	} else {
		
		docu.innerHTML = "";
		var docu = document.getElementById('Contrgrast').innerHTML = "Perdiste! :( Esa no es M?!?!?";	
	}
} else {
	var docu = document.getElementById('Contrgrast').innerHTML = "Y la M?!?!?";	
}


</script>
<!-- InstanceEndEditable -->
</div>

<footer>
PalChance
</footer>

</body>
<!-- InstanceEnd --></html>
