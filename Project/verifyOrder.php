<?php
// This page used to verify the information sent by the contactUs.php page

$main_url = 'main.php';
$takeoutMenu_url = 'takeoutMenu.php';

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
function check_valid_field($key, $value)
{
	//Assume field is invalid
	$invalidField = FALSE;

	//Process the key field...
	if(array_key_exists($key, $_POST))
	{
		//Remember this key...
		$_SESSION[$key] = htmlspecialchars($_POST[$key]);

		//Check if sender field is not blank...
		if (Trim($_POST[$key]) == "" || intVal(htmlspecialchars($_POST[$key])) < 0 || !is_numeric(htmlspecialchars($_POST[$key])))
		{
			$invalidField = TRUE;
			// Value is invalid, so store session error message...
			$_SESSION[$key . '.err'] = "Invalid " . $value . ".";
		}
	}
	return $invalidField;
}

// Abort processing if this is not an HTTP POST request...
if ($_SERVER['REQUEST_METHOD'] != 'POST')
  die;

// Initially assume there are no errors in processing...
$error_flag = FALSE;
$total = 0;

// Unset any previous error messages...
for($i=0;$i<intval($_SESSION['intItems']);$i++){
	$_SESSION['strOrder'.$i] = $_POST['strOrder'.$i];
	if (array_key_exists('strOrder'.$i.'.err', $_SESSION))
		unset($_SESSION['strOrder'.$i.'.err']);
		
	// Check if the email, sender, and text fields are valid
	if(check_valid_field('strOrder'.$i, 'value', TRUE)){
		$error_flag = TRUE;
	}
	else{
		$total = $total + intval($_SESSION['strOrder'.$i]);
	}
	
}

// Redirect the web browser to either the form (if there were any errors) or
// the success page (if there were no errors)...
header(
  'Location: '.
  ($error_flag === TRUE
    ? url_to_redirect_to($takeoutMenu_url)
    : url_to_redirect_to($main_url))
);

?>