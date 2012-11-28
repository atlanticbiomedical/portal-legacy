function getPageScroll(){

	var xScroll, yScroll;

	if (self.pageYOffset) {
		yScroll = self.pageYOffset;
		xScroll = self.pageXOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
		yScroll = document.documentElement.scrollTop;
		xScroll = document.documentElement.scrollLeft;
	} else if (document.body) {// all other Explorers
		yScroll = document.body.scrollTop;
		xScroll = document.body.scrollLeft;	
	}

	arrayPageScroll = new Array(xScroll,yScroll) 
	return arrayPageScroll;
}

function getPageSize(){
	
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = window.innerWidth + window.scrollMaxX;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	
//	console.log(self.innerWidth);
//	console.log(document.documentElement.clientWidth);

	if (self.innerHeight) {	// all except Explorer
		if(document.documentElement.clientWidth){
			windowWidth = document.documentElement.clientWidth; 
		} else {
			windowWidth = self.innerWidth;
		}
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

//	console.log("xScroll " + xScroll)
//	console.log("windowWidth " + windowWidth)

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = xScroll;		
	} else {
		pageWidth = windowWidth;
	}
//	console.log("pageWidth " + pageWidth)

	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
	return arrayPageSize;
}

function getScrollCenter()
{
	scroll_info = getPageScroll();
	page_info = getPageSize();

	viewable_width = page_info[2];
	viewable_height = page_info[3];

	scroll_x = scroll_info[0];
	scroll_y = scroll_info[1];

	x_center = (scroll_x + (viewable_width/2))-(220/2);
	y_center = (scroll_y + (viewable_height/2))-(140/2);
	
	return [x_center, y_center];

}

function show_popup2(ev ,id, name, popup_div){

	var innerVal =
        "Are you sure you want to send today's schedule to <span id ='tech_name_span'>[tech name]</span>?<br/><br/>"+
"<input type = 'hidden' id = 'hidden_tech_id' value='' />"+
"<input type = 'hidden' id = 'hidden_tech_name' value='' />"+

"Comments:<br/><textarea id='emailComment' style='width:210px;height:60px;margin-bottom:4px;'></textarea>"+
"<input class='emailButton' style='margin-left:18px;' type='submit' value='Send Email' onclick='sendTechEmail();'/> "+
"<input class='emailButton' type='button' value='cancel' onclick='Element.hide(\"emailPopUp\")'>";

	if(ev!=null)
		var e = ev;
	else //for ie
		var e = event;
	
	thePos = getScrollCenter();
	var x = thePos[0];
	var y = thePos[1];
    
        $('emailPopUp').innerHTML = innerVal;
        $('tech_name_span').innerHTML = name;
        $('hidden_tech_name').value = name;
        $('hidden_tech_id').value = id;
	positionAndShowPopUp(x,y,100,popup_div);

}

function sendTechEmail(){

        name= $('hidden_tech_name').value;
        id = $('hidden_tech_id').value;
        var comment = $('emailComment').value;
        theSelectedDate = $('date').value;
        new Ajax.Updater(
        "emailPopUp",
        "/index.php/scheduler/sendEmail?comment="+comment+"&tech_id="+id+"&date="+theSelectedDate,
        {
           method: "GET",
           evalScripts: false,
           onComplete: function(){
              
           }
        }
        );
}

function positionAndShowPopUp(x,y,width,popup_div)
{
	var a = document.getElementById(popup_div);
	a.style.position = "absolute";
	a.style.left = x + 'px';
	a.style.top = y + 'px';
	a.style.display = "block";
}
