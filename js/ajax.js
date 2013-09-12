var pre ="index";
function HttpRequest(url){
	document.getElementById(pre).className="nav-li";
var pageRequest = false; //variable to hold ajax object
/*@cc_on
   @if (@_jscript_version >= 5)
      try {
      pageRequest = new ActiveXObject("Msxml2.XMLHTTP")
      }
      catch (e){
         try {
         pageRequest = new ActiveXObject("Microsoft.XMLHTTP")
         }
         catch (e2){
         pageRequest = false
         }
      }
   @end
@*/

if (!pageRequest && typeof XMLHttpRequest != 'undefined')
   pageRequest = new XMLHttpRequest();
	
	
	pageRequest.onreadystatechange = function()
	{ //if pageRequest is not false

   		if ( pageRequest.readyState == 4 && pageRequest.status==200)
		{
   				document.getElementById('more').innerHTML=pageRequest.responseText;
		}

   }
   pageRequest.open('GET', url, false) //get page synchronously 
   	pageRequest.send();
	pre ='upload';
  document.getElementById(pre).className="active ";
}
function loadXML(url,subject)
{
  
  document.getElementById(pre).className="nav-li";
  var xmlhttp;
  var out;
  var x,i;
  xmlhttp =null;
  if(window.XMLHttpRequest)
    {
      xmlhttp =new XMLHttpRequest();
    }
  else if(window.ActiveXObject)
	{
	  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
  else
	{
	  alert("抱歉，您的浏览器太高级了不支持xmlhttp");
	}
  xmlhttp.onreadystatechange =function()
  {
	if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
	  {
		document.getElementById('more').innerHTML=xmlhttp.responseText;
	  }
  }

  xmlhttp.open("GET",url+"?s="+subject+"&time="+Math.random()*1234,true);
  xmlhttp.send();
  pre =subject;
  document.getElementById(pre).className="active ";
}
function loadComment(url)
{
  var xmlhttp;
  var out;
  var x,i;
  xmlhttp =new XMLHttpRequest();
  xmlhttp.onreadystatechange =function()
  {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById('fileinfo').innerHTML=xmlhttp.responseText;
      }
  }

  xmlhttp.open("GET",url+"&time="+Math.random()*1234,true);
  xmlhttp.send();
}
function loadInfo(url)
{
  var xmlhttp;
  var out;
  var x,i;
  xmlhttp =new XMLHttpRequest();
  xmlhttp.onreadystatechange =function()
  {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById('moreinfo').innerHTML=xmlhttp.responseText;
      }
      else
        document.getElementById('moreinfo').innerHTML='<img src="img/load.gif"><img src="img/load.gif"><img src="img/load.gif"><span>其实在校园网这么快你根本不会看到加载图片=.=,看到了有奖！！</span>';
  }

  xmlhttp.open("GET",url+"&time="+Math.random()*1234,true);
  xmlhttp.send();
}

function readMessage(time)
{
  var xmlhttp;
  var out;
  var x,i;
  xmlhttp =new XMLHttpRequest();
  xmlhttp.onreadystatechange =function()
  {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById(time).innerHTML=xmlhttp.responseText;
      }
  }

  xmlhttp.open("GET","../ajax/messageRead.php?time="+time,true);
  xmlhttp.send();
}


