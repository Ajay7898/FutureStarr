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
<section class="buyer-con-section">
   <div class="container">
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <h1>Update Card</h1>
         <div class="cart-sec">
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="card-body inner" id="update_card_form" style="display:none">
                     <form role="form" action="{{route('update.card.post')}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY_PK_LIVE') }}"  id="payment-form">
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
                        <div class="row">
                           <div class="col-xs-12">
                              <button class="btn btn-primary btn-md btn-block" type="submit" data-toggle="modal" data-target="#myModal1">Update Card</button>
                              <button class="btn btn-primary btn-md btn-block mt-0" id="cancel" type="reset">Cancel</button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="card-body inner" id="view_card">
                     <div class='form-row row'>
                        <div class='col-xs-12 form-group cvc'>
                           <label class='control-label required'>Card Number</label>
                           <input disabled class='form-control card-number' name="" maxlength="16" size='20' type='text' placeholder="**** **** **** {{($last4)? $last4: '****'}}" aria-label="Credit or debit card number">               
                        </div>
                     </div>
                     @if($last4)
                     <div class="row">
                           <div class="col-xs-12">
                              <button class="btn btn-primary btn-md btn-block" type="button" id="update_card">Update Card</button>
                           </div>
                     </div>
                     @endif
                  </div>
               </div>
         </div>
      </div>
   </div>
</section>

@endsection
@section('javascript')


<script type="text/javascript">

   $(function() {
      $('#update_card').on('click', function(e) {
         $("#view_card").hide();
         $("#update_card_form").show();
      });
      $('#cancel').on('click', function(e) {
         $("#view_card").show();
         $("#update_card_form").hide();
      });
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
               var totalAmount = 0;
               // insert the token into the form so it gets submitted to the server
               $form.find('input[type=text]').empty();
               $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
               $form.append("<input type='hidden' name='sellers' value='" + sellers + "'/>");
               $form.append("<input type='hidden' name='talent_id' value='" + talentId + "'/>");
               $form.get(0).submit();
           }
       }
   });
</script>
@stop

