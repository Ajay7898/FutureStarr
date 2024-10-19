@foreach($messages as $mess)
	<div class="get-all-users" style="margin-bottom: 15px;">
		<div class="col-sm-3 col-md-3 col-xs-3 get-all-users-mob1">
			@if($mess->role_id == 3)
				<a target="_blank" href="{{ url('buyer/'.$mess->public_profile) }}">
			@elseif($mess->role_id == 4)
				<a target="_blank" href="{{ url('seller/'.$mess->public_profile) }}">
			@else
				<a target="_blank" href="javascript:void(0);">
			@endif
				<img class="sidebar-pic" src="{{ $mess->profile_pic ? asset($mess->profile_pic) : asset('/assets/images/profile.png') }}">
			</a>
		</div>
		<div class="col-sm-8 col-md-8 col-xs-8 get-all-users-mob2" style="cursor: pointer; margin-left: -15px;">
			<p class="ttlusr" style="margin-bottom: 0; margin-top: -7px;">{{ $mess->username }}</p>
			<p style="margin-bottom: 0; margin-top: -7px; font-size: 11px !important; color: #999 !important;">{{ \Carbon\Carbon::parse($mess->created_at)->format('m/d/Y g:i A') }}</p>
			<p class="faded-text" style="text-align: left; color: #999; margin-bottom: 0; margin-top: -7px; color: #777 !important;">{{ $mess->message }}</p>
		</div>
		<div class="col-sm-1 col-md-1 col-xs-1" style="cursor: pointer; margin-right: -15px;">
			<div class="message-point">
				<span class="message-check">
					<input name="remember" type="checkbox" data-sid="{{ $mess->sent_by }}" data-mid="{{ $mess->id }}">
				</span>
				<span class="message-del">
					<a href="javascript: void(0);" onclick="return deletemessage({{ $mess->sent_by.', '.$mess->id }} );">
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>
				</span>
			</div>
		</div>
	</div>
@endforeach