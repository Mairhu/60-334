<?php
// Register page
include_once("Database.class");

$register_url = 'main.php?strPage=register';
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

//Determines if a passed POST field is valid ($value is a string for the error message)
function check_valid_field($key, $value, $checkName = FALSE, $checkEmail = FALSE, $checkPhoneNumber = FALSE)
{
	//Assume field is invalid
	$invalidField = FALSE;

	//Process the key field...
	if(array_key_exists($key, $_POST))
	{
		//Remember this key...
		$_SESSION[$key] = htmlspecialchars($_POST[$key]);

		//Check if key is valid...
		if($checkName && !preg_match("/^[a-zA-Z'-]+$/",htmlspecialchars($_POST[$key])))
		{
			$invalidField = TRUE;
			//Key is invalid, so store session error message...
			$_SESSION[$key . '.err'] = "Invalid " . $value . ".";
		}
		//Check if key is valid...
		else if($checkEmail && !filter_var(htmlspecialchars($_POST[$key]), FILTER_VALIDATE_EMAIL))
		{
			$invalidField = TRUE;
			//Key is invalid, so store session error message...
			$_SESSION[$key . '.err'] = "Invalid " . $value . ".";
		}
		//Check if key is valid...
		else if($checkPhoneNumber && (!is_numeric(htmlspecialchars($_POST[$key])) || 
		  intval(htmlspecialchars($_POST[$key])) < 1000000 || intval(htmlspecialchars($_POST[$key])) < 0)) {
			$invalidField = TRUE;
			//Key is invalid, so store session error message...
			$_SESSION[$key . '.err'] = "Invalid " . $value . ".";
		}
		else
		{
			//Check if sender field is not blank...
			if (Trim(htmlspecialchars($_POST[$key])) == "")
			{
				$invalidField = TRUE;
				// Credit card name is invalid, so store session error message...
				$_SESSION[$key . '.err'] = "Invalid " . $value . ".";
			}
		}
	}
	return $invalidField;
}

// Initially assume there are no errors in processing...
$error_flag = FALSE;

// Unset any previous error messages...
if (array_key_exists('strFirstName.err', $_SESSION))
	unset($_SESSION['strFirstName.err']);
if (array_key_exists('strLastName.err', $_SESSION))
	unset($_SESSION['strLastName.err']);
if(array_key_exists('strNewEmail.err', $_SESSION))
	unset($_SESSION['strNewEmail.err']);
if(array_key_exists('strNewUserName.err', $_SESSION))
	unset($_SESSION['strNewUserName.err']);
if(array_key_exists('strNewPassword.err', $_SESSION))
	unset($_SESSION['strNewPassword.err']);
if(array_key_exists('strVerifyPassword.err', $_SESSION))
	unset($_SESSION['strVerifyPassword.err']);
if(array_key_exists('strPhoneNumber.err', $_SESSION))
	unset($_SESSION['strPhoneNumber.err']);

// Check the fields to ensure they are valid
$_SESSION['strVerifyPassword'] = htmlspecialchars($_POST['strVerifyPassword']);
if(check_valid_field('strFirstName', 'first name', TRUE) | 
  check_valid_field('strLastName', 'last name', TRUE) | 
  check_valid_field('strNewEmail', 'email', FALSE, TRUE) | 
  check_valid_field('strNewUserName', 'username') | 
  check_valid_field('strNewPassword', 'password') |
  check_valid_field('strPhoneNumber', 'phone number', FALSE, FALSE, TRUE))
{
	$error_flag = TRUE;
}

// Determine if the verified password is the same as the new password
if($_SESSION['strNewPassword'] != $_SESSION['strVerifyPassword'])
{
	$_SESSION['strVerifyPassword.err'] = "Password not verified.";
	$error_flag = TRUE;
}

// Add new user to the database
$objDB = new Database("dbRestaurant");

// Determine if the username already exists in the database
$strSQL = "SELECT strUserName FROM tblUser WHERE strUserName = ".$objDB->sanitize($_SESSION['strNewUserName']);
$rsResult = $objDB->query($strSQL);
$arrRow = $objDB->fetch_row($rsResult);
if($arrRow['strUserName'] == $_SESSION['strNewUserName']){
	if(!isset($_SESSION['strNewUserName.err']))
		$_SESSION['strNewUserName.err'] = "User Name in use by another account.";
	$error_flag = TRUE;
}

// Determine if the email already exists in the database
$strSQL = "SELECT strEmail FROM tblUser WHERE strEmail= ".$objDB->sanitize($_SESSION['strNewEmail']);
$rsResult = $objDB->query($strSQL);
$arrRow = $objDB->fetch_row($rsResult);
if($arrRow['strEmail'] == $_SESSION['strNewEmail']){
	if(!isset($_SESSION['strNewEmail.err']))
		$_SESSION['strNewEmail.err'] = "Email in use by another account.";
	$error_flag = TRUE;
}

// Register User
if(!$error_flag)
{
	$strSQL = "INSERT INTO tblUser (strFirstName, strLastName, strEmail, strUserName, strPassword, strPhone, intUserType, dtmCreatedOn) 
	  VALUES (".$objDB->sanitize($_SESSION['strFirstName']).",".$objDB->sanitize($_SESSION['strLastName']).",".$objDB->sanitize($_SESSION['strNewEmail']).",".
			$objDB->sanitize($_SESSION['strNewUserName']).",".$objDB->sanitize($_SESSION['strNewPassword']).",".$objDB->sanitize($_SESSION['strPhoneNumber']).",".
			$objDB->sanitize("4").",NOW())";
	$rsResult = $objDB->query($strSQL);
	$_SESSION['strUserName'] = $_SESSION['strNewUserName'];
	$_SESSION['strPassword'] = $_SESSION['strNewPassword'];
	
	// Set the user ID
	$strSQL = "SELECT intUserID FROM tblUser WHERE strUserName = " . $objDB->sanitize($_SESSION['strUserName']);
	$rsResult = $objDB->query($strSQL);
	$_SESSION['intUserID'] = intval($rsResult);
	
	// Set the user type
	$strSQL = "SELECT intUserType FROM tblUser WHERE strUserName = " . $objDB->sanitize($_SESSION['strUserName']);
	$rsResult = $objDB->query($strSQL);
	$_SESSION['intUserType'] = intval($rsResult);

}

// Redirect the web browser to either the form (if there were any errors) or
// the success page (if there were no errors)...
header(
  'Location: '.
  ($error_flag === TRUE
    ? url_to_redirect_to($register_url)
    : url_to_redirect_to($main_url))
);

?>