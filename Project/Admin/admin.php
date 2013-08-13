<?php

include_once("../formElement.class");
include_once("../Database.class");
include_once("../common.php");
include_once("../constants.php");
session_start();

$objDB = new Database("dbRestaurant");

?>

<html>
	<head>
		<title>Tantalizing Asian Cuisine Administration</title>
		<link rel="stylesheet" type="text/css" href="common.css"/>
		<link rel="stylesheet" type="text/css" href="../Admin/adminCommon.css"/>
	</head>
	<body>
		<h1>Administration</h1>
		<div id="navigation" class="flL">
			<h2 class="padL5">Options</h2>
		</div>
		<div id="forumContent" >
			<div id="mainBody"  class="flR aL">
				<?= getPageContents();?>
			</div>
		</div>
	</body>
</html>