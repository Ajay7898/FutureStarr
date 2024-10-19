@extends('layouts.seller') @section('content')
<div id="seller-header">
	<div id="sub-header" class="container-fluid">
		<div class="row">
			<div class="col-sm-12 top-cls top-cls-l"></div>
		</div>
	</div>
</div>
<!--SideBar-Start---->
	<section class="buyer-con-section">
	<div class="container">
		<div class="row">
	   @include('frontend.sidebar.seller')
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="buyer-form commercial-sec">
					
           <div class="row">
              <div class="col-md-6">
                  <h4>Promote Product Section</h4>
              </div>
              <div class="col-md-6">
                <a href="{{route('seller.index')}}" class="pull-right back-btn seller-graph-back-btn" title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
              </div>
            </div>
					<div class="row">
           @if(count($products) == 0 )
                  @php $class = 'talent_list'; @endphp
            @else
                 @php $class = ''; @endphp
            @endif

            @if(count($products) > 0) 
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="dash-box-sec table-sec-btn">
								<div class="filter-n-btn-sec">
									Filter
									 <select class="form-control b-select" onchange="filterPromotedProduct(this)">
				                           <option value="">Default</option>
				                           <option value="30" <?php if(Request::segment(4) =='30') {echo 'selected';}?>>Last 30 Days</option>
				                           <option value="20" <?php if(Request::segment(4) =='20') {echo 'selected';}?>>Last 20 Days</option>
				                           <option value="10" <?php if(Request::segment(4) =='10') {echo 'selected';}?>>Last 10 Days</option>
				                        </select>
								</div>
								<div class="filter-n-btn-sec">
									<a href="{{ route('seller.my-product') }}">Promote New Product</a>
								</div>
							</div>
							
							<div class="dash-box-sec commercila tabs-n">
								<div class="img-box-tab">
									<div class="inbox_chat product-sec">
									
									    @foreach($products as $value)
									   @php 
      						               $urlToShare = route('talent.productInfo',$value->id);
                                       $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                                       if(!empty($value->getCommercila['image_path'])) {
                                       $contentType = mime_content_type($value->getCommercila['image_path']);

                                       if(! in_array($contentType, $allowedMimeTypes) ){
                                         $productImage= 'assets/images/star-logo.png'; 
                                         
                                       } else {
                                         $productImage= $value->getCommercila['image_path']; 
                                        }
                                      } else {
                                         $productImage= 'assets/images/star-logo.png'; 
      						               
                                      } @endphp
										<div class="chat_list">
										  <div class="chat_people">
											<div class="chat_img"> <img src="{{asset($productImage)}}" alt="sunil"> </div>
											<div class="chat_ib">
											  <h5>{{ $value->getTalent['title'] }} <span class="chat_date"><a href="javascript::void(0)" data-toggle="modal" data-target="#myModal-editPromoteProduct{{$value->id}}">Edit</a>&nbsp&nbsp|&nbsp&nbsp<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal-del{{$value->id}}">Delete</a></span></h5>
											  <p>{{ $value->getTalent['description'] }}</p>
											<div class="share-link-modal">
												<ul>
													<li><a href="http://www.facebook.com/sharer.php?u={{Request::url()}}"><i class="fa fa-facebook facebook" aria-hidden="true"></i> Facebook</a></li>
													<li><a href="http://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}"><i class="fa fa-linkedin linkedin" aria-hidden="true"></i> Linkdin</a></li>
													<li><a href="http://twitter.com/share?text=share&url={{Request::url()}}"><i class="fa fa-twitter twitter" aria-hidden="true"></i> Twitter</a></li>
												</ul>
											</div>
											<div class="share-linkn">
												<ul>
													<li><a href="">{{ $value->getTalent['active'] }}&nbsp&nbsp|&nbsp&nbsp</a></li>
													<!-- <li><a href="">10 Clicks</a></li> -->
													<li><a href="">{{ $value->getTalent['view'] }} Views&nbsp&nbsp|&nbsp&nbsp</a></li>
													<li><a href="">{{ promotedAwardCount($value->talent_id) }} Rewards</a></li>
												</ul>
											</div>
											
											</div>
											
										  </div>
										</div>
									   <div class="modal fade trophy-mod myModal-share" id="myModal-editPromoteProduct{{$value->id}}" role="dialog">
                                       <div class="modal-dialog">
                                          <div class="modal-content buyer-form">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button> 
                                                <h4 class="modal-title">Share on Socail Media</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="form-group">
                                                   <label>Title</label>
                                                   <input type="text" id="s-title{{$value->id}}" value="{{$value->title}}">
                                                   <span id="titleError{{$value->id}}" class="invalid-feedback"></span>
                                                </div>
                                                <div class="form-group">
                                                   <label>Your Message</label>
                                                   <textarea name="message" id="commentToShare{{$value->id}}" placeholder="Message" required>{{$value->message}}</textarea>
                                                   <span id="messageError{{$value->id}}" class="invalid-feedback"></span>
                                                </div>
                                                <input type="hidden" name="url" id="url{{$value->id}}" value="{{$urlToShare}}">
                                                <div class="share-link-modal">
                                                  @if($value->social_id =='facebook')
                                                    @php $activeShare = 'activeShare1'; @endphp
                                                  @elseif($value->social_id =='linkedin')
                                                    @php $activeShare = 'activeShare1'; @endphp
                                                  @elseif($value->social_id =='twitter')
                                                    @php $activeShare = 'activeShare1'; @endphp
                                                  @endif
                                                   <ul>
                                                      <li>
                                                        
                                                         <a data-name="facebook" data-talentid="{{$value->id}}" class="facebook customer share {{$activeShare}}" href="https://www.facebook.com/sharer.php?u={{ route('talent.productInfo',$value->talent_id)}}&quote=" title="Facebook share" target="_blank" data-link="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                                                      </li>
                                                      <li>
                                                  
                                                            <a data-name="linkedin" data-talentid="{{$value->id}}" class="linkedin customer share {{$activeShare}}" href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('talent.productInfo',$value->talent_id)}}&amp;summary=" title="linkedin Share" target="_blank" data-link="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i>LinkedIn</a>

                                                      </li>
                                                      <li>
                                                        
                                                         <a data-name="twitter" data-talentid="{{$value->id}}" class="twitter customer share {{$activeShare}}" href="https://twitter.com/share?url={{ route('talent.productInfo',$value->talent_id)}}&amp;text=Share talent &amp;hashtags=" title="Twitter share" target="_blank" data-link="twitter">
                                                          <i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a>
                                                      </li>
                                                   </ul>
                                                   <span id="socialNameError{{$value->id}}" class="invalid-feedback"></span>
                                                </div>
                                             </div>
                                             <div class="modal-footer sec-btn">
                                                <!-- <a href="javascript:void(0);" onclick="editPromoteProduct('{{$value->id}}')">Send</a> -->
                                                <a href="#" data-dismiss="modal">Cancel</a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
									<div class="modal fade" id="myModal-del{{$value->id}}" role="dialog">
                                       <div class="modal-dialog">
                                          <!-- Modal content-->
                                          <div class="modal-content buyer-form">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title"></h4>
                                             </div>
                                             <div class="modal-body">
                                                <p>"Are You Sure you want to Remove this item"</p>
                                             </div>
                                             <div class="modal-footer sec-btn">
                                                <a href="javascript:void(0);" onclick="deleteSellerPromoteProduct('{{$value->id}}')">Yes</a>
                                                <a href="#" data-dismiss="modal">No</a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
									  @endforeach
									  
									</div>
								</div>
								<div class="pagination-n">
                                 {!! $products->render() !!}
                              </div>
							</div>
							
						</div>


             @else
             <div class="col-md-12 col-sm-12 col-xs-12 {{$class}}">
                  <div class="dash-box-sec table-sec-btn">
                     <div class="filter-n-btn-sec">
                     </div>
                     <div class="filter-n-btn-sec">
                        <a href="{{ route('seller.my-product') }}">Promote New Product</a> 
                     </div>
                  </div>
             </div>
             @endif

					</div>
				</div>
			</div>
		</div>
</section>
<!-- all models -->
	
	<!-- all models -->
	<!--SideBar-End---->
@include('frontend.talent.login')
 <a class="scroll-top-arrow" href="javascript:void(0);"><i  class="ti-arrow-up"></i></a>
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
       var talentid = $(this).data('talentid');
       var title = $("#s-title"+talentid).val();
       var message = $("textarea#commentToShare"+talentid).val();
       var media = $(this).data('name');
      

      var hash = ',';
      var sharingText  = title+hash+message;
  
       if(message != '' && title !='') {
         if(media =='twitter') {

             var url = $(this).attr('href');
             var newHref = url.replace("hashtags=", "hashtags="+sharingText);
             $(this).attr('href',newHref);

         } else if(media =='linkedin') {
             
             var url = $(this).attr('href');
             var newHref = url.replace("summary=", "summary="+sharingText);
             $(this).attr('href',newHref); 
         
         } else if(media =='facebook') {
         
             var url = $(this).attr('href');
             var newHref = url.replace("quote=", "quote="+sharingText);
             $(this).attr('href',newHref);
         }   
         $(this).customerPopup(e); 

         var routeurl = '{!! route('seller.edit-promote-product') !!}';
          $.ajax({
            type: "post",
            url: routeurl,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "promote_id":talentid,
                  "title": title,
                  "message": message,
                  "social_name": media
            },
            success: function(response){
                  if(response.success) {
                   $('[id^="myModal-editPromoteProduct"]').modal('hide');
                    toastr.success(response.success);
                
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                  $("#titleError"+talentId).text(data.responseJSON.validation_errors.title);
                  $("#messageError"+talentId).text(data.responseJSON.validation_errors.message);
                  $("#socialNameError"+talentId).text(data.responseJSON.validation_errors.social_name);
              }     
            }
        });
       } else {
          e.preventDefault();
          toastr.error('Write something in title and message box.');
       }
        
   });
   });
   
   }(jQuery));
</script>
@stop()