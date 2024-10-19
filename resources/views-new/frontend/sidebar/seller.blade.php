<style>
   .view{
	   border: none !important;
	   background: transparent !important;
	   color: black !important;
   }
   .view img{
	   
   }
   .sidebar-btn {
    flex-wrap: wrap;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
.sidebar-btn a {
    flex-basis: 47%;
}
   </style>
   
   <div class="col-md-4 col-sm-4 col-xs-12">
     <div class="buyer-acont seller-sec">
      <h3>
        {{ Auth::user()->first_name ?: ''}}&nbsp; {{ Auth::user()->last_name ? : ''}}
      </h3>

      <img src="{{ !empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic) : asset('assets/images/buyer/b-acount.png') }}" alt="profileImage">
	  
	   <a class="view" href="{{ route('seller.chatMessagees')}}">
            <img style="width: 55px !important;
    height: 55px;
    border-radius: 0%;
    object-fit: contain;
    " alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/view.png') }}"><br/> Views <br/>({{profileViews(Auth::user()->id)}})
          </a>
      <div class="seller-header-n">
        <p>
          <a href="{{ route('seller.chatMessagees')}}">
            <i class="fa fa-envelope" aria-hidden="true"></i> Inbox <span class="msg-count-out">(<span class="msg-count">0</span>)</span>
          </a>
        </p>
        <p>
         <a class="" href="javascript:void(0)">
           <img style="width: 25px !important;
           height: 20px;
           border-radius: 0%;
           object-fit: contain;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/today_revenu.svg') }}"> Sales ( {{ dailySales() }} )
         </a>
       </p>
       <p>
         <a class="rider" data-toggle="modal" data-target="#exampleModalLong">
           <img style="width: 25px !important;
           height: 20px;
           border-radius: 0%;
           object-fit: contain;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}"> Riders ( {{ count(riders(!empty(Auth::check()) ? Auth::user()->id : '') ) }} )
         </a>
       </p>
       <p>
        <a  class="user-riders" data-toggle="modal" data-target="#user-rider">
          <img style="width: 25px !important;
          height: 20px;
          border-radius: 0%;
          object-fit: contain;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-blue.png') }}"> Following ( {{ count(following(!empty(Auth::check()) ? Auth::user()->id : '') ) }} )
        </a>
      </p>
      <p>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#seller-dashboard-award-modal">
          <i class="fa fa-trophy" aria-hidden="true" style="color: #ebc205;"></i> Awards ({{ getSellerTalentAward(Auth::user()->id) }})
        </a>
      </p>

    </div>
<div class="sidebar-btn">
    <a href="javascript:void(0)" data-toggle="modal" data-target="#profile-imageModal">Change Profile Picture</a>
    <a href="{{route('seller.edit')}}">Profile Setting</a>

    <a href="{{route('seller.public.profile')}}">Manage Public Profile</a>

    <a style="background: #0f1d6b;color: white;padding: 10px;font-weight: bold;border-radius: 5px;" target="_blank"  href="{{ route('seller-public-profile', Auth::user()->public_profile ) }}"><i class="fa fa-eye"></i>&nbsp;See Public Profile</a>

  </div>
  </div>
</div>

@section('javascript')
  <script type="text/javascript">
    get_inbox_users();
    function get_inbox_users() {
      jQuery.ajax({
         type: "GET",
         url: '{!! url("buyer-seller/inbox-message/same") !!}',
         success: function(response) {
              jQuery(".msg-count").html(response['count']);

         },
         error: function(data){
           toastr.error('Bad Request.');
         }
      });
    }
  </script>
@endsection

@include('frontend.sidebar.riders')