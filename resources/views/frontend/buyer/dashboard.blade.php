@extends('layouts.talent') 
@section('title', 'Future Starr | Buyer Dashboard')

@section('content')

<style>
.buyer-acont img {
    border-radius: 50%;
    object-fit: cover;
    object-position: top center;
    width: 150px!important;
    height: 150px;
}
.btn.btn-small {
    font-size: 14px;
    padding: 10px 40px;
}

p.no-msg {
    color: red !important;
    font-family: Oswald,sans-serif;
    font-size: 23px !important;
    padding: 15px;
}
.unread-msg{
    background: #69d569db;
    padding: 3px;
    border-radius: 50%;
    color: #000000;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- banner start -->
<section class="wow fadeIn cover-background socail-buzz background-position-top top-space buyer-banner-sec dash" style="background-image:url({{ asset('assets/images/buyer/buyer-banner.jpg')}});">
   <div class="bg-extra-dark-gray"></div>
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
            <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
               <!-- start page title -->
               <!-- <h1 class="alt-font text-white font-weight-600 mb-2">FutureStarr&nbsp;<i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Social Buzz</h1> -->
               <!-- end page title -->
               <!-- start sub title -->
               <!--  <span class="display-block text-white opacity6 alt-font">
                  Promote your Products</span> -->
               <!-- end sub title -->
            </div>
         </div>
      </div>
   </div>
</section>
<!--SideBar-Start---->
<section class="buyer-con-section">
   <div class="container">
   <div class="row">

      @include('frontend.sidebar.buyer')
      
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
         <div class="buyer-form buyer-product-trophy">
            <h4>Buyer Products</h4>
			<hr>
            <div class="row">
               @if(count($buyers) > 0 )
               @php $i = 1; $j = 1; @endphp
               @foreach($buyers as $buyer)
               @php
               $urlToShare = route('talent.productInfo',$buyer->talent_id)
               @endphp
              
               <div class="col-lg-4 col-md-6 col-sm-4 col-xs-12">
                  <div class="dash-box-sec">
                     <div class="img-box-n">
                     @if(!empty($buyer->getCommercila->image_path) && file_exists($buyer->getCommercila->image_path))
                        @php $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml']; @endphp
                        @php $allowedMimeTypes1 = ['audio/mp3', 'audio/mpeg']; @endphp
                        @php $allowedMimeTypes2 = ['video/mp4', 'video/mkv', 'video/wav']; @endphp
                        @php $contentType = mime_content_type($buyer->getCommercila->image_path); @endphp
                        @if(in_array($contentType, $allowedMimeTypes) )
                        <img src="{{asset($buyer->getCommercila->image_path)}}" class="product-img" alt="product-img">
                        @endif
                        @if(in_array($contentType, $allowedMimeTypes1) )
                        @php $video = explode(".",$buyer->getCommercila->image_path) @endphp
                        @if(strtolower(end($video)) =="mp3")
                        <video id="my-player" poster="{{asset('assets/images/talent-mall/audio-bg.png')}}" style="width: 100%" controls>
                           <source src="{{asset($buyer->getCommercila->image_path)}}" type="video/mp3">
                           <source src="{{asset($buyer->getCommercila->image_path)}}" type="video/ogg">
                           Your browser does not support
                           HTML5 video.
                        </video>
                        @endif
                        @endif
                        @if(in_array($contentType, $allowedMimeTypes2) )
                        @php $video = explode(".",$buyer->getCommercila->image_path) @endphp
                        @if(strtolower(end($video)) =="mp4" || strtolower(end($video)) =="ogv")
                        <video id="my-player" style="width: 100%" controls>
                           <source src="{{asset($buyer->getCommercila->image_path)}}" type="video/mp4">
                           <source src="{{asset($buyer->getCommercila->image_path)}}" type="video/ogg">
                           Your browser does not support
                           HTML5 video.
                        </video>
                        @endif
                        @if(strtolower(end($video)) =="mkv")
                        <video id="my-player" poster="{{asset('assets/images/audio-banner.jpg')}}" style="width: 100%" controls>
                           <source src="{{asset($buyer->getCommercila->image_path)}}" type="video/x-matroska">
                           <source src="{{asset($buyer->getCommercila->image_path)}}" type="video/x-matroska">
                           Your browser does not support
                           HTML5 video.
                        </video>
                        @endif
                        @endif
                        @endif
                        <div class="links-n">
                           <ul>
                              <li><a href="#" data-toggle="modal" data-target="#myModal-del{{$buyer->talent_id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                              <li><a href="" data-toggle="modal" data-target="#myModal-share{{$buyer->talent_id}}"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                              <li><a href="#" data-toggle="modal" data-target="#myModal-tro{{$buyer->talent_id}}"><i class="fa fa-trophy" aria-hidden="true"></i></a></li>
                              <li><a href="#" data-toggle="modal" data-target="#myModal-message{{$buyer->talent_id}}"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="heading-sec">
                        <p>{{ !empty($buyer->getTalent->title)?$buyer->getTalent->title:''}}</p>
                        <p>By : {{getUserName(!empty($buyer->getTalent->user_id)?$buyer->getTalent->user_id:'') }}</p>
                        <ul>
                           @php $rating = getTalentRating($buyer->talent_id);
                           @endphp
                           @if($rating !=0) 
                           @for($k= 0; $k < $rating; $k++)
                           <li><a href=""><i class="fa fa-trophy" aria-hidden="true"></i></a></li>
                           @endfor 
                           @php $loop = 5 - $rating @endphp         @for($l= 0; $l < $loop; $l++)
                           <li class="trophy"><a href=""><i class="fa fa-trophy" aria-hidden="true"></i></a></li>
                           @endfor
                           @else 
                           @for($j= 0; $j < 5; $j++)
                           <li class="trophy"><a href=""><i class="fa fa-trophy" aria-hidden="true"></i></a></li>
                           @endfor
                           @endif
                           <li><span>({{$rating}})</span></li>
                        </ul>
                     </div>
                     <div class="download-btn-sec">
                        <a class="d-load" href="#" data-toggle="modal" data-target="#myModal{{$buyer->talent_id}}">Download</a>
                        <a href="#" data-toggle="modal" data-target="#myModal-coment{{$buyer->talent_id}}">Leave comments</a>
                     </div>
                  </div>
               </div>
               <div class="modal fade myModal-del" id="myModal-del{{$buyer->talent_id}}" role="dialog">
                  <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content buyer-form">
                        <!-- <div class="modal-header"> -->
                        <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
                        <!-- <h4 class="modal-title">Modal Header</h4> -->
                        <!-- </div> -->
                        <div class="modal-body">
                           <p>"Are You Sure you want to Remove this item"</p>
                        </div>
                        <div class="modal-footer sec-btn">
                           <a href="javascript:void(0)" onclick="deleteBuyerProduct('{{$buyer->id}}','{{$buyer->talent_id}}')">Yes</a>
                           <a href="#" data-dismiss="modal">No</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal fade myModal-del" id="myModal{{$buyer->talent_id}}" role="dialog">
                  <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content buyer-form">
                        <!-- <div class="modal-header"> -->
                        <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
                        <!-- <h4 class="modal-title">Modal Header</h4> -->
                        <!-- </div> -->
                        <div class="modal-body">
                           <p>Do you want to download your product ?</p>
                        </div>
                        <div class="modal-footer sec-btn">
                           <a href="javascript:void(0)" onclick="downloadProduct('{{$buyer->talent_id}}')">Yes</a>
                           <a href="#" data-dismiss="modal">No</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="modal fade trophy-mod myModal-message" id="myModal-message{{$buyer->talent_id}}" role="dialog">
                  <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content buyer-form">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">×</button> 
                           <h4 class="modal-title">Send Message</h4>
                        </div>
                        <div class="modal-body">
                           <form>
                              <div class="form-group">
                                 <label>Message Title</label>
                                 <input type="text" id="message_title{{$buyer->talent_id}}" class="form-control">
                                 <span class="invalid-feedback" id="title_error{{$buyer->talent_id}}"></span>
                              </div>
                              <div class="form-group">
                                 <label>Your Message</label>
                                 <textarea name="message" id="message{{$buyer->talent_id}}" placeholder="Message" required=""></textarea>
                                 <span class="invalid-feedback" id="message_error{{$buyer->talent_id}}"></span>
                              </div>
                        </div>
                        <div class="modal-footer sec-btn">
                        <a href="javascript:void(0)" onclick="addBuyerMessage('{{$buyer->talent_id}}')">Send</a>
                        <a href="#" data-dismiss="modal">Cancel</a>
                        </div>
                     </div>
                     </form>
                  </div>
               </div>
               <div class="modal fade trophy-mod myModal-coment" id="myModal-coment{{$buyer->talent_id}}" role="dialog">
                  <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content buyer-form">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">×</button> 
                           <h4 class="modal-title">Leave Comment</h4>
                        </div>
                        <div class="modal-body">
                           <form>
                              <div class="form-group">
                                 <label>Leave Comment</label>
                                 <textarea name="message" id="leaveComment{{$buyer->talent_id}}" placeholder="Comment" required=""></textarea>
                                 <span class="invalid-feedback" id="commentError{{$buyer->talent_id}}"></span>
                              </div>
                        </div>
                        <div class="modal-footer sec-btn">
                        <a href="javascript:void(0)" onclick="addCommentToTalent('{{$buyer->talent_id}}')">Yes</a>
                        <a href="#" data-dismiss="modal">No</a>
                        </div>
                     </div>
                     </form>
                  </div>
               </div>
               <div class="modal fade trophy-mod myModal-share" id="myModal-share{{$buyer->talent_id}}" role="dialog">
                  <div class="modal-dialog">
                     <div class="modal-content buyer-form">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">×</button> 
                           <h4 class="modal-title">Share on Social Media</h4>
                        </div>
                        <div class="modal-body">
                           <form>
                              <div class="form-group">
                                 <label>Your Message</label>
                                 <textarea  name="message" id="commentToShare{{$buyer->talent_id}}" placeholder="Message" required></textarea>
                              </div>
                              <div class="share-link-modal">
                                 <ul>
                                    <li>
                                       <a data-id="{{$buyer->talent_id}}" data-name="facebook" title="Facebook share" href="http://www.facebook.com/sharer.php?u={{$urlToShare}}&quote=" target="_blank"  class="customer share" ><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                                    </li>
                                    <li>
                                       <a data-id="{{$buyer->talent_id}}" data-name="linkedin" class="customer share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{$urlToShare}}&amp;summary=" target="_blank" title="FutureStarr Talent share"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkdin</a>
                                    </li>
                                    <li>
                                       <a data-id="{{$buyer->talent_id}}" data-name="twitter" class="customer share" href="http://twitter.com/share?text=share&url={{$urlToShare}}&amp;text=Share talent &amp;hashtags=" target="_blank" title="FutureStarr talent share"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a>
                                    </li>
                                 </ul>
                              </div>
                           </form>
                        </div>
                        <div class="modal-footer sec-btn">
                       <!--  <a href="javascript:void(0);" onclick="shareSocilaMedia('{{$buyer->talent_id}}')">Send</a> -->
                        <a href="#" data-dismiss="modal">Cancel</a>
                        </div>
                     </div>
                     
                  </div>
               </div>
               <div class="modal fade myModal-tro" id="myModal-tro{{$buyer->talent_id}}" role="dialog">
                  <div class="modal-dialog">
                     <!-- Modal content-->
                     <div class="modal-content buyer-form">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">×</button> 
                           <h4 class="modal-title">Award Talent</h4>
                        </div>
                        <div class="modal-body">
                           <form>
                              <div class="heading-sec">
                                 <span>Give Award to Talent</span>
                                 <div class="rating-sec">
                                    @php $rating.$buyer->buyer_id = getTalentRatingByBuyer($buyer->buyer_id,$buyer->talent_id);
                                    $buyerRating = $rating.$buyer->buyer_id;
                                    @endphp
                                    <ul style="display: inline !important;">
                                       <li>
                                          <input type="radio"  name="rating" value="1"  title="Sucks big time - 1 star" <?php echo ($buyerRating=='1')?'checked':'' ?>>
                                          <i class="fa fa-trophy" aria-hidden="true"></i>
                                          @if($buyerRating=='1') ({{$buyerRating}}-trophy)
                                          @endif
                                       </li>
                                       <li>
                                          <input type="radio"  name="rating" value="2"  title="Kinda bad - 2 stars" <?php echo ($buyerRating=='2')?'checked':'' ?>>
                                          @for($i=0; $i <2; $i++)
                                          <i class="fa fa-trophy" aria-hidden="true"></i>
                                          @endfor
                                          @if($buyerRating=='2') ({{$buyerRating}}-trophy)
                                          @endif
                                       </li>
                                       <li>
                                          <input type="radio"  name="rating" value="3"  title="Meh - 3 stars" <?php echo ($buyerRating=='3')?'checked':'' ?>>
                                          @for($i=0; $i < 3; $i++)
                                          <i class="fa fa-trophy" aria-hidden="true"></i>
                                          @endfor
                                          @if($buyerRating=='3') ({{$buyerRating}}-trophy)
                                          @endif
                                       </li>
                                       <li>
                                          <input type="radio"  name="rating" value="4"  title="Pretty good - 4 stars" <?php echo ($buyerRating=='4')?'checked':'' ?>>
                                          @for($i=0; $i < 4; $i++)
                                          <i class="fa fa-trophy" aria-hidden="true"></i>
                                          @endfor
                                          @if($buyerRating=='4') ({{$buyerRating}}-trophy)
                                          @endif
                                       </li>
                                       <li>
                                          <input type="radio" name="rating" value="5"  title="Awesome - 5 stars" <?php echo ($buyerRating=='5')?'checked':'' ?>>
                                          @for($i=0; $i < 5; $i++)
                                          <i class="fa fa-trophy" aria-hidden="true"></i>
                                          @endfor
                                          @if($buyerRating=='5') ({{$buyerRating}}-trophy)
                                          @endif
                                       <li>
                                    </ul>
                                 </div>
                                 <span class="invalid-feedback" id="rating{{$buyer->talent_id}}"></span> 
                              </div>
                              <div class="form-group">
                                 <label>Leave Comment</label>
                                 <textarea name="message" id="comment{{$buyer->talent_id}}" placeholder="Comment" required="required"></textarea>  
                                 <span class="invalid-feedback" id="messagerating{{$buyer->talent_id}}"></span>
                              </div>
                        </div>
                        <div class="modal-footer sec-btn">
                        <a href="javascript:void(0)" onclick="addRating('{{$buyer->talent_id}}');">Yes</a>
                        <a href="#" data-dismiss="modal">No</a>
                        </div>
                     </div>
                     </form>
                  </div>
               </div>
               @endforeach
               @php $i++; $j++; @endphp
               @else
               <p class="npa">Sorry, No Product available.</p>
               <p class="npa" style="color:#000!important;">Start Shopping Here</p>
				<a class=" btn btn-small btn-dark-gray talent-mall" href="http://18.224.252.149/talent-mall">Talent Mall <span class="talent-icon"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span></a>
               @endif
            </div>
      
         </div>
      </div>
      <div class="col-md-3 col-sm-12 col-xs-12">
         <div class="message-sec side-sec">
            <h4>Inbox <span class="msg-count-out">(<span class="msg-count">0</span>)</span></h4>
            <div class="row">
               <div class="col-md-12">
                  <div class="inbox_chat">
                     <!--<a href="#">
                        <div class="chat_list">
                           <div class="chat_people">
                              <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                              <div class="chat_ib">
                                 <h5>Edward Standley,.. <span class="chat_date">11/15/17</span></h5>
                                 <p>Test, which is a new approach to have all solutions 
                                    astrology under one roof.
                                 </p>
                              </div>
                           </div>
                        </div>
                     </a> --> <p class="no-msg">0 Messages </p>     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
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
       var id = $(this).data('id');
       var message = $("textarea#commentToShare"+id).val();
       var media = $(this).data('name');
       if(message != '') {
         if(media =='twitter') {

             var url = $(this).attr('href');
             var newHref = url.replace("hashtags=", "hashtags="+message);
             $(this).attr('href',newHref);

         } else if(media =='linkedin') {
             
             var url = $(this).attr('href');
             var newHref = url.replace("summary=", "summary="+message);
             $(this).attr('href',newHref); 
         
         } else if(media =='facebook') {
         
             var url = $(this).attr('href');
             var newHref = url.replace("quote=", "quote="+message);
             $(this).attr('href',newHref);
         
         }                       
         $(this).customerPopup(e); 
       } else {
          e.preventDefault();
          toastr.error('Write something in message box.');
       }
        
   });
   });
   
   }(jQuery));
</script>
<script type="text/javascript">
@php 
	$a = request()->input('a');
@endphp
// function get_all_users() {
// 	$.ajax({
// 	   type: "GET",
// 	   url: '{!! url("/api/message/getinboxuser/".Auth::user()->id) !!}',
// 	   success: function(response) {
// 			var obj = response;
// 			var html = right_html = '';
// 			var i = 0;
// 			$.each(obj, function(key, value) {
// 				if(!value.first_name) {return;}
// 				if(value.profile_pic) {
// 					profile_pic = value.profile_pic;
// 				} else {
// 					profile_pic = 'assets/images/profile.png';
// 				}
				
// 				default_img = '/assets/images/profile.png';
// 				date = new Date(value.date);
				
// 				message = value.message;
// 				if(message) {
// 					message = message.substring(0, 20);
// 				}
				
// 				right_html += '<a href="{{ url('buyer/message/') }}?a=inbox&chat_id=''&name='' ''&received_by=''">';
// 				right_html += '<div class="chat_list"><div class="chat_people">';
// 				right_html += '<div class="chat_img"><img src="/''" alt="'' ''" onerror="this.src=\'''\'"></div>';
// 				right_html += '<div class="chat_ib">';
// 				right_html += '<h5><span class="chat_date">''</span></h5><p>''</p>';
// 				right_html += '</div>';
// 				right_html += '</div></div>';
// 				right_html += '</a>';
				
// 				i++;
// 			});
			
// 			if(right_html == '') {
// 				right_html = '<p class="no-msg">0 Messages </p>';
// 			}
			
// 			// $(".inbox_chat").html(right_html);
// 	   },
// 	   error: function(data){
// 		   toastr.error('Bad Request.');
// 	   }
// 	});
// }
$(document).on("click",".user_img",function() {
	var sent_by = $(this).attr('data-msg-id');
	$.ajax({
	   type: "GET",
	   url: '{!! url("/api/message/msgRead/".Auth::user()->id) !!}/'+sent_by,
	   success: function(response) {

	   },
	   error: function(data){
		   toastr.error('Bad Request.');
	   }
	});
   $(this).find('.unread-msg').hide();
});

function get_inbox_users() {
   jQuery.ajax({
      type: "GET",
      url: '{!! url("buyer-seller/inbox-message/buy") !!}',
      success: function(response) {
             // console.log('response', response);
          jQuery(".msg-count").html(response['count']);

         var html = response['messages']
         if(html == '') { html = "<p class='no-msg'>0 Messages</p>"; }
         

         jQuery(".inbox_chat").html(html);
      },
      error: function(data){
         toastr.error('Bad Request.');
      }
   });
}
$(function() {
	// get_all_users();
   get_inbox_users();
});
</script>
@stop

