@extends('layouts.talent') @section('content')

@if(Auth::check())
		 @php $bannerclass = 'now_logged'; @endphp
		 
         @else
		 @php $bannerclass = 'now_loggedout'; @endphp
		 
         @endif

<!-- start page title section -->
<section  class="{{$bannerclass}} wow fadeIn cover-background background-position-center top-space star-search-cat" style="">
		<img src="{{ asset($catagory->catagory_detailed_banner)}}" width="100%" alt="Category">
            <div class="opacity-medium"></div>
        </section>
        <!-- end page title section -->
        
        <section class="wow fadeIn py-3">
            <div class="container">
                <h1 class="alt-font text-black font-weight-600 text-center mb-0 star-search-abd">{{$catagory->name}}</h1>
            </div>
        </section>
        
        <!-- start accordion section -->
        <section class="bg-light-gray border-none wow fadeIn pb-0 pt-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 wow fadeInLeft mb-5">
                        <!-- <span class="text-center alt-font d-block text-extra-dark-gray font-weight-500 mb-5 author-moretext1" id="des-{{$catagory->id}}" > {!! $catagory->catagory_desc !!}</span>-->
                        <span class="text-center alt-font text-extra-dark-gray font-weight-500 mb-5 author-moretext star-search-textdd" id="des-{{$catagory->id}}" > {!! $catagory->catagory_desc !!}
						
						<a class="authors-moreless-button btn btn-small btn-transparent-black" id="read_button" href="javascript: void(0)" onclick='desopen("des-{{$catagory->id}}")'>Read More</a>
						
                        <div class="text-center mt-5">
                          @if(Auth::check())
                            <a class="btn btn-small btn-transparent-black" href="{{ route('talent.index') }}" >PURCHASE NEW TALENT</a> 
                          @else
                            <a class="btn btn-small btn-transparent-black" data-toggle="modal" data-target="#register_my_model" href="javascript::void(0)" >PURCHASE NEW TALENT</a> 
                          @endif

                          @if(Auth::check() && Auth::user()->role_id =='4')
                              <a class="btn btn-small btn-dark-gray" href="{{ route('seller.index') }}"
                               style="margin-left:4px;" >SELL YOUR TALENT</a>
                            @elseif(Auth::check() && Auth::user()->role_id =='3')
                               <a class="btn btn-small btn-dark-gray" href="javascript:void(0);" data-toggle="modal" data-target="#askToJoinAsSeller" style="margin-left:4px;" >SELL YOUR TALENT</a>
                            @else
                            <a class="btn btn-small btn-dark-gray" href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model" style="margin-left:4px;" >SELL YOUR TALENT</a>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-6 cover-background sm-height-auto xs-height-350px wow fadeInRight" style="background: url({{ asset($catagory->catagory_banner)}})"></div>
                </div>
            </div>
        </section>
        <!-- end accordion section -->

        <!-- start social icons style 02 section -->
        <section class="wow fadeIn">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 col-sm-12 col-xs-12 text-center mb-5">
                        <div class="position-relative overflow-hidden width-100">
                            <span class="text-small text-outside-line-full alt-font font-weight-600 text-uppercase">SHARE IT ON</span>
                        </div>
                    </div>
                    <div class="col-md-12 text-center elements-social social-icon-style-4">
                        <ul class="medium-icon">
                            <li>
                                <a class="facebook customer share" href="http://www.facebook.com/sharer.php?u={{ Request::url() }}" shareButton="facebook" >
                                  <i class="fab fa-facebook-f"></i>
                                  <span></span>
                                </a>
                            </li>
                            <li>
                                <a class="twitter customer share" href="http://twitter.com/share?text=share&url={{ Request::url() }}" shareButton="twitter">
                                  <i class="fab fa-twitter"></i>
                                  <span></span>
                                </a>
                            </li>
                            <li>
                                <a class="linkedin customer share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{Request::url()}}" >
                                  <i class="fab fa-linkedin"></i>
                                  <span></span>
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- end social icons style 02 section -->

<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;"><i  class="ti-arrow-up"></i></a>

<!-- ASK TO LOGIN -->
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

<!-- Ask to join as Buyer -->

<div class="modal-ask-to-login fade" id="askToJoinAsBuyer" role="dialog">
    <div class="modal-dialog">
        <form>
            <!-- Modal content-->
            <div class="ask-to-login">
                <div class="modal-body">
                    <br />
                    <h3 class="ask-register"> To use this feature please register as Seller. <br /> <small>By clicking Register, you will be logged out from your current account. </small></h3>
                    <!-- <i class="fa fa-circle-o-notch fa-spin"></i> -->
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal" >REGISTER</button>
                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Ask to join as Seller -->

<div class="modal-ask-to-login fade" id="askToJoinAsSeller" role="dialog">
    <div class="modal-dialog">
     <div class="modal-content buyer-form">
       <div class="modal-header">
           
          <h5 class="modal-title">You are login as Buyer.</h5>
       </div>
       <div class="modal-body">
          <p><strong style="font-size:20px !important;"> To use this feature please register as Seller.</strong></p>
           <p> By clicking Register, you will be logged out from your current account.</p>
        </div>
        <div class="modal-footer sec-btn">
        <a href="javascript:void(0)"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            Register
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" data-dismiss="modal">Cancel</a>
       </div>
    </div>
    
  </div>
</div>

<div class="container">
   <!-- Modal -->
   <div id="register_my_model1" class="modal  modal-m" role="dialog">
      <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header mob-cls">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-sm-5 text-center login-back">
                     <h4 class="mo-sign-awe">
                        To use this feature please register as Seller. 
                     </h4>
                     <h4 class="mo-sign-fr">By clicking Register,</h4>
                     <p class="mo-now-fr"><b> you will be logged out from your current account.</b></p>
                     
                     <a href="javascript:void(0)" class="btn btn-danger reg-mod"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        Register
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                     <div class="text-center ac-acc">
                        <span class="ac-acc-ald"> Already have account? <a href="javascript:void(0)" class="cursor-pointer ac-acc-ald-open" onclick="openLoginModal();" >login here</a>
                        </span>
                     </div>
                  </div>
                  <div class="col-sm-7 text-center login-back-img" style="height: auto;background-image:url({{ asset('assets/images/new_pop_up.jpg')}});background-size:cover;background-position:left;">
                     <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
                     <br><br><br><br><br><br>
                     <p class="closer-data"></p>
                     <h3 class="closer-data"></h3>
                     <p class="closer-data"></p>
                     <br><br>  <br><br><br><br><br>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
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

/*==================================================*/
   function desopen(id){ 
 
 document.getElementById(id).classList.toggle('star-search-textdd');
 
 
 var x = document.getElementById("read_button");
  if (x.innerHTML === "Read More") {
    x.innerHTML = "Read Less";
  } else {
    x.innerHTML = "Read More";
  }
 
 
}
</script>
@stop
