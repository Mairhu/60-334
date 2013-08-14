<?php
// ContactUs page

include_once("constants.php");
include_once("formElement.class");

class contactUs{
	private $_strText;
	
	function contactUs(){
		$this->_strText = "Comments? Questions? Let us know what you think!<br/>";
	}
	
	function toHTML(){
		// Create the email address input box
		$objEmailAddressInput = new Input("strEmailAddress", "strEmailAddressID");
		$objEmailAddressInput->setClass("box");
		$objEmailAddressInput->setValue("");
		
		// Create the sender input box
		$objSenderInput = new Input("strSender", "strSenderID");
		$objSenderInput->setClass("box");
		$objSenderInput->setValue("");
		
		// Create the text message input box
		$objEmailTextArea = new textArea("strEmailText","strEmailTextID");
		$objEmailTextArea->setClass("box");
		$objEmailTextArea->setValue("");
		
		// Create the email button input box
		$objSendEmailButton = new Button("strSendEmail", "strSendEmailID");
		$objSendEmailButton->setValue("Send");
		$objSendEmailButton->setAction("main.php");
		
		// Determine if there are any error messages to be displayed
		$errorEmailAddress = get_error_message('strEmailAddress.err');
		$errorSender = get_error_message('strSender.err');
		$errorText = get_error_message('strEmailText.err');
		
		// Reload the email address, sender, or message session if it exists
		if(array_key_exists('strEmailAddress', $_SESSION))
			$objEmailAddressInput->setValue($_SESSION['strEmailAddress']);
		if(array_key_exists('strSender', $_SESSION))
			$objSenderInput->setValue($_SESSION['strSender']);
		if(array_key_exists('strEmailText', $_SESSION))
			$objEmailTextArea->setValue($_SESSION['strEmailText']);
		
		// Display the form in html
		$strHTML = "<h2>Contact Us</h2>
					<p>" . $this->_strText . "</p>". 
					"<form action=\"verifyEmail.php\" method=\"POST\">
						<div class=\"outerbox\"><br/>
							Your email address:<br/>". 
								$objEmailAddressInput->toHTML() . $errorEmailAddress . "<br/>". 
							"Name:<br/>". 
								$objSenderInput->toHTML() . $errorSender . "<br/>" . 
							"Message:<br/>". 
								$objEmailTextArea->toHTML() . $errorText . "<br/>". 
							"<br/><div class=\"toright\">" . 
							$objSendEmailButton->toHTML() . 
						"</div>
					</form></div>";
							
		return $strHTML;
	}

}

?>