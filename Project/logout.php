<?php

include_once("constants.php");

// Determine if user is logged in or not
if(empty($_SESSION['strUsername']) || empty($_SESSION['strPassword']))
{
	// If they are not, redirect user to the login page
	header("Location: main.php?strPage=login");
	die("Redirecting to main.php?strPage=login");
} 

class logout{
	private $_strText;
	
	function logout(){
		$this->_strText = "Yay you logged out!";
	}
	
	function toHTML(){
		session_destroy();
		header("Location: main.php?strPage=logout"); 
		$strHTML = "<h2>Logout</h2>
							<div class=\"troubleshoot\">This is the default page for the application's website.</div>
							<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>