function show_message(code, message){
	if (message == '') {
		return false;
	};
	$('#message-alert').html("<strong>"+message+"</strong>");
	if (code == 400) {
		$('#message-alert').removeClass("alert-success");
		$('#message-alert').addClass("alert-danger");
	}else if (code == 200) {
		$('#message-alert').removeClass("alert-danger");
		$('#message-alert').addClass("alert-success");
	};
	$('#message-container').slideDown();
	setTimeout(hide_message, 3000);
}

function hide_message(){
	$('#message-container').slideUp();
}

//submit form
$(function () {

	$("#btn_submit").click(function(){

		var _this = $(this);
		//$('#submit_verify').val("0");
		//$(".alert").slideUp();
		$(".modal-content .alert").removeClass("alert-danger");
		var options = { 
			beforeSubmit:  function showRequest() {
				_this.addClass("disabled");
			},
			success:function showResponse(data)  {

				$(".modal-content .alert").slideDown();
				$(".modal-content .alert").children("p").html(data.message);
				if(data.code == '200'){
					$(".modal-content .alert").addClass("alert-success");
					$(".modal-content .alert").children("h4").html("Success!");
					setTimeout("$('.modal').modal('hide');",1000);
					setTimeout("location.reload();",1300);
					return true;
				}else if (data.code == '300') {
					$(".modal-content .alert").addClass("alert-danger");
					$(".modal-content .alert").children("h4").html("Notice!");
					$('#submit_verify').val("1");
					_this.removeClass("disabled");
					return false;
				}else{
					$(".modal-content .alert").addClass("alert-danger");
					$(".modal-content .alert").children("h4").html("Error!");
					setTimeout("$('.modal-content .alert').slideUp();",1000);
					_this.removeClass("disabled");
					return false;
				}
			},
			type:      'post',
			dataType:  'json',
			timeout:   30000 
		};

		$('#myForm').ajaxSubmit(options);
		return false;
	});

	$("#btn_back").click(function(){
		history.back();
	});

	//input user
	if ('undefined' == typeof($.fn.tokenInput)) {

	}else{
		$("#inputUser").tokenInput("/address/ajax_search_name", {
			prePopulate: [
				//{id: 11, name: "Slurms"},
				//{id: 12, name: "address"},
				//{id: 13, name: "back"}
			],
			onAdd: function (item) {
				//alert("Added " + item.name);
			},
			onDelete: function (item) {
				//alert("Deleted " + item.name);
			}
		});
	}

});

//set cookie
function setCookie(c_name, value, expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie=c_name+ "=" + escape(value) + ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())+";path=/";
}
//read cookie
function getCookie(c_name){
    if (document.cookie.length>0){
        c_start=document.cookie.indexOf(c_name + "=")
        if (c_start!=-1){
            c_start=c_start + c_name.length+1
            c_end=document.cookie.indexOf(";",c_start)
            if (c_end==-1) c_end=document.cookie.length
            return unescape(document.cookie.substring(c_start,c_end))
        }
    }
    return ""
}
//remove attributes "disabled"

$('.rm-disable').removeAttr('disabled');
$('#logo').mouseover(function(){
    $(this).css('cursor','pointer');
});
$('#logo').click(function(){
    location.href='/';
});
