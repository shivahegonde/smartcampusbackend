<?php

	require_once ('DB_Functions.php');
	
	//connection to db and constructor of function class
	$db = new DB_Functions();
	
	$response = array("error" => FALSE); //response
	
	//isset function is applicable for variable is set or not
	if(isset($_POST['to']) && isset($_POST['message'])) {
		
		//got details
		$to = $_POST['to'];
		$message = $_POST['message'];

		$response["error"] = FALSE;
		$sendmail = $db->sendMail($to, $message);	
		echo json_encode($response);
		

	}else{
		//required parameters missing
		$response["error"] = TRUE;
		$response["error_msg"] = "Required parameters is missing!";
		echo json_encode($response);
	}

?>