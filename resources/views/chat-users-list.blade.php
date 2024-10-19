<div class="input-group search_data">
   <input style="display: block;width: auto;" type="text" placeholder="Search..." name="" class="form-control search chat-s-onup" value="" id="myInput">
   <div  class="input-group-prepend">
      <span style="padding: 1.375rem 1.75rem;" class="input-group-text search_btn"><i class="fas fa-search"></i></span>
   </div>
</div>
<ul class="contacts" id="contacts">
   @if(count($fav_users) > 0)
   <h6 style="font-size: 15px;padding: 0 0 0 12px;">Super Star</h6>
   @foreach($fav_users as $key => $user) 
       @if($user->role_id == '4')
          @php 
             $profile_link = route('seller-public-profile', $user->public_profile )
          @endphp
       @elseif($user->role_id == '3')
            @php 
              $profile_link = route('buyer-public-profile', $user->public_profile ) 
           @endphp
       @else
           @php $profile_link = 'javascript:void(0)' @endphp
   @endif
   <li class="active">

      @if(Cache::has('user_is_online_' . $user->user_id))
            @php $on_off =  'online' @endphp
      @else 
            @php $on_off =  'offline' @endphp
      @endif
      <a href="javascript:void(0);"  class="chat-toggle" data-id="{{ $user->user_id }}" data-user="{{ $user->username }}" data-imgsrc="{{ !empty($user->profile_pic) && file_exists($user->profile_pic) ? asset($user->profile_pic) : url('assets/images/star-logo.png') }}" data-plink="{{ $profile_link }}" data-onoff="{{ $on_off }}" data-email="{{ $user->email }}">
      <div class="d-flex bd-highlight">
         <div class="img_cont">
            <img src="{{ !empty($user->profile_pic) && file_exists($user->profile_pic) ? asset($user->profile_pic) :  url('assets/images/star-logo.png') }}" class="rounded-circle user_img" id="xxx">
            @if(Cache::has('user_is_online_' . $user->user_id))
            @php $on_off =  'online' @endphp
            <span><i class="fa fa-star text-success" aria-hidden="true"></i></span>
            @else 
            @php $on_off =  'offline' @endphp
            <span><i class="fa fa-star text-warning" aria-hidden="true"></i></span>
            @endif
         </div>
         <div class="user_info">
          
            {{ $user->username ?: '' }}
            </a>
            <a href="javascript:void(0)" class="remove-fav-user" data-id="{{$user->user_id}}" title="Click to remove from Super Star list.">
            <i class="fa fa-heart text-danger"></i>
            </a>
            @if(Cache::has('user_is_online_' . $user->user_id))
            <p>online</p>
            @else 
            <p>offline</p>
            @endif
         </div>
      </div>
    </a>
   </li>
   @endforeach
   @endif
   @if(count($users) > 0)
   <h6 style="font-size: 15px;padding: 0 0 0 12px;">Chats</h6>
   @foreach($users as $key => $user) 
       @if($user->role_id == '4')
          @php 
             $profile_link = route('seller-public-profile', $user->public_profile )
          @endphp
       @elseif($user->role_id == '3')
          @php 
             $profile_link = route('buyer-public-profile', $user->public_profile ) 
          @endphp
          
       @else
           @php $profile_link = 'javascript:void(0)' @endphp
   @endif
   <li class="active">
      @if(Cache::has('user_is_online_' . $user->user_id))
            @php $on_off =  'online' @endphp
      @else 
            @php $on_off =  'offline' @endphp
      @endif

     <a href="javascript:void(0);"  class="chat-toggle" data-id="{{ $user->user_id }}" data-user="{{ $user->username }}" data-imgsrc="{{ !empty($user->profile_pic) && file_exists($user->profile_pic) ? asset($user->profile_pic) : url('assets/images/star-logo.png') }}" data-plink="{{ $profile_link }}" data-onoff="{{ $on_off }}" data-email="{{ $user->email }}">
      <div class="d-flex bd-highlight">
         <div class="img_cont">
            <img src="{{ !empty($user->profile_pic) && file_exists($user->profile_pic) ? asset($user->profile_pic) :  url('assets/images/star-logo.png') }}" class="rounded-circle user_img" id="xxx">
            @if(Cache::has('user_is_online_' . $user->user_id))
            @php $on_off =  'online' @endphp
            <span><i class="fa fa-star text-success" aria-hidden="true"></i></span>
            @else 
            @php $on_off =  'offline' @endphp
            <span><i class="fa fa-star text-warning" aria-hidden="true"></i></span>
            @endif
         </div>
         <div class="user_info">
           
            {{ $user->username ?: '' }}
            </a>
            @if(Cache::has('user_is_online_' . $user->user_id))
            <p>online</p>
            @else 
            <p>offline</p>
            @endif
         </div>
      </div>
    </a>
   </li>
   @endforeach
   @endif
   @if(count($users) ==0 && count($fav_users) == 0)
   <p class="text-danger text-center">No conversation available.</p>
   @endif
</ul>