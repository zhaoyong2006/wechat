var includeDocument = {
    animaVideoEvent: function () { //弹出放出视频
        var oLi = $(".anima_video_box ul li .imgWrap img");
        var videoBox = $(".anima_video_iframe_href");
        var oMask = $(".pub_oMask");
        var bodyWidth = parseInt($("body").attr("tw"));
        var timer = "";
        oLi.live("click", function () {
            var oVideoHref = $(this).attr("videosrc");
            oMask.show();
            videoBox.show();
            videoBox.css({
                "width": (videoBox.width() / bodyWidth * $(window).width()) + "px",
                "height": (videoBox.height() / bodyWidth * $(window).height()) + "px"
            }).css({
                "left": ($(window).width() - videoBox.width()) / 2 + "px",
                "top": ($(window).height() - videoBox.height()) / 2 + "px"
            });
            oMask.css({
                "width": $(window).width() + "px",
                "height": $(document).height() + "px"
            });
            videoBox.find("iframe").attr("src", oVideoHref);
        });
        oMask.click(function () {
            videoBox.attr("style", "");
            videoBox.find("iframe").attr("src", "");
            oMask.hide();
            videoBox.hide();
        });

        $(window).resize(function () {
            if (videoBox.is(":visible")) {
                videoBox.attr("style", "");
                videoBox.show();
                videoBox.css({
                    "width": (videoBox.width() / bodyWidth * $(window).width()) + "px",
                    "height": (videoBox.height() / bodyWidth * $(window).height()) + "px"
                }).css({
                    "left": ($(window).width() - videoBox.width()) / 2 + "px",
                    "top": ($(window).height() - videoBox.height()) / 2 + "px"
                });
                oMask.css({
                    "width": $(window).width() + "px",
                    "height": $(document).height() + "px"
                });
            };
        });

    },
    animaSlideEvent: function (oClickDom, obj) { //点击下拉出盒子
        var oClick = $(oClickDom);
        var oSlide = $(obj);
        oClick.click(function () {
            var This = $(this);
            if (This.next(oSlide).is(":hidden")) {
                
                This.find(".sort_title_font").addClass("sort_title_font_current").parents(".public_border_style").siblings(".public_border_style").find(".public_sort_title_box .sort_title_font").removeClass("sort_title_font_current");
                This.next(oSlide).slideDown(300).parent().siblings(".public_border_style").find(oSlide).slideUp(300);
                This.next(".raiders_sort_box").find(".sort_title_font").autoHeight();
                This.next(".raiders_sort_box").find(".sort_title_font").autoLineHeight();
                This.next(".raiders_sort_box").find(".sort_title_font").autoFontSize();
            } else {
                This.next(oSlide).slideUp(300);
                This.find(".sort_title_font").removeClass("sort_title_font_current");
            };

        });
    },
    viewImages: function () {
        var timer = "";
        var view = function () {
            timer = setTimeout(function () {
                if (mobile) {
                    $(".raiders_imgNew").css({
                        "paddingTop": 24 / 640 * $(window).width() + "px",
                        "height": 40 / 640 * $(window).width() + "px"
                    });
                };
            }, 100);
        };
        view();
        $(window).resize(function () {
            clearTimeout(timer);
            view();
        });
    },
    viewInfors_p: function () {
        if (mobile) {
            setTimeout(function () {
                $(".card_content_infors .fl p").css({
                    "fontSize": parseInt($(".card_content_infors .fl").css("fontSize")) / 640 * $(window).width() + "px"
                });
            }, 1000);
            $(window).resize(function () {
                setTimeout(function () {
                    $(".card_content_infors .fl p").css({
                        "fontSize": parseInt($(".card_content_infors .fl").css("fontSize")) / 640 * $(window).width() + "px"
                    });
                }, 500);
            });
        };
    }
};

addLoadEvent(function () {
    includeDocument.animaVideoEvent(); //弹出放出视频
    includeDocument.animaSlideEvent(".public_sort_title_boxVideo", ".anima_video_box"); //点击下拉出盒
    includeDocument.animaSlideEvent(".public_sort_title_boxList", ".raiders_sort_box"); //点击下拉出盒子
    includeDocument.viewImages(); //new图
    if(!mobile){
        $(".loading").hide();
    };
});