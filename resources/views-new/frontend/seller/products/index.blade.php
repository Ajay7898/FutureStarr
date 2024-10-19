@extends('layouts.seller') @section('content')
<div id="seller-header">
   <div id="sub-header" class="container-fluid" >
      <div class="row">
         <div class="col-sm-12 top-cls top-cls-l"></div>
      </div>
   </div>
</div>
<style>

.product-sell a {
    padding: 9px 10px !important;
    background: #2167c5 !important;
    border: 0 !important;
    font-size: 11px !important;
    color: #fff;
}

   #facebookCheckbox { visibility: hidden; } 
</style>
<!--SideBar-Start---->
<section class="buyer-con-section">
   <div class="container">
   <div class="row">
      @include('frontend.sidebar.seller')
      <div class="col-md-8 col-sm-8 col-xs-12">
         <div class="buyer-form commercial-sec">
            
              <div class="row">
                  <div class="col-md-6">
                      <h4>Product Section</h4>
                  </div>
                  <div class="col-md-6">
                    <a href="{{route('seller.index')}}" class="pull-right back-btn seller-graph-back-btn"  title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
                  </div>
               </div>
            <div class="row">
                @if(count($talents) == 0 )
                  @php $class = 'talent_list'; @endphp
                @endif
               @if(count($talents) > 0)
               <div class="col-md-12 col-sm-12 col-xs-12">
                  
                  <div class="dash-box-sec table-sec-btn">
                     <div class="filter-n-btn-sec">
                        Filter
                        <select class="form-control b-select" onchange="filter(this)">
                           <option value="">Default</option>
                           <option value="30" <?php if(Request::segment(4) =='30') {echo 'selected';}?>>Last 30 Days</option>
                           <option value="20" <?php if(Request::segment(4) =='20') {echo 'selected';}?>>Last 20 Days</option>
                           <option value="10" <?php if(Request::segment(4) =='10') {echo 'selected';}?>>Last 10 Days</option>
                        </select>
                     </div>
                     <div class="filter-n-btn-sec">
                        <a href="javascript:void(0)" id="delete_records"><i class="fa fa-trash" aria-hidden="true"></i> Mass Delete</a>
                        @if(!empty($checkSellerStripeAccount))
                        <a href="{{route('seller.add-product')}}"><i class="fa fa-plus" aria-hidden="true"></i> Create a Product</a>
                        @else
                        <a href="javascript:void();" data-toggle="modal" data-target="#stripeModal"><i class="fa fa-plus" aria-hidden="true"></i> Create a Product</a>
                        @endif
                     </div>
                  </div>
                  <div class="dash-box-sec commercila tabs-n">
                     <div class="img-box-tab">
                        <div class="table-data">
                           <div class="table-responsive">
                              <table class="table table-striped">
                                 <thead>
                                    <tr>
                                       <th><input type="checkbox" name="vehicle1" value="" id="select_all" style="display: block !important;"></th>
                                       <th>Product</th>
                                       <th>Active/Deactive</th>
                                       <!-- <th>Admin Approval</th> -->
                                       <th>Views</th>
                                       <th>Awards</th>
                                       <th>Price</th>
                                       <th></th>
                                       <th></th>
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                    @foreach($talents as $talent)
                                    @php 
                                    $urlToShare = route('talent.productInfo',$talent->id);
                                    if(file_exists($talent->getCommercila['image_path'])) {
                                    $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                                    $contentType = mime_content_type($talent->getCommercila['image_path']);
                                    if(! in_array($contentType, $allowedMimeTypes) ){
                                    $productImage= 'assets/images/star-logo.png'; 
                                    } else {
                                    $productImage= $talent->getCommercila['image_path']; 
                                    }
                                    } else {
                                    $productImage= 'assets/images/star-logo.png'; 
                                    }
                                    if($talent->approved ==0) {
                                    $approvedStatus = 'Pending';
                                    } else if($talent->approved){
                                    $approvedStatus = 'Approved';
                                    } else {
                                    $approvedStatus = 'Rejected';
                                    }
                                    @endphp
                                    <tr>
                                       <td><input type="checkbox" name="products" value="{{$talent->id}}" class="emp_checkbox" data-emp-id="{{$talent->id}}"></td>
                                       <td style="padding:0px !important;" class="img-sec pro-sec-image">
                                       <a target="_blank" href="{{ route('talent.productInfo',$talent->slug)}}">  
                                           <img  src="{{ asset($productImage)}}">
                                           <span>{!! Str::limit(strip_tags($talent->title), 25) !!}</span>
                                       </a>
                                       </td>
                                       <td>{{$talent->active}}</td>
                                       <!-- <td>{{$approvedStatus}}</td> -->
                                       <td>{{$talent->view}}</td>
                                       <td>{{!empty($talent->getTalentAwards)?count($talent->getTalentAwards):0}}</td>
                                       <td>{{$talent->price}}</td>
                                       <td><a class="pencil"  href="{{URL::to('seller/edit-product/'.$talent->id)}}"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #ff503f;"></i></a>
                                       </td>
                                       <td><i  class="fa fa-trash" aria-hidden="true" style="color: #000;" data-toggle="modal" data-target="#myModal-del{{$talent->id}}"></i></td>
                                       <td class="product-sell"><a class="product-sell-pp" href="javascript:void(0)" data-toggle="modal"  data-target="#myModal-share{{$talent->id}}" >Promote Product</a></td>
                                    </tr>
                                    <div class="modal fade" id="myModal-del{{$talent->id}}" role="dialog">
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
                                                <a href="javascript:void(0);" onclick="deleteSellerProduct('{{$talent->id}}')">Yes</a>
                                                <a href="#" data-dismiss="modal">No</a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="modal fade trophy-mod myModal-share" id="myModal-share{{$talent->id}}" role="dialog">
                                       <div class="modal-dialog">
                                          <div class="modal-content buyer-form">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button> 
                                                <h4 class="modal-title">Share on Social Media</h4>
                                             </div>
                                             <form id="sharingform">
                                             <div class="modal-body">
                                                <div class="form-group">
                                                   <label>Title</label>
                                                   <input type="text" id="s-title{{$talent->id}}" value="">
                                                   <span id="titleError{{$talent->id}}" class="invalid-feedback"></span>
                                                </div>
                                                <div class="form-group">
                                                   <label>Your Message</label>
                                                   <textarea name="message" id="commentToShare{{$talent->id}}" placeholder="Message" required></textarea>
                                                   <span id="messageError{{$talent->id}}" class="invalid-feedback"></span>
                                                </div>
                                                <input type="hidden" name="url" id="url{{$talent->id}}" value="{{$urlToShare}}">
                                                <div class="share-link-modal">
                                                   <ul>
                                                      <li>
                                                         
                                                         <a data-name="facebook" data-talentid="{{$talent->id}}" class="facebook customer share" href="https://www.facebook.com/sharer.php?u={{ route('talent.productInfo',$talent->id)}}&quote=" title="Facebook share" target="_blank" data-link="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a>
                                                      </li>
                                                      <li>
                                                         
                                                         <a data-name="linkedin" data-talentid="{{$talent->id}}" class="linkedin customer share" href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('talent.productInfo',$talent->id)}}&amp;summary=" title="linkedin Share" target="_blank" data-link="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i>LinkedIn</a>
                                                      </li>
                                                      <li>
                                                         
                                                         <a data-name="twitter" data-talentid="{{$talent->id}}" class="twitter customer share" href="https://twitter.com/share?url={{ route('talent.productInfo',$talent->id)}}&amp;text=Share talent &amp;hashtags=" title="Twitter share" target="_blank" data-link="twitter">
                                                          <i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a>
                                                      </li>
                                                   </ul>
                                                   <span id="socialNameError{{$talent->id}}" class="invalid-feedback"></span>
                                                </div>
                                             </div>
                                          </form>
                                             <div class="modal-footer sec-btn">
                                                <!-- <a href="javascript:void(0);" onclick="SellershareSocilaMedia('{{$talent->id}}')">Send</a> -->
                                                <a href="#" data-dismiss="modal">Cancel</a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                   
                                 </tbody>
                              </table>
                              <div class="pagination-n">
                                 {!! $talents->render() !!}
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
             @else
             <div class="col-md-12 col-sm-12 col-xs-12 {{$class}}">
                  <div class="dash-box-sec table-sec-btn">
                     <div class="filter-n-btn-sec">
                     </div>
                     <div class="filter-n-btn-sec">
                        @if(!empty($checkSellerStripeAccount))
                        <a href="{{route('seller.add-product')}}"><i class="fa fa-plus" aria-hidden="true"></i> Create a Product</a>
                        @else
                        <a href="javascript:void();" data-toggle="modal" data-target="#stripeModal"><i class="fa fa-plus" aria-hidden="true"></i> Create a Product</a>
                        @endif
                     </div>
                  </div>
             </div>
             @endif
           
         </div>
      </div>
   </div>
</section>
<!-- Modal -->
<div class="modal fade myModal-del" id="stripeModal" role="dialog" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content buyer-form">
         <div class="modal-header">
         <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
          <h4 class="modal-title">Add Product and Stripe Information</h4>
         </div>
         <div class="modal-body">
            <p> Dear Seller, Futurestarr found that you have not connected your stripe account with Future Starr Stripe. 
               To upload the products and make it for selling. Please connect your stripe account first.</p>
            <br/>
			<h4>Already have stripe? Activate with FutureStarr</h4>
			<br/>
            <h3>Create your stripe account here <a href="https://dashboard.stripe.com/register" target="_blank">Click Here</a></h3>
         </div>
         <!--- Live -->
         <div class="modal-footer sec-btn">
            <a href="https://dashboard.stripe.com/express/oauth/authorize?response_type=code&client_id=ca_F6ShA9nmj7rFyWAacUK5jHM002arTCh9&scope=read_write">Connect Stripe Account</a>
            <a href="#" data-dismiss="modal">Skip</a>
         </div>
         <!--- End -->

         <!--- TESTING -->
         <!--<div class="modal-footer sec-btn">
            <a href="https://dashboard.stripe.com/express/oauth/authorize?response_type=code&client_id=ca_F6Shcg79GaOsJJ42qGdMCgeAb2Ieoaiy&scope=read_write">Connect Stripe Account</a>
            <a href="#" data-dismiss="modal">Skip</a>
         </div>-->
         <!--- End -->


         </div>
      </div>
   </div>
</div>
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
         var routeurl = '{!! route('seller.post-promote-product') !!}'; 
         $.ajax({
            type: "post",
            url: routeurl,
            data: {
                  "_token": "{{ csrf_token() }}",
                  "talent_id":talentid,
                  "title": title,
                  "message": message,
                  "social_name": media
            }, 
            success: function(response){
                  if(response.success) {
                   $('#sharingform').trigger("reset");
                   $('[id^="myModal-share"]').modal('hide');
                    toastr.success(response.success);
                     //setTimeout(function(){ window.location.reload() }, 1000);
                 }
                 if(response.error) {
                    toastr.error(response.error);
                 }
            },
            error: function(data){
              if(data) {
                  $("#titleError"+talentid).text(data.responseJSON.validation_errors.title);
                  $("#messageError"+talentid).text(data.responseJSON.validation_errors.message);
                  $("#socialNameError"+talentid).text(data.responseJSON.validation_errors.social_name);
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
@stop

