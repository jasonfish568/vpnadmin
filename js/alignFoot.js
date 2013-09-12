// JavaScript Document
// 页面底部对齐，menu 和 content 的 id 必须同上	
	
	var mh = document.getElementById("content");
	var sh = document.getElementById("menu"); 
	var leastH = 520;
	if(sh.clientHeight < leastH){
		sh.style.height = leastH + "px";
	}
	if(mh.clientHeight < sh.clientHeight){ 
		mh.style.height = sh .clientHeight + "px";
	}else{ 
		sh.style.height = mh.clientHeight + "px";
	}