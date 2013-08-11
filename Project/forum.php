<?php

include_once("constants.php");
    
// Determine if user is logged in or not
if(empty($_SESSION['strUsername']) || empty($_SESSION['strPassword']))
{
	// If they are not, redirect user to the login page
	header("Location: main.php?strPage=login");
	die("Redirecting to main.php?strPage=login");
} 

class forum{
	private $_strText;
	
	
	function forum(){
		$this->_strText = "Welcome to the Forum!";
	}
	
	function toHTML(){
		$strHTML = "<h2>Forum</h2>
							<div class=\"troubleshoot\">This is the default page for the application's website.</div>
							<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>