<?php

require_once('base.php'); 
require_once('controller_user.php'); 

require('Models/transaction.php'); 

class controller_transaction extends base  { 
	
	public $transaction;
	
	public function __construct() {
		$this->recordset=array();
	}
	
	public function find($id) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$userdata =  $this->selectquerysDB("SELECT * FROM transactions WHERE id =".$id);
		
		//Assign the values
		
		$this->transaction = new transaction();
		$this->transaction->id = $userdata[0]['id'];
		
		$user_controler = new controller_user(); 
		$this->transaction->to = $user_controler->find( $userdata[0]['id_user_to']); 
		$this->transaction->from = $user_controler->find( $userdata[0]['id_user_from']); 
		
		$this->transaction->type =  $userdata[0]['type'];
		$this->transaction->price =  $userdata[0]['price'];
		$this->transaction->created =  $userdata[0]['created'];


		return $this->transaction;
	}
	
	
	public function findAllFromUser($id) {
		//Connect to db
		$this->connectoDB();
		
		
		//make query
		$querymessage=  $this->selectquerysDB("SELECT * FROM transactions WHERE id_user_to = " . $id . " ORDER BY created DESC");
		//Assign the values
		
		//$userhaswork->work_icon =  str_replace("icons","Badges", $row_userhasworks['photourl']) ;
		
		$i = 0;
		
		$user_controler = new controller_user(); 

		foreach ($querymessage as $userdata ) {
			//Assign the values
		
			$this->recordset[$i] = new transaction();
			$this->recordset[$i]->id = $userdata['id'];
		
			$this->recordset[$i]->to = $user_controler->find( $userdata['id_user_to']); 
			
			//TODOTMP
			if ($userdata['id_user_from'] > 0) {
				$this->recordset[$i]->from = $user_controler->find( $userdata['id_user_from']); 
			}
		
			$this->recordset[$i]->type =  $userdata['type'];
			$this->recordset[$i]->price =  $userdata['price'];
			$this->recordset[$i]->date =  $userdata['created'];

			$i++;
		}

		return $this->recordset;
	}
	
}


	

?>
