<?php



/**
 *
 * @author pardhu
 *        
 */

class Update{

	public function updateSingle($fromtable, $wherecolumn, $columnvalue, $updatecolumn, $updatevalue) {
		$db = new Database(); // $db is an object for Database class
		$con = $db->connection();  // Creating connection $con using $db object
		try {
			$sql = "UPDATE ".$fromtable." SET ".$updatecolumn." = ".$updatevalue." WHERE ".$wherecolumn." = ?"; // Using prepated statements for where column value
			//echo $sql;
			$stmt = $con->prepare($sql);
			$stmt->bindParam('1', $columnvalue, PDO::PARAM_INT); // Binding ? value with the sql statement
			$output = $stmt->execute();
			return $output;
		}
		catch(Exception $e) {
			return $e;
		}
	}

	public function updateAll($fromtable, $wherecolumn, $columnvalue,$valueArray) {

		$db = new Database(); // $db is an object for Database class
		$con = $db->connection();  // Creating connection $con using $db object
		
		try {
			$se = new Select;
			$count =$se->getColoumnCount($fromtable);
			$ColoumnNames =$se->getColoumnNamesFromTable($fromtable);
			$value="=?,";
			for($x=1;$x<=$count;$x++){
				//echo $count."$$$$$".$x."######".$ColoumnNames[$x-1]."<br/>";
				if($x==1){
					$value="=?";
				$value=$ColoumnNames[$count-$x].$value;
				}else{
				$value=$ColoumnNames[$count-$x]."=?,".$value;
				}
				}
				
			$sql="UPDATE ".$fromtable." SET ".$value." WHERE ".$wherecolumn."=?";
			//echo $sql;
			//$sql = "SELECT * FROM ".$fromtable." WHERE ".$wherecolumn." = ?"; // Using prepated statements for where column value
			$stmt = $con->prepare($sql);
			
			for($r=1;$r<=$count;$r++){
				$stmt->bindValue($r, $valueArray[$r-1]); // Binding ? value with the sql statement
				//echo "<br/>".($r).$valueArray[$r-1];
				if($count==$r){
					$stmt->bindValue($r+1, $columnvalue);
					//echo "<br/>".($r).$columnvalue;
				}else{
					
				}
			}
		   $stmt->execute();
			//echo "true";
		}
		catch(Exception $e) {
			return $e;
		}
		

	}
}
?>