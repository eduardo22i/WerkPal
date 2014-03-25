<?php

require_once('base.php'); 
require('Models/user.php'); 
require('controller_city.php'); 

class controller_user extends base  { 
	
	public $user;
	
	public function __construct() {
		$this->recordset=array();
	}
	
	public function find($userid) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$userdata =  $this->selectquerysDB("SELECT * FROM users WHERE id =".$userid);
		
		//Assign the values
		
		$this->user = new user();
		$this->user->id = $userdata[0]['id'];
		$this->user->name = $userdata[0]['name'];
		$this->user->lastname =  $userdata[0]['lastname'];
		$this->user->completename = $this->user->name. " ". $this->user->lastname;
		$this->user->email =  $userdata[0]['email'];
		$this->user->password =  $userdata[0]['password'];
		$this->user->biography =  $userdata[0]['biography'];
		$controller_city =  new controller_city();
		$this->user->city = $controller_city ->find($userdata[0]['idcity']);
		$this->user->type =  $userdata[0]['type'];
		$this->user->photo =  $userdata[0]['photo'];
		
		return $this->user;
	}
	
}


	

?>
