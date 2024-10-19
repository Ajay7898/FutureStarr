@extends('layouts.talent')
@section('front_page_head')
<style>


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
    height: 40px;
margin-top: 5px;
}

.chat_row {
    margin: 15px 0;
    position: relative;
    display: inline-block;
}
.chat_wrapper{
    max-height: 500px;
overflow-y: scroll;
margin-bottom: 15px;
}
.message_time {
    position: absolute;
    top: -22px;
}
.receiver_div .message_time {
    left: 18px;
}
.sender_div .message_time {
    right: 18px;
}
</style>
@endsection
@section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url({{ asset('assets/images/read-more/welcome-banner.jpg')}});">
  <div class="opacity-medium"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">

      </div>
    </div>
  </div>
</section>
  <div class="container about-us-container">
  <div class="row">
    <div class="col-sm-12 col-md-3">
      <ul>
        <li>support agent 1</li>
        <li>support agent 2</li>
      </ul>
    </div>
    <div class="col-sm-12 col-md-9">
      <div class="col-sm-12">
        <h2><i class="fas fa-comments"></i> Mesages - {{ $user->username }}</h2>
        <div class="portlet box dark">
            <div class="portlet-body table-responsive">
                <div class="col-md-12 ">

           <div class="col-md-12 dash_left dash_section chat_wrapper" id="chat_wrapper">


             @if(count($totalSorted)>0)
             @foreach($totalSorted as $message)
             <div class="col-md-12 chat_row {{ ($message->sender_id == Auth::user()->id)?"sender_div":"receiver_div" }} ">
                 <small class="message_time" >{{ date('dS M y, G:i', strtotime($message->created_at))}}</small>
                 <span>{{ $message->message }}</span>
             </div>
             @endforeach
             @else
             <div class="col-md-12 chat_row">
                 <span>Start Chat</span>
             </div>
             @endif

                    </div>
                    <div class="col-md-12">
                          <form id="regected-form" method="POST" onsubmit="sendMessage(event)">
                            <input type="hidden" id="receiver_id" value="3336">
                                <div class="col-md-12">
                                    <textarea rows="2" class="form-control" value="" placeholder="Type Message" required="" id="support_message" name="support_message"></textarea>
                                </div>
                                <div class="col-md-2">
                                  <button class="btn btn-primary chat_btn_send" type="submit"  > Send </button>
                                </div>
                            </form>
                    </div>


                               </div>

                                </div>
                            </div>


      </div>

    </div>
  </div>
</div>
<div class="container">
   <!-- Modal -->
  <div id="register_my_model" class="modal  modal-m pop" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header mob-cls">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5 text-center login-back">

                            <h4 class="mo-sign-awe">
                    Awe, looks like you have not
                </h4>
                            <h4 class="mo-sign-fr">signed up for Future Starr.</h4>
                            <p class="mo-now"><b>No worries, click the Register</b></p>
                            <p class="mo-now-fr"><b>button and sign up now for FREE!</b></p>

                            <!-- <button class="btn btn-danger btn-sm login-button" style="margin: 5% 0 0 21%;">REGISTER</button> -->
                            <a href="/register" class="btn btn-danger reg-mod"  (click)="model_toggle()">Register</a>
                        </div>
                        <div class="col-sm-7 text-center login-back-img">
                            <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>

                            <p class="closer-data"></p>
                            <h3 class="closer-data"></h3>
                            <p class="closer-data"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container">
   <!-- Modal -->
  <div id="register_my_model1" class="modal  modal-m pop" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header mob-cls">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5 text-center login-back">

                            <h4 class="mo-sign-awe">
                    Awe, looks like you have not
                </h4>
                            <h4 class="mo-sign-fr">signed up for Future Starr.</h4>
                            <p class="mo-now"><b>No worries, click the Register</b></p>
                            <p class="mo-now-fr"><b>button and sign up now for FREE!</b></p>

                            <!-- <button class="btn btn-danger btn-sm login-button" style="margin: 5% 0 0 21%;">REGISTER</button> -->
                            <a href="/register" class="btn btn-danger reg-mod"  (click)="model_toggle()">Register</a>
                        </div>
                        <div class="col-sm-7 text-center login-back-img">
                            <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>

                            <p class="closer-data"></p>
                            <h3 class="closer-data"></h3>
                            <p class="closer-data"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('front_page_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
$(document).ready(function(){
scrollToBottom();
 setInterval(function(){
  update_last_activity();
}, 5000);

});

function sendMessage(event)
 {
   event.preventDefault();
      $('.chat_btn_send').prop('disabled', true);
      $.ajax({
                  url: "{{ route(((Auth::user()->role_id == 4)?'seller':'buyer').'.chat.message.store') }}",
                  type: 'post',
                  data: {
                      'message': $('#support_message').val(),
                      'receiver_id': $('#receiver_id').val(),
                      '_token': "{{csrf_token()}}"
                  },
                  success: function (response) {
                    var date = moment(response.created_at);
                    var newDate = date.format("D MMM YY, h:mm");
                    html = '';
                    html += '<div class="col-md-12 chat_row sender_div">';
                    html += '<small class="message_time">'+newDate+'</small>';
                    html += '<span>'+response.message+'</span>';
                    html += '</div>';
                  $(".dash_section.chat_wrapper").append(html);
                  $('#support_message').val("");
                  scrollToBottom();

                  },
                  error: function (e) {
                      console.log('error', e);
                  }
              });
              $('.chat_btn_send').prop('disabled', false);


 }
function update_last_activity()
 {

   $.ajax({
                type: "GET",
                url: "<?php echo url(((Auth::user()->role_id == 4)?"seller":"buyer")."/api/get-unread/".Auth::user()->id."/3336"); ?>",
                data: '',
                success: function (data) {
                  if(data.received_messages != 0){
                    html = '';
                    $.each( data.received_messages, function( key, value ) {

                      var date = moment(value.created_at);
                      var newDate = date.format("D MMM YY, h:mm");

                      html += '<div class="col-md-12 chat_row receiver_div">';
                      html += '<small class="message_time">'+newDate+'</small>';
                      html += '<span>'+value.message+'</span>';
                      html += '</div>';

                    });
                    $(".dash_section.chat_wrapper").append(html);
                    scrollToBottom();
                  }
                }
            });
 }

 function scrollToBottom(){
 var chat_wrapper = $('#chat_wrapper');
   var height = chat_wrapper[0].scrollHeight;
   chat_wrapper.animate({
       scrollTop: height
   });
 }

</script>
@endsection
