// Some simple KeyEvents Here, hehe~

var boring1 = new Array();
var boringc = 0;

function keyDown(e){
    var theEvent = window.event || e;
    var nn = theEvent.keyCode || theEvent.which;
    if(nn==75){//Key_K
        roll(0);
    }else if(nn==74){//Key_J
        roll(1);
    }else if(nn>=49 && nn<=57){
        jumpTo(nn - 48);
    }else if(nn == 48){
        jumpTo(10);
    }else if(nn == 85){
        jumpTo(11);
    }else if(nn == 78){
        jumpNext(1);
    }else if(nn == 77){
        jumpNext(-1);
    }
    boringc++;
    boring1.push(nn);
    if(boringc>6) boring1.shift(); 
    var summy = 0;
    if(boringc>5) 
    for(var w=0;w<6;w++){
        summy += boring1[w];
    }
    if(summy == 10){ 
        alert("123");
    }
}
document.onkeydown = keyDown;

function roll(d){
  if(d==0)
    window.scrollBy(0,-60);
  else if(d==1)
    window.scrollBy(0,60);
}

function jumpTo(n){
    for(var i=1;i<=11;i++){
        document.getElementById(i).className = 'tab-pane';
        document.getElementById('li'+i).className = '';
    }
    document.getElementById(n).className = 'tab-pane active';
    document.getElementById('li'+n).className = 'active';
}

function jumpNext(u){
    for(var j=1;j<=11;j++){
        if(document.getElementById("li"+j).className == 'active'){
            if(u==1){
                if(j==11)jumpTo(1);
                else jumpTo(j+1);
            }else{
                if(j==1)jumpTo(11);
                else jumpTo(j-1);
            }

            break;
        }
    }
}
