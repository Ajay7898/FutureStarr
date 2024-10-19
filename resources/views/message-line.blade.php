@if($message->from_user == \Auth::user()->id)

<div class="d-flex justify-content-end mb-4 base_sent" data-message-id="{{ $message->id }}">
    <div class="msg_cotainer_send">
        {!! $message->content !!}
        <span class="msg_time_send">{{ $message->created_at->diffForHumans() }}</span>
    </div>
    <div class="img_cont_msg">
        <img src="{{ !empty($message->fromUser->profile_pic) ? asset($message->fromUser->profile_pic) : url('assets/images/star-logo.png') }}" class="rounded-circle user_img_msg">
    </div>
</div>

@else

<div class="d-flex justify-content-start mb-4 base_receive" data-message-id="{{ $message->id }}">
    <div class="img_cont_msg">
        <img src="{{ !empty($message->fromUser->profile_pic) ? asset($message->fromUser->profile_pic) : url('assets/images/star-logo.png') }}" class="rounded-circle user_img_msg">
    </div>
    <div class="msg_cotainer">
         {!! $message->content !!}
     <span class="msg_time">{{ $message->created_at->diffForHumans() }}</span>
 </div>
</div>

@endif