<?php

require_once('base.php'); 
require_once('Models/review.php'); 
require_once('controller_userhasworks.php'); 
require_once('controller_user.php'); 

class controller_review extends base  { 
	
	public $review;
	
	public function __construct() {
		$this->recordset=array();
	}
	
	public function find($reviewid) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$userdata =  $this->selectquerysDB("SELECT * FROM reviews WHERE id =".$reviewid);
		
		//Assign the values
		
		$this->review = new review();
		$this->review->id = $userdata[0]['id'];
		
		$controller_userhasworks = new controller_userhasworks();
		
		$this->review->userhavework = $controller_userhasworks->find($userdata[0]['iduserhavework']);
		
		$controller_user = new controller_user();
		$this->review->reviewer =  $controller_user->find($userdata[0]['idreviewer']);
		
		$this->review->review =  $userdata[0]['review'];
		$this->review->comment =  $userdata[0]['comment'];
		$this->review->created =  $userdata[0]['created'];

		
		return $this->review;
	}
	
	public function findToUser($reviewid) {
		
		//Connect to db
		$this->connectoDB();
		

		//make query
		$querydata =  $this->selectquerysDB("SELECT * FROM reviews WHERE iduserhavework =".$reviewid);
		
		//Assign the values
		$this->recordset=array();
		
		$i = 0;
		foreach ($querydata as $userdata) {
			$this->review = new review();
			$this->review->id = $userdata['id'];
			
			$controller_userhasworks = new controller_userhasworks();
			
			$this->review->userhavework = $controller_userhasworks->find($userdata['iduserhavework']);
			
			$controller_user = new controller_user();
			$this->review->reviewer =  $controller_user->find($userdata['idreviewer']);
			
			$this->review->review =  $userdata['review'];
			$this->review->comment =  $userdata['comment'];
			
			$this->review->created =  $userdata['created'];
			
			$this->recordset[$i] = $this->review;
			
			$i++;
		}
		
		return $this->recordset;
	}
	
}


	

?>
