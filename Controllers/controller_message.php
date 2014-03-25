<?php

require_once('base.php'); 
require_once('Models/message.php'); 
require_once('controller_user.php'); 
require_once('controller_cityhaswork.php'); 


class controller_message extends base  { 
	
	public $message;
	
	public function __construct() {
		$this->recordset=array();
	}
	
	
	public function insert($from, $to, $cityhaswork, $date, $hours, $latitude, $longitud, $message) {
		 //Connect to db
		$this->connectoDB();
		
		//make query
		 $insertSQL = sprintf("INSERT INTO messages  (idfrom, idto, idcityhaswork, date, hours, latitude, longitude, message) VALUES 
  											 (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($from, "int"),
                       GetSQLValueString($to, "int"),
                       GetSQLValueString($cityhaswork, "int"),
                       GetSQLValueString($date, "date"),
					     GetSQLValueString($hours, "int"),
                       GetSQLValueString($latitude, "double"),
                       GetSQLValueString($longitud, "double"),
					     GetSQLValueString($message, "text"));
  		$record =  $this->querysDB($insertSQL);
	}
	
	public function find($messageid) {
		//Connect to db
		$this->connectoDB();
		
		//make query
		$record =  $this->selectquerysDB("SELECT * FROM messages WHERE id =".$messageid . " ORDER BY created DESC");
		$querymessage = $record[0];
		//Assign the values
		
		$this->message = new message();
		$this->message->id = $querymessage['id'];
		
		$idfrom = new controller_user();
		$this->message->from =  $idfrom->find($querymessage['idfrom']);	
		$idto = new controller_user();
		$this->message->to =  $idto->find($querymessage['idto']);
		
		
		$cityhaswork = new controller_cityhaswork();
		$this->message->cityhaswork = $cityhaswork->find($querymessage['idcityhaswork']);
		$this->message->isread =  $querymessage['isread'];
		$this->message->isaccepted =  $querymessage['isaccepted'];
		$this->message->date =  $querymessage['date'];
		$this->message->hours =  $querymessage['hours'];
		$this->message->latitude =  $querymessage['latitude'];
		$this->message->longitude =  $querymessage['longitude'];
		$this->message->message =  $querymessage['message'];
		
		return $this->message;
	}
	
	
	public function findForUser($messageid, $userid) {
		//Connect to db
		$this->connectoDB();
		
		//make query
		$record =  $this->selectquerysDB("SELECT * FROM messages WHERE id =".$messageid . " AND idto = ". $userid."  ORDER BY created DESC");
		
		if (count($record) > 0) { 
		$querymessage = $record[0];
		//Assign the values
		
		$this->message = new message();
		$this->message->id = $querymessage['id'];
		
		$idfrom = new controller_user();
		$this->message->from =  $idfrom->find($querymessage['idfrom']);	
		$idto = new controller_user();
		$this->message->to =  $idto->find($querymessage['idto']);
		
		
		$cityhaswork = new controller_cityhaswork();
		$this->message->cityhaswork = $cityhaswork->find($querymessage['idcityhaswork']);
		$this->message->isread =  $querymessage['isread'];
		$this->message->isaccepted =  $querymessage['isaccepted'];
		$this->message->date =  $querymessage['date'];
		$this->message->hours =  $querymessage['hours'];
		$this->message->latitude =  $querymessage['latitude'];
		$this->message->longitude =  $querymessage['longitude'];
		$this->message->message =  $querymessage['message'];
		
		return $this->message;
		}
	}
	
	
	public function findAll($queryparameter) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$recordset2 =  $this->selectquerysDB("SELECT *	FROM messages 	WHERE idto=".$queryparameter.  " ORDER BY created DESC");
		
		
		//Assign the values
		 
		
		$i = 0;
		foreach ($recordset2 as $querymessage) { 
			$message = new message();
			$message->id = $querymessage['id'];
			$idfrom = new controller_user();
			$message->from =  $idfrom->find($querymessage['idfrom']);
			$idto = new controller_user();
			$message->to =  $idto->find($querymessage['idto']);
			$cityhaswork = new controller_cityhaswork();
			$message->cityhaswork = $cityhaswork->find($querymessage['idcityhaswork']);
			$message->isread =  $querymessage['isread'];
			$message->isaccepted =  $querymessage['isaccepted'];
			$message->date =  $querymessage['date'];
			$message->hours =  $querymessage['hours'];
			$message->latitude =  $querymessage['latitude'];
			$message->longitude =  $querymessage['longitude'];
			$message->message =  $querymessage['message'];
		
			$this->recordset[$i] = $message;
			$i++;
			
		} 
		
		
	}
	
	
	public function updateMessageViewFromUser($id, $userid) {
		
		$this->connectoDB();
		//make query
		$updateSQL = sprintf("UPDATE messages
						SET isread=1
						WHERE id=".$id . " AND idto = ". $userid);
						
				
		$record =  $this->querysDB($updateSQL);
		  
		return $record;
	}
	
}


	

?>
