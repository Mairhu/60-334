function updateThread(intID){
	var element = document.getElementById("active" + intID);
	
	var strSend;
	
	if(element.className == "red"){
		strSend = "activate";
		element.className = "green";
	}
	else if(element.className == "green"){
		strSend = "deactivate";
		element.className = "red";
	}
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST","../common.php", false);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("strFunction=activateThread&strActivate=" + strSend + "&intID=" + intID);
	
}