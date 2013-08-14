<?php
// Takeout Menu page

include_once("formElement.class");
require_once("Database.class");
require_once("common.php");
require_once("constants.php");

session_start();

// Retrieve array of catagories
$arrCategory = getMenuCategories();

// Initialize database
$objDB = new Database("dbRestaurant");

// Retrieve menu items from database
$strSQL = "SELECT * 
					FROM tblMenuItem 
					LEFT JOIN tblMenuCategory
						USING(intMenuCategoryID)
					ORDER BY intMenuCategoryID, intMenuNumber";

$rsResult = $objDB->query($strSQL);

$arrRow = $objDB->fetch_row($rsResult);
$intCurrentCategory = $arrRow["intMenuCategoryID"];

// Create HTML for page
$strHTML = "<form action=\"verifyOrder.php\" method=\"POST\"><div id=\"" . $intCurrentCategory . "\">" . $arrCategory[$intCurrentCategory] . "<table>";
$intCount = 0;
$intItems = 0;

// Submit order button
$objButton = new Button("strSubmitOrder", "strSubmitOrderID");
$objButton->setMethod("POST");
$objButton->setValue("Order");
$objButton->setAction("verifyOrder.php");

while($arrRow){

	// Cycle through each menu item in the database and add to html table
	if($intCurrentCategory != $arrRow["intMenuCategoryID"]){
		$intCurrentCategory = $arrRow["intMenuCategoryID"];
		$strHTML .= "</table></div><div id=\"" . $intCurrentCategory . "\"><h3>" 
							. $arrCategory[$intCurrentCategory] . "</h3><table>";
	}
	
	// Create the order input box
	$objInputOrder = new Input("strOrder".$intItems, "strOrderID");
	//$objInputOrder->setClass("box");
	$objInputOrder->setValue(0);
	$objInputOrder->setAttribute("maxlength", 3);
	
	// Initialize any error messages
	$errorOrder = get_error_message('strOrder'.$intItems.'.err');
	
	if(array_key_exists('strOrder'.$intItems, $_SESSION))
		$objInputOrder->setValue($_SESSION['strOrder'.$intItems]);
	
	// Create columns for table
	$strHTML .= "<tr class=\"bg" . $intCount%2 . "\">
								<td class=\"cellColumn\">" . $arrRow["intMenuNumber"] . "</td>
								<td class=\"cellColumn\">" . $arrRow["txtMenuItemName"] . "</td>
								<td class=\"cellColumn\">" . $arrRow["txtDescription"] . "</td>
								<td class=\"cellColumn\">" . ($arrRow["blnSpicy"] ? "Spicy" : "") . "</td>
								<td class=\"cellColumn\">$" . number_format($arrRow["dblPrice"],2) . "</td>
							   <td>". $objInputOrder->toHTML() . $errorOrder ."</td>
						</tr>";
	$arrRow = $objDB->fetch_row($rsResult);
	$intItems++;
}

$strHTML .= "</table>" . $objButton->toHTML() . "</div></form>";
$_SESSION['intItems'] = $intItems;

?>
<!-- HTML code for page-->
<html>
	<head>
		<title>Tantalizing Asian Cuisine - Order Online</title>
		<link rel="stylesheet" type="text/css" href="common.css"/>
	</head>
	<body class='bgOverride'>
		<h2>Menu</h2>
		<?=$strHTML?>
	</body>
</html>