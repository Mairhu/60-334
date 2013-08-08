<?php

include_once("constants.php");

class defaultpage{
	private $_strText;
	
	
	function defaultPage(){
		$this->_strText = "Hi this is the constructor of the page";
	}
	
	function toHTML(){
		$strHTML = "<h2>Default Page</h2>
							<div class=\"troubleshoot\">This is the default page for the application's website.</div>
							<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>";
							
		return $strHTML;
	}

}

?>