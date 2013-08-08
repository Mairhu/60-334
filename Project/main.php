<?php
include_once("constants.php");

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
							<img class=\"navigationImage\" src=\"" . $strImage . "\"/></a>
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

if(!isset($_SESSION["blnIsLoggedIn"])){
	$arrUse = $arrLoginPages;
}
else{
	$arrUse = $arrGuestPages;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tantalizing Asian Cuisine - Page <?= $arrPageNames[$strPage]?></title>
		<link rel="stylesheet" type="text/css" href="common.css"/>
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
				<div class="content flL"><?= $objPage->toHTML()?></div>
			<div class="spacerDiv flR">
				<img class="bottomRight" src="images/rb.jpg"/>
			</div>
		</div>
	</body>
</html>