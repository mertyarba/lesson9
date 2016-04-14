<?php

	require_once ("../../config.php");
	
	//start server session to store data
	//in every file you want to access session you should require functions
	session_start();
	
	function login($user, $pass){
		//hash the password
		$pass = hash("sha512", $pass);
		
		//GLOBALS - access outside variable in function
		$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");
		$stmt = $mysql->prepare ("SELECT id, name FROM users WHERE username=? and password=?");
		
		echo $mysql->error;
		
		$stmt->bind_param("ss", $user, $pass);
			
			$stmt->bind_result($id, $name);
			
			$stmt->execute();
			
			//GET THE DATA
			if($stmt->fetch()){
				echo "user with id".$id."logged in!";
				
				//create sesssion variables and redirect user
				$_SESSION["user_id"] = $id;
				$_SESSION["username"] = $user;
				$_SESSION["name"] = $name;
				
				header("Location: restrict.php");
				
				
			}else{
				//username or password was wrong
				echo $stmt->error;
				echo "Wrong credentials!";
			}
		
	}
	function signup($user, $pass, $first, $last){
		
		//hash the password
		$pass = hash("sha512", $pass);
		
		//GLOBALS - access outside variable in function
		$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");
		
		$stmt = $mysql->prepare("INSERT INTO users (username, password, Name) VALUES (?,?,?)");
		
		echo $mysql->error;
		
		$name = $first." ".$last;
		
		$stmt->bind_param("sss", $user, $pass, $name);
		
		if($stmt->execute()){
			echo "user saved successfully! ";
		}else{
			echo $stmt->error;
		}
	}
	function saveInterest ($interest){
		
		$mysql = new mysqli("localhost", $GLOBALS["db_username"], $GLOBALS["db_password"], "webpr2016_mertyarba");
      $stmt= $mysql->prepare("INSERT INTO interest (name) VALUE (?)");
	  echo $mysql->error;
	  $stmt->bind_param("s", $interest);
	  
	  if($stmt->execute()){
		echo "Interest saved successfully. ";
	  }else{
		  echo $stmt->error;
	  }
	}

?>