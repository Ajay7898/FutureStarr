
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
      <div class="comment-sec align-sec">
         @if(!empty($socialbuzzList->getUserData['profile_pic']) && file_exists($socialbuzzList->getUserData['profile_pic']))
         <a target="_blank" href="{{ $profile_link }}" alt="public-profile">
         <img class="soc-image" src="{{ asset($socialbuzzList->getUserData['profile_pic'])}}" alt="Profile Image Future Starr">
         </a>
         @else
         <img class="soc-image" src="{{ asset('assets/images/social-buzz/logo-listing.png')}}" alt="Future star favicon">
         @endif
         <span>{{ $socialbuzzList->getUserData['username'] ?: '' }}</span>
         @if(Auth::check()  && Auth::user()->id == $socialbuzzList->posted_by)
         <div class="pull-right">
            <a class="text-danger" href="javascript::void(0);" data-toggle="modal" data-target="#edit_social_buzz<?php echo $i; ?>">
            <i class="fa fa-pencil" title="Edit Social Buzz"></i>
            </a>
         </div>
         @endif
      </div>
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
         @if (strpos($socialbuzzList->product_img_path, '.jpg') !== false || strpos($socialbuzzList->product_img_path, '.jpeg') !== false || strpos($socialbuzzList->product_img_path, '.png') !== false || strpos($socialbuzzList->product_img_path, '.jfif') !== false) 
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
         @if(strpos($socialbuzzList->product_img_path, '.mp3') !== false)
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
      <!-- <div class="input-sec">
         <input id="name" name="name" placeholder="http://prntscr.com/iayznk" class="form-control here" type="text">
         <img src="{{ asset('assets/images/social-buzz/clip.png')}}">
         <button>Send</button>
         </div> -->                     
   </div>
   <!-- Edit Social Buzz Modal Start-->
   <div class="modal fade report-user" id="edit_social_buzz<?php echo $j; ?>" role="dialog" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Edit Social Buzz</h4>
            </div>
            <div class="modal-body">
               <div class="centered-modal-body">
                  <form id="edit_scoial_buzz_form{{$socialbuzzList->id}}"  method="post" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="social_buzz_id" value="{{$socialbuzzList->id}}">
                     <div class="form-group">
                        <textarea class="form-control" name="comment" id="comment{{$socialbuzzList->id}}" required rows="3" cols="4" >{{$socialbuzzList->comment}}</textarea>
                     </div>
                     <div class="form-group">
                        <select class="form-control" id="product_link{{$socialbuzzList->id}}" name="product_link">
                           <option value="">Please choose product</option>
                           @if(!empty($products))
                           @foreach($products as $value)
                           <option value="{{ url('talent-mall/product-info/'.$value->id) }}" {{ $socialbuzzList->product_link == url('talent-mall/product-info/'.$value->id) ? 'selected' : '' }}>{{ $value->title}}</option>
                           @endforeach
                           @else 
                           <option value="" style="color:red;">No Product Available</option>
                           @endif
                        </select>
                     </div>
                     <div class="form-group">
                        <input class="form-control" type="file" data-toggle="tooltip" title="Add Image(jpeg,png,jpg), Audio(Mp3),Video(Mp4 ,Max-duration: 1-30 minutes)" id="chooseFile_edit{{$socialbuzzList->id}}" name="social_buzz_file" class="mb-0 p-0 tooltip">
                     </div>
                     <input type="hidden" name="previous_file" value="{{$socialbuzzList->product_img_path}}">
                     <img style="height:150px !important;width:300px !important;" id="show_image_edit{{$socialbuzzList->id}}" src="#" alt="image preview"></br>
                     <audio id="sound_edit{{$socialbuzzList->id}}" controls></audio>
                     <video autoplay="true" height="400" width="400" controls id="video_here1_edit{{$socialbuzzList->id}}">
                        <source src="" id="video_here_edit{{$socialbuzzList->id}}">
                        Your browser does not support HTML5 video.
                     </video>
                     <input type="submit" name="submit" value="save" id="edit_button{{$socialbuzzList->id}}" class="pi-btn">
                     <div id="loader{{$socialbuzzList->id}}" style='display: none;'>
                        <p>Your file is uploading
                           <img src="{{asset('assets/images/loading.gif')}}" width='32px' height='32px' alt="Loading Gif">
                        </p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         </form>
      </div>
   </div>
   <!-- Edit Social Buzz Modal End-->
  
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
                           <img  class="circular img-40" src="{{ !empty($comment->commentBy['profile_pic']) && file_exists($comment->commentBy['profile_pic']) ? asset($comment->commentBy['profile_pic']) : asset('assets/images/profile.png')}}">
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
                        <img  class="circular img-40" src="{{ !empty($fanbase->awardBy['profile_pic']) && file_exists($fanbase->awardBy['profile_pic']) ? $fanbase->awardBy['profile_pic']: asset('assets/images/profile.png') }}">
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
                     <!-- <i class="fa fa-bicycle"></i> -->
                     <img class="hover-images mcycle" src="{{ asset('assets/images/rider-green.png') }}"> <!-- http://localhost:8000/assets/images/rider-green.png-->
                     <span style="color:black">( {{ count($socialbuzzList->getSocialBuzzRiders)}} )</span>&nbsp;Riders
                  </h5>
                  <h4 class="modal-title"> Riders </h4>
               </div>
               <div class="modal-body">
                  <div class="centered-modal-body">
                     @if(count($socialbuzzList->selfRider) > 0)
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
                        <img  class="circular img-40" src="{{ !empty($fanbase->rideBy['profile_pic']) && file_exists($fanbase->rideBy['profile_pic']) ? $fanbase->rideBy['profile_pic'] :asset('assets/images/profile.png')}}">
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
   @endif           
   
