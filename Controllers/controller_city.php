<?php

//require('base.php'); 
require('Models/city.php'); 


class controller_city extends base  { 
	
	public $city;
	
	public function __construct() {
		$this->recordset=array();
	}
	
	public function find($cityid) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$citydata =  $this->selectquerysDB("SELECT * FROM cities WHERE id =".$cityid);
		
		//Assign the values
		
		$this->city = new city();
		$this->city->id = $citydata[0]['id'];
		$this->city->name =  $citydata[0]['name'];
		
		return $this->city;
	}
	
}


	

?>
