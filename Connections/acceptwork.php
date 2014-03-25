<?php require_once('chanceamigo.php'); ?>

<?php

if (isset($_GET['accept'])) {
	
	$insertSQL = sprintf("UPDATE messages
							SET isaccepted=1
							WHERE id=".$_GET['id'] . " AND  idto = " . $user->id);
	mysql_select_db($database_chanceamigo, $chanceamigo);
  	$Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	
	
	$query_messages = sprintf("SELECT m.id as id, m.idto, m.idfrom,  m.date, m.hours, m.isaccepted, w.name as workname, c.name as city, cw.price as price
							 FROM ((messages m
							 JOIN cityhaswork cw
							 ON m.idcityhaswork = cw.id)
							 JOIN works w
							 ON cw.idwork = w.id)
							 JOIN cities c
							 ON cw.idcity = c.id
 							 WHERE m.id=".$_GET['id'] . " AND  m.idto = " . $user->id);
							 
	
	//$query_messages = sprintf("SELECT * FROM messages WHERE id = ".$_GET['id']);
	$messages = mysql_query($query_messages, $chanceamigo) or die(mysql_error());
	$row_messages = mysql_fetch_assoc($messages);
	$totalRows_messages = mysql_num_rows($messages);
	
	
	
	if ($row_messages['isaccepted'] == 1 &&  $row_messages!= "") {
	
		$insertSQL = sprintf("INSERT INTO transactions (id_user_to, id_user_from, type, price) VALUES 
  											 		  (%s, %s, %s, %s)",
						   GetSQLValueString($row_messages['idto'], "int"),
						   GetSQLValueString($row_messages['idfrom'], "int"),
						   GetSQLValueString("C", "text"),
						   GetSQLValueString($row_messages['price'] * $row_messages['hours'] , "double"));						  
		mysql_select_db($database_chanceamigo, $chanceamigo);
  		$Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	}
	
}

if (isset($_GET['ignore'])) {
	
	$insertSQL = sprintf("UPDATE messages
							SET isaccepted=2
							WHERE id=".$_GET['id'] - " AND  m.idto = " . $user->id);
	mysql_select_db($database_chanceamigo, $chanceamigo);
  	$Result1 = mysql_query($insertSQL, $chanceamigo) or die(mysql_error());
	
	
}

?>