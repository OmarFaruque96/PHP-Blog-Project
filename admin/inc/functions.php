<?php 
	
	include "connection.php";
	// delete function

	function delete($table,$table_id,$item_id,$url){

		global $db;

		$query = "DELETE FROM $table WHERE $table_id = '$item_id'";

		$result = mysqli_query($db,$query);
		if($result){
			header('Location: '.$url.'');
		}else{
			die("Delete Category Error!".mysqli_error($db));
		}


	}



?>