<?php 

require_once('Controllers/controller_cityhaswork.php'); 
$cityhasworkcontroller = new controller_cityhaswork();
$cityhasworks = $cityhasworkcontroller->findAll($_GET['idcity']);

?>

<?php if (count($cityhasworks) > 0)  { ?> 

<select name="idwork" onChange="showHint2(this.value)">
    <option>Choose a service</option>
    <option>.........................</option>
    <?php foreach ($cityhasworks as $cityhaswork) {  ?>
    <option value="<?php echo $cityhaswork->id ; ?>"><?php echo $cityhaswork->work->name; ?></option>
    <?php } ?>
    </select>
<?php }  else { ?>
	<p>Todavía no hay trabajos disponibles en esta cuidad. <strong>Regresa</strong> Pronto!</p>
<?php }  ?>

