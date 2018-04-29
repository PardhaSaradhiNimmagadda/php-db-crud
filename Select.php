<?php

/**
 *
 * @author pardhu
 *        
 */
class Select
{
	
	public function getColoumnCount($tablename){
		$db = new Database;
		$dbh = $db->Connection();
		$stmt = $dbh->prepare("SELECT * FROM ".$tablename."");
		//$result=$stmt->columnCount();
		$stmt->execute();
		$result1=$stmt->columnCount();
		return $result1;
	}
	
	public function getColoumnNamesFromTable($tablename) {
		$db = new Database; // $db is an object for Database class
		$con = $db->connection(); // Creating connection $con using $db object
		try {
			$sql = "DESCRIBE ".$tablename;
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$table_fields = $stmt->fetchAll(PDO::FETCH_COLUMN); // fetches all column names
			return $table_fields;
		}
		catch (Exception $e) {
			return $e;
		}
	}
	public function selectAll($tablename) {
		$db = new Database(); // $db is an object for Database class
		$con = $db->connection(); // Creating connection $con using $db object
		$result = null;
		try {
			$sql = "SELECT * FROM ".$tablename;
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$output = array();
			$output = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetches everything in an array
			return $output;
		}
		catch(Exception $e) {
			return $e;
		}
	}
	
		public function selectAllase_desc($tablename,$coloumnname,$ase_des) {
		$db = new Database(); // $db is an object for Database class
		$con = $db->connection(); // Creating connection $con using $db object
		$result = null;
		try {
			$sql = "SELECT * FROM ".$tablename." Order by ".$coloumnname." ".$ase_des." limit 5";
			
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$output = array();
			$output = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetches everything in an array
			return $output;
		}
		catch(Exception $e) {
			return $e;
		}
	}
	
	public function selectWhere($fromtable, $wherecolumn, $columnvalue) {
		$db = new Database(); // $db is an object for Database class
		$con = $db->connection();  // Creating connection $con using $db object
		try {
			$sql = "SELECT * FROM ".$fromtable." WHERE ".$wherecolumn." = ?"; // Using prepated statements for where column value
			//echo $sql;
			$stmt = $con->prepare($sql);
			$stmt->bindParam('1', $columnvalue, PDO::PARAM_INT); // Binding ? value with the sql statement
			$stmt->execute();
			$output = array();
			$output = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetches a row in an array
			//print_r($output);
			return $output;
		}
		catch(Exception $e) {
			return $e;
		}
	}

	public function selectLike($fromtable, $wherecolumn, $likevalue) {
		$db = new Database(); // $db is an object for Database class
		$con = $db->connection();  // Creating connection $con using $db object
		try {
			$sql = "SELECT * FROM ".$fromtable." WHERE ".$wherecolumn." LIKE '".$likevalue."'"; // Using prepated statements for where column value
			$stmt = $con->prepare($sql);
			//$stmt->bindParam('1', $likevalue, PDO::PARAM_INT); // Binding ? value with the sql statement
			$stmt->execute();
			$output = array();
			$output = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetches a row in an array
			//print_r($output);
			return $output;
		}
		catch(Exception $e) {
			return $e;
		}
	}
	
	
	Public function selectAutoIncrement($tablename){
	
		$db = new Database(); // $db is an object for Database class
		$con = $db->connection(); // Creating connection $con using $db object
		$result = null;
		try {

			$sql = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA ='a_t' AND TABLE_NAME = '".$tablename."'";
			//echo $sql;
			$stmt = $con->prepare($sql);
			$stmt->execute();
			//$output = array();
			$output = $stmt->fetch(PDO::FETCH_ASSOC); // fetches everything in an array
			
			return $output;
		}
		catch(Exception $e) {
			return $e;
		}
	}
	Public function selectRandom($tablename){
	
$db = new Database(); // $db is an object for Database class
		$con = $db->connection(); // Creating connection $con using $db object
		$result = null;
		try {

			$sql = "SELECT * FROM ".$tablename." ORDER BY RAND() LIMIT 6";
			//echo $sql;
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$output = array();
			$output = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetches everything in an array
			
			return $output;
		}
		catch(Exception $e) {
			return $e;
		}
	}
	

	Public function selectDistinct($tablename,$columnname){
	
$db = new Database(); // $db is an object for Database class
		$con = $db->connection(); // Creating connection $con using $db object
		$result = null;
		try {

			$sql = "SELECT DISTINCT ".$columnname." FROM ".$tablename." ORDER BY ".$columnname." ASC";
			//echo $sql;
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$output = array();
			$output = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetches everything in an array
			
			return $output;
		}
		catch(Exception $e) {
			return $e;
		}
	}
	
	
	
		// For Current Month
Public function selectCurrentDate($tablename,$Received_Date){
		
		$db = new Database(); //$db is an object for Database Class
		$con = $db->connection(); // Creating connection $con using $db object
		try{
			$sql = "SELECT * from ".$tablename." where MONTH(".$Received_Date.") = MONTH(CURDATE())";
			echo $sql;
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$output = array();
			$output = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetches everything in an array
			
			return $output;
		}
		catch(Exception $e){
			return $e;
		}
		
	}



	
}
?>