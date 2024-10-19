       <div class="buyer-acont">
         <h3>
               {{ Auth::user()->username ?: ''}}
         </h3>
 
        <img src="{{ !empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic) : asset('assets/images/buyer/b-acount.png') }}">
        
        <div class="seller-header-n">
          <p><a href="{{ route('seller.chatMessagees')}}"><i class="fa fa-envelope" aria-hidden="true"></i> Inbox <span class="msg-count-out">(<span class="msg-count">0</span>)</span></a></p>
          <p><a href="javascript:void(0)" data-toggle="modal" data-target="#seller-dashboard-award-modal"><i class="fa fa-trophy" aria-hidden="true" style="color: #ebc205;"></i> Awards ({{getSellerTalentAward(Auth::user()->id)}})</a></p>
        </div>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#profile-imageModal">Change Profile Picture</a>
        <a href="{{route('seller.edit')}}">Edit Account</a>
      </div>

      @include('frontend.sidebar.riders')