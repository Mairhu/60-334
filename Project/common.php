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

?>