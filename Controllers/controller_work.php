<?php

require_once('base.php'); 
require('Models/work.php'); 

class controller_work extends base  { 
	
	public $work;
	
	public function __construct() {
		$this->recordset=array();
	}
	
	public function find($workid) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$userdata =  $this->selectquerysDB("SELECT * FROM works WHERE id =".$workid);
		
		//Assign the values
		
		$this->work = new work();
		$this->work->id = $userdata[0]['id'];
		$this->work->name =  $userdata[0]['name'];
		$this->work->photourl =  $userdata[0]['photourl'];
		$this->work->badgePhoto =str_replace("icons","Badges", $userdata[0]['photourl'] ) ;
		
		return $this->work;
	}
	
}


	

?>
