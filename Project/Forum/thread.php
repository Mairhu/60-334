<?php

include_once("../Database.class");

class thread{
	private $_objDB;
	private $_arrPost;
	private $_intThreadID;
	
	function thread($intThreadID){
		$this->_objDB = new Database("dbRestaurant");
		$this->_intThreadID = $intThreadID;
		if($intThreadID > 0){
			$this->setupPosts();
		}
	}
	
	function setupPosts(){
		$this->_arrPost = new array();
		$strSQL = "SELECT * FROM tblPost WHERE intThreadID = " . $this->_intThreadID ;
		$this->_objDB->query($strSQL);
	}
	
	function getAllThreads(){
		$strSQL = "SELECT * FROM tblThread WHERE blnActive = 1";
		
	}
	
	function toHTML(){
		if(count($_arrPost) > 0){
			
		}
		else{
			$strReturn = "<h3>Welcome to the forum!</h3>";
			$strReturn .= "<div>Current Threads:</div>";
			$strReturn .= $this->getAllThreads();
		}
	}

}

?>