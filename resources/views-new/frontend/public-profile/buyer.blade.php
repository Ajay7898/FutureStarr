@extends('layouts.talent') 
@section('title', $user['username'].' | FutureStarr')
@section('content')
<style>
   ul.seller_data_left_ul {
   flex-direction: column!important;
   }
   ul.seller_data_left_ul li {
   margin-bottom:10px;
   }
   .p-1 div {
   flex-direction: column;
   display: flex;
   justify-content: center;
   align-items: center;
   }
   .buyer .rd {
   margin: 10px 0 0 0;
   width: 100%;
   }
   .buyer ul.seller_data_left_ul.seller_data_left_ul {
   width: 100%;
   padding: 0px;
   }
   .buyer ul.seller_data_left_ul li.seller_data_left_li{
   width: auto!important;
   margin: 0 0 10px 0!important;
   }
   .pd0 {
   padding: 0px!important;
   }
   section.seller-profile.pd0 {
   padding: 30px 0 0 0px!important;
   }
   .sta-r i.fa.fa-star {
   color: red;
   }
   .sta-r i.fa.fa-star {
   position: unset;
   }
   label.label_pro {
   padding-top:20px	 
   /* position: absolute;
   left: 20px; */
   }
   .chose_product select {
   margin-top: 5px!important;
   }
   .input-sec {
   position: relative;
   }
   p.loc-dd {
    color: #fff!important;
    font-size: 18px!important;
}
</style>
<!-- banner start -->
<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url({{ !empty($user['banner_image']) ? asset($user['banner_image']) : asset('assets/images/maxresdefault.jpg') }}); height: 350px !important;"></section>

<!--<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url(http://127.0.0.1:8000/assets/images/bann1.jpg); height: 350px !important;"></section>-->

<section class="seller-profile pd0 ht-300 margin-top-negative">
   <div class="container">
   <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 star-background-image">
         <div class="seller_data">
            <div class="public-profile-main">
               <div class="seller_data_left no-left">
                  <img src="{{ !empty($user['profile_pic']) && file_exists($user['profile_pic']) ? asset($user['profile_pic']) : url('assets/images/star-logo.png') }}" width="250px" alt="profileImage" class="buyer-dd1">
				  
				<img src="/assets/images/star.png" width="250px" alt="profileImage" class="buyer-dd" >
                  </div>
               </div>
               </div>
               </div>
			   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
			     <div class="seller_data_left pt-4 pb-4 right-sec-buyer">
            	<div class="star-right-dd">
					<h1 class="username-dd">{{ $user['username'] ? : '' }}</h1>
					<p class="loc-dd">{{ $user['city'] ? : '' }} / <!-- {{ $user['country'] ? : '' }}/ -->{{ $user['state'] ? : '' }}</p>
					</div>

                  
                  <!--<p class="join_date">{{  \Carbon\Carbon::parse($user['created_at'])->format('d/m/Y') }} (Joined)</p>
                  <div class="view_buyer_btn col-md-6">
                     <img alt="commercial Ads" class="view-img" src="{{ asset('assets/images/view.png') }}"> <br/>
                     <p>Views({{ $profile_views }})</p>
                  </div>-->
               </div>
			  </div>
		</div>
   </div>
</section>

<section class="seller-profile pd00">
<div class="container">
			   <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
               <div class="seller_data_right pt-4">
                  <div class="seller_data_right-inner">
                     <h3>Video Bio</h3>
                     @if($user['bio_video'] && file_exists($user['bio_video']))
                     <video width="400" poster="{{ asset('assets/images/futurestarrlogo.jpg') }}" controls controlsList="nodownload" autoplay>
                        <source src="{{ asset($user['bio_video']) }}" id="video_here">
                        Your browser does not support HTML5 video.
                     </video>
                     @else
                     <img src="{{ asset('assets/images/futurestarrlogo.jpg') }}" class="round-rect" alt="profileImage">
                     <h5 class="buyer-h5-vid"><i class="fa fa-video-camera" aria-hidden="true"></i><br/><br/>No video available</h5>
                     @endif
                  </div>
               </div>
            </div>
         </div>
		 </div>
		 </section>

<section class="knowledge-section mg-top-dd">
   <div class="container">
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-3">
         <div class="seller_data_left_ul_main">
            <ul class="seller_data_left_ul">
               <li class="seller_data_left_li">                           
                  <img alt="Views" src="{{ asset('assets/images/view.png') }}">
                  <a>Views ({{buyerPurchased($user['id'])}})</a>
               </li>
               <li class="seller_data_left_li">                           
                  <img alt="Purchases" src="{{ asset('assets/images/star_red_purchase.png') }}">
                  <a>PURCHASES ({{buyerPurchased($user['id'])}})</a>
               </li>
               <li class="seller_data_left_li">                          
                  <a> <img alt="Riders" src="{{ asset('assets/images/star_green.png') }}"> RIDERS ({{ count($riders) }})</a>
               </li>
               <li class="seller_data_left_li">                           
                  <a><img alt="Following" src="{{ asset('assets/images/star_blue.png') }}">FOLLOWING ({{$following}})</a>
               </li>
            </ul>
         </div>
         <div class="bio_info">
            <div class="text-left">
               <h3 style="color:#000!important;">Bio Info</h3>
               <p class="bio-details-content">{{ $user['description'] ?: '' }} </p>
            </div>
            <div class="p-1">
               <div class="text-center">
                  @if(!empty(Auth::check()))
                  <button type="button" class="btn btn-primary msgme"  data-toggle="modal" data-target="#sendMessage">Message me</button>
                  <a type="button" class="btn btn-primary rd"  data-toggle="modal" data-target="#riderModal"> <img alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">  Riders</a>
                  @else
                  <button type="button" class="btn btn-primary msgme" data-toggle="modal" data-target="#register_my_model"> Message me</button>
                  <a type="button" class="btn btn-primary rd" data-toggle="modal" data-target="#register_my_model"> <img  alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">  Riders</a>
                  @endif
               </div>
            </div>
         </div>
         <br>
         
      </div>
         <div class="col-md-1 col-lg-1 hide-space">
            <p>Space</p>
         </div>	  
	  
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8  buzz-middle new">
         <div class="dash-heading">
            <h1> 
                  {{ $user['username'] }} - Trending
            </h1>
         </div>
         <div class="listing-buzz row">
            <div class="col-md-12">
              
               @if(count($socialBuzzList) >0 )
               <?php $i = 1; 
                  $j = 1;
                  $k = 0;
                  $c= 1;
                  ?>
               @foreach($socialBuzzList as $socialbuzzList)
               @if($socialbuzzList->getUserData['role_id'] == '4')
               @php 
               $profile_link = route('seller-public-profile', $socialbuzzList->getUserData['public_profile'] )
               @endphp
               @elseif($socialbuzzList->getUserData['role_id'] == '3')
               @php 
               $profile_link = route('buyer-public-profile', $socialbuzzList->getUserData['public_profile'] ) 
               @endphp
               @else
               @php $profile_link = 'javascript:void(0)' @endphp
               @endif
               <div class="main-sec-listinhg">
                 
                  <div class="message-box align-sec">
                     <div class="dash-heading colorClass">
                        <h3>{{$socialbuzzList->comment}}</h3>
                     </div>
                     @if(!empty($socialbuzzList->product_link))                 
                     <!--  <span>
                        <h4>Product Link:</h4>
                        <a target="_blank" href="{{$socialbuzzList->product_link}}">{{$socialbuzzList->product_link}}</a>
                        </span> -->
                     @endif
                     @if (strpos($socialbuzzList->product_img_path, '.jpg') !== false || strpos($socialbuzzList->product_img_path, '.jpeg') !== false || strpos($socialbuzzList->product_img_path, '.png') !== false) 
                     @if(!empty($socialbuzzList->product_img_path) && file_exists($socialbuzzList->product_img_path)) 
                     <img class="img-fluid" src="{{ URL::asset($socialbuzzList->product_img_path)}}" alt="Social Media Images">
                     @endif
                     @endif
                     @if(strpos($socialbuzzList->product_img_path, '.mp4') !== false)
                     <video id="my-player" oster="{{asset('assets/images/music-background.png')}} style="width: 100%" controls>
                     <source src="{{asset($socialbuzzList->product_img_path)}}" type="video/mp4">
                     <source src="{{asset($socialbuzzList->product_img_path)}}" type="video/ogg">
                     Your browser does not support
                     HTML5 video.
                     </video>
                     @endif
                     @if(strpos($socialbuzzList->product_img_path, '.mp3') !== false || strpos($socialbuzzList->product_img_path, '.mp3') !== false)
                     <video id="my-player" poster="{{asset('assets/images/talent-mall/audio-bg.png')}}" style="width: 100%" controls preload="auto" autobuffer>
                        <source src="{{asset($socialbuzzList->product_img_path)}}" type="audio/mp3">
                        <source src="{{asset($socialbuzzList->product_img_path)}}" type="audio/ogg">
                        Your browser does not support
                        HTML5 video.
                     </video>
                     @endif
                  </div>
                  <div class="socail-box">
                     <ul>
                        @if($check==true)
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#giveAward<?php echo $i; ?>">
                           <li><img src="{{ asset('assets/images/social-buzz/cup.png')}}" alt="award">&nbsp;{{ count($socialbuzzList->getSocialBuzzAwards)}}&nbsp;Awards</li>
                        </a>
                        @else 
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                           <li><img src="{{ asset('assets/images/social-buzz/cup.png')}}" alt="award">&nbsp;{{ count($socialbuzzList->getSocialBuzzAwards)}}&nbsp;Awards</li>
                        </a>
                        @endif
                        @if($check==true) 
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#comment<?php echo $i; ?>">
                           <li><img src="{{ asset('assets/images/social-buzz/chat.png')}}" alt="chat">&nbsp;{{ count($socialbuzzList->getSocialBuzzComments)}}&nbsp;Comments</li>
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#shareModal<?php echo $i; ?>">
                           <li><img src="{{ asset('assets/images/social-buzz/share.png')}}" alt="Share"> Share</li>
                        </a>
                        @php 
                        $url = $socialbuzzList->product_link;
                        $host = explode('/',$url); 
                        $talent_id = !empty($host[5])?$host[5]:'';
                        @endphp
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#purchaseModal<?php echo $i; ?>">
                           <li><img src="{{ asset('assets/images/social-buzz/cart.png')}}" alt="Cart"> @php $count = totalPurchasePerTalent($talent_id) @endphp {{ $count}} Purchase</li>
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#ridersModal<?php echo $i; ?>">
                           <li><img class="riders" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">&nbsp;{{ count($socialbuzzList->getSocialBuzzRiders)}}&nbsp;Riders</li>
                        </a>
                        @else 
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                           <li><img src="{{ asset('assets/images/social-buzz/chat.png')}}" alt="chat">&nbsp;{{ count($socialbuzzList->getSocialBuzzComments)}}&nbsp; Comments</li>
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                           <li><img src="{{ asset('assets/images/social-buzz/share.png')}}" alt="Share"> Share</li>
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                           <li><img src="{{ asset('assets/images/social-buzz/cart.png')}}" alt="Cart"> Purchase</li>
                        </a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                           <li><img class="riders" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">&nbsp;{{ count($socialbuzzList->getSocialBuzzRiders)}}&nbsp;Riders</li>
                        </a>
                        @endif    
                     </ul>
                     <div class="report-sec">
                        @if($check==true)
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#reportUser<?php echo $i; ?>">
                        <img src="{{ asset('assets/images/social-buzz/flag.png')}}" alt="Report"> Report
                        </a>
                        @else
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                        <img src="{{ asset('assets/images/social-buzz/flag.png')}}" alt="Report"> Report
                        </a>
                        @endif
                     </div>
                  </div>                    
               </div>
              
               <!-- Comment Modal -->
               <div class="modal fade" id="comment<?php echo $j;?>" role="dialog" data-keyboard="false" data-backdrop="static">
                  <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Leave a comment</h4>
                        </div>
                        <div class="modal-body">
                           <div class="centered-modal-body">
                              <textarea class="form-control" name="comment" id="comment_txt{{$socialbuzzList->id}}"  class ="adsd" placeholder="Your Comment.. "></textarea>
                              <div class="row">
                                 <div class="col-md-12" style="height:250px;overflow-y: scroll;">
                                    @if(count($socialbuzzList->getSocialBuzzComments) > 0)
                                    @foreach($socialbuzzList->getSocialBuzzComments as $comment)
                                    @if($comment->commentBy['role_id'] = '3')
                                    @php $c_p_link=  route('buyer-public-profile', $comment->commentBy['public_profile']) @endphp
                                    @elseif($comment->commentBy['role_id'] = '4')
                                    @php $c_p_link=  route('seller-public-profile', $comment->commentBy['public_profile']) @endphp
                                    @else
                                    @php $c_p_link = javascript::void(0) @endphp
                                    @endif
                                    <div class="pop-content">
                                       <a target="_blank" href="{{ $c_p_link }}" alt="profile link">
                                       <img alt="profileImage" class="circular img-40" src="{{ !empty($comment->commentBy['profile_pic']) && file_exists($comment->commentBy['profile_pic']) ? asset($comment->commentBy['profile_pic']) : asset('assets/images/profile.png')}}">
                                       </a>
                                       <div class="content-sec-pop">
                                          <h6>{{ $comment->commentBy['first_name'] }} {{ $comment->commentBy['last_name'] }}</h6>
                                          <span> {{$comment->post_comment}} </span>
                                       </div>
                                    </div>
                                    @endforeach 
                                    @else
                                    <div class="pop-content">
                                       <p>No Comment Yet.</p>
                                    </div>
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div  class="modal-footer">
                           <button class="btn btn-danger btn-d" type="button" id="social-comment" onclick="commentSave('{{$socialbuzzList->id}}')">SAVE</button>
                           <button class="btn btn-default btn-d" data-dismiss="modal" type="button">CANCEL</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Comment Modal End-->
               <!--- Awards Modal Start --->
               <div class="modal fade" id="giveAward<?php echo $j;?>" role="dialog" data-keyboard="false" data-backdrop="static">
                  <div class="modal-dialog">
                     <form>
                        @csrf
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 class="pull-right">
                                 <i class="fa fa-trophy"></i>
                                 <span style="color:black">( {{ count($socialbuzzList->getSocialBuzzAwards)}} )</span>&nbsp;Awards
                              </h5>
                              <h4 class="modal-title"> Awards </h4>
                           </div>
                           <div class="modal-body">
                              <div class="centered-modal-body">
                                 @if(count($socialbuzzList->alreadyAwarded) > 0)
                                 <div>
                                    <span class=emoji>&#x1F44D;</span>
                                    <h4>You have already awarded this talent.</h4>
                                 </div>
                                 @else
                                 <div>
                                    <h4>Are you sure to award this talent?</h4>
                                    <button type="button" class="btn btn-danger" onclick="addAward('{{$socialbuzzList->id}}')">SAVE</button>
                                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>  
                                 </div>
                                 @endif
                              </div>
                              <div class="modal-footer-awards">
                                 <div class="fanbase-background">
                                    <h5>Fan Base</h5>
                                 </div>
                                 @if(count($socialbuzzList->getSocialBuzzAwards) > 0)
                                 @foreach($socialbuzzList->getSocialBuzzAwards as $fanbase)
                                 @if($fanbase->awardBy['role_id'] = '3')
                                 @php $a_p_link=  route('buyer-public-profile', $fanbase->awardBy['public_profile']) @endphp
                                 @elseif($fanbase->awardBy['role_id'] = '4')
                                 @php $a_p_link=  route('seller-public-profile', $fanbase->awardBy['public_profile']) @endphp
                                 @else
                                 @php $a_p_link = javascript::void(0) @endphp
                                 @endif
                                 <div class="pop-content">
                                    <a target="_blank" href="{{ $a_p_link }}" alt="profile link">
                                    <img alt="profileImage" class="circular img-40" src="{{ !empty($fanbase->awardBy['profile_pic']) && file_exists($fanbase->awardBy['profile_pic']) ? asset($fanbase->awardBy['profile_pic']) : asset('assets/images/profile.png') }}">
                                    </a>
                                    <div class="content-sec-pop">
                                       <h6> {{ $fanbase->awardBy['first_name'] }} {{ $fanbase->awardBy['last_name'] }} </h6>
                                    </div>
                                 </div>
                                 @endforeach
                                 @else
                                 <div class="no-fanbase-data-found">
                                    <h5>No one awarded this talent yet!</h5>
                                 </div>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!--- Awards Modal End --->
               <!--- Riders Modal Start --->
               <div class="modal fade" id="ridersModal<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
                  <div class="modal-dialog">
                     <form>
                        @csrf
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 class="pull-right">
							  <img alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">
                                 <span style="color:black">( {{ count($socialbuzzList->getSocialBuzzRiders)}} )</span>&nbsp;Riders
                              </h5>
                              <h4 class="modal-title"> Riders </h4>
                           </div>
                           <div class="modal-body">
                              <div class="centered-modal-body">
                                 @if($socialbuzzList->user_id  == Auth::id())
                                    <div>
                                       <h4>Sorry, you cannot add yourself as a Rider</h4>
                                    </div>
                                 @elseif(count($socialbuzzList->selfRider) > 0)
                                 <div>
                                    <span class=emoji>&#x1F44D;</span>
                                    <h4>You are already a rider to this talent.</h4>
                                 </div>                                 
                                 @else 
                                 <div>
                                    <h4>Are you ready to ride?</h4>
                                    <button type="button" class="btn btn-danger" onclick="addRider('{{$socialbuzzList->id}}')">SAVE</button>
                                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                                 </div>
                                 @endif
                              </div>
                              <div class="modal-footer-awards">
                                 <div class="fanbase-background">
                                    <h5>Fan Base</h5>
                                 </div>
                                 @if(count($socialbuzzList->getSocialBuzzRiders) > 0)
                                 @foreach($socialbuzzList->getSocialBuzzRiders as $fanbase)
                                 @if($fanbase->rideBy['role_id'] = '3')
                                 @php $r_p_link=  route('buyer-public-profile', $fanbase->rideBy['public_profile']) @endphp
                                 @elseif($fanbase->rideBy['role_id'] = '4')
                                 @php $r_p_link=  route('seller-public-profile', $fanbase->rideBy['public_profile']) @endphp
                                 @else
                                 @php $a_p_link = javascript::void(0) @endphp
                                 @endif
                                 <div class="pop-content">
                                    <a target="_blank" href="{{ $r_p_link }}" alt="profile link">
                                    <img alt="profileImage"  class="circular img-40" src="{{ !empty($fanbase->rideBy['profile_pic']) && file_exists($fanbase->rideBy['profile_pic']) ? asset($fanbase->rideBy['profile_pic']) :asset('assets/images/profile.png')}}">
                                    </a>
                                    <div class="content-sec-pop">
                                       <h6>{{ $fanbase->rideBy['first_name'] }} {{ $fanbase->rideBy['last_name'] }}</h6>
                                    </div>
                                 </div>
                                 @endforeach
                                 @else
                                 <div class="no-fanbase-data-found">
                                    <h5>No Riders yet!</h5>
                                 </div>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!--- Riders Modal End --->
               <!-- Report User Modal Start-->
               <div class="modal fade report-user" id="reportUser<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
                  <div class="modal-dialog">
                     <form>
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"> Report </h4>
                           </div>
                           <div class="modal-body">
                              <div class="centered-modal-body">
                                 @if($socialbuzzList->report =='1')
                                 <h4>Flag this user for inappropriate behaviour</h4>
                                 <button type="button" class="btn btn-danger" onclick="reportUser('{{$socialbuzzList->id}}','{{$socialbuzzList->user_id}}')">YES</button>
                                 <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                                 @else
                                 <h4>You have already flag this user for inappropriate behaviour.</h4>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- Report User Modal End-->
               <!-- Purchase Modal Start-->
               <div class="modal fade report-user" id="purchaseModal<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
                  <div class="modal-dialog">
                     <form>
                        <!-- Modal content-->
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"> Purchase </h4>
                           </div>
                           <div class="modal-body">
                              @if(!empty($socialbuzzList->product_link))
                              <div class="centered-modal-body">
                                 <h4>Would you like to purchase?</h4>
                                 <a id="url" class="btn btn-danger" onclick="goToPurchaseProduct('{{$socialbuzzList->product_link}}')" target="_blank">YES</a>
                                 <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                              </div>
                              @else
                              <div class="centered-modal-body">
                                 <h4>No product added to purchase..Keep exploring on <b class="text-danger">Future Starr Social Buzz</b></h4>
                              </div>
                              @endif
                           </div>
                           <div class="modal-footer">
                              <!-- <button type="submit" class="btn btn-danger">SHARE</button> -->
                              <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- Purchase Modal End-->
               <!-- Send Message Modal End-->
               <div class="social-buzz-modals">
                  <div class="modal fade share-modal" id="shareModal<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
                     <div class="modal-dialog">
                        <form #social="ngForm" (ngSubmit)="shareOnSocialMedia(social)">
                        <div class="modal-content">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"> Share </h4>
                           </div>
                           <div class="modal-body">
                              <!-- <div class="form-group">
                                 <textarea class="form-control" style="resize: none" rows="5" placeholder="say something..."></textarea>
                                 </div> -->
                              @if(!empty($socialbuzzList->product_link))
                              <div class="form-group">
                                 <div class="btn-group btn-icons" role="group">
                                    <br />
                                    <ul class="nav">
                                       <li class="list-item-facebook">
                                          <a href="http://www.facebook.com/sharer.php?u={{$socialbuzzList->product_link}}" target="_blank" class="social-btn-facebook btn modal-btn btn-bg customer share">
                                          <i class="fa fa-facebook"> </i>
                                          <span class="separator"></span> FACEBOOK</a>
                                       </li>
                                       <li class="list-item-instagram">
                                          <a href="https://plus.google.com/share?url={{$socialbuzzList->product_link}}" target="_blank" class="social-btn-instagram btn modal-btn btn-bg customer share">
                                          <i class="fa fa-google-plus"></i>
                                          <span class="separator"></span> GOOGLE +</a>
                                       </li>
                                       <li class="list-item-twitter">
                                          <a href="http://twitter.com/share?text=share&url={{$socialbuzzList->product_link}}
                                             " target="_blank" class="social-btn-twitter btn modal-btn btn-bg customer share">
                                          <i class="fa fa-twitter"></i>
                                          <span class="separator"></span> TWITTER</a>
                                       </li>
                                       <li class="list-item-linkedin">
                                          <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{$socialbuzzList->product_link}}" target="_blank" class="social-btn-linkedin btn modal-btn btn-bg customer share">
                                          <i class="fa fa-linkedin" aria-hidden="true"></i>
                                          <span class="separator"></span> LINKEDIN</a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              @else
                              <h4 class="text-center">No product added to share..Keep exploring on <b class="text-danger">Future Starr Social Buzz</b></h4>
                              @endif
                           </div>
                           <div class="modal-footer">
                              <!-- <button type="submit" class="btn btn-danger">SHARE</button> -->
                              <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <!-- Share Modal End-->
               @php
               $i++;
               $j++; 
               $k++;
               $c++;
               @endphp
               @endforeach

                  @else
                      <h1 class="text-danger text-center" style="margin-top: 5pc; margin-bottom: 5pc;">No Trending available. 
                      </h1>
               @endif   

            </div>
           
         </div>
      </div>
   </div>
</section>
<a class="scroll-top-arrow" href="javascript:void(0);"><i   class="ti-arrow-up"></i></a>
<!-- Rider Modal Start-->
<div class="modal fade" id="riderModal" role="dialog">
   <div class="modal-dialog">
      <form>
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <span style="margin-top:10px;"  class="pull-right">
                  <!-- <i class="fa fa-motorcycle riders"></i> -->
                  <img alt="commercial Ads" class="pop-rider-images" src="{{ asset('assets/images/rider-white_1.png') }}">
                  <span style="color:black; font-weight:bold;">({{ count($riders) }}) </span> <b>Riders</b> &nbsp;
               </span>
               <span style="color:white; font-weight:bold;" class="modal-title pro-pop-sp"><b> Riders</b> </span>
            </div>
            <div class="modal-body">
               <div class="centered-modal-body">
                  @if(!empty($self_rider))
                  <div>
                     <span class=emoji>&#x1F44D;</span>
                     <h4>You are already a rider.</h4>
                  </div>
                  @else
                  <div>
                     <h4>Are you ready to ride?</h4>
                     <button type="button" class="btn btn-danger" data-to="{{ Crypt::encryptString($user['id']) }}" data-from="{{ !empty(Auth::user()->id) ? Auth::user()->id : ''}}" data-url="{{ route('public.profile.rider.add') }}" id="add-rider">SAVE</button>
                     <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                  </div>
                  @endif
               </div>
            </div>
            <div class="modal-footer-awards">
               <div class="fanbase-background">
                  <h5>Fan Base</h5>
               </div>
               @if(count($riders) > 0)
               @foreach($riders as $rider)
               @if($rider->role == 'seller')
               @php 
               $profile_link = route('seller-public-profile', $rider->public_profile )
               @endphp
               @elseif($rider->role == 'buyer')
               @php 
               $profile_link = route('buyer-public-profile', $rider->public_profile ) 
               @endphp
               @else 
               @php $profile_link = 'javascript:void(0)' @endphp
               @endif
               <div class="pop-content">
                  <a target="_blank" href="{{ $profile_link }}" alt="public-profile">
                  <img alt="profileImage" class="circular img-40" src="{{ !empty($rider->profile_pic) ? asset($rider->profile_pic): asset('assets/images/profile.png')}}">
                  </a>
                  <div class="content-sec-pop">
                     <h6>{{ $rider->first_name ?: '' }}&nbsp;{{ $rider->last_name ?: ''}}</h6>
                  </div>
               </div>
               @endforeach
               @else
               <div class="no-fanbase-data-found">
                  <h5>No Riders yet!</h5>
               </div>
               @endif
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Rider Modal End-->
<!-- Send Message Modal Start-->
<div class="modal fade" id="sendMessage" role="dialog">
   <div class="modal-dialog">
      <form>
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Send Message </h4>
            </div>
            <div class="modal-body">
               <p style="font-size: 15px; font-weight: 500;">Information: To do one to one chat you can add as rider to this user by click on button riders next to this.</p>
               <div class="form-group">
                  <label>Your Message</label>
                  <br />
                  <textarea class="form-control" name="message"  id="message" rows="6"  required placeholder="Write here"> </textarea>
                  <span class="invalid-feedback" id="message_error"></span>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" id="send-message" data-to="{{ Crypt::encryptString($user['id'] ) }}" data-from="{{ !empty(Auth::user()->id) ? Auth::user()->id : ''  }}" data-url="{{ route('public.profile.message.send')}}" >Send</button>
               <button type="button" class="btn btn-default btn-d" data-dismiss="modal">Cancel</button>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Send Message Modal End-->
@endsection
@section('javascript')
<script type="text/javascript">
   $(document).ready(function() {

      $("#send-message").click(function() {
          var message_to = $(this).data('to');
          var message_from = $(this).data('from');
          var message = $("#message").val();
          var url = $(this).data('url');
          var post_data = {
              "_token": "{{ csrf_token() }}",
              to: message_to,
              from: message_from,
              message: message
          };
          $.ajax({
              url: url,
              type: 'POST',
              data: post_data,
              beforeSend: function() {
                  $("#send-message").prop('disabled', true);
                  $("#send-message").text('Sending');
              },
              success: function(response) {
   
                  if (response.success) {
                      toastr.success(response.success);
                      $("#message").val('');
                      return true;
                  }
                  if (response.error) {
                      toastr.error(response.error);
                      return false;
                  }
                  if (response.info) {
                      toastr.info(response.info);
                      $("#message").val('');
                      return false;
                  }
                  if (response.required) {
                      toastr.error(response.required);
                      $("#message").css('border', '1px solid red');
                      return false;
                  }
              },
              complete: function() {
                  $("#send-message").prop('disabled', false);
                  $("#send-message").text('Send');
              },
              error: function(data) {
                  toastr.error(data);
              }
          });
      });
   
      $("#add-rider").click(function() {
          var to = $(this).data('to');
          var from = $(this).data('from');
          var url = $(this).data('url');
          var post_data = {
              "_token": "{{ csrf_token() }}",
              to: to,
              from: from,
          };
          $.ajax({
              url: url,
              type: 'POST',
              data: post_data,
              beforeSend: function() {
                  $("#add-rider").prop('disabled', true);
                  $("#add-rider").text('SAVING');
              },
              success: function(response) {
   
                  if (response.success) {
                      toastr.success(response.success);
                      return true;
                  }
                  if (response.error) {
                      toastr.error(response.error);
                      return false;
                  }
                  if (response.info) {
                      toastr.info(response.info);
                      return false;
                  }
                  if (response.required) {
                      toastr.error(response.required);
                      return false;
                  }
              },
              complete: function() {
                  $("#add-rider").prop('disabled', false);
                  $("#add-rider").text('SAVE');
              },
              error: function(data) {
                  toastr.error(data);
              }
          });
      });
   });
   
   $(document).ready(function() {
      $.getJSON('https://ipapi.co/json/', function(data) {
          var postdata1 = JSON.stringify(data, null, 2);
          var postdata = JSON.parse(postdata1);
          var ip = postdata.ip;
          var country = postdata.country_name;
          var pathname = window.location.pathname;
          var post_data = {
              'ip': ip,
              'country': country,
              'pathname': pathname,
              "_token": "{{ csrf_token() }}",
          };
          $.ajax({
              type: 'POST',
              url: '{!! route('profile-visitor') !!}',
              data: post_data,
              success: function(response) {
   
                  console.log('response', response);
   
              },
              error: function(error) {
   
              }
          });
      });
   });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script src="{{ asset('assets/vendor/emoji-picker/lib/js/config.js') }}"></script>
<script src="{{ asset('assets/vendor/emoji-picker/lib/js/util.js') }}"></script>
<script src="{{ asset('assets/vendor/emoji-picker/lib/js/jquery.emojiarea.js') }}"></script>
<script src="{{ asset('assets/vendor/emoji-picker/lib/js/emoji-picker.js') }}"></script>
<script type="text/javascript">
   $(function () {
    // Initializes and creates emoji set from sprite sheet
       window.emojiPicker = new EmojiPicker({
           emojiable_selector: '[data-emojiable=true]',
           assetsPath: "{!! asset('assets/vendor/emoji-picker/lib/img/') !!}",
           popupButtonClasses: 'icon-smile'
       });
   
       window.emojiPicker.discover();
   });
   function commentSave(postId) {
         var url = '{!! route('social-buzz.storeComments') !!}';
         var comment = $("textarea#comment_txt"+postId).val();
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "comment": comment,
                  "post_id":postId
            },
           
            success: function(response){
                 if(response.validation_error) {
                    $("#social-comment").show();
                    toastr.warning(response.validation_error);
                    $('[id^="comment_txt"]').css('border-color', '#ff503f');
                 }
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 2000);
                 }
                  if(response.error) {
                    toastr.error(response.error);
                  }
            },
            
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });
   }
   function addAward(postId){
         $('[id^="giveAward"]').modal('hide');
         var url = '{!! route('social-buzz.storeAward') !!}';     
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "post_id":postId
            },
            success: function(response){
                 if(response.validation_error) {
                    toastr.warning(response.validation_error);
                 }
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                  if(response.error) {
                    toastr.error(response.error);
                  }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });
   }
   
   function addRider(postId){
         $('[id^="ridersModal"]').modal('hide');
         var url = '{!! route('social-buzz.storeRider') !!}';     
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "post_id":postId
            },
            success: function(response){
                 if(response.validation_error) {
                    toastr.warning(response.validation_error);
                 }
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                  if(response.error) {
                    toastr.error(response.error);
                  }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });
   
   }
   function goToPurchaseProduct(productLink){
    if(productLink) {
        $('[id^="purchaseModal"]').modal('hide');
        window.open(productLink);
    }
   }
   function reportUser(postId, userId){
         $('[id^="reportUser"]').modal('hide');
         var url = '{!! route('social-buzz.reportUser') !!}';     
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "post_id":postId,
                  "user_id":userId
            },
            success: function(response){
                 if(response.validation_error) {
                    toastr.warning(response.validation_error);
                 }
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data){
                toastr.error('Bad Request.');
              }
            }
        });
   }
   
</script>
<script type="text/javascript">
   
   ;(function($){
   
   /**
   * jQuery function to prevent default anchor event and take the href * and the title to make a share popup
   *
   * @param  {[object]} e           [Mouse event]
   * @param  {[integer]} intWidth   [Popup width defalut 500]
   * @param  {[integer]} intHeight  [Popup height defalut 400]
   * @param  {[boolean]} blnResize  [Is popup resizeabel default true]
   */
   $.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {
   
   // Prevent default anchor event
   e.preventDefault();
   
   // Set values for window
   intWidth = intWidth || '500';
   intHeight = intHeight || '400';
   strResize = (blnResize ? 'yes' : 'no');
   
   // Set title and open popup with focus on it
   var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
       strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
       objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
   }
   
   /* ================================================== */
   
   $(document).ready(function ($) {
   $('.customer.share').on("click", function(e) {
       $(this).customerPopup(e);
   });
   });
   
   }(jQuery));
</script>

@stop