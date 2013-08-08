<?php

include_once("constants.php");

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