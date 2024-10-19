<div class="buyer-acont">
   <h3>
       {{ Auth::user()->username ?: ''}}
   </h3>
 
  <img src="{{ !empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic) : asset('assets/images/buyer/b-acount.png') }}">

   <p><i class="fa fa-shopping-cart" aria-hidden="true"></i> Purchases (${{buyerTotalPurchase(Auth::user()->id)}})</p>
   <a href="javascript:void(0)" data-toggle="modal" data-target="#profile-imageModal">Change Profile Picture</a>
   <a href="{{route('buyer.edit')}}">Edit Account</a>
</div>

@include('frontend.sidebar.riders')