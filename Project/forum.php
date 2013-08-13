<?php

include_once("constants.php");

class forum{	
	
	function forum(){
		
	}
	
	function toHTML(){
		if(!isset($_SESSION['intUserID'])){
			header("Location: main.php");
		}
		else{
			header("Location: Forum/forumContents.php");
		}
	}

}

?>