// JavaScript Document
function check()
{
  var chosensub = document.getElementById("subject").value;
  if(chosensub == 'none')
    {
      alert("明洋说：未选择正确科目！！");
      return false;
    }
    else
      return true;
}

function getScrollTop(){
  return document.documentElement.scrollTop+document.body.scrollTop;
}


function goTopEx(){
  var obj=document.getElementById("gotopbtn");
  var menu=document.getElementById("li1");
  // var mainmenu =document.getElementById('mainmenu');
  function setScrollTop(value){
    document.documentElement.scrollTop=value;
    document.body.scrollTop=value;
  }    
  window.onscroll=function(){
    /*
       if(getScrollTop()>183)
       {  mainmenu.style.position="fixed";
       mainmenu.style.top="24px";
       }
       else 
       mainmenu.style.position="";
       */

    getScrollTop()>0?obj.style.display="":obj.style.display="none";
  }
  obj.onclick=function(){
    var goTop=setInterval(scrollMove,10);
    function scrollMove(){
      setScrollTop(getScrollTop()/1.1);
      if(getScrollTop()<1)clearInterval(goTop);
    }
  }
  /*
     mainmenu.onClick = function(){
     var goTop=setInterval(scrollMove,10);
     function scrollMove(){
     setScrollTop(getScrollTop()/1.1);
     if(getScrollTop()<1)clearInterval(goTop);
     }
     }
     */


}

function setTime(){
  var tH = document.getElementById("tH").innerHTML;
  var ti = document.getElementById("ti").innerHTML;
  var ts = document.getElementById("ts").innerHTML;
  var arr = new Array(parseInt(tH),parseInt(ti),parseInt(ts));
  arr[2]++;
  if(arr[2]==60){
    arr[2]=0;arr[1]++;
  }
  if(arr[1]==60){
    arr[1]=0;arr[0]++;
  }
  if(arr[0]==24){
    arr[0]=0;
  }

  var xh = String(arr[0]);
  var xi = String(arr[1]);
  var xs = String(arr[2]);

  if(arr[0]<10)xh=0+xh;
  if(arr[1]<10)xi=0+xi;
  if(arr[2]<10)xs=0+xs;
  document.getElementById("tH").innerHTML = xh;
  document.getElementById("ti").innerHTML = xi;

  if(arr[1]==59)
    document.getElementById("ts").innerHTML = "hehe不告诉你";
  else
    document.getElementById("ts").innerHTML = xs;

  setTimeout(setTime,1000);
}
