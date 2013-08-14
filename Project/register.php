<?php
// Registration page for new users

include_once("constants.php");

class register{
	private $_strText;
	
	function register(){
		$this->_strText = "You can register here.";
	}
	
	function toHTML(){
		// Redirect user if they are already logged in
		if(isset($_SESSION['intUserID'])){
			header( 'Location: main.php' );
			exit;
		}
		session_destroy();
		
		// Create the first name input box
		$objInputFirstName = new Input("strFirstName", "strFirstNameID");
		$objInputFirstName->setClass("box");
		$objInputFirstName->setValue("");
		$objInputFirstName->setAttribute("maxlength", 45);
		
		// Create the last name input box
		$objInputLastName = new Input("strLastName", "strLastNameID");
		$objInputLastName->setClass("box");
		$objInputLastName->setValue("");
		$objInputLastName->setAttribute("maxlength", 45);
		
		// Create the new email input box
		$objInputNewEmail = new Input("strNewEmail", "strNewEmailID");
		$objInputNewEmail->setClass("box");
		$objInputNewEmail->setValue("");
		$objInputNewEmail->setAttribute("maxlength", 100);
		
		// Create the new username input box
		$objInputNewUsername = new Input("strNewUserName", "strNewUserNameID");
		$objInputNewUsername->setClass("box");
		$objInputNewUsername->setValue("");
		$objInputNewUsername->setAttribute("maxlength", 60);
		
		// Create the new password input box
		$objInputNewPassword = new Input("strNewPassword", "strNewPasswordID");
		$objInputNewPassword->setClass("box");
		$objInputNewPassword->setValue("");
		$objInputNewPassword->setAttribute("maxlength", 60);
		$objInputNewPassword->setAttribute("type", "password");
		
		// Create the verify password input box
		$objInputVerifyPassword = new Input("strVerifyPassword", "strVerifyPasswordID");
		$objInputVerifyPassword->setClass("box");
		$objInputVerifyPassword->setValue("");
		$objInputVerifyPassword->setAttribute("maxlength", 60);
		$objInputVerifyPassword->setAttribute("type", "password");
		
		// Create the phone number input box
		$objInputPhoneNumber = new Input("strPhoneNumber", "strPhoneNumberID");
		$objInputPhoneNumber->setClass("box");
		$objInputPhoneNumber->setValue("");
		$objInputPhoneNumber->setAttribute("maxlength", 15);
		
		// Create the submit button
		$objButton = new Button("strButton", "strButtonID");
		$objButton->setMethod("POST");
		$objButton->setValue("Register");
		$objButton->setAction("verifyRegister.php");

		// Determine if there are any error messages to display
		$errorFirstName = get_error_message('strFirstName.err');
		$errorLastName =  get_error_message('strLastName.err');
		$errorEmail = get_error_message('strNewEmail.err');
		$errorPhoneNumber = get_error_message('strPhoneNumber.err');
		$errorUsername = get_error_message('strNewUserName.err');
		$errorPassword = get_error_message('strNewPassword.err');
		$errorVerifyPassword = get_error_message('strVerifyPassword.err');
		
		// Reload some information if the user gets redirected to this page
		if(array_key_exists('strFirstName', $_SESSION))
			$objInputFirstName->setValue($_SESSION['strFirstName']);
		if(array_key_exists('strLastName', $_SESSION))
			$objInputLastName->setValue($_SESSION['strLastName']);
		if(array_key_exists('strNewEmail', $_SESSION))
			$objInputNewEmail->setValue($_SESSION['strNewEmail']);
		if(array_key_exists('strPhoneNumber', $_SESSION))
			$objInputPhoneNumber->setValue($_SESSION['strPhoneNumber']);
		if(array_key_exists('strNewUserName', $_SESSION))
			$objInputNewUsername->setValue($_SESSION['strNewUserName']);
		
		// Create the form in html
		$strHTML = "<h2>Register</h2>
					<div class=\"troubleshoot\">This is the default page for the application's website.</div>
						<p class=\"troubleshootp\">This is the text setup with the application: " . $this->_strText . "</p>". 
						"<form action=\"verifyRegister.php\" method=\"POST\"><div class=\"outerbox\"><br/>".
							"First Name: " . $objInputFirstName->toHTML() . $errorFirstName . "<br/>". 
							"Last Name: " . $objInputLastName->toHTML() . $errorLastName . "<br/>". 
							"Email: " . $objInputNewEmail->toHTML() . $errorEmail . "<br/>". 
							"Phone Number: " . $objInputPhoneNumber->toHTML() . $errorPhoneNumber . "<br/>". 
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