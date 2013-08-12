<?php

include_once("constants.php");

class logout{
	private $_strText;
	
	function logout(){
		$this->_strText = "Yay you logged out!";
	}
	
	function toHTML(){
		session_destroy();
		$strHTML = "<h2>Logout</h2>
							<div class=\"troubleshoot\">This is the default page for the application's website.</div>
							<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>