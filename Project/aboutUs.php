<?php

include_once("constants.php");

class aboutUs{
	private $_strText;
	
	
	function aboutUs(){
		$this->_strText = "Hi this is the constructor of the about us page";
	}
	
	function toHTML(){
		$strHTML = "<h2>About Us</h2>
							<div class=\"troubleshoot\">This is the default page for the application's website.</div>
							<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>