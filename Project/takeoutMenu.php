<?php

require_once("Database.class");
require_once("common.php");
require_once("constants.php");

session_start();

$arrCategory = getMenuCategories();

$objDB = new Database("dbRestaurant");

$strSQL = "SELECT * 
					FROM tblMenuItem 
					LEFT JOIN tblMenuCategory
						USING(intMenuCategoryID)
					ORDER BY intMenuCategoryID, intMenuNumber";

$rsResult = $objDB->query($strSQL);

$arrRow = $objDB->fetch_row($rsResult);
$intCurrentCategory = $arrRow["intMenuCategoryID"];

$strHTML = "<div id=\"" . $intCurrentCategory . "\">" . $arrCategory[$intCurrentCategory] . "<table>";
$intCount = 0;
while($arrRow){

	if($intCurrentCategory != $arrRow["intMenuCategoryID"]){
		$intCurrentCategory = $arrRow["intMenuCategoryID"];
		$strHTML .= "</table></div><div id=\"" . $intCurrentCategory . "\"><h3>" 
							. $arrCategory[$intCurrentCategory] . "</h3><table>";
	}
	$strHTML .= "<tr class=\"bg" . $intCount%2 . "\">
								<td>" . $arrRow["intMenuNumber"] . "</td>
								<td>" . $arrRow["txtMenuItemName"] . "</td>
								<td>" . $arrRow["txtDescription"] . "</td>
								<td>" . ($arrRow["blnSpicy"] ? "Spicy" : "") . "</td>
							   <td>Input Field</td>
						</tr>";
	$arrRow = $objDB->fetch_row($rsResult);
}

$strHTML .= "</table></div>";

?>

<html>
	<head>
		<title>Tantalizing Asian Cuisine - Order Online</title>
		<script>
			
		</script>
	</head>
	<body>
		<h2>Menu</h2>
		<?=$strHTML?>
	</body>
</html>