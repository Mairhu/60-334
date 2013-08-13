<?php

include_once("Database.class");

$login_url = 'main.php?strPage=login';
$main_url = 'main.php';

session_start();

//
// Redirects using Location: in HTTP require the absolute URL. This function
// computes this page's URL, strips off the file name (of this PHP script)
// using dirname() and appends the $relative_url passed in.
//
function url_to_redirect_to($relative_url)
{
  $url = 'http';
  if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] == 'on')
    $url .= 's';
  return $url.'://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])
    .'/'.$relative_url;
}

//===========================================================================
// Initially assume there are no errors in processing...
$error_flag = FALSE;

// Unset any previous error messages...
if (array_key_exists('strUserName.err', $_SESSION))
	unset($_SESSION['strUserName.err']);
if(array_key_exists('strPassword.err', $_SESSION))
	unset($_SESSION['strPassword.err']);
  
  // Process the username field...
if (array_key_exists('strUserName', $_POST))
{
  // Remember this username...
  $_SESSION['strUserName'] = htmlspecialchars($_POST['strUserName']);
}

  // Process the password field...
if (array_key_exists('strPassword', $_POST))
{
  // Remember this password...
  $_SESSION['strPassword'] = htmlspecialchars($_POST['strPassword']);
}

// Initiate database
$objDB = new Database("dbRestaurant");

// Validate username
$strSQL = "SELECT * FROM tblUser WHERE strUserName=".$objDB->sanitize($_SESSION['strUserName']);
$rsResult = $objDB->query($strSQL);
$arrRow = $objDB->fetch_row($rsResult);
if(empty($arrRow)){
	$_SESSION['strUserName.err'] = "User Name does not exist.";
	unset($_SESSION['strPassword']);
	$error_flag = TRUE;
}

// Validate password
$strSQL = "SELECT * FROM tblUser WHERE strPassword=".$objDB->sanitize($_SESSION['strPassword']);
$rsResult = $objDB->query($strSQL);
$arrRow = $objDB->fetch_row($rsResult);
if(empty($arrRow)){
	if(!isset($_SESSION['strUserName.err']))
		$_SESSION['strPassword.err'] = "Password is incorrect.";
	unset($_SESSION['strPassword']);
	$error_flag = TRUE;
}

// Login User
if(!$error_flag){
	$strSQL = "SELECT * FROM tblUser WHERE strUserName=".$objDB->sanitize($_SESSION['strUserName']).
		" AND strPassword=".$objDB->sanitize($_SESSION['strPassword']);
	$rsResult = $objDB->query($strSQL);
	$arrRow = $objDB->fetch_row($rsResult);
	if($arrRow["strUserName"] == $_SESSION['strUserName'] && $arrRow["strPassword"] == $_SESSION['strPassword']){
		$_SESSION['intUserID'] = $arrRow["intUserID"];
		$_SESSION['strFirstName'] = $arrRow["strFirstName"];
		$_SESSION['strLastName'] = $arrRow["strLastName"];
		$_SESSION['strEmail'] = $arrRow["strEmail"];
		$_SESSION['strUserName'] = $arrRow["strUserName"];
		$_SESSION['strPassword'] = $arrRow["strPassword"];
		$_SESSION['strPhoneNumber'] = $arrRow["strPhone"];
		$_SESSION['intUserType'] = $arrRow["intUserType"];
	}
}

//===========================================================================
// Redirect the web browser to either the form (if there were any errors) or
// the success page (if there were no errors)...
header(
  'Location: '.
  ($error_flag === TRUE
    ? url_to_redirect_to($login_url)
    : url_to_redirect_to($main_url))
);
?>