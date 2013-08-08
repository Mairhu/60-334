<?php
/* This is the file that contains the demo for the form elements
generated by php. 

This file was created by Ping S. Yong on 06/08/13.
*/
include_once("formElement.class");
include_once("Database.class");

echo "<!DOCTYPE html>
<html>
<head><title>Test</title></head>
<body>";

$objInput = new Input("strName", "strNameID");
$objInput->setClass("troubleshoot");
$objInput->setValue("Hi I'm an input field");
echo "input: " . $objInput->toHTML() . "<br/>";

$objTextArea = new textArea("strText","strTextID");
$objTextArea->setClass("troubleshootp");
$objTextArea->setValue("Hi I'm a text field");
echo "text:" . $objTextArea->toHTML() . "<br/>";


$objDropDown = new dropDown("strOrder", "strOrderID");
$objDropDown->setClass("troubleshoot"); 
$objDropDown->setOptions(array("1","2","3"));
echo "dd1:" . $objDropDown->toHTML() . "<br/>";

$objDropDown2 = new dropDown("strOrder2", "strOrderID2");
$objDropDown2->setClass("troubleshootp"); 
$objDropDown2->setOptions(array("1"=>"a","2"=>"b","3"=>"c"));
echo "dd2:" . $objDropDown2->toHTML() . "<br/>";

//checkbox Set

$objCheckbox1 = new checkbox("strColour", "strBlue");
$objCheckbox2 = new checkbox("strColour", "strRed", true);
$objCheckbox3 = new checkbox("strColour", "strYellow");

$objCheckbox1->setValue("Blue");
$objCheckbox2->setValue("Red");
$objCheckbox3->setValue("Yellow");

echo "blue:" . $objCheckbox1->toHTML() . "<br/>";
echo "red:" . $objCheckbox2->toHTML() . "<br/>";
echo "yellow:" . $objCheckbox3->toHTML() . "<br/>";

//radiobutton set

$objRadio1 = new radio("strGender", "strFemale", true);
$objRadio2 = new radio("strGender", "strMale");

$objRadio1->setValue = "female";
$objRadio2->setValue = "male";

echo "female:" . $objRadio1->toHTML() . "<br/>";
echo "male:" . $objRadio2->toHTML() . "<br/>";

echo "<form>";
$objButton = new Button("strButton", "strButtonID");
$objButton->setValue("To Main");
$objButton->setAction("main.php");
echo $objButton->toHTML() . "<br/>";

echo "</form></body></html>";
$objDB = new Database("dbRestaurant");

?>