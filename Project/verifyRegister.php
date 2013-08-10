<?php
// Register page

$register_url = 'main.php?strPage=register';
$login_url = 'main.php?strPage=login';

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
function check_valid_field($key, $value, $checkName = FALSE)
{
	//Assume field is invalid
	$invalidField = FALSE;

	//Process the key field...
	if(array_key_exists($key, $_POST))
	{
		//Remember this key...
		$_SESSION[$key] = $_POST[$key];

		//Check if key is valid...
		if($checkName && !preg_match("/^[a-zA-Z'-]+$/",$_POST[$key]))
		{
			$invalidField = TRUE;
			//Key is invalid, so store session error message...
			$_SESSION[$key . '.err'] = "Invalid " . $value . ".";
		}
		else
		{
			//Check if sender field is not blank...
			if (Trim($_POST[$key]) == "")
			{
				$invalidField = TRUE;
				// Credit card name is invalid, so store session error message...
				$_SESSION[$key . '.err'] = "Invalid " . $value . ".";
			}
		}
	}
	return $invalidField;
}

// Abort processing if this is not an HTTP POST request...
if ($_SERVER['REQUEST_METHOD'] != 'POST')
  die;

// Initially assume there are no errors in processing...
$error_flag = FALSE;

// Unset any previous error messages...
if (array_key_exists('strFirstName.err', $_SESSION))
	unset($_SESSION['strFirstName.err']);
if (array_key_exists('strLastName.err', $_SESSION))
	unset($_SESSION['strLastName.err']);
if(array_key_exists('strNewUsername.err', $_SESSION))
	unset($_SESSION['strNewUsername.err']);
if(array_key_exists('strNewPassword.err', $_SESSION))
	unset($_SESSION['strNewPassword.err']);
if(array_key_exists('strVerifyPassword.err', $_SESSION))
	unset($_SESSION['strVerifyPassword.err']);

// Check the fields to ensure they are valid
$_SESSION['strVerifyPassword'] = $_POST['strVerifyPassword'];
if(check_valid_field('strFirstName', 'first name', TRUE) | 
  check_valid_field('strLastName', 'last name', TRUE) | 
  check_valid_field('strNewUsername', 'username') | 
  check_valid_field('strNewPassword', 'password'))
{
	$error_flag = TRUE;
}

// Determine if the verified password is the same as the new password
if($_SESSION['strNewPassword'] != $_SESSION['strVerifyPassword'])
{
	$_SESSION['strVerifyPassword.err'] = "Password not verified.";
	$error_flag = TRUE;
}

// Redirect the web browser to either the form (if there were any errors) or
// the success page (if there were no errors)...
header(
  'Location: '.
  ($error_flag === TRUE
    ? url_to_redirect_to($register_url)
    : url_to_redirect_to($login_url))
);

?>