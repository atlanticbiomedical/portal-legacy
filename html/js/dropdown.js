function handleKey(e)
{
    keycode = event.keyCode;
    ele = event.srcElement;
    //alert(keycode);
    if(ele != null) {
				if(keycode == 8 || keycode == 127) // backspace
				{
					if(isNaN(ele.insertIndex) || ele.insertIndex == -1) {
						ele.enteredText = ele.enteredText.substring(0,ele.enteredText.length-1);
						ele.insertIndex = -1;
					}
					else{
						ele.enteredText = ele.enteredText.substr(0,ele.insertIndex-1) + ele.enteredText.substr(ele.insertIndex);
						if(ele.insertIndex > 0 ) {
							ele.insertIndex = ele.insertIndex - 1;
						}
					}
					resetTime(ele);
					event.cancelbubble=true;
					setSelected();
					return false;
				}
				else if(keycode == 46){  // delete
					if(event.shiftKey) {
						ele.enteredText = "";
						ele.selectedIndex=0;
						ele.insertIndex = -1;
					}
					else {
						ele.enteredText = ele.enteredText.substr(0,ele.insertIndex) + ele.enteredText.substr(ele.insertIndex+1);
					}
					resetTime(ele);
					setSelected();
				}
				else if(keycode == 37){ // left arrow
					 if(isNaN(ele.insertIndex) || ele.insertIndex == -1) {
						ele.insertIndex = ele.enteredText.length-1;
					 }
					 else {
						if(ele.insertIndex > 0 ) {
							ele.insertIndex = ele.insertIndex - 1;
						}
					 }
					 resetTime(ele);
					 setSelected();
				}
				else if(keycode == 39){ // right arrow
					 if(isNaN(ele.insertIndex) || ele.insertIndex == -1) {
						ele.insertIndex = ele.enteredText.length;
					 }
					 else {
						if(ele.insertIndex < ele.enteredText.length) {
							ele.insertIndex = ele.insertIndex + 1;
						}
					 }
					 resetTime(ele);
					 setSelected();
				}
				else if(keycode == 9 || keycode == 39 || keycode == 40){ // tab,up and down arrow
					event.cancelbubble=false;
					ele.enteredText = "";
					ele.insertIndex = -1;
					return true;
				}

	}
	return true;
}
function resetTime(ele){
		var curTime = new Date();
		var t = curTime.getTime() -  ele.lastEntered;
		ele.lastEntered = curTime;
		window.status= ":Search Text=" + ele.enteredText +  ":Selected Index=" + ele.selectedIndex + ":Current position=" + ele.insertIndex;
}
function setSelected(){
	ele = event.srcElement;
	if (ele != null)
	{ // detect if element exists
		enteredText = ele.enteredText.toLowerCase();
		var selectIndex = -1;
		var selectLength = 20000;
		for(k=0; k < ele.children.length;k++){
		  txt = ele.children[k].text.toLowerCase()
		  if( txt.indexOf(enteredText) == 0) {
			if(txt == enteredText){
		  	   selectIndex =k;
		  	   break;
		  	}
		  	var len = txt.length;
		  	if(selectLength > len) {
		  		selectLength = len;
		  		selectIndex = k;
		  	}
		  }
		}
		if(selectIndex > -1) {
		   ele.selectedIndex=selectIndex;
		   window.status= ":Search Text=" + ele.enteredText +  ":Selected Index=" + ele.selectedIndex + ":Current position=" + ele.insertIndex;
		   return false;
		}
	} // end if
	return false;
}
function selectItem(txtField,tier2){
	ele = event.srcElement;
	if(isNaN(ele.insertIndex)) {
	  ele.insertIndex = -1;
	}
	if(ele.insertIndex > -1) {
		ele.enteredText = ele.enteredText.substr(0,ele.insertIndex) +  String.fromCharCode(event.keyCode) + ele.enteredText.substr(ele.insertIndex);
		ele.insertIndex = ele.insertIndex +1;
	}
	else {
		if(ele.enteredText == "") {
			ele.lastEntered = new Date();
		}
		else {
		  var curTime = new Date();
		  var t = curTime.getTime() -  ele.lastEntered;
		  ele.lastEntered = curTime;
		  if(t > 2000) {
	          ele.enteredText = "";
 		  }
		}
		ele.enteredText = ele.enteredText + String.fromCharCode(event.keyCode);
	}
	event.cancelBubble=true;
	window.status= ":Search Text=" + ele.enteredText +  ":Selected Index=" + ele.selectedIndex + ":Current position=" + ele.insertIndex;
	return setSelected();
}

