@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone.min.js"></script> --}}
<link rel="stylesheet" href="{{ asset('assets/css/emojionearea.min.css') }}">
<script src="{{ asset('assets/js/emojionearea.min.js') }}" type="text/javascript"></script>
<style type="text/css">
	.chat_img.online::after {
	    background: #0ee60e;
	}
</style>
<script type="text/javascript">
@php 
	$a = request()->input('a');
	$chat_id = request()->input('chat_id');
	if($chat_id){}else{$chat_id=0;}
	$_pic = request()->input('pic');
	if($_pic){}else{$_pic='';}
	$first_name = request()->input('first_name');
	$last_name = request()->input('last_name');
	$name = strval($first_name.' '.$last_name);
	if($name){}else{$name='';}
	$received_by = request()->input('received_by');
	if($received_by){}else{$received_by=0;}
@endphp
var chat_id = {{$chat_id}};
if(chat_id!=0){
	var _pic = "{{$_pic}}";
	var name = "{{$name}}";
	var received_by = {{ $received_by }};
	// getMessage(name, received_by);
}	

var lmi = 0;

var imvar = 0;
get_unread_users();

get_inbox_users();

setTimeout(function(){ 
	get_all_users()
}, 1000)


setTimeout(function(){ 
	auto_reply()
	console.log('auto reply')
}, 20000)


function auto_reply() {
	jQuery.ajax({
	   type: "GET",
	   url: '{!! url("buyer-seller/auto-reply") !!}',
	   success: function(response) {

	   },
	   error: function(data){
		   toastr.error('Bad Request.');
	   }
	});
}
// jQuery(document).on("click",".user_img",function() {
// 	var sent_by = jQuery(this).attr('data-msg-id');
// 	jQuery.ajax({
// 	   type: "GET",
// 	   url: '{!! url("/api/message/msgRead/".Auth::user()->id) !!}/'+sent_by,
// 	   success: function(response) {
// 			// window.location.reload();
// 	   },
// 	   error: function(data){
// 		   toastr.error('Bad Request.');
// 	   }
// 	});
// 	jQuery(this).find('.unread-msg').hide();
// });

// function setCookie(key, value, expiry) {
//     var expires = new Date();
//     expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
//     document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
// }

// function getCookie(key) {
//     var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|jQuery)');
//     return keyValue ? keyValue[2] : null;
// }

// function eraseCookie(key) {
//     var keyValue = getCookie(key);
//     setCookie(key, keyValue, '-1');
// }
// eraseCookie('user_id');


jQuery(document).on('click', '.get-all-users .get-all-users-mob2', function(){
	name = jQuery(this).find('.ttlusr').text()
	sid = jQuery(this).parents('.get-all-users').find('.message-check input').data('sid')	
	get_unread_users()
	getMessage(name, sid)
	get_inbox_users()
});

function get_inbox_users() {
	jQuery.ajax({
	   type: "GET",
	   url: '{!! url("buyer-seller/inbox-message/same") !!}',
	   success: function(response) {
	  //  		setCookie('user_id', 20 , '1');
			// var cookie_user_id = getCookie('user_id');
			// console.log(cookie_user_id)
			if (response.state == false) {
				jQuery(".inbox_chat").html("<p class='no-msg'>0 Messages</p>");
				jQuery(".msg-count").html(0);
	   	    }else{
	   	    	jQuery(".msg-count").html(response['count']);
				var html = response['messages']
	   	    	jQuery(".inbox_chat").html(html);
	   	    }			

	   },
	   error: function(data){
		   toastr.error('Bad Request.');
	   }
	});
}

function get_all_contact_delete() {
	jQuery.ajax({
	   type: "GET",
	   url: '{!! url("buyer-seller/getalluser") !!}',
	   success: function(response) {
			var obj = response;
			var html = '';
			jQuery.each(obj, function(key, value) {
				if(!value.first_name) {return;}
				if(value.profile_pic) {
					profile_pic = value.profile_pic;
				} else {
					profile_pic = 'assets/images/profile.png';
				}
				
				html += '<div class="row m-t-10">';
				html += '<div class="col-sm-2 col-md-2 col-xs-3 no-padding-right get-all-users-de1"><img class="sidebar-pic" src="/'+profile_pic+'"></div>';
				html += '<div class="col-sm-10 col-md-10 col-xs-9 get-all-users-de2"><div class="row no-margin">';
				
				message = value.message;
				if(message) {
					message = message.substring(0, 20);
				}
				
				html += '<div class="col-sm-9 col-md-9 col-xs-9 text-left no-padding get-all-users-de22"><span><b style="font-size: 13px;">'+value.first_name+' '+value.last_name+' </b></span><p class="faded-text">'+message+'</p></div>';
				html += '<div class="col-sm-3 col-md-3 col-xs-3 text-right get-all-users-de222"></div>';
				html += '</div></div>';
				html += '</div>';
			});
			jQuery("#tab3").html(html);
	   },
	   error: function(data){
		   toastr.error('Bad Request.');
	   }
	});
}

function get_read_users() {
	jQuery.ajax({
	   type: "GET",
	   url: '{!! url("buyer-seller/getallreaduser") !!}',
	   success: function(response) {
	   		jQuery('#tab1 .filter a').removeClass('active');
			jQuery('#readmsg').addClass('active');

			jQuery("#tab1 .sidebar-message").html(response);
	   },
	   error: function(data){
		   toastr.error('Bad Request.');
	   }
	});
}

function get_unread_users() {
	jQuery.ajax({
	   type: "GET",
	   url: '{!! url("buyer-seller/getallunreaduser") !!}',
	   success: function(response) {

	   		if (response.state == false) {
	   				// console.log('blank')
	   			jQuery('#unrmsg').css({
   			    	"background": "",
   			    	"padding": "",
   			    	"border-radius": ""
   			    })

	   			jQuery("#tab1 .sidebar-message").html("<p class='no-msg'>0 Messages</p>");
	   		}	
	   		else{
   			    jQuery('#unrmsg').css({
   			    	"background": "rgba(255, 0, 0, .09)",
   			    	"padding": "1px 5px",
   			    	"border-radius": "7px"
   			    })
	   			jQuery("#tab1 .sidebar-message").html(response);
	   		}	

			
	   },
	   error: function(data){
		   toastr.error('Bad Request.');
	   }
	});
}

jQuery(function() {

	var emt = jQuery('#send-message-form textarea').emojioneArea({
		pickerPosition: "left",
	});
	jQuery('.message-sidebar .nav-tabs a').on('click', function() {
		id = jQuery(this).attr('id');
		if(id == 'option1-a') get_all_users();
		if(id == 'option2-a') get_all_contact();
		if(id == 'option3-a') get_all_contact_delete();
		//jQuery('.option-box').removeClass('active');
		//jQuery(this).addClass('active');
	});
	
	jQuery('#tab1 .filter a').on('click', function() {
		id = jQuery(this).attr('id');
		jQuery('#tab1 .filter a').removeClass('active');
		jQuery(this).addClass('active');
		if(id == 'allmsg') get_all_users();
		if(id == 'readmsg') get_read_users();
		if(id == 'unrmsg') get_unread_users();
	});
	

	
	function get_all_contact() {
		var url = '{!! url("/api/message/get_all_contact/".Auth::user()->id) !!}';
		jQuery.ajax({
		   type: "GET",
		   url: url,
		   success: function(response){
				var obj = response
				var html = '';
				jQuery.each(obj, function(key, value) {
					//console.log(value);
					html += '<div class="row margin-bottom-5 margin-top-5">';
					html += '<div class="col-sm-2 col-md-2 col-xs-3 get-all-users-anc1"><a href="#"><img class="sidebar-pic circular" src="/assets/images/profile.png"></a></div>';
					html += '<div class="col-sm-10 col-md-10 col-xs-9 get-all-users-anc2"><div style="text-align: left; font-size: 14px;"><span class="cursor-pointer" onClick="return sendMessage('+value.id+', \''+value.first_name+' '+value.last_name+'\');"><b>' +value.first_name + ' ' + value.last_name +' </b></span></div></div>';
					html += '</div>';
				});
				jQuery("#tab2 div").next("div").html(html);
		   },
		   error: function(data){
			   toastr.error('Bad Request.');
		   }
		});
	}

    jQuery(document).on('keydown', '#send-message-form', function (e) {
        if(e.which == 13) {
			jQuery('#send-message-form').submit();
        }
    });

	jQuery('#send-message-form').submit(function(e) {
		e.preventDefault();
		
		message = emt[0].emojioneArea.getText();
		if (message.trim() == '') {
			message = jQuery('#send-message-form .emojionearea-editor').text();
		}
		if(message.trim() == '' && jQuery("#message_file")[0].files.length == 0) {
			return;
		}
		jQuery('#send-message-form textarea').val('');
		emt[0].emojioneArea.setText('');
		jQuery('#load').css('visibility', 'visible');
		var formData = new FormData(this);
		formData.append('message', message);
		formData.append('currentUser', {{ Auth::user()->id }});
		btn = jQuery('#send-message-form button');
		jQuery.ajax({
			url: '{{ url("buyer-seller/chat-message") }}',
			type: 'POST',
			data: formData,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				btn.button('loading');
			},
			success: function(resp) {
				// console.log(resp)
				jQuery('#lmi').text(resp['lmi'])
				jQuery('#send-message-form textarea').val('');
				emt[0].emojioneArea.setText('');
				jQuery('#load').css('visibility', 'hidden');

				jQuery(".direct-chat-messages").append(resp['html']);
				jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight);
			},
			error: function(data){
				jQuery('#send-message-form textarea').val('');
				emt[0].emojioneArea.setText('');
				toastr.error('Bad Request.');
		    }
		});
	});
	
	jQuery('#automatic-form').submit(function(e) {
		e.preventDefault();
		var formData = new FormData(this);
		if(jQuery('#togBtn').is(':checked')) {
			formData.append('auto_reply', 1);
		} else {
			formData.append('auto_reply', 0);
		}
		formData.append('user_id', {{ Auth::user()->id }});
		jQuery.ajax({
			url: '{{ url("/api/autoreply-setting") }}',
			type: 'POST',
			data: formData,
			dataType: 'json',
			cache: false,
			contentType: false,
			processData: false,
			success: function(json) {
				if(json.success) {
					toastr.success('Setting Saved.');
				}
			},
			error: function(data){
				toastr.error('Bad Request.');
		   }
		});
	});
	
	jQuery('#tab1 .message-search').on('keyup', function(){
		var filter = jQuery(this).val().toLowerCase();
		var nodes = jQuery('#tab1 .get-all-users');
		for (i = 0; i < nodes.length; i++) {
			if (nodes[i].innerText.toLowerCase().includes(filter)) {
			  nodes[i].style.display = "block";
			} else {
			  nodes[i].style.display = "none";
			}
		}
	})
	jQuery('#tab2 .message-search').on('keyup', function(){
		var filter = jQuery(this).val().toLowerCase();
		var nodes = jQuery('#tab2 .row');
		for (i = 0; i < nodes.length; i++) {
			if (nodes[i].innerText.toLowerCase().includes(filter)) {
			  nodes[i].style.display = "block";
			} else {
			  nodes[i].style.display = "none";
			}
		}
	})
});


function get_all_users() {
	jQuery.ajax({
	   type: "GET",
	   url: '{!! url("buyer-seller/getalluser") !!}',
	   success: function(response) {	 
			jQuery("#tab1 .sidebar-message").html(response);
	   },
	   error: function(data){
		   toastr.error('Bad Request.');
	   }
	});
}

function sendMessage(user_id, name) {
	//jQuery('#load').css('visibility', 'visible');
	jQuery('#send-message-form input[name="received_by"]').val(user_id);
	jQuery(".direct-chat-messages").html('');
	jQuery('.buyer-form > h4').html('Message - ' + name);
	if(user_id) {
		getMessage(name, user_id)
	} else {
		jQuery('html, body').animate({
			scrollTop: jQuery(".buyer-form").offset().top - 80
		}, 100);
	}
}

jQuery(document).on('click', '.inbox_chat a', function(){
	
	var num = jQuery(this).parents('.message-sec.side-sec').find('.msg-count').text();
	var msg_count = jQuery(this).find('.unread-msg').text();
	num = parseInt(num)
	msg_count = parseInt(msg_count)
	num = num - msg_count;
	if (num >= 0) {
		jQuery(this).parents('.message-sec.side-sec').find('.msg-count').text(num)
		jQuery('.msg-count-out .msg-count').text(num);
		getMessage(jQuery(this).data('username'), jQuery(this).data('sent-id'));
		get_unread_users();
		jQuery(this).remove();
	}	
});

function getMessage(name, user_id) {
	jQuery('#load').css('visibility', 'visible');
	var url = '{!! url("buyer-seller/chat-message/") !!}/' + user_id;
	// console.log(url)
	jQuery.ajax({
	   type: "GET",
	   url: url,
	   success: function(response){
	   		if (response != '') {
		   		jQuery("#lmi").html(response['lmi'])
		   		lmi = jQuery('#lmi').text();
		   		get_read_users()
				jQuery(".direct-chat-messages").html(response['html']);
				jQuery('.buyer-form > h4').html('Message - ' + name);
				jQuery('html, body').animate({
					scrollTop: jQuery(".buyer-form").offset().top - 80
				}, 100);
				jQuery('#load').css('visibility', 'hidden');
				jQuery('#send-message-form input[name="received_by"]').val(response['receiver_id']);
				jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight);
			}
	   },
	   error: function(data){
		   toastr.error('Bad Request.');
		   jQuery('#load').css('visibility', 'hidden');
		   //jQuery('#send-message-form input[name="received_by"]').val(user_id);
	   }
	});
}

setInterval(function(){
	lmi = jQuery('#lmi').text();
	rec = jQuery('#send-message-form input[name="received_by"]').val();
	if (lmi != 0) {
	    jQuery.ajax({
	        type:'GET',
	        url: '{!! url("buyer-seller/refresh-message") !!}/'+lmi+'/'+rec,
	        success:function(data){
	        	if (data['lmi'] > lmi) {
	        		lmi = jQuery('#lmi').text(data['lmi']);
					jQuery(".direct-chat-messages").append(data['html']);
					jQuery(".direct-chat-messages").scrollTop(jQuery(".direct-chat-messages")[0].scrollHeight);
	        	}            	            
	        }
	    });
	}
}, 1500);

function deletemessage(user_id, id) {
	var box = confirm("Are you sure delete this message");
	if (box === true) {
		jQuery('#load').css('visibility', 'visible');
		jQuery.ajax({
		   type: "GET",
		   url: '{!! url("buyer-seller/delete-message/") !!}/'+id,
		   success: function(response) {
			   get_all_contact_delete();
			   get_all_users();
			   jQuery('#load').css('visibility', 'hidden');
		   },
		   error: function(data){
			   toastr.error('Bad Request.');
		   }
		});
	}
}

jQuery(document).on('click', '.message-all-check input', function(){
	if (jQuery(this).prop('checked') == true) {
	   	$( ".get-all-users .message-check input" ).each(function() {
	   		$(this).prop("checked", true)
		});
	}else{
		$( ".get-all-users .message-check input" ).each(function() {
	   		$(this).prop("checked", false)
		});
	}

	
})

jQuery(document).on('click', '#select-delete', function(){
	var box = confirm("Are you sure delete this message");
	var sid = Array();
	jQuery( ".get-all-users .message-check input" ).each(function() {
	   if (jQuery(this).prop("checked") == true) {

	   		if (jQuery.inArray(jQuery(this).data('sid'), sid) === -1) {
	   			sid.push(jQuery(this).data('sid'));
	   		}
	  		
	   }
	});
	if (box === true) {
		jQuery('#load').css('visibility', 'visible');
	   	token = $("meta[name='csrf-token']").attr("content")
		jQuery.ajax({
		    type: "POST",
		    url: '{!! url("buyer-seller/check-delete-message/") !!}',
			data: {
				_token: token,
				sid : sid,
			},
			// dataType: 'json',
		    success: function() {
			   get_all_users();
			   jQuery('#load').css('visibility', 'hidden');
		    },
		    error: function(data){
			   toastr.error('Bad Request.');
		    }
		});
	}
});
function deleteMessageSelected(user_id, id) {
	var box = confirm("Are you sure delete this message");
	if (box === true) {
		jQuery('#load').css('visibility', 'visible');
		jQuery.ajax({
		   type: "GET",
		   url: '{!! url("buyer-seller/delete-message/") !!}/'+id,
		   success: function(response) {
		   		// console.log(response);
			   // get_all_contact_delete();
			   get_all_users();
			   jQuery('#load').css('visibility', 'hidden');
		   },
		   error: function(data){
			   toastr.error('Bad Request.');
		   }
		});
	}
}
</script>
@stop
<!--SideBar-End---->