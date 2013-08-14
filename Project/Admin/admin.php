<?php
// Admin page

include_once("../formElement.class");
include_once("../Database.class");
include_once("../common.php");
include_once("../constants.php");

session_start();

// Redirect user if they are not logged in or have wrong security permissions
if(!isset($_SESSION['intUserID']) || $_SESSION['intUserType'] != 1 && $_SESSION['intUserType'] != 2){
	header( 'Location: ../main.php' );
	exit;
}

// Initialize database
$objDB = new Database("dbRestaurant");

// Set up page
if(isset($_POST["strKey"])){
	require_once($_POST["strKey"] . ".class");
	$strPage = $_POST["strKey"];
}

else if(isset($_GET["strKey"])){
	require_once($_GET["strKey"] . ".class");
	$strPage = $_GET["strKey"];
}
else{
	$strPage = "defaultPage";
}

if($strPage != "defaultPage"){
	$objPage = new $strPage(); 
}

// Return options for administrator
function getOptions(){
	GLOBAL $arrAdminPages;
	
	$strReturn = "";
	
	foreach($arrAdminPages as $intKey=>$strName){
		$strReturn .= "<a href=\"admin.php?strKey=" . str_replace(' ','',$strName) . "\">$strName</a><br/>";
	}
	
	return $strReturn;
}

$strHTML = "Welcome to the admin page! To start, please choose a category";


?>

<!-- HTML for admin page -->
<html>
	<head>
		<title>Tantalizing Asian Cuisine Administration</title>
		<link rel="stylesheet" type="text/css" href="../common.css"/>
		<link rel="stylesheet" type="text/css" href="adminCommon.css"/>
		<script type="text/javascript" src="admin.js"></script>
	</head>
	<body>
		<h1>Administration</h1>
		<div id="navigation" class="flL">
			<h2 class="padL5">Options</h2>
				<?= getOptions();?>
			<a href="../main.php">Back to Home</a>
		</div>
		<div id="forumContent" >
			<div id="mainBody"  class="flR aL">
				<?= $strPage != "defaultPage" ? $objPage->toHTML() : $strHTML?>
			</div>
		</div>
	</body>
</html>