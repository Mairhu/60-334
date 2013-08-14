<?php

// Page names
$arrPageNames = array( "defaultPage" => "Main",
										"aboutUs"=>"About Us",
										"menu" => "View Menu",
										"online" => "Order Online",
										"login" => "Login",
										"logout" => "Logout",
										"forum" => "Forum",
										"contactUs" => "Contact Us"
									);

									
									
// Image Constants
define("strIMAGE_HOME" ,						 "images/home.png");
define("strIMAGE_ABOUT_US" ,				 "images/aboutUs.png");
define("strIMAGE_MENU" ,						 "images/menu.png");
define("strIMAGE_LOGIN" ,				 	"images/login.png");
define("strIMAGE_LOGOUT" ,				 	"images/logout.png");
define("strIMAGE_FORUM" ,				 	"images/forum.png");
define("strIMAGE_CONTACT" ,				"images/contactUs.png");
define("strIMAGE_BKG_DEF" ,				"images/default.png");
define("strIMAGE_BKG_1" ,					"images/bkg1.png");
define("strIMAGE_BKG_2" ,					"images/bkg2.png");
define("strIMAGE_BKG_3" ,					"images/bkg3.png");

// Pages available to logged in users
$arrLoginPages = array(strIMAGE_HOME=>null,
									strIMAGE_ABOUT_US => "aboutUs",
									strIMAGE_MENU => "menu",
									strIMAGE_FORUM => "forum",
									strIMAGE_CONTACT => "contactUs",
									strIMAGE_LOGOUT => "logout"
									);

// Pages available to guest users
$arrGuestPages = array(strIMAGE_HOME=>null,
									strIMAGE_ABOUT_US => "aboutUs",
									strIMAGE_MENU => "menu",
									strIMAGE_CONTACT => "contactUs",
									strIMAGE_LOGIN => "login"
									);

// Pages available to admin users
$arrAdminPages = array(1 => "Modify Menu",
									2 => "Modify Threads");


?>