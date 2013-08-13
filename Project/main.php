<?php
include_once("constants.php");
require_once("formElement.class");

session_start();
$invalid_log = FALSE;

// Process the username field...
if (array_key_exists('username', $_POST))
{
  // Remember this username...
  $_SESSION['username'] = $_POST['username'];

  // Check if credit card name is from 1 to 30 chars and alnum or space...
  if (preg_match('/^[A-Za-z0-9 ]{1,30}$/', $_POST['username']) != 1)
  {
    $invalid_log = TRUE;
    // Credit card name is invalid, so store session error message...
    $_SESSION['username'] = <<<ZZEOF
Credit card names can only have alphabetic, numeric, or spaces characters and must have at least 1 character and no more than 30 characters.
ZZEOF;
  }
}

// Process the password field...
if (array_key_exists('password', $_POST))
{
  // Remember this username...
  $_SESSION['password'] = $_POST['password'];

}

// Send
if (array_key_exists('strTextID', $_POST))
{
	mail('fake@fake.com', 'My Subject', $_POST['strTextID']);
}

//Will change the background when button is clicked.
function changeBackground($toThis)
{
	if($toThis == "default")
	{
		
	}
}

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

if(isset($_SESSION["blnIsLoggedIn"])){
	$arrUse = $arrLoginPages;
}
else{
	$arrUse = $arrGuestPages;
}

// Log in the user if they successfully logged in
if(array_key_exists('strPassword.err', $_SESSION) || array_key_exists('strUsername.err', $_SESSION))
{
	$arrUse = $arrGuestPages;
	echo "Login name or password is not valid.";
}
else if (array_key_exists('strPassword', $_SESSION) && array_key_exists('strUsername', $_SESSION))
{
	$arrUse = $arrLoginPages;
}

if($invalid_log)
	echo "Login name or password is not valid.";
	
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
			<?php
				if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST))
					echo "Welcome " . $_POST['username'];
			?>
		</div>
		<table class="navigationTable">
			<tr>
				<td>
					<a>
						<img src="/images/default.png" />
					</a>
				</td>
			</tr>
		</table>
	</body>
</html>