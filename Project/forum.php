<?php

include_once("constants.php");

class forum{	
	
	function forum(){
		
	}
	
	function toHTML(){
		// Redirect user depending on their login status
		if(!isset($_SESSION['intUserID'])){
			header("Location: main.php");
		}
		else{
			header("Location: Forum/forumContents.php");
		}
	}

}

?>