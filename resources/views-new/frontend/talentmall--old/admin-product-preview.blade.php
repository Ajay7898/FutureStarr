@extends('layouts.talent') @section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background background-position-top top-space" style="background-image:url({{ asset('assets/images/talent-mall.jpg')}});">
   <div class="opacity-medium bg-extra-dark-gray"></div>
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
            <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
               <!-- start page title -->
               <h1 class="alt-font text-white font-weight-600 mb-2">Talent Mall</h1>
               <!-- end page title -->
               <!-- start sub title -->
               <span class="display-block text-white opacity6 alt-font">
               Browse and Purchase Talents</span>
               <!-- end sub title -->
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End banner  -->
<!-- Start Content  -->       
<!-- start blog section -->
<section class="pt-5 product-info talent-mall-ban-pro">
   <div class="container">
      <div class="row talent-mall-ban-pro-raw">
	  
	   <div class="col-md-3  tm-pi-section-1 text-center talent-mall-ban-pro-raws">
	   <div class="col-sm-12 talent-mall-ban-pro-raws-da">
            @if(!empty($talentInformation['commercialMedia'][0]->image_path) && file_exists($talentInformation['commercialMedia'][0]->image_path))
            @php $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml']; @endphp
            @php $allowedMimeTypes1 = ['audio/mp3']; @endphp
            @php $allowedMimeTypes2 = ['video/mp4', 'video/mkv', 'video/wav']; @endphp
            @php $contentType = mime_content_type($talentInformation['commercialMedia'][0]->image_path); @endphp
            @if(in_array($contentType, $allowedMimeTypes) )
            <img src="{{asset($talentInformation['commercialMedia'][0]->image_path)}}" class="product-img" alt="product-img">
            @endif
            @if(in_array($contentType, $allowedMimeTypes1) )
            @php $video = explode(".",$talentInformation['commercialMedia'][0]->image_path) @endphp
            @if(strtolower(end($video)) =="mp3")
            <video id="my-player" poster="{{asset('assets/images/talent-mall/audio-bg.png')}}" style="width: 100%" controls>
               <source src="{{asset($talentInformation['commercialMedia'][0]->image_path)}}" type="video/mp3">
               <source src="{{asset($talentInformation['commercialMedia'][0]->image_path)}}" type="video/ogg">
               Your browser does not support
               HTML5 video.
            </video>
            @endif
            @endif
            @if(in_array($contentType, $allowedMimeTypes2) )
            @php $video = explode(".",$talentInformation['commercialMedia'][0]->image_path) @endphp
            @if(strtolower(end($video)) =="mp4" || strtolower(end($video)) =="ogv")
            <video id="my-player" style="width: 100%" controls>
               <source src="{{asset($talentInformation['commercialMedia'][0]->image_path)}}" type="video/mp4">
               <source src="{{asset($talentInformation['commercialMedia'][0]->image_path)}}" type="video/ogg">
               Your browser does not support
               HTML5 video.
            </video>
            @endif
            @if(strtolower(end($video)) =="mkv")
            <video id="my-player" poster="{{asset('assets/images/audio-banner.jpg')}}" style="width: 100%" controls>
               <source src="{{asset($talentInformation['commercialMedia'][0]->image_path)}}" type="video/x-matroska">
               <source src="{{asset($talentInformation['commercialMedia'][0]->image_path)}}" type="video/x-matroska">
               Your browser does not support
               HTML5 video.
            </video>
            @endif
            @endif
            @endif
			<hr class="hrli">
			
            <ul class="list-unstyled font-weight-600 text-dark mt-3 talent-mall-category-awards">
               <li><i class="fa fa-trophy aw-tr" aria-hidden="true"></i>&nbsp&nbsp AWARDS ({{ count($talentInformation['getTalentAwards']) }}) <hr class="hrli"></li>
			   
			   
               <li><i class="fa fa-download dow-li" aria-hidden="true"></i>&nbsp&nbsp DOWNLOADS ({{ count($talentInformation['getDownloads']) }}) <hr class="hrli"></li>
			   
			   <li><img style="max-width:27px;border-radius: 0%;object-fit: contain;" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/view.png') }}">&nbsp&nbsp VIEWS ({{ $talentInformation['view'] }}) <hr class="hrli"></li>
			   
			    <li class="rider" data-toggle="modal" data-target="#exampleModalLong"><img alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}"> &nbsp&nbsp RIDERS (0) <hr class="hrli"></li>
            </ul>
         
			  <p class="sam-pro sam-pro-seller">SELLER</p>
            <div class="user-card">
               <div class="user-info">
                  <div class="profile-pic pro-cat-pro-pic">
                     @if(file_exists($talentInformation['getUserData']['profile_pic']) && !empty($talentInformation['getUserData']['profile_pic']))
                     <img src="{{asset('assets/'.!empty($talentInformation['getUserData']['profile_pic'])?$talentInformation['getUserData']['profile_pic']:'images/buyer/b-acount.png')}}" alt="profile pic" width="100px" height="100px">
                     @else 
						 
					 <i class="fa fa-user" aria-hidden="true"></i>
                      
                     @endif
                  </div>
                  <div class="user-caption">
                     <h4 class="us-name">{{ $talentInformation['getUserData']['first_name'] }}&nbsp;{{ $talentInformation['getUserData']['last_name'] }}</h4>
                     <!-- clas <ps="us-status"> Stay positive, work hard, make it happen</p> -->
                  </div>
                  <!-- <div class="ratings">
                     <div class="r-star">
                       <i class="fa fa-star fa-lg"></i>
                       <i class="fa fa-star fa-lg"></i>
                       <i class="fa fa-star fa-lg"></i>
                       <i class="fa fa-star fa-lg"></i>
                       <i class="fa fa-star fa-lg"></i>
                     </div>
                     <div class="r-count">5 <a href="#!" class="r-review">(83 reviews)</a></div>  
                     </div> -->
                  <div class="contact-btn">
                     @if(Auth::check())
                     <a data-toggle="modal" data-target="#sendMessage" href="javascript:void(0);" class="btn btn-outline-grey btn-block">Contact Me</a>  
                     @else
                     <a data-toggle="modal" data-target="#register_my_model" href="javascript:void(0);" class="btn btn-outline-grey btn-block">Contact Me</a> 
                     @endif
                  </div>
               </div>
               <hr class="spacer hrsli"/>
               <div class="user-ex-info">
                  <div class="item">
                     <div class="us-label"><i class="fa fa-map"></i><strong>From: </strong></div>
                     <div class="us-data">{{ $talentInformation['getUSerData']['address'] }}</div>
                  </div>
                  <div class="item">
                     <div class="us-label"><i class="fa fa-user"></i><strong>Member Since: </strong></div>
                     <div class="us-data">{{ date('F, Y', strtotime($talentInformation['getUSerData']['created_at'])) }}</div>
                  </div>
                  <!-- <div class="item">
                     <div class="us-label"><i class="fa fa-clock-o"></i> Avg. Response Time</div>
                     <div class="us-data"><strong>2 hours</strong></div>
                     </div> 
                     <div class="item">
                     <div class="us-label"><i class="fa fa-plane"></i> Recent Delivery</div>
                     <div class="us-data"><strong>{{ getProductSelletCount($talentInformation['getUSerData']['id']) }}</strong></div> -->
               </div>
            </div>
           
            <div class="user-desc">
               <p [innerHTML]="talent.talent[0].description"></p>
            </div>
            </div>
         </div>
        
		   
      
	  
         <div class="col-md-8 product-infos product-infos-main">
		 <div class="col-sm-12 product-infos-main-sub">
		 <div class="row product-info-deti">
		 <div class="col-md-7 product-info-deti1">
		  <h4>{{ $talentInformation['title'] }}</h4>
            <p class="product-info-deti1-pr"><strong>PRICE</strong><strong class="product-info-deti1-pr-price"> :&nbsp;$&nbsp;{{ $talentInformation['price'] }}</strong></p>
			</div>
			 <div class="col-md-5 product-info-deti2" style="display: none;">
            <p class="flex-wrap d-flex">
               @if(Auth::check()=='true' && Auth::user()->role_id =='3')
                  @if(empty($checkItemInCart))
                  <a id="add_to_cart" href="javascript:void(0);" class="px-3 mr-2 mb-2 btn btn-large btn-dark text-very-small border-radius-4 text-uppercase" onclick="addToCart('{{$talentInformation['id']}}')" ><i class="fa fa-shopping-cart ml-0" aria-hidden="true"></i>&nbsp&nbsp add to cart</a>
                  @else
                  <a id="go_to_cart" class="go-to-cart-button px-3 mr-2 mb-2 btn btn-large btn-dark text-very-small border-radius-4 text-uppercase" href="{{route('cart.index')}}">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; GO TO CART</a>
                  @endif
               @elseif(Auth::check()=='true' && Auth::user()->role_id =='4')
               <a id="add_to_cart" href="javascript:void(0);" class="px-3 mr-2 mb-2 btn btn-large btn-dark text-very-small border-radius-4 text-uppercase" data-toggle="modal" data-target="#askToJoinAsBuyer" ><i class="fa fa-shopping-cart ml-0" aria-hidden="true"></i> add to cart</a>
               @else 
               <a id="add_to_cart" href="javascript:void(0);" class="px-3 mr-2 mb-2 btn btn-large btn-dark text-very-small border-radius-4 text-uppercase" data-toggle="modal" data-target="#register_my_model"><i class="fa fa-shopping-cart ml-0" aria-hidden="true"></i> add to cart</a>
               @endif
		 </div>
		 </div>
		 <div class="row product-info-deti-subinfo">
		 <div class="col-md-7 product-info-deti-subinfo1">
		   @if(!empty($talentInformation['description']))
            <p>
               
               <span>
               @php 
               $small = substr($talentInformation['description'], 0, 100);
               @endphp
               {{ $small }}
               @if(strlen($talentInformation['description']) > 100)
               <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal-desc">Read more </a> 
               @endif
               </span>
            </p>
            @else 
            <b>NO TALENT INFORMATION AVAILABLE!</b>
            @endif
            <p class="product-info-deti-subinfo1-by"><strong>BY</strong> : {{ $talentInformation['getUserData']['first_name'] }}&nbsp;{{ $talentInformation['getUserData']['last_name'] }}</p>
		 
			</div>
			<div class="col-md-5 product-info-deti-subinfo2">
           @if(Auth::check()) 
               <a href="javascript:void(0);" class="px-3 mr-2 mb-2 mx-sm-2 btn btn-large btn-primary text-very-small border-radius-4 text-uppercase" title="Promote this talent" data-toggle="modal" data-target="#shareModal">
                  <i class="ml-0 fa fa-podcast" aria-hidden="true"></i><!-- PROMOTE THIS TALENT -->
               </a>
               <a href="javascript:void(0);" class="px-3 mb-2 btn btn-large btn-primary text-very-small border-radius-4 text-uppercase" title="Award talent" data-toggle="modal" data-target="#giveAward">
                  <i class="ml-0 fa fa-trophy" aria-hidden="true"></i> <!-- AWARD TALENT -->
               </a>
               @else 
               <a href="javascript:void(0);" class="px-3 mr-2 mb-2 mx-sm-2 btn btn-large btn-primary text-very-small border-radius-4 text-uppercase" title="Promote this talent" data-toggle="modal" data-target="#register_my_model">
                  <i class="ml-0 fa fa-podcast" aria-hidden="true"></i><!-- PROMOTE THIS TALENT -->
               </a>
               <a href="javascript:void(0);" class="px-3 mb-2 btn btn-large btn-primary text-very-small border-radius-4 text-uppercase" title="Award talent" data-toggle="modal" data-target="#register_my_model">
                  <i class="ml-0 fa fa-trophy" aria-hidden="true"></i> <!-- AWARD TALENT -->
               </a>
               @endif
            </p>
			</div>
			</div>
			
			
			<div class="row product-info-deti-social">
			<div class="col-md-7 product-info-deti-social1">
			@if(Auth::check())
               <a href="javascript:void(0);" class="btn btn-small btn-dark text-very-small border-radius-4 text-uppercase mb-2"  data-toggle="modal" data-target="#sendMessage"><i class="fa fa-envelope" aria-hidden="true"></i> Contact Me</a>
               @else
               <a href="javascript:void(0);" class="con btn btn-small btn-dark text-very-small border-radius-4 text-uppercase mb-2"  data-toggle="modal" data-target="#register_my_model"><i class="fa fa-envelope" aria-hidden="true"></i> Contact Me</a>
               @endif
			
            <ul class="list-unstyled d-flex">
               <li>
                  @if(Auth::check())
                  <a class="motor-css" href="javascript:void(0);" data-toggle="modal" data-target="#riderModal">   <img alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">
                  </a>
                  @else
                  <a class="motor-css ot" href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">
                     <img alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">
                     @endif
                     <span class="badge badge-primary">{{ count($talentInformation['getTalentRiders']) }}</span>
               </li>
               <li class="ml-3">
               <a class="comment-css" href="javascript:void(0);" data-toggle="modal" data-target="#openComment">
               <i class="fa fa-comment" aria-hidden="true"></i>
               </a> 
               <span class="badge badge-primary">{{ count($talentInformation['talentComments']) }}</span>
               </li>
            </ul>
			
			    </div>
			   <div class="col-md-5 product-info-deti-social2">
               <ul class="extra-small-icon social-icon-style-1 text-small mb-0">
                  <li>
                     <a class="facebook customer share" href="http://www.facebook.com/sharer.php?u={{Request::fullUrl()}}" target="_blank" 
                        ><i class="fa fa-facebook"> </i>
                     </a>
                  </li>
                  <li>
                     <a class="twitter customer share" href="http://twitter.com/share?text=share&url={{Request::fullUrl()}}
                        " target="_blank" >
                     <i class="fa fa-twitter"></i>
                     </a>
                  </li>
                  <li>
                     <a class="google customer share" href="https://plus.google.com/share?url={{Request::fullUrl()}}" target="_blank">
                     <i class="fa fa-google-plus"></i>
                     </a>
                  </li>
                  <li>
                     <a class="linkedin customer share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::fullUrl()}}" target="_blank">
                     <i class="fa fa-linkedin"></i>
                     </a>
                  </li>
               </ul>
            </div>
            </div>
			
			 <p class="text-extra-large text-center font-weight-600 text-dark pb-3 sam-pro">SAMPLE PRODUCT</p>
            @if(count($talentInformation['sampleMedia']) > 0)
            <a href="javascript:void(0)" id="seller-video">
            <img src="{{asset('assets/images/music-background.png')}}" alt="music background"/>
            </a>
            @else 
            <img src="{{asset('assets/images/talent-mall/sam.png')}}" alt="sample background" width="100%" height="auto" />
            <p class="sam-pro-smile">No sample product found for this Talent</p>
            @endif
            </div>
            </div>
           
      </div>
     
     <style>
	 section {
		padding: 0px 0 !important;
		overflow: hidden;
	}
	 </style>

   </div>
   </div>
</section>
<!-- end blog section -->

<div id="myModal-desc" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ $talentInformation['title'] }} - Description</h4>
         </div>
         <div class="modal-body">
            <p>{{ $talentInformation['description'] }}</p>
         </div>
         <div class="modal-footer">
            <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
         </div>
      </div>
   </div>
</div>
<!-- Rider Modal Start-->
<div class="social-buzz-modals">
   <div class="modal fade" id="riderModal" role="dialog">
      <div class="modal-dialog">
         <form>
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <span style="margin-top:10px;"  class="pull-right">
                     <!-- <i class="fa fa-motorcycle riders"></i> -->
                     <img class="cm-ads" alt="commercial Ads" class="hover-images" src="{{ asset('assets/images/rider-green.png') }}">
                     <span style="color:black; font-weight:bold;">( {{count($talentInformation['getTalentRiders'])}} ) </span> <b>Riders</b> &nbsp;
                  </span>
                  <span style="color:white; font-weight:bold;" class="modal-title pro-pop-sp"><b> Riders</b> </span>
               </div>
               <div *ngIf="!selfRider" class="modal-body">
                  <div class="centered-modal-body">
                     @if(count($talentInformation['selfRider']) > 0)
                     <div>
                        <span class=emoji>&#x1F44D;</span>
                        <h4>You are already a rider to this talent.</h4>
                     </div>
                     @else 
                     <div>
                        <h4>Are you ready to ride?</h4>
                        <button type="button" class="btn btn-danger" onclick="addRiderToTalent('{{ Crypt::encryptString($talentInformation->id) }}')">SAVE</button>
                        <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                     </div>
                     @endif
                  </div>
               </div>
               <div class="modal-footer-awards">
                  <div class="fanbase-background">
                     <h5>Fan Base</h5>
                  </div>
                  @if(count($talentInformation['getTalentRiders']) > 0)
                  @foreach($talentInformation['getTalentRiders'] as $fanbase)

                     @if($fanbase->rideBy['role_id'] = '3')

                        @php $r_p_link=  route('buyer-public-profile', $fanbase->rideBy['public_profile']) @endphp

                     @elseif($fanbase->rideBy['role_id'] = '4')

                        @php $r_p_link=  route('seller-public-profile', $fanbase->rideBy['public_profile']) @endphp

                     @else
                        @php $r_p_link = javascript::void(0) @endphp
                     @endif

                  <div class="pop-content">
                     <a target="_blank" href="{{ $r_p_link }}">
                     
                      <img  class="circular img-40" src="{{ !empty($fanbase->rideBy['profile_pic']) && file_exists($fanbase->rideBy['profile_pic']) ? asset($fanbase->rideBy['profile_pic']) : asset('assets/images/profile.png')}}">
                     
                     </a>
                     <div class="content-sec-pop">
                        <h6> {{ $fanbase->rideBy['first_name'] }} {{ $fanbase->rideBy['last_name'] }}</h6>
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
               <div class="form-group">
                  <label for="name">Message Title</label>
                  <br />
                  <input type="text" class="form-control" name="title" id="title" required placeholder="Message Title"
                     />
                  <span class="invalid-feedback" id="title_error"></span>
               </div>
               <div class="form-group">
                  <label>Your Message</label>
                  <br />
                  <textarea class="form-control" name="message"  id="message" rows="6"  required placeholder="Write here"> </textarea>
                  <span class="invalid-feedback" id="message_error"></span>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger"  onclick="addBuyerContactMessage('{{$talentInformation['id']}}')">SAVE</button>
               <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- Send Message Modal End-->

<!-- Asking to Login Start-->
<div class="modal-ask-to-login fade" id="askToLogin" role="dialog">
   <div class="modal-dialog">
      <form>
         <!-- Modal content-->
         <div class="ask-to-login">
            <div class="modal-body">
               <div class="form-group text-spinner">
                  <h3 class="deleteConfirmation">Please login to use this feature! </h3>
                  <i class="fa fa-circle-o-notch fa-spin"></i>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>

<!-- comment model is start -->
<div class="social-buzz-modals">
   <div class="modal fade" id="openComment" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h5 class="pull-right" style="margin: 15px 0 0 0;">
                  <span style="color:black;" *ngIf="talent_comments_count">
                  ( {{ count($talentInformation->talentComments)}} )
                  </span>
                  <i class="fa fa-comment"></i>
               </h5>
               <h4 class="modal-title" style="margin: 0px 0 0 0;"> Comments </h4>
            </div>
            <div class="modal-body">
               @if(count($talentInformation->talentComments) > 0)
               @foreach($talentInformation->talentComments as $comment)

                  @if($comment->commentBy['role_id'] = '3')

                     @php $c_p_link=  route('buyer-public-profile', $comment->commentBy['public_profile']) @endphp

                  @elseif($comment->commentBy['role_id'] = '4')

                     @php $c_p_link=  route('seller-public-profile', $comment->commentBy['public_profile']) @endphp

                  @else
                     @php $c_p_link = javascript::void(0) @endphp
                  @endif

               <span>
                  <div class="row">
                     <div class="col-sm-6 col-md-6 col-xs-6">
                        <div class="fanbase-users">
                           <a target="_blank" href="{{ $c_p_link }}">
                             
                              <img  class="circular img-40" src="{{ !empty($comment->commentBy['profile_pic']) && file_exists($comment->commentBy['profile_pic']) ? asset($comment->commentBy['profile_pic']) : asset('assets/images/profile.png')}}">

                           </a>
                           <span class="fanbase-user-name"><b>
                              {{ $comment->commentBy['first_name'] }} {{ $comment->commentBy['last_name'] }}
                           </b></span>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-xs-6  text-right">
                        <h5>{{ $comment->created_at }}</h5>
                     </div>
                  </div>
                  <div class="row margin-top">
                     <div class="col-sm-12 col-md-12 col-xs-12">
                        <p>{{ $comment->comment }} </p>
                     </div>
                  </div>
                  <hr>
               </span>
               @endforeach
               @else 
               <div class="text-center">
                  No Comments found
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
<!-- comment model is start -->

<!-- Award Modal Start-->
<div class="social-buzz-modals">

   <div class="modal fade" id="giveAward" role="dialog">
      <div class="modal-dialog">
         <form>
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="pull-right">
                     <i class="fa fa-trophy"></i>
                     <span style="color:black"> ( {{ count($talentInformation['getTalentAwards'])}} )</span> Award
                  </h5>
                  <h4 class="modal-title"> Awards </h4>
               </div>
               <div class="modal-body">
                  <div class="centered-modal-body">
                     @if(count($talentInformation['alreadyAwarded']) > 0)
                     <div>
                        <h4>You have already awarded this talent.</h4>
                     </div>
                     @else
                     <div>
                        <h4>Are you sure to send this talent an Award?</h4>
                        <button type="button" class="btn btn-danger" onclick="awardTalent('{{ Crypt::encryptString($talentInformation['id']) }}')">YES</button>
                        <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                     </div>
                     @endif
                  </div>
               </div>
               <div class="modal-footer-awards">
                  <div class="fanbase-background">
                     <h5>Fan Base</h5>
                  </div>
                  @if(count($talentInformation->getTalentAwards) > 0)
                  @foreach($talentInformation->getTalentAwards as $fanbase)

                     @if($fanbase->awardBy['role_id'] = '3')

                        @php $a_p_link=  route('buyer-public-profile', $fanbase->awardBy['public_profile']) @endphp

                     @elseif($fanbase->awardBy['role_id'] = '4')

                        @php $a_p_link=  route('seller-public-profile', $fanbase->awardBy['public_profile']) @endphp

                     @else
                        @php $a_p_link = javascript::void(0) @endphp
                     @endif

                  <div class="pop-content">
                     <a target="_blank" href="{{ $a_p_link }}">
                    
                        <img  class="circular img-40" src="{{ !empty($fanbase->awardBy['profile_pic']) && file_exists($fanbase->awardBy['profile_pic']) ? asset($fanbase->awardBy['profile_pic']) : asset('assets/images/profile.png')}}">
                    
                     </a>
                     <div class="content-sec-pop">
                        <h6> {{ $fanbase->awardBy['first_name'] }} {{ $fanbase->awardBy['last_name'] }}</h6>
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
         </form>
      </div>
   </div>
   <!-- Award Modal End-->
</div>
<!-- Award Modal End-->


<!-- Send Message Modal End-->
<div class="social-buzz-modals">
   <div class="modal fade share-modal" id="shareModal" role="dialog">
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
               <div class="form-group">
                  <div class="btn-group btn-icons" role="group">
                     <br />
                     <ul class="nav">
                        <li class="list-item-facebook">
                           <a href="http://www.facebook.com/sharer.php?u={{Request::fullUrl()}}" target="_blank" class="social-btn-facebook btn modal-btn btn-bg customer share">
                           <i class="fa fa-facebook"> </i>
                           <span class="separator"></span> FACEBOOK</a>
                        </li>
                        <li class="list-item-instagram">
                           <a href="https://plus.google.com/share?url={{Request::fullUrl()}}" target="_blank" class="social-btn-instagram btn modal-btn btn-bg customer share">
                           <i class="fa fa-google-plus"></i>
                           <span class="separator"></span> GOOGLE +</a>
                        </li>
                        <li class="list-item-twitter">
                           <a href="http://twitter.com/share?text=share&url={{Request::fullUrl()}}
                              " target="_blank" class="social-btn-twitter btn modal-btn btn-bg customer share">
                           <i class="fa fa-twitter"></i>
                           <span class="separator"></span> TWITTER</a>
                        </li>
                        <li class="list-item-linkedin">
                           <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::fullUrl()}}" target="_blank" class="social-btn-linkedin btn modal-btn btn-bg customer share">
                           <i class="fa fa-linkedin" aria-hidden="true"></i>
                           <span class="separator"></span> LINKEDIN</a>
                        </li>
                     </ul>
                  </div>
               </div>
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
<!-- Login as buyer Modal START -->
<div class="modal-ask-to-login fade" id="askToJoinAsBuyer" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content buyer-form">
         <div class="modal-header">
            <h5 class="modal-title">You are login as Seller.</h5>
         </div>
         <div class="modal-body">
            <p><strong style="font-size:20px !important;"> To use this feature please register as Buyer.</strong></p>
            <p> By clicking Register, you will be logged out from your current account.</p>
         </div>
         <div class="modal-footer sec-btn">
            <a href="{{ route('custom-logout') }}">Register</a>
            <a href="#" data-dismiss="modal">Cancel</a>
         </div>
      </div>
   </div>
</div>
<!-- Login as buyer Modal ENDS -->
<!-- No sample product popup -->
<div id="sampleProductModal" class="modal fade modal-m" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- <div class="modal-header mob-cls" style="padding:5px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> -->
         <div class="modal-body">
            <div class="row">
               <div class="col-sm-5 text-center" style="background-color:#fff;">
                  <button type="button" class="close desk-cls text-danger visible-xs" style="color: #ff503f !important;opacity: unset !important;text-shadow:unset !important" data-dismiss="modal">&times;</button><br>
                  <h4 style="color:#ff503f;font-weight: 600;margin: 12px 0 0 0;">
                     Oops, looks like the seller did not upload a sample product
                  </h4>
                  <p style="margin: 34px 0 0 0; text-align: center;"><b>No worries, Click the contact me button and Send them a quick message!</b></p>
                  <a class="btn btn-danger" style="margin: 15px;" data-dismiss="modal" (click)="showSendMessageModal()">CONTACT ME</a>
               </div>
               <div class="col-sm-7 text-center login-back-img hidden-xs" style="background-image:url('assets/images/img_tea_man.png');background-size:100% 100%;background-position:left;margin-top:-15px;margin-bottom:-15px;height: 270px;">
                  <button type="button" class="close desk-cls text-danger" style="color: #ff503f !important;opacity: unset !important;text-shadow:unset !important" data-dismiss="modal">&times;</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container">
   <!-- Modal -->
<div id="register_my_model" class="modal  modal-m pop" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header mob-cls">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5 text-center login-back">

                            <h4 class="mo-sign-awe">
                    Awe, looks like you have not 
                </h4>
                            <h4 class="mo-sign-fr">signed up for Future Starr.</h4>
                            <p class="mo-now"><b>No worries, click the Register</b></p>
                            <p class="mo-now-fr"><b>button and sign up now for FREE!</b></p>

                            <!-- <button class="btn btn-danger btn-sm login-button" style="margin: 5% 0 0 21%;">REGISTER</button> -->
                            <a href="/register" class="btn btn-danger reg-mod"  (click)="model_toggle()">Register</a>
                        </div>
                        <div class="col-sm-7 text-center login-back-img">
                            <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                           
                            <p class="closer-data"></p>
                            <h3 class="closer-data"></h3>
                            <p class="closer-data"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
   
   
</div>
<div id="seller-video-modal" class="modal fade" role="dialog">
   <div class="modal-dialog login-model-sec">
      <div class="modal-content">
         <!-- <div class="modal-header mob-cls" style="padding:5px;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> -->
         <div class="modal-body seller-video-modal-x">
            <div>
               <button class="close desk-cls" data-dismiss="modal" type="button">×</button>
            </div>
            <div class="col-sm-12 text-center">
               <!--  <video style="width: 100%; margin-bottom: 5px;" controls></video -->
               @if(count($talentInformation['sampleMedia']) > 0)
               @php $video = explode(".",$talentInformation['sampleMedia'][0]->path_name) @endphp
               @if(strtolower(end($video)) =="mp4" || strtolower(end($video)) =="ogv")
               <video id="my-player" style="width: 100%" controls>
                  <source src="{{asset($talentInformation['sampleMedia'][0]->path_name)}}" type="video/mp4">
                  <source src="{{asset($talentInformation['sampleMedia'][0]->path_name)}}" type="video/ogg">
                  Your browser does not support
                  HTML5 video.
               </video>
               @endif
               @if(strtolower(end($video)) =="mkv")
               <!--  <a href="javascript:void(0);" id="seller-video" data-src="{{asset($talentInformation['sampleMedia'][0]->path_name)}}" data-type="video/x-matroska">
                  <img src="{{asset('assets/images/music-background.png')}}" style="width: 100%; max-height: 400px;" />
                  </a> -->
               <video id="my-player" poster="{{asset('assets/images/audio-banner.jpg')}}" style="width: 100%" controls>
                  <source src="{{asset($talentInformation['sampleMedia'][0]->path_name)}}" type="video/x-matroska">
                  <source src="{{asset($talentInformation['sampleMedia'][0]->path_name)}}" type="video/x-matroska">
                  Your browser does not support
                  HTML5 video.
               </video>
               @endif
               @if(strtolower(end($video)) =="mp3")
               <video id="my-player" poster="{{asset('assets/images/talent-mall/audio-bg.png')}}" style="width: 100%" controls>
                  <source src="{{asset($talentInformation['sampleMedia'][0]->path_name)}}" type="video/mp3">
                  <source src="{{asset($talentInformation['sampleMedia'][0]->path_name)}}" type="video/ogg">
                  Your browser does not support
                  HTML5 video.
               </video>
               @endif
               @if(strtolower(end($video)) =="jpg" || strtolower(end($video)) =="png" || strtolower(end($video)) =="jpeg")
               <a href="javascript:void(0);"  class="cursor">
               <img src="{{ asset($talentInformation['sampleMedia'][0]->path_name)}}" alt="sample media"/>
               </a>                     
               @endif
            
            @endif
			</div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('javascript')
<script>
   $('#seller-video').on('click', function(){
     src = $(this).attr('data-src');
     $('#seller-video-modal video').attr('src', src);
     $('#seller-video-modal').modal();
   })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function(){
       var value = '<?php Session::get('isOpen') ?>';
       if(value == true) {
         $('#stripeModal').modal('show');  
       }
   });
   
   
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

