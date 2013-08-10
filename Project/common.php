<?php

function getArrayDepth($array){
	$max = 1;
	$intDepth = 1;
	foreach($array as $val){
		if(is_array($val)){
			$intDepth += getArrayDepth($val);
		}
		if($intDepth > $max){
			$max = $intDepth;
		}
	}
	
	return $max;
}

//Determines any errors with the current session
function get_error_message($errorType)
{
	$errorMessage = "";
	if(array_key_exists($errorType, $_SESSION)){
		$errorMessage = '<div class="toright"><font color="#F00"><b>'.
		  htmlspecialchars($_SESSION[$errorType]).'</b></font></div>';
	}
	return $errorMessage;
}

?>