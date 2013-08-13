<?php

include_once("constants.php");

class aboutUs{
	private $_strText;
	
	
	function aboutUs(){
		$this->_strText = "Hi this is the constructor of the about us page";
	}
	
	function toHTML(){
		$strHTML = "<h2>About Us</h2>
							<div><iframe width='425' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://maps.google.ca/maps?q=560+Wyandotte+Street+West,+Windsor,+ON&amp;sll=42.312003,-83.043063&amp;hl=en&amp;ie=UTF8&amp;hq=&amp;hnear=560+Wyandotte+St+W,+Windsor,+Ontario+N9A+5X8&amp;ll=42.311529,-83.042414&amp;spn=0.006593,0.016512&amp;t=m&amp;z=14&amp;output=embed'></iframe><br /><small><a href='https://maps.google.ca/maps?q=560+Wyandotte+Street+West,+Windsor,+ON&amp;sll=42.312003,-83.043063&amp;hl=en&amp;ie=UTF8&amp;hq=&amp;hnear=560+Wyandotte+St+W,+Windsor,+Ontario+N9A+5X8&amp;ll=42.311529,-83.042414&amp;spn=0.006593,0.016512&amp;t=m&amp;z=14&amp;source=embed' style='color:#0000FF;text-align:left'>View Larger Map</a></small></div>
							<p>Located at 560 Wyandotte St. W., we serve some of the best Asian food in the city!  Stop by sometime, and try it for yourself!</p>";
							
		return $strHTML;
	}

}

?>