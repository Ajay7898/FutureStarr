@extends('admin.common')

@section('title', 'Chat Support')

@section('admin_page_head')
<style>
.att_link{
  color: blue !important;
}

  a#get_file {
  	text-align: center;
  	cursor: pointer;
  	margin-top: 5px;
  	color: #fff;
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
.chat_user_ul{
  border: 1px solid;
  padding: 0;
  max-height: 600px;
overflow-y: scroll;

}
.chat_user_li{
  cursor: pointer;
  border-bottom: 1px solid;
  list-style-type: none;
  padding: 5px;
}
.unread_msg{
  line-height: 1;
}
.active_chat.chat_user_li {
	background: #f2f2f2;
}
</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title"><i class="fas fa-comments"></i> Chat Support</h3>
         </div>
         <!-- /.card-header -->
         <div class="card">
            <div class="row">
               <div class="col-sm-3 col-md-3 pr-0">
                  <!-- general form elements disabled -->
                  <!-- /.card-header -->
                  <div class="card-body">
                     <ul class="chat_user_ul">
                       @foreach($data['sorted_user'] as $suser)
                       <li onclick="switchUser({{$suser->id}})" id="chat_user_{{ $suser->id }}"  class="{{ ($suser->id == $user->id)?"active_chat":"" }} chat_user_li">
                         {{ $suser->first_name ." " . $suser->last_name}}
                         @php
                         if(isset($suser->total_support_chats)){
                           $total_unread_chats =  $suser->total_support_chats - $suser->total_read;
                         }else{
                           $total_unread_chats =  0;
                         }

                         @endphp
                         <div class="unread_msg">
                         @if($total_unread_chats != 0 && $suser->id != $user->id)
                          <small><i>{{ $total_unread_chats }} New Messages.</i></small>
                          @endif
                          </div>
                       </li>
                       @endforeach
                     </ul>
                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
               </div>
               <div class="col-sm-12 col-md-9 pl-0">
                  <!-- general form elements disabled -->
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="col-md-12">

                    <div class="portlet box dark">

                        <div class="portlet-body table-responsive">
                            <div class="col-md-12 ">

                       <div class="col-md-12 dash_left dash_section chat_wrapper" id="chat_wrapper">


                         @if(count($totalSorted)>0)
                         @foreach($totalSorted as $message)
                         <div class="col-md-12 chat_row {{ ($message['sender_id'] == Auth::user()->id)?"sender_div":"receiver_div" }} ">
                             <small class="message_time" >{{ date('dS M y, G:i', strtotime($message['created_at']))}}</small>
                             <span>
                               {!! $message['message'] !!}
                               @if($message['message_media'] !== null)
                               <br><a class="att_link" href="{{ url($message['message_media']) }}" target="_blank" title="{{ basename($message['message_media']) }}"><i class="fa fa-paperclip"></i> Attachment</a>
                               @endif
                             </span>
                         </div>
                         @endforeach
                       </div>
                   <div class="col-md-12">
                         <form id="form_send_message" method="POST" onsubmit="sendMessage(event)">
                           <input type="hidden" id="receiver_id" name="receiver_id" value="{{ $user->id }}">
                           <input type="hidden" name="_token" id="csrf-token" value="{{csrf_token()}}" />
                               <div class="col-md-12">
                                   <textarea rows="2" class="form-control" value="" placeholder="Type Message" required="" id="message" name="message"></textarea>
                               </div>
                               <div class="col-md-2">
                                 <input type="file" name="support_attach" id="support_attach">
                                 <div id="supportattachname" style="display:none;"><small>Select a file</small> <div onclick="fileRemove()"><i class="fa fa-times"></i></div></div>
                                 <a class="btn btn-primary" onclick="openFileInput();" id="get_file"><i class="fa fa-paperclip"></i> </a>
                                 <button class="btn btn-primary chat_btn_send" type="submit"  > Send </button>
                               </div>
                           </form>
                   </div>
                         @else
                         <div class="col-md-12 chat_row">
                             <span>Not any Data</span>
                         </div>
                         @endif


                                           </div>

                                            </div>
                                        </div>
                                    </div>

                  </div>
                  <!-- /.card -->
                  <!-- /.card -->
               </div>
            </div>

         </div>
         <!-- /.card -->
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section('admin_page_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/locale/es-us.min.js" type="text/javascript"></script>
<script>

function openFileInput(){
  document.getElementById('support_attach').click();
}
$('#support_attach').change(function (e) {
    var fileName = e.target.files[0].name;
    $('#supportattachname small').html(fileName);
    $('#supportattachname').show();
});

function fileRemove() {
  $('#support_attach').val(null);
  $('#supportattachname small').html("");
  $('#supportattachname').hide();
}

$(document).ready(function(){
scrollToBottom();
 setInterval(function(){
  update_last_activity();
}, 5000);

});

function sendMessage(event)
 {
   event.preventDefault();
   var formData = new FormData(document.getElementById("form_send_message"));

      $('.chat_btn_send').prop('disabled', true);

      $.ajax({
                  url: "{{ route('admin.chat.message.store') }}",
                  type: 'post',
                  data: formData,
                 async: false,
                 cache: false,
                 contentType: false,
                 enctype: 'multipart/form-data',
                 processData: false,
                  success: function (response) {

                    var date = moment(response.created_at);
                    var newDate = date.format("D MMM YY, h:mm");
                    file_html = '';
                    if(response.message_media !== null){
                      file_url = "<?php echo url('/') ?>/" + response.message_media;
                      file_html +='<br><a class="att_link" href="'+file_url+'" target="_blank" title="'+file_url.split("/").pop()+'"><i class="fa fa-paperclip"></i> Attachment</a>';
                    }
                    html = '';
                    html += '<div class="col-md-12 chat_row sender_div">';
                    html += '<small class="message_time">'+newDate+'</small>';
                    html += '<span>';
                    html += response.message;
                    html += file_html;
                    html += '</span>';
                    html += '</div>';
                  $(".dash_section.chat_wrapper").append(html);
                  $('#message').val("");
                  scrollToBottom();
                  fileRemove();

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
                url: "<?php echo url("admin/chat_support/api/get-unread/".Auth::user()->id); ?>/"+$('#receiver_id').val(),
                data: '',
                success: function (data) {

                  if(data.sorted_user.length != 0){

                    html = '';
                    $.each( data.sorted_user, function( key, value ) {

                      if( value.id == $('#receiver_id').val() ){
                        var class_name = 'active_chat';
                        active_html = '';
                        active_html += '<li onclick="switchUser('+value.id+')" id="chat_user_'+value.id+'"  class="'+class_name+' chat_user_li">';
                        active_html += value.first_name +' '+ value.last_name;
                        active_html += '</li>';
                        html = active_html + html;

                      }else {
                        var class_name = '';
                        html += '<li onclick="switchUser('+value.id+')" id="chat_user_'+value.id+'"  class="'+class_name+' chat_user_li">';
                        html += value.first_name +' '+ value.last_name;
                        if(value.unread_messages != 0){
                        html += '<div class="unread_msg">';
                        html += '<small><i>'+value.unread_messages+' New Messages.</i></small>';
                        html += '<div>';
                        html += '</li>';
                      }
                    }
                    });
                    $('.chat_user_ul').html(html);
                  }

                  if(data.received_messages.length != 0){
                    html = '';
                    $.each( data.received_messages, function( key, value ) {

                      var date = moment(value.created_at);
                      var newDate = date.format("D MMM YY, h:mm");
                      file_html = '';
                      if(value.message_media !== null){
                        file_url = "<?php echo url('/') ?>/" + value.message_media;
                        file_html +='<br><a class="att_link" href="'+file_url+'" target="_blank" title="'+file_url.split("/").pop()+'"><i class="fa fa-paperclip"></i> Attachment</a>';
                      }

                      html += '<div class="col-md-12 chat_row receiver_div">';
                      html += '<small class="message_time">'+newDate+'</small>';
                      html += '<span>';
                      html += value.message;
                      html += file_html;
                      html += '</span>';
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

function switchUser(user_id){
  $('.chat_user_li').removeClass('active_chat');
  $('#chat_user_'+user_id).addClass('active_chat');
  $('#receiver_id').val(user_id);

  $.ajax({
               type: "GET",
               url: "<?php echo url('admin/chat_support/api/get-chat/'.Auth::user()->id); ?>/" + $('#receiver_id').val(),
               data: '',
               success: function (data) {
                 if(data != 0){
                   html = '';
                   $.each( data, function( key, value ) {

                     var date = moment(value.created_at);
                     var newDate = date.format("D MMM YY, h:mm");

                     if( value.sender_id == $('#receiver_id').val() ){
                       var class_name = 'receiver_div';
                     }else {
                       var class_name = 'sender_div';
                     }
                     file_html = '';
                     if(value.message_media !== null){
                       file_url = "<?php echo url('/') ?>/" + value.message_media;
                       file_html +='<br><a class="att_link" href="'+file_url+'" target="_blank" title="'+file_url.split("/").pop()+'"><i class="fa fa-paperclip"></i> Attachment</a>';
                     }

                     html += '<div class="col-md-12 chat_row '+class_name+' ">';
                     html += '<small class="message_time">'+newDate+'</small>';
                     html += '<span>';
                     html += value.message;
                     html += file_html;
                     html += '</span>';
                     html += '</div>';

                   });
                   $(".dash_section.chat_wrapper").html(html);
                   scrollToBottom();
                 }
               }
           });

}

</script>
@endsection
