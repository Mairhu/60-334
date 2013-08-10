<?php

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
// Abort processing if this is not an HTTP POST request...
if ($_SERVER['REQUEST_METHOD'] != 'POST')
  die;


//===========================================================================
// Abort processing if the HTTP-Referrer header is not provided or is
// incorrect...
/*if (!array_key_exists('referring-page', $_SESSION))
{
  header('Location: '.url_to_redirect_to($login_url));
  exit();
}*/

//===========================================================================
// Initially assume there are no errors in processing...
$error_flag = FALSE;

// Unset any previous error messages...
if (array_key_exists('strUsername.err', $_SESSION))
	unset($_SESSION['strUsername.err']);
if(array_key_exists('strPassword.err', $_SESSION))
	unset($_SESSION['strPassword.err']);
  
  
  // Process the username field...
if (array_key_exists('strUsername', $_POST))
{
  // Remember this username...
  $_SESSION['strUsername'] = $_POST['strUsername'];

  // Check if username is not blank...
  if (Trim($_POST['strUsername']) == "")
  {
    $error_flag = TRUE;
    // Username is invalid, so store session error message...
    $_SESSION['strUsername.err'] = "Invalid username.";
  }
}

  // Process the password field...
if (array_key_exists('strPassword', $_POST))
{
  // Remember this password...
  $_SESSION['strPassword'] = $_POST['strPassword'];

  // Check if password is not blank...
  if (Trim($_POST['strPassword']) == "")
  {
    $error_flag = TRUE;
    // Password is invalid, so store session error message...
    $_SESSION['strPassword.err'] = "Invalid password.";
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