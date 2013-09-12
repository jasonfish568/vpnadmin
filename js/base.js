// JavaScript Document
		function onClickBack(){
			window.location.href="index.html";
		}
        
  		function g(o){return document.getElementById(o);}
		function mouseOn(n){
			//如果有N个标签,就将i<=N;
			for(var i=1;i<=5;i++){
				g('m'+i).className='unover list';
			}
			g('m'+n).className='onover list';
        }
 

