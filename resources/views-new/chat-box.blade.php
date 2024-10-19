<script src='https://kit.fontawesome.com/a076d05399.js'></script>
 <script src="{{ asset('assets/js/jquery.emojiarea.js') }}" type="text/javascript"></script>
<style type="text/css">
    
 .chat_box p {
    font-size: 13px;
    padding: 5px;
    border-radius: 3px;
}

.chat_box .base_receive p {
    background: #4bdbe6;
}

.chat_box .base_sent p {
    background: #e674a8;
}

.chat_box time {
    font-size: 11px;
    font-style: italic;
}

#login-box {
    margin-top: 20px
}

#chat_box {
    position: fixed;    
    right: 95%;
    width: 27%;
}

.chat_box .close-chat {
    margin-top: -17px;
    cursor: pointer;
}

.chat_box {
    margin-right: 0px;
    width: 310px;
}
.chat_box .user_img_msg{object-fit:cover;object-position:center;}
.chat_box .chat-area{
    height:345px;
    overflow-y: scroll;
	background:#fffcf3;
}
#chat .panel-default{overflow:hidden}

#users li {
    margin-bottom: 5px;
}
.chat_box .msg_cotainer_send{
	word-break: break-word!important;
	max-width: 80%;
}
#chat-overlay .user_info {
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 15px;
    word-break: normal;
    width: 30%;
    overflow: hidden;
    height: 57px;
}
.chat_box button.btn.btn-primary.btn-sm.btn-chat {
    position: fixed;
    margin-left: -60px;
}
#chat .panel-footer .input-group-btn{
	height: 50% !important;
}
#chat .panel-footer .input-group-btn-smiley {
    position: absolute;
    font-size: 0;
    white-space: normal;
    width: 60px;
    right: 10px;
    height: 50% !important;
    bottom: 5px;
    z-index: 3;
}

#chat .panel-footer .input-group-btn-smiley button{
 font-size:24px;
}

.chat_box .glyphicon-ok {
    color: #42b7dd;
}
.chat_box .panel-default {
    border-color: lightgray;
    border-radius: 15px;
}
.chat_box .loader {
    -webkit-animation: spin 1000ms infinite linear;
    animation: spin 1000ms infinite linear;
}
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }
}
.chat-emoji-div.emoji-footer {
	top: -227px;
}
.social-buzz .input-group-btn-smiley.emoji-footer button {
	top: 0;
	right: 20px;
}
</style>
<audio id="chat-alert-sound" style="display: none">
        <source src="{{ asset('sound/zapsplat_musical.mp3') }}" />
</audio>
<div id="chat_box" class="chat_box pull-right chat_data_commu" style="display: none;">
    <div class="row">
        <div class="col-xs-12 col-md-12">
                <div class="panel panel-default">
                   <!--  <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat with <i class="chat-user"></i> </h3>
                        <span class="glyphicon glyphicon-remove pull-right close-chat"></span>
                    </div> -->
                    <div  class="card-header msg_head">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">

                                   <!--  <img src="" class="rounded-circle user_img"> -->
                                   <!--  <span class=""> <i class="fa fa-star" aria-hidden="true"></i></span> -->
                                   
                                </div>
                                <div class="user_info main_chat">
                                    <span><i class="chat-user"></i></span>
                                   <!--  <p>1767 Messages</p> -->
                                </div>
                                <div class="video_cam">
                                    <span><i class="fas fa-video" data-toggle="modal" data-target="#myModal" onclick="inProgress(0);"></i></span>
                                    <span><i class="fas fa-phone" data-toggle="modal" data-target="#myModal" onclick="inProgress(1);"></i></span>
                                </div>
                            </div>
                            <span class="action_menu_btn" id="action_menu_btn" data-id=""><i class="fas fa-ellipsis-v"></i></span>
                            <div class="action_menu">
                                <ul>
                                    <li>
                                        <a href="{{ route('contact-us.index') }}" target="_blank" alt="contact-us">
                                        <i class="fas fa-user-circle"></i> Customer care</a>
                                    </li>
                                    <li class="profile_link">
                                        <a target="_blank" href="javascript:void(0);">
                                        <i class="fas fa-user-circle"></i> View profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" data-userid="" id="add-fav-user">
                                        <i class="fas fa-users"></i> Add as super star</a>
                                    </li>

                                    <!-- <li><i class="fas fa-plus"></i> Add to group</li>-->
                                    <li><a href="javascript:void(0);" data-toggle="modal" data-target="#deleteusermodel" class="deleteusermodel"><i class="fa fa-trash"></i> Delete </a></li> 
                                    <li>
                                        <a href="javascript:void(0);" class="close-chat" data-id=""><i class="fas fa-remove"></i>Close tab</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    <div class="panel-body chat-area">

                    </div>
                    <div class="panel-footer">
                        <div class="input-group form-controls">

                             <textarea id="inputEmoji" class="form-control input-sm chat_input inputEmoji emoji-for-footer" placeholder="Write your message here..."></textarea>
									
                              <span class="input-group-btn">	
                                    <button class="btn btn-primary btn-sm btn-chat" type="button" data-to-user="" data-status="" data-useremail="" disabled>
                                        <i class="glyphicon glyphicon-send"></i>
                                        Send</button>
                              </span>
                              
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <input type="hidden" id="to_user_id" value="" />
</div>
<div class="modal fade" id="deleteusermodel" role="dialog" data-keyboard="false" data-backdrop="static" style="display: none; padding-right: 17px; z-index: 9999 !important;" aria-modal="true">
   <div class="modal-dialog">
      <form><!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">×</button>
               <!-- <h5 class="pull-right">
                  <span style="color:black">( 0 )</span>&nbsp;Comments
               </h5> -->
               <h4 class="modal-title"> User Name </h4>
            </div>
            <div class="modal-body">
               <div class="centered-modal-body">
                  <div>
                     <h4>Are you sure you want to delete this user?</h4>
                     <button type="button" class="btn btn-danger bydc" data-userid="" data-dismiss="modal">Yes</button>
                     <button type="button" class="btn btn-default btn-d" data-dismiss="modal">No</button>
                  </div>
               </div>
               <div class="modal-footer-awards">
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="{{ asset('assets/css/emojionearea.min.css') }}">
	<script src="{{ asset('assets/js/emojionearea.min.js') }}" type="text/javascript"></script>
	
    <script type="text/javascript">
		jQuery(document).on('click', '.deleteusermodel', function(){

            jQuery('#deleteusermodel .modal-title').text(jQuery('.chat_box.chat-opened .main_chat .chat-user').text())
            jQuery('#deleteusermodel .modal-body .bydc').attr('data-userid', jQuery(this).data('userid'))
            jQuery('#action_menu-'+jQuery(this).data('userid')).css("display", "none")
             // pull-right chat_data_commu 
        });

        jQuery(document).on('click', '#deleteusermodel .bydc', function(){
            token = $("meta[name='csrf-token']").attr("content")
            var isThis =  this;
            jQuery( "#contacts .active a" ).each(function() {
                if (jQuery(this).data('id') == jQuery('#deleteusermodel .bydc').attr('data-userid')) {
                    jQuery(this).parents('.active').remove();
                    jQuery('#chat_box_'+jQuery('#deleteusermodel .bydc').attr('data-userid')).remove();
                    
                }
            });
            jQuery.ajax({
                type: "POST",
                url: '{!! url("/send/del") !!}',
                data: {
                    _token: token,
                    id : jQuery(this).data('userid'),
                },
                // dataType: 'json',
                success: function(resp) {
                    if (resp.state == 1) {
                        jQuery('.chat_box.chat-opened .panel-body.chat-area').html('');
                    }                   

                },
                error: function(data){
                   toastr.error('Bad Request.');
                }
            });
        })
    </script>