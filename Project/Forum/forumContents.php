<?php
// Forum page

include_once("../formElement.class");
include_once("../Database.class");
include_once("../common.php");
session_start();

// Redirect user if they are not logged in
if(!isset($_SESSION['intUserID'])){
	header( 'Location: ../main.php' );
	exit;
}

// Initiate database
$objDB = new Database("dbRestaurant");

// Retrieve query information if the thread is set
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
					xmlhttp.open("POST","../common.php", false);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("strFunction=updateThread&intThreadID=" + intThreadID + "&text=" + strPost);
					// alert(xmlhttp.responseText);
					document.getElementById("mainBody").innerHTML = (xmlhttp.responseText);
					tinyMCE.get('strText').setContent("");
				}
		</script>
	</head>
	<body>
		<h1> <?= $strHeading?></h1>
		<div id="navigation" class="flL">
			<h2 class="padL5">Categories</h2>
			<?= getFormCategory();?>
			<a href="../main.php">Back to Home</a>
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