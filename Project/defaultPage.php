<?php

include_once("constants.php");

class defaultpage{
	private $_strText;
	
	
	function defaultPage(){
		$this->_strText = "Hi this is the constructor of the page";
	}
	
	function toHTML(){
		// Text to appear on home page
		$strHTML = "<h2>Welcome to Tantalizing Asian Cuisine!</h2>
							<div>We serve some of the best Malaysian, Thai, and Chinese food in the area.  Feel free to check out our menu.</div>
							<p>We now have a takeout option available right on our website, check it out!!!</p>";
							
		return $strHTML;
	}

}

?>