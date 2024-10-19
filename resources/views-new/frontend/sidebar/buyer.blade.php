<style>
   .view{
	   border: none !important;
	   background: transparent !important;
	   color: black !important;
   }
   .view img{
	   
   }
.sidebar-btn div {
    flex-basis: 47%;
}
.sidebar-btn div {
    font-weight: 700 !important;
    background: #fff;
    display: block;
    padding: 3px;
    width: 100%;
    color: #ff503f;
    margin: 10px auto;
    border: 2px solid #ff503f;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
}
.sidebar-btn a {
    font-weight: 700 !important; 
    background: #fff; 
    display: block;
     padding:unset; 
     width: 100%; 
    color: #ff503f;
     margin: 10px auto; 
     border: none; 
     border-radius: 4px; 
    text-decoration: none;
}
.sidebar-btn div a {
    padding: 0!important;
    height: 100%;
    margin: 0!important;
    display: flex;
    justify-content: center!important;
    align-items: center!important;
}

.sidebar-btn div:hover {
    background: #ff503f;
    color: #fff;
}
.sidebar-btn {
    flex-wrap: wrap;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}



   </style>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
   <div class="buyer-acont">
     
      <h3>
            {{ Auth::user()->username }} 
      </h3>
   
        <img src="{{ !empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic) : asset('assets/images/buyer/b-acount.png') }}">
		
		<a class="view" href="{{ route('seller.chatMessagees')}}">
            <img style="width: 55px !important;
    height: 55px;
    border-radius: 0%;
    object-fit: contain;
    " alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/view.png') }}"><br/> Views <br/>({{profileViews(Auth::user()->id)}})
          </a>
      <p>
        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Purchases (${{buyerTotalPurchase(Auth::user()->id)}})
      </p>

      <p class="rider" data-toggle="modal" data-target="#exampleModalLong"><img style="width: 18px !important;
    height: 20px;
    border-radius: 0%;
    object-fit: contain;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}"> Riders ( {{ count(riders(!empty(Auth::check()) ? Auth::user()->id : '') ) }} )</p>

      <p  class="user-rider" data-toggle="modal" data-target="#user-rider"><img style="width: 18px !important;
    height: 20px;
    border-radius: 0%;
    object-fit: contain;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-blue.png') }}"> Following ( {{ count(following(!empty(Auth::check()) ? Auth::user()->id : '') ) }} )</p>

		<div class="sidebar-btn">
   <div>   <a href="javascript:void(0)" data-toggle="modal" data-target="#profile-imageModal">Change Profile Picture</a></div>
     <div> <a href="{{ route('buyer.edit') }}">Edit Account</a></div>
    <div>  <a href="{{ route('buyer.chatMessagees') }}">Messages</a></div>
     <div> <a href="{{ route('buyer.public.profile') }}" alt="public-profile">Manage Public Profile</a></div>

      <!-- <a style="background: #0f1d6b;color: white;padding: 10px;font-weight: bold;border-radius: 5px;" target="_blank" href="{{ route('buyer-public-profile', Crypt::encryptString(Auth::user()->id) ) }}">See Public Profile.</a> -->

      <a style="background: #0f1d6b;color: white;padding: 10px;font-weight: bold;border-radius: 5px;" target="_blank" href="{{ route('buyer-public-profile', 
      Auth::user()->public_profile ) }}">See Public Profile</a>
      </div>
   </div>
</div>

@include('frontend.sidebar.riders')

