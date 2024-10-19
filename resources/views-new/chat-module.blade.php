@if(!empty(Auth::check()))
<style>
   .img_cont i.fa.fa-star {
   position: absolute;
   top: auto;
   left: auto;
   color: yellow;
   bottom: 1px;
   right: 1px;
   font-size: 19px;
   }
   .img_cont{height: 70px;}
   #chat{
   right: 145px;
   top:auto;
   bottom:10px;
   position: fixed;   
   z-index: 10006;
   display:none; 
   }
   #chat .card{
	   width: 300px !important;
   }
   #chat .card-header{
	   padding-bottom:0px;
   }
   #chat .img_cont{
	   float:left;
   }
   #chat-overlay{
   right: 23px !important;  
   top: 0%;
   }
   .msg_time {
   position: absolute;
   left: 10px;
   bottom: -19px;
   color: grey;
   font-size: 10px;
   width: 100%;
   }
   .msg_cotainer_send{
   word-break: break-all;
   }
   .msg_cotainer,.msg_cotainer_send{word-break:break-word;font-size:16px}
   #chat .panel-footer textarea.form-control.input-sm.chat_input {
   width: 100%;
   }
   #chat .panel-footer button.btn.btn-primary.btn-sm.btn-chat{  position: absolute;
   margin-left: 0;
   right: 0;
   top: 50%;
   margin-top: -16px;
   border-radius: 4px;} 
   textarea.form-control.input-sm.chat_input {
   width: 100%;
   padding:10px 70px 10px 10px;
   }
   #chat .panel-footer .input-group-btn {
   position: absolute;
   font-size: 0;
   white-space: normal;
   width: 60px;
   right: 8px;
   height: 100%;
   bottom: 0;
   z-index:3;
   }
   .msg_cotainer .msg_time,.msg_time_send{width: auto;
   word-break: normal;
   white-space: nowrap;bottom: -20px;}
   .img_cont_msg{min-width:40px}
   #chat-overlay .user_info {
   margin-top: auto;
   margin-bottom: auto;
   margin-left: 15px;
   word-break: normal;
   width: 30%;
   overflow: hidden;
   height: 57px;
   }
   .panel-default {
   border-color: lightgray;
   border-radius: 15px;
   }
   body .round.hollow a{left:auto}
   body .round.hollow a:hover{padding:0}
   .round.hollow i.fa.fa-commenting-o {
   font-size: 20px;
   }
   .message_data{
   color: white;
   width: auto;
   float:left;
   }
   .search_data{
   padding:0px 5px 10px 5px;
   }
   .search_data input#myInput{
   border: 1px solid #B43E38 !important;
   }
   .search_data .search_btn{
   background:#B43E38 !important; 
   }
   .message_data_option{
   color: white;
   width: auto;
   float:right;
   }
   .round.hollow a{float: left;
   left: auto;
   height: 70px;
   width: 70px;
   padding: 0;
   position: fixed;
   right: 10px;
   text-align: center;
   text-decoration: none;
   top: 45%;
   z-index: 10006;
   border-radius: 100%;
   background: #b43e38!important;
   color: #fff!important;
   border: 0 none!important;}
   .chat_box.chat_box{margin-right:15px}
   .chat_box.chat_box .action_menu_btn{width:20px;text-align:right;}
   @media screen and (max-width:1200px){
   body #chat {
   right:70px;
   top: auto;
   bottom: 30px;left:auto
   }
   .chat.chat {
   margin-top: auto;
   margin-bottom: auto;
   flex-basis: 100%;
   width: auto;
   float: right;
   flex: auto;
   width: auto;
   max-width: 100%;
   }
   body #chat .row.justify-content-center {
   justify-content: end!important;
   }
   }
   @media screen and (max-width:1070px){   
   .chat_box.chat_box {
   margin-right: 15px;
   top: -50px;
   position: absolute;
   right: 30px;
   max-width: 300px;
   z-index: 10000;
   }
   .emojionearea .emojionearea-editor{
	min-height: 8em;
   }}
   @media only screen and (max-width:767px){
   .emojionearea .emojionearea-picker{
    padding:0px 45px 50px 35px;
   }
   .chat{padding:0 10px}
   .chat_box.chat_box{margin-right:10px;
   position: absolute;
   top: -50px;
   right: 30px;
   max-width: 300px;
   z-index: 10000;}
   body .chat_box .img_cont span i.fa{top: 2.5em;}
   body .chat_box .user_img{height:60px;width:60px;}
   #chat{max-height: calc(100vh - 20px);
   right: 100px;
   top: auto;
   bottom: 10px;
   right: 75px;}
   .chat .card{max-height: calc(100vh - 90px)}
   body #chat {
   right: 40px;
   top: auto;
   bottom: 10px;
   left: auto;
   }
   body .panel-default {
   overflow: hidden;
   }
   #chat .action_menu{z-index: 8;}
   .img_cont {
   height: 60px;
   width: 60px;
   }
   .img_cont .user_img {
   float:left;
   height: 60px;
   width: 60px;
   }
   }
   @media only screen and (max-width :600px) and (orientation : portrait){
   .chat.chat {
   margin-top: auto;
   margin-bottom: auto;
   flex-basis: 100%;
   width: auto;
   float: right;
   flex: auto;
   width: auto;
   max-width: 290px;
   }
   .chat_box.chat_box{right:0}
   }
   @media only screen and (max-width :767px) and (orientation : landscape){
   body .chat-area{height:calc(100% - 156px)}
   body .panel-default {
   height: 474px;
   max-height: calc(100vh - 110px);
   }
   .chat .card {max-height:calc(100vh - 110px)}
   }
   @media only screen and (max-width:374px) and (orientation: portrait){
   .chat.chat {max-width: 240px;}
   .chat .card{max-width: 240px;}
   .chat_box.chat_box{max-width:260px}
   #chat .input-group input#myInput{max-width: calc(100% - 44px)}
   }
</style>
<div id="chat">
   <div class="container-fluid h-100">
      <div class="row justify-content-center h-100">
         <div id="chat-overlay" class="row"></div>
         <div class="col-md-8 col-xl-6 chat">
            <div class="card">
               <div class="card-header">
                  <div class="img_cont" >
                     <img src="{{ !empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic) :  url('assets/images/star-logo.png') }}" class="rounded-circle user_img" style="height: 50px; width: 50px;"> 
                     <span><i style="top: 2pc; left: 2pc;"class="fa fa-star text-success" aria-hidden="true"></i></span>
                  </div>
                 
                  <div class="message_data" id="open-chat-window" style="cursor: pointer;">
                     Messaging
                     <span class="user-name">{{ Auth::user()->username }}</span>
                  </div>
                <!--   <div class="message_data_option" >
                     <i class="fa fa-ellipsis-v" aria-hidden="true"></i>              
                  </div> -->
               </div>
            
               <div class="card-body contacts_body">
                  <div class="spinnerloader" id="loader" style="display: block;padding: 9pc 0pc 0pc 8pc;">
                     <div class="spinner-border" role="status" >
                        <span class="sr-only">Loading...</span>
                     </div>
                  </div>
               </div>
               <div class="card-footer"></div>
            </div>
         </div>
      </div>
   </div>
</div>
@endif
