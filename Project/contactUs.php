<?php

include_once("constants.php");

class contactUs{
	private $_strText;
	
	
	function contactUs(){
		$this->_strText = "Hi this is the constructor of the Contact Us page";
	}
	
	function toHTML(){
		$strHTML = "<h2>Contact Us</h2>
							<div class=\"troubleshoot\">This is the default page for the application's website.</div>
							<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>