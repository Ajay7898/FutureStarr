jQuery(function() {
    
    jQuery(document).on('click', "#open-chat-window", function() {
       
        jQuery("#chat").toggle();
        eraseCookie('user_id'); 
        eraseCookie('username'); 
        eraseCookie('image'); 
        eraseCookie('profile_link'); 
        eraseCookie('onoff'); 
        eraseCookie('email'); 
        return true;

    });
    jQuery('[id^="open-chat-room"]').click(function() {
        
        var id = jQuery(this).data('id');
        jQuery("#chat-room").toggle();
        // scrollToBottom();
        return true;

    });
    
    /**** check oepn chat box on page load*******/

    var cookie_user_id = getCookie('user_id');
   // alert('cookie_user_id'+cookie_user_id);
    var cookie_username = getCookie('username');
    var cookie_image = getCookie('image');
    var cookie_profile_link = getCookie('profile_link');
    var cookie_onoff = getCookie('onoff');
    var cookie_email = getCookie('email');

    if(cookie_user_id != null  && cookie_username != null && cookie_image != null  &&  cookie_profile_link != null && cookie_onoff!= null && cookie_email!= null ) {
        // jQuery("#chat").show();
        cloneChatBox(cookie_user_id, cookie_username, cookie_image, cookie_profile_link, cookie_onoff, cookie_email, function() {
            let chatBox = jQuery("#chat_box_" + cookie_user_id);
            if (!chatBox.hasClass("chat-opened")) {
                chatBox.addClass("chat-opened").slideDown("fast");
                loadLatestMessages(chatBox, cookie_user_id);

                 setTimeout(function(){ 
                      chatBox.find(".chat-area").animate({
                        scrollTop: 10000
                    }, 800, 'swing');
                 }, 500);
            }
        });
    } else {
      //  console.log('failed');
       // console.log('else part');
    }

});

function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|jQuery)');
    return keyValue ? keyValue[2] : null;
}

function eraseCookie(key) {
    var keyValue = getCookie(key);
    setCookie(key, keyValue, '-1');
}

jQuery(function() {
    
    Pusher.logToConsole = true;
    let pusher = new Pusher(jQuery("#pusher_app_key").val(), {
        cluster: jQuery("#pusher_cluster").val(),
        encrypted: false
    });
    let channel = pusher.subscribe('chat');
    // on click on any chat btn render the chat box
    //  jQuery(".chat-toggle").on("click", function(e) {

    jQuery(document).on('click','.chat-toggle',function(e) {
        
        e.preventDefault();
       
        eraseCookie('user_id'); 
        eraseCookie('username'); 
        eraseCookie('image'); 
        eraseCookie('profile_link'); 
        eraseCookie('onoff'); 
        eraseCookie('email'); 

        let ele = jQuery(this);
        let user_id = ele.attr("data-id");
        let username = ele.attr("data-user");
        let image = ele.attr("data-imgsrc");
        let profile_link = ele.attr("data-plink");
        let onoff = ele.attr("data-onoff");
        let email = ele.attr("data-email");

        setCookie('user_id', user_id , '1'); 
        setCookie('username', username, '1'); 
        setCookie('image', image, '1'); 
        setCookie('profile_link', profile_link,'1'); 
        setCookie('onoff', onoff, '1'); 
        setCookie('email', email, '1'); 

        
        cloneChatBox(user_id, username, image, profile_link, onoff, email, function() {

            let chatBox = jQuery("#chat_box_" + user_id);
            if (!chatBox.hasClass("chat-opened")) {
                chatBox.addClass("chat-opened").slideDown("fast");
                loadLatestMessages(chatBox, user_id);
                chatBox.find(".chat-area").animate({
                    scrollTop: jQuery(this).height()*10000
                }, 2000);

                //console.log(chatBox.find(".chat-area").offset().top);

                //console.log(chatBox.find(".chat-area").outerHeight(true));

                // chatBox.find(".chat-area").animate({
                //     scrollTop: chatBox.find(".chat-area").offset().top + chatBox.find(".chat-area").outerHeight(true)
                // }, 800, 'swing');
               
             /*setTimeout(function(){ 
                  chatBox.find(".chat-area").animate({
                    scrollTop: 10000
                }, 800, 'swing');
             }, 500);*/
            
            }
        });
    });

    // on close chat close the chat box but don't remove it from the dom
    //jQuery(".close-chat").on("click", function(e) {
    jQuery(document).on('click', '.close-chat',function(e) {

         jQuery(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
         var id = jQuery(this).attr("data-id");
         jQuery("#action_menu-"+id).hide();
            eraseCookie('user_id'); 
            eraseCookie('username'); 
            eraseCookie('image'); 
            eraseCookie('profile_link'); 
            eraseCookie('onoff'); 
            eraseCookie('email'); 
    });

    // on change chat input text toggle the chat btn disabled state
     //jQuery(".chat_input").on("change keyup", function(e) {
     jQuery(document).on("change keyup", ".chat_input",function(e) {
        if (jQuery(this).val() != "") {
            // jQuery(this).parents(".form-controls").find(".btn-chat").prop("disabled", false);
        } else {
            // jQuery(this).parents(".form-controls").find(".btn-chat").prop("disabled", true);
        }

    });
    
    // jQuery(function() {
         
    //     document.onkeydown = function(event){
    //         if(window.event.keyCode =='13'){
    //             var user_id = jQuery('.btn-chat').attr('data-to-user');
    //             var message = jQuery('.emojionearea-editor').html();
    //             send(user_id, message);
    //             // debugger;  
    //             var status = jQuery('.btn-chat').data('status');
    //             var email = jQuery('.btn-chat').data('useremail');
    //             if(status == 'offline') {
    //                 messageNotification(email, message);
    //             }
    //         }
    //     }

    // });


    // on click the btn send the message
   // jQuery(".btn-chat").on("click", function(e) {
    jQuery(document).on('click', '.btn-chat',function(e) {
        send(jQuery(this).attr('data-to-user'), jQuery("#chat_box_" + jQuery(this).attr('data-to-user')).find(".chat_input").val());  
        /*** check user status ***/
        var status = jQuery(this).data('status');
        var email = jQuery(this).data('useremail');
        var message = jQuery("#chat_box_" + jQuery(this).attr('data-to-user')).find(".chat_input").val();
        if(status == 'offline') {
            /** send email if user is offline **/
            messageNotification(email, message);
        }
    });

    jQuery(document).on('keyup', '.emojionearea-editor',function(e) {
        if (event.keyCode === 13) {
            
            var user_id = jQuery('.btn-chat').attr('data-to-user');
            var message = jQuery('#chat_box_'+jQuery('.btn-chat').attr('data-to-user')+' .inputEmoji')[0].emojioneArea.getText();
            
            send(user_id, message);
            var status = jQuery('.btn-chat').data('status');
            var email = jQuery('.btn-chat').data('useremail');
            if(status == 'offline') {
                 messageNotification(email, message);
            }
        }   
    });

    // listen for the send event, this event will be triggered on click the send btn

    channel.bind('pusher:subscription_succeeded', function(members) {
        //console.log('successfully subscribed!');
    });

     channel.bind('send', function(data) {
        displayMessage(data.data);
        


     });

    // handle the scroll top of any chat box
    // the idea is to load the last messages by date depending of last message
    // that's already loaded on the chat box
    let lastScrollTop = 0;

    jQuery(".chat-area").on("scroll", function(e) {
        let st = jQuery(this).scrollTop();
        if (st < lastScrollTop) {
            fetchOldMessages(jQuery(this).parents(".chat-opened").find("#to_user_id").val(), jQuery(this).find(".msg_container:first-child").attr("data-message-id"));
        }
        lastScrollTop = st;
    });

    // listen for the oldMsgs event, this event will be triggered on scroll top
    channel.bind('send', function(data) {
        displayOldMessages(data);
    });
});

/**
 * loaderHtml
 *
 * @returns {string}
 */
function loaderHtml() {
    return '<i class="glyphicon glyphicon-refresh loader"></i>';
}

/**
 * cloneChatBox
 *
 * this helper function make a copy of the html chat box depending on receiver user
 * then append it to 'chat-overlay' div
 *
 * @param user_id
 * @param username
 * @param callback
 */
function cloneChatBox(user_id, username, image, profile_link, onoff, email, callback) {

     var openedchat = jQuery(".chat-opened").attr('id');
     jQuery('#'+openedchat).remove();
     if(openedchat != undefined ||  openedchat != null) {
            var splitStr = openedchat.split("_");
            if(user_id != splitStr[2]) {
                jQuery("#"+openedchat).removeClass("chat-opened").slideUp("fast");
                var id = jQuery(this).attr("data-id");
                jQuery("#action_menu-"+id).hide();
            }
     } 
     if (jQuery("#chat_box_" + user_id).length == 0 ) {
        let cloned = jQuery("#chat_box").clone(true);
        // change cloned box id
        cloned.attr("id", "chat_box_" + user_id);
        cloned.find(".chat-user").text(username);
        cloned.find(".action_menu li a ,#add-fav-user").attr({"id" : "add-fav-user-" +user_id, "data-userid": user_id});
        cloned.find(".profile_link a").attr('href' , profile_link);
        cloned.find(".action_menu_btn").attr("id", "action_menu_btn-" + user_id);
        cloned.find(".action_menu_btn").attr("data-id",  user_id);
        cloned.find(".action_menu").attr("id",  "action_menu-" +user_id);
        cloned.find(".close-chat").attr("data-id",  user_id);
        cloned.find(".btn-chat").attr({"data-to-user": user_id, "data-status":onoff, "data-useremail": email });
        cloned.find("#to_user_id").val(user_id);
        
        if(onoff == 'online') {
            var onoff_html = '<img src="' + image + '" class="rounded-circle user_img"><span><i class="fa fa-star text-success" aria-hidden="true"></i></span>';
        } else {
            var onoff_html = '<img src="'+ image + '" class="rounded-circle user_img"><span><i class="fa fa-star text-warning" aria-hidden="true"></i></span>';
        }
        cloned.find(".img_cont").html(onoff_html);

        setTimeout(function(){ 
            jQuery("#chat-overlay").append(cloned); 
        }, 1000);
            
    }
    setTimeout(function(){ 
       callback();
     }, 1000);
     

}

/**
 * loadLatestMessages`
 *
 * this function called on load to fetch the latest messages
 *
 * @param container
 * @param user_id
 */

var chatUserIds = [];
function loadLatestMessages(container, user_id) {
    let chat_area = container.find(".chat-area");
    
    chat_area.html("");

    jQuery.ajax({
        url: base_url + "/load-latest-messages",
        data: {
            user_id: user_id,
            _token: jQuery("meta[name='csrf-token']").attr("content")
        },
        method: "GET",
        dataType: "json",

        beforeSend: function() {
            if (chat_area.find(".loader").length == 0) {
                chat_area.html(loaderHtml());
            }
        },
        success: function(response) {

            //console.log('container', container);
            //console.log('user_id', user_id);
            // console.log('response message latest', response);

            if (response.state == 1) {
                response.messages.map(function(val, index) {
                    jQuery(val).appendTo(chat_area);
                });
            }
            
            // console.log(chatUserIds);
            if(!chatUserIds.includes(user_id)) {
                var emt = jQuery('#chat_box_'+user_id+' .inputEmoji').emojioneArea({
                    useSprite: false,
                    pickerPosition: "top",
                    events: {
                        keyup: function (editor, event) {
                            if (this.getText() != "") {
                                editor.closest(".form-controls").find(".btn-chat").prop("disabled", false);
                            } else {
                                editor.closest(".form-controls").find(".btn-chat").prop("disabled", true);
                            }
                        },
                        emojibtn_click: function (button, event) {
                            this.editor.closest(".form-controls").find(".btn-chat").prop("disabled", false);
                        }
                    }
                });
                // chatUserIds.push(user_id);
                jQuery(".chat-area").animate({ scrollTop: jQuery(".chat-area").height()*10000 }, 500);
            }
            
        },
        complete: function() {
            chat_area.find(".loader").remove();
        }
    });
}

/**
 * send
 *
 * this function is the main function of chat as it send the message
 *
 * @param to_user
 * @param message
 */
function send(to_user, message) {
    let chat_box = jQuery("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");
    
    jQuery.ajax({
        url: base_url + "/send",
        data: {
            to_user: to_user,
            message: message,
            _token: jQuery("meta[name='csrf-token']").attr("content")
        },
        method: "POST",
        dataType: "json",
        beforeSend: function() {
            if (chat_area.find(".loader").length == 0) {
                chat_area.append(loaderHtml());
            }
        },
        success: function(response) {},
        complete: function() {
            chat_area.find(".loader").remove();
            chat_box.find(".btn-chat").prop("disabled", true);
            chat_box.find(".chat_input").val("");
            
            jQuery('#chat_box_' + to_user + ' .inputEmoji')[0].emojioneArea.setText("");

         /*   chat_area.animate({
                scrollTop: chat_area.offset().top + chat_area.outerHeight(true)
            }, 800, 'swing');*/
             setTimeout(function(){ 
                   chat_area.animate({
                    scrollTop: jQuery(this).height()*10000
                }, 800, 'swing');
            }, 500);
        }
    });
}

/**
 * fetchOldMessages
 *
 * this function load the old messages if scroll up triggerd
 *
 * @param to_user
 * @param old_message_id
 */
function fetchOldMessages(to_user, old_message_id) {
    let chat_box = jQuery("#chat_box_" + to_user);
    let chat_area = chat_box.find(".chat-area");

    jQuery.ajax({
        url: base_url + "/fetch-old-messages",
        data: {
            to_user: to_user,
            old_message_id: old_message_id,
            _token: jQuery("meta[name='csrf-token']").attr("content")
        },
        method: "GET",
        dataType: "json",
        beforeSend: function() {
            if (chat_area.find(".loader").length == 0) {
                chat_area.prepend(loaderHtml());
            }
        },
        success: function(response) {},
        complete: function() {
            chat_area.find(".loader").remove();
        }
    });
}

/**
 * getMessageSenderHtml
 *
 * this is the message template for the sender
 *
 * @param message
 * @returns {string}
 */
function getMessageSenderHtml(message) {

  return ` 
  <div class="d-flex justify-content-end mb-4 base_sent" data-message-id="${message.id}">
        <div class="msg_cotainer_send">
            ${message.content}
            <span class="msg_time_send">${message.dateHumanReadable}</span>
        </div>
        <div class="img_cont_msg">
            <img src="` + base_url + '/' + message.from_user.profile_pic + `" class="rounded-circle user_img_msg">
        </div>
    </div>`;
}

/**
 * getMessageReceiverHtml
 *
 * this is the message template for the receiver
 *
 * @param message
 * @returns {string}
 */
function getMessageReceiverHtml(message) {
  
    return` 
      <div class="d-flex justify-content-start mb-4 base_receive" data-message-id="${message.id}">
        <div class="img_cont_msg">
            <img src="` + base_url + '/' + message.from_user.profile_pic + `" class="rounded-circle user_img_msg">
        </div>
        <div class="msg_cotainer">
               ${message.content}
         <span class="msg_time">${message.dateHumanReadable}</span>
     </div>
    </div>`;
}

/**
 * This function called by the send event triggered from pusher to display the message
 *
 * @param message
 */
function displayMessage(message) {
    
    let alert_sound = document.getElementById("chat-alert-sound");

    if (jQuery("#current_user").val() == message.from_user_id) {

        let messageLine = getMessageSenderHtml(message);

        //console.log('message line', messageLine);

        jQuery("#chat_box_" + message.to_user_id).find(".chat-area").append(messageLine);

    } else if (jQuery("#current_user").val() == message.to_user_id) {

        alert_sound.play();
        var image = '';
        var onoff  = '';
        jQuery('.chat-toggle').each(function( index ) {
		  	if(message.from_user.username == jQuery(this).data('user')){
		  		onoff = jQuery(this).data('onoff');
		  	}
		});
        //var email = '';
        // for the receiver user check if the chat box is already opened otherwise open it
        cloneChatBox(message.from_user_id, message.from_user.username, '../'+message.from_user.profile_pic, message.profile_link, onoff, email, function() {

            let chatBox = jQuery("#chat_box_" + message.from_user_id);

            if (!chatBox.hasClass("chat-opened")) {

                chatBox.addClass("chat-opened").slideDown("fast");

                loadLatestMessages(chatBox, message.from_user_id);

                chatBox.find(".chat-area").animate({
                    scrollTop: chatBox.find(".chat-area").offset().top + chatBox.find(".chat-area").outerHeight(true)
                }, 800, 'swing');
               
               // chatBox.find(".chat-area").animate({ scrollTop: jQuery(".chat-area").scrollTop() }, 1000);
               
                 //jQuery('.chat-area').scrollTop(jQuery('.chat-area')[0].scrollHeight);
            } else {
                 
                let messageLine = getMessageReceiverHtml(message);

                // append the message for the receiver user
                jQuery("#chat_box_" + message.from_user_id).find(".chat-area").append(messageLine);
                 
                jQuery(".chat-area").animate({ scrollTop: jQuery('.chat-area').prop("scrollHeight")}, 1000);

                
            }
        });
    }
}

 function playAudio() { 
          x.play(); 
 } 


 function displayOldMessages(data) {
    if (data.data.length > 0) {

        data.data.map(function(val, index) {
            jQuery("#chat_box_" + data.to_user).find(".chat-area").prepend(val);
        });
    }
}


function myFunction() {
   
    var search = jQuery("#myInput").val();
    if(search != '' || search != null || search != undefined) {
       
        var post_data = {
              search: search,
              _token: jQuery("meta[name='csrf-token']").attr("content")
        };
        var url = base_url + '/search-chat-users';
        jQuery.ajax({
             url: url,
             type: 'POST',
             data: post_data,
             success: function(response) {
                  jQuery("#contacts").html('');
                  var users = response.messages;
                  jQuery("#contacts").html(users);

             }, error: function(erro) {
                 //console.log('error response', error);
             }
        });


    } else {
        
        chat_users();
    }
    
  
}

function messageNotification(email, message) {

    if(email && message) {

        var post_data = {
              email: email, 
              message: message,
              _token: jQuery("meta[name='csrf-token']").attr("content")
        };
        var url = base_url + '/notification/send';
        jQuery.ajax({
             url: url,
             type: 'POST',
             data: post_data,
             success: function(response) {
                 //console.log('sucess response', response);
             }, error: function(erro) {
                 //console.log('error response', error);
             }
        });
    }
}

//jQuery(document).ready(function() {
    jQuery('#action_menu_btn').click(function() {
        var id = jQuery(this).attr("data-id");        
        jQuery('#action_menu-'+id).toggle();
    });

//});
jQuery(document).ready(function() {
    chat_users();
});

//jQuery(document).ready(function() {
 jQuery('[id^="add-fav-user"]').click(function() {
       var user_id = jQuery(this).attr('data-userid');
       var post_data = {  _token: jQuery("meta[name='csrf-token']").attr("content") , "type": 'add'};
       var url = base_url+'/favourite-user/create/'+user_id;
       jQuery.ajax({
            url : url,
            type: 'POST',
            data: post_data,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.success);
                    chat_users();
                    return true;
                }
                
            }, error:function(error) {
                   toastr.error(error);
                   return true;
            }
       });
 });

   // });

 jQuery(document).on('click', '.remove-fav-user',function(e) {
            
       var user_id = jQuery(this).attr('data-id');
       var post_data = {  _token: jQuery("meta[name='csrf-token']").attr("content") , "type": 'remove'};
       var url = base_url+'/favourite-user/create/'+user_id;
       jQuery.ajax({
            url : url,
            type: 'POST',
            data: post_data,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.success);
                    chat_users();
                    return true;
                }
            }, error:function(error) {
                   toastr.error(error);
                   return true;
            }
       });
});


function chat_users() {

    jQuery(".spinnerloader").remove();
    var post_data = {  _token: jQuery("meta[name='csrf-token']").attr("content")};
    var url = base_url + '/chat-users';
    jQuery.ajax({
         url: url,
         type: 'GET',
         data: post_data,
         success: function(response) {
             var users = response.messages;
             jQuery(".contacts_body").html(users);
         }, error: function(error) {
             //console.log('error response', error);
         },
    
    });
}

setInterval(chat_users, 20000);