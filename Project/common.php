<?php

if(isset($_POST["strFunction"])){
	session_start();
	$_POST["strFunction"]();
}

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

function updateThread(){
	if(!isset($_POST["intThreadID"])){
		echo "Error - No Thread";
	}

	include_once("Database.class");
	$objDB = new Database("dbRestaurant");
	$strSQL = "INSERT INTO tblPost 
					SET intThreadID = " . $_POST["intThreadID"] . ","
					. "txtContent = " . $objDB->sanitize($_POST["text"]) . ","
					. "dtmCreatedOn = NOW(),
					intCreatedBy = " . $objDB->sanitize($_SESSION["intUserID"]) ;
	// echo $strSQL;
	if($objDB->query($strSQL)){
		echo getPosts($_POST["intThreadID"]);
	}
}

function getPosts($intThreadID){
	$objDB = new Database("dbRestaurant");
	$strSQL = "SELECT strUserName, txtContent, tblPost.dtmCreatedOn
					FROM tblPost 
					LEFT JOIN tblUser 
						ON intUserID = tblPost.intCreatedBy
					WHERE intThreadID = " . $intThreadID;
	$rsResult = $objDB->query($strSQL);
	$strReturn = "";
	$intCount = 0;
	while ($arrRow = $objDB->fetch_row($rsResult)){
		$strReturn .= "<div class=\"post" . ($intCount++)%2 . "\"><span class=\"bold\">"
							. date("Y-m-d", strtotime($arrRow["dtmCreatedOn"])) . " - " 
							. $arrRow["strUserName"] . ":</span><span class=\"padL4\""
							. $arrRow["txtContent"] . "</span></div>";
	}
	
	return $strReturn;
}

function getMenuCategories(){
	$objDB = new Database("dbRestaurant");
	$strSQL = "SELECT intMenuCategoryID, strMenuCategoryName
		FROM tblMenuCategory
		ORDER BY intMenuCategoryID";
	$rsResult = $objDB->query($strSQL);
	$arrReturn = array();
	while ($arrRow = $objDB->fetch_row($rsResult)){
		$arrReturn[$arrRow["intMenuCategoryID"]] = $arrRow["strMenuCategoryName"];
	}

	return $arrReturn;
}

?>