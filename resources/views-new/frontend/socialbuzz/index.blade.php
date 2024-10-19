@extends('layouts.talent') 
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   .sta-r i.fa.fa-star {
   position: unset;
   }
   .input-sec {
   position: relative;
   }
   /* label.label_pro {
   position: absolute;
   left: 20px;
   } */
   .chose_product select {
   margin-top: 5px!important;
   }
   .sta-r i.fa.fa-star {
   color: red;
   }
   
    .extra-str {
    font-size: 22px !important;
    font-size: 30px !important;
    line-height: 50px !important;
   }
   
   .remove-preview{
    margin-left: 317px;
    cursor:pointer;
   }

   .label-upload{
      background-color:#80808063;
      color:black !important;
   }
   
</style>
<section class="wow fadeIn cover-background socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/social-buzz/banner-buzz.jpg')}});">
   <div class="opacity-medium bg-extra-dark-gray"></div>
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
            <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
               <!-- start page title -->
               <h1 class="alt-font text-white font-weight-600 mb-2">FutureStarr&nbsp;<i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Social Buzz</h1>
               <!-- end page title -->
               <!-- start sub title -->
               <span class="display-block text-white opacity6 alt-font">
               Promote your Products</span>
               <!-- end sub title -->
            </div>
         </div>
      </div>
   </div>
</section>
<section class="knowledge-section">
   <div class="container">
      <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="dash-heading colorClass">
               <h3>Trending</h3>
            </div>
            <div class="sidebar-nav knowledge">
               <div class="well">
                  <ul class="nav nav-list">
                     @if(count($talentCategories) > 0)
                     @php $requestSegment =  Request::segment(2) @endphp
                     @if(empty($requestSegment))
                     @php  $categorySelect = $firstCategory['id'] @endphp
                     @else
                     @php  $categorySelect = $category_id @endphp
                     @endif
                     @foreach($talentCategories as $category)
                     <li class="<?php if($category->id == $categorySelect){ echo 'active'; }?>">
                        <a href="{{ url('/social-buzz/'.$category->slug)}}">
                        <img src="{{ asset('assets/'.$category->tarending_catagory_sidebar_icon )}}" alt="{{$category->category_alt_social_buzz}}"> {{ $category->name }}
                        </a>
                     </li>
                     @endforeach
                     @else
                     <li>No Categories Found!!</li>
                     @endif
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-sm-7 col-md-7 buzz-middle new">
            <div class="dash-heading">
              <h2 class="extra-str">{{ $categoryInfo->name }}</h2>
            </div>
            <div class="listing-buzz row">
               <div class="col-md-12">
                  <div class="main-sec-listinhg">
                     <div class="comment-sec align-sec">
                        <img src="{{ asset('assets/images/social-buzz/logo-listing.png')}}" alt="Future star favicon">
                        <span>Start Promoting!</span>
                     </div>
                     <form  id="social-buzz-form" method="POST" enctype="multipart/form-data" action="{{ route('social-buzz.store') }}">
                        @csrf
                        <div class="message-box align-sec">
                           <textarea class="form-control @error('comment') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" placeholder="Enter text here..." name="comment" data-emojiable="true"
                              data-emoji-input="unicode"required style="border: 3px solid #fff41c; height:140px;"></textarea>
                            @error('comment')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                            @enderror
                            
                        </div>
                        <input type="hidden" name="category_id" value="{{ $categorySelect }}">
                        <div class="input-sec" style="padding: 20px;padding-top: 0px;padding-bottom: 0px;">
                           <div class="chose_product">
                              <label class="label_pro" >
                              <span class="sta-r"><i class="fa fa-star" aria-hidden="true"></i></span> 
                              Seller only
                              <span class="sta-r"><i class="fa fa-star" aria-hidden="true"></i></span>
                              </label>
                              <select style="margin-top: 20px; border: 3px solid #fff41c;width: 100%;" class="form-control" id="product_link" name="product_link">
                                 <option value="">Please choose product</option>
                                 @if(!empty($products))
                                 @foreach($products as $value)
                                 <option value="{{ url('talent-mall/product-info/'.$value->slug) }}">{{ $value->title}}</option>
                                 @endforeach
                                 @else 
                                 <option value="" style="color: red;">No Product Available</option>
                                 @endif
                              </select>
                           </div>
                           <span class="file-input d-flex align-items-center " >
                           <img alt="camera" src="{{ asset('assets/images/social-buzz/camera-clip.webp')}}">
                           <label style="font-size: 14px; color: #979797; font-weight: normal; margin-top: 9px; padding: 6px; border-radius: 9px;" id="upload_label">Upload Image/Video</label>
                           <input type="file" data-toggle="tooltip" title="Add Image(jpeg,png,jpg), Audio(Mp3),Video(Mp4 ,Max-duration: 1-30 minutes)" id="chooseFile" name="profile_pic" class="mb-0 p-0 tooltip">
                           @error('profile_pic')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                            @enderror
                           </span>
                        </div>
                        <div class="social_buzz_submit_box" style="padding: 20px;">
                           @if($check==true)
                           <button type="submit" class="hide-off">Send</button>
                           <button  id='loader-button' style='display: none;' class="btn btn-primary sp" type="button" disabled >
                           <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                           Sending
                           </button>
                           @else
                           <button type="button" data-toggle="modal" data-target="#register_my_model">Send</button>
                           @endif
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                           <br><br>
                           <span class="glyphicon glyphicon-remove-circle text-danger remove-preview"></span>
                           </div>
                        </div>
                        <img style="height:150px !important;width:300px !important;" id="show_image" src="#" alt="image preview"></br>
                        <audio id="sound" controls></audio>
                        <video autoplay="true" width="300" controls id="video_here1" style="width: 50% !important">
                           <source src="" id="video_here">
                           Your browser does not support HTML5 video.
                        </video>
                     </form>
                  </div>
                <div id="social-buzz-list">
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
                                <img class="img-fluid" src="{{ URL::asset($socialbuzzList->product_img_path)}}" style="height: 300px !important;" alt="Social Media Images">
                           @endif
                        @endif

                        @if(strpos($socialbuzzList->product_img_path, '.mp4') !== false)
                        <video id="my-player" oster="{{asset('assets/images/music-background.png')}}" style="width: 100%;height: 300px !important;" controls>
                        <source src="{{asset($socialbuzzList->product_img_path)}}" type="video/mp4">
                        <source src="{{asset($socialbuzzList->product_img_path)}}" type="video/ogg">
                        Your browser does not support
                        HTML5 video.
                        </video>
                        @endif
                        @if(strpos($socialbuzzList->product_img_path, '.mp3') !== false)
                        <video id="my-player" poster="{{asset('assets/images/talent-mall/audio-bg.png')}}" style="width: 100%;height: 300px !important;" controls preload="auto" autobuffer>
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
                                          <img alt="profileImage"  class="circular img-40" src="{{ !empty($comment->commentBy['profile_pic']) && file_exists($comment->commentBy['profile_pic']) ? asset($comment->commentBy['profile_pic']) : asset('assets/images/profile.png')}}">
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
                                       <img alt="profileImage" class="circular img-40" src="{{ !empty($fanbase->awardBy['profile_pic']) && file_exists($fanbase->awardBy['profile_pic']) ? $fanbase->awardBy['profile_pic']: asset('assets/images/profile.png') }}">
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
                                    <img alt="bicycle" class="hover-images mcycle" src="{{ asset('assets/images/rider-green.png') }}"> <!--  http://localhost:8000/assets/images/rider-green.png -->
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
                                       <img alt="profileImage" class="circular img-40" src="{{ !empty($fanbase->rideBy['profile_pic']) && file_exists($fanbase->rideBy['profile_pic']) ? $fanbase->rideBy['profile_pic'] :asset('assets/images/profile.png')}}">
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
                                      <a href="{{ $socialbuzzList->product_link }}"  class="btn btn-danger" target="_blank">YES</a>

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
                        
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title"> Share </h4>
                              </div>
                              <div class="modal-body">
                           
                                 @if(!empty($socialbuzzList->product_link))
                                 <div class="form-group">
                                    <div class="btn-group btn-icons" role="group">
                                       <br />
                                       <ul class="nav">
                                          <li class="list-item-facebook">
                                             <a href="http://www.facebook.com/sharer.php?u={{ $socialbuzzList->product_link }}" target="_blank" class="social-btn-facebook btn modal-btn btn-bg customer share">
                                             <i class="fa fa-facebook"> </i>
                                             <span class="separator"></span> FACEBOOK</a>
                                          </li>
                                          <li class="list-item-instagram">
                                             <a href="https://plus.google.com/share?url={{ $socialbuzzList->product_link }}" target="_blank" class="social-btn-instagram btn modal-btn btn-bg customer share">
                                             <i class="fa fa-google-plus"></i>
                                             <span class="separator"></span> GOOGLE +</a>
                                          </li>
                                          <li class="list-item-twitter">
                                             <a href="http://twitter.com/share?text=share&url={{ $socialbuzzList->product_link }}
                                             " target="_blank" class="social-btn-twitter btn modal-btn btn-bg customer share">
                                             <i class="fa fa-twitter"></i>
                                             <span class="separator"></span> TWITTER</a>
                                          </li>
                                          <li class="list-item-linkedin">
                                             <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{  $socialbuzzList->product_link }}" target="_blank" class="social-btn-linkedin btn modal-btn btn-bg customer share">
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
                  <h2 class="text-danger text-center extra-str" style="margin-top: 5pc; margin-bottom: 5pc;">No Social Buzz available. </h2>
                  @endif
                  </div>           
               </div>
               <div class="pagination-n" style="margin: 5px 0px 5px 15pc !important;">
                  <!-- Pagination links goes here --->
                  @if($socialBuzzCount > 10)
                  <a href="javascript:void(0);" id="{{ $socialbuzzList->id }}" class="show_more btn btn-success text-center" title="Load more posts" data-category="{{ $categoryInfo->id }}">Show more</a>

                  <span class="loding btn btn-success text-center" style="display: none;">
                     <span class="loding_txt">Loading...</span>
                  </span>
                  @endif

               </div>
            </div>
         </div>

         <div class="col-md-2 col-sm-2 sidebar-sec">
            @if(count($ads) > 0 )
            @foreach($ads as $ad)
            @php
            $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml','video/mp4', 'video/mkv', 'video/.wav'];
            $contentType = mime_content_type($ad->video_path);
            if(strstr($contentType, "video/")) {
            $video = explode(".",$ad->video_path);
            if(strtolower(end($video)) =="mp4" || strtolower(end($video)) =="ogv"){
            @endphp
            <div class="buzz-side-sec" onclick="addAdView('{{$ad->ad_id}}')" data-id="{{$ad->ad_id}}">
               <a target="_blank" href="{{route('talent.productInfo',$ad->product_id)}}">
                  <video id="my-player" style="width: 100%" controls>
                     <source src="{{asset($ad->video_path)}}" type="video/mp4">
                     <source src="{{asset($ad->video_path)}}" type="video/ogg">
                     Your browser does not support
                     HTML5 video.
                  </video>
               </a>
            </div>
            @php } else if(strtolower(end($video)) =="mkv") { @endphp  
            <div class="buzz-side-sec" onclick="addAdView('{{$ad->ad_id}}')" data-id="{{$ad->ad_id}}">
               <a target="_blank" href="{{route('talent.productInfo',$ad->product_id)}}">
                  <video id="my-player" style="width: 100%" controls>
                     <source src="{{asset($ad->video_path)}}" type="video/x-matroska">
                     <source src="{{asset($ad->video_path)}}" type="video/x-matroska">
                     Your browser does not support
                     HTML5 video.
                  </video>
               </a>
            </div>
            @php
            }
            } else if(strstr($contentType, "image/")){
            if(! in_array($contentType, $allowedMimeTypes) ){
            $adImage= 'assets/images/social-buzz/ad.png'; @endphp
            <div class="buzz-side-sec" onclick="addAdView('{{$ad->ad_id}}')" data-id="{{$ad->ad_id}}">
               <a target="_blank" href="{{route('talent.productInfo',$ad->product_id)}}">
               <img alt="Ad" src="{{ asset($adImage)}}">
               </a>
            </div>
            @php } else { @endphp
            <div class="buzz-side-sec" onclick="addAdView('{{$ad->ad_id}}')" data-id="{{$ad->ad_id}}">
               <a target="_blank" href="{{route('talent.productInfo',$ad->product_id)}}">
               <img alt="Ad" src="{{ asset($ad->video_path)}}">
               </a>
            </div>
            @php }
            }
            @endphp
            @endforeach
            @else
            @for($i = 0; $i <= 4; $i++)
            @if(Auth::check() && Auth::user()->role_id =='4')
            <div class="place_ad_here">
               <a href="{{ route('seller.commercial-ads-dashboard') }}">
               <img class="place_ad_here-image" src="{{ asset('assets/images/social-buzz/Place-Ad.jpg') }}" alt="place_ad_here-image"></a>
               </a>
            </div>
            @elseif(Auth::guest() || Auth::user()->role_id == '3')
            <div class="place_ad_here">
               <a href="javascript:void();" data-toggle="modal" data-target="#place_ad_here">
               <img class="place_ad_here-image" src="{{ asset('assets/images/social-buzz/Place-Ad.jpg') }}" alt="place_ad_here-image"></a>
               </a>
            </div>
            @endif
            @endfor 
            @endif
         </div>
      </div>
   </div>
   </div>
</section>

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
<div class="social-buzz-modals">
   <div class="modal fade share-modal" id="place_ad_here" role="dialog">
      <div class="modal-dialog">
         <form #social="ngForm" (ngSubmit)="shareOnSocialMedia(social)">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title"> Place Ad here </h4>
            </div>
            <div class="modal-body">
               <h4 class="text-center">Seller can only post ads.</h4>
               <h5 class="text-center">Please login into your Seller's account or Register a new account.</h5>
            </div>
            <div class="modal-footer">
               <!-- <button type="submit" class="btn btn-danger">SHARE</button> -->
               <!-- <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button> -->
            </div>
         </div>
         </form>
      </div>
   </div>
</div>
<div class="messageContainer"></div>


@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;"><i  class="ti-arrow-up"></i></a>
@endsection
@section('javascript')
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
   
   <link rel="stylesheet" href="{{ asset('assets/css/emojionearea.min.css') }}">
   <script src="{{ asset('assets/js/emojionearea.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
  
   $(document).ready(function(){

     //Changed By Chetan
     $('#exampleFormControlTextarea1').emojioneArea({
         useSprite: false,
         pickerPosition: "top"
      });

       $(document).on('click','.show_more',function(){
           var ID = $(this).attr('id');
          
           var category_id = $(this).data('category');
           
           $('.show_more').hide();
           $('.loding').show();
           $.ajax({
                 url: '{!! route('social-buzz.index') !!}',
                 type: 'GET',
                 data: {
                     "_token": "{{ csrf_token() }}",
                     "category": category_id,
                     "social_buzz_id":ID
                 },
                 success: function(response) {
                      $('.loding').remove();
                      $("#social-buzz-list").append(response.social_buzz);
                      $(".show_more").remove();
                      if(response.count  > 10) {
                        $(".pagination-n").append(response.category);  
                      } 

                   },
                 error:function(error) {
                    //console.log('error', error);
                 }
           });
       });
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
<script type="text/javascript">
   function addAdView(adId) {
        var url = '{!! route('social-buzz.add-ad-views') !!}';     
         $.ajax({
            type: "post",
            url: url,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "ad_id":adId
            },
            success: function(response){
            /*     if(response.validation_error) {
                    toastr.warning(response.validation_error);
                 }
                 if(response.success) {
                    toastr.success(response.success);
                       setTimeout(function(){ window.location.reload() }, 1000);
                 }
                  if(response.error) {
                    toastr.error(response.error);
                  }*/
            },
            error: function(data){
              /*  toastr.error('Bad Request.')*/;
            }
        });
   }
</script>
<script type="text/javascript">
   $(document).ready(function(){
       $('#show_image').hide();
       $('.remove-preview').hide();
       $('#sound').hide();
       $('#video_here1').hide();
    });
   function readURL(input) {
     if (input.files && input.files[0]) {
       var reader = new FileReader();
      
       reader.onload = function(e) {
          //console.log(e.target.result);
          var hasString = e.target.result
          if (hasString.indexOf('data:image/jpeg') > -1 || hasString.indexOf('data:image/png') > -1 || hasString.indexOf('data:image/jpg') > -1){
              $('#sound').hide();
              $('#video_here1').hide();
              $('#show_image').show();
              $('#show_image').attr('src', e.target.result);
              $('#upload_label').removeClass("label-upload");
         } else if(hasString.indexOf('data:audio/mp3') > -1 || hasString.indexOf('data:audio/mpeg') > -1){
              $('#show_image').hide();
              $('#video_here1').hide();
              var sound = document.getElementById('sound');
              sound.src = URL.createObjectURL(input.files[0]);
              sound.onend = function(e) {
                URL.revokeObjectURL(input.src);
              }
              $('#sound').show();
              $('#upload_label').removeClass("label-upload");
         } else if(hasString.indexOf('data:video/mp4') > -1){
              $('#sound').hide();
              $('#show_image').hide();
              var $source = $('#video_here');
              $source[0].src = URL.createObjectURL(input.files[0]);
              $source.parent()[0].load();
              $('#video_here1').show();
              $('#upload_label').removeClass("label-upload");
         }  else {
             
         }
         $('.remove-preview').show();
       }
       reader.readAsDataURL(input.files[0]);
     }
     $(document).on("click",".remove-preview",function() {
         $('#show_image').hide();
         $('#sound').hide();
         $('#video_here1').hide();
         $('#upload_label').addClass("label-upload");
         $(this).hide();
     });
   }
   
   $("#chooseFile").change(function() {
       var fileName = $('#chooseFile')[0].files[0].name;
          var file = $('#chooseFile')[0].files[0];
          var fileType = file["type"];
          
          var checkFileSize =  $('#chooseFile')[0].files[0].size/ 1024;
          if(checkFileSize > 10000){
            toastr.info('FutureStarr accept maximum file size of 10MB.');
            $("#chooseFile").val('');
            return false;
          }
          if(fileType == "video/mp4"){
               var vid = document.createElement('video');
               var fileURL = URL.createObjectURL(file);
               vid.src = fileURL;
             // wait for duration to change from NaN to the actual duration
               vid.ondurationchange = function() {
                   var duration = this.duration;
                   if(duration > 1800 || duration < 1) {
                      $("#chooseFile").val('');
                      toastr.error('Invalid video duration.Video duration should be between 1-30 minutes.');
                      $("#chooseFile").val('');
                      return false;
                   }
               };
          } else {
              var validImageTypes = ["image/jpg" ,"image/jpeg", "image/png", "audio/mp3", "audio/mpeg", "video/mp4"];

              if ($.inArray(fileType, validImageTypes) > 0) {    
                  $("#noFile1").text(fileName);
              } else {
                  $("#chooseFile").val('');
                  toastr.error('Invalid Image, Audio or video format.');
              }  
           }
          
     readURL(this);
   });
   
</script>
<!---------  Social Buzz Edit Script Start ---------->
<script type="text/javascript">
   $(document).ready(function(){
      
    $('[id^="show_image_edit"]').hide();
    $('[id^="sound_edit"]').hide();
    $('[id^="video_here1_edit"]').hide();
   });
   function readURLEdit(input) {
   if (input.files && input.files[0]) {
    var reader = new FileReader();
   
    reader.onload = function(e) {
      // console.log(e.target.result);
       var hasString = e.target.result
       if (hasString.indexOf('data:image/jpeg') > -1 || hasString.indexOf('data:image/png') > -1 || hasString.indexOf('data:image/jpg') > -1){
           $('[id^="sound_edit"]').hide();
           $('[id^="video_here1_edit"]').hide();
           $('[id^="show_image_edit"]').show();
           $('[id^="show_image_edit"]').attr('src', e.target.result);
      } else if(hasString.indexOf('data:audio/mp3') > -1 || hasString.indexOf('data:audio/mpeg') > -1){
           $('[id^="show_image_edit"]').hide();
           $('[id^="video_here1_edit"]').hide();
           var sound = document.getElementById('sound');
           sound.src = URL.createObjectURL(input.files[0]);
           sound.onend = function(e) {
             URL.revokeObjectURL(input.src);
           }
           $('[id^="sound_edit"]').show();
      } else if(hasString.indexOf('data:video/mp4') > -1){
           $('[id^="sound_edit"]').hide();
           $('[id^="show_image_edit"]').hide();
           var $source = $('[id^="video_here_edit"]');
           $source[0].src = URL.createObjectURL(input.files[0]);
           $source.parent()[0].load();
           $('[id^="video_here1_edit"]').show();
      }  else {
          
      }
    }
    reader.readAsDataURL(input.files[0]);
   }
   }
   
   $('[id^="chooseFile_edit"]').change(function() {
    var fileName = $('[id^="chooseFile_edit"]')[0].files[0].name;
       var file = $('[id^="chooseFile_edit"]')[0].files[0];
       var fileType = file["type"];
       var checkFileSize =  $('[id^="chooseFile_edit"]')[0].files[0].size/ 1024;
       if(checkFileSize > 10000){
         toastr.info('FutureStarr accept maximum file size of 10MB.');
         $('[id^="chooseFile_edit"]').val('');
         return false;
       }
       if(fileType == "video/mp4"){
            var vid = document.createElement('video');
            var fileURL = URL.createObjectURL(file);
            vid.src = fileURL;
          // wait for duration to change from NaN to the actual duration
            vid.ondurationchange = function() {
                var duration = this.duration;
                if(duration > 1800 || duration < 1) {
                   $('[id^="chooseFile_edit"]').val('');
                   toastr.error('Invalid video duration.Video duration should be between 1-30 minutes.');
                   return false;
                }
            };
       } else {
           var validImageTypes = ["image/jpg" ,"image/jpeg", "image/png", "audio/mp3", "audio/mpeg", "video/mp4"];
           if ($.inArray(fileType, validImageTypes) > 0) {    
               $("#noFile1_edit").text(fileName);
           } else {
               $('[id^="chooseFile_edit"]').val('');
               toastr.error('Invalid Image, Audio or video format.');
           }  
        }
       
   readURLEdit(this);
   });
</script>
<script type="text/javascript">
   $('[id^="edit_scoial_buzz_form"]').on('submit', function(event){
   event.preventDefault();
   $.ajax({
   url:"{!! route('edit-scoial-buzz') !!}",
   method:"POST",
   data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,
   beforeSend: function(){
    // Show image container
    $('[id^="loader"]').show();
    $('[id^="edit_button"]').hide();
   },
   success:function(response) {
      console.log(response);
       if(response.success) {
          $('[id^="edit_social_buzz"]').modal('hide');
           toastr.success(response.success);
              setTimeout(function(){ window.location.reload(); }, 1000);
        }
        if(response.error) {
         toastr.error(response.error);
        }
        if(response.warning) {
           toastr.warning(response.warning);
        }
   },
    complete:function(data){
       // Hide image container
       $('[id^="loader"]').hide();
   }, error:function(data) {
       $('[id^="edit_button"]').show();
   }
   })
   });
   
   $(function(){
      $('.modal').on('hidden.bs.modal', function(){
          $('[id^="chooseFile_edit"]').val('');
          $('[id^="show_image_edit"]').hide();
          $('[id^="sound_edit"]').hide();
          $('[id^="video_here1_edit"]').hide();
   });
   });
   
   $(function(){
    $('#social-buzz-form').submit(function() {
        $('#loader-button').show(); 
        $(".hide-off").hide();
      return true;
    });
   });
   
   
</script>
<!---------  Social Buzz Edit Script End ---------->
@stop