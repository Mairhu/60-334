<?php
include_once("constants.php");
require_once("formElement.class");

session_start();

// Initialize variables
$loginMessage = "";
$invalid_log = FALSE;

// Determine if user is logged in and display messages/links accordingly
if(array_key_exists('intUserID', $_SESSION)){
	if($_SESSION['intUserType'] == 1 || $_SESSION['intUserType'] == 2){
		$loginMessage = "/<a href='Admin/Admin.php'>Admin Page</a>";
	}
	$loginMessage = "Welcome ".$_SESSION['strFirstName']."!" . $loginMessage;
}
else{
	$loginMessage = "<a href='main.php?strPage=register'>Register</a>";
	$invalid_log = TRUE;
}

// Set up buttons on the page
function setupButtons($arrUse){
	$strHTML = "";
	foreach($arrUse as $strImage => $page){
		if(isset($page)){
			$strGet = "?strPage=".$page;
		}
		else{
			$strGet = "";
		}
		$strHTML .= "<td class=\"aC\"><a href=\"main.php" . $strGet . "\">
							<img class=\"navigationImage button\" src=\"" . $strImage . "\"/></a>
							</td>";
	}
	return $strHTML;
}

if(isset($_POST["strPage"])){
	require_once($_POST["strPage"] . ".php");
	$strPage = $_POST["strPage"];
}

else if(isset($_GET["strPage"])){
	require_once($_GET["strPage"] . ".php");
	$strPage = $_GET["strPage"];
}
else{
	require_once("defaultPage.php");
	$strPage = "defaultPage";
}

$objPage = new $strPage();

//Load page depending on user login status
if(!$invalid_log){
	$arrUse = $arrLoginPages;
}
else{
	$arrUse = $arrGuestPages;
}

?>

<!-- HTML page -->
<!DOCTYPE html>
<html>
	<head>
		<title>Tantalizing Asian Cuisine - Page <?= $arrPageNames[$strPage]?></title>
		<link rel="stylesheet" type="text/css" href="common.css"/>
		<script type="text/javascript" src="main.js"></script>
	</head>
	<body>
		<h1 class="title">Tantalizing Asian Cuisine</h1>
			<div class="navigation stripPadding">
				<img class="flL" src="images/lt.jpg"/>
					<table class="navigationTable stripPadding flL">
						<tr>
							<?=setupButtons($arrUse)?>
						</tr>
					</table>
				<img class="flR" src="images/rt.jpg"/>
			 </div>
			 
			<div class="mainPane clB">
				<div class="spacerDiv flL">
					<img class="bottomLeft" src="images/lb.jpg"/>
				</div>
				<div class="content flL"><?= $objPage->toHTML()?><?php echo $loginMessage; ?></div>
			<div class="spacerDiv flR">
				<img class="bottomRight" src="images/rb.jpg"/>
			</div>
			<?php echo $loginMessage; ?>
			<div class="bottomBorder">
				<table class="buttonTable aC">
					<tr>
						<td><a onclick="changeBackground('default')"><img class="navigationImage button" src="<?=strIMAGE_BKG_DEF?>" /></a></td>
						<td><a onclick="changeBackground('1')"><img class="navigationImage button" src="<?=strIMAGE_BKG_1?>" /></a></td>
						<td><a onclick="changeBackground('2')"><img class="navigationImage button" src="<?=strIMAGE_BKG_2?>" /></a></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>