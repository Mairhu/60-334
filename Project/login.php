<?php
// Login page

include_once("constants.php");
include_once("formElement.class");

class login{
	private $_strText;
	
	function login(){
		$this->_strText = "Please enter your login information below:<br/>";		
	}
	
	function toHTML(){	
		// Redirect user if they are logged in
		if(isset($_SESSION['intUserID'])){
			header( 'Location: main.php' );
			exit;
		}
		
		// Create username input box
		$objInputUsername = new Input("strUserName", "strUserNameID");
		$objInputUsername->setClass("box");
		$objInputUsername->setValue("");
		$objInputUsername->setAttribute("maxlength", 60);
		
		// Create password input box
		$objInputPassword = new Input("strPassword", "strPasswordID");
		$objInputPassword->setClass("box");
		$objInputPassword->setValue("");
		$objInputPassword->setAttribute("maxlength", 60);
		$objInputPassword->setAttribute("type", "password");
		
		// Create submit button
		$objButton = new Button("strButton", "strButtonID");
		$objButton->setMethod("POST");
		$objButton->setValue("Login");
		$objButton->setAction("verifyLogin.php");

		// Determine if there are any error messages to be displayed
		$errorUsername = get_error_message('strUserName.err');
		$errorPassword = get_error_message('strPassword.err');
		
		// Reload the username session if it exists
		if(array_key_exists('strUserName', $_SESSION))
			$objInputUsername->setValue($_SESSION['strUserName']);
		
		// If the username or password is not recognized, ask user if they have registered with the site
		$registerMessage = "";
		if(array_key_exists('strUserName.err', $_SESSION) || array_key_exists('strPassword.err', $_SESSION))
			$registerMessage = "<a href=\"main.php?strPage=register\">Have you registered yet?</a>";
	
		// Display the form in html
		$strHTML = "<h2>Login</h2>
					<div class=\"troubleshoot\">This is the default page for the application's website.</div>
					<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>"
					. "<form action=\"verifyLogin.php\" method=\"POST\"><div class=\"outerbox\"><br/>Username: " . $objInputUsername->toHTML() . $errorUsername . "<br/>"
					. "<br/>Password: " . $objInputPassword->toHTML() . $errorPassword . "<br/>"
					. "<br/><div class=\"toright\">" . $objButton->toHTML() . "</div></form><br/>"
					. "<font color=\"#F00\">" .$registerMessage ."</font></div>";
							
		return $strHTML;
	}

}

?>