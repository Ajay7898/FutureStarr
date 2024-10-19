<div class="direct-chat-msg right">
	<div class="direct-chat-info clearfix">
		<span class="direct-chat-name pull-right">&nbsp;</span>
		<span class="direct-chat-timestamp pull-left">{{ \Carbon\Carbon::parse($mess->created_at)->format('m/d/Y g:i A') }}</span>
	</div>
	<img class="direct-chat-img" src="{{ $mess->profile_pic ? asset($mess->profile_pic) : asset('/assets/images/profile.png') }}">
	<div class="direct-chat-text">
		<span style="display: block;">{{ $mess->message }}</span>
		@if($mess->message_media)
			@php
				$type = explode('.', $mess->message_media)[1];
			@endphp

			@if($type == 'jpg' || $type == 'jpeg' || $type == 'png' || $type == 'JPG' || $type == 'JPEG' || $type == 'PNG')
				<img src="{{ asset($mess->message_media) }}" style="width: 200px;" />
			@else
				<video width="200" height="160" controls style="width: 200px; height: 160px; min-height: 160px;">
				  	<source src="{{ asset($mess->message_media) }}" type="video/mp4">
				</video>
			@endif

		@endif
	</div>
</div>