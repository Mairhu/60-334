<?php

include_once("constants.php");

class login{
	private $_strText;
	
	
	function login(){
		$this->_strText = "Please Log In";
	}
	
	function toHTML(){
		$strHTML = "<h2>Login</h2>
							<div class=\"troubleshoot\">This is the default page for the application's website.</div>
							<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>