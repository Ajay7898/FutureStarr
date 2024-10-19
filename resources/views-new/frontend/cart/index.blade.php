@extends('layouts.talent') @section('content')
<ngx-loading [show]="loading" [config]="{ backdropBorderRadius: '14px' }"></ngx-loading>
<div id="main-header">
   <app-header></app-header>
</div>
<div>
   <img class="star-search-banner" src="{{asset('assets/images/talent-mall/chekout-bg.jpg')}}" style="height:325px;" />
</div>
<style type="text/css">
 .custom-cart {
    background: url('../cart/empty-cart.png') no-repeat center;height: 500px;text-align: center;padding: 10px;}.cart-sec{padding:20px;border:1px solid #ccc;margin:20px 0}.credit-sec{display:flex;justify-content:space-between;border-bottom:1px solid #ccc;margin:0 0 20px}.payment-btn-sec button{border-color:#ff503f;background:#ff503f}.payment-btn-sec button{border-color:#ff503f;background:#ff503f;font-size:16px}.payment-btn-sec{margin:0 0 40px}.img-cards.paypal img{width:100px}.side-payment img{width:110px;border-radius:5px}.side-payment{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;border-bottom:1px solid #ccc;padding-bottom:20px;margin-right:0}.side-payment.total{float:right}
	
	button.btn-continue {
    font-size: 12px;
    text-transform: uppercase;
    background: #ff503f;
    border: 1px solid #ff503f;
    padding: 5px 20px;
    color: #fff;
    border-radius: 5px;
}
button.btn-cancel {
	text-transform: uppercase;
	font-size: 12px;
    background: #fff;
    border: 1px solid #b7b7b7;
    padding: 5px 20px;
    color: #333333;
    border-radius: 5px;
}
button.btn-cancel:hover {
	color:#fff;
    background: #ff503f;
    border: 1px solid #ff503f;
}


.modal-footer {
    border-top: 2px solid #e2e2e2;
}
.modal-body p {
    font-size: 24px!important;
    max-width: 500px;
    margin: 0 auto 30px;
}
.modal-dialog {
    max-width: 650px;
}
</style>
@if(count($cartData) == 0 )
   @php $class = 'custom-cart'; @endphp
@else
 @php $class =''; @endphp
@endif
<section class="buyer-con-section">
   <div class="container">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 {{ $class }}">
         <h1>Shopping Cart</h1>
         @if(count($cartData) > 0 )

         <div class="cart-sec">
            <h3>Payment Method</h3>
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="credit-sec">
                     <p class="cr"><input type="radio" name="payment_method">Credit Card</p>
                     <div class="img-cards">
                        <img src="{{asset('assets/images/cart/1.png')}}" alt="Credit Card">
                        <img src="{{asset('assets/images/cart/2.png')}}" alt="Credit Card">
                        <img src="{{asset('assets/images/cart/3.png')}}" alt="Credit Card">
                     </div>
                  </div>
                  <p>Pay securely use your credit card</p>
                  <div class="card-body inner">
                     <form role="form" action="{{route('cart.index.post')}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY_PK_LIVE') }}"  id="payment-form">
                        @csrf
                        <div class='form-row row'>
                           <div class='col-xs-12 form-group cvc'>
                              <label class='control-label required'>Card Number</label>
                              <input autocomplete='off' class='form-control card-number' name="card_number" maxlength="16" size='20' type='text' placeholder='1234 1234 1234 1234' aria-label="Credit or debit card number">               
                           </div>
                        </div>
                        <div class='form-row row'>
                           <div class='col-xs-12 col-md-4 form-group cvc'>
                              <label class='control-label required'>CVC</label> 
                              <input autocomplete='off'  class='form-control card-cvc' maxlength="3" placeholder='ex. 311' size='4' type='text'>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration'>
                              <label class='control-label required'>Expiration Month</label>
                              <input class='form-control card-expiry-month' placeholder='MM' size='2'  type='text'>
                           </div>
                           <div class='col-xs-12 col-md-4 form-group expiration'>
                              <label class='control-label required'>Expiration Year</label> <input class='form-control card-expiry-year' placeholder='YY' maxlength="2" size='2' type='text'>
                           </div>
                        </div>
                        <div class='form-row row'>
                           <div class='col-md-12 error form-group hide'>
                              <div class='alert-danger alert'>Please correct the errors and try
                                 again.
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-12">
                              <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{$totalAmount}})</button>
					  <!-- Modal -->
					  <div class="modal fade" id="myModal1" role="dialog">
						<div class="modal-dialog">
						
						  <!-- Modal content-->
						  <div class="modal-content">
							<!--<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							  <h4 class="modal-title">Modal Header</h4>
							</div>-->
							<div class="modal-body" style="text-align:center;">
							  <img src="{{asset('assets/images/boom.png')}}" alt="paypal">
							  <p>Boom! Your Payment Processed. <br>
									Thank You!</p>
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn-continue">Continue</button>
							</div>
						  </div>
						  
						</div>
					  </div>							  
                           </div>
                        </div>
                     </form>
                  </div>
                  <div  class="credit-sec">
                     <p class="ppl-sec">
                        <input data-index="paypal" name="payment_method" onclick="myModalPaypal();" type="radio" data-toggle="modal" data-target="#myModalPaypal"> <label _ngcontent-c2="">PayPal</label>
                     </p>
                     <div class="user-cart">
                        <img src="{{asset('assets/images/cart/paypal.png')}}" alt="paypal">
                     </div>
                  </div>
               @if($stripe_customer_id)
				  <div class="hotpay">
              
              
					<a href="#" data-toggle="modal" disabled data-target="#myModal"><img src="{{asset('assets/images/hotpay.jpg')}}" alt="hotpay"></a>


					  <!-- Modal -->
					  <div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog">
						
						  <!-- Modal content-->
						  <div class="modal-content">
							<!--<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">&times;</button>
							  <h4 class="modal-title">Modal Header</h4>
							</div>-->
							<div class="modal-body" style="text-align:center;">
							  <img src="{{asset('assets/images/fire.png')}}" alt="paypal">
							  <p>Your Items are burning up! Use Hot Pay 1 Quick Payment Option</p>
							</div>
                     <form method="post" action="{{route('cart.index.post')}}">
                        @csrf
                        <input type="hidden" value="hotpay" name="hotpay">
                        <div class="modal-footer">
                        <button type="submit" class="btn-continue">Continue</button>
                        <button type="reset" class="btn-cancel" data-dismiss="modal">Cancel</button>
                        </div>
                     </form>
						  </div>
						  
						</div>
					  </div>

				  </div>
              @endif
				  

               </div>
               <div class="col-md-6 col-sm-6 col-xs-12 ">
                  <div class="credit-sec">
                     <p>Cart Summary</p>
                  </div>
                  <div class="row scrollbar scrollbar-primary">
                     <div class="col-sm-12 force-overflow">
                        @foreach($cartData as $cartKey => $cartValue)                        
                        <div style="display:none;" class="pull-right">
                           <span>
                           <strong>Sold By: {{getUserName($cartKey)}}</strong>
                           </span>
                        </div>
                        @php $sum = 0; @endphp
                        @foreach($cartValue as $innerCartKey => $innerCartValue)

                        @php
                        $price = $innerCartValue->unit_price;
                        $sum += $price;
                        @endphp
                        @if(empty($innerCartValue->getCommercial['image_path']))
                        @php
                        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                        $contentType = mime_content_type($innerCartValue->getCommercial['image_path']);
                        if(! in_array($contentType, $allowedMimeTypes) ){
                        $productImage = 'assets/images/star-logo.png'; 
                        } else {
                        $productImage = $innerCartValue->getCommercial['image_path'];
                        }
                        @endphp
                        @else 
                        @php $productImage = 'assets/images/star-logo.png'; @endphp
                        @endif
                        <div class="side-payment">
                           <div class="con-img">
                              <img src="{{asset($productImage)}}" alt="productImage">
                           </div>
                           <p class="title side-payment-tit">{{$innerCartValue->title}}</p>
                           <span><a class="recart" href="javascript:void(0);" onclick="removeCartItem('{{$innerCartValue->id}}')"><i class="fa fa-trash-o"></i></a></span>
                           <span class="unitprice">$&nbsp;{{$innerCartValue->unit_price}}</span>
                           <span id="talent_id{{$cartKey}}" data-talent-id="{{$innerCartValue->talent_id}}"></span>
                        </div>
                        @endforeach
                        @endforeach
                        <span style="display:none;" id="sub_total{{$cartKey}}" data-seller-id="{{$cartKey}}"  data-sub-total="{{$sum}}"><b>Sub total of seller:&nbsp;${{$sum}}</b></span>
                     </div>
                  </div>
                  <div style="border:none;" class="side-payment total">
                     <span class="sub-totals-data">Sub Total: ${{$totalAmount}} </span>
                  </div>
               </div>
         </div>
         @else
         <h4> Your Shopping Cart is empty! Please keep shopping.. </h4>
         @endif
      </div>
   </div>
</section>
<!-- Modal -->
<div id="myModalPaypal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Checkout</h4>
         </div>
         <div class="modal-body">
            <p>Sorry, we are currently not accepting Paypal payments at the time. Please choose other payment option.</p>
         </div>
         <div class="modal-footer">
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
         </div>
         <div class="modal-body">
            <p>Some text in the modal.</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
@endsection
@section('javascript')
<script>
   function removeCartItem(itemId) {
      var url = '{!! route('cart.delete-item') !!}';
       $.ajax({
               type: "post",
               url: url,
               data: {
                     "_token": "{{ csrf_token() }}",
                     "id":itemId,  
               },
               success: function(response){
                    if(response.success) {
                       toastr.success(response.success);
                          setTimeout(function(){ window.location.reload() }, 1000);
                    }
                    if(response.error) {
                       toastr.error(response.error);
                    }
                    if(response.info) {
                       toastr.error(response.info);
                    }
               },
               error: function(data){
                   toastr.error('Bad Request.');
               }
           });
   }
   function openModal(){
     $("#myModal").modal('show');
   }
</script>

<script type="text/javascript">
   $(function() {
     var $form   = $(".require-validation");
     $('form.require-validation').bind('submit', function(e) {
       var $form         = $(".require-validation"),
           inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'].join(', '),
           $inputs       = $form.find('.required').find(inputSelector),
           $errorMessage = $form.find('div.error'),
           valid         = true;
           $errorMessage.addClass('hide');
           $('.has-error').removeClass('has-error');
       $inputs.each(function(i, el) {
         var $input = $(el);
         if ($input.val() === '') {
           $input.parent().addClass('has-error');
           $errorMessage.removeClass('hide');
           e.preventDefault();
         }
       });
       if (!$form.data('cc-on-file')) {
         //$("#myModal").modal('show');
         e.preventDefault();
         Stripe.setPublishableKey($form.data('stripe-publishable-key'));
         Stripe.createToken({
           number: $('.card-number').val(),
           cvc: $('.card-cvc').val(),
           exp_month: $('.card-expiry-month').val(),
           exp_year: $('.card-expiry-year').val()
         }, stripeResponseHandler);
       }
     });
     function stripeResponseHandler(status, response) {
   
           if (response.error) {
              toastr.error(response.error.message);
           } else {
               // $("#myModal").modal('hide');
                var sellers = [];
                $('[id^="sub_total"]').each(function() {
                     sellers.push($(this).data('seller-id')+'-'+$(this).data('sub-total'));
                }); 
                var talentId = [];
                $('[id^="talent_id"]').each(function() {
                     talentId.push($(this).data('talent-id'));
                });
               // token contains id, last4, and card type
              // alert(talentId);
               var token = response['id'];
               var totalAmount = '{{$totalAmount}}';
               // insert the token into the form so it gets submitted to the server
               $form.find('input[type=text]').empty();
               $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
               $form.append("<input type='hidden' name='sellers' value='" + sellers + "'/>");
               $form.append("<input type='hidden' name='talent_id' value='" + talentId + "'/>");
               $form.append("<input type='hidden' name='total_amount' value='" + totalAmount + "'/>");
               $form.get(0).submit();
           }
       }
   });
</script>
@stop

