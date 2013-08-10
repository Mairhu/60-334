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
		// Create username input box
		$objInputUsername = new Input("strUsername", "strUsernameID");
		$objInputUsername->setClass("box");
		$objInputUsername->setValue("");
		
		// Create password input box
		$objInputPassword = new Input("strPassword", "strPasswordID");
		$objInputPassword->setClass("box");
		$objInputPassword->setValue("");
		
		// Create submit button
		$objButton = new Button("strButton", "strButtonID");
		$objButton->setMethod("POST");
		$objButton->setValue("Login");
		$objButton->setAction("verifyLogin.php");

		// Determine if there are any error messages to be displayed
		$errorUsername = get_error_message('strUsername.err');
		$errorPassword = get_error_message('strPassword.err');
		
		// Reload the username session if it exists
		if(array_key_exists('strUsername', $_SESSION))
			$objInputUsername->setValue($_SESSION['strUsername']);
		
		// If the username or password is not recognized, ask user if they have registered with the site
		$registerMessage = "";
		if(array_key_exists('strUsername.err', $_SESSION) || array_key_exists('strPassword.err', $_SESSION))
			$registerMessage = "<a href=\"main.php?strPage=register\">Have you registered yet?</a>";
	
		// Display the form in html
		$strHTML = "<h2>Login</h2>
					<div class=\"troubleshoot\">This is the default page for the application's website.</div>
					<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>"
					. "<form action=\"verifyLogin.php\" method=\"POST\"><div class=\"outerbox\"><br/>Username: " . $objInputUsername->toHTML() . $errorUsername . "<br/>"
					. "<br/>Password: " . $objInputPassword->toHTML() . $errorPassword . "<br/>"
					. "<br/><div class=\"toright\">" . $objButton->toHTML() . "</div></form><br/>"
					. "<font color=\"#F00\">" .$registerMessage ."</font></div>";
					
					echo htmlspecialchars($objButton->toHTML());
							
		return $strHTML;
	}

}

?>