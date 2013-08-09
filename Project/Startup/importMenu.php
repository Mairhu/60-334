<?php
include_once("../Database.class");

$file = fopen("menu.csv", 'r');

$arrHeading = fgetcsv($file);
$objDB = new Database("dbRestaurant");

$arrCategory = array();

	$strMenuSQL = "INSERT INTO tblMenuItem 
							(intMenuNumber, 
							txtMenuItemName, 
							txtDescription, 
							intMenuCategoryID,
							dblPrice, 
							strSize, 
							blnSpicy)
							VALUES ";
	$strConnector = "";
while($arrRow = fgetcsv($file)){
	$arrQuery = array_combine($arrHeading, $arrRow);
	
	if(!(in_array($arrQuery["strCategory"], $arrCategory))){
		$arrCategory[] = $arrQuery["strCategory"];
		$intCategory = count($arrCategory);
		
		$strInsertCategory = "INSERT INTO tblMenuCategory SET strMenuCategoryName = " . $objDB->sanitize($arrQuery["strCategory"]);

		$objDB->query($strInsertCategory);

	}
	
	$strMenuSQL .= $strConnector . "(" . 
														$objDB->sanitize($arrQuery["intMenuNumber"]) . ", " .
														$objDB->sanitize($arrQuery["txtMenuItemName"]) . ", " .
														$objDB->sanitize($arrQuery["txtDescription"]) . ", " .
														$objDB->sanitize($intCategory) . ", " .
														$objDB->sanitize($arrQuery["dblPrice"]) . ", " .
														$objDB->sanitize($arrQuery["strSize"]) . ", " .
														($arrQuery["blnSpicy"] ? 1 : 0) . 
													")";
	$strConnector = ", ";

}


if(! $objDB->query($strMenuSQL)){
	echo $objDB->displayError();
}
// echo $strMenuSQL . "<br/><br/>";

echo "Script Complete";
?>