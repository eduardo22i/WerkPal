<?php

require_once('base.php'); 
require_once('Models/cityhaswork.php'); 
require_once('controller_city.php'); 
require_once('controller_work.php'); 

class controller_cityhaswork extends base  { 
	
	public $cityhaswork;
	
	public function __construct() {
		$this->recordset=array();
	}
	
	public function findAll($cityhasworkid) {
		//Connect to db
		$this->connectoDB();
		
		//make query
		$cityhasworkdata =  $this->selectquerysDB(sprintf ("SELECT * FROM cityhaswork WHERE idcity = %s",GetSQLValueString($cityhasworkid, "int")));

		$i = 0;
		foreach ($cityhasworkdata as $querymessage) { 
		
			
			$cityhaswork = new cityhaswork();
			$cityhaswork->id = $querymessage['id'];
			$city = new controller_city ();
			$cityhaswork->city = $city->find($querymessage['idcity']);
			$work = new controller_work ();
			$cityhaswork->work =  $work->find($querymessage['idwork']);
			$this->cityhaswork->price =  $querymessage['price'];
			
			 
			$this->recordset[$i] = $cityhaswork;
			$i++;
			

		
		}
		return $this->recordset;
	}
	
	public function find($cityhasworkid) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$cityhasworkdata =  $this->selectquerysDB("SELECT * FROM cityhaswork WHERE id =".$cityhasworkid);
		
		//Assign the values
		
	
		$this->cityhaswork = new cityhaswork();
		$this->cityhaswork->id = $cityhasworkdata[0]['id'];
		$city = new controller_city ();
		$this->cityhaswork->city = $city->find($cityhasworkdata[0]['idcity']);
		$work = new controller_work ();
		$this->cityhaswork->work =  $work->find($cityhasworkdata[0]['idwork']);
		$this->cityhaswork->price =  $cityhasworkdata[0]['price'];
		
		return $this->cityhaswork;
	}
	
}


	

?>
