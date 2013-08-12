<?php

include_once("../formElement.class");
include_once("../Database.class");
include_once("../common.php");
session_start();
$_SESSION["intUserID"] = 1;
$objDB = new Database("dbRestaurant");

if(isset($_GET["intThreadID"])){
	$intCurrentThread = $_GET["intThreadID"];
	$strHidden = "";
	$strSQL = "SELECT strThreadName FROM tblThread WHERE intThreadID = " . $intCurrentThread;
	$rsResult = $objDB->query($strSQL);
	$arrRow = $objDB->fetch_row($rsResult);
	$strHeading = $arrRow["strThreadName"];
	
}
else{
	$intCurrentThread = 0;
	$strHidden = "hidden";
	$strHeading = "Welcome to the forum!";
}

$objTextArea = new textArea("strText", "strText");
$objTextArea->setClass("commentTextArea aL");
$objButton = new button("strPost", "strPost");
$objButton->setAttribute("onclick", "submitPost(" . $intCurrentThread . ")");
$objButton->setValue("Submit Post");

function getFormCategory(){
	$objDB = new Database("dbRestaurant");
	$strSQL = "SELECT strThreadName, intThreadID
					FROM tblThread
					WHERE blnActive = 1";

	$rsResult = $objDB->query($strSQL);
	$strReturn = "";
	while($arrRow = $objDB->fetch_row($rsResult)){
		$strReturn .= "<a href=\"forumContents.php?intThreadID=" 
		. $arrRow["intThreadID"] ."\">" 
		. $arrRow["strThreadName"] . "</a><br/>";
	}
	
	return $strReturn;
	
}

?>

<html>
	<head>
		<title>Tantalizing Asian Cuisine Forum</title>
		<link rel="stylesheet" type="text/css" href="common.css"/>
		<link rel="stylesheet" type="text/css" href="forumCommon.css"/>
		<script src="../tinymce/tinymce.min.js"></script>
		<script>
				tinymce.init({selector:'textarea'});
				
				function submitPost(intThreadID){
					var xmlhttp = new XMLHttpRequest();
					var strPost = tinyMCE.get('strText').getContent();
					xmlhttp.open("POST","../common.php",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("strFunction=updateThread&intThreadID=" + intThreadID + "&text=" + strPost);
					document.getElementById("mainBody").innerHTML = (xmlhttp.responseText);
				}
		</script>
	</head>
	<body>
		<h1> <?= $strHeading?></h1>
		<div id="navigation" class="flL">
			<h2 class="padL5">Categories</h2>
			<?= getFormCategory();?>
		</div>
		<div id="forumContent" >
			<div id="mainBody"  class="flR aL">
				<?= getPosts($intCurrentThread);?>
			</div>
		</div>
		<div id="textArea" class="clB flR aL">
			<div id="textAreaDiv" class="clB flL aL <?=$strHidden?>">
				<?= $objTextArea->toHTML();?>
				<?= $objButton->toHTML();?>
			</div>
		</div>
	</body>
</html>