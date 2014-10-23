var browser = {
  versions:function(){
	var sUserAgent = navigator.userAgent.toLowerCase();
	return{
		  ipad:sUserAgent.match(/ipad/i) == "ipad", //whether ipad?
		  iphone:sUserAgent.match(/iphone os/i) == "iphone os", //whether iphone and ios?
		  midp:sUserAgent.match(/midp/i) == "midp", //whether midp
		  uc7:sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4", //whether uc7
		  uc:sUserAgent.match(/ucweb/i) == "ucweb", //whether ucweb
		  android:sUserAgent.match(/android/i) == "android", //whether android
		  bIsCE:sUserAgent.match(/windows ce/i) == "windows ce",
		  bIsWM: sUserAgent.match(/windows mobile/i) == "windows mobile", //whether mobile 
          window8:sUserAgent.match(/iemobile/i) == "iemobile" //window 8
	  };
  }()
};
var mobile = (browser.versions.ipad || browser.versions.iphone || browser.versions.midp || browser.versions.uc7 || browser.versions.uc || browser.versions.android || browser.versions.bIsCE || browser.versions.bIsWM || browser.versions.window8);
var _onloadEvent = { 
	MARK : function(object){ //获得真实的高度和宽度并且储存
		var obj = $(object);
		obj.find("*:not(img,script,link,body,br)").each(function(i){
			$(this).attr({
				"tw":$(this).width(),
				"th":$(this).height(),
				"tlh":parseInt($(this).css("lineHeight"))
			});
			if(parseInt($(this).css("paddingTop")) > 0){
				$(this).attr({
					"tPadT":parseInt($(this).css("paddingTop"))
				});	
			};
			if(parseInt($(this).css("paddingBottom")) > 0){
				$(this).attr({
					"tPadB":parseInt($(this).css("paddingBottom"))
				});	
			};
			
			if(parseInt($(this).css("top")) > 0){
				$(this).attr({
					"tTop":parseInt($(this).css("top"))
				});	
			};
			if(parseInt($(this).css("bottom")) > 0){
				$(this).attr({
					"tBottom":parseInt($(this).css("bottom"))
				});	
			};
			
			if(parseInt($(this).css("marginTop")) != 0){
				$(this).attr({
					"tMarT":parseInt($(this).css("marginTop"))
				});	
			};
			if(parseInt($(this).css("marginBottom")) != 0){
				$(this).attr({
					"tMarB":parseInt($(this).css("marginBottom"))
				});	
			};
			
			if(parseInt($(this).css("fontSize"))>=12){
				$(this).attr({
					"tFs":parseInt($(this).css("fontSize"))
				});	
			};
			if(i>=obj.find("*:not(img,script,link,body,br)").size()-1){
				$("#pc_css").attr("href",$("#pc_css").attr("mobile"));
			};
		});
	},
	AUTODOM : function(ah,alh,ap,am,afz,apo){	//执行自动化的操作1
		$(ah).each(function(){
			$(this).autoHeight();
		});
		$(alh).each(function(){
			$(this).autoLineHeight();
		});
		$(ap).each(function(){
			$(this).autoPadding();
		});
		$(am).each(function(){
			$(this).autoMargin();
		});
		$(afz).each(function(){
			$(this).autoFontSize();
		});
		$(apo).each(function(){
			$(this).autoPosition();
		});
	},
	AUTODOMLIST : function(obj){
		$(obj).each(function(){
			var curThis = $(this);
			var special = $(this).attr("class"); //获得当前特殊的class
			var specialClass = special.substring(special.indexOf("(")+1,special.indexOf(")")); //获取class样式名称并且处理
			var _parent = specialClass.substring(0,specialClass.indexOf("*")); //class的名字
			var _children = specialClass.substring(specialClass.indexOf("*")+1,specialClass.indexOf("+")); //包含的子类元素
			var _ah = specialClass.substring(specialClass.indexOf("+")).split("+"); //数组第一个是","
			
			$(this).find(_children).each(function(){
				if(_ah.indexOf("ah") != -1){
					$(this).autoHeight();
				};
				if(_ah.indexOf("alh") != -1){
					$(this).autoLineHeight();
				};
				if(_ah.indexOf("ap") != -1){
					$(this).autoPadding();
				};
				if(_ah.indexOf("am") != -1){
					$(this).autoMargin();
				};
				if(_ah.indexOf("afs") != -1){
					$(this).autoFontSize();
				};
				if(_ah.indexOf("apo") != -1){
					$(this).autoPosition();
				};
				
			});
		});
	}
};

//jquery的插件
//height auto
jQuery.fn.autoHeight = function() {
	var This = $(this);
	var thisStyle = {
		tureHeight : parseInt($(this).attr("th")),
		tureWidth : parseInt($(this).attr("tw")),
		thisWidth :$(this).width()
	};
	This.css({
		"height":thisStyle.tureHeight/(thisStyle.tureWidth/thisStyle.thisWidth)+"px"
	});
	
	
};
//line-height auto
jQuery.fn.autoLineHeight = function() {
	var thisStyle = {
		tureWidth : parseInt($(this).attr("tw")),
		tureLineHeight : parseInt($(this).attr("tlh")),
		thisWidth : $(this).width()
	};
	if(thisStyle.tureLineHeight > 22){
		$(this).css({
			"lineHeight":thisStyle.tureLineHeight/(thisStyle.tureWidth/thisStyle.thisWidth)+"px"
		});
	};
	
};

//padding top or bottom
jQuery.fn.autoPadding = function() {
	var thisStyle = {
		turePaddingTop : parseInt($(this).attr("tPadT")),
		turePaddingBottom : parseInt($(this).attr("tPadB")),
		tureWidth : parseInt($(this).attr("tw")),
		thisWidth : $(this).width()
	};
	
	if(thisStyle.turePaddingTop > 0){
		$(this).css({
			"paddingTop":thisStyle.turePaddingTop/(thisStyle.tureWidth/thisStyle.thisWidth)+"px"
		});	
	};
	if(thisStyle.turePaddingBottom > 0){
		$(this).css({
			"paddingBottom":thisStyle.turePaddingBottom/(thisStyle.tureWidth/thisStyle.thisWidth)+"px"
		});
	};
};

//margin top or bottom
jQuery.fn.autoMargin = function() {
	var thisStyle = {
		tureMarginTop : parseInt($(this).attr("tMarT")),
		tureMarginBottom : parseInt($(this).attr("tMarB")),
		tureWidth : parseInt($(this).attr("tw")),
		thisWidth : $(this).width()
	};
	$(this).css({
		"marginTop":thisStyle.tureMarginTop/(thisStyle.tureWidth/thisStyle.thisWidth)+"px"
	});
	$(this).css({
		"marginBottom":thisStyle.tureMarginBottom/(thisStyle.tureWidth/thisStyle.thisWidth)+"px"
	});
};

//position top or bottom
jQuery.fn.autoPosition = function() {
	
	var thisStyle = {
		tureTop : parseInt($(this).attr("tTop")),
		tureBottom : parseInt($(this).attr("tBottom")),
		tureWidth : parseInt($(this).attr("tw")),
		thisWidth : $(this).width()
	};
	
	$(this).css({
		"top":thisStyle.tureTop/(thisStyle.tureWidth/thisStyle.thisWidth)+"px"
	});
	/*$(this).css({
		"bottom":thisStyle.tureBottom/(thisStyle.tureWidth/thisStyle.thisWidth)+"px"
	});*/
};

//padding font size
jQuery.fn.autoFontSize = function() {
	var thisStyle = {
		tureFontSize : parseInt($(this).attr("tFs")),
		turePsWidth : parseInt($("body:eq(0)").attr("tw")), //设计稿的宽度定在了body上面
		thisWidth : $(this).width()
	};
	
	if(thisStyle.tureFontSize){ //判断字体大小如果小于12则字体大小为12
		if(thisStyle.tureFontSize/thisStyle.turePsWidth*$(window).width() < 12){
			$(this).css({
				"fontSize":12+"px"
			});
		}else{
			$(this).css({
				"fontSize":thisStyle.tureFontSize/thisStyle.turePsWidth*$(window).width()+"px"
			});
		};
		
	};
	
};

jQuery(document).ready(function () {

    if (mobile) {
        var timer = "";
        _onloadEvent.MARK("body");
        $.ajax({
            url: $("#pc_css").attr("mobile"),
            type: "GET",
            dataType: "html",
            success: function (data) {
                setTimeout(function () {
                    _onloadEvent.AUTODOM(".autoHeight", ".autoLineHeight", ".autoPadding", ".autoMargin", ".autoFontSize", ".autoPosition");
                    _onloadEvent.AUTODOMLIST(".autoList");
                    $(".loading").hide();
                    $(window).resize(function () {
                        clearTimeout(timer);
                        timer = setTimeout(function () {
                            _onloadEvent.AUTODOM(".autoHeight", ".autoLineHeight", ".autoPadding", ".autoMargin", ".autoFontSize", ".autoPosition");
                            _onloadEvent.AUTODOMLIST(".autoList");
                        }, 100);
                    });

                },1000);
                
            }
        });
    };

});
