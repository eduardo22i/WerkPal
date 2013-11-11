<?php 


require_once('Controllers/controller_userhasworks.php'); 
$userhasworkscontroller = new controller_userhasworks();
$usershasworks = $userhasworkscontroller->findAllByCity($_GET['idcityhaswork']);

?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="workerstableselection">
<tr>
<td colspan="3" cel>Workers</td>
</tr>
        
<?php if (count($usershasworks) > 0)  { ?> 
  <?php $tmp = 0; ?>
	  <?php foreach ($usershasworks as $userhaswork)  {  ?>
	    <tr>
        	<td align="center" width="100"><img src="<?php echo  $userhaswork->user->photo; ?>"  width="100"/> </td>
        	<td valign="middle"><h2><?php echo $userhaswork->user->completename ;?></h2>
            <p><?php echo $userhaswork->user->biography ;?></p></td>
        	<td width="140">
            <!-- TODO:  -->
            <h2>$ <?php  printf("%1\$.2f", $userhaswork->cityhaswork->price); ?> </h2>
            <div class="findaservicedetailsrank">
           	<img src="images/star.png" width="23" height="23" />
           	<img src="images/star.png" width="23" height="23" />
 	          <img src="images/star.png" width="23" height="23" />
    	       <img src="images/star.png" width="23" height="23" />
       	    	<img src="images/star.png" width="23" height="23" />
        	 </div>
           <a href="sendmessage.php?iduser=<?php echo $userhaswork->user->id ;?>&idcityhaswork=<?php echo $userhaswork->cityhaswork->id; ?>" class="btn">Select</a>
           </td>
			<?php $tmp++; ?>   
	    
	    </tr>
	  <?php } ?>
<?php }  else { ?>
	<tr>
    	<td align="center"><p>Currently, there are no workers in this area.</p>
        <p>Come back, <strong>Soon</strong>!</p></td>
    </tr>
<?php }  ?>
 </table>
