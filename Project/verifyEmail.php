<?php
// This page used to verify the information sent by the contactUs.php page

// Redirect users to the contact or main page depending on success emailing
$contactUS_url = 'main.php?strPage=contactUs';
$main_url = 'main.php';

session_start();

// Redirects using Location: in HTTP require the absolute URL. This function
// computes this page's URL, strips off the file name (of this PHP script)
// using dirname() and appends the $relative_url passed in.
function url_to_redirect_to($relative_url)
{
  $url = 'http';
  if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] == 'on')
    $url .= 's';
  return $url.'://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI'])
    .'/'.$relative_url;
}

//Determines if a passed POST field is valid ($value is a string for the error message)
function check_valid_field($key, $value, $checkEmail = FALSE)
{
	//Assume field is invalid
	$invalidField = FALSE;

	//Process the key field...
	if(array_key_exists($key, $_POST))
	{
		//Remember this key...
		$_SESSION[$key] = $_POST[$key];

		//Check if key is valid...
		if($checkEmail && !filter_var($_POST[$key], FILTER_VALIDATE_EMAIL))
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

// Initially assume there are no errors in processing...
$error_flag = FALSE;

// Unset any previous error messages...
if (array_key_exists('strEmailAddress.err', $_SESSION))
	unset($_SESSION['strEmailAddress.err']);
if(array_key_exists('strSender.err', $_SESSION))
	unset($_SESSION['strSender.err']);
if(array_key_exists('strEmailText.err', $_SESSION))
	unset($_SESSION['strEmailText.err']);

// Check if the email, sender, and text fields are valid
if(check_valid_field('strEmailAddress', 'email address', TRUE) | 
  check_valid_field('strSender', 'name') | 
  check_valid_field('strEmailText', 'message'))
{
	$error_flag = TRUE;
}

// Redirect the web browser to either the contact form (if there were any errors) or
// the main page (if there were no errors)...
header(
  'Location: '.
  ($error_flag === TRUE
    ? url_to_redirect_to($contactUS_url)
    : url_to_redirect_to($main_url))
);

?>