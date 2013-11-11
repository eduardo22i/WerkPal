<?php 

class base { 

    public $recordset;
	
	public $hostname_chanceamigo ;
	public $database_chanceamigo;
	public $password_chanceamigo;
	public $chanceamigo;
	
	public function __construct() {
		
		
		$this->connectoDB();
   }
   
   public function find() {
	   
   }
   
   public function findAll() {
	   
   }
      
   //#Region private
   public function connectoDB() {
	   

	   /*
	    $this->hostname_chanceamigo = "68.178.138.182";
		$this->database_chanceamigo = "palenterprises";
		$this->username_chanceamigo = "palenterprises";
		$this->password_chanceamigo = "unPato1!";
		
		*/
		$this->hostname_chanceamigo = "localhost";
		$this->database_chanceamigo = "Hack";
		$this->username_chanceamigo = "root";
		$this->password_chanceamigo = "root";
		
		$this->chanceamigo = mysql_pconnect($this->hostname_chanceamigo, $this->username_chanceamigo, $this->password_chanceamigo) or trigger_error(mysql_error(),E_USER_ERROR);  
   }
   
   
   
   public function selectquerysDB($query) {
		mysql_select_db($this->database_chanceamigo, $this->chanceamigo);
		$query_query = sprintf($query);
		
					 
		$query = mysql_query($query_query, $this->chanceamigo) or die(mysql_error());
		$row_query = mysql_fetch_assoc($query);
		$totalRows_query = mysql_num_rows($query);  
		
		$array = array();
		if ($totalRows_query > 0) {
		$i = 0;
			do {
				$array[$i] = $row_query;
				
				$i++;
				
			} while ($row_query = mysql_fetch_assoc($query) );
		
		}
		return $array;
	 }
	  
	  
   
}

?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>