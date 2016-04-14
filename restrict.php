<?php
	
	//we need functions for dealing with session
	require_once("functions.php");
	
	if(!isset($_SESSION["user_id"])){
		//redirect not logged in user to the login page
		header("Location: login.php");
		
	}


	//?Logout is in the URL
	if(isset($_GET["logout"])){
		
		//delete the session
		session_destroy();
		
		header("Location: login.php");
	}
	
	if (isset($_GET["add_new_interest"])){
		
		if (!empty($_GET["new_interest"])){
		
		saveInterest($_GET["new_interest"]);
		
		}else{
			
			echo "You left the interest field empty!";
		}	
	}

?>

<a href="?logout=1">Log out</a>
<br>
<br>
<br>
<h1>Welcome <?php echo $_SESSION["name"];?> (<?=$_SESSION["user_id"];?>) </h1>

<h2>Add Interest</h2>
<form>

	<input type="text" name="new_interest">
	<input type="submit" name="add_new_interest" value="Add">
	
</form>