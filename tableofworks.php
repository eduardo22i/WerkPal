<?php 

require_once('Controllers/controller_cityhaswork.php'); 
$cityhasworkcontroller = new controller_cityhaswork();
$cityhasworks = $cityhasworkcontroller->findAll($_GET['idcity']);

?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="workstableselection">
<tr>
<td colspan="3" cel>Oficios</td>
</tr>
        
<?php if (count($cityhasworks) > 0)  { ?> 
  <?php $tmp = 0; ?>
	  <?php foreach ($cityhasworks as $cityhaswork)  {  ?>
	    <tr>
        	<td align="center"><img src="<?php echo  $cityhaswork->work->photourl;?>"  width="20"/> </td>
        	<td><?php echo $cityhaswork->work->name ;?></td>
        	<td><input type="checkbox" name="CheckboxGroup<?php echo $tmp; ?>"  value="<?php echo  $cityhaswork->id ?>"></td>
			<?php $tmp++; ?>   
	    
	    </tr>
	  <?php } ?>
<?php }  else { ?>
	<tr>
    	<td align="center"><p>Todavía no hay trabajos disponibles en esta cuidad. <strong>Regresa</strong> Pronto!</p></td>
    </tr>
<?php }  ?>
 </table>
