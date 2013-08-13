function changeBackground(strID){
	if(strID == "default"){
			strImage = "images/back.png"
	}
	else if(strID == "1"){
			strImage = "LeafTexture.svg"
	}
	else if(strID == "2"){
			strImage = "combPattern.svg"
	}
	else{
		strImage = "";
	}
	
	var body = document.getElementsByTagName('body')[0];
	
	if(strImage){
		body.style.backgroundImage = 'url(' + strImage + ')';
	}
}
