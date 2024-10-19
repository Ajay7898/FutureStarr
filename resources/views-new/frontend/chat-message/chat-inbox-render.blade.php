@foreach($data['messages'] as $mess)
@if($cond == 'buy')
<a href="{{ url('/buyer/message') }}" onclick="return getMessage({{ $mess->username.', '.$mess->sent_by }});" class="user_img" data-username="{{ $mess->username }}" data-sent-id="{{ $mess->sent_by}}">
@elseif($cond == 'sell')
<a href="{{ url('/seller/message') }}" onclick="return getMessage({{ $mess->username.', '.$mess->sent_by }});" class="user_img"  data-username="{{ $mess->username }}" data-sent-id="{{ $mess->sent_by}}">
@else
<a href="javascript:void(0)" onclick="return getMessage({{ $mess->username.', '.$mess->sent_by }});" class="user_img"  data-username="{{ $mess->username }}" data-sent-id="{{ $mess->sent_by}}">
@endif
	<div class="chat_list">
		<div class="chat_people">
			@if (Cache::has('user_is_online_' . $mess->user_id))
			<div class="chat_img online">
			@else
			<div class="chat_img">	
			@endif
				<img src="{{ $mess->profile_pic ? asset($mess->profile_pic) : asset('assets/images/buyer/b-acount.png') }}" alt="{{ $mess->username }}">
			</div>

			<div class="chat_ib">
				<h5>{{ $mess->username }}
					<span class="unread-msg">{{ $mess->message_count }}</span>
					<span class="chat_date">{{ \Carbon\Carbon::parse($mess->created_at)->format('m/d/Y g:i A') }}</span>
				</h5>
				<p>{{ $mess->message }}</p>
			</div>
		</div>
	</div>
</a>
@endforeach