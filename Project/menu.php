<?php

include_once("constants.php");

class menu{
	
	
	function menu(){
	}
	
	function toHTML(){
			include_once("menu-create.php");
			return "<link type=\"text/css\" href=\"xmlStyle.css\" />";
	}

}

?>