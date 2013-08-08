<?php

include_once("constants.php");

class menu{
	private $_strText;
	
	
	function menu(){
		$this->_strText = "Hi this is the constructor of the Menu";
	}
	
	function toHTML(){
		$strHTML = "<h2>Menu</h2>
							<div class=\"troubleshoot\">This is the default page for the application's website.</div>
							<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>