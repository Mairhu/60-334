<?php
include_once("constants.php");

class register{
	private $_strText;
	
	function register(){
		$this->_strText = "You can register here.";
	}
	
	function toHTML(){
		// User is creating account, so no previous session is required
		session_destroy();
		
		// Create the first name input box
		$objInputFirstName = new Input("strFirstName", "strFirstNameID");
		$objInputFirstName->setClass("box");
		$objInputFirstName->setValue("");
		
		// Create the last name input box
		$objInputLastName = new Input("strLastName", "strLastNameID");
		$objInputLastName->setClass("box");
		$objInputLastName->setValue("");
		
		// Create the new username input box
		$objInputNewUsername = new Input("strNewUsername", "strNewUsernameID");
		$objInputNewUsername->setClass("box");
		$objInputNewUsername->setValue("");
		
		// Create the new password input box
		$objInputNewPassword = new Input("strNewPassword", "strNewPasswordID");
		$objInputNewPassword->setClass("box");
		$objInputNewPassword->setValue("");
		
		// Create the verify password input box
		$objInputVerifyPassword = new Input("strVerifyPassword", "strVerifyPasswordID");
		$objInputVerifyPassword->setClass("box");
		$objInputVerifyPassword->setValue("");
		
		// Create the submit button
		$objButton = new Button("strButton", "strButtonID");
		$objButton->setMethod("POST");
		$objButton->setValue("Register");
		$objButton->setAction("verifyRegister.php");

		// Determine if there are any error messages to display
		$errorFirstName = get_error_message('strFirstName.err');
		$errorLastName =  get_error_message('strLastName.err');
		$errorUsername = get_error_message('strNewUsername.err');
		$errorPassword = get_error_message('strNewPassword.err');
		$errorVerifyPassword = get_error_message('strVerifyPassword.err');
		
		// Reload some information if the user gets redirected to this page
		if(array_key_exists('strFirstName', $_SESSION))
			$objInputFirstName->setValue($_SESSION['strFirstName']);
		if(array_key_exists('strLastName', $_SESSION))
			$objInputLastName->setValue($_SESSION['strLastName']);
		if(array_key_exists('strNewUsername', $_SESSION))
			$objInputNewUsername->setValue($_SESSION['strNewUsername']);
		
		// Create the form in html
		$strHTML = "<h2>Register</h2>
					<div class=\"troubleshoot\">This is the default page for the application's website.</div>
						<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>". 
						"<form action=\"verifyRegister.php\" method=\"POST\"><div class=\"outerbox\"><br/>".
							"First Name: " . $objInputFirstName->toHTML() . $errorFirstName . "<br/>". 
							"Last Name: " . $objInputLastName->toHTML() . $errorLastName . "<br/>". 
							"Username: " . $objInputNewUsername->toHTML() . $errorUsername . "<br/>". 
							"Password: " . $objInputNewPassword->toHTML() . $errorPassword . "<br/>". 
							"Verify Password: " . $objInputVerifyPassword->toHTML() . $errorVerifyPassword . "<br/><br/>". 
							"<div class=\"toright\">" . 
								$objButton->toHTML() . 
							"</div>
						</form><br/>
					</div>";
							
		return $strHTML;
	}

}
?>