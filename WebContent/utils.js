/**
 * @author sh: -c: line 0: `echo Palotas, Michael()' (2)
 */



cookie_name = "palotas_cookie";
var visited = false;

function putCookie() {

if(document.cookie != document.cookie) 
{index = document.cookie.indexOf(cookie_name);}
else 
{ index = -1;}

if ((index == -1) && visited == false)
{
visited = true;
document.cookie=cookie_name+"="+ visited +"; expires=Monday, 04-Apr-2015 05:00:00 GMT";
//alert("just set the cookie");
}

}

	
//Get cookie routine by Shelley Powers 
function get_cookie(Name) {
  var search = Name + "="
  var returnvalue = "";
  if (document.cookie.length > 0) {
    offset = document.cookie.indexOf(search)
    // if cookie exists
    if (offset != -1) { 
      offset += search.length
      // set index of beginning of value
      end = document.cookie.indexOf(";", offset);
      // set index of end of cookie value
      if (end == -1) end = document.cookie.length;
      returnvalue=unescape(document.cookie.substring(offset, end))
      }
   }
  return returnvalue;
}



/**
 * just a function to play around with
 */
function printBrowserInformation(){
	userAgent = navigator.userAgent;
	alreadyDisplayed = "";

	//get the value of the cookie
	alreadyDisplayed = get_cookie("palotas_cookie");
	
	
	if (alreadyDisplayed.indexOf("true") == -1)
	{
		if((userAgent.indexOf("Firefox") == -1) && (userAgent.indexOf("Chrome") == -1) && (userAgent.indexOf("Safari") == -1))
		{
			alert("This site was optimized for Chrome, Firefox and Safari browsers. It is possible that other browsers may not properly display the content of this site.");
		}
	}

	
}


function setActiveTab(){
	// get all li elements
	liElements = document.getElementById('nav').getElementsByTagName('li');
	
	//check which page we are currently on
	currentPage = document.location.href;
	
	 if ("http://gridfusion.net/".indexOf(currentPage)>=0)
	 {
	 	//set HOME tab as current
	 	liElements[0].className='current';	 	
	 }
	 else{
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
	

}




