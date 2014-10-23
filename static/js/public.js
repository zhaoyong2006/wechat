Array.max = function(arr){
	return Math.max.apply(Math,arr);
};
Array.min = function(arr){
	return Math.min.apply(Math,arr);
};

var oldweb = function(){
	var htmlDom = ["article","aside","details","figcaption","figure","footer","header","hgroup","menu","nav","section"];
	for(var i=0; i<htmlDom.length; i++){
		document.createElement(htmlDom[i]);
	};
};

function loadings(loadobj){
	$(loadobj).css({"height":$(window).height()+"px"});
	$(window).resize(function(){
		$(loadobj).css({"height":$(window).height()+"px"});	
	});
};


//dom ready complete
function addLoadEvent(func){
  var oldonload = window.onload;
  if(typeof window.onload != "function"){
    window.onload = func;
  }else{
    window.onload = function(){
      oldonload();
      func();
    };
  };
};



//css none
jQuery(document).ready(function(){
	//loadings(".loading");
	$(".anima_video_box ul li:nth-child(4n)").addClass("pad_r_n");
});


