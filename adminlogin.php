<?php

	require_once ('DB_Functions.php');
	
	//connection to db and constructor of function class
	$db = new DB_Functions();
	
	$response = array("error" => false);
	
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['adminid'])) {
		
		//got details
		$username = $_POST['username'];
		$password = $_POST['password'];
		$gfmid = $_POST['adminid'];
		
		//get the username and password.
		$verify = $db->checkuseractivedAdmin($username); //check if email verification is over or not
		$checkuser = $db->checkifuserexistedAdmin($username);
		$user = $db->getuserDataAdmin($username, $password, $adminid); // get username & password
		if($user != false){
				//successfully found user data
				$response["error"] = FALSE;
				$response["uid"] = $user["unique_id"];
				$response["user"]["username"] = $user["username"];
				$response["user"]["email"] = $user["email"];
				$response["user"]["created_at"] = $user["created_at"];
				$response["user"]["updated_at"] = $user["updated_at"];
				$response["user"]["fullname"] = $user["fullname"];
				echo json_encode($response); //change into json format
		}
		if($checkuser != false){
			//check if email verification is over or not
			if($verify){
				if(!$db->checkifuserexistedAdminid($adminid)){
					// user is not found with admin id
					$response["error"] = TRUE;
					$response["error_msg"] = "Admin ID not found";
					echo json_encode($response);
				}else{
					$user = $db->getuserDataAdmin($username, $password, $adminid); // get username & password
					if($user != false){
							//successfully found user data
							$response["error"] = FALSE;
							$response["uid"] = $user["unique_id"];
							$response["user"]["username"] = $user["username"];
							$response["user"]["email"] = $user["email"];
							$response["user"]["created_at"] = $user["created_at"];
							$response["user"]["updated_at"] = $user["updated_at"];
							$response["user"]["fullname"] = $user["fullname"];
							echo json_encode($response); //change into json format
					}else{
							// user is not found with the credentials
							$response["error"] = TRUE;
							$response["error_msg"] = "Login credentials are wrong. Please try again!";
							echo json_encode($response);
					}
				}
			}else{
					// user is not found with email verification
					$response["error"] = TRUE;
					$response["error_msg"] = "Email verification left";
					echo json_encode($response);
			}
		}else{
			// required post params is missing
			$response["error"] = TRUE;
			$response["error_msg"] = "Admin User not found";
			echo json_encode($response);	
		}
		
	
	}else{
		// required post params is missing
		$response["error"] = TRUE;
		$response["error_msg"] = "Required parameters is missing!";
		echo json_encode($response);
	}
	
?>