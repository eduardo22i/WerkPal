<?php

require_once('base.php'); 
require('Models/userhasworks.php'); 
require_once('controller_user.php'); 
require_once('controller_cityhaswork.php'); 

class controller_userhasworks  extends base  { 
	
	public $userhaswork;
	
	public function __construct() {
		$this->recordset=array();
	}
	public function findAllByCity($userid) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$recordset2 =  $this->selectquerysDB("SELECT * FROM usershaveworks WHERE idCityhaswork=".$userid);

		
		//Assign the values
		
		//$userhaswork->work_icon =  str_replace("icons","Badges", $row_userhasworks['photourl']) ;
		
		$i = 0;
		foreach ($recordset2 as $querymessage) { 
			$userhaswork = new userhasworks();
			$user = new controller_user();
			$userhaswork->user = $user->find($querymessage['idUser']);
			$cityhaswork = new controller_cityhaswork();
			$userhaswork->cityhaswork = $cityhaswork->find($querymessage['idCityhaswork']);
			$userhaswork->active = $querymessage['active'];
			
			 
			$this->recordset[$i] = $userhaswork;
			$i++;
			
		}
		
		return $this->recordset;
	}
	
	public function findAll($userid) {
		
		//Connect to db
		$this->connectoDB();
		
		//make query
		$recordset2 =  $this->selectquerysDB("SELECT * FROM usershaveworks WHERE idUser=".$userid);

		
		//Assign the values
		
		//$userhaswork->work_icon =  str_replace("icons","Badges", $row_userhasworks['photourl']) ;
		
		$i = 0;
		foreach ($recordset2 as $querymessage) { 
			$userhaswork = new userhasworks();
			$user = new controller_user();
			$userhaswork->user = $user->find($querymessage['idUser']);
			$cityhaswork = new controller_cityhaswork();
			$userhaswork->cityhaswork = $cityhaswork->find($querymessage['idCityhaswork']);
			$userhaswork->active = $querymessage['active'];
			
			 
			$this->recordset[$i] = $userhaswork;
			$i++;
			
		}
		
		return $this->recordset;
	}
	
}


	

?>
