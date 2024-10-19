<style type="text/css">
  .att_link{
  color: blue !important;
}
a#get_file {
    text-align: center;
    cursor: pointer;
}
#support_attach{
  display: none;
}
#supportattachname small {
    float: left;
    margin-right: 5px;
}
div#supportattachname {
    line-height: 1;
}
div#supportattachname div{
  color: red;
cursor: pointer;
}
#support_message{
  margin-bottom: 0;
}
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #151829;
  z-index: 9;
  background: #151829;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: #151829;
}

/* Full-width textarea */
.form-container #query_msg {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}
.form-container #support_message {
  width: 100%;
  padding: 0 5px;
  margin: 5px 0 0px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
}
.form-container input[type="text"] {
  background: #f1f1f1;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 45%;
  margin-bottom:10px;
  opacity: 0.8;
  float:left;
}
.form-container .cancel {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 45%;
  margin-bottom:10px;
  opacity: 0.8;
  float:right;
}
/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

  .popup-box {
      background-color: #ffffff;
    border: 1px solid #b0b0b0;
    bottom: 0;
    display: none;
    height: 500px;
    position: fixed;
    right: 70px;
    width: 300px;
    font-family: 'Open Sans', sans-serif;
  }
  .popup-head-left.pull-left {
  font-size: 15px;
}
  .round.hollow {
    margin: 0px 0 0;
  }
  .round.hollow a {
      border: 2px solid #F44336 ! important;
      background: #F44336;
      border-radius: 35px;
      color: white;
      font-size: 23px;
      padding: 10px 21px;
      text-decoration: none;
      font-family: 'Open Sans', sans-serif;
      position: fixed;
      left: 85pc;
  }
  
  .round.hollow a:hover {
    border: 2px solid #000;
    border-radius: 35px;
    color: red;
    color: #000;
    font-size: 23px;
    padding: 10px 21px;
    text-decoration: none;
  }
  .popup-box-on {
    display: block !important;
  }
  .popup-box .popup-head {
    background-color: #fff;
    clear: both;
    color: #7b7b7b;
    display: inline-table;
    font-size: 21px;
    padding: 7px 10px;
    width: 100%;
     font-family: Oswald;
  }
  .bg_none i {
    border: 1px solid #b43e38!important;
    border-radius: 25px;
    color: #b43e38!important;
    font-size: 17px;
    height: 33px;
    line-height: 30px;
    width: 33px;
  }
  .bg_none:hover i {
    border: 1px solid #000;
    border-radius: 25px;
    color: #000;
    font-size: 17px;
    height: 33px;
    line-height: 30px;
    width: 33px;
  }
  .bg_none {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
  }
  .popup-box .popup-head .popup-head-right {
    margin: 11px 7px 0;
  }
  .popup-box .popup-messages {
  }
  .popup-head-left img {
    border: 1px solid #7b7b7b;
    border-radius: 50%;
    width: 44px;
    margin-right: 5px;
  }
  .popup-messages-footer > input {
    border-bottom: 1px solid #b2b2b2 !important;
    height: 34px !important;
    margin: 7px;
    padding: 5px !important;
     border: medium none;
    width: 95% !important;
  }
  .popup-messages-footer {
    background: #fff none repeat scroll 0 0;
    bottom: 0;
    position: absolute;
    width: 100%;
  }
  .popup-messages-footer .btn-footer {
    overflow: hidden;
    padding: 2px 5px 10px 6px;
    width: 100%;
  }
  .simple_round {
    background: #d1d1d1 none repeat scroll 0 0;
    border-radius: 50%;
    color: #4b4b4b !important;
    height: 21px;
    padding: 0 0 0 1px;
    width: 21px;
  }
  .popup-box .popup-messages {
    background: #151829 none repeat scroll 0 0;
  }
  #support_chat_wrapper{
    height: 350px;
    overflow: auto;
  }

  .direct-chat-messages {
    padding: 10px;
    transform: translate(0px, 0px);
  }
  .popup-messages .chat-box-single-line {
    border-bottom: 1px solid #b43e38 ! important;
    height: 12px;
    margin: 7px 0 20px;
    position: relative;
    text-align: center;
  }
  .popup-messages abbr.timestamp {
    background: #b43e38  none repeat scroll 0 0;
    color: #fff;
    padding: 0 11px;
  }

  .popup-head-right .btn-group {
    display: inline-flex;
    margin: 0 8px 0 0;
    vertical-align: top !important;
  }
  .chat-header-button {
    background: #b43e38 none repeat scroll 0 0;
    border: 1px solid #b43e38;
    border-radius: 50%;
    font-size: 14px;
    height: 30px;
    width: 30px;
    COLOR: WHITE;
  }
  .popup-head-right .btn-group .dropdown-menu {
    border: medium none;
    min-width: 122px;
    padding: 0;
  }
  .popup-head-right .btn-group .dropdown-menu li a {
    font-size: 12px;
    padding: 3px 10px;
    color: #303030;
  }

  .popup-messages abbr.timestamp {
    background: #b43e38  none repeat scroll 0 0
    color: #fff;
    padding: 0 11px;
  }
  .popup-messages .chat-box-single-line {
    border-bottom: 1px solid #b43e38 ! important;
    height: 12px;
    margin: 7px 0 20px;
    position: relative;
    text-align: center;
  }
  .popup-messages .direct-chat-messages {
    height: auto;
  }
  .popup-messages .direct-chat-text {
    background: #dfece7 none repeat scroll 0 0;
    border: 1px solid #dfece7;
    border-radius: 2px;
    color: #1f2121;
  }
  .popup-messages .right .direct-chat-text {
    background: #fff none repeat scroll 0 0;
  }
  .right .direct-chat-text::after, .right .direct-chat-text::before {
  border-left-color: #fff;
}


  .popup-messages .direct-chat-timestamp {
    color: #fff;
    opacity: 0.6;
  }
  .popup-messages .left .direct-chat-timestamp {
    float: right;
  }
  .popup-messages .right .direct-chat-timestamp {
  float: left;
  }

  .popup-messages .direct-chat-name {
    font-size: 15px;
    font-weight: 600;
    color: #fff;
    opacity: 0.9;
  }

    .popup-messages .left  .direct-chat-name {
      margin: 0 0 0 49px !important;
    }
    .popup-messages .right .direct-chat-name {
      margin: 0 49px 0 0px !important;
      float: right;
    }
  .popup-messages .direct-chat-info {
    display: block;
    font-size: 12px;
    margin-bottom: 0;
  }
  .popup-messages  .big-round {
    margin: -9px 0 0 !important;
  }
  .popup-messages  .direct-chat-img {
    border: 1px solid #fff;
    background: #3f9684  none repeat scroll 0 0;
    border-radius: 50%;
    height: 40px;
    margin: -21px 0 0;
    width: 40px;
  }
  .left .direct-chat-img {
    float: left;
  }
  .right .direct-chat-img {
    float: right;
  }

  .direct-chat-reply-name {
    color: #fff;
    font-size: 15px;
    margin: 0 0 0 10px;
    opacity: 0.9;
  }

  .direct-chat-img-reply-small
  {
    border: 1px solid #fff;
    border-radius: 50%;
    float: left;
    height: 20px;
    margin: 0 8px;
    width: 20px;
    background:#b43e38!important;
  }

  .popup-messages .direct-chat-msg {
    margin-bottom: 10px;
    position: relative;
  }

  .popup-messages .doted-border::after {
    background: transparent none repeat scroll 0 0 !important;
    border-right: 2px dotted #fff !important;
    bottom: 0;
    content: "";
    left: 17px;
    margin: 0;
    position: absolute;
    top: 0;
    width: 2px;
     display: inline;
      z-index: -2;
  }

  .popup-messages .direct-chat-msg::after {
    /* background: #fff none repeat scroll 0 0;
    border-right: medium none;
    bottom: 0;
    content: "";
    left: 17px;
    margin: 0;
    position: absolute;
    top: 0;
    width: 2px;
     display: inline;
      z-index: -2; */
  }
  .direct-chat-text::after, .direct-chat-text::before {

    border-color: transparent #dfece7 transparent transparent;

  }
  .direct-chat-text::after, .direct-chat-text::before {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    border-color: transparent #d2d6de transparent transparent;
    border-image: none;
    border-style: solid;
    border-width: medium;
    content: " ";
    height: 0;
    pointer-events: none;
    position: absolute;
    right: 100%;
    top: 15px;
    width: 0;
  }
  .direct-chat-text::after {
    border-width: 5px;
    margin-top: -5px;
  }
  .popup-messages .direct-chat-text {
    background: #dfece7 none repeat scroll 0 0;
    border: 1px solid #dfece7;
    border-radius: 2px;
    color: #1f2121;
  }
  .direct-chat-text {
    background: #d2d6de none repeat scroll 0 0;
    border: 1px solid #d2d6de;
    border-radius: 5px;
    color: #444;
    margin: 5px 0 0 50px;
    padding: 5px 10px;
    position: relative;
  }

  .chat{
      margin-top: auto;
      margin-bottom: auto;
    }
    .card{
      height: 500px;
      border-radius: 15px !important;
      background-color: #fffcf3 !important;
    }
    .contacts_body{
      padding:  0.75rem 0 !important;
      overflow-y: auto;
      white-space: nowrap;
    }
    .main_chat span{
      color:white !important;
    }
    .main_chat p{
      color:white !important;
    }
    .msg_card_body{
      overflow-y: auto;
    }
    .card-header{
      border-radius: 15px 15px 0 0 !important;
      border-bottom: 0 !important;
      background:#b43e38!important;
    }
   .card-footer{
    border-radius: 0 0 15px 15px !important;
      border-top: 0 !important;
  }
    .container{
      align-content: center;
    }
    .search{
      border-radius: 15px 0 0 15px !important;
      border:0 !important;
      color:grey !important;
    }
    .search:focus{
         box-shadow:none !important;
       outline:0px !important;
    }
    .type_msg{
      background-color: #fffcf3 !important;
      border:0 !important;
      color:grey !important;
      height: 60px !important;
      overflow-y: auto;
    }
    .type_msg:focus{
        box-shadow:none !important;
        outline:0px !important;
        color:gray;
    }
    .attach_btn{
      border-radius: 15px 0 0 15px !important;
      background-color: #fffcf3 !important;
      border:0 !important;
      color: #b43e38 !important;
      cursor: pointer;
      font-size:30px;
      font-weight:bold;
    }
    .send_btn{
      border-radius: 0 15px 15px 0 !important;
      background-color: #fffcf3 !important;
      border:0 !important;
      color: #b43e38 !important;
      cursor: pointer;
      font-size:30px;
      font-weight:bold;
    }
    .search_btn{
      border-radius: 0 15px 15px 0 !important;
      background-color: rgba(0,0,0,0.3) !important;
      border:0 !important;
      color: white !important;
      cursor: pointer;
    }
    .contacts{
      list-style: none;
      padding: 0;
    }
    .contacts li{
      width: 100% !important;
      padding: 5px 10px;
      margin-bottom: 15px !important;
    }
    active{
      background-color: #fffcf3;
    }
    .user_img{
      height: 70px;
      width: 70px;
      border:1.5px solid #f5f6fa;
      object-fit: cover;

    }
    .user_img_msg{
      height: 40px;
      width: 40px;
      border:1.5px solid #f5f6fa;

    }
  .img_cont{
      position: relative;
      height: 60px;
      width: 70px;
      object-fit: cover;
  }
  .img_cont_msg{
      height: 40px;
      width: 40px;
  }
  i.fa.fa-star {
      position: absolute;
      top: 3.2em;
      left: 2.9em;
      color:yellow;
  }
  i.fa.fa-star.off {
      position: absolute;
      top: 3.9em;
      left: 3.3em;
      color:#e2e209;
  }
  .online_icon{
    position: absolute;
    height: 15px;
    width:15px;
    background-color: #4cd137;
    border-radius: 50%;
    bottom: 0.2em;
    right: 0.4em;
    border:1.5px solid white;
  }
  .offline{
    background-color: #c23616 !important;
  }
  .user_info{
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 15px;
  }
  .user_info a{
    font-size: 20px;
    color: grey;
    font-weight: bold;
  }
  .user_info p{
    font-size: 10px;
    color: rgba(255,255,255,0.6);
  }
  .video_cam{
    margin-left: 0px;
    margin-top: 5px;
  }
  .video_cam span{
    color: white;
    font-size: 20px;
    cursor: pointer;
    margin-right: 15px;
  }
  .msg_cotainer{
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 10px;
    border-radius: 25px;
    background-color: #151829;
    padding: 10px;
    position: relative;
    color:white;

  }
  .msg_cotainer_send{
    margin-top: auto;
    margin-bottom: auto;
    margin-right: 10px;
    border-radius: 25px;
    background-color: #ab2a1d;
    padding: 10px;
    position: relative;
    color: white;
  }
  .msg_time{
    position: absolute;
    left: 10px;
    bottom: -19px;
    color: grey;
    font-size: 10px;
  }
  .msg_time_send{
    position: absolute;
    right:0;
    bottom: -19px;
    color: grey;
    font-size: 10px;
  }
  .msg_head{
    position: relative;
  }
  .action_menu_btn{
    position: absolute;
    right: 10px;
    top: 10px;
    color: white;
    cursor: pointer;
    font-size: 20px;
  }
  .action_menu{
    z-index: 1;
    position: absolute;
    padding: 15px 0;
    background-color: #fffcf3;
    color: grey;
    border-radius: 15px;
    top: 30px;
    right: 15px;
    display: none;
    font-weight: bold;
  }
  .action_menu ul{
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .action_menu ul li{
    width: 100%;
    padding: 10px 15px;
    margin-bottom: 5px;
  }
  .action_menu ul li i{
    padding-right: 10px;
  }
  .action_menu ul li:hover{
    cursor: pointer;
    background-color: rgba(0,0,0,0.2);
  }

  .receiver_div > span {
    background-color: #f2f2f2;
    border-radius: 0 20px 20px;
    padding: 5px 20px;
    float: left;
  }

  .sender_div > span {
    background-color: #070725;
  color: #fff;
    border-radius: 20px 20px 0;
    padding: 5px 20px;
    float: right;
  }
  .chat_btn_send{
      height: auto;
  margin-top: 0;
  }

  .chat_row {
      margin: 15px 0;
      position: relative;
      display: inline-block;
          font-size: 12px;
  }
  .chat_wrapper{
    max-height: 300px;
      overflow-y: scroll;
      margin-bottom: 15px;
      min-height: 300px;
  }
  .message_time {
      position: absolute;
      top: -18px;
      color: #fff;
    font-size: 10px;
  }
  .receiver_div .message_time {
      left: 18px;
  }
  .sender_div .message_time {
      right: 18px;
  }
  .message{
    width: 100%;
  }

  .popup-messages-footer button:hover {
    background-color: transparent;
  }

  @media(max-width: 576px){
  .contacts_card{
    margin-bottom: 15px !important;
  }
  }
  
  
 /*************07092020***************/ 

 #aaa .col-sm-8.col-xs-12.panel-part span {
	color: #000;
    font-size: 28px;
	font-family: Oswald,sans-serif;
} 

.now_logged.wow.fadeIn.cover-background.background-position-center.top-space.star-search-cat {
    padding-top: 0px !important;
	padding-bottom: 40px !important;
}

.now_loggedout.wow.fadeIn.cover-background.background-position-center.top-space.star-search-cat {
    padding-top: 39px !important;
	padding-bottom: 40px !important;
}


 .blog-content {
    min-height: 72px !important;
    max-height: 72px !important;
}


.ovpasstitle.alt-font.post-title.text-medium.text-extra-dark-gray.width-100.display-block.md-width-100.margin-15px-bottom {
    min-height: 46px !important;
    max-height: 46px !important;
}

.author.mt-auto {
    min-height: 40px !important;
    max-height: 40px !important;
}

.author.mt-auto span {
    font-size: 13px !important;
    font-weight: 500;
}

section.wow.fadeIn.hover-option4.blog-post-style3 {
    padding-bottom: 40px !important;
}

@media screen and (max-width:768px) {
	.blog-content {
    min-height: 46px !important;
    max-height: 46px !important;
}


.ovpasstitle.alt-font.post-title.text-medium.text-extra-dark-gray.width-100.display-block.md-width-100.margin-15px-bottom {
    min-height: 48px !important;
    max-height: 48px !important;
}

.author.mt-auto {
    min-height: 17px !important;
    max-height: 17px !important
}

.wow.fadeIn.cover-background.background-position-center.top-space.star-search-cat {
    padding-bottom: 10px !important;
    padding-top: 3px !important;
}

}

.top-bg {
    border-bottom: 1px solid #b0a7a7 !important;
}


/********* social buzz - start promoting *******/

.message-box.align-sec .emoji-wysiwyg-editor.form-control {
    border: 3px solid rgb(255, 244, 28);
}

span.file-input.d-flex.align-items-center {
    height: 50px;
}

span.file-input.d-flex.align-items-center img {
    width: 80px;
}


element.style {
}
button:not(:disabled), [type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled) {
    cursor: pointer;
}

.social_buzz_submit_box button {
    background: #2aba3c;
    border: 0;
    border-radius: 4px;
    font-size: 16px;
    padding: 10px 45px;
    color: #fff;
    text-transform: uppercase;
    float: right;
}

.main-sec-listinhg {
    padding-bottom: 10px;
}

.chose_product {
    width: 100%;
}

.chose_product select {
    margin: 0px!important;
    padding: 0px;
}

span.file-input.d-flex.align-items-center img {
    width: 50px;
}

span.file-input {
    margin-top: 30px;
	width:55%;
}


@media screen and (max-width:475px) {
	
	span.file-input.d-flex.align-items-center {
    height: 85px;
	width:100% !important;
	}
	
	#social-buzz-form select#product_link {
    padding: 0;
	width:100% !important;
	}
	
	#social-buzz-form .input-sec {
    display:block !important;
	padding: 0px 10px  !important;
	}
	
}

@media screen and (min-width:768px) {
.talent-mall-ban .text-uppercase.alt-font.text-extra-dark-gray.margin-20px-bottom.font-weight-700.sm-width-100.xs-width-100.fnd-tlt-hr {
    text-align: right;
    padding-right: 13%;
}
}

/*** star buzz **/
.emoji-wysiwyg-editor.form-control:empty::before {
    content: attr(placeholder);
}

.emoji-wysiwyg-editor:active:before,
.emoji-wysiwyg-editor:focus:before {
    content: none;
}


.MsoListParagraphCxSpMiddle, .MsoListParagraphCxSpFirst, .MsoListParagraphCxSpLast {
    text-indent: 0px !important;
}

</style>