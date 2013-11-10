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
	
	public function find($messageid) {
		//Connect to db
		$this->connectoDB();
		
		//make query
		$record =  $this->selectquerysDB("SELECT * FROM messages WHERE id =".$messageid);
		$querymessage = $record[0];
		//Assign the values
		
		$this->message = new message();
		$this->message->id = $querymessage['id'];
		$idfrom = new controller_user();
		$this->message->from =  $idfrom->find($querymessage['idfrom']);
		$idto = new controller_user();
		$this->message->to =  $idfrom->find($querymessage['idto']);
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
	
	
	public function findAll($queryparameter) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$recordset2 =  $this->selectquerysDB("SELECT *	FROM messages 	WHERE idto=".$queryparameter);
		
		
		//Assign the values
		 
		
		$i = 0;
		foreach ($recordset2 as $querymessage) { 
			$message = new message();
			$message->id = $querymessage['id'];
			$idfrom = new controller_user();
			$message->from =  $idfrom->find($querymessage['idfrom']);
			$idto = new controller_user();
			$message->to =  $idfrom->find($querymessage['idto']);
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
	
}


	

?>
