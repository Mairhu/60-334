<?php

/*Database Constants*/

define("strDatabase", 		"dbRestaurant");

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
define("strIMAGE_ONLINE" ,				 	"images/orderOnline.png");
define("strIMAGE_LOGIN" ,				 	"images/login.png");
define("strIMAGE_LOGOUT" ,				 	"images/logout.png");
define("strIMAGE_FORUM" ,				 	"images/forum.png");
define("strIMAGE_CONTACT" ,				"images/contactUs.png");

$arrLoginPages = array(strIMAGE_HOME=>null,
									strIMAGE_ABOUT_US => "aboutUs",
									strIMAGE_MENU => "menu",
									strIMAGE_ONLINE => "online",
									strIMAGE_FORUM => "forum",
									strIMAGE_CONTACT => "contactUs",
									strIMAGE_LOGOUT => "logout"
									);

$arrGuestPages = array(strIMAGE_HOME=>null,
									strIMAGE_ABOUT_US => "aboutUs",
									strIMAGE_MENU => "menu",
									strIMAGE_ONLINE => "online",
									strIMAGE_LOGIN => "login",
									strIMAGE_CONTACT => "contactUs"
									);


?>