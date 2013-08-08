<?php

include_once("constants.php");

class online{
	private $_strText;
	
	
	function online(){
		$this->_strText = "Hi this is the constructor of Online Takeout page";
	}
	
	function toHTML(){
		$strHTML = "<h2>Order Online</h2>
							<div class=\"\">This is the default page for the application's website.</div>
							<p class=\"\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>