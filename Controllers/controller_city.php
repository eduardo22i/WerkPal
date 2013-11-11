<?php

require_once('base.php'); 
require_once('Models/city.php'); 


class controller_city extends base  { 
	
	public $city;
	
	public function __construct() {
		$this->recordset=array();
	}
	
	public function findAll( ) {
		
		//Connect to db
		$this->connectoDB();
		
		
		//make query
		$recordset2 =  $this->selectquerysDB("SELECT *	FROM cities ");
		
		//Assign the values
		
		$i = 0;
		foreach ($recordset2 as $querymessage) { 
			$city = new city();
			$city->id = $querymessage['id'];
			$city->name =  $querymessage['name'];
		
			$this->recordset[$i] = $city;
			$i++;
			
		} 
		
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
