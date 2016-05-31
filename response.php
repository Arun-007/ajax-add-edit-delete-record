<?php
//include db configuration file
include_once("config.php");

if(isset($_POST["content_txt"]) && strlen($_POST["content_txt"])>0) 
{	//check $_POST["content_txt"] is not empty

	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	
	// Insert sanitize string in record
	$insert_row = $mysqli->query("INSERT INTO add_delete_record(content) VALUES('".$contentToSave."')");
	
	if($insert_row)
	{
		$rand	= rand(1,8);
		 //Record was successfully inserted, respond result back to index page
		  $my_id = $mysqli->insert_id; //Get ID of last inserted row from MySQL
		  echo '<li id="item_'.$my_id.'" class="item_'.$rand.'">';
		  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$my_id.'">';
		  echo '<img src="images/icon_del.gif" border="0" />';
		  echo '</a></div>';
		  echo '<textarea class="text_area" id="text_'.$my_id.'">'.$contentToSave.'</textarea>';
		  echo '<div class="update_submit" id="update-'.$my_id.'">Submit</div>';
		  echo '</li>';
		  $mysqli->close(); //close db connection

	}else{
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}
elseif(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"]))
{	//do we have a delete request? $_POST["recordToDelete"]

	//sanitize post value, PHP filter FILTER_SANITIZE_NUMBER_INT removes all characters except digits, plus and minus sign.
	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	
	//try deleting record using the record ID we received from POST
	$delete_row = $mysqli->query("DELETE FROM add_delete_record WHERE id=".$idToDelete);
	
	if(!$delete_row)
	{    
		//If mysql delete query was unsuccessful, output error 
		header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
	$mysqli->close(); //close db connection
}


if(isset($_POST["recordToText"])) 
{	//check $_POST["content_txt"] is not empty

    $contentToSave= $_POST['recordToText'];
	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$id = filter_var($_POST["recordToUpdate"],FILTER_SANITIZE_NUMBER_INT); 
	
	// Insert sanitize string in record
	$insert_row = $mysqli->query("UPDATE add_delete_record SET content='".$contentToSave."' WHERE id='".$id."'");
	
	
	if(!$insert_row)
	{
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit(); 
		 

	}else{
		
		//echo "hai";
		 $mysqli->close(); //close db connection
		
	}

}

/*else
{
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}*/

?>