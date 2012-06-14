/**
 * @author sh: -c: line 0: `echo Palotas, Michael()' (2)
 */

/**
 * this function sets the active navigation tab by checking
 * if the object array contains parts of the current URL
 */

/*
function setActive() {
  aObj = document.getElementById('nav').getElementsByTagName('li');
  for(i=0;i<aObj.length;i++) {
    if(document.location.href.indexOf(aObj[i].firstChild)>=0) {
    	//alert("setActive MATCH");
      aObj[i].className='current';
    }
  }
}
*/


function setActiveTab(){
	// get all li elements
	liElements = document.getElementById('nav').getElementsByTagName('li');
	
	//check which page we are currently on
	currentPage = document.location.href;
	 //loop through liElements. Once the current page location matches aElement.href
	 //set that li element as current
	 for(i=0; i<liElements.length; i++) {
	 	firstChild = liElements[i].firstChild;
	 	if(firstChild.href.indexOf(currentPage) >= 0){
	 		//alert("match found!");
	 		liElements[i].className='current';
	 	}
	 } 
	
}



/**
 * just a function to play around with
 */
function printBrowserInformation(){
	alert("Browser: " + navigator.appCodeName);
	
}

